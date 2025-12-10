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
                    <h1 class="font-semibold mb-3">Create Product Categories</h1>
                    <form action="{{ route('product.category') }}" method="post" class="flex flex-col">
                        @csrf
                        <div class="grid grid-cols-2 gap-5">
                            <div class="w-full mr-2">
                                <input type="text" name="name" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm w-full" placeholder="Category Name" autocomplete="off">
                                @error('name')
                                    <p class="mt-1 text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="w-full mr-2">
                                <input type="text" name="seo_title" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm w-full" placeholder="SEO Title" autocomplete="off">
                                @error('seo_title')
                                    <p class="mt-1 text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-5 mt-3">
                            <div class="w-full mr-2">
                                <input type="text" name="description" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm w-full" placeholder="SEO Description" autocomplete="off">
                                @error('description')
                                    <p class="mt-1 text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="w-full mr-2">
                                <input type="text" name="body" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm w-full" placeholder="SEO Body" autocomplete="off">
                                @error('body')
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
                        <button type="submit" class="px-4 mt-3 py-2 bg-indigo-600 rounded-md text-white w-fit">Submit</button>
                    </form>

                    @if (count($categories))
                        <table class="w-full mt-3 rounded-lg overflow-hidden">
                            <tr class="bg-white text-gray-800 text-center text-sm">
                                <th class="p-2 text-start">Name</th>
                                <th class="text-start">Slug</th>
                                <th class="text-start">Products</th>
                                <th class="p-2 text-end">Created</th>
                            </tr>
                            @foreach ($categories as $item)
                                <tr class="text-center text-sm">
                                    <td class="p-2 text-start">{{ $item->name }}</td>
                                    <td class="text-start">{{ $item->slug }}</td>
                                    <td class="text-start">{{ count($item->products) }}</td>
                                    <td class="p-2 text-end">{{ $item->created_at->diffForHumans() }}</td>
                                </tr>
                            @endforeach
                        </table>
                    @else
                        <p class="text-center mt-3">No product category exist!</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>