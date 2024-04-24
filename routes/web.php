<?php

use App\Http\Controllers\CustomerController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [CustomerController::class, 'index'])->name('customers.index');
Route::get('/create', [CustomerController::class, 'create'])->name('customers.create');
Route::get('/edit/{id}', [CustomerController::class, 'edit'])->name('customers.edit');
Route::post('store', [CustomerController::class, 'store'])->name('customers.store');
Route::put('update/{id}', [CustomerController::class, 'update'])->name('customers.update');
Route::delete('destroy/{id}', [CustomerController::class, 'destroy'])->name('customers.destroy');