<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    public const LEVEL_INSTITUTION = 1;
    public const LEVEL_SUPERVISOR = 2;
    public const LEVEL_DIRECTOR = 3;
    public const LEVEL_PROVINCIAL_ADMIN = 5;
    public const LEVEL_ACADEMY_ADMIN = 6;

    protected $fillable = [
        'name',
        'email',
        'password',
        'gre',
        'niv'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'niv' => 'integer',
    ];

    public function hasLevel(int $level): bool
    {
        return $this->niv === $level;
    }

    public function hasAnyLevel(int ...$levels): bool
    {
        return in_array($this->niv, $levels, true);
    }

    public function isInstitutionAdmin(): bool
    {
        return $this->hasLevel(self::LEVEL_INSTITUTION);
    }

    public function isRegionalSupervisor(): bool
    {
        return $this->hasLevel(self::LEVEL_SUPERVISOR);
    }

    public function isRegionalDirector(): bool
    {
        return $this->hasLevel(self::LEVEL_DIRECTOR);
    }

    public function isProvincialAdmin(): bool
    {
        return $this->hasLevel(self::LEVEL_PROVINCIAL_ADMIN);
    }

    public function isAcademyAdmin(): bool
    {
        return $this->hasLevel(self::LEVEL_ACADEMY_ADMIN);
    }

    public function canAccessIqlimDashboard(): bool
    {
        return $this->hasLevel(self::LEVEL_PROVINCIAL_ADMIN);
    }

    public function canAccessAcademyDashboard(): bool
    {
        return $this->hasLevel(self::LEVEL_ACADEMY_ADMIN);
    }

    public function canViewMedia(): bool
    {
        return $this->hasAnyLevel(
            self::LEVEL_SUPERVISOR,
            self::LEVEL_DIRECTOR,
            self::LEVEL_PROVINCIAL_ADMIN,
            self::LEVEL_ACADEMY_ADMIN
        );
    }

    public function canManageMedia(): bool
    {
        return $this->hasAnyLevel(self::LEVEL_DIRECTOR, self::LEVEL_ACADEMY_ADMIN);
    }

    public function canManageActivities(): bool
    {
        return $this->hasAnyLevel(
            self::LEVEL_INSTITUTION,
            self::LEVEL_SUPERVISOR,
            self::LEVEL_DIRECTOR,
            self::LEVEL_PROVINCIAL_ADMIN,
            self::LEVEL_ACADEMY_ADMIN
        );
    }

    /** Liste / détail utilisateurs (lecture seule pour niv 3) */
    public function canViewUsers(): bool
    {
        return $this->hasAnyLevel(
            self::LEVEL_DIRECTOR,
            self::LEVEL_PROVINCIAL_ADMIN,
            self::LEVEL_ACADEMY_ADMIN
        );
    }

    /** Création d’utilisateurs : niv 5 (son province) et niv 6 (tout) — pas niv 3 */
    public function canCreateUsers(): bool
    {
        return $this->hasAnyLevel(self::LEVEL_PROVINCIAL_ADMIN, self::LEVEL_ACADEMY_ADMIN);
    }

    public function canEditUsers(): bool
    {
        return $this->hasAnyLevel(self::LEVEL_PROVINCIAL_ADMIN, self::LEVEL_ACADEMY_ADMIN);
    }

    /** Suppression, reset mot de passe, envoi identifiants */
    public function canFullyManageUsers(): bool
    {
        return $this->hasLevel(self::LEVEL_ACADEMY_ADMIN);
    }

    public function roleLabel(): string
    {
        return match ($this->niv) {
            self::LEVEL_INSTITUTION => 'مؤسسة',
            self::LEVEL_SUPERVISOR => 'إقليم',
            self::LEVEL_DIRECTOR => 'أكاديمية',
            self::LEVEL_PROVINCIAL_ADMIN => 'مدير إقليمي',
            self::LEVEL_ACADEMY_ADMIN => 'مدير أكاديمي',
            default => 'غير معروف',
        };
    }

    public function reports()
    {
        return $this->hasMany(Report::class, 'byu');
    }

    public function mails()
    {
        return $this->hasMany(Mail::class, 'buser');
    }

    /**
     * Code province (CD_PROV) : soit gre = CD_PROV dans z_prov, soit gre = CD_ETAB lié à Etabz.
     */
    public function provinceCode(): ?string
    {
        if ($this->gre === null || $this->gre === '') {
            return null;
        }

        $g = trim((string) $this->gre);

        if (ZProv::where('CD_PROV', $g)->exists()) {
            return $g;
        }

        $etab = Etabz::where('CD_ETAB', $g)->first();

        return $etab?->CD_PROV;
    }

    /** Tous les codes gre possibles pour une province (CD_PROV + CD_ETAB des établissements). */
    public static function greCodesForProvince(string $cdProv): array
    {
        $etabs = Etabz::where('CD_PROV', $cdProv)->pluck('CD_ETAB')->filter()->all();

        return array_values(array_unique(array_merge([$cdProv], $etabs)));
    }

    public function provinceLabel(): ?string
    {
        $cd = $this->provinceCode();
        if (!$cd) {
            return null;
        }

        return ZProv::where('CD_PROV', $cd)->value('LA_PROV');
    }

    /** Utilisateurs situés dans la même province (même logique gre / établissements). */
    public function scopeInSameProvinceAs(Builder $query, User $provincialUser): Builder
    {
        $cd = $provincialUser->provinceCode();
        if (!$cd) {
            return $query->whereRaw('1 = 0');
        }

        $codes = self::greCodesForProvince($cd);

        return $query->whereIn('gre', $codes);
    }

    /** Un autre utilisateur est-il dans la même province ? */
    public function sharesProvinceWith(User $other): bool
    {
        $a = $this->provinceCode();
        $b = $other->provinceCode();

        return $a !== null && $b !== null && $a === $b;
    }
}