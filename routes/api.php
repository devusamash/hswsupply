<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

#Customer
Route::post('create-customer', [CustomerController::class, 'createCustomer']);
Route::post('update-customer/{id}', [CustomerController::class, 'update']);
Route::get('get-customers', [CustomerController::class, 'show']);
Route::get('get-customer/{id}', [CustomerController::class, 'showSingle']);
Route::get('delete-customer/{id}', [CustomerController::class, 'destroy']);

#Order
Route::post('create-order', [OrderController::class, 'createOrder']);
Route::get('delete-order/{id}', [OrderController::class, 'destroy']);
Route::get('get-order/{id}', [OrderController::class, 'showSingle']);
Route::get('get-orders', [OrderController::class, 'show']);
Route::get('get-orders/customer/{id}', [OrderController::class, 'showCustomerOrders']);

#Category
Route::post('create-category', [CategoryController::class, 'createCategory']);
Route::post('delete-category/{id}', [CategoryController::class, 'deleteCategory']);
Route::get('get-category/{id}', [CategoryController::class, 'getSingleCategory']);
Route::get('get-categories', [CategoryController::class, 'getAllCategories']);
Route::post('update-category/{id}', [CategoryController::class, 'updateCategory']);

#Brand
Route::post('create-brand', [BrandController::class, 'createBrand']);
Route::post('delete-brand/{id}', [BrandController::class, 'deleteBrand']);
Route::get('get-brand/{id}', [BrandController::class, 'getSingleBrand']);
Route::get('get-brands', [BrandController::class, 'getAllBrands']);
Route::post('update-brand/{id}', [BrandController::class, 'updateBrand']);