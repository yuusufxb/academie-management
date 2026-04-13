<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $fillable = ['typ', 'dte', 'hr', 'title', 'resp', 'lieu', 'benfs', 'nb', 'ref', 'gre', 'niv'];
    public function photos()
{
    return $this->hasMany(Photo::class, 'idact');
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
public function catigory()
    {
        // 'typ' هو العمود الموجود في جدول activities والذي يحتوي على ID الفئة
        return $this->belongsTo(Catigory::class, 'typ');
    }
}

