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

Route::post('/login', [FgvPmpsController::class, 'login']);
Route::get('/profil/{user}', [FgvPmpsController::class, 'profil']);

Route::get('/tugasan', [FgvPmpsController::class, 'senarai_tugasan']);
Route::post('/tugasan', [FgvPmpsController::class, 'cipta_tugasan']);
Route::get('/tugasan/{id}', [FgvPmpsController::class, 'satu_tugasan']);
Route::get('/tugasan/user/{id}', [FgvPmpsController::class, 'senarai_tugasan_user']);

Route::post('/tugasan/{id}/siap', [FgvPmpsController::class, 'siap']);

Route::post('/tugasan/{id}/sah', [FgvPmpsController::class, 'sah_tugasan']);

Route::post('/tugasan/{id}/rosak', [FgvPmpsController::class, 'rosak']);

Route::get('/tandan/{tandan}', [FgvPmpsController::class, 'satu_tandan']);
