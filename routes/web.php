<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DogController;

use App\Http\Controllers\AdoptionDogController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\ParkController;
use App\Http\Controllers\VeterinaryCenterController;


Route::middleware('auth')->group(function () {
    // ... l-routes li kaynin
    Route::resource('dogs', DogController::class);
});

Route::get('/', fn () => redirect()->route('dashboard'));

Route::middleware('guest')->group(function () {
    Route::get('/login',    [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login',   [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register',[AuthController::class, 'register']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', DashboardController::class)->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
        Route::resource('users', UserController::class)->except('show');
        Route::resource('parks', ParkController::class)->except(['index', 'show']);
        Route::resource('veterinary-centers', VeterinaryCenterController::class)->except(['index', 'show']);
    });


    Route::resource('adoption-dogs', AdoptionDogController::class)->except(['index', 'show']);
    Route::resource('events', EventController::class)->except(['index', 'show']);

    Route::get('/favorites', [FavoriteController::class, 'index'])->name('favorites.index');

    Route::post('/interact/{type}/{id}/like',     [LikeController::class, 'toggle'])->name('likes.toggle');
    Route::post('/interact/{type}/{id}/favorite', [FavoriteController::class, 'toggle'])->name('favorites.toggle');
    Route::post('/interact/{type}/{id}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::delete('/comments/{comment}',          [CommentController::class, 'destroy'])->name('comments.destroy');

});


Route::resource('adoption-dogs', AdoptionDogController::class)->only(['index', 'show']);
Route::resource('events', EventController::class)->only(['index', 'show']);
Route::resource('parks', ParkController::class)->only(['index', 'show']);
Route::resource('veterinary-centers', VeterinaryCenterController::class)->only(['index', 'show']);