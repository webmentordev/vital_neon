<section class="w-full min-h-[70vh]">
    <div class="max-w-7xl m-auto py-12 px-4 grid grid-cols-2 gap-12 1130px:grid-cols-1 1130px:max-w-2xl">
        <div class="w-full flex flex-col">
            <div class="flex items-center justify-between pb-6 border-b border-white/10 mb-3">
                <h1 class="text-3xl text-white font-bold">Shopping Cart</h1>
                @if ($total_price != 0)
                    <button class="py-2 px-4 w-fit bg-red-500/20 border border-red-500 text-white rounded-lg mb-3" wire:click='emptyCart'>Empty Cart</button>
                @endif
            </div>
            <div class="w-full mb-2">
                <span class="text-white">Email Address</span>
                <x-custom-input type="email" name="email" wire:model.debounce.1000ms="email" placeholder="Email Address" required />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div class="grid grid-cols-2 gap-3 mb-2 530px:grid-cols-1">
                <div class="w-full">
                    <span class="text-white">First Name</span>
                    <x-custom-input type="text" name="f_name" wire:model.debounce.1000ms="f_name" placeholder="First Name" required />
                    <x-input-error :messages="$errors->get('f_name')" class="mt-2" />
                </div>
                <div class="w-full">
                    <span class="text-white">Last Name</span>
                    <x-custom-input type="text" name="l_name" wire:model.debounce.1000ms="l_name" placeholder="Last Name" required />
                    <x-input-error :messages="$errors->get('l_name')" class="mt-2" />
                </div>
            </div>

            <div class="w-full">
                <span class="text-white">Address</span>
                <x-custom-input type="text" name="address" wire:model.debounce.1000ms="address" placeholder="Address" required />
                <x-input-error :messages="$errors->get('address')" class="mt-2" />
            </div>

            <div class="w-full">
                <span class="text-white">Contact (shipping purpose)</span>
                <x-custom-input type="number" name="number" wire:model.debounce.1000ms="number" placeholder="Contact Number" required />
                <x-input-error :messages="$errors->get('number')" class="mt-2" />
            </div>
            <p class="text-gray-300 mb-3">🚚 Estimated Delivery: {{ \Carbon\Carbon::now()->format('d-M-y') }} - {{ \Carbon\Carbon::now()->addDays(5)->format('d-M-y') }}</p>
            @if ($total_price != 0)
                <button wire:click="checkout" class="py-3 px-5 rounded-md text-black bg-white font-semibold checkout_click">Pay Now</button>
            @endif
        </div>
        <div class="w-full border-l border-white/10 px-6 1130px:border-none 1130px:px-0">
            @if ($carts != null)
            @foreach ($carts as $cart)
                @if (session('success'))
                    <x-success :message="session('success')" />
                @endif
                <div class="flex items-center justify-between border-b border-white/10 py-6 mb-3 relative">
                    <div class="flex">
                        <img wire:click="removeItem('{{ $cart['slug'] }}')" src="https://api.iconify.design/bi:trash-fill.svg?color=%23ea1f1f" class="absolute p-2 rounded-full bg-red-600/10 -top-0 -left-3" alt="Trash">
                        <img src="{{ $cart['image'] }}" class="w-[60px] object-fit h-[60px] rounded-lg" alt="{{ $cart['name'] }} Image">
                        <div class="p-3">
                            <h3 class="mb-2 text-lg text-white font-semibold">{{ $cart['name'] }}</h3>
                        </div>
                    </div>
                    <span class="text-white/70 font-bold px-4">${{ $cart['price'] }}</span>
                </div>
            @endforeach
            @endif
            <div class="py-4 px-4 mt-4 rounded-lg bg-light">
                <div class="flex items-center justify-between mb-3">
                    <h3 class="text-white/50">Shipping Cost</h3>
                    <span class="font-semibold text-white/50">$0</span>
                </div>
                <div class="flex items-center justify-between">
                    <h3 class="text-white text-2xl font-semibold">Total Price</h3>
                    <span class="font-semibold text-main text-2xl">${{ $total_price }}</span>
                </div>
            </div>
        </div>
    </div>
</section>
