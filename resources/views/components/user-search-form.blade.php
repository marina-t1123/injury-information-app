<!-- ユーザー検索フォーム -->
<div class="p-4 text-white">
    @if( request()->is('doctor*'))
        <h2 class="text-center">トレーナー検索フォーム</h2>
        <form method="get" action="{{ route('doctor.users.index') }}" class="w-full max-w-sm">
            <div class="flex items-center border-b border-blue-400 py-2">
                <input type="text" name="search" class="text-center appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none" type="text" placeholder="名前" aria-label="Full name">
            </div>
            <div class="text-center mt-4">
                <button type="submit" class="flex-shrink-0 bg-blue-300 hover:bg-blue-500 border-blue-400 hover:border-blue-500 text-sm border-4 p-1 rounded" type="button">
                    検索
                </button>
                <button type="button" onclick="location.href='{{ route('doctor.users.index')}}'" class="flex-shrink-0 border-transparent border-4 hover:text-teal-800 text-sm py-1 px-2 rounded">
                    一覧表示
                </button>
            </div>
        </form>
    @else
        <h2 class="text-center">ドクター検索フォーム</h2>
        <form method="get" action="{{ route('user.doctor-index') }}" class="w-full max-w-sm">
            <div class="flex items-center border-b border-blue-400 py-2">
                <input type="text" name="search" class="text-center appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none" type="text" placeholder="名前" aria-label="Full name">
            </div>
            <div class="text-center mt-4">
                <button type="submit" class="flex-shrink-0 bg-blue-300 hover:bg-blue-500 border-blue-400 hover:border-blue-500 text-sm border-4 p-1 rounded" type="button">
                    検索
                </button>
                <button type="button" onclick="location.href='{{ route('user.doctor-index')}}'" class="flex-shrink-0 border-transparent border-4 hover:text-teal-800 text-sm py-1 px-2 rounded">
                    一覧表示
                </button>
            </div>
        </form>
    @endif
</div>


