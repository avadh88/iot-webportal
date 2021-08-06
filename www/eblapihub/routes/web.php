<?php

use App\Events\UserRegisteredEvent;
use App\Http\Controllers\Api\TempDeviceController;
use App\Http\Controllers\Api\UserController;
use App\Mail\UserRegisterd;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/temp',[TempDeviceController::class,'insertTempData']);
Route::prefix('web')->group(function () {
    Route::get('/login/verify', [UserController::class,'verify']);
});

// Route::get('/email', function() {
    // Mail::to('hemuch10@gmail.com')->send(new UserRegisterd());
    // return new UserRegisterd();
    // event( new UserRegisteredEvent('hemuch10@gmail.com') );
    // return '<h1>Email</h1>';
// });

