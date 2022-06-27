<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\UserRequest;

class UserController extends Controller
{

    public function index(User $model)
    {
        return view('users.index', ['users' => $model->paginate(15)]);
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(UserRequest $request)
    {
        $this->validate($request, $request->rules());

        $user = User::create($request->all());

        return view('users.login');
    }

    public function show($id)
    {
        return view('users.show', ['user' => User::where('id', $id)->first()]);
    }

    public function edit($id)
    {
        return view('users.edit', ['user' => User::where('id', $id)->first(), 'title' => 'User Profile']);
    }

    public function update(UserRequest $request, $id)
    {
        $this->validate($request, $request->rules());

        $data = $request->all();
        $data['acess'] = $request->has('acess') ? true : false;
        $user = User::firstWhere('id', $id);
        $result = $user->update($data);
        // dd($result);

        if ($result) {
            return back()->with(['success' => 'Atualizado com sucesso']);
        } else {
            return redirect()->back()->with(['error' => 'Erro']);
        }
    }

    public function destroy($id)
    {
        $user = User::firstWhere('id', $id);
        $result = $user->delete();

        if ($result) {
            return redirect()->route('home.index');
        } else {
            return redirect()->back();
        }
    }
}
