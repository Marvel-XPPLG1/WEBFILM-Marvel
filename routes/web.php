<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    AuthController,
    FilmController,
    CastController,
    GenreController,
    PeranController,
    KritikController,
    ProfileController,
    UserController,
};

// ===== Publik (dashboard & list film) =====
Route::get('/', [FilmController::class, 'movieHome'])->name('home');
Route::get('/movies', [FilmController::class, 'movies'])->name('movies');
Route::get('/movies/genre/{genre}', [FilmController::class, 'moviesByGenre'])->name('genre');
Route::get('/movies/{film}', [FilmController::class, 'show'])->name('movies.show');

// ===== Auth =====
Route::get('/login', fn () => redirect()->route('home')->with('error', 'Silakan login terlebih dahulu.'))->name('login');
Route::middleware('guest')->group(function () {
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
});
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

// ===== Semua user yang login: profile sendiri =====
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // Komentar/kritik (admin ditolak di controller)
    Route::post('/movies/{film}/kritik', [KritikController::class, 'store'])->name('kritik.store');
});

// ===== Khusus Administrator =====
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('films', FilmController::class)->except('show');
    Route::resource('casts', CastController::class)->except('show');
    Route::resource('genres', GenreController::class)->except('show');
    Route::resource('perans', PeranController::class)->except('show');
    Route::get('users', [UserController::class, 'index'])->name('users.index');
});
