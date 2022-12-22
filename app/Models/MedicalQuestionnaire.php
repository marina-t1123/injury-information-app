<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class MedicalQuestionnaire extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'injured_day', //受傷日
        'injured_area', //受傷部位
        'injury_status', //受傷状況
        'claim', //主張
        'pain', //疼痛
        'swelling', //腫脹
        'first_aid', //応急処置
        'orthopedic_test', //整形外科的テスト
        'muscle_strength_test', //筋力テスト
        'trainer_findings', //トレーナー所見
        'future_plans', //今後の予定
        'injury_image', //怪我の画像
        'athlete_id', //選手ID
    ];

    /**
     * 問診票に紐ずく選手のリレーション
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function athlete() : BelongsTo
    {
        return $this->belongsTo(Athlete::class);
    }

    /**
     * 問診票に紐ずくカルテのリレーション
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function medicalRecord() : HasOne
    {
        return $this->hasOne(MedicalRecord::class);
    }

}
