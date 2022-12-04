<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-700 leading-tight text-center">
            マイページ
        </h2>
    </x-slot>

    <div class="w-4/5 py-12 mx-auto">
        <!-- 選手新規作成リンク -->
        <div class="max-w-lg mx-auto sm:px-6 lg:px-8 text-center">
            <div class="bg-white shadow-sm sm:rounded-lg p-6 border-b border-gray-200">
                <a href="">
                    <p>選手新規作成</p>
                </a>
            </div>

            {{-- <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                </div>
            </div> --}}

        </div>

        <!-- 選手検索 -->
        <div class="w-4/5 h-70 bg-gray-300 mx-auto rounded-lg mt-9 flex justify-center">
            <x-athlete-search-form></x-athlete-search-form>
        </div>

        <!-- 選手一覧 -->
        <section class="text-gray-600 body-font">
            <div class="container px-5 py-14 mx-auto">
                <div class="flex flex-col text-center w-full mb-5">
                    <h2 class="sm:text-3xl text-l font-medium title-font mb-4 text-gray-700">選手一覧</h2>
                </div>
                <div class="flex flex-wrap -m-2">
                    <div class="p-2 lg:w-1/3 md:w-1/2 w-full">
                    <div class="h-full flex items-center border-gray-200 border p-4 rounded-lg">
                        <img alt="team" class="w-16 h-16 bg-gray-100 object-cover object-center flex-shrink-0 rounded-full mr-4" src="https://dummyimage.com/80x80">
                        <div class="flex-grow">
                            <h2 class="text-gray-900 title-font font-medium">Holden Caulfield</h2>
                            <p class="text-gray-500">UI Designer</p>
                        </div>
                    </div>
                    </div>
                    <div class="p-2 lg:w-1/3 md:w-1/2 w-full">
                    <div class="h-full flex items-center border-gray-200 border p-4 rounded-lg">
                        <img alt="team" class="w-16 h-16 bg-gray-100 object-cover object-center flex-shrink-0 rounded-full mr-4" src="https://dummyimage.com/84x84">
                        <div class="flex-grow">
                            <h2 class="text-gray-900 title-font font-medium">Henry Letham</h2>
                            <p class="text-gray-500">CTO</p>
                        </div>
                    </div>
                    </div>
                    <div class="p-2 lg:w-1/3 md:w-1/2 w-full">
                    <div class="h-full flex items-center border-gray-200 border p-4 rounded-lg">
                        <img alt="team" class="w-16 h-16 bg-gray-100 object-cover object-center flex-shrink-0 rounded-full mr-4" src="https://dummyimage.com/88x88">
                        <div class="flex-grow">
                            <h2 class="text-gray-900 title-font font-medium">Oskar Blinde</h2>
                            <p class="text-gray-500">Founder</p>
                        </div>
                    </div>
                </div>
              </div>
            </div>
        </section>
    </div>
</x-app-layout>
