<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Etabz extends Model
{
    protected $table = 'Etabz';
    protected $primaryKey = 'CD_ETAB';
    public $incrementing = false; // Primary key is a string, not an auto-increment integer
    protected $keyType = 'string';
    public $timestamps = false;
    protected $fillable = ['CD_ETAB', 'NOM_ETABA', 'cyc', 'la_com', 'LA_MIL', 'CD_PROV', 'LA_PROV'];

    public function province()
{
    return $this->belongsTo(ZProv::class, 'CD_PROV', 'CD_PROV');
}

public function tEtablis()
{
    return $this->hasOne(TEtablis::class, 'CD_ETAB', 'CD_ETAB');
}
}
