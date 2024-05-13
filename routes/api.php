<?php

use App\Http\Controllers\Api\AuthAPI;
use App\Http\Controllers\Api\BookAPI;
use App\Http\Controllers\Api\BorrowingAPI;
use App\Http\Controllers\Api\PostAPI;
use App\Http\Controllers\Api\ReviewAPI;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', [AuthAPI::class, 'registerUser']);
Route::post('/login', [AuthAPI::class, 'loginUser']);

Route::middleware('auth:sanctum')->group(function() {
    Route::resource('/books', BookAPI::class);
    Route::resource('/borrowings', BorrowingAPI::class);
    Route::resource('/posts', PostAPI::class);
    Route::resource('/reviews', ReviewAPI::class);
});