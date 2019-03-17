<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    protected $fillable = [
        'url',
        'token',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function visits()
    {
        return $this->hasMany(Visit::class);
    }
}
