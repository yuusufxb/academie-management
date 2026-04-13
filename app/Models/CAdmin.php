<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CAdmin extends Model
{
    protected $table = 'c_admins';
    protected $fillable = ['yr', 'mois', 'lieu', 'dte', 'rap', 'tof'];
}
