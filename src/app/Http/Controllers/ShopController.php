<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShopRequest;
use App\Models\Shop;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index() {
        $shops = Shop::all(); // すべての店舗データを取得
        return view('index', compact('shops'));
    }

    public function detail() {
        // 予約時間関連
        $startTime = strtotime('10:00'); // 開始時間
        $endTime = strtotime('22:00'); // 終了時間
        $interval = 2 * 60 * 60; // 2時間置きに設定
        $times = [];
        for ($time = $startTime; $time <= $endTime; $time += $interval) {
            $formattedTime = date('H:i', $time);
            $times[] = $formattedTime;
        }

        $numbers = array_merge(range(1, 9), ['10人以上']);
        return view('detail', compact('times', 'numbers'));
    }

    public function submit(Request $request) {
        return redirect()->route('done');
    }

    public function done() {
        return view('done');
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