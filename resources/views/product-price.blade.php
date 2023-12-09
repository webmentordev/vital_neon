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
                                @foreach ($productNames as $product)
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
                            <th class="p-2 text-end">Updated</th>
                            <th class="p-2 text-end">Update</th>
                        </tr>
                        @foreach ($products as $item)
                            <tr class="text-center text-sm">
                                <td class="p-2 text-start">{{ $item->name }}</td>
                                <td class="p-2 text-start">{{ $item->product->name }}</td>
                                <td class="text-end">${{ $item->price }}</td>
                                <td class="p-2 text-end">{{ $item->created_at->diffForHumans() }}</td>
                                <td class="p-2 text-end">
                                    @if ($item->created_at == $item->updated_at)
                                        <span>Never</span>
                                    @else
                                        {{ $item->updated_at->diffForHumans() }}
                                    @endif
                                </td>
                                <td class="p-2 text-end" x-data="{ open: false }">
                                    <span x-on:click="open = true" class="underline cursor-pointer text-indigo-600 font-semibold">Edit</span>
                                    <div class="bg-white/90 backdrop-blur w-full h-full right-0 z-10 p-3 rounded-lg shadow-lg fixed top-0 left-0" x-show="open" x-cloak x-transition>
                                        <div class="flex items-center justify-center h-full w-full" x-on:click.self="open = false">
                                            <form action="{{ route('product.price.update', $item->id) }}" method="post" class="grid grid-cols-1 max-w-2xl bg-gray-100 p-6 rounded-lg">
                                                @csrf
                                                @method("PATCH")
                                                <h3 class="mb-3 text-gray-600 font-semibold text-start text-2xl">Update Price</h3>
                                                <div class="w-full mb-3">
                                                    <input type="text" name="up_name" value="{{ $item->name }}" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm w-full" placeholder="Name" autocomplete="off">
                                                    @error('up_name')
                                                        <p class="mt-1 text-red-600">{{ $message }}</p>
                                                    @enderror
                                                </div>
                        
                                                <div class="w-full mb-3">
                                                    <select name="up_product" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm w-full">
                                                        <option value="{{ $item->product->id }}" selected>(Now) {{ $item->product->name }}</option>
                                                        @foreach ($productNames as $product)
                                                            <option value="{{ $product->id }}">{{ $product->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('up_product')
                                                        <p class="mt-1 text-red-600">{{ $message }}</p>
                                                    @enderror
                                                </div>
                        
                                                <div class="w-full mb-3">
                                                    <input type="number" value="{{ $item->price }}" min="1" step="0.01" name="up_price" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm w-full" placeholder="Price">
                                                    @error('up_price')
                                                        <p class="mt-1 text-red-600">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <button type="submit" class="px-4 py-2 bg-indigo-600 rounded-md text-white">Submit</button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
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