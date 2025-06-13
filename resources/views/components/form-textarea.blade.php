@props(['disabled' => false, "data" => ""])


<textarea {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'w-full mt-2 bg-dark rounded border border-gray-800 focus:border-main focus:ring-4 focus:ring-main-light text-base outline-none text-gray-300 py-2 px-3 leading-8 transition-colors duration-200 ease-in-out mb-1']) !!}>{{ $data }}</textarea>