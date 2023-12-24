<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShopRequest;
use App\Models\Area;
use App\Models\Genre;
use App\Models\Shop;

class ManagementController extends Controller
{
    // 店舗情報の表示
    public function getManagement() {
        $areas = Area::all(); // すべてのエリアデータを取得
        $genres = Genre::all();
        return view('management', compact('areas', 'genres'));
    }

    // 店舗情報のアップロード
    public function postManagement(ShopRequest $request) {
        // 店舗データを作成
        Shop::create([
            'shop_name' => $request->input('shop_name'),
            'area_id' => $request->input('area_id'),
            'genre_id' => $request->input('genre_id'),
            'shop_summary' => $request->input('shop_summary'),
            'image_url' => $request->input('image_url')
        ]);

        return redirect()->route('index');
    }
}
