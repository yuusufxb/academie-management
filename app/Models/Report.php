<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = ['idact', 'title', 'byu', 'rap', 'vu'];
    public function activity()
{
    return $this->belongsTo(Activity::class, 'idact');
}

public function user()
{
    return $this->belongsTo(User::class, 'byu');
}
}
