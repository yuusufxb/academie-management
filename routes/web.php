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
    Route::get('/activities/programmed', [ActivityController::class, 'programmed'])->name('activities.programmed');
    Route::get('/activities/schedule', [ActivityController::class, 'scheduleForm'])->name('activities.schedule');
    Route::post('/activities/schedule', [ActivityController::class, 'scheduleStore'])->name('activities.schedule.store');
    Route::get('/activities/create', [ActivityController::class, 'create'])->name('activities.create');
    Route::post('/activities', [ActivityController::class, 'store'])->name('activities.store');
    Route::get('/activities/{id}', [ActivityController::class, 'show'])->name('activities.show');
    Route::get('/activities/{id}/edit', [ActivityController::class, 'edit'])->name('activities.edit');
    Route::put('/activities/{id}', [ActivityController::class, 'update'])->name('activities.update');
    Route::delete('/activities/{id}', [ActivityController::class, 'destroy'])->name('activities.destroy');

    // Content management
    Route::get('/press', [PressController::class, 'index'])->name('press');
    Route::get('/council', [CouncilController::class, 'index'])->name('council');
    Route::get('/photos', [PhotoController::class, 'index'])->name('photos');
    Route::get('/initiatives', [InitiativeController::class, 'index'])->name('initiatives');
    Route::get('/videos', [VideoController::class, 'index'])->name('videos');
    Route::get('/users', [UserController::class, 'index'])->name('users');

    // Magazine
    Route::get('/magazine', [MagazineController::class, 'index'])->name('magazine');
    Route::post('/magazine/generate', [MagazineController::class, 'generate'])->name('magazine.generate');
    Route::get('/magazine/{id}', [MagazineController::class, 'view'])->name('magazine.view');
    Route::get('/magazine/{id}/download', [MagazineController::class, 'download'])->name('magazine.download');

    // System
    Route::get('/watermark', [DashboardController::class, 'watermark'])->name('watermark');
    Route::get('/messages', [DashboardController::class, 'messages'])->name('messages');
    Route::get('/account', [AccountController::class, 'index'])->name('account');
    Route::post('/account/password', [AccountController::class, 'changePassword'])->name('account.password');
});
