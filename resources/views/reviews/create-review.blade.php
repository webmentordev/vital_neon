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
        <div class="w-full max-w-2xl m-auto mt-6 px-6 py-4 bg-white shadow-md overflow-hidden rounded-lg">
            <form action="{{ route('post.review') }}" method="POST">
                @csrf
                @if (session('success'))
                    <x-alerts.success :message="session('success')" />
                @endif
                <div class="grid grid-cols-2 gap-4 mb-3">
                    <div class="w-full">
                        <x-input-label for="name" :value="__('Customer Name')" />
                        <x-text-input id="name" autocomplete="off" name="name" class="block mt-1 w-full" type="text" required />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div class="w-full">
                        <x-input-label for="date" :value="__('Post Date')" />
                        <x-text-input id="date" autocomplete="off" name="date" class="block mt-1 w-full" type="text" required />
                        <x-input-error :messages="$errors->get('date')" class="mt-2" />
                    </div>

                    <div class="w-full">
                        <x-input-label for="star" :value="__('Stars')" />
                        <x-text-input id="star" autocomplete="off" name="star" class="block mt-1 w-full" type="number" step="0.1" required />
                        <x-input-error :messages="$errors->get('star')" class="mt-2" />
                    </div>

                    <div class="w-full col-span-2">
                        <x-input-label for="review" :value="__('Review')" />
                        <x-text-area id="review" autocomplete="off" name="review" class="block mt-1 w-full" required />
                        <x-input-error :messages="$errors->get('review')" class="mt-2" />
                    </div>

                    <div class="w-full col-span-2">
                        <x-input-label for="url" :value="__('URL')" />
                        <x-text-input id="url" autocomplete="off" name="url" class="block mt-1 w-full" type="text" required />
                        <x-input-error :messages="$errors->get('url')" class="mt-2" />
                    </div>

                    <div class="w-full col-span-2">
                        <x-input-label for="image" :value="__('Image')" />
                        <x-text-input id="image" autocomplete="off" name="image" class="block mt-1 w-full" type="file" accept="image/*" required />
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