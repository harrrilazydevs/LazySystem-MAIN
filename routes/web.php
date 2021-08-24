<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LazyController;

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

Route::get('/dashboard', [DashboardController::class, 'index']);

Route::get('/dashboard/profile', [DashboardController::class, 'profile']);

Route::get('/dashboard/changepassword', [DashboardController::class, 'changepassword']);

Route::get('/dashboard/mdm/users', [DashboardController::class, 'MDM_USERS']);

Route::get('/dashboard/mdm/employee', [DashboardController::class, 'MDM_EMPLOYEES']);

Route::get('/dashboard/mdm/classroom', [DashboardController::class, 'MDM_CLASSROOM']);




// LAZY CONTROLLER
Route::post('/UNIV/EDIT', [LazyController::class, '__EDITN']);
Route::post('/UNIV/EDIT/FST', [LazyController::class, '__FORM_EDIT_SINGLE_TABLE']);
Route::post('/UNIV/EDIT/EMP/PASSWORD', [LazyController::class, '__UPDATE_PASSWORD']);
Route::post('/UNIV/DELETE', [LazyController::class, '__DELETEN']); 
Route::post('/UNIV/INSERT', [LazyController::class, '__INSERTN']); 




Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
