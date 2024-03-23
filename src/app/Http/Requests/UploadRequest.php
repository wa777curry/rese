<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UploadRequest extends FormRequest
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
            'shop_name' => ['required', 'string', 'max:100'],
            'shop_summary' => ['required', 'string', 'max:200'],
        ];
    }

    public function messages()
    {
        return [
            'shop_name.required' => '※店舗名を入力してください',
            'shop_name.string' => '※店舗名を文字列で入力してください',
            'shop_name.max' => '※店舗名を100文字以下で入力してください',
            'shop_summary.required' => '※店舗概要を入力してください',
            'shop_summary.string' => '※店舗概要を文字列で入力してください',
            'shop_summary.max' => '※店舗概要を200文字以下で入力してください',
        ];
    }
}
