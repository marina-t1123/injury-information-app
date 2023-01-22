<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-xl text-gray-700 leading-tight text-center">
            問診票詳細ページ
        </h1>
    </x-slot>

    <section class="text-gray-600 body-font">
        <div class="container px-5 py-24 mx-auto">
            <!-- 問診票詳細情報 -->
            <div class="flex items-center lg:w-3/5 mx-auto border-b pb-10 mb-10 border-gray-200 sm:flex-row flex-col">
                <div class="flex-grow sm:text-left text-center mt-6 sm:mt-0">
                    <h2 class="text-gray-900 text-lg title-font font-medium mb-2 mx-auto">
                        問診票情報
                    </h2>
                    <p>問診票ID： {{$medicalQuestionnaire->id}}</p>
                    <p>受傷日： {{ $medicalQuestionnaire->injured_day }}</p>
                    <p>受傷部位： {{ $medicalQuestionnaire->injured_area }}</p>
                    <p>受傷状況：<br> {{ $medicalQuestionnaire->injury_status }}</p>
                    <p>主張：<br> {{ $medicalQuestionnaire->claim }}</p>
                    <p>疼痛の有無：{{ $medicalQuestionnaire->pain == '0' ? 'なし' : 'あり' }}</p>
                    <p>腫脹の有無：{{ $medicalQuestionnaire->swelling == '0' ? 'なし' : 'あり' }}</p>
                    <p>応急処置：<br> {{ $medicalQuestionnaire->first_aid }}</p>
                    <p>整形外科的テスト：<br> {{ $medicalQuestionnaire->orthopedic_test }}</p>
                    <p>筋力テスト：<br>{{ $medicalQuestionnaire->muscle_stremgth_test }}</p>
                    <p>トレーナー所見：<br>{{ $medicalQuestionnaire->trainer_findings }}</p>
                    <p>今後の予定：<br>{{ $medicalQuestionnaire->future_plans }}</p>
                    <p>怪我の画像：</p><br>
                    <x-image :imageFileName="$medicalQuestionnaire->injury_image" type="injury_image"/>
                    <p>診察日：{{ $medicalQuestionnaire->hospital_day }}</p>
                    <p>担当医：{{ $medicalQuestionnaire->attending_physician }}</p>
                </div>
            </div>
            <!-- 問診票詳細・カルテページ -->
            @if (request()->is('doctor*'))
                <div class="mx-auto my-4 text-center">
                    <a href="{{ route('doctor.medical-questionnaire.show.menu', ['athlete_id' => $medicalQuestionnaire->athlete_id ]) }}" class="text-white bg-gray-500 border-0 py-2 px-8 focus:outline-none hover:bg-gray-300 rounded text-sm">
                        {{ $medicalQuestionnaire->athlete->name }}さんの問診票詳細・カルテページ
                    </a>
                </div>
            @else
                <div class="mx-auto my-4 text-center">
                    <a href="{{ route('user.medical-questionnaire.show.menu', ['athlete_id' => $medicalQuestionnaire->athlete_id ]) }}" class="text-white bg-gray-500 border-0 py-2 px-8 focus:outline-none hover:bg-gray-300 rounded text-sm">
                        {{ $medicalQuestionnaire->athlete->name }}さんの問診票・カルテ詳細ページ
                    </a>
                </div>
            @endif

            </div>
    </section>
</x-app-layout>
