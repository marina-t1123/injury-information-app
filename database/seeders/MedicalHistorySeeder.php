<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MedicalHistorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //選手IDが1〜4までの選手の既往歴を作成する
        DB::table('medical_histories')->insert([
            [
                'injured_day' => '2019/11/15',
                'injured_area' => '右膝',
                'injury_status' => '乱取り中に、背負い投げをかけた際に潰れてしまった。その際に上から乗られてしまいknee-inをして受傷。',
                'first_aid' => 'RICE処置を行う。病院でレントゲンとMRI撮影。接骨院で電気と超音波を行った。',
                'hospital_visit' => '1',
                'diagnosis' => '右膝内側靭帯のⅠ度損傷',
                'current_situation' => '現在は特に問題ない為、練習にも参加している状態。',
                'athlete_id' => '1',
                'created_at' => new Carbon('2022-12-01'),
                'updated_at' => new Carbon('2022-12-01'),
            ],
            [
                'injured_day' => '2020/2/8',
                'injured_area' => '右足関節',
                'injury_status' => '試合中、相手に投げられそうになり咄嗟に足をついた際に内反捻挫をした。',
                'first_aid' => 'アイシングのみ。試合後にテーピングを巻いて次の試合に出場。',
                'hospital_visit' => '0',
                'diagnosis' => '',
                'current_situation' => 'たまに内反捻挫を繰り返して、痛みが出ている場合はテーピングをして練習参加。',
                'athlete_id' => '2',
                'created_at' => new Carbon('2022-12-01'),
                'updated_at' => new Carbon('2022-12-01'),
            ],
            [
                'injured_day' => '2022/6/20',
                'injured_area' => '左肘',
                'injury_status' => '寝技の乱取り中に、十字固で関節技を掛けられて肘の過伸展で受傷。',
                'first_aid' => 'アイシングのみ。',
                'hospital_visit' => '1',
                'diagnosis' => '肘関節内側側副靭帯損傷(肘MCL損傷)Ⅱ度',
                'current_situation' => '現在も痛みが出ることがあるのでテーピングをして練習に参加。終わった後はアイシングを行う。',
                'athlete_id' => '3',
                'created_at' => new Carbon('2022-12-01'),
                'updated_at' => new Carbon('2022-12-01'),
            ],
            [
                'injured_day' => '2021/8/24',
                'injured_area' => '右肩',
                'injury_status' => '合宿の練習時に、右肩を脱臼肢位で相手に固められたまま大外刈りを掛けられて倒された際に受傷。',
                'first_aid' => 'RICE処置、練習不参加',
                'hospital_visit' => '1',
                'diagnosis' => '右肩肩鎖関節脱臼',
                'current_situation' => '船橋整形外科で手術を行い、メディカルリハとアスリハ実施。2022年の2月から練習復帰。',
                'athlete_id' => '4',
                'created_at' => new Carbon('2022-12-01'),
                'updated_at' => new Carbon('2022-12-01'),
            ],
            [
                'injured_day' => '2019/11/15',
                'injured_area' => '右膝',
                'injury_status' => '乱取り中に、背負い投げをかけた際に潰れてしまった。その際に上から乗られてしまいknee-inをして受傷。',
                'first_aid' => 'RICE処置を行う。病院でレントゲンとMRI撮影。接骨院で電気と超音波を行った。',
                'hospital_visit' => '1',
                'diagnosis' => '右膝内側靭帯のⅠ度損傷',
                'current_situation' => '現在は特に問題ない為、練習にも参加している状態。',
                'athlete_id' => '5',
                'created_at' => new Carbon('2022-12-01'),
                'updated_at' => new Carbon('2022-12-01'),
            ],
            [
                'injured_day' => '2020/2/8',
                'injured_area' => '右足関節',
                'injury_status' => '試合中、相手に投げられそうになり咄嗟に足をついた際に内反捻挫をした。',
                'first_aid' => 'アイシングのみ。試合後にテーピングを巻いて次の試合に出場。',
                'hospital_visit' => '0',
                'diagnosis' => '',
                'current_situation' => 'たまに内反捻挫を繰り返して、痛みが出ている場合はテーピングをして練習参加。',
                'athlete_id' => '6',
                'created_at' => new Carbon('2022-12-01'),
                'updated_at' => new Carbon('2022-12-01'),
            ],
            [
                'injured_day' => '2022/6/20',
                'injured_area' => '左肘',
                'injury_status' => '寝技の乱取り中に、十字固で関節技を掛けられて肘の過伸展で受傷。',
                'first_aid' => 'アイシングのみ。',
                'hospital_visit' => '1',
                'diagnosis' => '肘関節内側側副靭帯損傷(肘MCL損傷)Ⅱ度',
                'current_situation' => '現在も痛みが出ることがあるのでテーピングをして練習に参加。終わった後はアイシングを行う。',
                'athlete_id' => '7',
                'created_at' => new Carbon('2022-12-01'),
                'updated_at' => new Carbon('2022-12-01'),
            ],
            [
                'injured_day' => '2021/8/24',
                'injured_area' => '右肩',
                'injury_status' => '合宿の練習時に、右肩を脱臼肢位で相手に固められたまま大外刈りを掛けられて倒された際に受傷。',
                'first_aid' => 'RICE処置、練習不参加',
                'hospital_visit' => '1',
                'diagnosis' => '右肩肩鎖関節脱臼',
                'current_situation' => '船橋整形外科で手術を行い、メディカルリハとアスリハ実施。2022年の2月から練習復帰。',
                'athlete_id' => '8',
                'created_at' => new Carbon('2022-12-01'),
                'updated_at' => new Carbon('2022-12-01'),
            ],
        ]);
    }
}
