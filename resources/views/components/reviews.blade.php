@if (count($reviews))
    <section class="w-full" id="reviews">
        <div class="max-w-7xl w-full m-auto py-12 px-4">
            <div class="m-auto w-fit mb-4">
                <div class="flex items-center justify-center">
                    <span class="font-semibold text-7xl link text-[#FFA41C]">4.7</span>
                    <div class="flex flex-col ml-2">
                        <ul class="flex">
                            <li><img width="25px" src="https://api.iconify.design/material-symbols:star.svg?color=%23FFA41C" alt="Review star"></li>
                            <li><img width="25px" src="https://api.iconify.design/material-symbols:star.svg?color=%23FFA41C" alt="Review star"></li>
                            <li><img width="25px" src="https://api.iconify.design/material-symbols:star.svg?color=%23FFA41C" alt="Review star"></li>
                            <li><img width="25px" src="https://api.iconify.design/material-symbols:star.svg?color=%23FFA41C" alt="Review star"></li>
                            <li><img width="25px" src="https://api.iconify.design/material-symbols:star-half.svg?color=%23FFA41C" alt="Review star"></li>
                        </ul>
                        <p class="text-white">from <b>70+</b> Happy Customers</p>
                    </div>
                </div>
                <h2 class="text-3xl mb-4 text-white font-bold">What our esty customers think</h2>
            </div>
            <div class="w-full grid grid-cols-3 m-auto gap-3 940px:grid-cols-2 670px:grid-cols-1 670px:max-w-[400px]">
                @foreach ($reviews as $review)
                    <x-single-review :review="$review" />
                @endforeach
                @foreach ($reviews as $review)
                    <x-single-review :review="$review" />
                @endforeach
                @foreach ($reviews as $review)
                    <x-single-review :review="$review" />
                @endforeach
            </div>
        </div>
    </section>
@endif