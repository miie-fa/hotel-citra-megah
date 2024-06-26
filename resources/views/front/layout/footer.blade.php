<footer class="px-8 pb-5 lg:px-36 bg-footer dark:bg-gray-900">
    <div class="w-full max-w-screen-xl mx-auto">
        <div class="grid grid-cols-1 md:grid-cols-6 lg:grid-cols-12 gap-8 pt-8 lg:pt-14">
            <div class="md:col-span-4">
                <a href="#" class="mb-2 text-[1.7em] text-white font-logo">{{ $settings->name }}</a>
                <ul class="font-medium text-gray-500 dark:text-gray-400">
                    <li class="mb-4">
                        <span class="text-[15px] font-normal text-slate-300 ">{{ $settings->description }}</span>
                    </li>
                    <li class="mt-12">
                        <div class="flex flex-col">
                            <span class="text-sm font-normal text-slate-300">Follow Us</span>
                            <div class="flex gap-3 mt-2">
                                <a href="{{ $settings->facebook }}" class="transition-transform hover:scale-110">
                                    <img src="{{ asset('icon/facebook--24--outline.svg') }}" alt="">
                                </a>
                                <a href="{{ $settings->linkedin }}" class="transition-transform hover:scale-110">
                                    <img src="{{ asset('icon/linkedin--24--outline.svg') }}" alt="">
                                </a>
                                <a href="{{ $settings->instagram }}" class="transition-transform hover:scale-110">
                                    <img src="{{ asset('icon/instagram--24--outline.svg') }}" alt="">
                                </a>
                                <a href="{{ $settings->twitter }}" class="transition-transform hover:scale-110">
                                    <img src="{{ asset('icon/twitter--24--outline.svg') }}" alt="">
                                </a>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="md:col-span-2">
                <h2 class="mt-2 mb-2 text-xl font-medium text-slate-300">Navigation</h2>
                <ul class="font-medium text-gray-500 dark:text-gray-400">
                    <li class="mb-1">
                        <a href="{{ route('faqs') }}" class="text-[15px] text-slate-300 font-normal hover:underline">Help Center</a>
                    </li>
                    <li class="mb-1">
                        <a href="{{ route('terms_conditions') }}" class="text-[15px] text-slate-300 font-normal hover:underline">Terms & Conditions</a>
                    </li>
                    <li class="mb-1">
                        <a href="{{ route('privacy_police') }}" class="text-[15px] text-slate-300 font-normal hover:underline">Privacy Police</a>
                    </li>
                </ul>
            </div>
            <div class="hidden md:col-span-3 md:block">
                <h2 class="mt-2 mb-2 text-xl font-medium text-slate-300">Recent Post</h2>
                <ul class="font-medium text-gray-500 dark:text-gray-400 align-start">
                    @if (isset($posts))
                    @foreach ($posts->take(3) as $post)
                    @if ($post->is_published == '1')
                    <li class="mb-4">
                        <a href="{{ route('post', $post->slug) }}">
                            <div class="flex items-center">
                                <img class="w-14 h-14" src="{{ asset('storage/' . $post->thumbnail) }}" alt="">
                                <span class="text-[14px] leading-[15px] text-slate-300 font-normal hover:underline ms-3">{{ Str::limit($post->title, 30) }}</span>
                            </div>
                        </a>
                    </li>
                    @endif
                    @endforeach
                    @endif
                </ul>
            </div>
            <div class="md:col-span-3 ">
                <h2 class="mt-2 mb-2 text-xl font-medium text-slate-300">Contact Us</h2>
                <ul class="">
                    <li class="mb-4">
                        <div class="flex items-center gap-2">
                            <img src="{{ asset('icon/call.svg') }}" alt="">
                            <div class="text-[14px] leading-[15px] text-slate-300 font-normal ms-2">
                                <a href="tel:0.{{ $settings->phone }}" class="">+62 {{ $settings->phone }}</a>
                            </div>
                        </div>
                    </li>
                    <li class="mb-4">
                        <div class="flex items-center gap-2">
                            <img src="{{ asset('icon/mail.svg') }}" alt="">
                            <div class="text-[14px] leading-[15px] text-slate-300 font-normal ms-2">
                                <a href ="mailto:{{ $settings->email }}" class="">{{ $settings->email }}</a>
                            </div>
                        </div>
                    </li>
                    <li class="mb-4">
                        <div class="flex items-start gap-2">
                            <img class="self-start w-7 h-7" src="{{ asset('icon/map.svg') }}" alt="">
                            <div class="text-[14px] leading-[15px] text-slate-300 font-normal ms-2">
                                <a href="https://goo.gl/maps/xoUoESCM7HkbzXwT7" target="_blank" class="">{{ $settings->address }}</a>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <hr class="my-6 border-gray-700 sm:mx-auto dark:border-gray-700 lg:my-4" />
        <div class="sm:flex sm:items-center sm:justify-around">
            <span class="text-sm text-slate-300 sm:text-center dark:text-gray-400">Copyright &copy; <?php echo date("Y"); ?> <a href="/" class="hover:underline">{{ $settings->name }}</a>
            </span>
        </div>
    </div>
</footer>
