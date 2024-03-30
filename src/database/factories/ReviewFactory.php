<?php

namespace Database\Factories;

use App\Models\Review;
use App\Models\Shop;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReviewFactory extends Factory
{
    protected $model = Review::class;

    public function definition()
    {
        // ユーザーと店舗のIDを配列で定義
        $userIds = range(2, 10);
        $shopIds = range(1, 20);

        // 現在のインデックスを取得し、次のインデックスに移動する
        static $userIndex = 0;
        static $shopIndex = 0;

        // ユーザーIDと店舗IDに値を割り当てる
        $userId = $userIds[$userIndex];
        $shopId = $shopIds[$shopIndex];

        // インデックスを更新する
        $userIndex = ($userIndex + 1) % count($userIds);
        $shopIndex = ($shopIndex + 1) % count($shopIds);

        // ランダムな評価とコメントを生成
        $rating = $this->faker->numberBetween(1, 5);
        $comment = $this->faker->realText(100, 5);

        // ユーザーIDと店舗IDにランダムな評価とコメントを割り当てる
        return [
            'user_id' => $userId,
            'shop_id' => $shopId,
            'rating' => $rating,
            'comment' => $comment,
        ];
    }
}
