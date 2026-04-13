<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Star extends Model
{
    protected $fillable = ['idact', 'typ', 'title', 'infos', 'tof'];
    public function activity()
{
    return $this->belongsTo(Activity::class, 'idact');
}
}
