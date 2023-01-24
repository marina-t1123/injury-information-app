<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MedicalRecordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //選手ID1~4までのカルテを作成する
        DB::table('medical_records')->insert([
            [
                'hospital_day' => Carbon::today(),
                'attending_physician' => '高橋 和樹',
                'medical_examination' => '問診票の画像より腫脹が強くなっている。損傷部位の影響で関節可動域の制限あり。外側靭帯部分に圧痛や腫脹。特に前距腓靭帯の痛みが強い。三角靭帯部分にも圧痛あり。',
                'tests' => '腫脹が強いため、なし。',
                'doctor_findings' => 'レントゲン撮影の結果、骨折の可能性はなし。MRI撮影の結果、外側副靭帯の中でも前距腓靭帯部分のⅡ度損傷を確認。PTのメディカルリハで受傷部位の機能改善を検討。',
                'swelling' => '足関節内反捻挫Ⅱ度損傷',
                'future_policies' => 'まずは腫脹のケアとしてアイシングや超音波などをメディカルリハをPTと行う。腫脹が落ち着いてから、機能改善のリハビリを行う。',
                'medical_Questionnaire_id' => '1',
                'created_at' => new Carbon('2022-06-01'),
                'updated_at' => new Carbon('2022-06-01')
            ],
            [
                'hospital_day' => Carbon::today(),
                'attending_physician' => '山中 隆弘',
                'medical_examination' => '問診票の画像より腫脹が強くなっている。損傷部位の影響で関節可動域の制限あり。外側靭帯部分に圧痛や腫脹。特に前距腓靭帯の痛みが強い。三角靭帯部分にも圧痛あり。',
                'tests' => '腫脹が強いため、なし。',
                'doctor_findings' => 'レントゲン撮影の結果、骨折の可能性はなし。MRI撮影の結果、外族側副靭帯の中でも前距腓靭帯部分のⅢ度損傷を確認。PTのメディカルリハで受傷部位の機能改善を検討。完全断裂の為、試合出場は難しい。',
                'swelling' => '足関節内反捻挫Ⅲ度損傷',
                'future_policies' => 'まずは腫脹のケアとしてアイシングや超音波などをメディカルリハをPTと行う。腫脹が落ち着いてから、機能改善のリハビリを行う。',
                'medical_Questionnaire_id' => '2',
                'created_at' => new Carbon('2022-08-15'),
                'updated_at' => new Carbon('2022-08-15'),
            ],
            [
                'hospital_day' => new Carbon('2022-10-11'),
                'attending_physician' => '田中 幸助',
                'medical_examination' => '問診票の画像より腫脹が強くなっている。損傷部位の影響で関節可動域の制限あり。内側靭帯部分に疼痛や腫脹。特に前斜走靭帯の疼痛が強い。',
                'tests' => '腫脹が強いため、なし。',
                'doctor_findings' => 'レントゲン撮影の結果、骨折の可能性はなし。MRI撮影の結果、内側副靭帯の中でも前斜走靭帯靭帯部分のⅡ度損傷を確認。後斜走靭帯、横走靭帯もⅠ度損傷。PTのメディカルリハで受傷部位の炎症改善を検討。',
                'swelling' => '肘関節内側側副靭帯Ⅱ度損傷',
                'future_policies' => 'まずは腫脹や疼痛のケアとしてアイシングや超音波などをメディカルリハをPTと行う。腫脹が落ち着いてから、機能改善のリハビリを行う。',
                'medical_Questionnaire_id' => '3',
                'created_at' => new Carbon('2022-10-01'),
                'updated_at' => new Carbon('2022-10-01'),
            ],
            [
                'hospital_day' => new Carbon('2022-11-12'),
                'attending_physician' => '山中 隆弘',
                'medical_examination' => '問診票の画像より腫脹が強くなっている。損傷部位の影響で関節可動域の制限あり。外側靭帯部分に圧痛や腫脹。特に前距腓靭帯の痛みが強い。三角靭帯部分にも圧痛あり。',
                'tests' => '腫脹が強いため、なし。',
                'doctor_findings' => 'レントゲン撮影の結果、骨折の可能性はなし。MRI撮影の結果、外族側副靭帯の中でも前距腓靭帯部分のⅡ度損傷を確認。PTのメディカルリハで受傷部位の機能改善を検討。',
                'swelling' => '足関節内反捻挫Ⅱ度損傷',
                'future_policies' => 'まずは腫脹のケアとしてアイシングや超音波などをメディカルリハをPTと行う。腫脹が落ち着いてから、機能改善のリハビリを行う。',
                'medical_Questionnaire_id' => '4',
                'created_at' => new Carbon('2022-10-27'),
                'updated_at' => new Carbon('2022-10-27'),
            ],
        ]);
    }
}
