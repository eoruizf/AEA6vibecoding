
<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DogController;
use App\Http\Controllers\AdoptionDogController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\ParkController;
use App\Http\Controllers\VeterinaryCenterController;


// Home pública
Route::view('/', 'home')->name('home');


// Rutes per a visitants no autenticats
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});


// Rutes per a usuaris autenticats
Route::middleware('auth')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Dashboard
    Route::get('/dashboard', DashboardController::class)->name('dashboard');

    // Perfil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // Gestió dels gossos de l'usuari
    Route::resource('dogs', DogController::class);

    // Gestió d'adopcions
    Route::resource('adoption-dogs', AdoptionDogController::class)
        ->except(['index', 'show']);

    // Gestió d'esdeveniments
    Route::resource('events', EventController::class)
        ->except(['index', 'show']);

    // Favorits
    Route::get('/favorites', [FavoriteController::class, 'index'])
        ->name('favorites.index');

    Route::post('/interact/{type}/{id}/like', [LikeController::class, 'toggle'])
        ->name('likes.toggle');

    Route::post('/interact/{type}/{id}/favorite', [FavoriteController::class, 'toggle'])
        ->name('favorites.toggle');

    Route::post('/interact/{type}/{id}/comments', [CommentController::class, 'store'])
        ->name('comments.store');

    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])
        ->name('comments.destroy');

    // Administració
    Route::middleware('admin')
        ->prefix('admin')
        ->name('admin.')
        ->group(function () {
            Route::resource('users', UserController::class)->except('show');
            Route::resource('parks', ParkController::class)->except(['index', 'show']);
            Route::resource('veterinary-centers', VeterinaryCenterController::class)
                ->except(['index', 'show']);
        });
});


// Rutes públiques d'adopcions
Route::resource('adoption-dogs', AdoptionDogController::class)
    ->only(['index', 'show']);

// Rutes públiques d'esdeveniments
Route::resource('events', EventController::class)
    ->only(['index', 'show']);

// Rutes públiques de parcs
Route::resource('parks', ParkController::class)
    ->only(['index', 'show']);

// Rutes públiques de centres veterinaris
Route::resource('veterinary-centers', VeterinaryCenterController::class)
    ->only(['index', 'show']);
