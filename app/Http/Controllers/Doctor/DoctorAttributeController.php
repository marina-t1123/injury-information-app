<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\DoctorAttribute;
use App\Http\Requests\DoctorAttributeRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class DoctorAttributeController extends Controller
{
    /**
     * ドクター詳細設定画面表示
     *
     * @param int $id
     * @return Illuminate\View\View
     */
    public function showDoctorAttributeMenu($id)
    {
        //ドクターの詳細情報を取得する
        $doctor = Doctor::getDoctorAndAttribute($id);

        //ドクター詳細設定画面にリダイレクト
        return view('doctor-attribute.doctor-attribute-menu', compact('doctor'));
    }

    public function create($id)
    {
        //ドクター詳細を作成するドクターを取得する
        $doctor = Doctor::getDoctor($id);

        //ドクター詳細編集ページにリダイレクトする
        return view('doctor-attribute.create', compact('doctor'));
    }

    public function store(DoctorAttributeRequest $request, $id)
    {

        //ドクターの名前を登録する。
        Doctor::registerDoctorName($id, $request->name);

        //ドクター編集情報を新規作成する
        DoctorAttribute::create([
            'hospital_name' => $request->hospital_name,
            'phone_number' => $request->phone_number,
            'particular_field' => $request->particular_field,
            'career' => $request->career,
            'doctor_id' => $id
        ]);

        //ドクターと作成したドクター詳細を取得
        $doctor = Doctor::getDoctorAndAttribute($id);

        //ドクター詳細登録成功時に表示するフラッシュメッセージ
        Session::flash('message', 'ドクター詳細情報を登録しました。');

        //ドクター詳細編集ページにリダイレクトする
        return view('doctor-attribute.doctor-attribute-menu', compact('doctor'));
    }

    public function edit($id)
    {
        //ドクターの詳細情報を取得する
        $doctor = Doctor::getDoctorAndAttribute($id);

        //ドクター詳細編集ページにリダイレクトする
        return view('doctor-attribute.edit', compact('doctor'));
    }

    public function update(DoctorAttributeRequest $request, $id)
    {
        //編集するドクター詳細を取得する
        $targetDoctor = Doctor::getDoctor($id);

        //ドクターの名前が編集前と違った場合、更新する
        if($targetDoctor->name !== $request->name)
        {
            //編集後の名前を登録する
            Doctor::registerDoctorName($id, $request->name);
        }

        //ドクター詳細情報を更新する
        if(!empty($request))
        {
            DB::beginTransaction();
            try {
                //編集する詳細データを設定
                $doctorAttribute = [
                    'hospital_name' => $request->hospital_name,
                    'phone_number' => $request->phone_number,
                    'particular_field' => $request->particular_field,
                    'career' => $request->career
                ];
                //詳細データを更新する
                $targetDoctor->doctorAttribute()->update($doctorAttribute);
                DB::commit();
            } catch (\Throwable $e) {
                // 全てのエラー・例外をキャッチしてログに残す
                Log::error($e);
                //フロントにエラーを通知するので、例外を投げる
                throw $e;
                DB::rollBack();
            }
        }

        //ドクターと編集後のドクター詳細を取得する
        $doctor = Doctor::getDoctorAndAttribute($id);

        //ドクター詳細更新成功時に表示するフラッシュメッセージ
        Session::flash('message', 'ドクター詳細情報を編集しました。');

        //詳細情報ページにリダイレクトする
        return view('doctor-attribute.doctor-attribute-menu', compact('doctor'));

    }
}
