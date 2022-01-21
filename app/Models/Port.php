<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Port extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'ip',
        'private_port',
        'public_port',
        'type',
        'network_settings',
        'disponivel'
    ];

    public function container()
    {
        return $this->belongsTo(Container::class);
    }
}
