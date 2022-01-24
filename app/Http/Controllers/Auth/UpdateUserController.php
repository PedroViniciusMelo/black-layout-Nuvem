<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\PasswordRequest;
use App\Http\Requests\Auth\ProfileRequest;
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
    public function __invoke(ProfileRequest $request)
    {
        Auth::user()->update($request->all());

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
