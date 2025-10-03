<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MangaController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FrontendReviewController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FrontendFavoriteController;


// ======================
// 🔹 FRONTEND ROUTES (Public)
// ======================
Route::get('/', [HomeController::class, 'index'])->name('frontend.home');
Route::get('/mangalist', [MangaController::class, 'frontendList'])->name('frontend.mangalist');
Route::get('/manga/detail/{id}', [MangaController::class, 'detail'])->name('manga.detail');
Route::get('/manga/search', [MangaController::class, 'search'])->name('frontend.search');

// Public manga adding (if you want this accessible to everyone)
Route::get('/manga/adding', [MangaController::class, 'adding'])->name('manga.adding');
Route::post('/manga', [MangaController::class, 'create'])->name('manga.create');

Route::delete('/manga/review/{id}', [FrontendReviewController::class, 'remove'])
    ->name('frontend.reviews.remove');
// Review (Frontend)
Route::get('/manga/review/{id}/edit', [FrontendReviewController::class, 'edit'])
    ->name('frontend.reviews.edit');

Route::put('/manga/review/{id}', [FrontendReviewController::class, 'update'])
    ->name('frontend.reviews.update');



// ======================
// 🔹 AUTH ROUTES (Guest Only)
// ======================
Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.store');

    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');   // 👈 สำคัญ
    Route::post('/login', [AuthController::class, 'login'])->name('login.attempt');
});



// Logout route (for authenticated users only)
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// ======================
// 🔹 AUTHENTICATED USER ROUTES
// ======================
Route::middleware('auth')->group(function () {
    // Reviews (authenticated users only)
    Route::post('/manga/{id}/review', [FrontendReviewController::class, 'store'])->name('frontend.reviews.store');

    // Favorites (authenticated users only)
    Route::get('/my-favorites', [FavoriteController::class, 'myFavorites'])->name('favorites.my');
    Route::post('/favorites/toggle/{manga_id}', [FavoriteController::class, 'toggle'])->name('favorites.toggle');
    Route::post('/manga/{id}/favorite', [FrontendFavoriteController::class, 'toggle'])
        ->name('frontend.favorites.toggle');
    Route::delete('/favorites/{id}', [FrontendFavoriteController::class, 'remove'])
        ->name('frontend.favorites.remove');
});

// ======================
// 🔹 ADMIN ROUTES (Admin Only)
// ======================
Route::middleware(['auth', \App\Http\Middleware\AdminMiddleware::class])
    ->prefix('admin')
    ->group(function () {
        // Dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

        // Manga Management
        Route::get('/manga', [MangaController::class, 'index'])->name('admin.manga.list');
        Route::get('/manga/adding', [MangaController::class, 'adding'])->name('admin.manga.adding');
        Route::post('/manga', [MangaController::class, 'create'])->name('admin.manga.create');
        Route::get('/manga/{id}/edit', [MangaController::class, 'edit'])->name('admin.manga.edit');
        Route::put('/manga/{id}', [MangaController::class, 'update'])->name('admin.manga.update');
        Route::delete('/manga/{id}', [MangaController::class, 'remove'])->name('admin.manga.remove');

        // Users Management
        Route::get('/users', [UserController::class, 'index'])->name('admin.users.list');         // list users
        Route::get('/users/adding', [UserController::class, 'adding'])->name('admin.users.adding'); // show add form
        Route::post('/users', [UserController::class, 'create'])->name('admin.users.create');     // insert user
        Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('admin.users.edit'); // show edit form
        Route::put('/users/{id}', [UserController::class, 'update'])->name('admin.users.update');  // update user
        Route::delete('/users/{id}', [UserController::class, 'remove'])->name('admin.users.remove'); // delete user


        // Reviews Management
        Route::get('/reviews', [ReviewController::class, 'index'])->name('admin.reviews.list');
        Route::get('/reviews/adding', [ReviewController::class, 'adding'])->name('admin.reviews.adding');
        Route::post('/reviews', [ReviewController::class, 'create'])->name('admin.reviews.create');
        Route::get('/reviews/{id}/edit', [ReviewController::class, 'edit'])->name('admin.reviews.edit');
        Route::put('/reviews/{id}', [ReviewController::class, 'update'])->name('admin.reviews.update');
        Route::delete('/reviews/{id}', [ReviewController::class, 'remove'])->name('admin.reviews.remove');

        // Favorites Management
        Route::get('/favorites', [FavoriteController::class, 'index'])->name('admin.favorites.list');
        Route::get('/favorites/adding', [FavoriteController::class, 'adding'])->name('admin.favorites.adding');
        Route::post('/favorites', [FavoriteController::class, 'create'])->name('admin.favorites.create');
        Route::get('/favorites/{id}/edit', [FavoriteController::class, 'edit'])->name('admin.favorites.edit');
        Route::put('/favorites/{id}', [FavoriteController::class, 'update'])->name('admin.favorites.update');
        Route::delete('/favorites/{id}', [FavoriteController::class, 'remove'])->name('admin.favorites.remove');
    });


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
});