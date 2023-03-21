<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Size Database') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if (session('success'))
                        <p class="py-3 border-green-700 mb-3 text-center border bg-green-700 bg-opacity-40 text-white rounded-lg">{{ session('success') }}</p>
                    @endif
                    <h1 class="font-semibold mb-3">Create Size</h1>
                    <form action="{{ route('size') }}" method="post" class="flex">
                        @csrf
                        <div class="w-full mr-2">
                            <input type="text" name="size" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm w-full" placeholder="Size">
                            @error('size')
                                <p class="mt-1 text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="w-full mr-2">
                            <input type="number" min="1" step="0.01" name="width" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm w-full" placeholder="Width">
                            @error('width')
                                <p class="mt-1 text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="w-full mr-2">
                            <input type="number" min="1" step="0.01" name="height" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm w-full" placeholder="Height">
                            @error('height')
                                <p class="mt-1 text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="w-full mr-2">
                            <input type="number" min="1" step="0.01" name="price" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm w-full" placeholder="Price">
                            @error('price')
                                <p class="mt-1 text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <button type="submit" class="px-4 py-2 bg-main rounded-md text-white">Submit</button>
                    </form>

                    <table class="w-full mt-3 rounded-lg overflow-hidden">
                        <tr class="bg-white text-gray-800 text-center text-sm">
                            <th class="p-2 text-start">Size</th>
                            <th>Width</th>
                            <th>Height</th>
                            <th>Price</th>
                            <th class="p-2 text-end">Created</th>
                        </tr>
                        @foreach ($sizes as $item)
                            <tr class="text-center text-sm">
                                <td class="p-2 text-start">{{ $item->size }}</td>
                                <td>{{ $item->width }} Inches</td>
                                <td>{{ $item->height }} Inches</td>
                                <td>${{ $item->price }}</td>
                                <td class="p-2 text-end">{{ $item->created_at->diffForHumans() }}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
