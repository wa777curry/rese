<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    // ログイン関連
    public function showLoginForm() {
        return view('auth.login');
    }

    // 会員登録関連
    public function showRegisterForm() {
        return view('auth.register');
    }

    public function thanks() {
        return view('thanks');
    }

    // マイページ関連
    public function mypage() {
        return view('mypage');
    }

}
