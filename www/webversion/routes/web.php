<?php

use App\Http\Controllers\Ebl\CompanyController;
use App\Http\Controllers\Ebl\DashboardController;
use App\Http\Controllers\Ebl\RoleController;
use App\Http\Controllers\Temp\TempController;
use App\Http\Controllers\Ebl\UserController;
use App\Http\Controllers\Ebl\PermanentController;
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

Route::get('/', [UserController::class,'index']);
Route::get('/login', [UserController::class,'index']);

// Route::get('/login',[LoginController::class,'index']);
// Route::post('/verify',[LoginController::class,'loginVerify'])->name('login.loginVerify');
// Route::get('/logout',[LoginController::class,'logout'])->name('login.logout');


Route::middleware(['usersession'])->prefix('temporary')->group(function(){
    Route::get('/list',[TempController::class,'list']);
    Route::get('/edit/{id}',[TempController::class,'edit']);
    Route::get('/delete/{id}',[TempController::class,'delete']);
    Route::post('/update',[TempController::class,'update'])->name('temporary.update');
});

// Route::middleware(['usersession'])->get('/dashboard',[DashboardController::class,'view']);
Route::middleware(['usersession'])->post('/insert',[TempController::class,'insertData'])->name('permanent.insert');
Route::middleware(['usersession'])->get('/permanent/insert/{id}',[TempController::class,'permanent']);

// Route::get('users/{id}', [TempController::class,'delete']);

Route::middleware(['usersession'])->prefix('user')->group(function () {
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

Route::middleware(['usersession'])->prefix('roles')->group(function() {
    Route::post('/add',[RoleController::class,'add'])->name('roles.insert');
    Route::get('/new', [RoleController::class,'new']);
    Route::post('/update',[RoleController::class,'update'])->name('roles.update');
    Route::get('/list',[RoleController::class,'view']);
    Route::get('/edit/{id}',[RoleController::class,'edit']);
    Route::get('/delete/{id}',[RoleController::class,'delete']); 
});

Route::middleware(['usersession'])->prefix('permanent')->group(function(){
    Route::post('/add',[PermanentController::class,'add'])->name('permanent.create');
    Route::post('/update',[PermanentController::class,'update'])->name('permanent.update');
    Route::get('/list',[PermanentController::class,'view']);
    Route::get('/edit/{id}',[PermanentController::class,'edit']);
    Route::get('/delete/{id}',[PermanentController::class,'delete']);
});

Route::middleware(['usersession'])->prefix('company')->group(function(){
    Route::get('/new', [CompanyController::class,'new']);
    Route::post('/add',[CompanyController::class,'add'])->name('company.create');
    Route::post('/update',[CompanyController::class,'update'])->name('company.update');
    Route::get('/list',[CompanyController::class,'view']);
    Route::get('/edit/{id}',[CompanyController::class,'edit']);
    Route::get('/delete/{id}',[CompanyController::class,'delete']);
});

// Route::middleware(['usersession'])->prefix('dashboard')->group(function(){
    // Route::get('/dashboard',[DashboardController::class,'info']);
// });
Route::get('/dashboard',[DashboardController::class,'info']);
