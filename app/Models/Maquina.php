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

    public function totalTimeActivity($round = 0)
    {
        $activities = $this->atividadesMaquina;
        $time = 0;

        foreach($activities as $act) {
            if($act->dataHoraFim) {
                $time += strtotime($act->dataHoraFim) - strtotime($act->dataHoraInicio);
            } else {
                $time += strtotime(now()) - strtotime($act->dataHoraInicio);
            }
        }
        return ($round ? round($time/3600, $round) : $time/3600);
    }

    public static function totalTimeAllMachines($round =0)
    {
        $machines = Maquina::all();
        $total = 0;

        foreach($machines as $machine){
            $total += $machine->totalTimeActivity();
        }

        return ($round ? round($total, $round) : $total);
    }

    public function atividadesMaquina(){
        return $this->hasMany(AtividadeMaquina::class, 'hashcode_maquina');
    }
}
