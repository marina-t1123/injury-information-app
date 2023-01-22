<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-xl text-gray-700 leading-tight text-center">
            選手詳細情報ページ
        </h1>
    </x-slot>

    <section class="text-gray-600 body-font">
        <div class="container px-5 py-24 mx-auto">
            <!-- 選手詳細情報 -->
            <div class="flex items-center lg:w-3/5 mx-auto border-b pd-10 mb-10 border-gray-200 sm:flex-row flex-col">
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
            <!-- マイページ -->
            <x-mypage-button></x-mypage-button>
        </div>
    </section>
</x-app-layout>
