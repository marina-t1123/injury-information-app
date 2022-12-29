<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-700 leading-tight text-center">
            問診票メニュー
        </h2>
    </x-slot>

    <!-- フラッシュメッセージ -->
    <x-flash-message status="info" />

    <div class="w-4/5 py-12 mx-auto">
        <div class="mx-auto">
            <p class="text-gray-500 text-center">{{ $athlete->name }}さんの問診票ページ</p>
        </div>

        <!-- 問診票新規作成 -->
        <div class="mx-auto my-4 text-center">
            <a href="{{ route('user.medical-questionnaire.create', ['athlete_id' => $athlete->id ])}}" class="text-white bg-blue-300 border-0 py-2 px-8 focus:outline-none hover:bg-blue-500 rounded text-lg">
                問診票新規作成
            </a>
        </div>

        <!-- 問診票一覧 -->
        <section class="text-gray-600 body-font">
            <div class="container px-5 py-14 mx-auto text-base">

                <div class="flex flex-col text-center w-full mb-5">
                    <h2 class="sm:text-3xl text-l font-medium title-font mb-4 text-gray-700">問診票一覧</h2>
                </div>

                <div class="flex flex-wrap -m-2">
                    @foreach($medicalQuestionnaires as $medicalQuestionnaire)
                    <div class="flex flex-column p-2 lg:w-1/2 w-full mx-auto">
                        {{-- <div class="h-full flex items-center border-gray-200 border p-4 rounded-lg"> --}}
                        <div class="h-full border-gray-200 border p-4 rounded-lg mx-auto">

                            <div>
                                <h2 class="text-gray-900 title-font font-medium">問診票ID:{{ $medicalQuestionnaire->id }}</h2>
                                <p class="text-gray-500">選手名：{{ $medicalQuestionnaire->athlete->name }}</p>
                                <p class="text-gray-500">受傷日：{{ $medicalQuestionnaire->injured_day }}</p>
                                <p class="text-gray-500">受傷部位：{{ $medicalQuestionnaire->injured_area}}</p>
                            </div>
                            <div class="flex-row mx-auto">
                                <a href="{{ route('user.medical-questionnaire.show', ['medical_questionnaire_id' => $medicalQuestionnaire->id ]) }}" class="text-white bg-gray-800 border-0 py-2 px-8 mt-5 focus:outline-none hover:bg-gray-700 rounded text-sm">
                                    詳細
                                </a>
                                <a href="{{ route('user.medical-questionnaire.edit', ['medical_questionnaire_id' => $medicalQuestionnaire->id ]) }}" class="text-white bg-gray-800 border-0 py-2 px-8 mt-5 focus:outline-none hover:bg-gray-700 rounded text-sm">
                                    編集
                                </a>
                                <a href="{{ route('user.medical-record.show', ['medical_questionnaire_id' => $medicalQuestionnaire->id ]) }}" class="text-white bg-gray-800 border-0 py-2 px-8 mt-5 focus:outline-none hover:bg-gray-700 rounded text-sm">
                                    カルテ詳細
                                </a>
                                <form id="delete_{{ $medicalQuestionnaire->id }}" method="post" action="{{ route('user.medical-questionnaire.destroy', ['medical_questionnaire_id' => $medicalQuestionnaire->id]) }}">
                                    @csrf
                                    <a href="#" data-id="{{ $medicalQuestionnaire->id }}" onclick="deleteMedicalQuestionnaire(this)" class="text-white bg-red-300 border-0 py-2 px-8 mt-5 focus:outline-none hover:bg-red-400 rounded text-sm">
                                        削除
                                    </a>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endforeach

                    <!-- ページネーション -->
                    <div class="mx-auto">{{ $medicalQuestionnaires->links() }}</div>
                </div>
            </div>
        </section>
        <!-- 削除時のメッセージ確認 -->
        <script>
            function deleteMedicalQuestionnaire(e){
                'use strict'
                if(confirm('本当に削除していいですか？')){
                    document.getElementById('delete_' + e.dataset.id).submit();
                }
            }
        </script>
    </div>
</x-app-layout>
