<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('LightBox') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-[98%] mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if (session('success'))
                        <p class="py-3 border-green-700 mb-3 text-center border bg-green-700 bg-opacity-40 text-white rounded-lg">{{ session('success') }}</p>
                    @endif
                    <h1 class="font-semibold mb-3">Create LightBox</h1>
                    <form action="{{ route('lightbox.create') }}" enctype="multipart/form-data" method="post" class="flex flex-col">
                        @csrf
                        <div class="flex mb-3">
                            <div class="w-full mr-2">
                                <input type="text" name="title" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm w-full" placeholder="Title" value="{{ old('title') }}" autocomplete="off">
                                @error('title')
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
                                <input type="number" step="0.01" min="1" name="price" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm w-full" placeholder="Price" value="{{ old('price') }}" autocomplete="off">
                                @error('price')
                                    <p class="mt-1 text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <button type="submit" class="px-4 py-2 bg-indigo-600 rounded-md text-white">Submit</button>
                        </div>
                        <div class="grid grid-cols-2 mb-3 gap-6">
                            <div class="w-full">
                                <label>Light Image</label>
                                <input type="file" name="light_image" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 p-[6px] px-2 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm w-full" autocomplete="off">
                                @error('light_image')
                                    <p class="mt-1 text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="w-full">
                                <label>Dark Image <span class="text-sm">*optional</span></label>
                                <input type="file" name="dark_image" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 p-[6px] px-2 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm w-full" autocomplete="off">
                                @error('dark_image')
                                    <p class="mt-1 text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="w-full mb-3">
                            <input type="text" name="description" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm w-full" placeholder="SEO Description" value="{{ old('description') }}" autocomplete="off">
                            @error('description')
                                <p class="mt-1 text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <textarea class="form-control" id="summary-ckeditor" name="body">{{ old('body') }}</textarea>
                    </form>

                    <form action="{{ route('lightbox') }}" method="GET" class="flex my-4">
                        <div class="w-full mr-2">
                            <input type="search" name="search" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm w-full" placeholder="Search by name..." autocomplete="off">
                        </div>
                        <button type="submit" class="px-4 py-2 bg-indigo-600 rounded-md text-white">Search</button>
                    </form>

                    @if (count($lightboxes))
                        <table class="w-full mt-3 rounded-lg overflow-hidden">
                            <tr class="bg-white text-gray-800 text-center text-sm">
                                <th class="p-3 text-start">Name</th>
                                <th class="p-3 text-start">StripeID</th>
                                <th class="p-3 text-start">DarkImage</th>
                                <th class="p-3 text-start">Price</th>
                                <th class="p-3 text-start">Slug</th>
                                <th class="text-start">Description</th>
                                <th class="text-end">Featured</th>
                                <th class="text-end">Status</th>
                                <th class="p-3 text-end">Created</th>
                                <th class="p-3 text-end">Updated</th>
                                <th class="p-3 text-end">Edit</th>
                            </tr>
                            @foreach ($lightboxes as $item)
                                <tr class="text-center text-sm">
                                    <td class="p-2 text-start">{{ $item->title }}</td>
                                    <td class="p-2 text-start">{{ $item->stripe_id }}</td>
                                    <td class="p-2 text-start">
                                        @if ($item->dark_image)
                                            <span class="rounded-full p-1 bg-green-600 text-white">YES</span>
                                        @else
                                            <span class="rounded-full p-1 bg-red-600 text-white">NO</span>
                                        @endif
                                    </td>
                                    <td class="p-2 text-start">${{ number_format($item->price, 2) }}</td>
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
                                        <form action="{{ route('feature.lightbox', $item->slug) }}" method="post">
                                            @csrf
                                            @method('PATCH')
                                            <button class="font-bold @if ($item->is_featured) bg-green-500 text-white @else bg-yellow-500 text-black @endif py-1 px-3">
                                                @if ($item->is_featured)
                                                    Featured
                                                @else
                                                    UnFeatured
                                                @endif
                                            </button>
                                        </form>
                                    </td>
                                    <td class="text-end p-2">
                                        <form action="{{ route('status.lightbox', $item->slug) }}" method="post">
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
                                    <td class="p-2 text-end">{{ $item->updated_at->diffForHumans() }}</td>
                                    <td class="p-2 text-end"><a href="{{ route('lightbox.update', $item->slug) }}" class="underline text-blue-600">Edit</a></td>
                                </tr>
                            @endforeach
                        </table>
                        @if ($lightboxes->hasPages())
                            <div class="pagination p-3 rounded-lg bg-gray-700">
                                {{ $lightboxes->links() }}
                            </div>
                        @endif
                    @else
                        <p class="text-center py-12">No lightbox Data exist!</p>
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