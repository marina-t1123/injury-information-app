<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MedicalHistoryRequest extends FormRequest
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
            'injured_day' => 'required|date|before:today',//受傷日
            'injured_area' => 'required|string|max:255',//受傷部位
            'injury_status' => 'required|string|max:1500',//受傷状況
            'first_aid' => 'required|string|max:1500',//応急処置
            'hospital_visit' => 'required|boolean',//病院受診
            'diagnosis' => 'string|max:255',//診断名
            'current_situation' => 'required|string|max:1500', //現在の状態
        ];
    }

    public function messages()
    {
        return [
            'injured_day.before' => ':attribute の日付は今日より前の日付を指定してください。',
        ];
    }

    public function attributes()
    {
        return [
            'injured_day' => '受傷日',
            'injured_area' => '受傷部位',
            'injury_status' => '受傷状況',
            'first_aid' => '応急処置',
            'hospital_visit' => '病院受診',
            'diagnosis' => '診断名',
            'current_situation' => '現在の状態',
        ];
    }
}
