<<<<<<< HEAD
<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReviewController;
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::controller(AuthorController::class)->group( function (){
    Route::get('/authors', 'get');
    Route::get('/authors/book', 'getWithBooks');
    Route::get('/authors/{id}', 'details');
    Route::post('/authors', 'store');
    Route::patch('/authors/{id}', 'update');
    Route::delete('/authors/{id}', 'delete');
    Route::get('/authors/book/{id}', 'findBooks');
});

Route::controller(BookController::class)->group( function (){
    Route::get('/books', 'get');
    Route::get('/books/everything', 'getWithEverything');
    Route::get('/books/{id}', 'details');
    Route::post('/books', 'store');
    Route::patch('/books/{id}', 'update');
    Route::delete('/books/{id}', 'delete');
    Route::get('/books/reviews/{id}', 'findReviews');
});

Route::controller(GenreController::class)->group( function (){
    Route::get('/genres', 'get');
    Route::get('/genres/books', 'getWithBooks');
    Route::get('/genres/{id}', 'details');
    Route::post('/genres', 'store');
    Route::patch('/genres/{id}', 'update');
    Route::delete('/genres/{id}', 'delete');
    Route::get('/genres/books/{id}', 'findBooks');
});

Route::controller(UserController::class)->group( function (){
    Route::get('/users', 'get');
    Route::get('/users/{id}', 'details');
    Route::post('/users', 'store');
    Route::patch('/users/{id}', 'update');
    Route::delete('/users/{id}', 'delete');
    Route::get('/users/reviews/{id}', 'findReviews');
});

Route::controller(ReviewController::class)->group( function (){
    Route::get('/reviews', 'get');
    Route::get('/reviews/{id}', 'details');
    Route::post('/reviews', 'store');
    Route::patch('/reviews/{id}', 'update');
    Route::delete('/reviews/{id}', 'delete');
});

