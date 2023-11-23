<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Reviews') }}
            </h2>
            <a href="{{ route('create.review') }}" class="py-2 px-4 rounded-md bg-indigo-600 text-white font-semibold">Create Review</a>
        </div>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                @if (count($reviews))
                    <table class="w-full">
                        <tr class="text-sm text-white bg-gray-800">
                            <th class="p-2 text-start">Name</th>
                            <th class="p-2 text-start">Title</th>
                            <th class="p-2 text-start">Location</th>
                            <th class="p-2 text-start">Date</th>
                            <th class="p-2 text-start">Color</th>
                            <th class="p-2 text-start">Url</th>
                            <th class="p-2 text-start">Update</th>
                        </tr>
                        @foreach ($reviews as $item)
                            <tr class="text-sm odd:bg-gray-100">
                                <td class="p-2 text-start">{{ $item->name }}</td>
                                <td class="p-2 text-start">{{ $item->title }}</td>
                                <td class="p-2 text-start">{{ $item->location }}</td>
                                <td class="p-2 text-start">{{ $item->date }}</td>
                                <td class="p-2 text-start">{{ $item->color }}</td>
                                <td class="p-2 text-start"><a href="{{ $item->url }}" target="_blank" class="text-start underline text-blue-600">Visit</a></td>
                                <td class="p-2 text-start"><a href="{{ route('review.update', $item->id) }}" class="text-start underline text-blue-600">Update</a></td>
                            </tr>
                        @endforeach
                    </table>
                    @if ($reviews->hasPages())
                        <div class="py-3">
                            {{ $reviews->links() }}
                        </div>
                    @endif
                @else
                    <p class="py-3 text-center">No reviews data exist!</p>
                @endif
            </div>
        </div>
    </div>
    </x-app-layout>