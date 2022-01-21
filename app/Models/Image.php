<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Image extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'from_image',
        'from_src',
        'repo',
        'tag',
        'message',
        'user_type'
    ];

    public function getInstances()
    {
        return $this->hasMany(Container::class);
    }
}
