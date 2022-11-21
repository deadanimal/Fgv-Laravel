<?php

use App\Http\Controllers\AuditController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KerosakanController;
use App\Http\Controllers\LaporanController;
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
Route::get('/temp', [HomeController::class, 'temp']);

// Route::get('/test', [Homecontroller::class, 'test']);

Auth::routes();
// ['register' => false]
Route::middleware('auth.basic')->group(function () {

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
        Route::post('/tugasan/search', [TugasanController::class, 'search'])->name('search.tugasan');
    });

    Route::get('/tugasan', [TugasanController::class, 'tugasan_user'])->name('tu');

    Route::get('/audit', [AuditController::class, 'index'])->name('audit');
    Route::post('/search/audit', [AuditController::class, 'search'])->name('search.audit');

    Route::prefix('/pengurusan-pokok-induk')->group(function () {

        Route::prefix('/pokok')->group(function () {
            Route::get('/index', [PokokController::class, 'index'])->name('pi.p.index');
            Route::get('/create', [PokokController::class, 'create'])->name('pi.p.create');
            Route::get('/edit/{pokok}', [PokokController::class, 'edit'])->name('pi.p.edit');
            Route::post('/store', [PokokController::class, 'store'])->name('pi.p.store');
            Route::put('/update/{pokok}', [PokokController::class, 'update'])->name('pi.p.update');
            Route::delete('/delete/{pokok}', [PokokController::class, 'delete'])->name('pi.p.delete');
            Route::get('downloadqrpokok/{pokok}', [PokokController::class, 'downloadqr'])->name('downloadqrpokok');
            Route::post('/pokok/search', [PokokController::class, 'search'])->name('search.pokok');
            Route::get('/bulkqr', [PokokController::class, 'bulkqr'])->name('pokok.bulkqr');
        });

        Route::prefix('/tandan')->group(function () {
            Route::get('/index', [TandanController::class, 'index'])->name('pi.t.index');
            Route::get('/create', [TandanController::class, 'create'])->name('pi.t.create');
            Route::post('/store', [TandanController::class, 'store'])->name('pi.t.store');
            Route::get('/edit/{tandan}', [TandanController::class, 'edit'])->name('pi.t.edit');
            Route::put('/update/{tandan}', [TandanController::class, 'update'])->name('pi.t.update');
            Route::delete('/delete/{tandan}', [TandanController::class, 'delete'])->name('pi.t.delete');
            // Route::get('/muat-naik', [TandanController::class, 'MuatNaikDokumenTandan'])->name('pi.t.muat');

            Route::get('/downloadqrtandan/{tandan}', [TandanController::class, 'downloadqr'])->name('downloadqrtandan');
            Route::post('/generateQR', [TandanController::class, 'generateQR'])->name('generateQR');
            Route::post('/downloadmanyQR', [TandanController::class, 'downloadmanyQR'])->name('downloadmanyQR');
            Route::post('/tandan/search', [TandanController::class, 'search'])->name('search.tandan');

        });

    });

    Route::prefix('/laporan')->as('laporan.')->group(function () {
        Route::get('/motherpalm/index', [LaporanController::class, 'motherpalm'])->name('motherpalm');
        Route::post('/motherpalm/store', [LaporanController::class, 'motherpalmStore'])->name('motherpalmStore');

        Route::get('/fatherpalm/index', [LaporanController::class, 'fatherpalm'])->name('fatherpalm');
        Route::post('/fatherpalm/store', [LaporanController::class, 'fatherpalmStore'])->name('fatherpalmStore');
    });

    Route::prefix('/konfigurasi')->group(function () {
        Route::get('/kerosakan', [KerosakanController::class, 'index'])->name('k.index');
        Route::post('/kerosakan', [KerosakanController::class, 'store'])->name('k.store');
        Route::put('/kerosakan/{kerosakan}', [KerosakanController::class, 'update'])->name('k.update');
        Route::delete('/kerosakan/{kerosakan}', [KerosakanController::class, 'delete'])->name('k.delete');
    });

});
