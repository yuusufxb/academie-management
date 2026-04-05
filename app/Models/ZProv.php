<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ZProv extends Model
{
    protected $fillable = ['CD_PROV','CD_REG','LL_PROV','LA_PROV','Actif','DateModification'];
    protected $casts = ['DateModification' => 'datetime'];
}
