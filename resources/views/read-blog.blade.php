@extends('layouts.apps')
@section('content')
    <section class="w-full">
        <div class="max-w-5xl m-auto py-6 pb-12 px-4">
            <article class="w-full">
                <h1 class="blog-title text-4xl mb-2 text-white 620px:text-3xl">{{ $blog->title }}</h1>
                <ul class="flex flex-col mb-3 text-rust">
                    <span class="text-gray-100">Posted: 
                        <time class="created" datetime="{{ $blog->created_at->tz('UTC')->toAtomString() }}" itemprop="dateCreated">{{ $blog->created_at->format('M d, Y H:i:s A') }}</time> (UTC)
                    </span>
                    @if ($blog->created_at != $blog->updated_at)
                        <span class="text-gray-100">Last Updated:
                            <time class="updated" datetime="{{ $blog->updated_at->tz('UTC')->toAtomString() }}" itemprop="dateModified">{{ $blog->updated_at->format('M d, Y H:i:s A') }}</time> (UTC)
                        </span>
                    @endif
                </ul>
                <main class=" py-2 blog">
                    <img src="{{ asset('/storage/'.$blog->thumbnail) }}" title="{{ $blog->title }}" alt="{{ $blog->title }} Image">
                    {!! $blog->body !!}
                </main>
            </article>
        </div>
    </section>
@endsection