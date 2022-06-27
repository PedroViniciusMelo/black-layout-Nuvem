<?php

namespace App\Http\Controllers;

use App\Models\Maquina;
use App\Http\Requests\MachineRequest;
use App\Models\AtividadeMaquina;
use Illuminate\Support\Facades\Auth;

class MaquinasController extends Controller
{

    public function index()
    {
        $user = Auth::user();
        $data = [
            'machines' => $user->machines()->orderby('id')->paginate(5),
        ];

        return view('pages.machines.index', $data);
    }

    public function create()
    {
        return view('pages.machines.create');
    }

    public function store(MachineRequest $request)
    {
        $this->validar($request);
        $maquina = Maquina::create($this->getData($request));

        if ($maquina) {
            return redirect()->route('machines.index')->with(['success' => 'Máquina criada com sucesso!']);
        } else {
            return redirect()->back()->withInput();
        }
    }

    public function show($id)
    {
        $machine = Maquina::findOrFail($id);
        $params = [
            'machine' => $machine,
            'activities' => AtividadeMaquina::where('hashcode_maquina', $machine->hashcode)
                ->orderBy('created_at', 'desc')
                ->paginate(5),
        ];

        return view('pages.machines.show', $params);
    }

    public function edit($id)
    {
        return view('pages.machines.create', ['machine' => Maquina::findOrFail($id)]);
    }

    public function update(MachineRequest $request, $id)
    {
        $this->validar($request);
        $maquina = Maquina::findOrFail($id);
        $result = $maquina->update($request->all());

        if ($result) {
            return redirect()->back()->with(['success' => 'Máquina atualizada com sucesso!'])->withInput();
        } else {
            return redirect()->back()->withInput();
        }
    }

    public function destroy($id)
    {
        $maquina = Maquina::findOrFail($id);
        if ($maquina->delete()) {
            return redirect()->back()->with(['success' => 'Máquina deletada com sucesso!']);
        } else {
            return redirect()->back()->with('error', 'Falha ao deletar!');
        }
    }

    private function validar(MachineRequest $request)
    {
        $this->validate($request, $request->rules(), $request->messages());
    }

    private function getData(MachineRequest $request)
    {
        $data = $request->all();
        $data['user_id'] = Auth::user()->id;
        $data['hashcode'] = $this->getHashCode($data);

        return $data;
    }

    private function getHashCode($data)
    {
        $hash = '';

        foreach ($data as $d) {
            $hash .= $d;
        }

        $time = now();
        $hash .= "$time";

        return bcrypt($hash);
    }
}
