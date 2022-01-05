<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dockerfile extends Model
{
    protected $fillable = [
        'file',
        'tag'
    ];
}
