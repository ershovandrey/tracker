<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    // Remove builtin created_at and updated_at timestamps.
    public $timestamps = false;

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
