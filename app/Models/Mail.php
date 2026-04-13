<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mail extends Model
{
    protected $fillable = ['nom', 'email', 'objet', 'msg', 'ipfrom', 'vu', 'gre', 'buser'];

    public function user()
{
    return $this->belongsTo(User::class, 'buser');
}
}
