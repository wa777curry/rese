<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class ReviewValidationRules implements Rule
{
    protected $userId;

    public function __construct($userId)
    {
        $this->userId = $userId;
    }

    public function passes($attribute, $value)
    {
        return !DB::table('reviews')
            ->where('shop_id', $value)
            ->where('user_id', $this->userId)
            ->exists();
    }

    public function message()
    {
        return '※この店舗に対する口コミはすでに投稿されています';
    }
}
