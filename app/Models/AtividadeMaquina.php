<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AtividadeMaquina extends Model
{
    use HasFactory;

    protected $fillable = [
        'hashcode_maquina',
        'data_hora_inicio',
        'data_hora_fim',
        'last_notification'
    ];

    public static $rules = [
        'hashcode_maquina' => ['required'],
        'data_hora_inicio' => ['required']
    ];

    public static $messages = [
        'required' => 'O campo :attibute é obrigatório.',
    ];

    public function machine()
    {
        return $this->belongsTo(Maquina::class, 'hashcode');
    }

    public function user(): User
    {
        return $this->machine->user;
    }
}
