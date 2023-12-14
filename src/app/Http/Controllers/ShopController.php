<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShopRequest;
use App\Models\Shop;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index() {
        // すべての店舗データを取得
        $shops = Shop::all();
        return view('index', compact('shops'));
    }

    public function getManagement() {
        return view('management');
    }

    // 店舗情報アップロード
    public function postManagement(ShopRequest $request) {
        Shop::create([
            'shop_name' => $request->input('shop_name'),
            'area' => $request->input('area'),
            'genre' => $request->input('genre'),
            'shop_summary' => $request->input('shop_summary'),
            'image_url' => $request->input('image_url')
        ]);
        return redirect()->route('detail');
    }
}