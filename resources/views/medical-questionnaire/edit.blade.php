<x-app-layout>
    <x-slot name=header>
        <h1 class="font-semibold text=xl text-gray-700 leading-tight text-center">
            問診票編集画面
        </h1>
    </x-slot>

    <section class="text-gray-600 body-font relative">
        <div class="container px-5 py-10 mx-auto">
            <div class="flex flex-col text-center w-full mb-12">
                <p class="lg:w-2/3 mx-auto leading-relaxed text-base">
                    {{ $medicalQuestionnaire->athlete->name }}さんの問診票の編集を行います。
                </p>
            </div>
            <!-- 既往歴登録フォーム -->
            <div class="lg:w-1/2 md:w-2/3 mx-auto">
                <!-- エラーメッセージ -->
                <x-auth-validation-errors class="mb-4" :errors="$errors" />

                <form method="post" action="{{ route('user.medical-questionnaire.update', ['medical_questionnaire_id' => $medicalQuestionnaire->id ]) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="-m-2">
                        <!-- 受傷日 -->
                        <div class="p-2 w-3/4 mx-auto">
                            <div class="relative">
                            <label for="injured_day" class="leading-7 text-sm text-gray-600">
                                受傷日
                            </label>
                            <input type="date" id="injured_day" name="injured_day" value="{{ $medicalQuestionnaire->injured_day }}" class="w-full bg-white bg-opacity-50 rounded border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                            </div>
                        </div>
                        <!-- 受傷部位 -->
                        <div class="p-2 w-3/4 mx-auto">
                            <div class="relative">
                            <label for="injured_area" class="leading-7 text-sm text-gray-600">
                                受傷部位
                            </label>
                            <input type="string" id="injured_area" name="injured_area" value="{{ $medicalQuestionnaire->injured_area }}" class="w-full bg-white bg-opacity-50 rounded border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                            </div>
                        </div>
                        <!-- 受傷状況 -->
                        <div class="p-2 w-3/4 mx-auto">
                            <div class="relative">
                            <label for="injury_status" class="leading-7 text-sm text-gray-600">
                                受傷状況
                            </label>
                            <textarea id="injury_status" name="injury_status" cols='10' class="w-full bg-white bg-opacity-50 rounded border border-gray-300 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-200 h-32 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out">{{ $medicalQuestionnaire->injury_status }}</textarea>
                            </div>
                        </div>
                        <!-- 腫脹 -->
                        <div class="p-2 w-3/4 mx-auto">
                            <div class="relative">
                                <label for="claim" class="leading-7 text-sm text-gray-600">
                                    主張
                                </label>
                                <textarea id="claim" name="claim" class="w-full bg-white bg-opacity-50 rounded border border-gray-300 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-200 h-32 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out">{{ $medicalQuestionnaire->claim }}</textarea>
                            </div>
                        </div>
                        <!-- 疼痛 -->
                        <div class="p-2 w-3/4 mx-auto">
                            <div class="relative">
                                <label for="pain" class="leading-7 text-sm text-gray-600">
                                    疼痛
                                </label><br>
                                <input type="radio" id="pain" name="pain" value="0" @if($medicalQuestionnaire->pain === 0) checked @endif>なし
                                <input type="radio" id="pain" name="pain" value="1" @if($medicalQuestionnaire->pain === 1) checked @endif>あり
                            </div>
                        </div>
                        <!-- 腫脹 -->
                        <div class="p-2 w-3/4 mx-auto">
                            <div class="relative">
                                <label for="swelling" class="leading-7 text-sm text-gray-600">
                                    腫脹
                                </label><br>
                                <input type="radio" id="swellling" name="swelling" value="0" @if($medicalQuestionnaire->swelling === 0) checked @endif>なし
                                <input type="radio" id="swellling" name="swelling" value="1" @if($medicalQuestionnaire->swelling === 1) checked @endif>あり
                            </div>
                        </div>
                        <!-- 応急処置 -->
                        <div class="p-2 w-3/4 mx-auto">
                            <div class="relative">
                                <label for="first_aid" class="leading-7 text-sm text-gray-600">
                                    応急処置
                                </label>
                                <textarea id="first_aid" name="first_aid" class="w-full bg-white bg-opacity-50 rounded border border-gray-300 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-200 h-32 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out">{{ $medicalQuestionnaire->first_aid }}</textarea>
                            </div>
                        </div>
                        <!-- 整形外科的テスト -->
                        <div class="p-2 w-3/4 mx-auto">
                            <div class="relative">
                                <label for="orthopedic_test" class="leading-7 text-sm text-gray-600">
                                    整形外科的テスト
                                </label>
                                <textarea name="orthopedic_test" id="orthopedic_test" class="w-full bg-white bg-opacity-50 rounded border border-gray-300 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-200 h-32 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out">{{ $medicalQuestionnaire->orthopedic_test }}</textarea>
                            </div>
                        </div>
                        <!-- 筋力テスト -->
                        <div class="p-2 w-3/4 mx-auto">
                            <div class="relative">
                                <label for="muscle_stremgth_test" class="leading-7 text-sm text-gray-600">
                                    筋力テスト
                                </label>
                                <textarea id="muscle_stremgth_test" name="muscle_stremgth_test" class="w-full bg-white bg-opacity-50 rounded border border-gray-300 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-200 h-32 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out">{{ $medicalQuestionnaire->muscle_strength_test }}</textarea>
                            </div>
                        </div>
                        <!-- トレーナー所見 -->
                        <div class="p-2 w-3/4 mx-auto">
                            <div class="relative">
                                <label for="trainer_findings" class="leading-7 text-sm text-gray-600">
                                    トレーナー所見
                                </label>
                                <textarea id="trainer_findings" name="trainer_findings" class="w-full bg-white bg-opacity-50 rounded border border-gray-300 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-200 h-32 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out">{{ $medicalQuestionnaire->trainer_findings }}</textarea>
                            </div>
                        </div>
                        <!-- 今後の予定 -->
                        <div class="p-2 w-3/4 mx-auto">
                            <div class="relative">
                                <label for="future_plans" class="leading-7 text-sm text-gray-600">
                                    今後の予定
                                </label>
                                <textarea id="future_plans" name="future_plans" class="w-full bg-white bg-opacity-50 rounded border border-gray-300 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-200 h-32 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6 transition-colors duratioan-200 ease-in-out">{{ $medicalQuestionnaire->future_plans }}</textarea>
                            </div>
                        </div>
                        <!-- 登録済みの怪我の画像 -->
                        <div class="p-2 w-3/4 mx-auto">
                            <div class="relative">
                                <p>現在登録している画像</p>
                                <x-image :imageFileName="$medicalQuestionnaire->injury_image" type="injury_image" />
                            </div>
                        </div>
                        <!-- 怪我の画像 -->
                        <div class="p-2 w-3/4 mx-auto">
                            <div class="relative">
                                <label for="injury_image" class="leading-7 text-sm text-gray-600">
                                    画像<br>
                                    ※登録済みの画像を変更しない場合、再度画像ファイルを指定してください。
                                </label>
                                <input type="file" accept="image/png,image/jpeg,image/jpg" name="injury_image">
                            </div>
                        </div>
                        <!-- ボタン -->
                        <div class="p-2 flex flex-col w-2/4 mt-8 mx-auto">
                            <button type="submit" id="button" class="text-white bg-gray-600 border-0 py-2 px-8 focus:outline-none hover:bg-gray-500 rounded text-lg">
                                送信
                            </button>
                            <a href="{{ route('user.medical-history.show.menu', ['athlete_id' => $medicalQuestionnaire->athlete->id ]) }}" class="text-center text-white bg-gray-800 border-0 py-2 px-8 mt-5 focus:outline-none hover:bg-gray-700 rounded text-lg">
                                戻る
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
</x-app-layout>
