<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-xl text-gray-700 leading-tight text-center">
            選手編集
        </h1>
    </x-slot>

    <section class="text-gray-600 body-font relative">
        <div class="container px-5 py-10 mx-auto">
            <div class="flex flex-col text-center w-full mb-12">
                <p class="lg:w-2/3 mx-auto leading-relaxed text-base">
                    下記フォームに編集する項目を入力して、登録内容の変更をしてください。
                </p>
            </div>
            <!-- 選手登録フォーム -->
            <div class="lg:w-1/2 md:w-2/3 mx-auto">
                <!-- エラーメッセージ -->
                <x-auth-validation-errors class="mb-4" :errors="$errors" />

                <form method="post" action="{{ route('user.athlete.update', ['athlete_id' => $athlete->id]) }}">
                    @csrf
                    <div class="-m-2">
                        <!-- 選手名 -->
                        <div class="p-2 w-3/4 mx-auto">
                            <div class="relative">
                            <label for="name" class="leading-7 text-sm text-gray-600">
                                名前
                            </label>
                            <input type="text" id="name" name="name" value="{{ $athlete->name }}" class="w-full bg-white bg-opacity-50 rounded border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                            </div>
                        </div>
                        <!-- Eメール -->
                        <div class="p-2 w-3/4 mx-auto">
                            <div class="relative">
                            <label for="email" class="leading-7 text-sm text-gray-600">
                                Eメール
                            </label>
                            <input type="email" id="email" name="email" value="{{ $athlete->email }}" placeholder="test@test.com" class="w-full bg-white bg-opacity-50 rounded border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                            </div>
                        </div>
                        <!-- 電話番号 -->
                        <div class="p-2 w-3/4 mx-auto">
                            <div class="relative">
                            <label for="phone_number" class="leading-7 text-sm text-gray-600">
                                電話番号
                            </label>
                            <input type="string" id="phone_number" name="phone_number" value="{{ $athlete->phone_number }}" placeholder="00-0000-0000 or 000-0000-0000" class="w-full bg-white bg-opacity-50 rounded border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                            </div>
                        </div>
                        <!-- 所属 -->
                        <div class="p-2 w-3/4 mx-auto">
                            <div class="relative">
                            <label for="team" class="leading-7 text-sm text-gray-600">
                                所属名
                            </label>
                            <input type="string" id="team" name="team" value="{{ $athlete->team }}" class="w-full bg-white bg-opacity-50 rounded border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                            </div>
                        </div>
                        <!-- 競技名 -->
                        <div class="p-2 w-3/4 mx-auto">
                            <div class="relative">
                            <label for="event" class="leading-7 text-sm text-gray-600">
                                競技名
                            </label>
                            <input type="string" id="event" name="event" value="{{ $athlete->event }}" class="w-full bg-white bg-opacity-50 rounded border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                            </div>
                        </div>
                        <!-- 種目・ポジション -->
                        <div class="p-2 w-3/4 mx-auto">
                            <div class="relative">
                            <label for="event_detail" class="leading-7 text-sm text-gray-600">
                                種目・ポジション
                            </label>
                            <input type="string" id="event_detail" name="event_detail" value="{{ $athlete->event_detail }}" class="w-full bg-white bg-opacity-50 rounded border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                            </div>
                        </div>
                        <!-- 経歴 -->
                        <div class="p-2 w-3/4 mx-auto">
                            <div class="relative">
                            <label for="career" class="leading-7 text-sm text-gray-600">
                                経歴
                            </label>
                            <textarea id="career" name="career" class="w-full bg-white bg-opacity-50 rounded border border-gray-300 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-200 h-32 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out">{{ $athlete->career }}</textarea>
                            {{-- <textarea id="career" name="career" value="{{ $athlete->career }}" class="w-full bg-white bg-opacity-50 rounded border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"></textarea> --}}
                            </div>
                        </div>
                        <!-- ボタン -->
                        <div class="p-2 flex flex-col w-2/4 mt-8 mx-auto">
                            <button type="submit" id="button" class="h-20 text-white bg-gray-600 border-0 py-2 px-8 focus:outline-none hover:bg-gray-500 rounded text-lg">
                                送信
                            </button>
                            <button type="button" onclick="location.href='{{ route('user.mypage') }}'" class="text-white bg-gray-800 border-0 py-2 px-8 mt-5 focus:outline-none hover:bg-gray-700 rounded text-lg">
                                戻る
                            </button>
                            <!-- aタグは使用しないでonclickを使用する -->
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
</x-app-layout>
