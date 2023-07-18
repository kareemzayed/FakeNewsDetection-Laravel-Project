<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PredictionController;


/* ------------- available Routes ------------------------*/
Route::get('/', [MainController::class, 'landingPage']) -> name('landing-page');
Route::get('/home', [MainController::class, 'home']) -> name('home');
Route::post('/predict-news', [PredictionController::class, 'predictNews']) -> name('predict.news');
Route::post('/classify-with-url', [PredictionController::class, 'predictNewsWithURL']) -> name('predict.url');


/* ------------- authonticated Routes -------------------*/
Route::group(['middleware' => 'auth'], function() {
    Route::get('/profile', [UserController::class, 'profile']) -> name('profile');
    Route::post('/profile/update-information', [UserController::class, 'updateInformation']) -> name('update.information');
    Route::post('/profile/update-password', [UserController::class, 'UpdatePassword']) -> name('update-password');
    Route::get('/history', [UserController::class, 'ShowHistory']) -> name('history');
    Route::delete('/delete-process/{id}', [UserController::class, 'DeleteProcess']) -> name('user-delete-process');
    Route::post('/send-message', [UserController::class, 'SendMessgae']) -> name('send-message');
});
