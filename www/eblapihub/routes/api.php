<?php

use App\Http\Controllers\Api\ApplicationController;
use App\Http\Controllers\Api\CompanyController;
use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\Api\DeviceController;
use App\Http\Controllers\Api\PermanentController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\TempDeviceController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
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

Route::post('/temp', [TempDeviceController::class, 'insertTempData']);
Route::post('/check-device', [TempDeviceController::class, 'checkTempData']);


Route::post('web/login/verify', [UserController::class, 'verify']);
Route::middleware('auth:api')->post('web/logout', [UserController::class, 'logout']);

Route::middleware('auth:api')->prefix('web')->group(function () {
    // Route::post('/login/verify', [UserController::class,'verify']);
    Route::get('/user/list', [UserController::class, 'list']);
    Route::post('/user/add', [UserController::class, 'add']);
    Route::post('/user/update', [UserController::class, 'update']);
    Route::get('/user/delete/{id}', [UserController::class, 'delete']);
    Route::get('/user/edit/{id}', [UserController::class, 'edit']);

    Route::get('/list/devices', [TempDeviceController::class, 'listDevices'])->middleware('auth:api');

    Route::post('/list/add', [DeviceController::class, 'addDevice'])->middleware('auth:api');

    Route::post('roles/add', [RoleController::class, 'add']);
    Route::post('roles/update', [RoleController::class, 'update']);
    Route::get('roles/view', [RoleController::class, 'view']);
    Route::get('roles/edit/{id}', [RoleController::class, 'edit']);
    Route::get('/roles/delete/{id}', [RoleController::class, 'delete']);

    Route::get('/permanent/list/', [PermanentController::class, 'list']);
    Route::get('/permanent/edit/{id}', [PermanentController::class, 'edit']);
    Route::get('/permanent/delete/{id}', [PermanentController::class, 'delete']);
    Route::post('/permanent/update', [PermanentController::class, 'update']);
    Route::post('/permanent/add', [PermanentController::class, 'add'])->middleware('auth:api');
    Route::post('/permanent/status', [PermanentController::class, 'status']);
    Route::post('/permanent/retry', [PermanentController::class, 'retry']);
    // Route::get('/permanent/devicelist',[PermanentController::class,'deviceList']);


    Route::get('/temporary/edit/{id}', [TempDeviceController::class, 'edit']);
    Route::get('/temporary/delete/{id}', [TempDeviceController::class, 'delete']);
    Route::post('/temporary/update', [TempDeviceController::class, 'update']);


    Route::prefix('company')->group(function () {
        Route::post('/add', [CompanyController::class, 'add']);
        Route::get('/list', [CompanyController::class, 'list']);
        Route::post('/update', [CompanyController::class, 'update']);
        Route::get('/edit/{id}', [CompanyController::class, 'edit']);
        Route::get('/delete/{id}', [CompanyController::class, 'delete']);
        Route::get('/compnaylist', [CompanyController::class, 'compnaylist']);
        Route::post('/listbyid', [CompanyController::class, 'listbyid']);
        
    });

    Route::prefix('app')->group(function () {
        Route::post('/add', [ApplicationController::class, 'add']);
        Route::post('/list', [ApplicationController::class, 'list']);
        Route::get('/edit/{id}', [ApplicationController::class, 'edit']);
        Route::get('/delete/{id}', [ApplicationController::class, 'delete']);
        Route::post('/update', [ApplicationController::class, 'update']);
        // Route::get('/appData/{id}', [ApplicationController::class, 'sendDataToDevice']);
    });


    Route::prefix('dashboard')->group(function () {
        Route::get('/info', [DashboardController::class, 'info']);
    });
});

Route::get('/permanent/index', [PermanentController::class, 'index']);
Route::get('/publish', function () {
    Redis::publish('test', json_encode([
        'name' => 'Adam Wathan'
    ]));
});


Route::post('/permanent/status', [PermanentController::class, 'status']);
Route::get('/permanent/status-data', [PermanentController::class, 'statusData']);
Route::post('/permanent/devicelist', [PermanentController::class, 'deviceList']);
Route::post('/company/listbyid', [CompanyController::class, 'listbyid']);
Route::get('/company/listbyid/{id}', [CompanyController::class, 'listbyid']);


Route::get('app/app-data/{id}', [ApplicationController::class, 'sendDataToDevice']);
Route::post('app/load-image/imgRedisCall',[ApplicationController::class,'imgRedisCall']);
Route::post('app/process-image/imgRedisCall',[ApplicationController::class,'imgProcessRedisCall']);

