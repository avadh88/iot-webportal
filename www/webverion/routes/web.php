<?php

use App\Http\Controllers\Ebl\DashboardController;
use App\Http\Controllers\Ebl\LoginController;
use App\Http\Controllers\Ebl\RoleController;
use App\Http\Controllers\Temp\TempController;
use App\Http\Controllers\Ebl\UserController;
use App\Http\Controllers\Ebl\PermanentController;
use Illuminate\Support\Facades\Route;
use PHPUnit\TextUI\XmlConfiguration\Group;

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
    return view('login');
});

// Route::get('/login',[LoginController::class,'index']);
// Route::post('/verify',[LoginController::class,'loginVerify'])->name('login.loginVerify');
// Route::get('/logout',[LoginController::class,'logout'])->name('login.logout');


Route::middleware('usersession')->prefix('temporary')->group(function(){
    Route::get('/list',[TempController::class,'list']);
    Route::get('/edit/{id}',[TempController::class,'edit']);
    Route::get('/delete/{id}',[TempController::class,'delete']);
    Route::post('/add',[TempController::class,'add'])->name('temporary.add');
    Route::post('/update',[TempController::class,'update'])->name('temporary.update');
});

Route::middleware('usersession')->get('/dashboard',[DashboardController::class,'view']);
Route::middleware('usersession')->get('/insert/{id}',[TempController::class,'insertData']);

// Route::get('users/{id}', [TempController::class,'delete']);

Route::middleware('usersession')->prefix('user')->group(function () {
    Route::get('/list', [UserController::class,'list']);
    Route::get('/new', [UserController::class,'new']);
    Route::post('/add', [UserController::class,'add'])->name('user.name');
    Route::get('/delete/{id}', [UserController::class,'delete']);
    Route::get('/edit/{id}', [UserController::class,'edit']);
    Route::post('/update', [UserController::class,'update'])->name('user.update');
});

Route::get('/login',[UserController::class,'index'])->name('login');
Route::post('/verify',[UserController::class,'loginVerify'])->name('login.loginVerify');
Route::get('/logout',[UserController::class,'logout'])->name('login.logout');

Route::middleware('usersession')->prefix('roles')->group(function() {
    Route::post('/add',[RoleController::class,'add'])->name('roles.insert');
    Route::get('/new', [RoleController::class,'new']);
    Route::post('/update',[RoleController::class,'update'])->name('roles.update');
    Route::get('/list',[RoleController::class,'view']);
    Route::get('/edit/{id}',[RoleController::class,'edit']);
    Route::get('/delete/{id}',[RoleController::class,'delete']); 
});

Route::middleware('usersession')->prefix('permanent')->group(function(){
    Route::post('/add',[PermanentController::class,'add'])->name('permanent.create');
    Route::post('/update',[PermanentController::class,'update'])->name('permanent.update');
    Route::get('/list',[PermanentController::class,'view']);
    Route::get('/edit/{id}',[PermanentController::class,'edit']);
    Route::get('/delete/{id}',[PermanentController::class,'delete']);

});
