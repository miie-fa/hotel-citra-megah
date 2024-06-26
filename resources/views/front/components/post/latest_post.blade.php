<div class="h-auto px-4 py-5 bg-gray-100 mt-7">
    <h2 class="mb-6 text-xl font-medium text-gary-500">Popular Posts</h2>
    <div>
        @foreach ($latest_posts as $item)
            <div class="flex items-center mb-5 justify-left">
                <img class="w-20 h-20" src="{{ asset('storage/' . $item->thumbnail) }}" alt="">
                <div class="ms-2">
                    <a href="{{ route('post', $item->slug) }}"><h2 class="text-[14px] leading-5 tracking-normal hover:text-teal-950">{{ $item->title }}</h2></a>
                    <span class="text-[12px] text-sub">{{ $item->created_at->formatLocalized('%d %B %Y') }}</span>
                </div>
            </div>
        @endforeach
    </div>
</div>
