@extends('layouts.apps')
@section('content')
    <section class="w-full px-4">
        <div class="max-w-2xl m-auto py-[80px]">
            <form action="{{ route('support') }}" enctype="multipart/form-data" method="POST" class="p-12 rounded-lg border-gray-700 border shadow-md bg-light">
                @csrf
                <h2 class="font-semibold text-4xl text-white">Create a Support ticket</h2>
                <p class="py-2 text-gray-200 mb-2 text-sm">A <strong>ticket #ID</strong> will be sent to your email. Make sure to keep it safe.</p>
                @if (session('success'))
                    <p class="success">{{ session('success') }}</p>
                @endif
                <div class="grid grid-cols-2 gap-3">
                    <div class="flex flex-col">
                        <input type="text" name="name" placeholder="Full Name" class="input" value="{{ old('name') }}">
                        @error('name')
                            <p class="error">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="flex flex-col">
                        <input type="email" name="email" placeholder="Email Address" class="input" value="{{ old('email') }}">
                        @error('email')
                            <p class="error">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <input type="text" name="subject" placeholder="Subject" class="input" value="{{ old('subject') }}">
                @error('subject')
                    <p class="error">{{ $message }}</p>
                @enderror
                <textarea name="message" cols="30" rows="4" class="input" placeholder="Write your message!">{{ old('message') }}</textarea>
                @error('message')
                    <p class="error">{{ $message }}</p>
                @enderror
                <button type="submit" class="submit-btn">Contact</button>
            </form>
        </div>
    </section>
@endsection