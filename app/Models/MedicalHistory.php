<?php

namespace App\Models;

use App\Models\Athlete;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalHistory extends Model
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
        'first_aid', //応急処置
        'hospital_visit', //病院受診
        'diagnosis', //診断名
        'current_situation', //現在の状態
        'athlete_id', //選手ID
    ];

    /**
     * 既往歴に紐ずく選手のリレーション
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongTo
     */
    public function athlete()
    {
        return $this->belongsTo(Athlete::class);
    }

    /**
     * 指定されたIDを持つ既往歴を取得する
     *
     * @param int $medicalHistoryId
     * @return Illuminate\Database\Eloquent\Model
     */
    public static function getMedicalHistory($medicalHistoryId)
    {
        return self::findOrFail($medicalHistoryId);
    }

    /**
     * 指定された既往歴IDを持つ既往歴と紐ずく選手情報を取得する
     *
     * @param int $medicalHistoryId
     * @return Illuminate\Database\Eloquent\Model
     */
    public static function getMedicalHistoryAndAthleteData($medicalHistoryId)
    {
        return self::where('id', $medicalHistoryId)
                ->with('athlete')
                ->first();
    }

}
