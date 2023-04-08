<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Products') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
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
                                <input type="file" name="image" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 p-[6px] px-2 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm w-full" autocomplete="off">
                                @error('image')
                                    <p class="mt-1 text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <button type="submit" class="px-4 py-2 bg-main rounded-md text-white">Submit</button>
                        </div>
                        <textarea class="form-control" id="summary-ckeditor" name="body">{{ old('body') }}</textarea>
                    </form>

                    <table class="w-full mt-3 rounded-lg overflow-hidden">
                        <tr class="bg-white text-gray-800 text-center text-sm">
                            <th class="p-3 text-start">Name</th>
                            <th class="p-3 text-start">StripeID</th>
                            <th class="p-3 text-start">Image</th>
                            <th class="p-3 text-start">Slug</th>
                            <th class="text-start">Description</th>
                            <th class="text-end">Featured</th>
                            <th class="p-3 text-end">Created</th>
                        </tr>
                        @foreach ($products as $item)
                            <tr class="text-center text-sm">
                                <td class="p-2 text-start">{{ $item->name }}</td>
                                <td class="p-2 text-start">{{ $item->stripe_id }}</td>
                                <td class="p-2 text-start"><a href="{{ asset('storage/'.$item->image) }}"><img src="{{ asset('storage/'.$item->image) }}" width="60"></a></td>
                                <td class="p-2 text-start">{{ $item->slug }}</td>
                                <td class="text-start">{!! $item->body !!}</td>
                                <td class="text-end">{{ $item->featured }}</td>
                                <td class="p-2 text-end">{{ $item->created_at->diffForHumans() }}</td>
                            </tr>
                        @endforeach
                    </table>
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