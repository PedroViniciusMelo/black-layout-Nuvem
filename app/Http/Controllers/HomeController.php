<?php

namespace App\Http\Controllers;

use App\Models\Container;
use App\Models\Maquina;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $params = [
            'machines' => Auth::user()->machines()->get(),
            'containers' => Auth::user()->containers()->get(),
            'isAdmin' => Auth::user()->isAdmin(),
        ];

        return view('dashboard', $params);
    }
}
