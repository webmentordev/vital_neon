<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Orders') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-[95%] mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if (session('success'))
                        <p class="py-3 border-green-700 mb-3 text-center border bg-green-700 bg-opacity-40 text-white rounded-lg">{{ session('success') }}</p>
                    @endif
                    <table class="w-full mt-3 rounded-lg overflow-hidden">
                        <tr class="bg-white text-gray-800 text-center text-sm">
                            <th class="p-2 text-start">CheckoutID</th>
                            <th class="p-2 text-start">Name</th>
                            <th class="p-2 text-start">Quantity</th>
                            <th class="p-2 text-start">Details</th>
                            <th class="p-2 text-start">Status</th>
                            <th class="text-start">Price</th>
                            <th class="p-2 text-end">Shipping</th>
                            <th class="p-2 text-end">Created</th>
                            <th class="p-2 text-end">Address</th>
                        </tr>
                        @foreach ($orders as $item)
                            <tr class="text-center text-sm">
                                <td class="p-2 text-start">{{ $item->checkout_id }}</td>
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
                                <td class="text-end py-2">
                                    @if ($item->status != 'Cancelled')
                                        <form action="{{ route('orders.status', $item->checkout_id) }}" method="post">
                                            @csrf
                                            @method('PATCH')
                                            <select name="shipping" onchange="this.form.submit()" class="bg-slate-800 text-white rounded-lg">
                                                <option value="{{ $item->shipping }}" selected class="capitalize">{{ $item->shipping }}</option>
                                                <option value="processing">Processing</option>
                                                <option value="processed">Processed</option>
                                                <option value="transit">Transit</option>
                                                <option value="completed">Completed</option>
                                                <option value="cancelled">Cancelled</option>
                                            </select>
                                        </form>
                                    @else
                                        <span class="text-red-600">Cancelled</span>
                                    @endif
                                </td>
                                <td class="p-2 text-end">{{ $item->created_at->diffForHumans() }}</td>
                                <td class="p-2 text-end">
                                    <div x-data="{ open: false }">
                                        <span x-on:click="open = !open" class="text-blue-400 underline cursor-pointer">View</span>
                                        <div class="p-6 rounded-xl  w-[400px] text-start fixed bottom-3 right-3 bg-black z-10" x-show="open" x-transition x-cloak>
                                            <div class="relative">
                                                <span x-on:click="open = false" class="absolute -top-8 cursor-pointer p-1 px-2 rounded-full bg-red-600/10 text-red-600 -left-8">X</span>
                                                <p class="mb-1"><b>Name:</b> {{ $item->address->name }}</p>
                                                <p class="mb-1"><b>Email:</b> {{ $item->address->email }}</p>
                                                <p class="mb-1"><b>Phone:</b> {{ $item->address->number }}</p>
                                                <p><b>Address:</b> {{ $item->address->address }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                    @if ($orders->hasPages())
                        <div class="pagination p-3 rounded-lg bg-gray-700">
                            {{ $orders->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
