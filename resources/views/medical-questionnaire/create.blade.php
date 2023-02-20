<x-app-layout>
    <x-slot name=header>
        <h1 class="font-semibold text=xl text-gray-700 leading-tight text-center">
            問診票新規作成
        </h1>
    </x-slot>

    <section class="text-gray-600 body-font relative">
        <div class="container px-5 py-10 mx-auto">
            <div class="flex flex-col text-center w-full mb-12">
                <p class="lg:w-2/3 mx-auto leading-relaxed text-base">
                    {{ $athlete->name }}さんの問診票の登録を行います。
                </p>
            </div>
            <!-- 既往歴登録フォーム -->
            <div class="lg:w-1/2 md:w-2/3 mx-auto">
                <!-- エラーメッセージ -->
                <x-auth-validation-errors class="mb-4" :errors="$errors" />

                <form method="post" action="{{ route('user.medical-questionnaire.store', ['athlete_id' => $athlete->id ]) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="-m-2">
                        <!-- 受傷日 -->
                        <div class="p-2 w-3/4 mx-auto">
                            <div class="relative">
                            <label for="injured_day" class="leading-7 text-sm text-gray-600">
                                受傷日
                            </label>
                            <input type="date" id="injured_day" name="injured_day" value="{{ old('injured_day') }}" class="w-full bg-white bg-opacity-50 rounded border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                            </div>
                        </div>
                        <!-- 受傷部位 -->
                        <div class="p-2 w-3/4 mx-auto">
                            <div class="relative">
                            <label for="injured_area" class="leading-7 text-sm text-gray-600">
                                受傷部位
                            </label>
                            <input type="text" id="injured_area" name="injured_area" value="{{ old('injured_area') }}" class="w-full bg-white bg-opacity-50 rounded border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                            </div>
                        </div>
                        <!-- 受傷状況 -->
                        <div class="p-2 w-3/4 mx-auto">
                            <div class="relative">
                            <label for="injury_status" class="leading-7 text-sm text-gray-600">
                                受傷状況
                            </label>
                            <textarea id="injury_status" name="injury_status" class="w-full bg-white bg-opacity-50 rounded border border-gray-300 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-200 h-32 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out">{{ old('injury_status') }}</textarea>
                            </div>
                        </div>
                        <!-- 腫脹 -->
                        <div class="p-2 w-3/4 mx-auto">
                            <div class="relative">
                                <label for="claim" class="leading-7 text-sm text-gray-600">
                                    主張
                                </label>
                                <textarea id="claim" name="claim" class="w-full bg-white bg-opacity-50 rounded border border-gray-300 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-200 h-32 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out">{{ old('claim') }}</textarea>
                            </div>
                        </div>
                        <!-- 疼痛 -->
                        <div class="p-2 w-3/4 mx-auto">
                            <div class="relative">
                                <label for="pain" class="leading-7 text-sm text-gray-600">
                                    疼痛
                                </label><br>
                                <input type="radio" id="pain" name="pain" value="0">なし
                                <input type="radio" id="pain" name="pain" value="1">あり
                            </div>
                        </div>
                        <!-- 腫脹 -->
                        <div class="p-2 w-3/4 mx-auto">
                            <div class="relative">
                                <label for="swelling" class="leading-7 text-sm text-gray-600">
                                    腫脹
                                </label><br>
                                <input type="radio" id="swellling" name="swelling" value="0">なし
                                <input type="radio" id="swellling" name="swelling" value="1">あり
                            </div>
                        </div>
                        <!-- 応急処置 -->
                        <div class="p-2 w-3/4 mx-auto">
                            <div class="relative">
                                <label for="first_aid" class="leading-7 text-sm text-gray-600">
                                    応急処置
                                </label>
                                <textarea id="first_aid" name="first_aid" class="w-full bg-white bg-opacity-50 rounded border border-gray-300 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-200 h-32 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out">{{ old('injury_status') }}</textarea>
                            </div>
                        </div>
                        <!-- 整形外科的テスト -->
                        <div class="p-2 w-3/4 mx-auto">
                            <div class="relative">
                                <label for="orthopedic_test" class="leading-7 text-sm text-gray-600">
                                    整形外科的テスト
                                </label>
                                <textarea name="orthopedic_test" id="orthopedic_test" class="w-full bg-white bg-opacity-50 rounded border border-gray-300 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-200 h-32 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out">{{ old('orthopedic_test') }}</textarea>
                            </div>
                        </div>
                        <!-- 筋力テスト -->
                        <div class="p-2 w-3/4 mx-auto">
                            <div class="relative">
                                <label for="muscle_stremgth_test" class="leading-7 text-sm text-gray-600">
                                    筋力テスト
                                </label>
                                <textarea id="muscle_stremgth_test" name="muscle_stremgth_test" class="w-full bg-white bg-opacity-50 rounded border border-gray-300 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-200 h-32 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out">{{ old('muscle_strength_test') }}</textarea>
                            </div>
                        </div>
                        <!-- トレーナー所見 -->
                        <div class="p-2 w-3/4 mx-auto">
                            <div class="relative">
                                <label for="trainer_findings" class="leading-7 text-sm text-gray-600">
                                    トレーナー所見
                                </label>
                                <textarea id="trainer_findings" name="trainer_findings" class="w-full bg-white bg-opacity-50 rounded border border-gray-300 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-200 h-32 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out">{{ old('trainer_findings') }}</textarea>
                            </div>
                        </div>
                        <!-- 今後の予定 -->
                        <div class="p-2 w-3/4 mx-auto">
                            <div class="relative">
                                <label for="future_plans" class="leading-7 text-sm text-gray-600">
                                    今後の予定
                                </label>
                                <textarea id="future_plans" name="future_plans" class="w-full bg-white bg-opacity-50 rounded border border-gray-300 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-200 h-32 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out">{{ old('future_plans') }}</textarea>
                            </div>
                        </div>
                        <!-- 怪我の画像 -->
                        <div class="p-2 w-3/4 mx-auto">
                            <div class="relative">
                                <label for="injury_image" class="leading-7 text-sm text-gray-600">
                                    怪我の画像
                                </label>
                                <input type="file" accept="image/png,image/jpeg,image/jpg" name="injury_image">
                            </div>
                        </div>
                        <!-- 診察日 -->
                        <div class="p-2 w-3/4 mx-auto">
                            <div class="relative">
                                <label for="hospital_day" class="leading-7 text-sm text-gray-600">
                                    診察日
                                </label>
                                <input type="date" id="hospital_day" name="hospital_day" value="{{ old('hospital_day') }}" class="w-full bg-white bg-opacity-50 rounded border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                            </div>
                        </div>
                        <!-- 担当医 -->
                        <div class="p-2 w-3/4 mx-auto">
                            <div class="relative">
                                <label for="attending_physician" class="leading-7 text-sm text-gray-600">
                                    担当医
                                </label>
                                @if($doctors->isNotEmpty())
                                    <select name="attending_physician" id="attending_physician" class="w-full bg-white bg-opacity-50 rounded border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                        <option value="">選択してください</option>
                                        @foreach($doctors as $doctor)
                                            <option value="{{ $doctor->name }}" @if(old('attending_physician') === $doctor->name) selected @endif >{{ $doctor->name }}</option>
                                        @endforeach
                                    </select>
                                @else
                                    <p>ドクターが未登録です</p>
                                @endif
                            </div>
                        </div>
                        <!-- ボタン -->
                        <div class="p-2 flex flex-col w-2/4 mt-8 mx-auto">
                            <button type="submit" id="button" class="text-white bg-gray-600 border-0 py-2 px-8 focus:outline-none hover:bg-gray-500 rounded text-lg">
                                送信
                            </button>
                            <a href="{{ route('user.medical-history.show.menu', ['athlete_id' => $athlete->id ]) }}" class="text-center text-white bg-gray-800 border-0 py-2 px-8 mt-5 focus:outline-none hover:bg-gray-700 rounded text-lg">
                                戻る
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
</x-app-layout>
