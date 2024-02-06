<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Searches') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if (session('success'))
                    @endif
                    <h1 class="font-semibold mb-3">Searches Database</h1>
                    <table class="w-full mt-3 rounded-lg overflow-hidden">
                        <tr class="bg-white text-gray-800 text-center text-sm">
                            <th class="p-3 text-start">Search</th>
                            <th class="p-3 text-start">Created</th>
                            <th class="p-3 text-end">Delete</th>
                        </tr>
                        @foreach ($searches as $item)
                            <tr class="text-center text-sm odd:bg-gray-600">
                                <td class="p-2 text-start">{{ $item->search }}</td>
                                <td class="p-2 text-start">{{ $item->created_at->diffForHumans() }}</td>
                                <td class="p-2 text-end">
                                    <form action="{{ route('searche.delete', $item->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="py-1 bg-red-600 text-white px-3 rounded-md" type="submit">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                    {{ $searches->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>