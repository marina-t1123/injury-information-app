<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-700 leading-tight text-center">
            既往歴メニュー
        </h2>
    </x-slot>

    <!-- フラッシュメッセージ -->
    <x-flash-message status="info" />

    <div class="w-4/5 py-12 mx-auto">
        <div class="mx-auto">
            <p class="text-gray-500 text-center">{{ $athlete->name }}さんの既往歴ページ</p>
        </div>

        <!-- 既往歴新規作成 -->
        <div class="mx-auto my-4 text-center">
            <a href="{{ route('user.medical-history.create', ['athlete_id' => $athlete->id ])}}" class="text-white bg-blue-300 border-0 py-2 px-8 focus:outline-none hover:bg-blue-500 rounded text-lg">
                既往歴新規作成
            </a>
        </div>

        <!-- 既往歴検索 -->
        {{-- <div class="w-4/5 h-70 bg-gray-300 mx-auto rounded-lg mt-9 flex justify-center">
            <x-medical-history-search-form></x-medical-history-search-form>
        </div> --}}

        <!-- 選手一覧 -->
        <section class="text-gray-600 body-font">
            <div class="container px-5 py-14 mx-auto text-base">

                <div class="flex flex-col text-center w-full mb-5">
                    <h2 class="sm:text-3xl text-l font-medium title-font mb-4 text-gray-700">既往歴一覧</h2>
                </div>

                <div class="flex flex-wrap -m-2">
                    @foreach($medicalHistories as $medicalHistory)
                    <div class="flex flex-column p-2 lg:w-1/2 w-full mx-auto">
                        {{-- <div class="h-full flex items-center border-gray-200 border p-4 rounded-lg"> --}}
                        <div class="h-full border-gray-200 border p-4 rounded-lg mx-auto">

                            <div>
                                <h2 class="text-gray-900 title-font font-medium">既往歴ID:{{ $medicalHistory->id }}</h2>
                                <p class="text-gray-500">受傷日：{{ $medicalHistory->injured_day }}</p>
                                <p class="text-gray-500">受傷部位：{{ $medicalHistory->injured_area }}</p>
                                <p class="text-gray-500">診断名：{{ $medicalHistory->diagnosis }}</p>
                            </div>
                            <div class="flex-row mx-auto">
                                <a href="{{ route('user.medical-history.show', ['medical_history_id' => $medicalHistory->id ])}}" class="text-white bg-gray-800 border-0 py-2 px-8 mt-5 focus:outline-none hover:bg-gray-700 rounded text-sm">
                                    詳細
                                </a>
                                <a href="{{ route('user.medical-history.edit', ['medical_history_id' => $medicalHistory->id ])}}" class="text-white bg-gray-800 border-0 py-2 px-8 mt-5 focus:outline-none hover:bg-gray-700 rounded text-sm">
                                    編集
                                </a>
                                <form id="delete_{{ $medicalHistory->id }}" method="post" action="{{ route('user.medical-history.destroy', ['medical_history_id' => $medicalHistory->id]) }}">
                                    @csrf
                                    <a href="#" data-id="{{ $medicalHistory->id }}" onclick="deleteMedicalHistory(this)" class="text-white bg-red-300 border-0 py-2 px-8 mt-5 focus:outline-none hover:bg-red-400 rounded text-sm">
                                        削除
                                    </a>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endforeach

                    <!-- ページネーション -->
                    <div class="mx-auto">{{ $medicalHistories->links() }}</div>
                </div>
            </div>
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
