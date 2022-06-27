<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\PasswordRequest;
use App\Http\Requests\Auth\ProfileRequest;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Auth;
use Hash;

class UpdateUserController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param ProfileRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(UserRequest $request, $id)
    {
        $data = $request->all();
        $data['acess'] = $request->has('acess');
        $user = User::findOrfail($id);
        $result = $user->update($data);

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
