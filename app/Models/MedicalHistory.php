<?php

namespace App\Models;

use App\Models\Athlete;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
     * 既往歴の検索フォーム(部分一致検索)のローカルスコープ
     */
    public function scopeSearchMedicalHistory($query, $search)
    {
        //もし、検索フォームで入力があった場合
        if($search)
        {
            //検索フォームの入力値に全角スペースが入力されていたら半角スペースに変換する
            $convertSpace = mb_convert_kana($search, 's');
            //検索フォームの入力値を単語で区切り、配列にする(例:"田中 太郎" -> ["田中", "太郎"])
            $searchWordArray = preg_split('/[\s]+/', $convertSpace);
            //単語をループで回して、単語と部分一致する選手がいれば$queryとして保持される(検索結果を保持)
            foreach($searchWordArray as $value){
                $query->where('injured_area', 'like', '%' .$value. '%');
            }
            //検索結果を返す
            return $query;
        }
    }

    /**
     * 既往歴に紐ずく選手のリレーション
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongTo
     */
    public function athlete() : BelongsTo
    {
        return $this->belongsTo(Athlete::class);
    }

}
