<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\AdvertisementController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\User\UserEditProfileController;
use App\Http\Controllers\User\UserEditResetPasswordController;
use App\Http\Controllers\CalendarController;


Route::get('/', [App\Http\Controllers\HomePageController::class, 'index'])->name('homePage');

Auth::routes(['verify' => true]);

Route::post('/logout', [LogoutController::class, 'store'])->name('logout');



Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store']);


Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/advertisement/add', [AdvertisementController::class, 'add'])->middleware('auth')->name('add_advert');
Route::post('/advertisement/add', [AdvertisementController::class, 'store'])->middleware('auth');

Route::get('/advertisement/show', [AdvertisementController::class, 'show'])->middleware('auth')->name('show_advert');
Route::get('/advertisement/getvoivodeships/{id}', [AdvertisementController::class, 'getVoivodeships'])->middleware('auth');
Route::get('/advertisement/getcities/{id}', [AdvertisementController::class, 'getCities'])->middleware('auth');
Route::get('/advertisement/getdistricts/{id}', [AdvertisementController::class, 'getDistricts'])->middleware('auth');
Route::delete('/advertisement/show/{advert}', [AdvertisementController::class, 'delete'])->middleware('auth')->name('delete_advert');

//editing user profile
Route::get('/user/edit', [App\Http\Controllers\User\UserEditProfileController::class, 'index'])->name('userEdit');
Route::get('/user/edit/resetpassword', [App\Http\Controllers\User\UserEditResetPasswordController::class, 'index'])->name('reset_password');
Route::delete('/user/edit', [App\Http\Controllers\User\UserEditProfileController::class, 'destroy'])->name('userEdit');

//calendar
Route::get('/calendar', [App\Http\Controllers\CalendarController::class, 'index'])->name('calendar');
