<?php

use App\Http\Controllers\ProyectoController;
use App\Http\Controllers\TareaController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    //return view('welcome');

    //Inicio con mi vista de autenticación
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//rutas de mis controladores
Route::resource('proyectos', ProyectoController::class);
Route::resource('tareas', TareaController::class);


