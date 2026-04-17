<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $fillable = ['name', 'path', 'idact'];

    public function scopeVisibleToUser(Builder $query, ?User $user): Builder
    {
        if (!$user) {
            return $query->whereRaw('1 = 0');
        }

        return $query->whereHas('activity', function (Builder $activityQuery) use ($user) {
            $activityQuery->visibleToUser($user);
        });
    }

    public function activity()
{
    return $this->belongsTo(Activity::class, 'idact');
}
}
