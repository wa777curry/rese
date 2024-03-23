<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReservationRequest;
use App\Models\Rating;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    // 予約入力処理
    public function postReservation(ReservationRequest $request)
    {
        if (Auth::check()) {
            $user = Auth::user();

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

    // 予約完了画面の表示
    public function done()
    {
        return view('done');
    }

    // 予約変更処理
    public function postEditReservation(ReservationRequest $request, $id) {
        // 既存の予約情報を取得
        $reservation = Reservation::find($id);
        $reservation->update([
            'reservation_date' => $request->input('reservation_date'),
            'reservation_time' => $request->input('reservation_time'),
            'reservation_number' => $request->input('reservation_number'),
        ]);
        return redirect()->route('getReservation')->with('success', '予約が変更されました');
    }

    // 予約削除処理
    public function deleteReservation($id) {
        $reservation = Reservation::find($id);
        $reservation->delete();
        return redirect()->route('getReservation');
    }





    // 予約履歴の評価・コメント処理
    public function postEditHistory(Request $request, $id) {
        // 既存の予約情報を取得
        $reservation = Reservation::find($id);
        $ratingData = [
            'reservation_id' => $request->input('reservation_id'),
            'rating' => $request->input('rating'),
            'comment' => $request->input('comment'),
        ];
        $rating = Rating::where('reservation_id', $id)->first();

        if (!$rating) {
            // 評価が存在しない場合は新規作成
            $reservation->rating()->create($ratingData);
            return redirect()->route('getHistory')->with('success', '評価とコメントが保存されました');
        }
        return redirect()->route('getHistory')->with('error', '既に評価とコメントが存在します');
    }
}
