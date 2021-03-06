<?php


use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\StaffController;
use App\Http\Controllers\Api\SupplierController;
use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::group([

        'middleware' => 'api',
        'prefix' => 'auth'

    ], function ($router){
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/me', [AuthController::class, 'me']);
    Route::get('/getUser/{id}', [AuthController::class, 'getUser']);
    Route::get('/getAllUser', [AuthController::class, 'getAllUsers']);
    Route::post('/delete/{id}', [AuthController::class, 'deleteAUser']);
    Route::get('/delete', [AuthController::class, 'deleteAllUsers']);


});

Route::ApiResource('/staff', StaffController::class);
Route::ApiResource('/supplier', SupplierController::class);
Route::ApiResource('/category', CategoryController::class);
Route::ApiResource('/product', ProductController::class);
