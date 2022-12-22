<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\Relations\BelongsTo;

class MedicalRecord extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'hospital_day', //診察日
        'attending_physician', //担当医
        'medical_examination', //診察内容
        'tests', //テスト内容
        'doctor_findings', //ドクター所見
        'swelling', //診断名
        'future_policies', //今後の方針
        'image', //画像
        'image', //画像
        'image', //画像
        'medical_questionnaire_id', //問診票ID
    ];

    /**
     * カルテに紐付いている問診票のリレーション
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function medicalQuestionnaire() :BelongsTo
    {
        $this->belongsTo(MedicalQuestionnaire::class);
    }

}
