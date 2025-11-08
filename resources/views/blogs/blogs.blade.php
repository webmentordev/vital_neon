<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl text-white leading-tight">
                {{ __('Blogs Database') }}
            </h2>
            <a href="{{ route('blog.create') }}" class="py-2 bg-indigo-600 text-white px-4 rounded-md text-sm">Create Blogs</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-[95%] mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <p class="py-4 border-green-600 border text-center bg-green-700/20 rounded-lg mb-3 text-green-600">{{ session('success') }}</p>
            @endif
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @if (count($blogs))
                    <table class="w-full">
                        <tr class="text-[12px] text-white bg-gray-800">
                            <th class="p-2 text-start">ID</th>
                            <th class="p-2 text-start">Title</th>
                            <th class="p-2 text-start">Slug</th>
                            <th class="text-end p-2">Created</th>
                            <th class="text-end p-2">Image</th>
                            <th class="text-end p-2">Edit</th>
                            <th class="text-end p-2">Status</th>
                        </tr>
                        @foreach ($blogs as $item)
                            <tr class="text-[12px] odd:bg-gray-100">
                                <td class="p-2 text-start">#{{ $item->id }}</td>
                                <td class="p-2 text-start">{{ $item->title }}</td>
                                <td class="text-start">{{ $item->slug }}</td>
                                <td class="text-end p-2">{{ $item->created_at->format('D d-M-Y H:i:s A') }}</td>
                                <td class="text-end p-2"><a class="underline text-blue-500" href="{{ asset('/storage/'. $item->thumbnail) }}">View</a></td>
                                <td class="text-end p-2"><a class="underline text-blue-500" href="{{ route('blog.update', $item->slug) }}">Edit</a></td>
                                <td class="text-end p-2">
                                    <form action="{{ route('status.blog', $item->id) }}" method="post">
                                        @csrf
                                        @if ($item->is_active)
                                            <button type="submit" class="py-1 px-4 rounded-md bg-green-600 text-white">Active</button>
                                        @else
                                            <button type="submit" class="py-1 px-4 rounded-md bg-red-600 text-white">Inactive</button>
                                        @endif
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                    @if ($blogs->hasPages())
                        <div class="py-3">
                            {{ $blogs->links() }}
                        </div>
                    @endif
                @else
                    <p class="py-3 text-center">No blogs data exist!</p>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>