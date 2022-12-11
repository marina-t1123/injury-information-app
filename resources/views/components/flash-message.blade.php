@props(['status' => 'info'])

@php
if($status === 'info'){$bgcolor = 'bg-blue-300';}
if($status === 'error'){$bgcolor = 'bg-red-300';}
@endphp

@if(session('message'))
    <div class="{{ $bgcolor }} w-full p-2 text-white text-center">
        {{ session('message') }}
    </div>
@endif
