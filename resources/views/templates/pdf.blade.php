@extends('layouts.pdf')
@section('content')
    <section class="bg-red-500 h-screen flex items-center justify-center">
        <div class=" w-full max-w-[1600px] h-[1130px] bg-dark grid grid-cols-10 overflow-hidden" id="template">
            <div class="h-full w-full col-span-6 p-5">
                <div class="flex justify-between items-center">
                    <img src="{{ asset('assets/neon_tranp_white.png') }}" width="240px" class="mt-6">
                    <div>
                        <h3 class="text-white text-center mb-2">Any questions or concerns? <strong class="text-main">Contact
                                us</strong></h3>
                        <div class="px-3 py-4 bg-white rounded-r-full rounded-bl-full w-[440px] pl-8 box">
                            <ul>
                                <li class="flex items-center"><img
                                        src="https://api.iconify.design/material-symbols:call-sharp.svg?color=%2312caff"
                                        width="25" class="mr-2"><strong class="text-[15px]">+1 647-616-5799</strong></li>
                                <li class="flex items-center"><img
                                        src="https://api.iconify.design/ic:baseline-mail-outline.svg?color=%2312caff"
                                        width="25" class="mr-2"><strong class="text-[15px]">contact@vitalneon.com</strong>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="mt-4 rounded-3xl bg-white p-2">
                    <div class="h-[390px] bg-red-500 border border-dark bg-cover bg-center w-full rounded-3xl mb-4 relative overflow-hidden"
                        style="background-image: url('https://signage-proposal-dashboard.ystsol.com/storage/drawings/6pxZdslbWQMFU79OD00gMMBzjScCKHzqfovn02iz.png')">
                        <strong
                            class="absolute rounded-tr-full bg-dark text-white px-1 py-2 bottom-0 w-[130px] text-center text-lg z-10">Drawing</strong>
                    </div>
                    <div class="h-[390px] bg-red-500 border border-dark bg-cover bg-center w-full rounded-3xl relative overflow-hidden"
                        style="background-image: url('https://signage-proposal-dashboard.ystsol.com/storage/drawings/6pxZdslbWQMFU79OD00gMMBzjScCKHzqfovn02iz.png')">
                        <strong
                            class="absolute rounded-tr-full bg-dark text-white px-1 py-2 bottom-0 w-[130px] text-center text-lg z-10">Mockup</strong>
                    </div>
                </div>
                <div class="w-full py-4 px-5">
                    <p class="text-main text-center font-bold mb-2">Please review this carefully</p>
                    <div class="grid grid-cols-2">
                        <ul class="text-gray-200 list-disc">
                            <li>Please make sure <strong class="text-white">Spellings</strong> are correct</li>
                            <li>Mention <strong class="text-white">Dimensions</strong> are accurate</li>
                            <li><strong class="text-white">2 Years warrenty</strong>: UL Listed Components</li>
                            <li>Delivery in <strong class="text-white">15 - 17 working days</strong></li>
                        </ul>
                        <ul class="text-gray-200 list-disc">
                            <li>Test Proof of <strong class="text-white">Color</strong> can be provided upon request</li>
                            <li>Please not that VitalNeon has upto <strong class="text-white">5% color and dimension
                                    tolerance</strong> acceptable
                                difference between digital proof and actual product</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="h-full w-full flex items-center justify-center">
                <div class="flex flex-col border border-slate-300 py-12 px-3 rounded-t-full rounded-b-full text-white">
                    <div class="flex flex-col text-center mb-12">
                        <img src="{{ asset('assets/icons/increase.png') }}" width="80" class="m-auto">
                        <strong class>Value for Money</strong>
                    </div>
                    <div class="flex flex-col text-center mb-12">
                        <img src="{{ asset('assets/icons/ribbon.png') }}" width="80" class="m-auto">
                        <strong class>2 Year Warrenty</strong>
                    </div>
                    <div class="flex flex-col text-center mb-12">
                        <img src="{{ asset('assets/icons/fast-delivery.png') }}" width="80" class="m-auto">
                        <strong class>Turnaround 15 - 17 <br> Days</strong>
                    </div>
                    <div class="flex flex-col text-center mb-12">
                        <img src="{{ asset('assets/icons/phone.png') }}" width="80" class="m-auto">
                        <strong class>24 / 7 <br> Support</strong>
                    </div>
                    <div class="flex flex-col text-center">
                        <img src="{{ asset('assets/icons/certified.png') }}" width="80" class="m-auto">
                        <strong class>Value for Money</strong>
                    </div>
                </div>
            </div>
            <div class="h-full w-full col-span-3 pl-5">
                <div class="h-[970px] bg-white p-3">
                    <div class="bg-gray-300 w-full h-[430px] relative rounded-3xl overflow-hidden">
                        <strong
                            class="absolute rounded-br-full bg-dark text-white px-1 py-2 top-0 w-[190px] text-center text-lg z-10">Quote
                            Details</strong>
                        <div class="mt-10 py-3 px-4">
                            <strong class="text-black text-2xl">Muhammad Ahmer Tahir</strong>
                            <div class="pt-1">
                                <div class="flex items-center">
                                    <strong class="w-[160px] uppercase">Dimensions</strong>
                                    <span class="">: Metal Neon Sign</span>
                                </div>
                                <div class="flex items-center">
                                    <strong class="w-[160px] uppercase">Color</strong>
                                    <span class="">: Metal Neon Sign</span>
                                </div>
                                <div class="flex items-center">
                                    <strong class="w-[160px] uppercase">Finish</strong>
                                    <span class="">: Glossy</span>
                                </div>
                                <div class="flex items-center">
                                    <strong class="w-[160px] uppercase">Illuminated</strong>
                                    <span class="">: Yes</span>
                                </div>
                                <div class="flex items-center">
                                    <strong class="w-[160px] uppercase">Usage</strong>
                                    <span class="">: Outdoor</span>
                                </div>
                                <div class="flex items-center">
                                    <strong class="w-[160px] uppercase">Installation</strong>
                                    <span class="">: On Demand</span>
                                </div>
                            </div>
                            <div class="flex flex-col mt-2">
                                <div class="flex justify-between items-center py-2 px-4 bg-dark text-white rounded-t-3xl">
                                    <strong>Size</strong>
                                    <strong>Dimensions</strong>
                                    <strong>Price</strong>
                                </div>
                                <div class="flex justify-between items-center py-1 pr-2 mt-1">
                                    <strong class="py-1 w-[90px] text-center text-main bg-black">Small</strong>
                                    <strong>60 in x 47 in</strong>
                                    <strong>US$ 1,498</strong>
                                </div>
                                <div class="flex justify-between items-center py-1 pr-2">
                                    <strong class="py-1 w-[90px] text-center text-main bg-black">Medium</strong>
                                    <strong>60 in x 47 in</strong>
                                    <strong>US$ 1,498</strong>
                                </div>
                                <div class="flex justify-between items-center py-1 pr-2">
                                    <strong class="py-1 w-[90px] text-center text-main bg-black">Large</strong>
                                    <strong>60 in x 47 in</strong>
                                    <strong>US$ 1,498</strong>
                                </div>
                            </div>
                        </div>
                    </div>
                    <strong
                        class="text-3xl my-4 rounded-3xl mb-3 bg-main text-black w-full text-center p-5 inline-block box-btn">
                        CLICK HERE TO BUY
                    </strong>
                    <div class="bg-gray-300 w-full h-[400px] relative rounded-3xl overflow-hidden mt-3">
                        <strong
                            class="absolute rounded-br-full bg-dark text-white px-1 py-2 top-0 w-[210px] text-center text-lg z-10">Package
                            Included</strong>
                        <div class="mt-10 p-4 flex items-center justify-center">
                            <img src="{{ asset('assets/back_cut.jpg') }}" width="330px">
                        </div>
                    </div>
                </div>
                <p class="text-gray-200 mt-4">
                    All information on this document inclusing mockups is the property of VitalNeon. Any use or
                    redistribution of this information, in whole or in part, contained within these documents, may only be
                    done with express written consent of VitalNeon.
                </p>
            </div>
        </div>
    </section>
@endsection