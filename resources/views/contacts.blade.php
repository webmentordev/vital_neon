<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Support') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if (session('success'))
                        <p class="py-3 border-green-700 mb-3 text-center border bg-green-700 bg-opacity-40 text-white rounded-lg">{{ session('success') }}</p>
                    @endif
                    <h1 class="font-semibold mb-3">Support Contacts</h1>
                    <table class="w-full mt-3 rounded-lg overflow-hidden">
                        <tr class="bg-white text-gray-800 text-center text-sm">
                            <th class="p-2 text-start">Ticket#</th>
                            <th class="p-2 text-start">Name</th>
                            <th class="text-start">Email</th>
                            <th class="text-start">Subject</th>
                            <th class="px-4 text-end">Message</th>
                            <th class="p-2 text-end">Created</th>
                        </tr>
                        @foreach ($contacts as $item)
                            <tr class="text-center text-sm">
                                <td class="p-2 text-start">{{ $item->ticket }}</td>
                                <td class="p-2 text-start">{{ $item->name }}</td>
                                <td class="text-start">{{ $item->email }}</td>
                                <td class="px-4 text-end">{{ $item->subject }}</td>
                                <td class="px-4 text-end" x-data="{open:false}">
                                    <span class="text-blue-600 underline font-semibold cursor-pointer" x-on:click="open = true">Read</span>
                                    <div class="fixed z-20 w-full text-start left-0 top-0 h-full bg-opacity-25 px-6 backdrop-blur-lg flex items-center justify-center" x-show="open" x-cloak x-on:click.self="open = false">
                                        <div class="max-w-lg bg-white rounded-lg w-full p-6 relative">
                                            <p class="text-gray-900">{{ $item->message }}</p>
                                            <span class="bg-red-600 p-2 rounded-full text-white absolute -top-5 -right-4 px-3" x-on:click="open = false">X</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="p-2 text-end">{{ $item->created_at->diffForHumans() }}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>