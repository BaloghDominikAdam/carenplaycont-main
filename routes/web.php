<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GamesController;
use App\Http\Controllers\CommunityFeedController;
use App\Http\Controllers\MessageController;





Route::get('/', function () {
    return view('welcome');
});


Route::get('reg', [UserController::class, 'reg']);
Route::post('/reg', [UserController::class, 'regData']);

Route::get('login', [UserController::class, 'Login']);
Route::post('/login', [UserController::class, 'LoginData']);

Route::get('profil', [UserController::class, 'profil'])->name('profil');
Route::post('/profil/update', [UserController::class, 'update'])->name('profil.update');
Route::post('/profil/remove-picture', [UserController::class, 'removeProfilePicture'])->name('profil.removePicture');

Route::get('/profile/{id}', [UserController::class, 'showProfile'])->name('profile.show');




Route::get('/logout', [UserController::class, 'Logout']);

Route::get('newpass', [UserController::class, 'Newpass']);
Route::post('newpass', [UserController::class, 'NewpassData']);


Route::get('gamesMode', [GamesController::class ,'gamesMode']);

Route::get('community', [CommunityFeedController::class, 'Community']);
Route::post('community', [CommunityFeedController::class, 'CommunityData']);


Route::get('/messages/index', [MessageController::class, 'index'])->name('messages.index');
Route::post('/messages/send', [MessageController::class, 'send'])->name('messages.send');


Route::middleware('auth:sanctum')->group(function () {
    Route::post('/send-message', [MessageController::class, 'sendMessage']);
    Route::get('/get-messages/{userId}', [MessageController::class, 'getMessages']);
});

