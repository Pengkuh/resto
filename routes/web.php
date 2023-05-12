<?php

use App\Http\Controllers\adminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BaseController;
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

Route::get(
    '/',
    [BaseController::class, 'index']
)->middleware('auth:web');

// Auth Routes
Route::get('/login', [AuthController::class, 'login'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'authenticating']);
Route::get('/logout', [AuthController::class, 'logout'])->middleware('auth:web');
Route::get('/register', [AuthController::class, 'register'])->middleware('guest');
Route::post('/register', [AuthController::class, 'storeRegister'])->middleware('guest');

// shop
Route::get('/booking', [BaseController::class, 'Booking'])->middleware('auth:web');
Route::get('/reservation', [BaseController::class, 'Reservation'])->middleware('auth:web');
Route::get('/detail-reservation/{res_id}', [BaseController::class, 'detailReservation'])->middleware('auth:web');

Route::post('/reserved', [BaseController::class, 'Reserved'])->middleware('auth:web');
Route::post('/checkout', [BaseController::class, 'Checkout'])->middleware('auth:web');
Route::post('/pay', [BaseController::class, 'PayBill'])->middleware('auth:web');


Route::get('/dashboard', [adminController::class, 'index'])->middleware('auth:admin');
Route::get('/reservation-table', [adminController::class, 'reservation'])->middleware('auth:admin');
Route::post('/update-reservation', [adminController::class, 'updateReservation'])->middleware('auth:admin');
Route::get('/print-table/{bill_date}', [adminController::class, 'printTable'])->middleware('auth:admin');
Route::get('/reservation-detail/{res_id}', [adminController::class, 'detailReservation'])->middleware('auth:admin');
Route::get('/user-table', [adminController::class, 'user'])->middleware('auth:admin');
Route::get('/product-table', [adminController::class, 'product'])->middleware('auth:admin');
Route::post('/update-product', [adminController::class, 'updateProduct'])->middleware('auth:admin');
Route::post('/add-product', [adminController::class, 'addProduct'])->middleware('auth:admin');
