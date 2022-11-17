<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
})->name('home');

Route::get('/unauthorized', function () {
    return Inertia::render('Unauthorized');
})->name('unauthorized');

Route::resource('dashboard', DashboardController::class)->only('index')->middleware('auth');
Route::resource('users', UserController::class)->middleware('auth');
Route::resource('roles', RoleController::class)->middleware('auth');
Route::resource('permissions', PermissionController::class)->middleware('auth');

//Route::get('/users', function () {
//    return Inertia::render('Users/Index');
//})->middleware(['auth', 'verified'])->name('users');
//

//Route::resource('users', UserController::class);

require __DIR__.'/auth.php';
