@props(['status' => 'info'])

@php
if(session('status') === 'info'){ $bgColor = 'bg-blue-300';}
if(session('status') === 'alert'){$bgColor = 'bg-red-300';}
@endphp

@if(session('message'))
 <div class="{{ $bgColor }} w-2/3 mx-auto text-center p-2 my-4 text-white text-xs">
    {{ session('message' )}}
 </div>
@endif