<section class="w-full px-4 400px:p-2">
    <div class="max-w-7xl m-auto">
        <div class="grid grid-cols-2 890px:grid-cols-1">
            <div class="p-12 max-w-2xl 1090px:p-6 890px:hidden">
                <img src="{{ asset('assets/neon-signs.png') }}" alt="Image">
            </div>
            <div class="pt-12 1090px:pt-6" x-data="{ isUploading: false, progress: 0 }"
                x-on:livewire-upload-start="isUploading = true" x-on:livewire-upload-finish="isUploading = false"
                x-on:livewire-upload-error="isUploading = false"
                x-on:livewire-upload-progress="progress = $event.detail.progress">
                <form wire:submit.prevent="store_data" enctype="multipart/form-data" method="POST"
                    class="p-12 575px:p-6 rounded-lg border-gray-700 border shadow-md bg-light 920px:p-8 890px:max-w-2xl m-auto">
                    <h2 class="font-semibold text-2xl text-white">Get Free Mockup Design and Quote</h2>
                    <p class="py-2 text-gray-300 mb-2 text-sm">Upload your logo or drawing, and our team will transform
                        it
                        into
                        a stunning custom design – ready for your approval!</p>
                    @if (session('success'))
                        <div class="bg-white rounded-md p-6 w-full text-sm">
                            <div class="text-center mb-2">
                                <img src="https://api.iconify.design/material-symbols:check-circle.svg?color=%2320975a"
                                    class="m-auto mb-3" width="50" alt="Checkmark icon">
                                <h1 class="text-xl font-semibold mb-2">Thank you!</h1>
                                <p class="mb-2">Your request has been submitted Successfully!</p>
                                <p>RequestID# <strong>{{ Str::afterLast($uuid, '-') }}</strong></p>
                                (We have emailed you the Request ID)
                            </div>
                            <div class="bg-gray-100 p-6 rounded-lg border border-gray-200">
                                <h2 class="font-semibold mb-2 text-lg">What's NEXT?</h2>
                                <p class="mb-2">Our mockup design process typically requires <strong>2 - 12</strong>
                                    business
                                    hours to
                                    complete, depending
                                    on complexity and specifications.</p>
                                <p>For any questions regarding our design services, please don't hesitate to contact our
                                    support team.</p>
                            </div>
                            <button wire:click="hide_message()"
                                class="w-full bg-main text-black p-3 rounded-md mt-3 inline-block text-center font-bold">Let's
                                go back!</button>
                        </div>
                    @else

                        <div class="w-full" wire:loading.delay.shorter wire:target="store_data">
                            <x-loading message="Submitting request..." />
                        </div>
                        <div class="grid grid-cols-2 gap-3 1090px:grid-cols-1 mb-4">
                            <div class="flex flex-col">
                                <x-form-input type="text" wire:model.blur="name" placeholder="Full Name" />
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>
                            <div class="flex flex-col">
                                <x-form-input type="email" wire:model.blur="email" placeholder="Email Address" />
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-3 1090px:grid-cols-1 mb-4">
                            <div class="flex flex-col">
                                <x-form-input type="text" wire:model.blur="phone_number" placeholder="Phone Number" />
                                <x-input-error :messages="$errors->get('phone_number')" class="mt-2" />
                            </div>
                            <div class="flex flex-col">
                                <x-form-select wire:model.blur="location">
                                    <option value="Indoor" selected>Indoor Use </option>
                                    <option value="Outdoor">Outdoor Use (Waterproof)</option>
                                </x-form-select>
                                <x-input-error :messages="$errors->get('location')" class="mt-2" />
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-3 1090px:grid-cols-1 mb-4">
                            <div class="flex flex-col">
                                <x-form-input type="text" wire:model.blur="dimensions"
                                    placeholder="Dimensions in inches" />
                                <x-input-error :messages="$errors->get('dimensions')" class="mt-2" />
                            </div>

                            <div class="flex flex-col">
                                <x-form-input type="number" step="0.01" wire:model.blur="budget"
                                    placeholder="Expected Budget" />
                                <x-input-error :messages="$errors->get('budget')" class="mt-2" />
                            </div>
                        </div>

                        <x-form-textarea wire:model.blur="message" cols="30" rows="4"
                            placeholder="Please include any details you have, such as the font style, color, image or design, design type, and anything else you have in mind."></x-form-textarea>
                        @error('message')
                            <p class="error">{{ $message }}</p>
                        @enderror
                        <input type="file" id="file" class="hidden" wire:model="logos" multiple>
                        <label for="file"
                            class="mb-1 flex items-center cursor-pointer border border-dotted justify-center py-3 border-main bg-gray-800/30">
                            <div class="flex flex-col items-center">
                                <img width="60"
                                    src="https://api.iconify.design/vscode-icons:folder-type-images.svg?color=%23008080"
                                    alt="UploadImageIcon">
                                <h3 class="ml-3 font-semibold mt-2 text-white">Upload Your Design(s)</h3>
                            </div>
                        </label>
                        @error('logos')
                            <p class="error">{{ $message }}</p>
                        @enderror
                        <div x-show="isUploading" class="w-full mb-4">
                            <div
                                class="bg-gray-200 w-full h-[25px] rounded-full relative flex items-center justify-center overflow-hidden">
                                <div class="absolute top-0 left-0 h-full bg-blue-400"
                                    x-bind:style="'width: ' + progress + '%'"></div>
                                <span class="relative text-black">Uploading please wait...</span>
                            </div>
                        </div>
                        @php
                            $files = count($logos);
                        @endphp
                        @if ($files)
                            <p class="text-gray-200 mb-3 text-sm p-3 mt-1 bg-main/10 rounded-sm w-full text-center">
                                <strong class="text-main">{{ $files }}</strong>
                                {{ Str::plural('file', $files) }}
                                {{ $files == 1 ? 'is' : 'are' }}
                                selected
                            </p>
                        @else
                            <p class="text-gray-200 mb-3 text-sm">Max Filesize: 5MB | Filetype: png, jpeg, jpg, webp, pdf</p>
                        @endif
                        <div class="mb-4">
                            <button type="submit" class="bg-main w-full p-4 text-black font-bold"
                                x-bind:class="{'opacity-60': isUploading}" x-bind:disabled="isUploading">
                                Submit Your Request
                            </button>
                        </div>
                        <a href="https://www.trustpilot.com/review/vitalneon.com" title="Vital Neon TrustPilot reviews"
                            target="_blank" rel="nofollow" class="py-3 rounded-lg bg-gray-100 mb-6">
                            <img class="max-w-[80%] w-full m-auto"
                                src="{{ asset('assets/vital-neon-trustpilot-reviews.png') }}"
                                alt="Vital Neon TrustPilot reviews">
                        </a>
                        <a href="https://www.etsy.com/shop/VitalNeons" title="Vital Neon Etsy reviews" target="_blank"
                            rel="nofollow" class="mb-3 py-3 rounded-lg bg-gray-100">
                            <img class="max-w-[80%] w-full m-auto" src="{{ asset('assets/vital-neon-etsy-reviews.png') }}"
                                alt="Vital Neon Etsy reviews">
                        </a>
                    @endif
                </form>
            </div>
        </div>
        @if (count($products))
        <h3 class="text-4xl mt-8 mb-4 text-white font-bold">Our Neon Signs Collection</h3>
            <div class="grid grid-cols-4 gap-6 m-auto 1170px:grid-cols-3 940px:grid-cols-2 940px:max-w-2xl 620px:grid-cols-1 620px:max-w-[390px]">
                @foreach ($products as $item)
                    @if (count($item->categories))
                        <a href="{{ route('listing', $item->slug) }}" class="overflow-hidden group transition-all relative">
                            @if ($discount)
                                @if ($discount->discount != 0.00)
                                    <span class="bg-red-600 p-2 rounded-lg absolute top-2 right-2 text-white font-semibold">{{ number_format($discount->discount, 0) }}% Off</span>
                                @endif
                            @endif
                            <div class="overflow-hidden rounded-lg">
                                <img data-src="{{ asset('storage/'.$item->image) }}" class="group-hover:scale-125 transition-all lazyload h-[300px] 620px:h-full" alt="{{ $item->name }}" title="{{ $item->name }} Image" loading="lazy" style="width: 100%; object-fit: cover">
                            </div>
                            <div class="bg-light p-3 w-full bottom-0 left-0">
                                @if (strlen($item->name) >= 26)
                                    <h3 class="text-white text-center mb-3">{{ substr($item->name, 0, 26) }}...</h3>
                                @else
                                    <h3 class="text-white text-center mb-3">{{ $item->name }}</h3>
                                @endif
                                @if ($discount)
                                    @if ($discount->discount != 0.00)
                                        <div class="text-center">
                                            <del class="text-white/60">${{ number_format($item->categories[0]->price + (($discount->discount / 100) * $item->categories[0]->price), 2) }}</del>
                                            <p class="text-white text-3xl"><span class="font-semibold text-white">${{ number_format($item->categories[0]->price, 0) }}</span></p>
                                        </div>
                                    @endif
                                @endif
                                <span class="py-3 mt-3 rounded-md flex items-center group-hover:bg-[#90FED5] px-4 w-full transition-all text-center justify-center bg-[#00DC82] text-black font-bold">
                                    @if (!$discount)
                                        USD ${{ $item->categories[0]->price }}
                                    @else
                                        @if ($discount)
                                            @if ($discount->discount == 0.0)
                                                USD ${{ $item->categories[0]->price }}
                                            @else
                                                BUY NOW
                                            @endif
                                        @endif
                                    @endif
                                </span>
                            </div>
                        </a>
                    @endif
                @endforeach
            </div>
            @else
                <p class="text-center text-lg text-white">Product(s) not found!</p>
            @endif
        <div class="text-white mt-6">
            <h2 class="mb-3 text-3xl font-bold" title="Request Your Custom Neon Sign">Request Your Custom Neon Sign
            </h2>
            <p class="mb-4">Transform your vision into radiant reality with our personalized neon sign service. At
                Vital
                Neon, we believe in bringing your unique ideas to life, and we've made the process simple and
                seamless.
                Upload your own design and request a quote for a one-of-a-kind neon sign that reflects your style
                and
                personality.</p>

            <h3 class="font-bold text-lg">Customization at Your Fingertips</h3>
            <p class="mb-4">Express yourself by uploading your own design. Whether it's a logo, artwork, a special
                message, anime, or your favorite movie character, we'll turn it into a stunning neon masterpiece.
            </p>

            <h3 class="font-bold text-lg">Easy Quote Request</h3>
            <p class="mb-4">Getting started is a breeze. Simply fill out our user-friendly form with essential
                details,
                and our team will provide you with a comprehensive quote. After submitting the form, you will
                receive a
                mockup design via email, detailing the size and color configuration. We will not proceed with
                manufacturing until you are satisfied with the mockup.</p>

            <h3 class="font-bold text-lg">Tailor-Made Specifications</h3>
            <p class="mb-4">Your satisfaction is our priority. Specify your budget, preferred position (indoor or
                outdoor), desired dimensions (height and width) and your budget. This ensures a tailor-made neon
                sign
                that perfectly fits your space.</p>

            <h3 class="font-bold text-lg">Quality That Lasts</h3>
            <p class="mb-4">We understand the importance of durability. Indicate whether your neon sign will be
                placed
                indoors or outdoors for a higher quality that withstands weather elements.</p>

            <h3 class="font-bold text-lg">Attention to Detail</h3>
            <p class="mb-4">If your design involves text, let us know your preferred font style and color. We pay
                attention to the finer details to ensure your neon sign is a true reflection of your vision</p>
        </div>
    </div>
</section>