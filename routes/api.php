<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
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

// Product ที่ไม่ต้องใช้ Token
Route::get('productRead',[ProductController::class,'productRead']);
Route::get('productReadID/{id}',[ProductController::class,'productReadID']);

// Middleware คือ ตัวกรอง request Sanctum คือ แพ็คเกจที่ช่วยในเรื่องของการ Authenticate
Route::group(['middleware' => 'auth:sanctum'], function () {
    // Product ที่ต้องใช้ Token
    Route::post('productCreate',[ProductController::class,'productCreate']);
    Route::put('productUpdate/{id}',[ProductController::class,'productUpdate']);
    Route::delete('productDelete/{id}',[ProductController::class,'productDelete']);

    // Authentication ที่ต้องใช้ Token
    Route::post('logout',[AuthController::class,'logout']);
});







