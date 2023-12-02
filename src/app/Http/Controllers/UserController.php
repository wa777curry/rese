<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // ログイン関連
    public function getLogin() {
        return view('auth.login');
    }

    public function postLogin(UserRequest $request) {
        $accepts = $request->only('email', 'password');

        if (Auth::attempt($accepts)) {
            return redirect()->route('index');
        } else {
            $request->session()->flash('email', $request->input('email'));
            return back()->withErrors(['postLogin' => '※メールアドレスまたはパスワードが誤っています']);
        }
    }

    // 会員登録関連
    public function getRegister() {
        return view('auth.register');
    }

    public function postRegister(UserRequest $request) {
        User::create([
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
        ]);
        return view('thanks');
    }

    public function thanks() {
        return view('thanks');
    }

    // マイページ関連
    public function mypage() {
        return view('mypage');
    }

    // ログアウト関連
    public function logout() {
        Auth::logout();
        return redirect('/');
    }
}
