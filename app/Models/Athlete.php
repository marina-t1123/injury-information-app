<?php

namespace App\Models;

use App\Models\MedicalHistory;
use App\Models\MedicalQuestionnaire;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Athlete extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone_number',
        'team',
        'event',
        'event_detail',
        'career'
    ];

    /**
     * 選手検索のクエリのローカルスコープ
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $search
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSearchAthlete($query, $search)
    //クエリのローカルスコープを作成する際はscopeをプレフィックスとしてつける。
    {
        //もし、検索フォームで入力があった場合
        if($search){
            //全角スペースが入力されていたら半角スペースに変換する
            $convertSpace = mb_convert_kana($search, 's');
            //単語を空白(半角スペース)で区切り、配列にする(例:"田中 太郎" -> ["田中", "太郎"])
            $searchWordArray = preg_split('/[\s]+/', $convertSpace);
            //単語をループで回して、単語と部分一致する選手がいれば$queryとして保持される(検索結果を保持)
            foreach( $searchWordArray as $value){
                $query->where('name', 'like', '%' .$value. '%');
                //like句で「%入力値%」とすることで部分一致検索を行なっている
            }
            //検索結果を返す
            return $query;
        }
    }

    /**
     * 選手の既往歴のリレーション
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function medicalHistories()
    {
        return $this->HasMany(MedicalHistory::class);
    }

    /**
     * 選手の問診票のリレーション
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function medicalQuestionnaires()
    {
        return $this->HasMany(MedicalQuestionnaire::class);
    }

    /**
     * 指定されたIDを持つ選手を取得する
     *
     * @param int $athleteId
     * @return \Illuminate\Database\Eloquent\Model
     */
    public static function getAthlete($athleteId)
    {
        return self::findOrFail($athleteId);
    }

    /**
     * 指定された選手IDを持つ選手に紐ずく既往歴のリレーション
     *
     * @param int $athleteId
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public static function getAthleteAndMedicalHistory($athleteId)
    {
        return self::getAthlete($athleteId)
                ->medicalHistories();
    }

    /**
     * 指定された選手IDを持つ選手に紐ずく問診票のリレーション
     *
     * @param int $athleteId
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public static function getAthleteAndMedicalQuestionnaires($athleteId)
    {
        return self::getAthlete($athleteId)
                ->medicalQuestionnaires();
    }

}
