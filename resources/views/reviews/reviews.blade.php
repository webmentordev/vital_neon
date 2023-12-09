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
                            <th class="p-2 text-end">Image</th>
                            <th class="p-2 text-start">Name</th>
                            <th class="p-2 text-start">Date</th>
                            <th class="p-2 text-start">Review</th>
                            <th class="p-2 text-start">Stars</th>
                            <th class="p-2 text-end">URL</th>
                            <th class="p-2 text-end">Update</th>
                        </tr>
                        @foreach ($reviews as $item)
                            <tr class="text-sm odd:bg-gray-100">
                                <td class="p-2 text-start"><img class="bg-center bg-cover rounded-full" src="{{ asset('/storage/'.$item->image) }}" width="40px" height="40px"></td>
                                <td class="p-2 text-start">{{ $item->name }}</td>
                                <td class="p-2 text-start">{{ $item->date }}</td>
                                <td class="p-2 text-start">{{ $item->review }}</td>
                                <td class="p-2 text-start">{{ $item->star }}</td>
                                <td class="p-2 text-start"><a class="underline text-indigo-600 font-semibold" href="{{ $item->url }}">Visit</a></td>
                                <td class="p-2 text-start"><a class="underline text-indigo-600 font-semibold" href="{{ route('review.update', $item->id) }}">Update</a></td>
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