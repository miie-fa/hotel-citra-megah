<nav id="navbar" class="absolute top-0 left-0 z-50 w-full text-white bg-transparent shadow-md sticky-navbar nav-container navbar dark:bg-gray-900 dark:border-gray-600">
    <div class="flex flex-wrap items-center justify-between px-20 max-w-screen-xl p-4 mx-auto">
        <a href="/" class="flex items-center">
            <span class="self-center text-[24px] font-logo whitespace-nowrap">Hotel Citra Megah</span>
        </a>
        <div class="flex md:order-2">
                <a href="{{ route('cart') }}">
                    <button type="button" class="hidden custom-btn btn-15"><i class="fa-solid fa-cart-shopping"><sup class="text-white">@if(session()->has('cart_room_id')) {{ count(session()->get('cart_room_id')) }} @else @endif</sup></i></button>
                </a>
            @auth
                @if (auth()->user()->role == 'user')
                    <div class="hidden sm:block">
                        <a href="{{ route('user.dashboard') }}">
                            <button type="button" class=" custom-btn btn-15">Dashboard User</button>
                        </a>
                    </div>
                @elseif (auth()->user()->role == 'admin')
                    <div class="hidden sm:block">
                        <a href="{{ route('filament.admin.pages.dashboard') }}">
                            <button type="button" class=" custom-btn btn-15">Dashboard Admin</button>
                        </a>
                    </div>
                @endif
            @else
                <div class="hidden sm:block">
                    <a href="{{ route('login') }}">
                        <button type="button" class="custom-btn btn-15">Login/Sign Up</button>
                    </a>
                </div>
            @endauth

            <button data-collapse-toggle="navbar-sticky" type="button" class="inline-flex items-center justify-center w-10 h-10 p-2 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-sticky" aria-expanded="false">
                <span class="sr-only">Open main menu</span>
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
                </svg>
            </button>
        </div>
        <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-sticky">
            <ul class="flex flex-col p-4 mt-m font-medium border rounded-lg md:p-0 md:flex-row md:space-x-8 md:mt-0 md:border-0 dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
            <li>
                <a href="{{ route('home') }}" id="navbar-ul" class="block py-2 pl-3 pr-4 {{ request()->is('/') ? 'bg-teal-700 rounded font-menu md:bg-transparent md:text-teal-600 md:p-0 md:dark:text-blue-500' : 'rounded font-menu hover:bg-gray-100 md:hover:bg-transparent md:hover:text-teal-600 md:p-0 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700' }}">Home</a>
            </li>
            <li>
                <a href="{{ route('rooms') }}" id="navbar-ul" class="block py-2 pl-3 pr-4 {{ request()->is('room') ? 'text-white bg-teal-700 rounded font-menu md:bg-transparent md:text-teal-600 md:p-0 md:dark:text-blue-500' : 'rounded font-menu hover:bg-gray-100 md:hover:bg-transparent md:hover:text-teal-600 md:p-0 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700' }}">Rooms</a>
            </li>
            <li>
                <a href="{{ route('about') }}" id="navbar-ul" class="block py-2 pl-3 pr-4 {{ request()->is('about') ? 'text-white bg-teal-700 rounded font-menu md:bg-transparent md:text-teal-600 md:p-0 md:dark:text-blue-500' : 'rounded font-menu hover:bg-gray-100 md:hover:bg-transparent md:hover:text-teal-600 md:p-0 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700' }}">About</a>
            </li>
            <li>
                <a href="{{ route('blog') }}" id="navbar-ul" class="block py-2 pl-3 pr-4 {{ request()->is('blog') ? 'text-white bg-teal-700 rounded font-menu md:bg-transparent md:text-teal-600 md:p-0 md:dark:text-blue-500' : 'rounded font-menu hover:bg-gray-100 md:hover:bg-transparent md:hover:text-teal-600 md:p-0 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700' }}">Blog</a>
            </li>
            <li>
                <a href="{{ route('contact') }}"  class="block py-2 pl-3 pr-4 {{ request()->is('contact') ? 'text-white bg-teal-700 rounded font-menu md:bg-transparent md:text-teal-600 md:p-0 md:dark:text-blue-500' : 'rounded font-menu hover:bg-gray-100 md:hover:bg-transparent md:hover:text-teal-600 md:p-0 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700' }}">Contact</a>
            </li>
            @auth
                @if (auth()->user()->role == 'user')
                    <li>
                        <a href="{{ route('user.dashboard') }}"><button type="button" class="block px-4 py-2 mt-6 mr-5 text-sm font-medium text-center text-white bg-blue-900 md:hidden hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 md:mr-0 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Dashboard Admin</button></a>
                    </li>
                @elseif (auth()->user()->role == 'admin')
                    <li>
                        <a href="{{ route('filament.admin.pages.dashboard') }}"><button type="button" class="block px-4 py-2 mt-6 mr-5 text-sm font-medium text-center text-white bg-blue-900 md:hidden hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 md:mr-0 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Dashboard Admin</button></a>
                    </li>
                @endif
            @else
                <li>
                    <a href="{{ route('login') }}"><button type="button" class="block px-4 py-2 mt-6 mr-5 text-sm font-medium text-center text-white bg-blue-900 md:hidden hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 md:mr-0 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Login/Sign Up Apa</button></a>
                </li>
            @endauth
            </ul>
        </div>
    </div>
</nav>
{{-- <nav class="absolute">
    tes
</nav> --}}


