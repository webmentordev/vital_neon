@extends('layouts.apps')
@section('content')
    <section class="w-full px-4">
        <div class="max-w-2xl m-auto py-[80px]">
            <form action="{{ route('upload-design') }}" enctype="multipart/form-data" method="POST" class="p-12 575px:p-6 rounded-lg border-gray-700 border shadow-md bg-light">
                @csrf
                <h2 class="font-semibold text-2xl text-white">Upload Your Own Design</h2>
                <p class="py-2 text-gray-300 mb-2 text-sm">Take full control of your neon design by uploading the image.</p>
                @if (session('success'))
                    <p class="success">{{ session('success') }}</p>
                @endif
                <div class="grid grid-cols-2 gap-3 575px:grid-cols-1 mb-2">
                    <div class="flex flex-col">
                        <input type="text" name="name" placeholder="Full Name" class="w-full mt-2 bg-dark rounded border border-gray-800 focus:border-main focus:ring-4 focus:ring-main-light text-base outline-none text-gray-300 py-2 px-3 leading-8 transition-colors duration-200 ease-in-out" value="{{ old('name') }}">
                        @error('name')
                            <p class="error">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="flex flex-col">
                        <input type="email" name="email" placeholder="Email Address" class="w-full mt-2 bg-dark rounded border border-gray-800 focus:border-main focus:ring-4 focus:ring-main-light text-base outline-none text-gray-300 py-2 px-3 leading-8 transition-colors duration-200 ease-in-out" value="{{ old('email') }}">
                        @error('email')
                            <p class="error">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <textarea name="message" cols="30" rows="4" class="w-full mt-2 bg-dark rounded border border-gray-800 focus:border-main focus:ring-4 focus:ring-main-light text-base outline-none text-gray-300 py-2 px-3 leading-8 transition-colors duration-200 ease-in-out mb-3" placeholder="Write your message!">{{ old('message') }}</textarea>
                @error('message')
                    <p class="error">{{ $message }}</p>
                @enderror
                <input type="file" id="file" class="hidden" name="image" accept="image/*">
                <label for="file" class="mb-3 flex items-center cursor-pointer justify-center py-3 border-dotted border-main bg-gray-200">
                    <div class="flex items-center">
                        <img width="60" src="https://api.iconify.design/vscode-icons:folder-type-images.svg?color=%23008080" alt="UploadImageIcon">
                        <h3 class="ml-3 font-semibold mt-2">Upload Image</h3>
                    </div>
                </label>
                @error('image')
                    <p class="error">{{ $message }}</p>
                @enderror
                <button type="submit" class="submit-btn">Request The Quote</button>
            </form>
        </div>
    </section>
@endsection