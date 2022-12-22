<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Symfony\Contracts\Service\Attribute\Required;

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
            'medical_examination' => 'required|text|max:1500',
            'tests' => 'text|max:1500',
            'doctor_findings' => 'required|text|max:1500',
            'swelling' => 'required|string|max:255',
            'future_policies' => 'required|test|max:1500',
            'file.*.image' => 'image|mimes:jpg,jpeg,png'
        ];
    }
}
