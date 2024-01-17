<?php

namespace App\Http\Controllers;

use App\Models\Representative;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    // ログイン関連
    public function getAdmin() {
        return view('admin.login');
    }

    public function postAdmin(Request $request) {
        $credentials = $request->only(['email', 'password']);

        if (Auth::guard('admin')->attempt($credentials)) {
            return redirect()->route('getManagement');
            }
            // 認証に失敗した場合
            return redirect()->route('getAdmin')->withErrors(['postAdmin' => 'ログインに失敗しました']);
    }

    //　管理画面の表示
    public function getManagement() {
        return view('admin.admin');
    }

    // 店舗代表者の登録
    public function postManagement(Request $request) {
        Representative::create([
            'representativename' => $request->input('representativename'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
        ]);
        return view('admin.admin');
    }

    public function listManagement() {
        $representatives = Representative::all();
        return view('admin.list', ['representatives' => $representatives]);
    }



    public function uploadForm()
    {
        return view('admin.upload');
    }

    public function upload(Request $request)
    {
        // ディレクトリ名
        $dir = 'images';

        // sampleディレクトリに画像を保存
        $request->file('image')->store('public/' . $dir);

        return redirect('/');
    }
}
