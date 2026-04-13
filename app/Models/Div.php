<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Div extends Model
{
    public $timestamps = false; // Because `created_at` and `updated_at` are not in the SQL
    protected $fillable = ['niv', 'type', 'title', 'src'];
}
