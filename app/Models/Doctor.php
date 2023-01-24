<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class Doctor extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * ドクターに紐付くドクター詳細とのリレーション
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasOne
     */
    public function doctorAttribute()
    {
        return $this->hasOne(DoctorAttribute::class);
    }

    /**
     * ドクター検索のクエリのローカルスコープ
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function scopeSearchDoctor($query, $search)
    //クエリのローカルスコープを作成する際はscopeをプレフィックスとしてつける。
    {
        //もし、検索フォームで入力があった場合
        if($search){
            //全角スペースが入力されていたら半角スペースに変換する
            $convertSpace = mb_convert_kana($search, 's');
            //単語を空白(半角スペース)で区切り、配列にする(例:"田中 太郎" -> ["田中", "太郎"])
            $searchWordArray = preg_split('/[\s]+/', $convertSpace);
            //単語をループで回して、単語と部分一致するドクターがいれば$queryとして保持される(検索結果を保持)
            foreach( $searchWordArray as $value){
                $query->where('name', 'like', '%' .$value. '%');
                //like句で「%入力値%」とすることで部分一致検索を行なっている
            }
            //検索結果を返す
            return $query;
        }
    }

    /**
     * 指定されたIDをもつドクターモデルを取得
     *
     * @param int $id
     * @return Illuminate\Database\Eloquent\Model
     */
    public static function getDoctor($id)
    {
        return self::findOrFail($id);
    }

    /**
     * ドクターとドクター詳細を取得
     *
     * @param int $id
     * @return \Illuminate\Database\Eloquent\Model
     */
    public static function getDoctorAndAttribute($id)
    {
        return self::with('doctorAttribute')
                ->where('id', $id)
                ->first();
    }

    /**
     * ドクターの名前を登録する
     *
     * @param int $id
     * @param string $doctorName
     * @var \Illuminate\Database\Eloquent\Model $doctor
     */
    public static function registerDoctorName($id, $doctorName)
    {
        DB::beginTransaction();
        try {
            $doctor = self::getDoctor($id);
            //編集する名前を指定する
            $doctor->name = $doctorName;
            //名前を保存する
            $doctor->save();
            DB::commit();
        } catch (\Throwable $e) {
            // 全てのエラー・例外をキャッチしてログに残す
            Log::error($e);
            //フロントにエラーを通知するので、例外を投げる
            throw $e;
            DB::rollBack();
        }
    }
}
