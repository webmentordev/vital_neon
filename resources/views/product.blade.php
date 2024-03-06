<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Products') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-[98%] mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if (session('success'))
                        <p class="py-3 border-green-700 mb-3 text-center border bg-green-700 bg-opacity-40 text-white rounded-lg">{{ session('success') }}</p>
                    @endif
                    <h1 class="font-semibold mb-3">Create Product</h1>
                    <form action="{{ route('product') }}" enctype="multipart/form-data" method="post" class="flex flex-col">
                        @csrf
                        <div class="flex mb-3">
                            <div class="w-full mr-2">
                                <input type="text" name="name" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm w-full" placeholder="Name" value="{{ old('name') }}" autocomplete="off">
                                @error('name')
                                    <p class="mt-1 text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="w-full mr-2">
                                <input type="text" name="slug" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm w-full" placeholder="Slug" value="{{ old('slug') }}" autocomplete="off">
                                @error('slug')
                                    <p class="mt-1 text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="w-full mr-2">
                                <select name="category" id="category" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 p-[6px] px-2 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm w-full" required>
                                    <option value="" selected>__Select Category__</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('category')
                                    <p class="mt-1 text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="w-full mr-2">
                                <input type="file" name="image" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 p-[6px] px-2 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm w-full" autocomplete="off">
                                @error('image')
                                    <p class="mt-1 text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <button type="submit" class="px-4 py-2 bg-indigo-600 rounded-md text-white">Submit</button>
                        </div>
                        <div class="w-full mb-3">
                            <input type="text" name="description" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm w-full" placeholder="SEO Description" value="{{ old('description') }}" autocomplete="off">
                            @error('description')
                                <p class="mt-1 text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <textarea class="form-control" id="summary-ckeditor" name="body">{{ old('body') }}</textarea>
                    </form>

                    <form action="{{ route('product') }}" method="GET" class="flex my-4">
                        <div class="w-full mr-2">
                            <input type="search" name="search" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm w-full" placeholder="Search by name..." autocomplete="off">
                        </div>
                        <button type="submit" class="px-4 py-2 bg-indigo-600 rounded-md text-white">Search</button>
                    </form>

                    @if (count($products))
                        <table class="w-full mt-3 rounded-lg overflow-hidden">
                            <tr class="bg-white text-gray-800 text-center text-sm">
                                <th class="p-3 text-start">Name</th>
                                <th class="p-3 text-start">StripeID</th>
                                {{-- <th class="p-3 text-start">Image</th> --}}
                                <th class="p-3 text-start">Slug</th>
                                <th class="text-start">Description</th>
                                <th class="text-end">Featured</th>
                                <th class="text-end">Status</th>
                                <th class="p-3 text-end">Created</th>
                                <th class="p-3 text-end">Edit</th>
                            </tr>
                            @foreach ($products as $item)
                                <tr class="text-center text-sm">
                                    <td class="p-2 text-start">{{ $item->name }}</td>
                                    <td class="p-2 text-start">{{ $item->stripe_id }}</td>
                                    {{-- <td class="p-2 text-start"><a href="{{ asset('storage/'.$item->image) }}"><img src="{{ asset('storage/'.$item->image) }}" width="60"></a></td> --}}
                                    <td class="p-2 text-start">{{ $item->slug }}</td>
                                    <td class="text-start" x-data="{ open: false }">
                                        <span x-on:click="open = true" class="text-blue-400 underline cursor-pointer">Read</span>
                                        <div x-show="open" x-cloak x-on:click.self="open = false" class="fixed bg-dark bg-opacity-80 backdrop-blur-md top-0 left-0 w-full h-full flex items-center justify-center">
                                            <div class="max-w-7xl p-6 bg-white text-dark rounded-md">
                                                <div>
                                                    <h1 class="text-2xl mb-2 font-semibold">Description</h1>
                                                    <p>{!! $item->body !!}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-end p-2">
                                        <form action="{{ route('product.feature', $item->slug) }}" method="post">
                                            @csrf
                                            @method('PATCH')
                                            <button class="font-bold @if ($item->featured) bg-green-500 text-white @else bg-yellow-500 text-black @endif py-1 px-3">
                                                @if ($item->featured)
                                                    Featured
                                                @else
                                                    UnFeatured
                                                @endif
                                            </button>
                                        </form>
                                    </td>
                                    <td class="text-end p-2">
                                        <form action="{{ route('product.status', $item->slug) }}" method="post">
                                            @csrf
                                            @method('PATCH')
                                            <button class="@if ($item->is_active) bg-blue-500 @else bg-red-500 @endif text-white py-1 px-3">
                                                @if ($item->is_active)
                                                    Active
                                                @else
                                                    InActive
                                                @endif
                                            </button>
                                        </form>
                                    </td>
                                    <td class="p-2 text-end">{{ $item->created_at->diffForHumans() }}</td>
                                    <td class="p-2 text-end"><a href="{{ route('product.update', $item->slug) }}" class="underline text-blue-600">Edit</a></td>
                                </tr>
                            @endforeach
                        </table>
                        @if ($products->hasPages())
                            <div class="pagination p-3 rounded-lg bg-gray-700">
                                {{ $products->links() }}
                            </div>
                        @endif
                    @else
                        <p class="text-center py-12">No products Data exist!</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace( 'summary-ckeditor', {
            filebrowserUploadUrl: "{{route('upload', ['_token' => csrf_token() ])}}",
            filebrowserUploadMethod: 'form'
        });
    </script>
</x-app-layout>