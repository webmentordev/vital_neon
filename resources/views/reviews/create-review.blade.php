<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Post Review') }}
            </h2>
            <a href="{{ route('reviews') }}" class="py-2 px-4 rounded-md bg-indigo-600 text-white font-semibold">Go Back</a>
        </div>
    </x-slot>
    <section class="w-full">
        <div class="w-full max-w-2xl m-auto mt-6 px-6 py-4 bg-gray-700 shadow-md overflow-hidden rounded-lg">
            <form action="{{ route('post.review') }}" method="POST">
                @csrf
                @if (session('success'))
                    <x-success :message="session('success')" />
                @endif
                <div class="grid grid-cols-2 gap-4 mb-3">
                    <div class="w-full">
                        <x-input-label for="name" :value="__('Customer Name')" />
                        <input id="name" autocomplete="off" name="name" type="text" required class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm w-full block mt-1">
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div class="w-full">
                        <x-input-label for="date" :value="__('Post Date')" />
                        <input id="date" autocomplete="off" name="date" type="text" required  class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm w-full block mt-1">
                        <x-input-error :messages="$errors->get('date')" class="mt-2" />
                    </div>

                    <div class="w-full">
                        <x-input-label for="star" :value="__('Stars')" />
                        <input id="star" autocomplete="off" name="star" type="number" step="0.1" required class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm w-full block mt-1">
                        <x-input-error :messages="$errors->get('star')" class="mt-2" />
                    </div>

                    <div class="w-full">
                        <x-input-label for="url" :value="__('URL')" />
                        <input id="url" autocomplete="off" name="url" type="text" required class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm w-full block mt-1">
                        <x-input-error :messages="$errors->get('url')" class="mt-2" />
                    </div>

                    <div class="w-full col-span-2">
                        <x-input-label for="review" :value="__('Review')" />
                        <textarea id="review" autocomplete="off" name="review" required rows="10" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md block mt-1 shadow-sm w-full"></textarea>
                        <x-input-error :messages="$errors->get('review')" class="mt-2" />
                    </div>

                    <div class="w-full col-span-2">
                        <x-input-label for="image" :value="__('Image')" />
                        <input id="image" autocomplete="off" name="image" type="file" accept="image/*" required class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm w-full block mt-1">
                        <x-input-error :messages="$errors->get('image')" class="mt-2" />
                    </div>

                </div>
                <div class="flex items-center justify-end mt-4">
                    <x-primary-button class="ml-3">
                        {{ __('Create') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </section>
</x-app-layout>