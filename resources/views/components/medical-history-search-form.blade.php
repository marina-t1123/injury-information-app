<!-- 選手検索フォーム -->
<div class="p-4 text-white">
    <h2 class="text-center">既往歴検索フォーム</h2>
    <form method="get" action="{{ route('user.medical-history.search', ['athlete_id' => $athlete->id]) }}" class="w-full max-w-sm">
        <div class="flex items-center border-b border-blue-400 py-2">
            <input type="text" name="search" class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none" type="text" placeholder="受傷日 受傷部位" aria-label="Full name">
            <button type="submit" class="flex-shrink-0 bg-blue-300 hover:bg-blue-500 border-blue-400 hover:border-blue-500 text-sm border-4 py-1 px-2 rounded" type="button">
                検索
            </button>
        </div>
    </form>
</div>

