<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MedicalImage extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'medical_record_id', //カルテID
        'medical_image' //メディカルのファイル名
    ];

    /**
     * カルテとのリレーション
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function medicalRecord()
    {
        return $this->belongsTo(MedicalRecord::class);
    }

}
