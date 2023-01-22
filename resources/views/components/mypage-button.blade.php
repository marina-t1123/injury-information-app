@if (request()->is('doctor*'))
    <div class="mx-auto mt-5 text-center">
        <a href="{{ route('doctor.mypage')}}" class="text-white bg-gray-600 border-0 py-2 px-8 mt-5 focus:outline-none hover:bg-gray-500 rounded text-sm">マイページ</a>
    </div>
@else
    <div class="mx-auto mt-5 text-center">
        <a href="{{ route('user.mypage')}}" class="text-white bg-gray-600 border-0 py-2 px-8 mt-5 focus:outline-none hover:bg-gray-500 rounded text-sm">マイページ</a>
    </div>
@endif
