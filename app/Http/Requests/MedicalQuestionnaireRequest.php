<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MedicalQuestionnaireRequest extends FormRequest
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
            'injured_day' => 'required|date|before:today',
            'injured_area' => 'required|string|max:255',
            'injury_status' => 'required|string|max:1500',
            'claim' => 'required|string|max:1500',
            'pain' => 'required|boolean',
            'swelling' => 'required|boolean',
            'first_aid' => 'required|string|max:1500',
            'orthopedic_test' => 'string|max:1500',
            'muscle_strength_test' => 'string|max:1500',
            'trainer_findings' => 'required|string|max:1500',
            'future_plans' => 'string|max:1500',
            'injury_image1' => 'file|image|mimes:jpg,png,jpeg',
            'injury_image2' => 'file|image|mimes:jpg,png,jpeg',
            'injury_image3' => 'file|image|mimes:jpg,png,jpeg',
        ];
    }

    /**
     * 問診票のバリデーションメッセージ
     *
     * @return array
     */
    public function messages()
    {
        return [
            'injured_day.before' => ':attribute の日付は今日より前の日付を指定してください。',
        ];
    }

    /**
     * 問診票の属性名の変更
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'injured_day' => '受傷日',
            'injured_area' => '受傷部位',
            'injury_status' => '受傷状況',
            'claim' => '主張',
            'pain' => '疼痛',
            'swelling' => '腫脹',
            'first_aid' => '受傷後の処置',
            'orthopedic_test' => '整形外科的テスト',
            'muscle_strength_test' => '筋力テスト',
            'trainer_findings' => 'トレーナー所見',
            'future_plans' => '今後のスケジュール',
            'injury_image1' => '怪我の画像１',
            'injury_image2' => '怪我の画像２',
            'injury_image3' => '怪我の画像３',
        ];
    }
}
