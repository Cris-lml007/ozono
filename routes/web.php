<?php

use App\Http\Controllers\DashboardController;
use App\Livewire\Counter;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/count',Counter::class);


// Route::get('/treatments',function(){
//     return view('treatment');
// })->name('treatments');

// Route::get('/home',function(){
//     return view('home');
// });

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')->prefix('/dashboard')->group(function(){
    Route::controller(DashboardController::class)->group(function(){
        Route::get('/','index')->name('dashboard.main');
        Route::get('treatment','treatment')->name('dashboard.treatments');
        Route::get('staff','staff')->name('dashboard.staff');
        Route::get('settings','settings')->name('dashboard.settings');
        Route::get('consultation','consultation')->name('dashboard.consultation');
    });
});
