<?php

use App\Livewire\Counter;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/count',Counter::class);
Route::get('/treatments',function(){
    return view('treatment');
})->name('treatments');

// Route::get('/home',function(){
//     return view('home');
// });

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
