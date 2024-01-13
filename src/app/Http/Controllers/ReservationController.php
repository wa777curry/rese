<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReservationRequest;
use App\Models\Reservation;
use App\Models\Shop;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    // 予約入力関連
    public function postReservation(ReservationRequest $request) {
        if (Auth::check()) { // ログインしているかどうか
            $user = Auth::user(); // ログインユーザーの取得

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

    // 予約完了
    public function done() {
        return view('done');
    }

    // 予約変更
    public function postEditReservation(ReservationRequest $request, $id) {
        // 既存の予約情報を取得
        $reservation = Reservation::find($id);
        $reservation->update([
            'reservation_date' => $request->input('reservation_date'),
            'reservation_time' => $request->input('reservation_time'),
            'reservation_number' => $request->input('reservation_number'),
        ]);
        // 予約情報を取得し直す
        $reservation = Reservation::find($id);
        return redirect()->route('getReservation')->with('success', '予約が変更されました');
    }

    // 予約削除
    public function deleteReservation($id) {
        $reservation = Reservation::findOrFail($id);
        $reservation->delete();
        return redirect()->route('getReservation');
    }

    // QRコードの表示
    public function qrReservation($id) {
        // QRコード生成ロジックを追加
        // 生成されたQRコード画像を表示するビューを返す
        // または、直接画像を返すことも可能
    }
}