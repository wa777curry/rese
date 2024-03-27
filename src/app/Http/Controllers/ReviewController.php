<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReviewRequest;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function postReview(ReviewRequest $request, $id)
    {
        // ログインしているユーザーのIDを取得
        $userId = Auth::id();
        // リクエストから口コミデータを取得
        $data = $request->all();
        // 口コミをデータベースに保存
        $review = new Review();
        $review->user_id = $userId; // ログインしているユーザーのIDを設定
        $review->shop_id = $id; // 口コミが属する店舗のIDを設定
        $review->rating = $data['rating']; // 評価を設定
        $review->comment = $data['comment']; // コメントを設定

        // 画像がアップロードされている場合は、保存してURLをデータベースに格納
        if ($request->hasFile('comment_url')) {
            $imagePath = $request->file('comment_url')->store('uploads', 'public');
            $review->comment_url = $imagePath;
        }

        $review->save();

        return redirect()->route('detail', ['id' => $id])->with('success', '口コミが投稿されました');
    }
}