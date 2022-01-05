<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Command extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'command',
        'description'
    ];

    public function container()
    {
        return $this->belongsTo(Container::class);
    }

}
