<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ZProv extends Model
{
    protected $table = 'z_prov';
    protected $primaryKey = 'CD_PROV';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
    protected $fillable = ['CD_PROV', 'CD_REG', 'LL_PROV', 'LA_PROV', 'Actif', 'DateModification'];

    public function etablissements()
{
    return $this->hasMany(Etabz::class, 'CD_PROV', 'CD_PROV');
}
}
