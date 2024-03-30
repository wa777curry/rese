<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Favorite;
use App\Models\Genre;
use App\Models\Reservation;
use App\Models\Review;
use App\Models\Shop;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShopController extends Controller
{
    // 店舗一覧表示と検索処理
    public function index(Request $request)
    {
        $areas = Area::all();
        $genres = Genre::all();

        $randoms = [
            'random' => 'ランダム',
            'high_rating' => '評価が高い順',
            'low_rating' => '評価が低い順',
        ];

        $query = $this->shopData();

        $a = $request->input('a');
        $g = $request->input('g');
        $k = $request->input('k');
        // デフォルトの並び順をID順に設定
        $sortOption = $request->input('sort_option');

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

        // セレクトボックスからの選択オプションを取得
        $sortOption = $request->input('sort_option');
        // ランダムに並べ替える
        if ($sortOption === 'random') {
            $query->inRandomOrder();
        } elseif ($sortOption == 'high_rating') {
            // 評価が高い順に並べ替える
            $query->orderBy('rating', 'desc');
        } elseif ($sortOption == 'low_rating') {
            // 評価が低い順に並べ替える
            $query->orderBy('rating', 'asc');
        }

        // ランダムに並べ替える
        if ($sortOption === 'random') {
            $randomShops = $query->inRandomOrder()->get();
        } elseif ($sortOption == 'high_rating') {
            // 評価が高い順に並べ替える
            $query->orderBy('rating', 'desc');
        } elseif ($sortOption == 'low_rating') {
            // 評価が低い順に並べ替える
            $query->orderBy('rating', 'asc');
        } else {
            // セレクトボックスからの選択オプションがない場合は ID 順で並べ替える
            $query->orderBy('id');
        }

        $shops = $query->get();

        return view('index', compact('shops', 'areas', 'genres', 'k', 'a', 'g', 'randoms'));
    }

    // 店舗詳細表示
    public function detail($id)
    {
        // 店舗情報を取得
        $shop = Shop::find($id);
        list($times, $numbers) = $this->detailContent();
        // 口コミを取得
        $reviews = Review::where('shop_id', $id)->get();
        return view('detail', compact('shop', 'times', 'numbers', 'reviews'));
    }

    // 口コミ投稿画面表示
    public function review($id)
    {
        $shop = Shop::find($id);
        return view('review.review', compact('shop'));
    }

    // 口コミ編集フォーム画面表示
    public function editReview($id)
    {
        $review = Review::findOrFail($id);
        $shop = Shop::find($review->shop_id);
        return view('review.review-edit', compact('shop', 'review'));
    }

    // マイページ表示
    public function getMypage()
    {
        $data = $this->getMypageData();
        return view('mypage', $data);
    }

    // お気に入り店舗の表示
    public function getFavorite()
    {
        $data = $this->getMypageData();
        $userId = Auth::id(); // ログインIDの取得
        $favoriteShops = Favorite::where('user_id', $userId)->with('shop')
            ->orderBy('shop_id') // 店舗ID順
            ->get();
        return view('mypage.favorite', compact('favoriteShops', 'data'));
    }

    // 予約状況の表示
    public function getReservation()
    {
        $data = $this->getMypageData();
        list($times, $numbers) = $this->detailContent();

        $userId = Auth::id(); // ログインIDの取得
        $reservations = Reservation::where('user_id', $userId)
            // 現日時より未来の情報を表示
            ->where(function ($query) {
                $query->where('reservation_date', '>', now()->toDateString())
                    ->orWhere(function ($query) {
                        $query->where('reservation_date', '=', now()->toDateString())
                            ->where('reservation_time', '>', now()->format('H:i'));
                    });
            })
            ->orderBy('reservation_date') // 日付昇順
            ->orderBy('reservation_time') // 時間昇順
            ->get();

        // 予約番号の振り直し
        $reservations = $reservations->map(function ($reservation, $index) {
            $reservation->number = $index + 1;
            return $reservation;
        });

        return view('mypage.reservation', compact('reservations', 'data', 'times', 'numbers'));
    }

    // 予約履歴の表示
    public function getHistory()
    {
        $data = $this->getMypageData();
        $userId = Auth::id(); // ログインIDの取得
        $pastReservations = Reservation::where('user_id', $userId)
            // 現日時より未来の情報を表示
            ->where(function ($query) {
                $query->where('reservation_date', '<', now()->toDateString())
                    ->orWhere(function ($query) {
                        $query->where('reservation_date', '=', now()->toDateString())
                            ->where('reservation_time', '<', now()->format('H:i'));
                    });
            })
            ->with('rating')
            ->orderBy('reservation_date', 'desc') // 日付昇順
            ->orderBy('reservation_time') // 時間昇順
            ->get();

        // 履歴番号の振り直し
        $pastReservations = $pastReservations->map(function ($reservation, $index) {
            $reservation->number = $index + 1;
            return $reservation;
        });

        return view('mypage.history', compact('pastReservations', "data"));
    }

    private function getMypageData()
    {
        $areas = Area::all();
        $genres = Genre::all();
        $query = $this->shopData();
        return compact('areas', 'genres', 'query');
    }

    private function shopData()
    {
        $query = DB::table('shops');
        $query->join('areas', 'shops.area_id', '=', 'areas.id');
        $query->join('genres', 'shops.genre_id', '=', 'genres.id');
        $query->select('shops.*', 'areas.area_name', 'genres.genre_name', 'genres.image_url');
        return $query;
    }

    // 予約フォームの詳細
    private function detailContent()
    {
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
