<?php

namespace App\Models;

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
        'password',
    ];

    // 各選手の詳細情報のリレーション


    // 各選手の既往歴のリレーション


    // 各選手の問診票のリレーション


    // 選手のカルテのリレーション
}
