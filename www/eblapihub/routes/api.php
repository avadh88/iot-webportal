<?php

use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\Api\DeviceController;
use App\Http\Controllers\Api\PermanentController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\TempDeviceController;
use App\Http\Controllers\Api\UserController;
use App\Http\Middleware\Authenticate;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/temp',[TempDeviceController::class,'insertTempData']);
Route::post('/check-device',[TempDeviceController::class,'checkTempData']);
// Route::post('/check-device',[TempDeviceController::class,'checkTempData']);


Route::post('web/login/verify', [UserController::class,'verify']);
Route::middleware('auth:api')->post('web/logout', [UserController::class,'logout']);

Route::middleware('auth:api')->prefix('web')->group(function () {
    // Route::post('/login/verify', [UserController::class,'verify']);
    Route::get('/user/list', [UserController::class,'list']);
    Route::post('/user/add', [UserController::class,'add']);
    Route::post('/user/update', [UserController::class,'update']);
    Route::get('/user/delete/{id}', [UserController::class,'delete']);
    Route::get('/user/edit/{id}', [UserController::class,'edit']);
    
    Route::get('/list/devices', [TempDeviceController::class,'listDevices'])->middleware('auth:api');

    Route::get('/list/add/{id}',[DeviceController::class,'addDevice'])->middleware('auth:api');

    Route::post('roles/add', [RoleController::class,'add']);
    Route::post('roles/update', [RoleController::class,'update']);
    Route::get('roles/view', [RoleController::class,'view']);
    Route::get('roles/edit/{id}', [RoleController::class,'edit']);
    Route::get('/roles/delete/{id}', [RoleController::class,'delete']);
    
    Route::get('/permanent/list/', [PermanentController::class,'list']);
    Route::get('/permanent/edit/{id}', [PermanentController::class,'edit']);
    Route::get('/permanent/delete/{id}', [PermanentController::class,'delete']);
    Route::post('/permanent/update', [PermanentController::class,'update']);

    Route::get('/temporary/edit/{id}', [TempDeviceController::class,'edit']);
    Route::get('/temporary/delete/{id}', [TempDeviceController::class,'delete']);
    Route::post('/temporary/update', [TempDeviceController::class,'update']);

    
});

