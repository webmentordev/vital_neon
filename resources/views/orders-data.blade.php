<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Orders') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if (session('success'))
                        <p class="py-3 border-green-700 mb-3 text-center border bg-green-700 bg-opacity-40 text-white rounded-lg">{{ session('success') }}</p>
                    @endif
                    <table class="w-full mt-3 rounded-lg overflow-hidden">
                        <tr class="bg-white text-gray-800 text-center text-sm">
                            <th class="p-2 text-start">Name</th>
                            <th class="p-2 text-start">Quantity</th>
                            <th class="p-2 text-start">Details</th>
                            <th class="p-2 text-start">Status</th>
                            <th class="text-start">Price</th>
                            <th class="p-2 text-end">Shipping</th>
                            <th class="p-2 text-end">Created</th>
                        </tr>
                        @foreach ($orders as $item)
                            <tr class="text-center text-sm">
                                <td class="p-2 text-start">{{ $item->name }}</td>
                                <td class="p-2 text-start">{{ $item->quantity }}</td>
                                <td class="p-2 text-start">{{ $item->details }}</td>
                                <td class="p-2 text-start">
                                    @if ($item->status == 'pending' )
                                        <span class="p-2 text-yellow-400">{{ $item->status }}</span>
                                    @elseif($item->status == 'success')
                                        <span class="p-2 text-green-600">{{ $item->status }}</span>
                                    @else
                                        <span class="p-2 text-red-600">{{ $item->status }}</span>
                                    @endif
                                </td>
                                <td class="text-start">${{ $item->price }}</td>
                                <td class="text-end">{{ $item->shipping }}</td>
                                <td class="p-2 text-end">{{ $item->created_at->diffForHumans() }}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
