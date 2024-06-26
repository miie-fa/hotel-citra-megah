@extends('front.layout.app')

@section('title', 'Blog')

@section('content')
{{-- Banner --}}
<section class="relative">
    <img src="https://images.unsplash.com/photo-1488998427799-e3362cec87c3?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&h=350" alt="banner" class="h-auto max-w-full mx-auto filter brightness-50">
    <div class="absolute inset-0 flex items-center justify-center">
        <span class="px-1 py-1 text-lg font-medium text-white md:px-5 md:text-5xl md:py-7">{{ $title }}</span>
    </div>
</section>

{{-- List Blog --}}
<section class="max-w-screen-xl px-10 py-8 mx-auto mt-16 lg:px-20">
    <div class="flex flex-col lg:flex-row lg:gap-16">
        {{-- List Blog --}}

        <div class="lg:w-4/5">
            @if ($posts->count())
                @foreach ($posts as $item)
                    <div class="mb-14 content">
                        <a class="relative block group" href="{{ route('post', $item->slug) }}">
                            <div class="absolute inset-0 hidden transition duration-700 ease-out transform bg-gray-300 pointer-events-none md:block md:translate-y-2 md:translate-x-2 xl:translate-y-1 xl:translate-x-4 group-hover:translate-x-0 group-hover:translate-y-0" aria-hidden="true"></div>
                            <figure class="relative h-0 pb-[56.25%] md:pb-[75%] lg:pb-[56.25%] overflow-hidden transform md:-translate-y-2 xl:-translate-y-4 group-hover:translate-x-0 group-hover:translate-y-0 transition duration-700 ease-out">
                                <img class="absolute inset-0 object-cover w-full h-full transition duration-700 ease-out transform hover:scale-105" src="{{ asset('storage/' . $item->thumbnail) }}" width="540" height="303" alt="Blog post">
                            </figure>
                        </a>
                        {{-- <div class="">
                            <img class="w-full h-full transition-all duration-300 hover:scale-110" src="{{ asset('storage/' . $item->thumbnail) }}" alt="">
                        </div> --}}
                        <a href="{{ route('post', $item->slug) }}">
                            <h2 class="mt-2 text-2xl font-medium text-gray-900 transition-all duration-200 hover:text-cyan-900">{{ $item->title }}</h2>
                        </a>
                        <span class="text-sm text-sub"><a href="/blog?category={{ $item->category->slug }}">{{ $item->category->name }}</a> - {{ $item->created_at->isoFormat('DD MMMM YYYY - HH.mm') }}</span>
                        <p class="mt-3 text-gray-600">{!! Str::limit($item->content, '300') !!}</p>
                        <a href="{{ route('post', $item->slug) }}"><button class="px-5 py-2 mt-10 text-white bg-footer hover:bg-slate-800">Read More</button></a>
                    </div>
                @endforeach
                <section aria-label="Page navigation example" class="flex justify-center mt-6 mb-7">
                    <ul class="flex items-center h-8 -space-x-px text-sm">
                        <!-- Tombol Previous -->
                        <li>
                            <a href="{{ $posts->previousPageUrl() }}" class="flex items-center justify-center h-8 px-3 ml-0 leading-tight text-gray-500 bg-white border border-gray-300 rounded-l-lg {{ $posts->onFirstPage() ? 'opacity-50 pointer-events-none' : 'hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white' }}">
                                <span class="sr-only">Previous</span>
                                <svg class="w-2.5 h-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
                                </svg>
                            </a>
                        </li>

                        <!-- Tampilkan nomor-nomor halaman -->
                        @for ($page = 1; $page <= $posts->lastPage(); $page++)
                            <li>
                                <a href="{{ $posts->url($page) }}" class="flex items-center justify-center h-8 px-3 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white {{ $page === $posts->currentPage() ? 'font-bold' : '' }}">{{ $page }}</a>
                            </li>
                        @endfor

                        <!-- Tombol Next -->
                        <li>
                            <a href="{{ $posts->nextPageUrl() }}" class="flex items-center justify-center h-8 px-3 leading-tight text-gray-500 bg-white border border-gray-300 rounded-r-lg {{ !$posts->hasMorePages() ? 'opacity-50 pointer-events-none' : 'hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white' }}">
                                <span class="sr-only">Next</span>
                                <svg class="w-2.5 h-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                                </svg>
                            </a>
                        </li>
                    </ul>
                </section>
            @else
            <div class="text-center text-gray-600 ">
                <h2 class="text-3xl ">NOT FOUND</h2>
                <p>Nothing matched your search criteria. Please try again with different keywords</p>
            </div>
            @endif
        </div>
        <div class="lg:w-2/5">

            {{-- Search --}}
            @include('front.components.post.search')

            {{-- Terbaru --}}
            @include('front.components.post.latest_post')

            {{-- Banner CTA --}}
            @include('front.components.post.cta')

            {{-- Galeri --}}
            @include('front.components.post.gallery')
        </div>
    </div>
</section>
@endsection
