<?php

use App\Http\Controllers\AuditController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KerosakanController;
use App\Http\Controllers\PokokController;
use App\Http\Controllers\TandanController;
use App\Http\Controllers\TugasanController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Auth::routes();
// ['register' => false]
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [HomeController::class, 'index'])->name('laman');
    Route::get('', [HomeController::class, 'index']);

    Route::prefix('/pengurusan_pengguna')->group(function () {
        Route::get('/index', [UserController::class, 'index'])->name('pp.index');
        Route::get('/create', [UserController::class, 'create'])->name('pp.create');
        Route::post('/store', [UserController::class, 'store'])->name('pp.store');
        Route::get('/edit/{user}', [UserController::class, 'edit'])->name('pp.edit');
        Route::put('/update/{user}', [UserController::class, 'update'])->name('pp.update');
        Route::delete('/delete/{user}', [UserController::class, 'delete'])->name('pp.delete');
        Route::post('/kemaskini_password/{user}', [UserController::class, 'kemaskini_password'])->name('pp.updatePwd');

        Route::resource('/tugasan', TugasanController::class);

    });

    Route::get('audit', [AuditController::class, 'index'])->name('audit');

    Route::prefix('/pengurusan-pokok-induk')->group(function () {

        Route::prefix('/pokok')->group(function () {
            Route::get('/index', [PokokController::class, 'index'])->name('pi.p.index');
            Route::get('/create', [PokokController::class, 'create'])->name('pi.p.create');
            Route::get('/edit/{pokok}', [PokokController::class, 'edit'])->name('pi.p.edit');
            Route::post('/store', [PokokController::class, 'store'])->name('pi.p.store');
            Route::put('/update/{pokok}', [PokokController::class, 'update'])->name('pi.p.update');
            Route::delete('/delete/{pokok}', [PokokController::class, 'delete'])->name('pi.p.delete');

        });

        Route::prefix('/tandan')->group(function () {
            Route::get('/index', [TandanController::class, 'index'])->name('pi.t.index');
            Route::get('/create', [TandanController::class, 'create'])->name('pi.t.create');
            Route::post('/store', [TandanController::class, 'store'])->name('pi.t.store');
            Route::get('/edit/{tandan}', [TandanController::class, 'edit'])->name('pi.t.edit');
            Route::put('/update/{tandan}', [TandanController::class, 'update'])->name('pi.t.update');
            Route::delete('/delete/{tandan}', [TandanController::class, 'delete'])->name('pi.t.delete');
            // Route::get('/muat-naik', [TandanController::class, 'MuatNaikDokumenTandan'])->name('pi.t.muat');

            Route::get('downloadqr/{tandan}', [TandanController::class, 'downloadqr'])->name('downloadqr');
        });

    });

    Route::prefix('/konfigurasi')->group(function () {
        Route::get('/kerosakan', [KerosakanController::class, 'index'])->name('k.index');
        Route::post('/kerosakan', [KerosakanController::class, 'store'])->name('k.store');
        Route::put('/kerosakan/{kerosakan}', [KerosakanController::class, 'update'])->name('k.update');
        Route::delete('/kerosakan/{kerosakan}', [KerosakanController::class, 'delete'])->name('k.delete');
    });

});
