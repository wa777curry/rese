<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Request;

class DateTimeNotInPast implements Rule
{
    // 現在日時より未来かどうか
    public function passes($attribute, $value) {
        $currentDateTime = now();
        $reservationDateTime = \DateTime::createFromFormat('Y-m-d H:i', Request::input('reservation_date') . ' ' . $value);

        return $reservationDateTime >= $currentDateTime;
    }

    public function message() {
        return '※予約日時は現在の日時以降に設定してください';
    }
}