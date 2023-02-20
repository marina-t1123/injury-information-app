<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AthleteRequest extends FormRequest
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
     * 選手新規作成フォームでのバリデーションルール
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email:filter,dns|max:255',
            'phone_number' => 'required|string|regex:/^0[0-9]{1,4}-[0-9]{1,4}-[0-9]{3,4}\z/',
            'team' => 'nullable|string|max:255',
            'event' => 'required|string|max:255',
            'event_detail' => 'required|string|max:255',
            'career' => 'nullable|string|max:1000',
        ];

        /* Emailのバリデーション
            存在するドメイン以外は登録できない
            平仮名、カタカナ、漢字は登録できない
            @の直前・直後に . がある場合は登録できない
            その他emailの形式に沿わない入力は登録できない（例：先頭・末尾が記号の場合、記号が連続している場合、特殊記号の場合など）
        */
    }

    public function messages()
    {
        return [
            'event.required' => ':attributeの入力をお願いします',
            'event_detail.required' => ':attributeの入力をお願いします',
            'phone_number.regex' => ':attributeは、-(ハイフン)ありの電話番号の形式で入力して下さい'
        ];
    }

    public function attributes()
    {
        return [
            'name' => '名前',
            'email' => 'Eメール',
            'phone_number' => '電話番号',
            'team' => '所属名',
            'event' => '競技名',
            'event_detail' => '種目名・ポジション',
            'career' => '経歴',
        ];
    }
}
