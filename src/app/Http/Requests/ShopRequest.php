<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShopRequest extends FormRequest
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
    public function rules() {
        return [
            'shop_name' => ['required', 'string'],
            'area_id' => ['required'],
            'genre_id' => ['required'],
            'shop_summary' => ['required', 'string'],
            'image_url' => ['required', 'url'],
        ];
    }
}
