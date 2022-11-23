<?php

use App\Http\Controllers\BaggingApiController;
use App\Http\Controllers\ControlPollinationApiController;
use App\Http\Controllers\DataKerosakanApiController;
use App\Http\Controllers\FgvPmpsController;
use App\Http\Controllers\HarvestApiController;
use App\Http\Controllers\KerosakanApiController;
use App\Http\Controllers\PokokApiController;
use App\Http\Controllers\PollenApiController;
use App\Http\Controllers\QualityControlApiController;
use App\Http\Controllers\StokPollenApiController;
use App\Http\Controllers\TandanApiController;
use App\Http\Controllers\TugasanApiController;
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

// Route::get('/tugasan', [FgvPmpsController::class, 'senarai_tugasan']);
Route::post('/tugasan', [FgvPmpsController::class, 'cipta_tugasan']);
Route::get('/tugasan/{id}', [FgvPmpsController::class, 'satu_tugasan']);
Route::get('/tugasan/user/{id}', [FgvPmpsController::class, 'senarai_tugasan_user']);

Route::post('/tugasan/{id}/siap', [FgvPmpsController::class, 'siap']);

Route::post('/tugasan/{id}/sah', [FgvPmpsController::class, 'sah_tugasan']);

Route::post('/tugasan/{id}/rosak', [FgvPmpsController::class, 'rosak']);

Route::apiResources([
    '/pokok' => PokokApiController::class,
    '/tandan' => TandanApiController::class,
    '/tugasan' => TugasanApiController::class,
    '/kerosakan' => KerosakanApiController::class,
    '/pollen' => PollenApiController::class,
    '/stok_pollen' => StokPollenApiController::class,
    '/bagging' => BaggingApiController::class,
    '/control_pollination' => ControlPollinationApiController::class,
    '/quality_control' => QualityControlApiController::class,
    '/harvest' => HarvestApiController::class,
    '/data_kerosakan' => DataKerosakanApiController::class,
]);

Route::get('/tandan/{id_tandan}/pollen', [TandanApiController::class, 'findPollen']);
Route::get('/tandan/{id_tandan}/bagging', [TandanApiController::class, 'findBagging']);
Route::get('/tandan/{id_tandan}/cp', [TandanApiController::class, 'findCp']);
Route::get('/tandan/{id_tandan}/qc', [TandanApiController::class, 'findQc']);
Route::get('/tandan/{id_tandan}/harvest', [TandanApiController::class, 'findHarvest']);

Route::get('/users/peranan/{peranan}', [FgvPmpsController::class, 'userByPeranan']);
Route::post('/search/qc', [FgvPmpsController::class, 'searchQC']);
