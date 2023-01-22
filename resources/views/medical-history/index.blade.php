<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-700 leading-tight text-center">
            既往歴一覧
        </h2>
    </x-slot>

    <!-- フラッシュメッセージ -->
    <x-flash-message status="info" />

    <div class="w-11/12 mx-auto mt-6">
        <div class="mx-auto">
            <p class="text-gray-500 text-center">全ての登録済みの既往歴を表示しています。</p>
        </div>

        <!-- 既往歴一覧 -->
        <section class="text-gray-600 body-font">
            <div class="container px-5 py-24 mx-auto">
                <div class="flex flex-col text-center w-full mb-5">
                    <h3 class="sm:text-3xl text-l font-medium title-font mb-4 text-gray-700">既往歴一覧</h3>
                </div>

                <div class="flex flex-wrap -m-4">
                    @foreach($medicalHistories as $medicalHistory)
                        <div class="xl:w-1/3 md:w-1/2 w-11/12 mx-auto">
                        {{-- <div class="xl:w-1/3 md:w-1/2 p-4 mx-auto"> --}}
                            <div class="bg-white border border-gray-200 p-6 m-2 rounded-lg min-w-500 shadow">

                                {{-- <h3 class="text-lg text-gray-900 font-medium title-font mb-2">{{ $medicalHistory->name }}</h3> --}}
                                <!-- 既往歴ID -->
                                <div class="flex justify-start">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 7.5V6.108c0-1.135.845-2.098 1.976-2.192.373-.03.748-.057 1.123-.08M15.75 18H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08M15.75 18.75v-1.875a3.375 3.375 0 00-3.375-3.375h-1.5a1.125 1.125 0 01-1.125-1.125v-1.5A3.375 3.375 0 006.375 7.5H5.25m11.9-3.664A2.251 2.251 0 0015 2.25h-1.5a2.251 2.251 0 00-2.15 1.586m5.8 0c.065.21.1.433.1.664v.75h-6V4.5c0-.231.035-.454.1-.664M6.75 7.5H4.875c-.621 0-1.125.504-1.125 1.125v12c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V16.5a9 9 0 00-9-9z" />
                                    </svg>
                                    <p class="pl-1 leading-relaxed text-base">ID：{{ $medicalHistory->id }}</p>
                                </div>
                                <!-- 受傷日 -->
                                <div class="flex justify-start">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5m-9-6h.008v.008H12v-.008zM12 15h.008v.008H12V15zm0 2.25h.008v.008H12v-.008zM9.75 15h.008v.008H9.75V15zm0 2.25h.008v.008H9.75v-.008zM7.5 15h.008v.008H7.5V15zm0 2.25h.008v.008H7.5v-.008zm6.75-4.5h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V15zm0 2.25h.008v.008h-.008v-.008zm2.25-4.5h.008v.008H16.5v-.008zm0 2.25h.008v.008H16.5V15z" />
                                    </svg>
                                    <p class="pl-1 leading-relaxed text-base">{{ $medicalHistory->injured_day}}</p>
                                </div>
                                <!-- 受傷部位 -->
                                <div class="flex justify-start">
                                    <p class="text-gray-500">受傷部位：{{ $medicalHistory->injured_area }}</p>
                                </div>
                                <!-- 診断名 -->
                                <div class="flex justify-start">
                                    <p class="text-gray-500">診断名：{{ $medicalHistory->diagnosis }}</p>
                                </div>
                                <!-- 既往歴メニュー -->
                                <div class="medical_history_menu">
                                    @if (request()->is('doctor*'))
                                        <!-- 既往歴詳細 -->
                                        <a href="{{ route('doctor.medical-history.show', ['medical_history_id' => $medicalHistory->id ])}}" class="">
                                            <button class="flex items-center mt-auto mb-1 text-white bg-gray-400 border-0 py-2 px-4 w-full focus:outline-none hover:bg-gray-500 rounded">既往歴詳細
                                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 ml-auto" viewBox="0 0 24 24">
                                                <path d="M5 12h14M12 5l7 7-7 7"></path>
                                                </svg>
                                            </button>
                                        </a>
                                    @else
                                        <!-- 既往歴詳細 -->
                                        <a href="{{ route('user.medical-history.show', ['medical_history_id' => $medicalHistory->id ]) }}" class="">
                                            <button class="flex items-center mt-auto mb-1 text-white bg-gray-400 border-0 py-2 px-4 w-full focus:outline-none hover:bg-gray-500 rounded">既往歴詳細
                                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 ml-auto" viewBox="0 0 24 24">
                                                <path d="M5 12h14M12 5l7 7-7 7"></path>
                                                </svg>
                                            </button>
                                        </a>
                                        <!-- 既往歴編集 -->
                                        <a href="{{ route('user.medical-history.edit', ['medical_history_id' => $medicalHistory->id ]) }}">
                                            <button class="flex items-center mt-auto mb-1 text-white bg-gray-400 border-0 py-2 px-4 w-full focus:outline-none hover:bg-gray-500 rounded">既往歴編集
                                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 ml-auto" viewBox="0 0 24 24">
                                                <path d="M5 12h14M12 5l7 7-7 7"></path>
                                                </svg>
                                            </button>
                                        </a>
                                        <!-- 既往歴削除 -->
                                        <form id="delete_{{ $medicalHistory->id }}" method="post" action="{{ route('user.medical-history.destroy', ['medical_history_id' => $medicalHistory->id]) }}">
                                            @csrf
                                            <a href="#" data-id="{{ $medicalHistory->id }}" onclick="deleteMedicalHistory(this)">
                                                <button class="flex items-center mt-auto mb-1 text-white bg-red-400 border-0 py-2 px-4 w-full focus:outline-none hover:bg-red-500 rounded">削除
                                                    <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 ml-auto" viewBox="0 0 24 24">
                                                    <path d="M5 12h14M12 5l7 7-7 7"></path>
                                                    </svg>
                                                </button>
                                            </a>
                                        </form>
                                    @endif
                                </div>

                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- ページネーション -->
                @if (!empty($medicalHistorys))
                    <div class="mx-auto mt-5">{{ $medicalHistorys->links() }}</div>
                @endif

            </div>
            <!-- マイページボタン -->
            @if (request()->is('doctor*'))
                <div class="mx-auto mt-5 text-center">
                    <a href="{{ route('doctor.mypage')}}" class="text-white bg-gray-600 border-0 py-2 px-8 mt-5 focus:outline-none hover:bg-gray-500 rounded text-sm">マイページ</a>
                </div>
            @else
                <div class="mx-auto mt-5 text-center">
                    <a href="{{ route('user.mypage')}}" class="text-white bg-gray-600 border-0 py-2 px-8 mt-5 focus:outline-none hover:bg-gray-500 rounded text-sm">マイページ</a>
                </div>
            @endif
        </section>
        <!-- 削除時のメッセージ確認 -->
        <script>
            function deleteMedicalHistory(e){
                'use strict'
                if(confirm('本当に削除していいですか？')){
                    document.getElementById('delete_' + e.dataset.id).submit();
                }
            }
        </script>
    </div>
</x-app-layout>
