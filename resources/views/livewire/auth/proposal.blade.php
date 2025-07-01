<div>
    <div class="py-2">
        <div class="max-w-[99%] mx-auto">
            <div class="bg-white dark:bg-gray-800 rounded-lg">
                <div class="p-2 text-gray-900 dark:text-gray-100">
                    <div class="flex items-center justify-end">
                        <a href="{{ route("admin.create.proposals") }}" class="py-2 px-3 bg-blue-600 rounded-md">Create
                            Proposal</a>
                    </div>
                    @if (session('success'))
                        <x-success :message="session('success')" />
                    @endif
                    @if (count($proposals))
                        <table class="w-full mt-3 rounded-lg table-fixed text-sm leads-table">
                            <tr class="bg-white text-gray-800 text-center">
                                <th width="190px">Name</th>
                                <th width="220px">Email</th>
                                <th width="210px">Status</th>
                                <th width="160px">Emailed</th>
                                <th width="160px">PDF</th>
                                <th width="340px">Products</th>
                                <th class="text-end">Created</th>
                                <th class="text-end">Updated</th>
                                <th class="text-end flex justify-end">Send</th>
                            </tr>
                            @foreach ($proposals as $item)
                                <tr>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td class="capitalize">
                                        @if ($item->status == 'pending')
                                            <strong class="py-1 px-3 bg-yellow-400 text-black rounded-lg">Pending</strong>
                                        @elseif($item->status == 'processing')
                                            <strong class="py-1 px-3 bg-blue-700 text-white rounded-lg">Processing</strong>
                                        @elseif($item->status == 'ready')
                                            <strong class="py-1 px-3 bg-green-700 text-white rounded-lg">Ready</strong>
                                        @else
                                            <strong class="py-1 px-3 bg-red-700 text-white rounded-lg">Failed</strong>
                                        @endif
                                    </td>
                                    <td class="capitalize">
                                        @if (!$item->is_sent)
                                            <strong class="py-1 px-3 bg-red-500 text-black rounded-lg">No</strong>
                                        @else
                                            <strong class="py-1 px-3 bg-green-700 text-white rounded-lg">Yes</strong>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($item->pdf)
                                            <a class="text-blue-400 underline"
                                                href="{{ config('app.url') . '/' . $item->pdf }}">Read</a>
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>
                                        @if ($item->products)
                                            @php
                                                $items = json_decode($item->products);
                                            @endphp
                                            @foreach ($items as $index => $product)
                                                <a href="{{ $product }}" class="text-blue-400 underline" target="_blank">Product
                                                    #{{ $index + 1 }}</a>
                                            @endforeach
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>{{ $item->created_at->format("D M Y H:i")}}</td>
                                    <td>{{ $item->updated_at->format("D M Y H:i")}}</td>
                                    <td class="flex justify-end items-center relative" x-data="{ open: false }">
                                        <img src="https://api.iconify.design/humbleicons:dots-vertical.svg?color=%23ffffff"
                                            width="20" class="cursor-pointer" @click="open = true">
                                        <div class="absolute top-8 right-0 w-[150px] py-2 px-3 bg-white rounded-lg z-20"
                                            x-show="open" x-transition x-cloak @click.away="open = false">
                                            <div class="flex flex-col items-start">
                                                <button wire:click='sendEmail("{{ $item->id }}")'
                                                    class="mb-3 py-2 text-black font-bold">{{ $item->is_sent ? 'Resend' : 'Send Email' }}</button>
                                                <a href="{{ route('admin.edit.proposal', $item->id) }}"
                                                    class="mb-3 py-2 text-black font-bold">Edit</a>
                                                <button wire:click='delete("{{ $item->id }}")'
                                                    class="mb-3 py-2 text-white font-bold bg-red-600 w-full text-center">Delete</button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    @else
                        <p class="py-2 text-center">No proposal found in the system!</p>
                    @endif
                    @if ($proposals->hasPages())
                        <div class="pagination p-3 rounded-lg bg-gray-700">
                            {{ $proposals->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>