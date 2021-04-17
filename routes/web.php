<?php

use App\Http\Controllers\ProfileController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('post')->group(function () {
    Route::post('create', [ProfileController::class, 'store'])->name('post.create');
    Route::get('show', [ProfileController::class, 'index'])->name('post.show');
    Route::get('{profile:id}/edit', [ProfileController::class, 'edit'])->name('post.edit');
});
