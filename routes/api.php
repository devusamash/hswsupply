<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderController;
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