<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ActivityController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PhotoController;
use App\Http\Controllers\Admin\VideoController;
use App\Http\Controllers\Admin\MagazineController;
use App\Http\Controllers\Admin\PressController;
use App\Http\Controllers\Admin\CouncilController;
use App\Http\Controllers\Admin\InitiativeController;
use App\Http\Controllers\Admin\AccountController;
use App\Http\Controllers\Admin\MessageController;

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES
|--------------------------------------------------------------------------
*/
Route::get('/', [PublicController::class, 'home'])->name('home');
Route::get('/activities', [PublicController::class, 'activities'])->name('activities');
Route::get('/activities/{id}', [PublicController::class, 'activityShow'])->name('activities.show');
Route::get('/media', [PublicController::class, 'media'])->name('media');
Route::get('/initiatives', [PublicController::class, 'initiatives'])->name('initiatives');
Route::get('/council', [PublicController::class, 'council'])->name('council');
Route::get('/contact', [PublicController::class, 'contact'])->name('contact');
Route::post('/contact', [PublicController::class, 'contactSend'])->name('contact.send');

/*
|--------------------------------------------------------------------------
| AUTH ROUTES
|--------------------------------------------------------------------------
*/
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| ADMIN ROUTES (protected by auth middleware)
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {

    // Dashboard & Search
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/search', [DashboardController::class, 'search'])->name('search');


    // Activities (full CRUD + extras)
    Route::get('/activities', [ActivityController::class, 'index'])->name('activities.index');
    Route::get('/activities/create', [ActivityController::class, 'create'])->name('activities.create');
    Route::post('/activities', [ActivityController::class, 'store'])->name('activities.store');
    Route::get('/activities/{id}', [ActivityController::class, 'show'])->name('activities.show');
    Route::get('/activities/{id}/edit', [ActivityController::class, 'edit'])->name('activities.edit');
    Route::put('/activities/{id}', [ActivityController::class, 'update'])->name('activities.update');
    Route::delete('/activities/{id}', [ActivityController::class, 'destroy'])->name('activities.destroy');
    Route::get('/activities/{id}/report', [ActivityController::class, 'reportForm'])->name('activities.report');
    Route::post('/activities/{id}/report',[ActivityController::class, 'reportStore'])->name('activities.report.store');
    Route::get('/activities/{id}/photos', [ActivityController::class, 'photosForm'])->name('activities.photos');
    Route::post('/activities/{id}/photos',[ActivityController::class, 'photosStore'])->name('activities.photos.store');


    // Content management

    // Press
    Route::get('/press', [PressController::class, 'index'])->name('press');
    Route::get('/press/create', [PressController::class, 'create'])->name('press.create');
    Route::post('/press', [PressController::class, 'store'])->name('press.store');
    Route::get('/press/{id}', [PressController::class, 'show'])->name('press.show');
    Route::get('/press/{id}/edit', [PressController::class, 'edit'])->name('press.edit');
    Route::put('/press/{id}', [PressController::class, 'update'])->name('press.update');
    Route::delete('/press/{id}', [PressController::class, 'destroy'])->name('press.destroy');

    // Council
    Route::get('/council', [CouncilController::class, 'index'])->name('council');
    Route::get('/council/create', [CouncilController::class, 'create'])->name('council.create');
    Route::post('/council', [CouncilController::class, 'store'])->name('council.store');
    Route::get('/council/{id}', [CouncilController::class, 'show'])->name('council.show');
    Route::get('/council/{id}/edit', [CouncilController::class, 'edit'])->name('council.edit');
    Route::put('/council/{id}', [CouncilController::class, 'update'])->name('council.update');
    Route::delete('/council/{id}', [CouncilController::class, 'destroy'])->name('council.destroy');

    // Photos
    Route::get('/photos', [PhotoController::class, 'index'])->name('photos');
    Route::post('/photos', [PhotoController::class, 'store'])->name('photos.store');
    Route::delete('/photos/{id}', [PhotoController::class, 'destroy'])->name('photos.destroy');

    // Initiatives
    Route::get('/initiatives', [InitiativeController::class, 'index'])->name('initiatives');
    Route::get('/initiatives/create', [InitiativeController::class, 'create'])->name('initiatives.create');
    Route::post('/initiatives', [InitiativeController::class, 'store'])->name('initiatives.store');
    Route::get('/initiatives/{id}', [InitiativeController::class, 'show'])->name('initiatives.show');
    Route::get('/initiatives/{id}/edit', [InitiativeController::class, 'edit'])->name('initiatives.edit');
    Route::put('/initiatives/{id}', [InitiativeController::class, 'update'])->name('initiatives.update');
    Route::delete('/initiatives/{id}', [InitiativeController::class, 'destroy'])->name('initiatives.destroy');

    // Videos
    Route::get('/videos', [VideoController::class, 'index'])->name('videos');
    Route::get('/videos/create', [VideoController::class, 'create'])->name('videos.create');
    Route::post('/videos', [VideoController::class, 'store'])->name('videos.store');
    Route::get('/videos/{id}', [VideoController::class, 'show'])->name('videos.show');
    Route::get('/videos/{id}/edit', [VideoController::class, 'edit'])->name('videos.edit');
    Route::put('/videos/{id}', [VideoController::class, 'update'])->name('videos.update');
    Route::delete('/videos/{id}', [VideoController::class, 'destroy'])->name('videos.destroy');

    // Users 
    Route::get('/users', [UserController::class, 'index'])->name('users');
    Route::get('/users/create',    [UserController::class, 'create'])->name('users.create');
    Route::post('/users',          [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{id}',      [UserController::class, 'show'])->name('users.show');
    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{id}',      [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{id}',   [UserController::class, 'destroy'])->name('users.destroy');

    // Magazine
    Route::get('/magazine', [MagazineController::class, 'index'])->name('magazine');
    Route::post('/magazine/generate', [MagazineController::class, 'generate'])->name('magazine.generate');
    Route::get('/magazine/{id}', [MagazineController::class, 'view'])->name('magazine.view');
    Route::get('/magazine/{id}/download', [MagazineController::class, 'download'])->name('magazine.download');

    // Messages 
    Route::get('/messages',      [MessageController::class, 'index'])->name('messages');
    Route::get('/messages/{id}', [MessageController::class, 'show'])->name('messages.show');

    // System
    // Route::get('/watermark', [DashboardController::class, 'watermark'])->name('watermark');
    Route::get('/messages', [DashboardController::class, 'messages'])->name('messages');
    Route::get('/account', [AccountController::class, 'index'])->name('account');
    Route::post('/account/password', [AccountController::class, 'changePassword'])->name('account.password');
});
