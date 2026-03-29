<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Activity extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'type',
        'date',
        'place',
        'responsible',
        'description',
        'icon',
        'color_class',
        'type_color',
        'status',          // مصادق | انتظار | مسودة
        'scheduled_date',
        'notes',
    ];

    protected $casts = [
        'date'           => 'date',
        'scheduled_date' => 'date',
    ];

    public function photos()
    {
        return $this->hasMany(Photo::class);
    }

    /** Scope: filter by type */
    public function scopeOfType($query, $type)
    {
        return $query->where('type', $type);
    }

    /** Scope: programmed (has a scheduled_date) */
    public function scopeProgrammed($query)
    {
        return $query->whereNotNull('scheduled_date');
    }

    /** Scope: search */
    public function scopeSearch($query, $term)
    {
        return $query->where(function ($q) use ($term) {
            $q->where('title', 'like', "%$term%")
              ->orWhere('responsible', 'like', "%$term%")
              ->orWhere('place', 'like', "%$term%");
        });
    }
}
