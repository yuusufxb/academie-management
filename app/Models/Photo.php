<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $fillable = ['name', 'path', 'idact'];
    public function activity()
{
    return $this->belongsTo(Activity::class, 'idact');
}
}
