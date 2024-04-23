<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\BorrowingController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Route::get('/', function () {});

Route::post('/auth', [SiteController::class, 'auth']);

Route::get('/login', function() {
    if (Auth::check()) return redirect('/product');
    return view('login');
})->name('login');

Route::get('/logout', function() {
    Auth::logout();
    return redirect('/login');
});

Route::middleware(['auth, admin'])->group(function () {
    // Book CRUD
    Route::get('/admin/books', [BookController::class, 'index']);
    Route::get('/admin/books/create', [BookController::class, 'create']);
    Route::post('/admin/books/store', [BookController::class, 'store']);
    Route::get('/admin/books/{id}/edit', [BookController::class, 'edit']);
    Route::put('/admin/books/{id}/update', [BookController::class, 'update']);
    Route::delete('/admin/books/{id}/delete', [BookController::class, 'destroy']);

    // Borrowing
    Route::get('/admin/borrowings', [BorrowingController::class, 'index']);
    Route::get('/admin/borrowings/create', [BorrowingController::class, 'create']);
    Route::post('/admin/borrowings/store', [BorrowingController::class, 'store']);
    Route::put('/admin/borrowings/{id}/setReturned', [BookController::class, 'setAsReturned']);

    // Post
    Route::get('/admin/posts', [PostController::class, 'index']);
    Route::get('/admin/posts/create', [PostController::class, 'create']);
    Route::post('/admin/posts/add', [PostController::class, 'store']);
    Route::delete('/admin/posts/{id}/delete', [PostController::class, 'destroy']);

    // Review
    Route::get('/admin/reviews/create', [ReviewController::class, 'create']);
    Route::post('/admin/reviews/add', [ReviewController::class, 'store']);
    Route::delete('/admin/reviews/{id}/delete', [ReviewController::class, 'destroy']);
});

Route::middleware(['auth'])->group(function () {
    // Book CRUD
    Route::get('/user/books', [BookController::class, 'index']);

    // Borrowing
    Route::get('/user/borrowings', [BorrowingController::class, 'index']);
    Route::get('/user/borrowings/create', [BorrowingController::class, 'create']);
    Route::post('/user/borrowings/store', [BorrowingController::class, 'store']);
    Route::put('/user/borrowings/{id}/setReturned', [BookController::class, 'setAsReturned']);

    // Post
    Route::get('/user/posts', [PostController::class, 'index']);
    Route::get('/user/posts/create', [PostController::class, 'create']);
    Route::post('/user/posts/add', [PostController::class, 'store']);
    Route::delete('/user/posts/{id}/delete', [PostController::class, 'destroy']);

    // Review
    Route::get('/user/reviews/create', [ReviewController::class, 'create']);
    Route::post('/user/reviews/add', [ReviewController::class, 'store']);
    Route::delete('/user/reviews/{id}/delete', [ReviewController::class, 'destroy']);
});
