<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MedicalQuestionnaireSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //選手ID1~8までの問診票を作成
        DB::table('medical_Questionnaires')->insert([
            [
                'injured_day' => '2022/5/26',
                'injured_area' => '右足首',
                'injury_status' => '練習中に、内股で投げられそうな時に咄嗟に右足で投げられないように足をついた際に内反方向に捻りながら受傷。',
                'claim' => '足首が腫れていて、足をつくことができない。少しでも足首を動かすと痛い。',
                'pain' => '1',
                'swelling' => '1',
                'first_aid' => 'RICE処置',
                'orthopedic_test' => 'Lateral Instability test + , Medial Instability test +',
                'muscle_strength_test' => '腫脹が見られるため、行っていません。',
                'trainer_findings' => '外側靭帯部分に圧痛や腫脹が見られる。特に前距腓靭帯の痛みが強く出ている。三角靭帯部分にも圧痛あり。足関節の内反捻挫疑い。',
                'future_plans' => '６月に出場予定の試合がある。監督からの要望は出来れば出場させてほしいと要望あり。',
                'injury_image' => 'test_image1.jpeg',
                'athlete_id' => '1',
                'created_at' => new Carbon('2022-06-01'),
                'updated_at' => new Carbon('2022-06-01'),
            ],
            [
                'injured_day' => '2022/8/15',
                'injured_area' => '左足首',
                'injury_status' => '試合中に、背負い投げで投げられそうな時に咄嗟に左足で投げられないように足をついた際に内反方向に捻りながら受傷。',
                'claim' => '足首が腫れていて、足をつくことができない。少しでも足首を動かすと痛い。',
                'pain' => '1',
                'swelling' => '1',
                'first_aid' => 'RICE処置',
                'orthopedic_test' => 'Lateral Instability test + , Medial Instability test +',
                'muscle_strength_test' => '腫脹が見られるため、行っていません。',
                'trainer_findings' => '外側靭帯部分に圧痛や腫脹が見られる。特に前距腓靭帯の痛みが強く出ている。三角靭帯部分にも圧痛あり。足関節の内反捻挫疑い。',
                'future_plans' => '10月に出場予定の試合がある。監督からの要望は出来れば出場させてほしいと要望あり。',
                'injury_image' => '',
                'athlete_id' => '2',
                'created_at' => new Carbon('2022-08-15'),
                'updated_at' => new Carbon('2022-08-15'),
            ],
            [
                'injured_day' => '2022/9/26',
                'injured_area' => '左肘',
                'injury_status' => '練習中に、内股で投げられそうな時に咄嗟に左手で投げられないように手をついた際に肘の過伸展位で再受傷。最初の受傷は6月22日。',
                'claim' => '足首が腫れていて、足をつくことができない。少しでも足首を動かすと痛い。',
                'pain' => '1',
                'swelling' => '1',
                'first_aid' => 'RICE処置',
                'orthopedic_test' => 'Valgus Stress test +',
                'muscle_strength_test' => '腫脹が見られるため、行っていません。',
                'trainer_findings' => '6月22日の最初の受傷時と同じ箇所で、腫脹・圧痛などが見られる。肘関節内側側副靭帯の再受傷と考える。',
                'future_plans' => '今年に出場予定の試合なし。再受傷ということもあり、リハビリなどを行い完治した状態での練習復帰をさせてほしいと監督から要望あり。',
                'injury_image' => 'test_image2.png',
                'athlete_id' => '3',
                'created_at' => new Carbon('2022-10-01'),
                'updated_at' => new Carbon('2022-10-01'),
            ],
            [
                'injured_day' => '2022/10/26',
                'injured_area' => '右足首',
                'injury_status' => '練習中に、内股で投げられそうな時に咄嗟に右足で投げられないように足をついた際に内反方向に捻りながら受傷。',
                'claim' => '足首が腫れていて、足をつくことができない。少しでも足首を動かすと痛い。',
                'pain' => '1',
                'swelling' => '1',
                'first_aid' => 'RICE処置',
                'orthopedic_test' => 'Lateral Instability test + , Medial Instability test +',
                'muscle_strength_test' => '腫脹が見られるため、行っていません。',
                'trainer_findings' => '外側靭帯部分に圧痛や腫脹が見られる。特に前距腓靭帯の痛みが強く出ている。三角靭帯部分にも圧痛あり。足関節の内反捻挫疑い。',
                'future_plans' => '12月に強化合宿の予定がある。監督からの要望は合宿参加の方向で進めてほしいと要望あり。',
                'injury_image' => 'test_image3.jpeg',
                'athlete_id' => '4',
                'created_at' => new Carbon('2022-10-27'),
                'updated_at' => new Carbon('2022-10-27'),
            ],
        ]);
    }
}
