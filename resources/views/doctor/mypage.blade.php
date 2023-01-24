<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-700 leading-tight text-center">
            マイページ
        </h2>
    </x-slot>

    <!-- フラッシュメッセージ -->
    <x-flash-message status="info" />

    <!-- 本日受診の選手の問診票一覧 -->
    <x-today-medical-questionnaire :today=$today :todayMedicalQuestionnaires=$todayMedicalQuestionnaires />

    <!-- 選手検索 -->
    <div class="w-1/2 h-70 bg-gray-300 mx-auto rounded-lg mt-9 flex justify-center shadow">
        <x-athlete-search-form></x-athlete-search-form>
    </div>

    <!-- 選手一覧 -->
    <section class="text-gray-600 body-font">
        <div class="container py-24 mx-auto">
            <div class="flex flex-wrap w-full mb-20 flex-col items-center text-center">
                <h2 class="sm:text-3xl text-2xl font-medium title-font mb-2 text-gray-900">選手一覧</h2>
                <p class="lg:w-1/2 w-full leading-relaxed text-gray-500">現在登録している選手を表示しています。</p>
            </div>
            <div class="flex flex-wrap -m-4">
                @foreach($athletes as $athlete)
                    <div class="xl:w-1/3 md:w-1/2 w-11/12 p-4 mx-auto">
                    {{-- <div class="xl:w-1/3 md:w-1/2 p-4 mx-auto"> --}}
                        <div class="bg-white border border-gray-200 p-6 rounded-lg min-w-500 shadow">

                            <h3 class="text-lg text-gray-900 font-medium title-font mb-2">{{ $athlete->name }}</h3>
                            <!-- 所属 -->
                            <div class="flex justify-start">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008z" />
                                </svg>
                                <p class="pl-1 leading-relaxed text-base">{{ $athlete->team }}</p>
                            </div>
                            <!-- 競技名 -->
                            <div class="flex justify-start">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5.25 5.653c0-.856.917-1.398 1.667-.986l11.54 6.348a1.125 1.125 0 010 1.971l-11.54 6.347a1.125 1.125 0 01-1.667-.985V5.653z" />
                                </svg>
                                <p class="pl-1 leading-relaxed text-base">{{ $athlete->event }}</p>
                            </div>
                            <!-- 種目・ポジション -->
                            <div class="flex justify-start">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5.25 5.653c0-.856.917-1.398 1.667-.986l11.54 6.348a1.125 1.125 0 010 1.971l-11.54 6.347a1.125 1.125 0 01-1.667-.985V5.653z" />
                                </svg>
                                <p class="pl-1 leading-relaxed text-base">{{ $athlete->event_detail }}</p>
                            </div>
                            <!-- 選手メニュー -->
                            <div class="athlete_menu">
                                <!-- 既往歴 -->
                                <a href="{{ route('doctor.medical-history.show.menu', ['athlete_id' => $athlete->id ])}}" class="">
                                    <button class="flex items-center mt-auto mb-1 text-white bg-gray-400 border-0 py-2 px-4 w-full focus:outline-none hover:bg-gray-500 rounded">既往歴
                                        <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 ml-auto" viewBox="0 0 24 24">
                                        <path d="M5 12h14M12 5l7 7-7 7"></path>
                                        </svg>
                                    </button>
                                </a>
                                <!-- 問診票・カルテ -->
                                <a href="{{ route('doctor.medical-questionnaire.show.menu', ['athlete_id' => $athlete->id ])}}">
                                    <button class="flex items-center mt-auto mb-1 text-white bg-gray-400 border-0 py-2 px-4 w-full focus:outline-none hover:bg-gray-500 rounded">問診票・カルテ
                                        <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 ml-auto" viewBox="0 0 24 24">
                                        <path d="M5 12h14M12 5l7 7-7 7"></path>
                                        </svg>
                                    </button>
                                </a>
                                <!-- 選手詳細 -->
                                <a href="{{ route('doctor.athlete.show', [ 'athlete_id' => $athlete->id ]) }}">
                                    <button class="flex items-center mt-auto mb-1 text-white bg-gray-400 border-0 py-2 px-4 w-full focus:outline-none hover:bg-gray-500 rounded">選手詳細
                                        <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 ml-auto" viewBox="0 0 24 24">
                                        <path d="M5 12h14M12 5l7 7-7 7"></path>
                                        </svg>
                                    </button>
                                </a>
                            </div>

                        </div>
                    </div>
                @endforeach
            </div>
            <!-- ページネーション -->
            @if (!empty($athletes))
                <div class="mx-auto mt-5">{{ $athletes->links() }}</div>
            @endif
        </div>
    </section>

</x-app-layout>
