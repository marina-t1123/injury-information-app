<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-xl text-gray-700 leading-tight text-center">
            選手新規作成
        </h1>
    </x-slot>

    <section class="text-gray-600 body-font relative">
        <div class="container px-5 py-10 mx-auto">
            <div class="flex flex-col text-center w-full mb-12">
                <p class="lg:w-2/3 mx-auto leading-relaxed text-base">
                    下記フォームに必要事項を入力して、選手登録をしてください。
                </p>
            </div>
            <!-- 選手登録フォーム -->
            <div class="lg:w-1/2 md:w-2/3 mx-auto">
                <!-- エラーメッセージ -->
                <x-auth-validation-errors class="mb-4" :errors="$errors" />

                <form metod="post" action="{{ route('user.athlete.store') }}">
                    @csrf
                    <div class="-m-2">
                        <!-- 選手名 -->
                        <div class="p-2 w-3/4 mx-auto">
                            <div class="relative">
                            <label for="name" class="leading-7 text-sm text-gray-600">
                                名前
                            </label>
                            <input type="text" id="name" name="name" value="{{ old('name') }}" class="w-full bg-white bg-opacity-50 rounded border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                            </div>
                        </div>
                        <!-- Eメール -->
                        <div class="p-2 w-3/4 mx-auto">
                            <div class="relative">
                            <label for="email" class="leading-7 text-sm text-gray-600">
                                Eメール
                            </label>
                            <input type="email" id="email" name="email" value="{{ old('email') }}" class="w-full bg-white bg-opacity-50 rounded border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                            </div>
                        </div>
                        <!-- 電話番号 -->
                        <div class="p-2 w-3/4 mx-auto">
                            <div class="relative">
                            <label for="phone_number" class="leading-7 text-sm text-gray-600">
                                電話番号
                            </label>
                            <input type="phone_number" id="phone_number" name="phone_number" value="{{ old('phone_number') }}" class="w-full bg-white bg-opacity-50 rounded border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                            </div>
                        </div>
                        <!-- ボタン -->
                        <div class="p-2 flex flex-col w-2/4 mt-8 mx-auto">
                            <button type="submit" class="text-white bg-gray-600 border-0 py-2 px-8 focus:outline-none hover:bg-gray-500 rounded text-lg">
                                登録する
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
