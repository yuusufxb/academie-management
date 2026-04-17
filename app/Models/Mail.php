<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Mail extends Model
{
    protected $fillable = ['nom', 'email', 'objet', 'msg', 'ipfrom', 'vu', 'gre', 'buser'];

    public function scopeVisibleToUser(Builder $query, ?User $user): Builder
    {
        if (!$user) {
            return $query->whereRaw('1 = 0');
        }

        return match ((int) $user->niv) {
            User::LEVEL_INSTITUTION,
            User::LEVEL_SUPERVISOR => $query->where('gre', $user->gre),
            User::LEVEL_PROVINCIAL_ADMIN => $query->when(
                $user->provinceCode(),
                function (Builder $q, string $cd) {
                    $q->whereIn('gre', User::greCodesForProvince($cd));
                },
                fn (Builder $q) => $q->whereRaw('1 = 0')
            ),
            User::LEVEL_DIRECTOR,
            User::LEVEL_ACADEMY_ADMIN => $query,
            default => $query->whereRaw('1 = 0'),
        };
    }

    public function user()
{
    return $this->belongsTo(User::class, 'buser');
}
}
