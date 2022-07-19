<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\PasswordRequest;
use App\Http\Requests\Auth\ProfileRequest;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class UpdateUserController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param ProfileRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(Request $request)
    {
        //TODO ajustar validação
        $user = Auth::user();
        $data = $request->all();
        $data['access'] = $request->has('acess') ? true : false;
        $result = $user->update($data);

        if ($result) {
            return back()->with(['message' => 'Atualizado com sucesso']);
        } else {
            return redirect()->back()->with(['message' => 'Erro']);
        }
    }

    public function manageAccess(Request $request, $id){
        $user = User::findOrfail($id);
        $user->access = $request->has('access');
        $user->user_type = $request['user_type'];
        $user->containers = $request->has('containers') ? $request['containers'] : 1;

        $user->save();

        return redirect()
            ->back()
            ->with('success', 'User updated successfully!');
    }

    public function updatePassword(PasswordRequest $request){
        Auth::user()->update(
            ['password' => Hash::make($request->get('new_password'))]
        );

        return redirect()
            ->back()
            ->with('success', "Password updated successfully");
    }
}
