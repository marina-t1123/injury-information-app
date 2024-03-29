<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-xl text-gray-700 leading-tight text-center">
            ドクター詳細編集
        </h1>
    </x-slot>

    <section class="text-gray-600 body-font relative">
        <div class="container px-5 py-10 mx-auto">
            <div class="flex flex-col text-center w-full mb-12">
                <p class="lg:w-2/3 mx-auto leading-relaxed text-base">
                    {{ $doctor->name }}さんの詳細情報の編集を行います。
                </p>
            </div>
            <!-- ドクター詳細編集フォーム -->
            <div class="lg:w-1/2 md:w-2/3 mx-auto">
                <!-- エラーメッセージ -->
                <x-auth-validation-errors class="mb-4" :errors="$errors" />

                <form method="post" action="{{ route('doctor.doctor-attribute.update', ['id' => $doctor->id ]) }}">
                    @csrf
                    <div class="-m-2">
                        <!-- 名前 -->
                        <div class="p-2 w-3/4 mx-auto">
                            <div class="relative">
                            <label for="name" class="leading-7 text-sm text-gray-600">
                                名前
                            </label>
                            <input type="text" id="name" name="name" value="{{ $doctor->name }}" class="w-full bg-white bg-opacity-50 rounded border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                            </div>
                        </div>
                        <!-- 病院名 -->
                        <div class="p-2 w-3/4 mx-auto">
                            <div class="relative">
                            <label for="hospital_name" class="leading-7 text-sm text-gray-600">
                                病院名
                            </label>
                            <input type="text" id="hospital_name" name="hospital_name" value="{{ $doctor->doctorAttribute->hospital_name }}" class="w-full bg-white bg-opacity-50 rounded border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                            </div>
                        </div>
                        <!-- 電話番号 -->
                        <div class="p-2 w-3/4 mx-auto">
                            <div class="relative">
                            <label for="phone_number" class="leading-7 text-sm text-gray-600">
                                電話番号
                            </label>
                            <input type="tel" id="phone_number" name="phone_number" value="{{ $doctor->doctorAttribute->phone_number }}" class="w-full bg-white bg-opacity-50 rounded border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                            </div>
                        </div>
                        <!-- 専門分野 -->
                        <div class="p-2 w-3/4 mx-auto">
                            <div class="relative">
                            <label for="particular_field" class="leading-7 text-sm text-gray-600">
                                専門分野
                            </label>
                            <textarea id="particular_field" name="particular_field" class="w-full bg-white bg-opacity-50 rounded border border-gray-300 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-200 h-32 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out">{{ $doctor->doctorAttribute->particular_field }}</textarea>
                            </div>
                        </div>
                        <!-- 経歴 -->
                        <div class="p-2 w-3/4 mx-auto">
                            <div class="relative">
                            <label for="career" class="leading-7 text-sm text-gray-600">
                                経歴
                            </label>
                            <textarea id="career" name="career" class="w-full bg-white bg-opacity-50 rounded border border-gray-300 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-200 h-32 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out">{{ $doctor->doctorAttribute->career }}</textarea>
                            </div>
                        </div>
                        <!-- ボタン -->
                        <div class="p-2 flex flex-col w-2/4 mt-8 mx-auto">
                            <button type="submit" id="button" class="text-white bg-gray-600 border-0 py-2 px-8 focus:outline-none hover:bg-gray-500 rounded text-lg">
                                送信
                            </button>
                            <a href="{{ route('doctor.doctor-attribute.menu', ['id' => $doctor->id ]) }}" class="text-center text-white bg-gray-800 border-0 py-2 px-8 mt-5 focus:outline-none hover:bg-gray-700 rounded text-lg">
                                戻る
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
</x-app-layout>
