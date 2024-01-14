<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use Auth;

class AdminController extends Controller
{
    // ログイン関連
    public function getAdmin() {
        return view('admin.login');
    }

    public function postAdmin(UserRequest $request) {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            // 選択された役割に基づいてリダイレクト
            $role = $request->input('role');

            switch ($role) {
                case 'admin':
                    return redirect()->route('admin.dashboard'); // 仮の管理画面のダッシュボードルート
                case 'representative':
                    return redirect()->route('representative.dashboard'); // 仮の店舗代表者画面のダッシュボードルート
            }
        } else {
            // 認証に失敗した場合
            return redirect()->route('getAdmin')->withErrors(['postAdmin' => 'ログインに失敗しました']);
        }
    }

    // ログアウト関連
    public function logout() {
        Auth::logout();
        return redirect('/');
    }
}
