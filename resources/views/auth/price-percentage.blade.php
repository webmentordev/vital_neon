<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Price Pertentage') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if (session('success'))
                        <p class="py-3 border-green-700 mb-3 text-center border bg-green-700 bg-opacity-40 text-white rounded-lg">{{ session('success') }}</p>
                    @endif
                    <h1 class="font-semibold mb-3">Price Pertentage Database</h1>
                    <form action="{{ route('price.percentage') }}" method="post" class="flex items-center">
                        @csrf
                        <div class="w-full mr-2">
                            <input type="number" step="0.01" name="percentage" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm w-full" placeholder="Percentage Increment" value="{{ old('percentage') }}" autocomplete="off">
                            @error('percentage')
                                <p class="mt-1 text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <button type="submit" class="px-4 py-2 bg-indigo-600 rounded-md text-white">Create</button>
                        
                    </form>
                    @if (count($prices))
                        <table class="w-full mt-3 rounded-lg overflow-hidden">
                            <tr class="bg-white text-gray-800 text-center text-sm">
                                <th class="p-3 text-start">Percentage</th>
                                <th class="p-3 text-start">Status</th>
                                <th class="p-3 text-end">Created</th>
                            </tr>
                            @foreach ($prices as $item)
                                <tr class="text-center text-sm">
                                    <td class="p-2 text-start">{{ $item->percentage }}%</td>
                                    <td class="p-2 text-start">{{ $item->is_active }}</td>
                                    <td class="p-2 text-end">{{ $item->created_at->diffForHumans() }}</td>
                                </tr>
                            @endforeach
                        </table>
                    @else
                        <p class="text-center text-lg text-white mt-3">No price increments request received!</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>