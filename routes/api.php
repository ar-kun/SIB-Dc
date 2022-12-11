<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Wisata\WisataController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::post('register', [RegisterController::class, 'register']);
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LogoutController::class, 'logout']);

Route::get('user', [UserController::class, 'index']);

Route::post('new-wisata', [WisataController::class, 'store'])->middleware('auth:api');
Route::patch('update-wisata/{wisata}', [WisataController::class, 'update'])->middleware('auth:api');
Route::delete('delete-wisata/{wisata}', [WisataController::class, 'destroy'])->middleware('auth:api');

Route::get('wisata/{wisata}', [WisataController::class, 'show']);
Route::get('wisata', [WisataController::class, 'index']);