@extends('layouts.apps')
@section('content')
    <section class="w-full px-4">
        <div class="max-w-4xl m-auto py-[80px]">
            <form action="{{ route('upload-design') }}" enctype="multipart/form-data" method="POST" class="p-12 575px:p-6 rounded-lg border-gray-700 border shadow-md bg-light">
                @csrf
                <h2 class="font-semibold text-2xl text-white">Upload Your Own Design</h2>
                <p class="py-2 text-gray-300 mb-2 text-sm">Take full control of your neon design by uploading the image.</p>
                @if (session('success'))
                    <p class="success">{{ session('success') }}</p>
                @endif
                <div class="grid grid-cols-2 gap-3 575px:grid-cols-1 mb-4">
                    <div class="flex flex-col">
                        <input type="text" name="name" placeholder="Full Name" class="w-full mt-2 bg-dark rounded border border-gray-800 focus:border-main focus:ring-4 focus:ring-main-light text-base outline-none text-gray-300 py-2 px-3 leading-8 transition-colors duration-200 ease-in-out" value="{{ old('name') }}">
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>
                    <div class="flex flex-col">
                        <input type="email" name="email" placeholder="Email Address" class="w-full mt-2 bg-dark rounded border border-gray-800 focus:border-main focus:ring-4 focus:ring-main-light text-base outline-none text-gray-300 py-2 px-3 leading-8 transition-colors duration-200 ease-in-out" value="{{ old('email') }}">
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
                </div>
                <div class="flex flex-col mt-6 mb-5">
                    <h2 class="font-semibold text-lg text-white">Neon Sign Location</h2>
                    <p class="mb-3 text-gray-200 text-sm">The location where you are going to place the neon sign. Outdoor cost more than indoor sign.</p>
                    <div class="flex items-center mb-3">
                        <input type="radio" name="location" id="indoor" value="indoor" >
                        <label for="indoor" class="ml-2 text-white text-sm">Indoor Sign</label>
                    </div>
                    <div class="flex items-center mb-3">
                        <input type="radio" name="location" id="outdoor" value="outdoor">
                        <label for="outdoor" class="ml-2 text-white text-sm">Outdoor Sign</label>
                    </div>
                    <x-input-error :messages="$errors->get('location')" class="mt-2" />
                </div>

                <div class="grid grid-cols-2 gap-3 575px:grid-cols-1 mb-4">
                    <div class="flex flex-col">
                        <h2 class="font-semibold text-lg text-white mb-2">Aprroximate Size (Length/Height)</h2>
                        <input type="text" name="size" placeholder="Length/Height" class="w-full mt-2 bg-dark rounded border border-gray-800 focus:border-main focus:ring-4 focus:ring-main-light text-base outline-none text-gray-300 py-2 px-3 leading-8 transition-colors duration-200 ease-in-out" value="{{ old('size') }}">
                        <x-input-error :messages="$errors->get('size')" class="mt-2" />
                    </div>
    
                    <div class="flex flex-col">
                        <h2 class="font-semibold text-lg text-white mb-2">Budget (USD)</h2>
                        <input type="number" step="0.01" name="budget" placeholder="Budget (min $200 and Max $2000)" class="w-full mt-2 bg-dark rounded border border-gray-800 focus:border-main focus:ring-4 focus:ring-main-light text-base outline-none text-gray-300 py-2 px-3 leading-8 transition-colors duration-200 ease-in-out" value="{{ old('budget') }}">
                        <x-input-error :messages="$errors->get('budget')" class="mt-2" />
                    </div>
                </div>

                <textarea name="message" cols="30" rows="4" class="w-full mt-2 bg-dark rounded border border-gray-800 focus:border-main focus:ring-4 focus:ring-main-light text-base outline-none text-gray-300 py-2 px-3 leading-8 transition-colors duration-200 ease-in-out mb-5" placeholder="Please include details like font style,color,picture or design, and how soon you need it.">{{ old('message') }}</textarea>
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
            <div class="text-white mt-6">
                <h2 class="mb-3 text-3xl font-bold" title="Request Your Custom Neon Sign">Request Your Custom Neon Sign</h2>
                <p class="mb-4">Transform your vision into radiant reality with our personalized neon sign service. At Vital Neon, we believe in bringing your unique ideas to life, and we've made the process simple and seamless. Upload your own design and request a quote for a one-of-a-kind neon sign that reflects your style and personality.</p>

                <h3 class="font-bold text-lg">Customization at Your Fingertips</h3>
                <p class="mb-4">Express yourself by uploading your own design. Whether it's a logo, artwork, a special message, anime, or your favorite movie character, we'll turn it into a stunning neon masterpiece.</p>

                <h3 class="font-bold text-lg">Easy Quote Request</h3>
                <p class="mb-4">Getting started is a breeze. Simply fill out our user-friendly form with essential details, and our team will provide you with a comprehensive quote. After submitting the form, you will receive a mockup design via email, detailing the size and color configuration. We will not proceed with manufacturing until you are satisfied with the mockup.</p>

                <h3 class="font-bold text-lg">Tailor-Made Specifications</h3>
                <p class="mb-4">Your satisfaction is our priority. Specify your budget, preferred position (indoor or outdoor), desired dimensions (height and width) and your budget. This ensures a tailor-made neon sign that perfectly fits your space.</p>

                <h3 class="font-bold text-lg">Quality That Lasts</h3>
                <p class="mb-4">We understand the importance of durability. Indicate whether your neon sign will be placed indoors or outdoors for a higher quality that withstands weather elements.</p>

                <h3 class="font-bold text-lg">Attention to Detail</h3>
                <p class="mb-4">If your design involves text, let us know your preferred font style and color. We pay attention to the finer details to ensure your neon sign is a true reflection of your vision</p>
            </div>
        </div>
    </section>
@endsection