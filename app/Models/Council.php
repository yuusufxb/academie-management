<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Council extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'date',
        'place',
        'session',    
        'year',
        'report',
        'image',          //  
        'status',         //   
        'notes',
    ];

    protected $casts = [
        'date' => 'date',
        'year' => 'integer',
    ];

    // إذا عندك photos (relation)
    public function photos()
    {
        return $this->hasMany(CouncilPhoto::class);
    }

    /** Scope: filter by year */
    public function scopeOfYear($query, $year)
    {
        return $query->where('year', $year);
    }

    /** Scope: filter by session */
    public function scopeOfSession($query, $session)
    {
        return $query->where('session', $session);
    }

    /** Scope: search */
    public function scopeSearch($query, $term)
    {
        return $query->where(function ($q) use ($term) {
            $q->where('title', 'like', "%$term%")
              ->orWhere('place', 'like', "%$term%")
              ->orWhere('report', 'like', "%$term%");
        });
    }
}