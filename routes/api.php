<<<<<<< HEAD
<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CompanyController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::controller(ProductController::class)->group( function (){
    Route::get('/products', 'get');
    Route::get('/products/category', 'getWithCategory');
    Route::get('/products/{id}', 'details');
    Route::post('/products', 'store');
    Route::patch('/products/{id}', 'update');
    Route::delete('/products/{id}', 'delete');
    Route::get('/products/category/{id}', 'findCategory');
});


Route::controller(CategoryController::class)->group( function (){
    Route::get('/categories', 'get');
    Route::get('/categories/products', 'getWithProducts');
    Route::get('/categories/{id}', 'details');
    Route::post('/categories', 'store');
    Route::patch('/categories/{id}', 'update');
    Route::delete('/categories/{id}', 'delete');
    Route::get('/categories/products/{id}', 'findProducts');
});



Route::controller(CompanyController::class)->group( function (){
    Route::get('/companies', 'get');
    Route::get('/companies/products', 'getWithProducts');
    Route::get('/companies/{id}', 'details');
    Route::post('/companies', 'store');
    Route::patch('/companies/{id}', 'update');
    Route::delete('/companies/{id}', 'delete');
    Route::get('/companies/products/{id}', 'findProducts');
});

