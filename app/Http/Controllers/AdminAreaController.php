<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Container;
use App\Models\Maquina;
use App\Models\User;
use App\Models\Dockerfile;
use Illuminate\Support\Facades\Auth;

class AdminAreaController extends Controller
{
    private const PAGE_LIMITE = 10;

    public function index()
    {
        $params = [
            'machines' => Maquina::paginate($this::PAGE_LIMITE),
            'users' => User::orderBy('id')->paginate($this::PAGE_LIMITE),
            'containers' => Container::paginate($this::PAGE_LIMITE),
            'docker_host' => env('DOCKER_HOST'),
            'machinesQuantity' => Maquina::all()->count(),
            'machinesInActivity' => Maquina::where('disponivel', true)->count(),
            'images' => Image::paginate($this::PAGE_LIMITE),
            'registeredToday' => User::whereDate('created_at', '=', date('Y-m-d'))->count(),
            'registeredThisMonth' => User::whereYear('created_at', date('Y'))->whereMonth('created_at', date('m'))->count(),
            'instancesPerImage' => $this->getInstacesOfEachImage(),
            'graficDataUsers' => $this->getGraficDataUsers(),
            'graficDataMachines' => $this->getGraficDataMachines(),
            'imagesLabel' => Image::all()->pluck('name')->toArray(),
            'graficDataImages' => $this->getInstacesCountImages()
        ];

        return view('pages/admin/index', $params);
    }

    public function machines()
    {
        if (Auth::user()->isAdmin()) {
            return view('pages/admin/machines', ['machines' => Maquina::orderBy('id')->paginate(10)]);
        } else {
            return redirect()->back()->with('error', 'User not Authorized!!!');
        }
    }

    public function getGraficDataUsers()
    {
        $result = collect();
        foreach (range(1, 12) as $number) {
            $result->push(User::whereYear('created_at', date('Y'))->whereMonth('created_at', date($number))->count());
        }
        return $result;
    }

    public function getGraficDataMachines()
    {
        $result = collect();
        foreach (range(1, 12) as $number) {
            $result->push(Maquina::whereYear('created_at', date('Y'))->whereMonth('created_at', date($number))->count());
        }
        return $result;
    }

    public function users()
    {
        if (Auth::user()->isAdmin()) {
            $users = User::orderBy('id')->paginate(10);
            $params = [
                'users' => $users,
                'machinesCount' => $this->getMachinesCount($users),
                'imagesCount' => $this->getInstanceImagesCount($users),
            ];

            return view('pages.admin.manage_users', $params);
        } else {
            return redirect()->back()->with('error', 'User not Authorized!!!');
        }
    }

    public function requests()
    {
        if (Auth::user()->isAdmin()) {
            $users = User::where('user_type', '!=','admin')->orderBy('id')->paginate(10);
            $params = [
                'users' => $users,
                'registered_today' => User::whereYear('created_at', date('Y'))->whereMonth('created_at', date('m'))->whereDay('created_at', date('d'))->count(),
                'registered_this_month' => User::whereYear('created_at', date('Y'))->whereMonth('created_at', date('m'))->count()
            ];

            return view('pages.admin.manage_users', $params);
        } else {
            return redirect()->back()->with('error', 'User not Authorized!!!');
        }
    }

    public function getMachinesCount($users)
    {
        $array = [];

        foreach ($users as $user) {
            $array[$user->id] = Maquina::where('user_id', $user->id)->count();
        }

        return $array;
    }

    public function getInstanceImagesCount($users)
    {
        $array = [];

        foreach ($users as $user) {
            $array[$user->id] = Container::where('user_id', $user->id)->count();
        }

        return $array;
    }

    private function getInstacesOfEachImage()
    {
        $images = Image::all();

        $array = [];

        foreach ($images as $container) {
            $array[$container->id] = Container::where('image_id', $container->id)->get()->count();
        }

        return $array;
    }
    private function getInstacesCountImages()
    {
        $images = Image::all();

        $array = [];

        foreach ($images as $image) {
            $array[] = Container::where('image_id', $image->id)->get()->count();
        }

        return $array;
    }

    public function dockerfiles()
    {
        $dockerfiles = Dockerfile::all();
        $url = env('DOCKER_HOST');

        return view('pages.admin.dockerfiles', compact('dockerfiles', 'url'));

    }
}
