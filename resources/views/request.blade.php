<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Design Requests') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if (session('success'))
                    @endif
                    <h1 class="font-semibold mb-3">Design Requests Database</h1>
                    @if (count($designs))
                        <table class="w-full mt-3 rounded-lg overflow-hidden">
                            <tr class="bg-white text-gray-800 text-center text-sm">
                                <th class="p-3 text-start">Name</th>
                                <th class="p-3 text-start">Email</th>
                                <th class="p-3 text-start">File</th>
                                <th class="p-3 text-start">Budget</th>
                                <th class="p-3 text-start">Message</th>
                                <th class="p-3 text-start">Size</th>
                                <th class="p-3 text-end">Created</th>
                            </tr>
                            @foreach ($designs as $item)
                                <tr class="text-center text-sm">
                                    <td class="p-2 text-start">{{ $item->name }}</td>
                                    <td class="p-2 text-start">{{ $item->email }}</td>
                                    <td class="p-2 text-start"><a href="{{ asset('storage/'.$item->image) }}"><img src="{{ asset('storage/'.$item->image) }}" width="60"></a></td>
                                    <td class="p-2 text-start">${{ $item->budget }}</td>
                                    <td class="text-start" x-data="{ open: false }">
                                        <span x-on:click="open = true" class="text-blue-400 px-3 underline cursor-pointer">Read</span>
                                        <div x-show="open" x-cloak x-on:click.self="open = false" class="fixed bg-dark bg-opacity-80 backdrop-blur-md top-0 left-0 w-full h-full flex items-center justify-center">
                                            <div class="max-w-4xl w-full p-6 bg-white text-dark rounded-md">
                                                <div>
                                                    <h1 class="text-2xl mb-2 font-semibold">Description</h1>
                                                    <p>{!! $item->message !!}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="p-2 text-start">{{ $item->size }}</td>
                                    <td class="p-2 text-end">{{ $item->created_at->diffForHumans() }}</td>
                                </tr>
                            @endforeach
                        </table>
                        @if ($designs->hasPages())
                            <div class="pagination p-3 rounded-lg bg-gray-700">
                                {{ $designs->links() }}
                            </div>
                        @endif
                    @else
                        <p class="text-center text-lg text-white mt-3">No Design request received!</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>