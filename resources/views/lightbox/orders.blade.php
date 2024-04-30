<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('LightBox Orders') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-[98%] mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if (session('success'))
                        <p class="py-3 border-green-700 mb-3 text-center border bg-green-700 bg-opacity-40 text-white rounded-lg">{{ session('success') }}</p>
                    @endif
                    @if (count($orders))
                        <table class="w-full mt-3 rounded-lg overflow-hidden">
                            <tr class="bg-white text-gray-800 text-center text-sm">
                                <th class="p-3 text-start">ID</th>
                                <th class="p-3 text-start">Name</th>
                                <th class="p-3 text-start">Email</th>
                                <th class="p-3 text-start">Remote</th>
                                <th class="p-3 text-start">Price</th>
                                <th class="p-3 text-start">Status</th>
                                <th class="p-3 text-end">Created</th>
                                <th class="p-3 text-end">Updated</th>
                                <th class="p-3 text-end">URL</th>
                            </tr>
                            @foreach ($orders as $item)
                                <tr class="text-center text-sm">
                                    <td class="p-2 text-start">{{ $item->checkout_id }}</td>
                                    <td class="p-2 text-start">{{ $item->title }}</td>
                                    <td class="p-2 text-start">{{ $item->email }}</td>
                                    <td class="p-2 text-start capitalize">{{ $item->remote }}</td>
                                    <td class="p-2 text-start">${{ number_format($item->price, 2) }}</td>
                                    <td class="p-2 text-start text-black">
                                        @if ($item->status == 'pending')
                                            <form action="{{ route('order.status', $item->checkout_id) }}" method="post">
                                                @csrf
                                                @method('PATCH')
                                                <select name="status" class="p-1 rounded-lg w-full" onchange="this.form.submit()">
                                                    <option value="{{ $item->status }}" selected class="capitalize">{{ $item->status }} - currently</option>
                                                    <option value="processed">Processed</option>
                                                    <option value="transit">In-Transit</option>
                                                    <option value="completed">Completed</option>
                                                    <option value="canceled">Canceled</option>
                                                    <option value="refunded">Refunded</option>
                                                </select>
                                            </form>
                                        @elseif ($item->status == 'processed')
                                            <form action="{{ route('order.status', $item->checkout_id) }}" method="post">
                                                @csrf
                                                @method('PATCH')
                                                <select name="status" class="p-1 rounded-lg w-full">
                                                    <option value="{{ $item->status }}" selected class="capitalize">{{ $item->status }} - currently</option>
                                                    <option value="transit">In-Transit</option>
                                                    <option value="completed">Completed</option>
                                                    <option value="canceled">Canceled</option>
                                                    <option value="refunded">Refunded</option>
                                                </select>
                                                <div class="grid grid-cols-3 gap-1 mt-1">
                                                    <input type="text" class="p-1 rounded-lg w-full" name="transit_id" placeholder="TrackingID">
                                                    <input type="text" class="p-1 rounded-lg w-full" name="logistics" placeholder="Logistics">
                                                    <button type="submit" class="bg-indigo-500 text-white font-semibold p-1 rounded-lg w-full">Send</button>
                                                </div>
                                                
                                            </form>
                                        @elseif ($item->status == 'transit')
                                            <form action="{{ route('order.status', $item->checkout_id) }}" method="post">
                                                @csrf
                                                @method('PATCH')
                                                <select name="status" class="p-1 rounded-lg w-full" onchange="this.form.submit()">
                                                    <option value="{{ $item->status }}" selected class="capitalize">{{ $item->status }} - currently</option>
                                                    <option value="completed">Completed</option>
                                                    <option value="refunded">Refunded</option>
                                                </select>
                                            </form>
                                        @elseif ($item->status == 'completed')
                                            <strong class="capitalize bg-green-500 py-1 px-2 rounded-md">{{ $item->status }}</strong>
                                        @elseif ($item->status == 'refunded')
                                            <strong class="capitalize bg-blue-500 py-1 px-2 rounded-md">{{ $item->status }}</strong>
                                        @elseif ($item->status == 'canceled')
                                            <strong class="capitalize bg-red-500 py-1 px-2 rounded-md">{{ $item->status }}</strong>
                                        @endif
                                    </td>
                                    <td class="p-2 text-end">{{ $item->created_at->diffForHumans() }}</td>
                                    <td class="p-2 text-end">{{ $item->updated_at->diffForHumans() }}</td>
                                    <td class="p-2 text-end" x-data="{ open: false }">
                                        <span x-on:click="open = true" class="text-blue-400 underline cursor-pointer">Read</span>
                                        <div x-show="open" x-cloak x-on:click.self="open = false" class="fixed bg-dark bg-opacity-80 backdrop-blur-md top-0 left-0 w-full h-full flex items-center justify-center">
                                            <div class="max-w-7xl p-6 bg-white text-dark rounded-md text-start">
                                                <div class="w-full max-w-7xl overflow-hidden">
                                                    <h1 class="text-2xl mb-2 font-semibold">CheckoutURL</h1>
                                                    <p class="text-wrap">{{ $item->url }}</p>
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
                    @else
                        <p class="text-center py-12">No orders Data exist!</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>