<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReservationRequest;
use App\Models\Reservation;
use App\Models\Shop;
use Illuminate\Support\Facades\Auth;

class DetailController extends Controller
{
    // 店舗詳細関連
    public function detail($id) {
        $shop = Shop::find($id);
        $startTime = strtotime('10:00'); // 開始時間
        $endTime = strtotime('22:00'); // 終了時間
        $interval = 2 * 60 * 60; // 2時間置きに設定
        $times = [];
        for ($time = $startTime; $time <= $endTime; $time += $interval) {
            $formattedTime = date('H:i', $time);
            $times[] = $formattedTime;
        }
        $numbers = array_merge(range(1, 10));
        return view('detail', compact('shop', 'times', 'numbers'));
    }

    // 予約入力関連
    public function postReservation(ReservationRequest $request) {
        if (Auth::check()) { // ログインしているかどうか
            $user = Auth::user(); // ユーザーIDの取得

            Reservation::create([
                'user_id' => $user->id,
                'shop_id' => $request->input('shop_id'),
                'reservation_date' => $request->input('reservation_date'),
                'reservation_time' => $request->input('reservation_time'),
                'reservation_number' => $request->input('reservation_number'),
            ]);
            return redirect()->route('done');
        } else {
            return redirect()->route('getLogin');
        }
    }

    public function done() {
        return view('done');
    }
}
