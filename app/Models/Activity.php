<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $fillable = ['typ', 'dte', 'hr', 'title', 'resp', 'lieu', 'benfs', 'nb', 'ref', 'gre', 'niv'];

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

    public function photos()
{
    
    return $this->hasMany(Photo::class, 'idact');
}
    public function catigory()
    {
        // 'typ' هو العمود الموجود في جدول activities والذي يحتوي على ID الفئة
        return $this->belongsTo(Catigory::class, 'typ');
    }

public function reports()
{
    return $this->hasMany(Report::class, 'idact');
}

public function stars()
{
    return $this->hasMany(Star::class, 'idact');
}
public function mainPhoto()
{
    return $this->hasOne(Photo::class, 'idact')->where('is_main', 1);
}

public function videos()
{
    return $this->hasMany(Media::class, 'idact');
}

}

