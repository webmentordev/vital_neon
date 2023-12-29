<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Write Email') }}
            </h2>
            <a href="{{ route('email.send') }}" class="py-2 px-4 rounded-md bg-indigo-600 text-white font-semibold">Write</a>
        </div>
    </x-slot>
    <section class="w-full">
        <div class="w-full max-w-2xl m-auto mt-6 px-6 py-4 bg-gray-700 shadow-md overflow-hidden rounded-lg">
            <form action="{{ route('preview.email') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <h2 class="font-semibold mb-3 text-white text-3xl">Preview Email</h2>
                @if (session('success'))
                    <x-success :message="session('success')" />
                @endif
                <div class="grid grid-cols-2 gap-4 mb-3">
                    <div class="w-full col-span-2">
                        <x-input-label for="subject" :value="__('Subject')" />
                        <input id="subject" autocomplete="off" name="subject" type="text" required class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm w-full block mt-1">
                        <x-input-error :messages="$errors->get('subject')" class="mt-2" />
                    </div>

                    <div class="w-full col-span-2">
                        <x-input-label for="attachments" :value="__('Attachments')" />
                        <input id="attachments" autocomplete="off" name="attachments[]" type="file" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm w-full block mt-1">
                        <x-input-error :messages="$errors->get('attachments')" class="mt-2" />
                    </div>

                    <div class="w-full col-span-2">
                        <x-input-label for="content" :value="__('Content')" />
                        <textarea name="content" id="content" cols="30" rows="10" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm w-full block mt-1" required></textarea>
                        <x-input-error :messages="$errors->get('content')" class="mt-2" />
                    </div>

                </div>
                <div class="flex items-center justify-end mt-4">
                    <x-primary-button class="ml-3">
                        {{ __('Send') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </section>
</x-app-layout>