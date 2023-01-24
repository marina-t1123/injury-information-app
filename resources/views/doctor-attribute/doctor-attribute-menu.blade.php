<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-xl text-gray-700 leading-tight text-center">
            ドクター詳細ページ
        </h1>
    </x-slot>

    <!-- フラッシュメッセージ -->
    <x-flash-message status="info" />

    <section class="text-gray-600 body-font">
        <div class="container px-5 py-24 mx-auto">
            <!-- ドクター詳細情報 -->
            <div class="flex items-center lg:w-3/5 mx-auto border-b pb-10 mb-10 border-gray-200 sm:flex-row flex-col">
                @if(empty($doctor->doctorAttribute))
                    <p class="mx-auto">ドクター詳細情報が登録されていません。</p>
                @else
                    <div class="flex-grow sm:text-left text-center mt-6 sm:mt-0">
                        <h2 class="text-gray-900 text-lg title-font font-medium mb-2 mx-auto">
                            ドクター詳細情報
                        </h2>
                        <p>ID： {{$doctor->id}}</p>
                        <p>名前： {{ $doctor->name }}</p>
                        <p>Email： {{ $doctor->email }}</p>
                        <p>電話番号： {{ $doctor->doctorAttribute->phone_number }}</p>
                        <p>病院名： {{ $doctor->doctorAttribute->hospital_name }}</p>
                        <p>専門分野：<br> {{ $doctor->doctorAttribute->particular_field }}</p>
                        <p>経歴：<br>{{ $doctor->doctorAttribute->career }}</p>
                    </div>
                @endif

            </div>
            <!-- ドクター詳細新規登録 -->
            @if (empty($doctor->doctorAttribute))
                <div class="mx-auto my-4 text-center">
                    <a href="{{ route('doctor.doctor-attribute.create', ['id' => $doctor->id ]) }}" class="text-white bg-gray-500 border-0 py-2 px-8 focus:outline-none hover:bg-gray-300 rounded text-sm">
                        詳細情報登録
                    </a>
                </div>
            @endif
            <!-- ドクター詳細情報編集 -->
            <div class="mx-auto my-4 text-center">
                <a href="{{ route('doctor.doctor-attribute.edit', ['id' => $doctor->id ]) }}" class="text-white bg-gray-500 border-0 py-2 px-8 focus:outline-none hover:bg-gray-300 rounded text-sm">
                    詳細情報編集
                </a>
            </div>
            <!-- マイページボタン -->
            <x-mypage-button></x-mypage-button>
        </div>
    </section>
</x-app-layout>
