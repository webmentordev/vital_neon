<div>
    <div class="py-2">
        <div class="max-w-[99%] mx-auto">
            <div class="bg-white dark:bg-gray-800 overflow-hidden rounded-lg">
                <div class="p-2 text-gray-900 dark:text-gray-100">
                    <div class="w-full mb-2">
                        <x-form-input type="search" wire:model.live.throttle.1000ms="search"
                            placeholder="Search for the record..." />
                        @error('shape')
                            <p class="mt-1 text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    @if (session('success'))
                        <p class="success">{{ session('success') }}</p>
                    @endif
                    @if (count($leads))
                        <table class="w-full mt-3 rounded-lg overflow-hidden table-fixed text-sm leads-table">
                            <tr class="bg-white text-gray-800 text-center">
                                <th width="120px">ID</th>
                                <th width="190px">Name</th>
                                <th width="220px">Email</th>
                                <th width="210px">Phone</th>
                                <th width="160px">Budget</th>
                                <th width="160px">Content</th>
                                <th width="80px">Files</th>
                                <th class="text-end" width="120px">Completed</th>
                                <th class="text-end" width="140px">Ip</th>
                                <th class="text-end">Source</th>
                                <th class="text-end">Created</th>
                            </tr>
                            @foreach ($leads as $item)
                                <tr>
                                    <td>{{ Str::afterLast($item->uuid, '-') }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->email ? $item->email : '-' }}</td>
                                    <td>{{ $item->phone_number ? $item->phone_number : '-' }}</td>
                                    <td>{{ $item->budget ? '$' . number_format($item->budget, 2) : '-' }}</td>
                                    @php
                                        $logos = $item->logos ? json_decode($item->logos) : [];
                                    @endphp
                                    <td x-data="{ open: false }">
                                        <button class="text-main font-semibold underline" @click="open = true">Open
                                            Content</button>
                                        <div class="fixed top-0 left-0 h-full w-full bg-dark/90 backdrop-blur" x-show="open"
                                            x-cloak x-transition>
                                            <div class="w-full h-full flex items-center justify-center"
                                                @click.self="open = false">
                                                <div class="max-w-3xl bg-white rounded-lg w-full p-6 text-black">
                                                    <div class="flex justify-between mb-2 bg-gray-200 rounded-lg p-2">
                                                        <strong>Location</strong>
                                                        <span>{{ $item->location ? $item->location : '-' }}</span>
                                                    </div>
                                                    <div class="flex justify-between mb-2 p-2">
                                                        <strong class="mr-2">Dimensions</strong>
                                                        <span>{{ $item->dimensions ? $item->dimensions : '-' }}</span>
                                                    </div>
                                                    <div class="flex justify-between mb-3 bg-gray-200 rounded-lg p-2">
                                                        <span>{{ $item->user_agent ? $item->user_agent : '-' }}</span>
                                                    </div>
                                                    <div class="mb-2 bg-gray-200 rounded-lg p-2 flex flex-col">
                                                        <strong class="text-md mb-2">📩 Message:</strong>
                                                        <span>{{ $item->message ? $item->message : '-' }}</span>
                                                    </div>
                                                    <div class="mb-2 bg-gray-200 rounded-lg p-2 flex flex-col">
                                                        <strong class="text-md mb-2">📟 Designs:</strong>
                                                        @if (count($logos))
                                                            @foreach ($logos as $logo)
                                                                <div
                                                                    class="bg-white mb-3 p-2 rounded-lg flex items-center justify-between">
                                                                    <p>File #{{ $loop->index + 1 }} - <span
                                                                            class="py-1 px-2 rounded-md bg-yellow-300 capitalize">{{ Str::afterLast($logo, '.') }}</span>
                                                                    </p>
                                                                    <a href="{{ asset('storage/' . $logo) }}" target="_blank"
                                                                        class="py-1 px-3 rounded-md bg-green-700 text-white">Open the
                                                                        file</a>
                                                                </div>
                                                            @endforeach
                                                        @else
                                                            No File uploads yet!
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ count($logos) }}</td>
                                    <td class="text-end">@if ($item->is_completed)
                                        <span class="py-1 px-3 bg-green-700 rounded-lg">Yes</span>
                                    @else
                                            <span class="py-1 px-3 bg-red-700 rounded-lg">No</span>
                                        @endif
                                    </td>
                                    <td class="text-end">{{ $item->ip_address }}</td>
                                    <td class="text-end capitalize">{{ $item->source ? $item->source : '-' }}</td>
                                    <td class="text-end flex items-center" x-data="{ open: false }">
                                        {{ $item->created_at->format('d M Y H:i A') }} -
                                        <img @click="open = true" class="cursor-pointer"
                                            src="https://api.iconify.design/material-symbols:delete-forever-outline-sharp.svg?color=%23f11e1e">
                                        <div x-show="open" x-cloak x-transition
                                            class="top-0 left-0 fixed w-full h-full z-50 bg-black/30 backdrop-blur-sm">
                                            <div class="w-full h-full flex items-center justify-center"
                                                @click.self="open = false">
                                                <div class="max-w-lg w-full p-5 rounded-lg bg-white">
                                                    <h3 class="text-black mb-3">Are you sure you want to delete this lead? the
                                                        action is Irréversible</h3>
                                                    <div class="grid grid-cols-2 gap-3">
                                                        <button type="button" wire:click="delete('{{ $item->id }}')"
                                                            class="py-2 px-3 bg-green-700 w-full rounded-md">Confirm</button>
                                                        <button type="button" @click="open = false"
                                                            class="py-2 px-3 bg-black w-full rounded-md">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    @else
                        <p class="py-2 text-center">No leads found in the system!</p>
                    @endif
                    @if ($leads->hasPages())
                        <div class="pagination p-3 rounded-lg bg-gray-700">
                            {{ $leads->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>