<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GrupUserController;
use App\Http\Controllers\GuideController;
use App\Http\Controllers\KomentarController;
use App\Http\Controllers\MandaysController;
use App\Http\Controllers\MasterUserController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProyekController;
use App\Http\Controllers\RouteGroupController;
use App\Http\Controllers\RouteItemController;
use App\Http\Controllers\TemporaryImageController;
use App\Http\Controllers\TiketController;
use App\Http\Controllers\TiketUserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (Auth::check()) {
        return redirect('/dashboard');
    }
    return redirect('/login');
});

Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'login')->name('login');
    Route::post('/login', 'actionLogin')->name('actionLogin');
    Route::post('/logout', 'logout')->name('logout');
    Route::get('/change-password', 'update')->name('updatePassword');
    Route::post('/change-password', 'changePassword')->name('changePassword');
});

Route::resource('auth', AuthController::class);

Route::group(['middleware' => ['auth']], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/guide', [GuideController::class, 'index'])->name('guide');
    Route::resource('masterUser', MasterUserController::class)->only('index', 'show', 'store', 'update', 'destroy');
    Route::resource('grup-user', GrupUserController::class)->only('index', 'store', 'update', 'destroy');
    Route::resource('route', RouteGroupController::class)->only('index', 'store', 'update', 'destroy');
    Route::resource('route.item', RouteItemController::class)->only('index', 'store', 'update', 'destroy');
    Route::resource('menu', MenuController::class)->only('index', 'store', 'update', 'destroy');
    Route::resource('permission', PermissionController::class)->only('index', 'store', 'update', 'destroy');

    Route::resource('proyek', ProyekController::class)->only('index', 'store', 'update', 'destroy');
    Route::resource('mandays', MandaysController::class)->only('index', 'store', 'update', 'destroy');
    Route::resource('tiket', TiketController::class);
    Route::get('/create-tiket', [TiketController::class, 'user_create'])->name('userTiket.create');

    Route::resource('komentar', KomentarController::class)->only('show', 'store', 'destroy');

    Route::controller(TemporaryImageController::class)->group(function () {
        Route::post('/upload', 'store')->name('image.store');
        Route::delete('/delete', 'destroy')->name('image.destroy');
    });
});

Route::resource('tiket-user', TiketUserController::class)->only('index', 'update');