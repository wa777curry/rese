<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReservationRequest;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

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
    public function editReservation($id) {
        // 編集ページを表示するためのロジックを追加
        return view('reservation.edit', ['reservationId' => $id]);
    }

    // 予約削除
    public function deleteReservation($id) {
        $reservation = Reservation::findOrFail($id);
        $reservation->delete();
        return redirect()->route('mypage');
    }

    // QRコードの表示
    public function qrReservation($id) {
        // QRコード生成ロジックを追加
        // 生成されたQRコード画像を表示するビューを返す
        // または、直接画像を返すことも可能
    }
}