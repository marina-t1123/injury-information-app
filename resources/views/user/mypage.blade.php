<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-700 leading-tight text-center">
            マイページ
        </h2>
    </x-slot>

    <!-- フラッシュメッセージ -->
    <x-flash-message status="info" />

    <div class="w-4/5 py-12 mx-auto">
        <!-- 選手検索 -->
        <div class="w-4/5 h-70 bg-gray-300 mx-auto rounded-lg mt-9 flex justify-center">
            <x-athlete-search-form></x-athlete-search-form>
        </div>

        <!-- 選手一覧 -->
        <section class="text-gray-600 body-font">
            <div class="container px-5 py-14 mx-auto text-base">

                <div class="flex flex-col text-center w-full mb-5">
                    <h2 class="sm:text-3xl text-l font-medium title-font mb-4 text-gray-700">選手一覧</h2>
                </div>

                <div class="flex flex-wrap -m-2">
                    @foreach($athletes as $athlete)
                    <div class="flex flex-column p-2 lg:w-1/2 w-full mx-auto">
                        {{-- <div class="h-full flex items-center border-gray-200 border p-4 rounded-lg"> --}}
                        <div class="h-full border-gray-200 border p-4 rounded-lg mx-auto">

                            <div>
                                <h2 class="text-gray-900 title-font font-medium">ID:{{ $athlete->id }} {{ $athlete->name }}</h2>
                                <p class="text-gray-500">所属：{{ $athlete->team }}</p>
                                <p class="text-gray-500">競技名：{{ $athlete->event }}</p>
                                <p class="text-gray-500">種目・ポジション：{{ $athlete->event_detail }}</p>
                            </div>

                            <div class="flex-row mx-auto">
                                <a href="{{ route('user.medical-history.show.menu', ['athlete_id' => $athlete->id ])}}" class="text-white bg-gray-800 border-0 py-2 px-8 mt-5 focus:outline-none hover:bg-gray-700 rounded text-sm">
                                    既往歴
                                </a>
                                <a href="" class="text-white bg-gray-800 border-0 py-2 px-8 mt-5 focus:outline-none hover:bg-gray-700 rounded text-sm">
                                    問診票
                                </a>
                                <a href="" class="text-white bg-gray-800 border-0 py-2 px-8 mt-5 focus:outline-none hover:bg-gray-700 rounded text-sm">
                                    カルテ
                                </a>
                                <a href="{{ route('user.athlete.show.setting', [ 'athlete_id' => $athlete->id ]) }}" class="text-white bg-gray-800 border-0 py-2 px-8 mt-5 focus:outline-none hover:bg-gray-700 rounded text-sm">
                                    選手設定
                                </a>
                                {{-- <button type="button" onclick="location.href={{ route('user.athlete.show.setting', ['athlete_id'=>$athlete->id]) }}" class="text-white bg-gray-800 border-0 py-2 px-8 mt-5 focus:outline-none hover:bg-gray-700 rounded text-sm">
                                    選手設定
                                </button> --}}
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="mx-auto">{{ $athletes->links() }}</div>

            </div>
        </section>
    </div>
</x-app-layout>
