<?php

use App\Http\Controllers\Auth\UpdateUserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImagesController;
use App\Http\Controllers\Api\ContainersController;
use App\Http\Controllers\AdminAreaController;
use App\Http\Controllers\MaquinasController;
use App\Http\Controllers\DockerfileController;

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

Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::get('/dashboard', HomeController::class)->name('dashboard');
    //Admin-area
    Route::get('/admin-area', [AdminAreaController::class, 'index'])->name('admin.area');
    Route::get('/admin-area/requests', [AdminAreaController::class, 'requests'])->name('admin.area.requests');
    Route::get('/admin-area/machines', [AdminAreaController::class, 'machines'])->name('admin.area.machines');
    Route::get('/admin-area/users', [AdminAreaController::class, 'users'])->name('admin.area.users');
    Route::get('/admin-area/dockerfiles', [AdminAreaController::class, 'dockerfiles'])->name('admin.area.dockerfiles');
    Route::put('/change_access/{id}', [UpdateUserController::class, 'manageAccess'])->name('manage.access');

    //Machines
    Route::resource('machines', MaquinasController::class);

    //Images
    Route::resource('images', ImagesController::class);

    //Dockerfiles
    Route::resource('dockerfiles', DockerfileController::class);
    Route::put('dockerfiles/build', [DockerfileController::class, 'build'])->name('dockerfiles.build');

    //Containers
    Route::get('containers/instance/configure/{image_id}', [ImagesController::class, 'configureContainer'])->name('instance.configure');
    Route::resource('containers', ContainersController::class);
    Route::put('containers/toggle/{id}', [ContainersController::class, 'toggleContainer'])->name('toggleContainer');
    Route::get('terminal-tab/{docker_id}', [ContainersController::class, 'terminalNewTab'])->name('container.terminalTab');
});

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
