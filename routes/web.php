<?php

use App\Models\Advertisement;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\OpinionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\AdvertisementController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\User\ShowUserController;
use App\Http\Controllers\UsersAdvertismentController;
use App\Http\Controllers\User\AvailabilityController;
use App\Http\Controllers\User\UserEditProfileController;
use App\Http\Controllers\User\UserEditResetPasswordController;

Auth::routes(['verify' => true]);

Route::post('/logout', [LogoutController::class, 'store'])->name('logout');



Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store']);


Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/', [App\Http\Controllers\HomePageController::class, 'index'])->name('homePage');
Route::post('/{advert}', [App\Http\Controllers\HomePageController::class, 'singleAdvert'])->name('singleAdvert');

Route::get('/advertisement/add', [AdvertisementController::class, 'add'])->middleware('auth')->name('add_advert');
Route::post('/advertisement/add', [AdvertisementController::class, 'store'])->middleware('auth');

Route::get('/advertisement/show', [AdvertisementController::class, 'show'])->middleware('auth')->name('show_advert');
Route::get('/advertisement/getvoivodeships/{id}', [AdvertisementController::class, 'getVoivodeships'])->middleware('auth');
Route::get('/advertisement/getcities/{id}', [AdvertisementController::class, 'getCities'])->middleware('auth');
Route::get('/advertisement/getdistricts/{id}', [AdvertisementController::class, 'getDistricts'])->middleware('auth');
Route::delete('/advertisement/show/{advert}', [AdvertisementController::class, 'delete'])->middleware('auth')->name('delete_advert');
Route::get('/advertisement/{advert}', [AdvertisementController::class, 'showSingle'])->name('showSingle');
Route::get('/advertisement/edit/{advert}', [AdvertisementController::class, 'editShow'])->middleware('auth')->name('edit_advert');
Route::post('/advertisement/edit/{advert}', [AdvertisementController::class, 'editSave'])->middleware('auth');
Route::post('/advertisement/accept/{advert}', [AdvertisementController::class, 'addApplication'])->middleware('auth')->name('addApplication');
Route::get('/advertisements/showApplications', [AdvertisementController::class, 'showApplications'])->middleware('auth')->name('showApplications');
Route::post('/advertisements/accept', [AdvertisementController::class, 'acceptUser'])->middleware('auth')->name('acceptUser');
//show another user profile
Route::get('/profile/{user}', [ShowUserController::class, 'index'])->middleware('auth')->name('showUser');
Route::delete('/profile/{user}', [ShowUserController::class, 'destroy'])->name('showUser.destroy');
//User opinions
Route::get('/profile/{user}/opinions', [OpinionController::class, 'index'])->middleware('auth')->name('userOpinions');
Route::post('/profile/{user}/opinions', [OpinionController::class, 'addOpinion'])->middleware('auth')->name('addOpinion');
Route::put('/profile/editOpinion/{opinion}', [OpinionController::class, 'editOpinion'])->middleware('auth')->name('editOpinion');
Route::delete('profile/deleteOpinion/{opinion}', [OpinionController::class, 'deleteOpinion'])->middleware('auth')->name('deleteOpinion');

//editing user profile
Route::get('/user/edit', [App\Http\Controllers\User\UserEditProfileController::class, 'index'])->name('userEdit');
Route::delete('/user/edit', [App\Http\Controllers\User\UserEditProfileController::class, 'destroy'])->name('userEdit');
Route::post('/user/edit', [UserEditProfileController::class, 'resetPswd'])->name('reset_pswd');

Route::get('/user/edit/description', [App\Http\Controllers\User\UserEditProfileController::class, 'showDescriptionBlade'])->name('showDescriptionBlade');
Route::post('/user/edit/description', [UserEditProfileController::class, 'storeAbout'])->name('addAbout');

Route::get('/user/edit/nickname', [App\Http\Controllers\User\UserEditProfileController::class, 'showNicknameBlade'])->name('showNicknameBlade');
Route::post('/user/edit/nickname', [UserEditProfileController::class, 'storeNickname'])->name('addNickname');

Route::get('/user/edit/accountType', [App\Http\Controllers\User\UserEditProfileController::class, 'showAccountTypeBlade'])->name('showAccountTypeBlade');
Route::post('/user/edit/accountType', [UserEditProfileController::class, 'storeAccountType'])->name('storeAccountType');

Route::get('/user/edit/photo', [App\Http\Controllers\User\UserEditProfileController::class, 'showPhotoBlade'])->name('showPhotoBlade');
Route::post('/user/edit/photo', [UserEditProfileController::class, 'storePhoto'])->name('storePhoto');

//Messages
Route::get('/profile/{user}/messages', [MessageController::class, 'index'])->middleware('auth')->name('messageList');
Route::post('/profile/{user}/messages', [MessageController::class, 'newMessage'])->middleware('auth')->name('newMessage');
Route::get('/messages/getuser/{id}', [MessageController::class, 'getUser'])->middleware('auth');
Route::post('/messages/markread/{id}', [MessageController::class, 'markRead'])->middleware('auth');
Route::get('/messages/badges', [MessageController::class, 'countBadges'])->middleware('auth');


//Administator
Route::prefix('admin')->name('admin.')->middleware('admin')->group(function (){
    Route::resource('/users', UserController::class);
    
});

Route::post('admin/users/{user}/block', [UserController::class, 'block'])->middleware('admin')->name('admin.users.block');
Route::put('admin/users/{user}/unblock', [UserController::class, 'unblock'])->middleware('admin')->name('admin.users.unblock');
Route::put('admin/users/{user}/makeadmin', [UserController::class, 'makeadmin'])->middleware('admin')->name('admin.users.makeadmin');

//Calendar
Route::get('/calendar', [App\Http\Controllers\UsersAdvertisementsController::class, 'index'])->middleware('auth')->name('calendar');
Route::get('/calendarsend', [App\Http\Controllers\UsersAdvertisementsController::class, 'send'])->middleware('auth')->name('calendarsend');
//Search
Route::get('/search', [App\Http\Controllers\SearchController::class, 'index'])->name('search');
//Availability
Route::prefix('availability')->name('availability.')->middleware('auth')->group(function (){
    Route::resource('/availability', AvailabilityController::class);
    
});
