<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Product Categories') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if (session('success'))
                        <p class="py-3 border-green-700 mb-3 text-center border bg-green-700 bg-opacity-40 text-white rounded-lg">{{ session('success') }}</p>
                    @endif
                    <h1 class="font-semibold mb-3">Update Category</h1>
                    <form action="{{ route('update.category', $category->id) }}" enctype="multipart/form-data" method="post" class="flex flex-col mb-4">
                        @csrf
                        <div class="grid grid-cols-2 gap-3">
                            <div class="w-full mr-2">
                                <input type="text" name="name" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm w-full" placeholder="Category Name" autocomplete="off" required value="{{ $category->name }}">
                                @error('name')
                                    <p class="mt-1 text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="w-full mr-2">
                                <input type="text" name="slug" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm w-full" placeholder="Category Slug" autocomplete="off" required value="{{ $category->slug }}">
                                @error('slug')
                                    <p class="mt-1 text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-3 mt-3">
                            <div class="w-full mr-2">
                                <input type="text" name="title" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm w-full" placeholder="SEO Title" autocomplete="off" required value="{{ $category->title }}">
                                @error('title')
                                    <p class="mt-1 text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="w-full mr-2">
                                <input type="text" name="description" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm w-full" placeholder="SEO Description" autocomplete="off" value="{{ $category->description }}" required>
                                @error('description')
                                    <p class="mt-1 text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="w-full mr-2 mt-3">
                            <label for="image">SEO Image (Optional)</label>
                            <input type="file" id="image" name="image" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm w-full p-2" autocomplete="off">
                            @error('image')
                                <p class="mt-1 text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mt-4">
                            <x-input-label for="editor" value="SEO Content Body" />
                            <textarea id="summary-ckeditor" name="body">{{ $category->body }}</textarea>
                            <x-input-error :messages="$errors->get('body')" class="mt-2" />
                        </div>
                        
                        <button type="submit" class="px-4 mt-3 py-2 bg-indigo-600 rounded-md text-white w-fit mb-3">Submit</button>

                        @if ($category->image)
                            <img src="{{ asset("storage/". $category->image) }}" width="400px">
                        @else
                            <p>This category does not have an image</p>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>