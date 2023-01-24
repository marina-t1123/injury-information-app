<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserAttributeRequest extends FormRequest
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
     * ユーザー詳細情報フォームでのバリデーションルール
     *
     * @return array
     */
    public function rules()
    {
        return [
            'team' => 'nullable|string|max:255',
            'phone_number' => 'required|string|regex:/^(0{1}\d{1,4}-{0,1}\d{1,4}-{0,1}\d{4})$/',
            'career' => 'nullable|string|max:1500',
        ];

    }

    public function messages()
    {
        return [
            'phone_number.regex' => ':attribute は、「00-0000-0000」か「000-0000-0000」の形式で入力して下さい'
        ];
    }

    public function attributes()
    {
        return [
            'team' =>'所属',
            'phone_number' => '電話番号',
            'career' => '経歴',
        ];
    }
}
