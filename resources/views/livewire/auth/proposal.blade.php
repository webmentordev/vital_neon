<div>
    <div class="py-2">
        <div class="max-w-[99%] mx-auto">
            <div class="bg-white dark:bg-gray-800 overflow-hidden rounded-lg">
                <div class="p-2 text-gray-900 dark:text-gray-100">
                    <div class="flex items-center justify-end">
                        <a href="{{ route("admin.create.proposals") }}" class="py-2 px-3 bg-blue-600 rounded-md">Create
                            Proposal</a>
                    </div>
                    @if (count($proposals))
                        <table class="w-full mt-3 rounded-lg overflow-hidden table-fixed text-sm leads-table">
                            <tr class="bg-white text-gray-800 text-center">
                                <th width="190px">Name</th>
                                <th width="220px">Email</th>
                                <th width="210px">Status</th>
                                <th width="160px">Emailed</th>
                                <th width="160px">PDF</th>
                                <th width="80px">Products</th>
                                <th class="text-end">Created</th>
                                <th class="text-end">Updated</th>
                            </tr>
                            @foreach ($proposals as $item)
                                <tr>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td class="capitalize">
                                        @if ($item->status = 'pending')
                                            <strong class="py-1 px-3 bg-yellow-400 text-black rounded-lg">Pending</strong>
                                        @elseif($item->status = 'processing')
                                            <strong class="py-1 px-3 bg-blue-700 text-white rounded-lg">Processing</strong>
                                        @elseif($item->status = 'ready')
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
                                    <td>{{ $item->pdf ? "<a href='.$item->pdf.'>Read</a>" : '-' }}</td>
                                    <td>
                                        @if ($item->products)
                                            @php
                                                $items = json_decode($item->products);
                                            @endphp
                                            @foreach ($items as $product)
                                                <a href="{{ $product }}" target="_blank">Product #01{{ $loop->index }},</a>
                                            @endforeach
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>{{ $item->created_at->format("D M Y H:i")}}</td>
                                    <td>{{ $item->updated_at->format("D M Y H:i")}}</td>
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