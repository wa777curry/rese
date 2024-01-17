<?php

namespace App\Http\Requests;

use App\Rules\DateTimeNotInPast;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ReservationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'reservation_date' => ['required', 'date'],
            'reservation_time' => ['required', new DateTimeNotInPast],
            'reservation_number' => [
                'required',
                Rule::unique('reservations')
                    ->where('user_id', Auth::id())
                    ->where('shop_id', $this->input('shop_id'))
                    ->where('reservation_date', $this->input('reservation_date'))
                    ->where('reservation_time', $this->input('reservation_time'))
            ],
        ];
    }

    public function messages()
    {
        return [
            'reservation_date.required' => '※予約日を選択してください',
            'reservation_date.date' => '※有効な日付形式で入力してください',
            'reservation_time.required' => '※予約時間を選択してください',
            'reservation_number.required' => '※予約人数を選択してください',
            'unique' => '※指定された日時には既に予約があります',
        ];
    }
}
