<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Initiative extends Model
{
    use HasFactory;


    protected $fillable = [
        'title',
        'level',        //  | 
        'school',       //  
        'date',         //  
        'category',     //  
        'platform',     //  / 
        'report',       //   
        'image',        //   
    ];

    protected $casts = [
        'date' => 'date',
    ];

    public function photos()
    {
        return $this->hasMany(InitiativePhoto::class);
    }

    /** Scope: filter by level */
    public function scopeOfLevel($query, $level)
    {
        return $query->where('level', $level);
    }

    /** Scope: search by title, school or category */
    public function scopeSearch($query, $term)
    {
        return $query->where(function ($q) use ($term) {
            $q->where('title', 'like', "%$term%")
              ->orWhere('school', 'like', "%$term%")
              ->orWhere('category', 'like', "%$term%");
        });
    }
}