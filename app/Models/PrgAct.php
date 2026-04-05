<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PrgAct extends Model
{
    protected $fillable = ['resp','title','result','src','nbpart','type','parts','date','desc','lieu'];
    protected $casts = ['date' => 'date'];
}
