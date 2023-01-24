<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoctorAttribute extends Model
{
    use HasFactory;

     /**
     * モデルと関連しているテーブル
     *
     * @var string
     */
    protected $table = 'doctor_attribute';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'hospital_name', //病院名
        'phone_number', //電話番号
        'particular_field', //専門分野
        'career', //経歴
        'doctor_id', //ドクターID
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
