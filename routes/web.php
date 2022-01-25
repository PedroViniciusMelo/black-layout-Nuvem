<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImagesController;
use App\Http\Controllers\Api\ContainersController;
use App\Http\Controllers\AdminAreaController;
use App\Http\Controllers\MaquinasController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => 'auth'], function () {
    //Admin-area
    Route::get('admin-area', [AdminAreaController::class, 'index'])->name('admin.area');
    Route::get('admin-area/requests', [AdminAreaController::class, 'requests'])->name('admin.area.requests');
    Route::get('admin-area/machines', [AdminAreaController::class, 'machines'])->name('admin.area.machines');
    Route::get('admin-area/users', [AdminAreaController::class, 'users'])->name('admin.area.users');
    Route::get('admin-area/dockerfiles', [AdminAreaController::class, 'dockerfiles'])->name('admin.area.dockerfiles');

    Route::resource('machines', MaquinasController::class)->except('index');

    //Images
    Route::resource('images', ImagesController::class);

    //Containers
    Route::get('containers/instance/configure/{image_id}', [ImagesController::class, 'configureContainer'])->name('instance.configure');
    Route::get('containers-instance', [ContainersController::class, 'index'])->name('instance.index');
    Route::resource('containers', ContainersController::class);
    Route::get('terminal-tab/{docker_id}', [ContainersController::class, 'terminalNewTab'])->name('container.terminalTab');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// useless routes
// Just to demo sidebar dropdown links active states.
Route::get('/buttons/text', function () {
    return view('buttons-showcase.text');
})->middleware(['auth'])->name('buttons.text');

Route::get('/buttons/icon', function () {
    return view('buttons-showcase.icon');
})->middleware(['auth'])->name('buttons.icon');

Route::get('/buttons/text-icon', function () {
    return view('buttons-showcase.text-icon');
})->middleware(['auth'])->name('buttons.text-icon');

require __DIR__ . '/auth.php';
