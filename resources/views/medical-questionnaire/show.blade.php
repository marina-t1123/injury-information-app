<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-xl text-gray-700 leading-tight text-center">
            問診票詳細ページ
        </h1>
    </x-slot>

    <section class="text-gray-600 body-font">
        <div class="container px-5 py-24 mx-auto">
            <!-- 既往歴詳細情報 -->
            <div class="flex items-center lg:w-3/5 mx-auto border-b pb-10 mb-10 border-gray-200 sm:flex-row flex-col">
                <div class="flex-grow sm:text-left text-center mt-6 sm:mt-0">
                    <h2 class="text-gray-900 text-lg title-font font-medium mb-2 mx-auto">
                        問診票情報
                    </h2>
                    <p>問診票ID： {{$medicalQuestionnaire->id}}</p>
                    <p>名前： {{ $medicalQuestionnaire->athlete->name }}</p>
                    <p>受傷日： {{ $medicalQuestionnaire->injured_day }}</p>
                    <p>受傷部位： {{ $medicalQuestionnaire->injured_area }}</p>
                    <p>受傷状況： {{ $medicalQuestionnaire->injury_status }}</p>
                    <p>主張： {{ $medicalQuestionnaire->claim }}</p>
                    <p>疼痛の有無： {{ $medicalQuestionnaire->pain == '0' ? 'なし' : 'あり' }}</p>
                    <p>腫脹の有無： {{ $medicalQuestionnaire->swelling == '0' ? 'なし' : 'あり' }}</p>
                    <p>応急処置： {{ $medicalQuestionnaire->first_aid }}</p>
                    <p>整形外科的テスト： {{ $medicalQuestionnaire->orthopedic_test }}</p>
                    <p>筋力テスト： {{ $medicalQuestionnaire->muscle_stremgth_test }}</p>
                    <p>トレーナー所見： {{ $medicalQuestionnaire->trainer_findings }}</p>
                    <p>今後の予定： {{ $medicalQuestionnaire->future_plans }}</p>
                    <p>怪我の画像：</p>
                    <x-injury-image :medicalQuestionnaire=$medicalQuestionnaire />
                </div>
            </div>
            <!-- 既往歴メニュー -->
            <div class="mx-auto my-4 text-center">
                <a href="{{ route('user.medical-questionnaire.show.menu', ['athlete_id' => $medicalQuestionnaire->athlete_id ]) }}" class="text-white bg-gray-500 border-0 py-2 px-8 focus:outline-none hover:bg-gray-300 rounded text-sm">
                    {{ $medicalQuestionnaire->athlete->name }}さんの問診票ページ
                </a>
            </div>
            </div>
    </section>
</x-app-layout>
