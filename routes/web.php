<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Home
Route::get('/',     [HomeController::class, 'index']);
Route::get('/home', [HomeController::class, 'home'])->name('home');

//Departments
Route::get('/departments/{department}/users/manage',        [DepartmentController::class, 'manageUsers']);
Route::post('/departments/{department}/users',              [DepartmentController::class, 'addUser']);
Route::delete('/departments/{department}/users/{user}',     [DepartmentController::class, 'removeUser']);
Route::get('/departments/hierarchy',                        [DepartmentController::class, 'hierarchy']);

//Resources
Route::resource('departments',  DepartmentController::class);
Route::resource('users',        UserController::class);