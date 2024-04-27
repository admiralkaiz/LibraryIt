<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\BorrowingController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use PhpParser\Node\Expr\FuncCall;

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

Route::get('/', function () {
    return view('landing_page');
});

Route::post('/auth', [SiteController::class, 'auth']);

Route::get('/register', function () {
    return view('register');
});

Route::post('/registerUser', [UserController::class, 'registerUser']);

Route::get('/login', function() {
    if (Auth::check()) return redirect('/product');
    return view('login');
})->name('login');

Route::get('/logout', function() {
    Auth::logout();
    return redirect('/');
});

Route::middleware(['auth'])->group(function () {
    Route::middleware(['admin'])->group(function () {
        Route::get('/admin/books', [BookController::class, 'index']);
        Route::get('/admin/books/create', [BookController::class, 'create']);
        Route::post('/admin/books/store', [BookController::class, 'store']);
        Route::get('/admin/books/{id}', [BookController::class, 'show']);
        Route::get('/admin/books/{id}/edit', [BookController::class, 'edit']);
        Route::put('/admin/books/{id}/update', [BookController::class, 'update']);
        Route::delete('/admin/books/{id}/delete', [BookController::class, 'destroy']);

        // Borrowing
        Route::get('/admin/borrowings', [BorrowingController::class, 'index']);
        Route::get('/admin/borrowings/create', [BorrowingController::class, 'create']);
        Route::post('/admin/borrowings/store', [BorrowingController::class, 'store']);
        Route::put('/admin/borrowings/{id}/setReturned', [BorrowingController::class, 'setAsReturned']);

        // Post
        Route::get('/admin/posts', [PostController::class, 'index']);
        Route::post('/admin/posts/add', [PostController::class, 'store']);
        Route::delete('/admin/posts/{id}/delete', [PostController::class, 'destroy']);

        // Review
        Route::post('/admin/reviews/add', [ReviewController::class, 'store']);
        Route::delete('/admin/reviews/{id}/delete', [ReviewController::class, 'destroy']);
    });

    // Book CRUD
    Route::get('/user/books', [BookController::class, 'index']);
    Route::get('/user/books/{id}', [BookController::class, 'show']);

    // Borrowing
    Route::get('/user/borrowings', [BorrowingController::class, 'index']);

    // Post
    Route::get('/user/posts', [PostController::class, 'index']);
    Route::post('/user/posts/add', [PostController::class, 'store']);
    Route::delete('/user/posts/{id}/delete', [PostController::class, 'destroy']);

    // Review
    Route::post('/user/reviews/add', [ReviewController::class, 'store']);
    Route::delete('/user/reviews/{id}/delete', [ReviewController::class, 'destroy']);
});
