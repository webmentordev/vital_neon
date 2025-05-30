@extends('layouts.pdf')
@section('content')
    <section class="bg-red-500 h-screen flex items-center justify-center">
        <div class=" w-full max-w-[1600px] h-[1130px] bg-dark grid grid-cols-10" id="template">
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
                                        width="25" class="mr-2"><strong class="text-[15px]">16476165799</strong></li>
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
                        style="background-image: url('https://signage-proposal-dashboard.ystsol.com/storage/mockups/zjl5W0y3OpyZxECCNwyeHXfGgx3YXY3jstijUwue.png')">
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
            <div class="bg-blue-400 h-full w-full p-3">

            </div>
            <div class="bg-green-400 h-full w-full col-span-3 p-5">

            </div>
        </div>
    </section>
@endsection