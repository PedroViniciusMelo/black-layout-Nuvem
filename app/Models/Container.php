<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Container extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'hashcode_maquina',
        'docker_id',
        'user_id',
        'data_hora_instanciado',
        'data_hora_finalizado',
        'nickname',
        'image_id',
        'status',
        'state'
    ];

    public static $rules = [
        'hashcode_maquina' => ['required'],
        'docker_id' => ['required'],
        'data_hora_instanciado' => ['required', 'date'],
        'data_hora_finalizado' => ['nullable', 'date'],
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'id', 'user_id');
    }

    public function image()
    {
        return $this->belongsTo(Image::class);
    }

    public function commands()
    {
        return $this->hasMany(Command::class);
    }

    public function ports()
    {
        return $this->hasMany(Port::class);
    }
}
