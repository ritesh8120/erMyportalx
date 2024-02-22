<?php

use App\Http\Controllers\admin\{
    EmployeeController,
    TaskController
};
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Common\TimelogController;
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
})->name('login');

Route::post('login', [AuthController::class, 'index'])->name('auth.login');

Route::middleware('auth')->group(function(){
    Route::get('dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
    Route::get('dashboard/timelog', [AuthController::class, 'timelog'])->name('dashboard.timelog.index');
    Route::resource('employee', EmployeeController::class);
    Route::resource('task', TaskController::class);
    Route::resource('timelog', TimelogController::class);
    Route::post('addMore', [TimelogController::class, 'addMore'])->name('timelog.addMore');
});