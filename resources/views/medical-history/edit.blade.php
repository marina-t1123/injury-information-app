<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-xl text-gray-700 leading-tight text-center">
            既往歴編集
        </h1>
    </x-slot>

    <section class="text-gray-600 body-font relative">
        <div class="container px-5 py-10 mx-auto">
            <div class="flex flex-col text-center w-full mb-12">
                <p class="lg:w-2/3 mx-auto leading-relaxed text-base">
                    {{ $medicalHistory->athlete->name }}さんの既往歴の編集を行います。
                </p>
            </div>
            <!-- 既往歴登録フォーム -->
            <div class="lg:w-1/2 md:w-2/3 mx-auto">
                <!-- エラーメッセージ -->
                <x-auth-validation-errors class="mb-4" :errors="$errors" />

                <form method="post" action="{{ route('user.medical-history.update', ['medical_history_id' => $medicalHistory->id ]) }}">
                    @csrf
                    <div class="-m-2">
                        <!-- 受傷日 -->
                        <div class="p-2 w-3/4 mx-auto">
                            <div class="relative">
                            <label for="injured_day" class="leading-7 text-sm text-gray-600">
                                受傷日
                            </label>
                            <input type="date" id="injured_day" name="injured_day" value="{{ $medicalHistory->injured_day }}" class="w-full bg-white bg-opacity-50 rounded border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                            </div>
                        </div>
                        <!-- 受傷部位 -->
                        <div class="p-2 w-3/4 mx-auto">
                            <div class="relative">
                            <label for="injured_area" class="leading-7 text-sm text-gray-600">
                                受傷部位
                            </label>
                            <input type="text" id="injured_area" name="injured_area" value="{{ $medicalHistory->injured_area }}" class="w-full bg-white bg-opacity-50 rounded border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                            </div>
                        </div>
                        <!-- 受傷状況 -->
                        <div class="p-2 w-3/4 mx-auto">
                            <div class="relative">
                            <label for="injury_status" class="leading-7 text-sm text-gray-600">
                                受傷状況
                            </label>
                            <textarea id="injury_status" name="injury_status" class="w-full bg-white bg-opacity-50 rounded border border-gray-300 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-200 h-32 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out">{{ $medicalHistory->injury_status }}</textarea>
                            </div>
                        </div>
                        <!-- 応急処置 -->
                        <div class="p-2 w-3/4 mx-auto">
                            <div class="relative">
                            <label for="first_aid" class="leading-7 text-sm text-gray-600">
                                応急処置
                            </label>
                            <textarea id="first_aid" name="first_aid" class="w-full bg-white bg-opacity-50 rounded border border-gray-300 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-200 h-32 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out">{{ $medicalHistory->first_aid }}</textarea>
                            </div>
                        </div>
                        <!-- 病院受診の有無 -->
                        <div class="p-2 w-3/4 mx-auto">
                            <div class="relative">
                            <label for="hospital_visit" class="leading-7 text-sm text-gray-600">
                                病院受診の有無
                            </label><br>
                            <input type="radio" name="hospital_visit" value="0" @if($medicalHistory->hospital_visit == 0) checked @endif>なし
                            <input type="radio" name="hospital_visit" value="1" @if($medicalHistory->hospital_visit == 1) checked @endif>あり
                            </div>
                        </div>
                        <!-- 診断名 -->
                        <div class="p-2 w-3/4 mx-auto">
                            <div class="relative">
                            <label for="diagnosis" class="leading-7 text-sm text-gray-600">
                                診断名
                            </label>
                            <textarea id="diagnosis" name="diagnosis" class="w-full bg-white bg-opacity-50 rounded border border-gray-300 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-200 h-32 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out">{{ $medicalHistory->diagnosis }}</textarea>
                            </div>
                        </div>
                        <!-- 現在の状況 -->
                        <div class="p-2 w-3/4 mx-auto">
                            <div class="relative">
                            <label for="current_situation" class="leading-7 text-sm text-gray-600">
                                現在の状況
                            </label>
                            <textarea id="current_situation" name="current_situation" class="w-full bg-white bg-opacity-50 rounded border border-gray-300 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-200 h-32 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out">{{ $medicalHistory->current_situation }}</textarea>
                            </div>
                        </div>
                        <!-- ボタン -->
                        <div class="p-2 flex flex-col w-2/4 mt-8 mx-auto">
                            <button type="submit" id="button" class="text-white bg-gray-600 border-0 py-2 px-8 focus:outline-none hover:bg-gray-500 rounded text-lg">
                                送信
                            </button>
                            <a href="{{ route('user.medical-history.show.menu', ['athlete_id' => $medicalHistory->athlete_id ]) }}" class="text-center text-white bg-gray-800 border-0 py-2 px-8 mt-5 focus:outline-none hover:bg-gray-700 rounded text-lg">
                                戻る
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
</x-app-layout>
