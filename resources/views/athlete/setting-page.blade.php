<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-xl text-gray-700 leading-tight text-center">
            選手設定メニュー
        </h1>
    </x-slot>

    <!-- フラッシュメッセージ -->
    <x-flash-message status="info" />

    <section class="text-gray-600 body-font">
        <div class="container px-5 py-24 mx-auto">
            @if (request()->is('doctor*'))
                <!-- 選手情報 -->
                <div class="flex items-center lg:w-3/5 mx-auto border-b pb-10 mb-10 border-gray-200 sm:flex-row flex-col">
                    <div class="flex-grow sm:text-left text-center mt-6 sm:mt-0">
                        <h2 class="text-gray-900 text-lg title-font font-medium mb-2 mx-auto">
                            選手情報
                        </h2>
                        <p>選手ID： {{$athlete->id}}</p>
                        <p>名前： {{ $athlete->name }}</p>
                        <p>Email： {{ $athlete->email }}</p>
                        <p>電話番号： {{ $athlete->phone_number }}</p>
                        <p>所属： {{ $athlete->team }}</p>
                        <p>競技名： {{ $athlete->event }}</p>
                        <p>種目・ポジション： {{ $athlete->event_detail }}</p>
                        <p>経歴： {{ $athlete->career }}</p>
                    </div>
                </div>
            @else
                <!-- 選手情報 -->
                <div class="flex items-center lg:w-3/5 mx-auto border-b pb-10 mb-10 border-gray-200 sm:flex-row flex-col">
                    <div class="flex-grow sm:text-left text-center mt-6 sm:mt-0">
                        <h2 class="text-gray-900 text-lg title-font font-medium mb-2 mx-auto">
                            選手情報
                        </h2>
                        <p>選手ID： {{$athlete->id}}</p>
                        <p>名前： {{ $athlete->name }}</p>
                        <p>Email： {{ $athlete->email }}</p>
                        <p>電話番号： {{ $athlete->phone_number }}</p>
                        <p>所属： {{ $athlete->team }}</p>
                        <p>競技名： {{ $athlete->event }}</p>
                        <p>種目・ポジション： {{ $athlete->event_detail }}</p>
                        <p>経歴： {{ $athlete->career }}</p>
                    </div>
                </div>
                <!-- 選手情報編集 -->
                <div class="flex items-center lg:w-3/5 mx-auto border-b pb-10 mb-10 border-gray-200 sm:flex-row flex-col">
                    <div class="flex-grow sm:text-left text-center mt-6 sm:mt-0">
                        <h2 class="text-gray-900 text-lg title-font font-medium mb-2 mx-auto">
                            選手情報編集
                        </h2>
                        <p class="leading-relaxed text-base">
                            {{$athlete->name}}さんの選手情報を編集します。
                        </p>
                        <form method="get" action="{{ route('user.athlete.edit', ['athlete_id' => $athlete->id]) }}">
                            <button type="submit" class="mt-3 text-blue-300 inline-flex items-center hover:text-blue-500">
                                編集する
                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 ml-2" viewBox="0 0 24 24">
                                <path d="M5 12h14M12 5l7 7-7 7"></path>
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
                <!-- 選手削除 -->
                <div class="flex items-center lg:w-3/5 mx-auto sm:flex-row flex-col">
                    <div class="flex-grow sm:text-left text-center mt-6 sm:mt-0">
                        <h2 class="text-gray-900 text-lg title-font font-medium mb-2">
                            アカウント削除
                        </h2>
                        <p class="leading-relaxed text-base">
                            {{$athlete->name}}さんに関連する選手情報・既往歴・問診票・カルテとアカウントを削除します。
                        </p>
                        <form id="delete_{{ $athlete->id }}" method="post" action="{{ route('user.athlete.destroy', ['athlete_id' => $athlete->id]) }}">
                            @csrf
                            <a href="#" data-id="{{ $athlete->id }}" onclick="deleteAthlete(this)" class="mt-3 text-red-300 inline-flex items-center hover:text-red-500">
                                削除する
                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 ml-2" viewBox="0 0 24 24">
                                <path d="M5 12h14M12 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </form>
                    </div>
                </div>
            @endif
            <!-- マイページボタン -->
            <x-mypage-button />
        </div>
    </section>
    <!-- 確認メッセージ -->
    <script>
        function deleteAthlete(e){
            'use strict'
            if(confirm('本当に削除していいですか？')){
                document.getElementById('delete_' + e.dataset.id).submit()
            }
        }
    </script>
</x-app-layout>
