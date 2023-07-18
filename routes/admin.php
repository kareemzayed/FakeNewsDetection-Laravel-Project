<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\MainController;

/*
    - Admin Routes Here ==>
*/

Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {

    Route::controller(MainController::class)->group(function () {
        Route::get('/dashboard', 'viewDashboard')->name('dashboard');
        Route::get('/users', 'viewUsers')->name('view-users');
        Route::delete('/delete-user/{id}', 'deleteUser')->name('delete-user');
        Route::get('/processes/{userId}', 'showProcessesForUser')->name('show-user-processes');
        Route::get('/users-messages', 'showUserMessages') -> name('show-users-messages');
        Route::delete('/delete-message/{id}', 'deleteMessage') -> name('delete-message');
        Route::get('/users-all-processes', 'showAllProcesses') -> name('show-all-processes');
        Route::get('/user-of-process/{userId}', 'showUserOfProcess')->name('show-process-user');
        Route::delete('/delete-process/{id}', 'deleteProcess') -> name('delete-process');
        Route::get('/users-real-news', 'showRealNews') -> name('show-real-news');
        Route::get('/users-fake-news', 'showFakeNews') -> name('show-fake-news');
        Route::get('/processes-to-dashboard', 'getProcessesToDashboard');
        Route::get('/get-fakeNews-perecentage', 'getFakeNewsPerecentage');
    });

});
