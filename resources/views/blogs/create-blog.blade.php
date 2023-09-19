<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl text-white leading-tight">
                {{ __('Create Blog') }}
            </h2>
            <a href="{{ route('blogs.show') }}" class="py-2 bg-indigo-600 text-white px-4 rounded-md text-sm">View Blogs</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('blog.create') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @if (session('success'))
                            <p class="py-4 border-green-600 border text-center bg-green-700/20 rounded-lg mb-3 text-green-600">{{ session('success') }}</p>
                        @endif
                        <div class="grid grid-cols-2 gap-3">
                            <div class="w-full mb-3">
                                <x-input-label for="title" :value="__('Title')" />
                                <x-custom-input-field id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title')" required />
                                <x-input-error :messages="$errors->get('title')" class="mt-2" />
                            </div>

                            <div class="w-full mb-3">
                                <x-input-label for="slug" :value="__('Slug')" />
                                <x-custom-input-field id="slug" class="block mt-1 w-full" type="text" name="slug" :value="old('slug')" required />
                                <x-input-error :messages="$errors->get('slug')" class="mt-2" />
                            </div>

                            <div class="w-full mb-3 col-span-2">
                                <x-input-label for="description" :value="__('Description')" />
                                <x-custom-input-field id="description" class="block mt-1 w-full" type="text" name="description" :value="old('description')" required />
                                <x-input-error :messages="$errors->get('description')" class="mt-2" />
                            </div>

                            <div class="w-full mb-3 p-4 border border-gray-300 rounded-lg col-span-2">
                                <x-input-label for="thumbnail" :value="__('Thumbnail')" />
                                <x-custom-input-field id="thumbnail" class="block mt-1 w-full" type="file" name="thumbnail" required />
                                <x-input-error :messages="$errors->get('thumbnail')" class="mt-2" />
                            </div>
                            <div class="col-span-2">
                                <x-input-label for="editor" :value="__('Body')" />
                                <textarea id="summary-ckeditor" name="body">{{ old('body') }}</textarea>
                                <x-input-error :messages="$errors->get('body')" class="mt-2" />
                            </div>
                        </div>
                        <x-primary-button class="mt-6">
                            {{ __('Post') }}
                        </x-primary-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>