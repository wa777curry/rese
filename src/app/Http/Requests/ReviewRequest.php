<?php

namespace App\Http\Requests;

use App\Rules\ReviewValidationRules;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ReviewRequest extends FormRequest
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
            'rating' => ['required', 'in:1,2,3,4,5'],
            'comment' => ['required', 'string', 'max:400'],
            'comment_url' => ['file', 'mimes:jpeg,png', 'max:2048'],
            'shop_id' => ['required', new ReviewValidationRules(Auth::id())],
        ];
    }

    public function messages()
    {
        return [
            'rating.required' => '※星評価をしてください',
            'comment.required' => '※コメントを入力してください',
            'comment.string' => '※コメントは文字列で入力してください',
            'comment.max' => '※コメントは400文字以下で入力してください',
            'comment_url.file' => '※画像ファイルを指定してください',
            'comment_url.mimes' => '※有効な画像形式（JPEG、PNG）を指定してください',
            'comment_url.max' => '※ファイルサイズは2MB以下にしてください',
            'shop_id.required' => '※この店舗に対する口コミはすでに投稿されています',
        ];
    }
}
