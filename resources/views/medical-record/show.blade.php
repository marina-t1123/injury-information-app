<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-xl text-gray-700 leading-tight text-center">
            カルテ詳細ページ
        </h1>
    </x-slot>

    <section class="text-gray-600 body-font">
        <div class="container px-5 py-24 mx-auto">
            <!-- カルテ詳細情報 -->
            <div class="flex items-center lg:w-3/5 mx-auto border-b pb-10 mb-10 border-gray-200 sm:flex-row flex-col">
                <div class="flex-grow sm:text-left text-center mt-6 sm:mt-0">
                    <h2 class="text-gray-900 text-lg title-font font-medium mb-2 mx-auto">
                        カルテ情報
                    </h2>
                    <p>カルテID： {{$medicalRecord->id}}</p>
                    <p>診察日： {{ $medicalRecord->hospital_day }}</p>
                    <p>担当医： {{ $medicalRecord->attending_physician }}</p>
                    <p>診察内容： {{ $medicalRecord->medical_examination }}</p>
                    <p>テスト内容： {{ $medicalRecord->tests }}</p>
                    <p>ドクター所見： {{ $medicalRecord->docter_findings }}</p>
                    <p>診断名： {{ $medicalRecord->swelling }}</p>
                    <p>今後の方針： {{ $medicalRecord->future_policies }}</p>
                    <p>画像：</p>
                    @foreach ($medicalImages as $medicalImage)
                        <x-image :imageFileName="$medicalImage->medical_image" type="medical_image" />
                    @endforeach
                </div>
            </div>
            <!-- 既往歴メニュー -->
            <div class="mx-auto my-4 text-center">
                <a href="{{ route('user.medical-questionnaire.show.menu', ['athlete_id' => $athlete->id ]) }}" class="text-white bg-gray-500 border-0 py-2 px-8 focus:outline-none hover:bg-gray-300 rounded text-sm">
                    {{ $athlete->name }}さんの問診票ページ
                </a>
            </div>
            </div>
    </section>
</x-app-layout>
