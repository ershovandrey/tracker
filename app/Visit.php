<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    protected $fillable = [
        'site_id',
        'visitor',
        'url',
        'browser',
        'ip',
        'datetime'
    ];

    public function site()
    {
        return $this->belongsTo(Site::class);
    }
}
