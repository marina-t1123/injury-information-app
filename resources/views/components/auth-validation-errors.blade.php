@props(['errors'])

@if ($errors->any())
    <div {{ $attributes }}>
        <div class="font-medium text-red-600 text-center">
            {{ __('There is an error in the form entry.')}}
        </div>

        <ul class="mt-3 list-disc list-inside text-sm text-red-600">
            @foreach ($errors->all() as $error)
                <li class="text-center">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
