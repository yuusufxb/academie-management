<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Qossassa extends Model
{
    protected $fillable = ['journal', 'dte', 'titre', 'lien', 'photo', 'txt'];
}
