<?php

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Aqui se encuentran todas las rutas Web de nuestro cliente, cada una con
| sus respectivos nombres.
|
*/

// Ruta principal, Index o Home donde se muestra la lista de citas, calendario y demas.
Route::get('/', [\App\Http\Controllers\WebController::class, 'indexApi']) -> middleware('web') -> name('index');

// Ruta de inicio de sesion
Route::get('/login', [\App\Http\Controllers\WebController::class, 'login']) -> middleware('web') -> name('login');

// Ruta de registro
Route::get('/register', [\App\Http\Controllers\WebController::class, 'register']) -> middleware('web') -> name('register');

// Ruta de cierre de sesion
Route::get('/logout', [\App\Http\Controllers\WebController::class, 'logout']) -> middleware('web') -> name('logout');

// Ruta para pasar el token de sesion al servidor
Route::post('/store-token', [\App\Http\Controllers\TokenController::class, 'storeToken']) -> middleware('web') -> name('store-token');
