<?php

use App\Http\Controllers\FgvPmpsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/profil', [FgvPmpsController::class, 'profil']);

Route::get('/tugasan', [FgvPmpsController::class, 'senarai_tugasan']);
Route::post('/tugasan', [FgvPmpsController::class, 'cipta_tugasan']);
Route::get('/tugasan/{id}', [FgvPmpsController::class, 'satu_tugasan']);
Route::get('/tugasan/user/{id}', [FgvPmpsController::class, 'senarai_tugasan_user']);

// Route::post('/tugasan/{id}/siap-balut', [FgvPmpsController::class, 'siap_balut']);
// Route::post('/tugasan/{id}/siap-debung', [FgvPmpsController::class, 'siap_debung']);
// Route::post('/tugasan/{id}/siap-kawalan', [FgvPmpsController::class, 'siap_kawalan']);
// Route::post('/tugasan/{id}/siap-tuai', [FgvPmpsController::class, 'siap_tuai']);

Route::post('/tugasan/{id}/siap', [FgvPmpsController::class, 'siap']);

Route::put('/tugasan/{id}/sah', [FgvPmpsController::class, 'sah_tugasan']);

Route::post('/rosak', [FgvPmpsController::class, 'lapor_rosak']);
