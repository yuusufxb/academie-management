<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InitiativePhoto extends Model
{
    protected $fillable = ['idrep', 'name', 'path'];

    public function initiative()
    {
        return $this->belongsTo(Report::class, 'idrep');
    }
}

