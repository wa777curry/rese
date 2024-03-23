<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // ログイン画面の表示
    public function getLogin()
    {
        return view('auth.login');
    }

    // ログイン処理
    public function postLogin(UserRequest $request)
    {
        $accepts = $request->only('email', 'password');

        if (Auth::attempt($accepts)) {
            return redirect()->route('index');
        } else {
            $request->session()->flash('email', $request->input('email'));
            return back()->withErrors(['postLogin' => '※メールアドレスまたはパスワードが誤っています']);
        }
    }

    // 会員登録画面の表示
    public function getRegister()
    {
        return view('auth.register');
    }

    // 会員登録処理
    public function postRegister(UserRequest $request)
    {
        User::create([
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
        ]);
        return view('thanks');
    }

    // 登録完了画面の表示
    public function thanks()
    {
        return view('thanks');
    }

    // ログアウト処理
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
