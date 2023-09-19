@extends('layouts.apps')
@section('content')
    <section class="w-full px-4">
        <div class="max-w-7xl m-auto py-[80px]">
            <div class="text-center mb-6 border-b border-light py-3">
                <h4 class="text-[34.5px] uppercase mb-3 text-white font-bold flex text-5xl justify-center items-center m-auto choose 490px:text-2xl">Our Blogs</h4>
            </div>
            <form action="{{ route('blog.search') }}" class="mb-6" method="get">
                <div class="bg-light p-3 pl-5 rounded-lg flex 490px:flex-col">
                    <img class="490px:hidden" src="https://api.iconify.design/streamline:interface-search-glass-search-magnifying.svg?color=%23ffffff" width="30" alt="Search Icon">
                    <input type="text" class="bg-transparent border-none 490px:border 490px:border-white/10 focus:outline-none 490px:rounded-lg py-2 490px:py-3 ml-3 490px:ml-0 490px:mb-2 w-full outline-none text-gray-300" autocomplete="off" placeholder="Search for blog..." name="search">
                    <button type="submit" class="bg-white text-dark font-semibold px-6 rounded-lg 490px:py-3">Search</button>
                </div>
            </form>
            @if (count($blogs))
            <div class="grid grid-cols-2 gap-6 m-auto 1170px:grid-cols-3 940px:grid-cols-2 940px:max-w-2xl 620px:grid-cols-1 620px:max-w-[390px]">
                @foreach ($blogs as $blog)
                    <a href="{{ route('blog.read', $blog->slug) }}" class="bg-light p-3 rounded-lg 710:max-w-[440px] w-full m-auto">
                        <img data-src="{{ asset('/storage/'. $blog->thumbnail) }}" class="mb-3 lazyload rounded-lg" alt="{{ $blog->name }} Image">
                        <div class="py-3 px-2">
                            <span class="link rounded-md bg-dark text-sm text-gray-200 py-2 px-3 mb-3 inline-block">Posted: {{ $blog->created_at->diffForHumans() }}</span>
                            @if ($blog->created_at != $blog->updated_at)
                                <span class="link rounded-md bg-rust-green text-sm text-gray-200 py-2 px-3 mb-3 inline-block">Updated: {{ $blog->updated_at->diffForHumans() }}</span>
                            @endif
                            <h3 class="blog-title text-xl text-white/80">{{ $blog->title }}</h3>
                        </div>
                        <span class="py-3 bg-indigo-600 rounded-lg bg-rust inline-block px-4 w-full font-semibold text-center text-white">Read article</span>
                    </a>
                @endforeach
            </div>
            @else
                <p class="text-center text-lg text-white">Blogs(s) not found!</p>
            @endif
        </div>
    </section>
@endsection