<?php

use App\Http\Controllers\EmployeController;
use Illuminate\Support\Facades\Route;


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

Route::get('/', function () {
    return view('welcome');
});

Route::resource('employes', EmployeController::class);
Route::delete('employes/{employe}/forceDestroy', [EmployeController::class, 'forceDestroy'])
    ->name('employes.forceDestroy');
