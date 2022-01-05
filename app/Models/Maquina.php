<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Maquina extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $fillable = [
        'cpu_utilizavel',
        'ram_utilizavel',
        'hashcode',
        'user_id',
        'ip',
        'disponivel'
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function atividadesMaquina(){
        return $this->hasMany(AtividadeMaquina::class, 'hashcode_maquina');
    }
}
