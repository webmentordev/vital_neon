<section class="w-full py-[80px]">
    <div class="grid grid-cols-2 gap-6 max-w-7xl m-auto min-h-[800px]">
        <div class="bg-cover bg-center rounded-md flex items-center justify-center" style="background-image: url({{ asset('assets/images/dark_wall.jpg') }})">
            <span class="neonText text-7xl font-semibold">{{ $custom_text }}</span>
        </div>
        <form wire:submit.prevent="createOrder" method="POST">
            <label class="text-xl font-semibold">Write your text</label>
            <input type="text" wire:model.debounce.500ms="custom_text" placeholder="Custom Text" class="w-full mt-2 bg-white rounded border border-main focus:border-main focus:ring-4 focus:ring-main-light text-base outline-none text-gray-700 py-2 px-3 leading-8 transition-colors duration-200 ease-in-out">
        </form>
    </div>
</section>