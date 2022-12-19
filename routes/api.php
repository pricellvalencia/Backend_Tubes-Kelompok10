<?php

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

Route::post('register', [App\Http\Controllers\Api\UserController::class, 'register']);
Route::post('login', [App\Http\Controllers\Api\UserController::class, 'login']);
Route::get('user/{id}', [App\Http\Controllers\Api\UserController::class, 'show']);
Route::put('user/{id}', [App\Http\Controllers\Api\UserController::class, 'update']);

Route::get('/email/verify/need-verification', [App\Http\Controllers\VerificationController::class, 'notice'])->name('verification.notice');
Route::get('/email/verify/{id}', [App\Http\Controllers\VerificationController::class, 'verify'])->name('verification.verify');

Route::get('lowongan', [App\Http\Controllers\Api\LowonganController::class, 'index']);
Route::get('lowongan/{id}', [App\Http\Controllers\Api\LowonganController::class, 'show']);
Route::post('lowongan', [App\Http\Controllers\Api\LowonganController::class, 'store']);
Route::put('lowongan/{id}', [App\Http\Controllers\Api\LowonganController::class, 'update']);
Route::delete('lowongan/{id}', [App\Http\Controllers\Api\LowonganController::class, 'destroy']);

Route::get('pelamar', [App\Http\Controllers\Api\PelamarController::class, 'index']);
Route::get('pelamar/{id}', [App\Http\Controllers\Api\PelamarController::class, 'show']);
Route::post('pelamar', [App\Http\Controllers\Api\PelamarController::class, 'store']);
Route::put('pelamar/{id}', [App\Http\Controllers\Api\PelamarController::class, 'update']);
Route::delete('pelamar/{id}', [App\Http\Controllers\Api\PelamarController::class, 'destroy']);

Route::get('kritikSaran', [App\Http\Controllers\Api\KritikSaranController::class, 'index']);
Route::get('kritikSaran/{id}', [App\Http\Controllers\Api\KritikSaranController::class, 'show']);
Route::post('kritikSaran', [App\Http\Controllers\Api\KritikSaranController::class, 'store']);
Route::put('kritikSaran/{id}', [App\Http\Controllers\Api\KritikSaranController::class, 'update']);
Route::delete('kritikSaran/{id}', [App\Http\Controllers\Api\KritikSaranController::class, 'destroy']);
