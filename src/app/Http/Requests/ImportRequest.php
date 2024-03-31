<?php

namespace App\Http\Requests;

use App\Models\Representative;
use App\Models\Shop;
use Illuminate\Foundation\Http\FormRequest;

class ImportRequest extends FormRequest
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
            'csv_file' => ['required', 'file', 'mimes:csv,txt', 'max:2048'],
        ];
    }

    public function messages()
    {
        return [
            'csv_file.required' => '※CSVファイルを選択してください',
            'csv_file.file' => '※ファイルをアップロードしてください',
            'csv_file.mimes' => '※CSVファイルのみアップロードできます',
            'csv_file.max' => '※ファイルサイズは2MB以下にしてください',
        ];
    }
}
