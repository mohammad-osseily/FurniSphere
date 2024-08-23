<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/

Route::group(['prefix' => 'auth'], function () {
    Route::post('/register', [AuthController::class, 'register']); // User Registration
    Route::post('/login', [AuthController::class, 'login']);       // User Login
    Route::post('/logout', [AuthController::class, 'logout']);     // User Logout
    Route::post('/refresh', [AuthController::class, 'refresh']);   // Refresh Token
});

/*
|--------------------------------------------------------------------------
| User Routes
|--------------------------------------------------------------------------
*/

Route::group(['middleware' => 'auth:api'], function () {
    Route::get('/user/profile', [UserController::class, 'profile']);              // Get User Profile
    Route::post('/user/profile/update', [UserController::class, 'updateProfile']); // Update User Profile
});

/*
|--------------------------------------------------------------------------
| Product Routes
|--------------------------------------------------------------------------
*/

Route::get('/products', [ProductController::class, 'index']);                // List All Products
Route::get('/products/{id}', [ProductController::class, 'show']);            // Show Single Product

Route::group(['middleware' => 'auth:api'], function () {
    Route::post('/products/create', [ProductController::class, 'store']);            // Create Product (Admin Only)
    Route::post('/products/{id}/update', [ProductController::class, 'update']);      // Update Product (Admin Only)
    Route::post('/products/{id}/delete', [ProductController::class, 'destroy']);     // Delete Product (Admin Only)
});

/*
|--------------------------------------------------------------------------
| Category Routes
|--------------------------------------------------------------------------
*/

Route::get('/categories', [CategoryController::class, 'index']);               // List All Categories
Route::get('/categories/{id}', [CategoryController::class, 'show']);           // Show Single Category

Route::group(['middleware' => 'auth:api'], function () {
    Route::post('/categories/create', [CategoryController::class, 'store']);            // Create Category (Admin Only)
    Route::post('/categories/{id}/update', [CategoryController::class, 'update']);      // Update Category (Admin Only)
    Route::post('/categories/{id}/delete', [CategoryController::class, 'destroy']);     // Delete Category (Admin Only)
});

/*
|--------------------------------------------------------------------------
| Order Routes
|--------------------------------------------------------------------------
*/

Route::group(['middleware' => 'auth:api'], function () {
    Route::get('/orders', [OrderController::class, 'index']);                        // List All Orders (Admin Only)
    Route::get('/orders/{id}', [OrderController::class, 'show']);                    // Show Single Order
    Route::post('/orders/create', [OrderController::class, 'store']);                // Create New Order
    Route::post('/orders/{id}/update', [OrderController::class, 'update']);          // Update Order Status (Admin Only)
    Route::post('/orders/{id}/delete', [OrderController::class, 'destroy']);         // Delete Order (Admin Only)
});
