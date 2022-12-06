<?php

namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class StoreAthleteRequest extends FormRequest
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
     * 選手新規作成フォームでのバリデーションルールを取得
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email:filter,dns',
            'phone_number' => 'required|regex:/^(0{1}\d{1,4}-{0,1}\d{1,4}-{0,1}\d{4})$/',
        ];
    }

    // public function messages()
    // {
    //     return [
    //         'name.required' => ':attribute の入力をお願いします',
    //         'email.required' => ':attribute  の入力をお願いします',
    //     ];
    // }

    public function attributes()
    {
        return [
            'name' => '名前',
            'email' => 'Eメール',
            'phone_number' => '電話番号',
        ];
    }
}
