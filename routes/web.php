<?php

use App\Http\Controllers\adminController;
use App\Http\Controllers\AsignaturasController;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\estudianteController;
use App\Http\Controllers\PermisoController;
use App\Http\Controllers\PersonalController;
use App\Http\Controllers\profesorController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

// Rutas de Control e Ingresos del sistema
Route::middleware('auth')->group(function () {
    Route::get('/administrador', [adminController::class, 'index'])->name('admin.dashboard');
    Route::get('/estudiante', [estudianteController::class, 'index'])->name('estudiante.dashboard');
    Route::get('/profesor', [profesorController::class, 'index'])->name('profesor.dashboard');
    Route::get('/dashboard', [adminController::class, 'index'])->name('dashboard');
});

// Rutas de Control e Ingresos del sistema
Route::middleware('auth')->group(function () {
    Route::resource('/roles', RoleController::class);
    Route::resource('/permisos', PermisoController::class);
    Route::resource('/usuarios', UserController::class);
    Route::resource('/personal', PersonalController::class);
    Route::resource('/cursos', CursoController::class);
    Route::resource('/asignaturas', AsignaturasController::class);
   
});

//Rutas de Configuracion de Perfil
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
