@if ($errors->any())
    <div {{ $attributes }}>
        <div class="font-medium text-red-300 text-center">
            {{ __('There is an error in the form entry.')}}
        </div>

        <ul class="mt-3 list-disc list-inside text-sm text-red-300 text-center">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
