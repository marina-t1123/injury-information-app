<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-700 leading-tight text-center">
            カルテメニュー
        </h2>
    </x-slot>

    <!-- フラッシュメッセージ -->
    <x-flash-message status="info" />

    <div class="w-4/5 py-12 mx-auto">
        <section class="text-gray-600 body-font">
            <div class="container px-5 py-14 mx-auto">

                <div class="flex items-center lg:w-3/5 mx-auto border-b pb-10 mb-10 border-gray-200 sm:fle-row flex-col">
                    <!-- カルテ情報 -->
                    <div class="flex-grow text-left mt-6 sm:mt-0 mb-12">
                        <h2 class="text-gray-900 text-center text-lg title-font font-medium mb-2 mx-auto">
                            カルテ情報
                        </h2>
                        <p>選手名：{{ $athlete->name }}</p>
                        <p>診察日：{{ $medicalRecord->hospital_day }}</p>
                        <p>担当医：{{ $medicalRecord->attending_physician }}先生</p>
                        <p>診察内容：<br>
                            {{ $medicalRecord->medical_examination }}
                        </p>
                        <p>テスト内容：<br>
                            {{ $medicalRecord->tests }}
                        </p>
                        <p>ドクター所見：<br>
                            {{ $medicalRecord->doctor_findings }}
                        </p>
                        <p>診断名：{{ $medicalRecord->swelling }}</p>
                        <p>今後の方針：<br>
                            {{ $medicalRecord->future_policies }}
                        </p>
                        <p>画像：</p>
                        @foreach ($medicalImages as $medicalImage)
                            <x-image :imageFileName="$medicalImage->medical_image" type="medical_image" />
                        @endforeach
                    </div>
                    <!-- カルテ編集 -->
                    <div class="flex-grow sm:text-left text-center mt-6 mb-8 sm:mt-0">
                        <a href="{{ route('doctor.medical-record.edit', ['medical_record_id' => $medicalRecord->id ]) }}" class="text-white bg-gray-800 border-0 py-2 px-8 mt-5 focus:outline-none hover:bg-gray-700 rounded text-sm">
                            カルテ編集
                        </a>
                    </div>
                    <!-- 問診票・カルテ詳細ページ -->
                    <div class="flex-grow sm:text-left text-center mt-6 sm:mt-0">
                        <a href="{{ route('doctor.medical-questionnaire.show.menu', ['athlete_id' => $athlete->id ]) }}" class="text-white bg-gray-600 border-0 py-2 px-8 mt-5 focus:outline-none hover:bg-gray-500 rounded text-sm">
                            問診票・カルテ詳細ページ
                        </a>
                    </div>
                </div>
                <!-- マイページボタン -->
                <x-mypage-button></x-mypage-button>
            </div>
        </section>
    </div>
</x-app-layout>
