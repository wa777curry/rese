<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ShopController;

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

Route::get('/login', [UserController::class, 'showLoginForm'])->name('login');
Route::post('/login', [UserController::class, 'login'])->name('login.submit');

Route::get('/register', [UserController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [UserController::class, 'register'])->name('register.submit');

Route::get('/thanks', [UserController::class, 'thanks']);

Route::get('/', [ShopController::class, 'index'])->name('index');

Route::get('/detail', [ShopController::class, 'detail'])->name('detail');

Route::post('/reservation', [ShopController::class, 'submit'])->name('reservation.submit');

Route::get('/done', [ShopController::class, 'done'])->name('done');

Route::get('/mypage', [UserController::class, 'mypage'])->name('mypage');