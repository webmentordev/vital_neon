<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Product Pricing') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if (session('success'))
                        <p class="py-3 border-green-700 mb-3 text-center border bg-green-700 bg-opacity-40 text-white rounded-lg">{{ session('success') }}</p>
                    @endif
                    <h1 class="font-semibold mb-3">Create Price for Products</h1>
                    <form action="{{ route('product.price') }}" method="post" class="flex">
                        @csrf
                        <div class="w-full mr-2">
                            <input type="text" name="name" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm w-full" placeholder="Name" autocomplete="off">
                            @error('name')
                                <p class="mt-1 text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="w-full mr-2">
                            <select name="product" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm w-full">
                                @foreach ($products as $product)
                                    @if ($loop->first)
                                        <option value="{{ $product->id }}" selected>{{ $product->name }}</option>
                                    @else
                                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('product')
                                <p class="mt-1 text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="w-full mr-2">
                            <input type="number" min="1" step="0.01" name="price" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm w-full" placeholder="Price">
                            @error('price')
                                <p class="mt-1 text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <button type="submit" class="px-4 py-2 bg-indigo-600 rounded-md text-white">Submit</button>
                    </form>

                    <table class="w-full mt-3 rounded-lg overflow-hidden">
                        <tr class="bg-white text-gray-800 text-center text-sm">
                            <th class="p-2 text-start">Size</th>
                            <th class="p-2 text-start">Product</th>
                            <th class="text-end">Price</th>
                            <th class="p-2 text-end">Created</th>
                        </tr>
                        @foreach ($products as $item)
                            <tr class="text-center text-sm">
                                <td class="p-2 text-start">{{ $item->name }}</td>
                                <td class="p-2 text-start">{{ $item->product->name }}</td>
                                <td class="text-end">${{ $item->price }}</td>
                                <td class="p-2 text-end">{{ $item->created_at->diffForHumans() }}</td>
                            </tr>
                        @endforeach
                    </table>
                    @if ($products->hasPages())
                        <div class="pagination p-3 rounded-lg bg-gray-700">
                            {{ $products->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>