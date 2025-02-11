<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AtividadeMaquina;
use App\Models\Maquina;
use Illuminate\Http\Request;

class AtividadeMaquinasController extends Controller
{
    public function index()
    {
        return AtividadeMaquina::all();
    }

    public function store(Request $request)
    {
        $hash = $request->input('hashcode_maquina');
        $data = [
            'hashcode_maquina' => $hash,
            'data_hora_inicio' => now(),
            'last_notification' => now(),
        ];

        $machine = Maquina::firstWhere('hashcode', $hash);
        $activity = AtividadeMaquina::firstWhere(['data_hora_fim' => null, 'hashcode_maquina' => $hash]);

        if ($machine) {
            if ($activity) {
                $machine->ip = $request->server()['REMOTE_ADDR'];
                $machine->save();
                $activity->last_notification = now();
                $activity->save();
            } else {
                AtividadeMaquina::create($data);

                $machine->disponivel = true;
                $machine->save();
            }
        }
    }

    public function show($id)
    {
        return AtividadeMaquina::findOrFail($id);
    }

    public function update(Request $request)
    {
        $hash = $request->input('hashcode_maquina');

        $machine = Maquina::firstWhere('hashcode', $hash);
        $activity = AtividadeMaquina::firstWhere(['data_hora_fim' => null, 'hashcode_maquina' => $hash]);

        if ($machine && $activity) {
            $activity->dataHoraFim = now();
            $activity->save();

            $machine->disponivel = false;
            $machine->save();
        }
    }

    public function destroy($id)
    {
        $atividade = AtividadeMaquina::findOrFail($id);
        $atividade->delete();
    }
}
