<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Favorite;
use App\Models\Genre;
use App\Models\Reservation;
use App\Models\Shop;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShopController extends Controller
{
    // 店舗一覧表示と検索
    public function index(Request $request) {
        $areas = Area::all();
        $genres = Genre::all();

        $query = $this->shopData();

        $a = $request->input('a');
        $g = $request->input('g');
        $k = $request->input('k');

        if ($k !== null) {
            //全角を半角に
            $search_split = mb_convert_kana($k, 's');
            //半角で文字を切り分けて、配列に入れる
            $search_split2 = preg_split('/[\s]+/', $search_split, -1, PREG_SPLIT_NO_EMPTY);
            //配列をforeachでまわして、where条件を付け加える
            foreach ($search_split2 as $value) {
                $query->where('shop_name', 'LIKE', '%' . $value . '%');
            }
        }
        if ($a !== null) {
            $query->where('area_id', '=', $a);
        }
        if ($g !== null) {
            $query->where('genre_id', '=', $g);
        }
        $shops = $query->get();

        return view('index', compact('shops', 'areas', 'genres', 'k', 'a', 'g'));
    }

    // マイページの表示
    public function getMypage() {
        $areas = Area::all();
        $genres = Genre::all();

        $query = $this->shopData();

        // 予約状況の表示
        $userId = Auth::id(); // ログインIDの取得
        $reservations = Reservation::where('user_id', $userId)
            ->where('reservation_date', '>=', now()->toDateString()) // 未来の予約のみを取得
            ->orderBy('reservation_date') // 日付昇順
            ->orderBy('reservation_time') // 時間昇順
            ->get();

        // 予約番号の振り直し
        $reservations = $reservations->map(function ($reservation, $index) {
            $reservation->number = $index + 1;
            return $reservation;
        });

        // お気に入り店舗の表示
        $favoriteShops = Favorite::where('user_id', $userId)->with('shop')->get();

        return view('mypage', compact('reservations', 'favoriteShops', 'areas', 'genres'));
    }

    private function shopData() {
        $query = DB::table('shops');
        $query->join('areas', 'shops.area_id', '=', 'areas.id');
        $query->join('genres', 'shops.genre_id', '=', 'genres.id');
        $query->select('shops.*', 'areas.area_name', 'genres.genre_name',);
        $query->orderBy('shops.id', 'asc');

        return $query;
    }

    // 店舗詳細関連
    public function detail($id) {
        $shop = Shop::find($id);
        list($times, $numbers) = $this->detailContent();
        return view('detail', compact('shop', 'times', 'numbers'));
    }

    // 予約フォームの詳細
    private function detailContent() {
        $startTime = strtotime('10:00'); // 開始時間
        $endTime = strtotime('22:00'); // 終了時間
        $interval = 1 * 60 * 60; // 1時間置きに設定
        $times = [];
        for ($time = $startTime; $time <= $endTime; $time += $interval) {
            $formattedTime = date('H:i', $time);
            $times[] = $formattedTime;
        }
        $numbers = array_merge(range(1, 10)); // 1〜10人まで選択
        return [$times, $numbers];
    }
}