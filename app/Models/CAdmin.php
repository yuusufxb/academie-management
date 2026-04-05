<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CAdmin extends Model
{
    protected $fillable = ['yr', 'mois', 'lieu', 'dte', 'rap', 'tof'];
    protected $casts = ['dte' => 'date'];
}
