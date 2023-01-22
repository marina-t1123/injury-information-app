<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

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
     * トレーナーに紐付いているトレーナー詳細のリレーション
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function userAttribute()
    {
        return $this->hasOne(UserAttribute::class);
    }

    /**
     * トレーナー検索のクエリのローカルスコープ
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param $search
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSearchUser($query, $search)
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
     * 指定されたIDをもつトレーナーモデルを取得
     *
     * @param int $id
     * @return Illuminate\Database\Eloquent\Model
     */
    public static function getUser($id)
    {
        return self::findOrFail($id);
    }

    /**
     * 指定されたIDを持つトレーナーとトレーナー詳細を取得
     *
     * @param int $id
     * @return \Illuminate\Database\Eloquent\Model
     */
    public static function getUserAndAttribute($id)
    {
        return self::with('UserAttribute')
                ->where('id', $id)
                ->first();
    }

    /**
     * トレーナーの名前を登録する
     *
     * @param int $id
     * @param string $UserName
     * @var App\Models\Illuminate\Database\Eloquent\Model $User
     */
    public static function registerUserName($id, $userName)
    {
        DB::beginTransaction();
        try {
            $user = self::getUser($id);
            //編集する名前を指定する
            $user->name = $userName;
            //名前を保存する
            $user->save();
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
