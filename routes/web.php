<?php

use App\Http\Controllers\AdministratorController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ModeratorController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserProgressController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\VideoController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Route to fetch ratings by video ID
Route::get('/ratings/video/{videoId}', [RatingController::class, 'getRatingsByVideo']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// User Routes
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/users', [UserController::class, 'index']);
    Route::post('/users', [UserController::class, 'store']);
    Route::get('/users/{id}', [UserController::class, 'show']);
    Route::put('/users/{id}', [UserController::class, 'update']);
    Route::delete('/users/{id}', [UserController::class, 'destroy']);
});

// User Progress Routes
Route::middleware('auth')->group(function () {
    Route::get('/user-progress', [UserProgressController::class, 'index']);
    Route::post('/user-progress', [UserProgressController::class, 'store']);
    Route::get('/user-progress/{id}', [UserProgressController::class, 'show']);
    Route::put('/user-progress/{id}', [UserProgressController::class, 'update']);
    Route::delete('/user-progress/{id}', [UserProgressController::class, 'destroy']);
});



// Video Routes
Route::middleware(['auth', 'moderator.admin'])->group(function () {
    Route::post('/videos', [VideoController::class, 'store']);
    Route::put('/videos/{id}', [VideoController::class, 'update']);
    Route::delete('/videos/{id}', [VideoController::class, 'destroy']);
});

// Regular user can view videos
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/videos', [VideoController::class, 'index']);
    Route::get('/videos/{id}', [VideoController::class, 'show']);
});

// Comment Routes
Route::middleware(['auth', 'role:user,moderator'])->group(function () {
    Route::get('/comments', [CommentController::class, 'index']);
    Route::post('/comments', [CommentController::class, 'store']);
    Route::get('/comments/{id}', [CommentController::class, 'show']);
    Route::put('/comments/{id}', [CommentController::class, 'update']);
    Route::delete('/comments/{id}', [CommentController::class, 'destroy']);
});

// Ratings Routes
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::post('/ratings', [RatingController::class, 'store'])->name('ratings.store');
    Route::put('/ratings/{id}', [RatingController::class, 'update'])->name('ratings.update');
    Route::get('/ratings/user/{userId}', [RatingController::class, 'getRatingsByUser']);
    Route::get('/ratings/video/{videoId}', [RatingController::class, 'getRatingsByVideo']);
});


// Moderator Routes
Route::middleware(['auth', 'role:moderator,admin'])->group(function () {
    Route::get('/moderators', [ModeratorController::class, 'index']);
    Route::post('/moderators', [ModeratorController::class, 'store']);
    Route::get('/moderators/{id}', [ModeratorController::class, 'show']);
    Route::put('/moderators/{id}', [ModeratorController::class, 'update']);
    Route::delete('/moderators/{id}', [ModeratorController::class, 'destroy']);
});

// Administrator Routes
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/administrators', [AdministratorController::class, 'index']);
    Route::post('/administrators', [AdministratorController::class, 'store']);
    Route::get('/administrators/{id}', [AdministratorController::class, 'show']);
    Route::put('/administrators/{id}', [AdministratorController::class, 'update']);
    Route::delete('/administrators/{id}', [AdministratorController::class, 'destroy']);
});
