<section class="w-full px-4">
    <div class="max-w-7xl m-auto">
        <div class="grid grid-cols-2">
            <div class="p-12 max-w-2xl">
                <img src="{{ asset('assets/neon-signs.png') }}" alt="Image">
            </div>
            <div class="pt-12" x-data="{ isUploading: false, progress: 0 }"
                x-on:livewire-upload-start="isUploading = true" x-on:livewire-upload-finish="isUploading = false"
                x-on:livewire-upload-error="isUploading = false"
                x-on:livewire-upload-progress="progress = $event.detail.progress">
                <form wire:submit.prevent="store_data" enctype="multipart/form-data" method="POST"
                    class="p-12 575px:p-6 rounded-lg border-gray-700 border shadow-md bg-light">
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
                        <div class="grid grid-cols-2 gap-3 575px:grid-cols-1 mb-4">
                            <div class="flex flex-col">
                                <x-form-input type="text" wire:model.blur="name" placeholder="Full Name" />
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>
                            <div class="flex flex-col">
                                <x-form-input type="email" wire:model.blur="email" placeholder="Email Address" />
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-3 575px:grid-cols-1 mb-4">
                            <div class="flex flex-col">
                                <x-form-input type="text" wire:model.blur="phone_number" placeholder="Phone Number" />
                                <x-input-error :messages="$errors->get('phone_number')" class="mt-2" />
                            </div>
                            <div class="flex flex-col">
                                <x-form-select wire:model.blur="location">
                                    <option value="" selected>Neon Sign Location</option>
                                    <option value="Indoor">Indoor Use </option>
                                    <option value="Outdoor">Outdoor Use (Waterproof)</option>
                                </x-form-select>
                                <x-input-error :messages="$errors->get('location')" class="mt-2" />
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-3 575px:grid-cols-1 mb-4">
                            <div class="flex flex-col">
                                <x-form-input type="text" wire:model.blur="dimensions"
                                    placeholder="Width / Height or Dimensions" />
                                <x-input-error :messages="$errors->get('dimensions')" class="mt-2" />
                            </div>

                            <div class="flex flex-col">
                                <x-form-input type="number" step="0.01" wire:model.blur="budget"
                                    placeholder="Your Budget ($200 to $2000)" />
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
                        <div>
                            <button type="submit" class="bg-main w-full p-4 text-black font-bold"
                                x-bind:class="{'opacity-60': isUploading}" x-bind:disabled="isUploading">
                                Submit Your Request
                            </button>
                        </div>
                    @endif
                </form>
            </div>
        </div>
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