@props(['disabled' => false, 'value'])

<textarea cols="30" rows="6" {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'py-2 px-3 rounded-lg bg-dark-100 border border-white/10 w-full text-white/80']) !!}>{{ $value }}</textarea>