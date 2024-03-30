<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReviewRequest;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ReviewController extends Controller
{
    // 口コミ投稿処理
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
            $imagePath = $request->file('comment_url')->store('reviews', 'public');
            $review->comment_url = $imagePath;
        }

        $review->save();
        return redirect()->route('detail', ['id' => $id])->with('success', '口コミが投稿されました');
    }

    // 口コミを更新
    public function updateReview(ReviewRequest $request, $id)
    {
        // 口コミの投稿IDを取得
        $review = Review::findOrFail($id);
        // 編集した内容を更新（画像以外）
        $review->update($request->only('rating', 'comment'));
        // 削除フラグを取得
        $deleteFlag = $request->input('deleteFlag');

        // 画像がアップロードされている場合は、保存してURLをデータベースに格納
        if ($request->hasFile('comment_url')) {
            $imagePath = $request->file('comment_url')->store('reviews', 'public');
            $review->comment_url = $imagePath;
        } elseif ($deleteFlag) {
            // 削除フラグがある場合は画像を削除し、データベースの画像フィールドをnullに設定
            $review->comment_url = null;
            // 画像を削除
            Storage::disk('public')->delete(asset('storage/' . $review->comment_url));
        }

        $review->save();
        return redirect()->route('detail', ['id' => $review->shop_id])->with('success', '口コミが更新されました');
    }

    // 口コミを削除
    public function deleteReview($id)
    {
        $review = Review::findOrFail($id);
        $shop_id = $review->shop_id;
        $review->delete();
        return redirect()->route('detail', ['id' => $shop_id])->with('success', '口コミが削除されました');
    }
}
