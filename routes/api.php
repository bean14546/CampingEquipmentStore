<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductHistoryController;
use App\Http\Controllers\StartedOnController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
// Authentication ที่ไม่ต้องใช้ Token
Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);

// Middleware คือ ตัวกรอง request Sanctum คือ แพ็คเกจที่ช่วยในเรื่องของการ Authenticate
Route::group(['middleware' => 'auth:sanctum'], function () {
    // Product
    Route::post('productCreate', [ProductController::class, 'productCreate']);
    Route::put('productUpdate/{id}', [ProductController::class, 'productUpdate']);
    Route::delete('productDelete/{id}', [ProductController::class, 'productDelete']);
    Route::get('productCount', [ProductController::class, 'productCount']);
    Route::get('productRead', [ProductController::class, 'productRead']);
    Route::get('productReadID/{id}', [ProductController::class, 'productReadID']);
    Route::get('productReadCategory/{cetegory}', [ProductController::class, 'productReadCategory']);
    Route::get('productSearch/{keyword}', [ProductController::class, 'productSearch']);

    // History Product
    Route::post('productHistoryCreate', [ProductHistoryController::class, 'productHistoryCreate']);
    Route::get('productHistoryRead', [ProductHistoryController::class, 'productHistoryRead']);
    Route::delete('productHistoryDelete/{id}', [ProductHistoryController::class, 'productHistoryDelete']);
    Route::get('productHistoryCount', [ProductHistoryController::class, 'productHistoryCount']);
    Route::get('productHistorySearch/{keyword}', [ProductHistoryController::class, 'productHistorySearch']);

    // User
    Route::get('userCount', [UserController::class, 'userCount']);
    Route::get('userRead', [UserController::class, 'userRead']);
    Route::get('userReadID/{id}', [UserController::class, 'userReadID']);
    Route::put('userUpdate/{id}', [UserController::class, 'userUpdate']);
    Route::delete('userDelete/{id}', [UserController::class, 'userDelete']);
    Route::get('userSearch/{keyword}', [UserController::class, 'userSearch']);


    // User Started On (ดึงข้อมูลของผู้ที่ login ล่าสุด)
    Route::get('activeUsersCount', [StartedOnController::class, 'activeUsersCount']);
    Route::get('activeUsersRead', [StartedOnController::class, 'activeUsersRead']);
    Route::get('activeUsersSearch/{keyword}', [StartedOnController::class, 'activeUsersSearch']);

    // Authentication ที่ต้องใช้ Token
    Route::post('logout', [AuthController::class, 'logout']);
});
