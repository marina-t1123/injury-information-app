<x-app-layout>
    <x-slot name=header>
        <h1 class="font-semibold text=xl text-gray-700 leading-tight text-center">
            カルテ編集画面
        </h1>
    </x-slot>

    <section class="text-gray-600 body-font relative">
        <div class="container px-5 py-10 mx-auto">
            <!-- カルテ編集フォーム -->
            <div class="lg:w-1/2 md:w-2/3 mx-auto">
                <!-- エラーメッセージ -->
                <x-auth-validation-errors class="mb-4 text-center" :errors="$errors" />

                <form method="post" action="{{ route('doctor.medical-record.update', ['medical_record_id' => $medicalRecord->id ]) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="-m-2">
                        <!-- 診察日 -->
                        <div class="p-2 w-3/4 mx-auto">
                            <div class="relative">
                                <label for="hospital_day" class="leading-7 text-sm text-gray-600">
                                    診察日
                                </label>
                                <input type="date" id="hospital_day" name="hospital_day" value="{{ $medicalRecord->hospital_day }}" class="w-full bg-white bg-opacity-50 rounded border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                            </div>
                        </div>
                        <!-- 担当医 -->
                        <div class="p-2 w-3/4 mx-auto">
                            <div class="relative">
                                <label for="attending_physician" class="leading-7 text-sm text-gray-600">
                                    担当医
                                </label>
                                <input type="text" id="attending_physician" name="attending_physician" value="{{ $medicalRecord->attending_physician }}" class="w-full bg-white bg-opacity-50 rounded border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                            </div>
                        </div>
                        <!-- 診察内容 -->
                        <div class="p-2 w-3/4 mx-auto">
                            <div class="relative">
                                <label for="medical_examination" class="leading-7 text-sm text-gray-600">
                                    診察内容
                                </label>
                                <textarea id="medical_examination" name="medical_examination" cols='10' class="w-full bg-white bg-opacity-50 rounded border border-gray-300 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-200 h-32 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out">{{ $medicalRecord->medical_examination }}</textarea>
                            </div>
                        </div>
                        <!-- テスト内容 -->
                        <div class="p-2 w-3/4 mx-auto">
                            <div class="relative">
                                <label for="tests" class="leading-7 text-sm text-gray-600">
                                    テスト内容
                                </label>
                                <textarea id="tests" name="tests" class="w-full bg-white bg-opacity-50 rounded border border-gray-300 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-200 h-32 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out">{{ $medicalRecord->tests }}</textarea>
                            </div>
                        </div>
                        <!-- ドクター所見 -->
                        <div class="p-2 w-3/4 mx-auto">
                            <div class="relative">
                                <label for="doctor_findings" class="leading-7 text-sm text-gray-600">
                                    ドクター所見
                                </label>
                                <textarea id="doctor_findings" name="doctor_findings" class="w-full bg-white bg-opacity-50 rounded border border-gray-300 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-200 h-32 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out">{{ $medicalRecord->doctor_findings }}</textarea>
                            </div>
                        </div>
                        <!-- 診断名 -->
                        <div class="p-2 w-3/4 mx-auto">
                            <div class="relative">
                                <label for="swelling" class="leading-7 text-sm text-gray-600">
                                    診断名
                                </label>
                                <input type="text" name="swelling" id="swelling" value="{{ $medicalRecord->swelling}}" class="w-full bg-white bg-opacity-50 rounded border border-gray-300 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-200 h-32 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out"></input>
                            </div>
                        </div>
                        <!-- 今後の方針 -->
                        <div class="p-2 w-3/4 mx-auto">
                            <div class="relative">
                                <label for="future_policies" class="leading-7 text-sm text-gray-600">
                                    今後の方針
                                </label>
                                <textarea id="future_policies" name="future_policies" class="w-full bg-white bg-opacity-50 rounded border border-gray-300 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-200 h-32 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out">{{ $medicalRecord->future_policies }}</textarea>
                            </div>
                        </div>
                        <!-- 登録済みの怪我の画像 -->
                        <div class="p-2 w-3/4 mx-auto">
                            <div class="relative">
                                <p class="text-sm">現在登録している画像</p>
                                @foreach ($medicalImages as $medicalImage)
                                    <x-image :imageFileName="$medicalImage->medical_image" type="medical_image" />
                                @endforeach
                            </div>
                        </div>
                        <!-- 画像 -->
                        <div class="p-2 w-3/4 mx-auto">
                            <div class="relative">
                                <label for="hospital_image" class="leading-7 text-sm text-gray-600">
                                    画像
                                </label>
                                <input type="file" id="files" class="text-sm" accept="image/png,image/jpeg,image/jpg" name="files[][medical_image]" multiple>
                            </div>
                        </div>
                        <!-- ボタン -->
                        <div class="p-2 flex flex-col w-2/4 mt-8 mx-auto">
                            <button type="submit" id="button" class="text-white bg-gray-600 border-0 py-2 px-8 focus:outline-none hover:bg-gray-500 rounded text-lg">
                                送信
                            </button>
                            <a href="{{ route('doctor.medical-questionnaire.show.menu', ['athlete_id' => $medicalQuestionnaire->athlete->id ]) }}" class="text-center text-white bg-gray-800 border-0 py-2 px-8 mt-5 focus:outline-none hover:bg-gray-700 rounded text-lg">
                                問診票詳細・カルテページ
                            </a>
                        </div>

                    </div>
                </form>
            </div>

        </div>
    </section>

</x-app-layout>
