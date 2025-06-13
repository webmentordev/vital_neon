@props(['disabled' => false, "data" => ""])


<textarea {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'w-full bg-dark rounded border mb-2 border-white/10 focus:border-main focus:ring-4 focus:ring-main-light text-base outline-none text-gray-300 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out']) !!}>{{ $slot }}</textarea>