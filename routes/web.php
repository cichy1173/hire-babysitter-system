<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;




Route::get('/', function () {
    return view('index');
});

//Auth::routes();

Route::post('/logout', [LogoutController::class, 'store'])->name('logout');



Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store']);


Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/advertisement/add', function (){
    return view('advertisements.add');
})->name('add_advert');

Route::post('/advertisement/add', function (){
    dd("...");
})  -> name('add_advert');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/full-calender', [App\Http\Controllers\FullCalenderController::class, 'index'])->name('calendar');

Route::post('/full-calender/action', [App\Http\Controllers\FullCalenderController::class, 'action']);
