<div class="w-full mx-auto">

    <!-- 本日受診の選手の問診票一覧 -->
    <section class="text-gray-600 body-font">
        <div class="container px-5 py-24 mx-auto">
            <div class="flex flex-col text-center w-full mb-5">
                <h3 class="sm:text-3xl text-l font-medium title-font mb-4 text-gray-700">受診選手の問診票一覧</h3>
                <p>{{ $today }}の受診する選手の問診票一覧</p>
                @if(empty($todayMedicalQuestionnaires))
                    <p class="mt-5">本日受診する選手はいません。</p>
                @endif
            </div>

            <!-- 問診票一覧  -->
            <div class="flex flex-wrap -m-4">
                <div class="lg:w-3/6 md:w-2/3 w-full p-4 mx-auto">
                @foreach($todayMedicalQuestionnaires as $todayMedicalQuestionnaire)
                    <div class="bg-white border border-gray-200 p-6 rounded-lg min-w-500 shadow">
                        <h3 class="text-lg text-gray-900 font-medium title-font mb-2">{{ $todayMedicalQuestionnaire->name }}</h3>
                        <!-- 担当医 -->
                        <div class="flex justify-start">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <p class="pl-1 leading-relaxed text-base">{{ $todayMedicalQuestionnaire->attending_physician }}先生</p>
                        </div>
                        <!-- 受傷日 -->
                        <div class="flex justify-start">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5m-9-6h.008v.008H12v-.008zM12 15h.008v.008H12V15zm0 2.25h.008v.008H12v-.008zM9.75 15h.008v.008H9.75V15zm0 2.25h.008v.008H9.75v-.008zM7.5 15h.008v.008H7.5V15zm0 2.25h.008v.008H7.5v-.008zm6.75-4.5h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V15zm0 2.25h.008v.008h-.008v-.008zm2.25-4.5h.008v.008H16.5v-.008zm0 2.25h.008v.008H16.5V15z" />
                            </svg>
                            <p class="pl-1 leading-relaxed text-base">{{ $todayMedicalQuestionnaire->injured_day}}</p>
                        </div>
                        <!-- 受傷部位 -->
                        <div class="flex justify-start">
                            <p class="pl-1 leading-relaxed text-base">受傷部位：{{ $todayMedicalQuestionnaire->injured_area}}</p>
                        </div>
                        <!-- 選手メニュー -->
                        <div class="athlete_menu">
                            @if(request()->is('doctor*'))
                                <!-- 既往歴 -->
                                <a href="{{ route('doctor.medical-history.show.menu', ['athlete_id' => $todayMedicalQuestionnaire->athlete_id ])}}" class="">
                                    <button class="flex items-center mt-auto mb-1 text-sm text-white bg-gray-400 border-0 py-2 px-4 w-full focus:outline-none hover:bg-gray-500 rounded">既往歴
                                        <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 ml-auto" viewBox="0 0 24 24">
                                        <path d="M5 12h14M12 5l7 7-7 7"></path>
                                        </svg>
                                    </button>
                                </a>
                                <!-- 問診票・カルテ詳細 -->
                                <a href="{{ route('doctor.medical-questionnaire.show.menu', ['athlete_id' => $todayMedicalQuestionnaire->athlete_id ])}}">
                                    <button class="flex items-center mt-auto mb-1 text-sm text-white bg-gray-400 border-0 py-2 px-4 w-full focus:outline-none hover:bg-gray-500 rounded">問診票・カルテ
                                        <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 ml-auto" viewBox="0 0 24 24">
                                        <path d="M5 12h14M12 5l7 7-7 7"></path>
                                        </svg>
                                    </button>
                                </a>
                                <!-- 選手設定 -->
                                <a href="{{ route('doctor.athlete.show', [ 'athlete_id' => $todayMedicalQuestionnaire->athlete_id ]) }}">
                                    <button class="flex items-center mt-auto mb-1 text-sm text-white bg-gray-400 border-0 py-2 px-4 w-full focus:outline-none hover:bg-gray-500 rounded">選手設定
                                        <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 ml-auto" viewBox="0 0 24 24">
                                        <path d="M5 12h14M12 5l7 7-7 7"></path>
                                        </svg>
                                    </button>
                                </a>
                            @else
                                <!-- 既往歴 -->
                                <a href="{{ route('user.medical-history.show.menu', ['athlete_id' => $todayMedicalQuestionnaire->athlete_id ])}}" class="">
                                    <button class="flex items-center mt-auto mb-1 text-sm text-white bg-gray-400 border-0 py-2 px-4 w-full focus:outline-none hover:bg-gray-500 rounded">既往歴
                                        <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 ml-auto" viewBox="0 0 24 24">
                                        <path d="M5 12h14M12 5l7 7-7 7"></path>
                                        </svg>
                                    </button>
                                </a>
                                <!-- 問診票・カルテ詳細 -->
                                <a href="{{ route('user.medical-questionnaire.show.menu', ['athlete_id' => $todayMedicalQuestionnaire->athlete_id ])}}">
                                    <button class="flex items-center mt-auto mb-1 text-sm text-white bg-gray-400 border-0 py-2 px-4 w-full focus:outline-none hover:bg-gray-500 rounded">問診票・カルテ
                                        <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 ml-auto" viewBox="0 0 24 24">
                                        <path d="M5 12h14M12 5l7 7-7 7"></path>
                                        </svg>
                                    </button>
                                </a>
                                <!-- 選手設定 -->
                                <a href="{{ route('user.athlete.show.setting', [ 'athlete_id' => $todayMedicalQuestionnaire->athlete_id ]) }}">
                                    <button class="flex items-center mt-auto mb-1 text-sm text-white bg-gray-400 border-0 py-2 px-4 w-full focus:outline-none hover:bg-gray-500 rounded">選手設定
                                        <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 ml-auto" viewBox="0 0 24 24">
                                        <path d="M5 12h14M12 5l7 7-7 7"></path>
                                        </svg>
                                    </button>
                                </a>
                            @endif
                        </div>
                    </div>
                @endforeach
                </div>
            </div>
            <!-- ページネーション -->

                <div class="mx-auto mt-5">{{ $todayMedicalQuestionnaires->links() }}</div>
        </div>
    </section>

</div>
