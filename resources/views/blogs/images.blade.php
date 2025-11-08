<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl text-white leading-tight">
                Blog / Product Body Images
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-[95%] mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <p class="py-4 border-green-600 border text-center bg-green-700/20 rounded-lg mb-3 text-green-600">{{ session('success') }}</p>
            @endif
            <div class="overflow-hidden">
                @if (count($images))
                    <div class="grid grid-cols-6 gap-6">
                        @foreach ($images as $item)
                            <div class="flex flex-col" x-data="{ open: false, copied: false }">
                                <a href="{{ $item->url }}" target="_blank">
                                    <img src="{{ $item->url }}" class="w-full h-[300px] object-cover rounded-lg">
                                </a>
                                <div class="grid grid-cols-2 gap-3" x-show="!open">
                                    <button @click="open = true" class="text-center w-full py-2 px-3 bg-red-500/20 mt-1 rounded-lg border border-red-600 text-red-600">Delete</button>
                                    <button 
                                        @click="navigator.clipboard.writeText('{{ $item->url }}'); copied = true; setTimeout(() => copied = false, 2000)" 
                                        class="text-center w-full py-2 px-3 bg-indigo-500/20 mt-1 rounded-lg border border-indigo-600 text-indigo-600 relative"
                                    >
                                        <span x-show="!copied">Copy Link</span>
                                        <span x-show="copied" x-cloak>Copied!</span>
                                    </button>
                                </div>
                                
                                <div class="grid grid-cols-2 gap-3" x-show="open" x-cloak>
                                    <form action="{{ route('image.blog.delete', $item->id) }}" method="post">
                                        @csrf
                                        <button type="submit" class="text-center w-full py-2 px-3 bg-green-500/20 mt-1 rounded-lg border border-green-600 text-green-100">Confirm</button>
                                    </form>
                                    <button @click="open = false" class="text-center w-full py-2 px-3 bg-red-500/20 mt-1 rounded-lg border border-red-600 text-red-600">Close</button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    @if ($images->hasPages())
                        <div class="py-3">
                            {{ $images->links() }}
                        </div>
                    @endif
                @else
                    <p class="py-3 text-center text-white text-lg">No images data exist!</p>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>