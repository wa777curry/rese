<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ManagementController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\ModalController;

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

Route::get('/login', [UserController::class, 'getLogin'])->name('getLogin');
Route::post('/login', [UserController::class, 'postLogin'])->name('postLogin');

Route::get('/register', [UserController::class, 'getRegister'])->name('getRegister');
Route::post('/register', [UserController::class, 'postRegister'])->name('postRegister');

Route::get('/', [ShopController::class, 'index'])->name('index');

Route::get('/detail/{id}', [ShopController::class, 'detail'])->name('detail');

Route::get('/management', [ManagementController::class, 'getManagement'])->name('getManagement');
Route::post('/management', [ManagementController::class, 'postManagement'])->name('postManagement');

Route::middleware('auth')->group(function () {
    Route::get('/thanks', [UserController::class, 'thanks']);

    Route::get('/logout', [UserController::class, 'logout']);

    Route::post('/detail/{id}', [ReservationController::class, 'postReservation'])->name('postReservation');
    Route::get('/done', [ReservationController::class, 'done'])->name('done');

    Route::get('/reservation/edit/{id}', [ReservationController::class, 'editReservation'])->name('editReservation');
    Route::get('/reservation/delete/{id}', [ReservationController::class, 'deleteReservation'])->name('deleteReservation');
    Route::get('/reservation/qr/{id}', [ReservationController::class, 'qrReservation'])->name('qrReservation');

    Route::get('/mypage', [ShopController::class, 'getMypage'])->name('mypage');
    Route::get('/mypage/favorite', [ShopController::class, 'getFavorite'])->name('getFavorite');
    Route::get('/mypage/reservation', [ShopController::class, 'getReservation'])->name('getReservation');
    Route::get('/mypage/history', [ShopController::class, 'getHistory'])->name('getHistory');

    Route::get('/modal', [ModalController::class, 'modal']);

    Route::get('/favorite/{shop}', [FavoriteController::class, 'favorite'])->name('favorite');
    Route::get('/nofavorite/{shop}', [FavoriteController::class, 'nofavorite'])->name('nofavorite');
});