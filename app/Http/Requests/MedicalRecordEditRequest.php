<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MedicalRecordEditRequest extends FormRequest
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
            'hospital_day' => 'required|date',
            'attending_physician' => 'required|string|max:255',
            'medical_examination' => 'required|string|max:1500',
            'tests' => 'string|max:1500',
            'doctor_findings' => 'required|string|max:1500',
            'swelling' => 'required|string|max:255',
            'future_policies' => 'required|string|max:1500',
            'files.*.medical_image' => 'image|mimes:jpg,jpeg,png'
        ];
    }

    /**
     * カルテの属性名の変更
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'hospital_day' => '診察日',
            'attending_physician' => '担当医',
            'medical_examination' => '診察内容',
            'tests' => 'テスト内容',
            'doctor_findings' => 'ドクター所見',
            'swelling' => '診断名',
            'future_policies' =>  '今後の方針',
            'files.*.medical_image' => '画像',
        ];
    }
}
