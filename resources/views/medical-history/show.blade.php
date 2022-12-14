<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-xl text-gray-700 leading-tight text-center">
            既往歴詳細ページ
        </h1>
    </x-slot>

    <section class="text-gray-600 body-font">
        <div class="container px-5 py-24 mx-auto">
            <!-- 既往歴詳細情報 -->
            <div class="flex items-center lg:w-3/5 mx-auto border-b pb-10 mb-10 border-gray-200 sm:flex-row flex-col">
                <div class="flex-grow sm:text-left text-center mt-6 sm:mt-0">
                    <h2 class="text-gray-900 text-lg title-font font-medium mb-2 mx-auto">
                        既往歴情報
                    </h2>
                    <p>既往歴ID： {{$medicalHistory->id}}</p>
                    <p>名前： {{ $medicalHistory->athlete->name }}</p>
                    <p>受傷日： {{ $medicalHistory->injured_day }}</p>
                    <p>受傷部位： {{ $medicalHistory->injured_area }}</p>
                    <p>受傷状況： {{ $medicalHistory->injury_status }}</p>
                    <p>応急処置： {{ $medicalHistory->first_aid }}</p>
                    <p>病院受診の有無： {{ $medicalHistory->hospital_visit == '0' ? 'なし' : 'あり' }}</p>
                    <p>診断名： {{ $medicalHistory->diagnosis }}</p>
                    <p>現在の状況： {{ $medicalHistory->current_situation }}</p>
                </div>
            </div>
            <!-- 既往歴メニュー -->
            <div class="mx-auto my-4 text-center">
                <a href="{{ route('user.medical-history.show.menu', ['athlete_id' => $medicalHistory->athlete_id ]) }}" class="text-white bg-gray-500 border-0 py-2 px-8 focus:outline-none hover:bg-gray-300 rounded text-sm">
                    {{ $medicalHistory->athlete->name }}さんの既往歴ページ
                </a>
            </div>
            </div>
    </section>
</x-app-layout>
