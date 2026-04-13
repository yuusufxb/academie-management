<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TEtablis extends Model
{
    protected $table = 't_etablis';
    protected $primaryKey = 'CD_ETAB';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
    protected $fillable = ['CD_ETAB', 'NOM_ETABA', 'CD_COM', 'typeEtab', 'CD_EtabMere', 'cyc', 'prov'];
}
