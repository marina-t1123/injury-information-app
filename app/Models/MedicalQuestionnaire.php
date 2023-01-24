<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Athlete;
use App\Models\MedicalRecord;
use Carbon\Carbon;

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
        'hospital_day', //診察日
        'attending_physician', //担当医
        'athlete_id', //選手ID
    ];

    /**
     * 問診票に紐ずく選手のリレーション
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function athlete()
    {
        return $this->belongsTo(Athlete::class);
    }

    /**
     * 問診票に紐ずくカルテのリレーション
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function medicalRecord()
    {
        return $this->hasOne(MedicalRecord::class);
    }

    /**
     * 今日受診する選手の問診票をカルテと一緒に取得する
     *
     * @param \Illuminate\Database\Eloquent\Collection||null $todayMedicalQuestionnaires
     */
    public static function getTodayMedicalQuestionnaires()
    {
        return self::where('hospital_day', Carbon::today())
                ->leftJoin('athletes', 'medical_questionnaires.athlete_id', '=', 'athletes.id')
                ->with('medicalRecord')
                ->paginate(1);
    }


    /**
     * 指定された問診票IDを持つ問診票と選手情報を取得する
     *
     * @param int $medicalQuestionnaireId
     * @return Illuminate\Database\Eloquent\Model
     */
    public static function getMedicalQuestionnaireAndAthlete($medicalQuestionnaireId)
    {
        return self::where('id' , $medicalQuestionnaireId)
                ->with('athlete')
                ->first();
    }
}
