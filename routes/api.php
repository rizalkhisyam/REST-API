<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Http\Request;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('post')->group(function () {
    Route::post('create', [ProfileController::class, 'store']);
    Route::get('show', [ProfileController::class, 'show']);
    Route::get('{profile:id}/edit', [ProfileController::class, 'edit']);
    Route::put('{profile:id}/edit', [ProfileController::class, 'update']);
    Route::delete('{profile:id}/delete', [ProfileController::class, 'delete']);
    Route::get('show-all-data', [ProfileController::class, 'showAll']);
    Route::get('get-by-id/{profile:id}', [ProfileController::class, 'findOne']);
    Route::post('create-many', [ProfileController::class, 'bulkInsert']);
});
