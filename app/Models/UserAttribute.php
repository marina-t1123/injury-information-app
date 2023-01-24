<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class UserAttribute extends Model
{
    use HasFactory;

     /**
     * モデルと関連しているテーブル
     *
     * @var string
     */
    protected $table = 'user_attribute';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'team', //所属
        'phone_number', //電話番号
        'career', //経歴
        'user_id', //ユーザーID
    ];

    /**
     * ユーザー詳細に紐付いているユーザーのリレーション
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
