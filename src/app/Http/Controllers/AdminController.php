<?php

namespace App\Http\Controllers;

use App\Http\Requests\RepresentativeRequest;
use App\Http\Requests\UploadRequest;
use App\Models\Area;
use App\Models\Genre;
use App\Models\Representative;
use App\Models\Shop;
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
        } elseif (Auth::guard('representative')->attempt($credentials)) {
            return redirect()->route('getOperation');
        }
        // 認証に失敗した場合
        return redirect()->route('getAdmin')->withErrors(['postAdmin' => 'ログインに失敗しました']);
    }

    // 管理者画面の表示
    public function getManagement() {
        return view('admin.admin');
    }

    // 店舗代表者の登録
    public function postManagement(RepresentativeRequest $request) {
        Representative::create([
            'representativename' => $request->input('representativename'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
        ]);
        return redirect()->route('listManagement');
    }

    // 店舗代表者の一覧
    public function listManagement() {
        $representatives = Representative::all();
        return view('admin.list', compact('representatives'));
    }

    // 予約状況の確認の表示
    public function getOperation() {
        $representative = Auth::guard('representative')->user();
        $currentDate = now()->toDateString();
        $reservations = $representative->reservations
            ->where('reservation_date', '>=', $currentDate);

        return view('admin.operation', compact('reservations'));
    }

    // 店舗情報登録の表示
    public function getUpload(Request $request) {
        $areas = Area::all();
        $genres = Genre::all();
        return view('admin.upload', compact('areas', 'genres'));
    }

    // 店舗の登録
    public function postUpload(UploadRequest $request) {
        $representative = Auth::guard('representative')->user();

        Shop::create([
            'representative_id' => $representative->id,
            'shop_name' => $request->input('shop_name'),
            'area_id' => $request->input('area_id'),
            'genre_id' => $request->input('genre_id'),
            'shop_summary' => $request->input('shop_summary'),
        ]);
        return redirect()->route('getShoplist');
    }

    // 店舗登録一覧の表示
    public function getShoplist() {
        $representative = Auth::guard('representative')->user();
        $shops = $representative->shops;
        return view('admin.shoplist', compact('shops'));
    }

    // 編集画面の表示
    public function getEdit($id) {
        $shop = Shop::findOrFail($id);
        $areas = Area::all();
        $genres = Genre::all();
        return view('admin.edit', compact('shop', 'areas', 'genres'));
    }

    // 編集画面からの更新処理
    public function postEdit(Request $request, $id) {
        $shop = Shop::findOrFail($id);

        // フォームから送信されたデータを更新
        $shop->update([
            'shop_name' => $request->input('shop_name'),
            'area_id' => $request->input('area_id'),
            'genre_id' => $request->input('genre_id'),
            'shop_summary' => $request->input('shop_summary'),
            // 他の更新対象のカラムも同様に更新
        ]);

        return redirect()->route('getShoplist');
    }


    public function storage(Request $request) {
        // ディレクトリ名
        $dir = 'images';
        // sampleディレクトリに画像を保存
        $request->file('image')->store('public/' . $dir);
        return redirect('/');
    }
}
