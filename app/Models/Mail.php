<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mail extends Model
{
    protected $fillable = ['nom','email','objet','msg','ipfrom','vu','gre','buser'];
}
