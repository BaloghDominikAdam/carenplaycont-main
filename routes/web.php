<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GamesController;





Route::get('/', function () {
    return view('welcome');
});


Route::get('reg', [UserController::class, 'reg']);
Route::post('/reg', [UserController::class, 'regData']);

Route::get('login', [UserController::class, 'Login']);
Route::post('/login', [UserController::class, 'LoginData']);

Route::get('profil', [UserController::class, 'profil']);


Route::get('/logout', [UserController::class, 'Logout']);

Route::get('newpass', [UserController::class, 'Newpass']);
Route::post('newpass', [UserController::class, 'NewpassData']);


Route::get('gamesMode', [GamesController::class ,'gamesMode']);


