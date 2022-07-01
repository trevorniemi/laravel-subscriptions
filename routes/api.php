<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CustomerSubscriptionController;
use App\Http\Controllers\API\RegisterController;

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

Route::controller(RegisterController::class)->group(function () {
    Route::post('register', 'register');
    Route::post('login', 'login');
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('customer-subscriptions/customer/{id}', 'App\Http\Controllers\CustomerSubscriptionController@byCustomer');
    Route::resource('companies', CompanyController::class);
    Route::resource('subscriptions', SubscriptionController::class);
    Route::resource('customers', CustomerController::class);
    Route::resource('customer-subscriptions', CustomerSubscriptionController::class);
});
