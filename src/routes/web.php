<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\DetailController;
use App\Http\Controllers\ManagementController;

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

Route::get('/detail/{id}', [DetailController::class, 'detail'])->name('detail');

Route::get('/management', [ManagementController::class, 'getManagement'])->name('getManagement');
Route::post('/management', [ManagementController::class, 'postManagement'])->name('postManagement');

Route::middleware('auth')->group(function () {
    Route::get('/thanks', [UserController::class, 'thanks']);

    Route::get('/logout', [UserController::class, 'logout']);

    Route::post('/detail/{id}', [DetailController::class, 'postReservation'])->name('postReservation');

    Route::get('/done', [DetailController::class, 'done'])->name('done');

    Route::get('/mypage', [UserController::class, 'mypage'])->name('mypage');
});