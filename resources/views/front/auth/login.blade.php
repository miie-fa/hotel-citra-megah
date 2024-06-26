@extends('front.auth.layouts.app')

@section('title', 'Sign In - ' . env('APP_NAME'))

@section('content')
    <section>
        <div class="grid items-center justify-center grid-cols-1 px-4 py-3 md:px-20 md:py-6 md:grid-cols-12">
            <div class="col-span-7 text-gray-100 none md:block">
                <span class="self-center text-[24px] font-logo whitespace-nowrap">Hotel Citra Megah</span>
                <h2 class="w-full mt-5 text-2xl font-medium md:w-3/4 md:text-5xl">Selamat Datang Di Hotel Citra Megah</h2>
                <p class="mb-3 mt-7">Hotel Citra Megah - Hotel bintang lima terbaik di Indonesia</p>
            </div>
            <div style="border-radius: 20px; background: rgba(255, 255, 255, 0.4); backdrop-filter: blur(10px);" class="col-span-5 p-6 shadow-md">
                <div class="flex flex-col text-center">
                    <span class="text-[24px] font-logo whitespace-nowrap text-gray-950">Hotel Citra Megah</span>
                    <span class="text-white">Please enter your email and password.</span>
                </div>
                @if (Session::has('success'))
                    <div class="flex items-center p-4 mt-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
                        <svg class="flex-shrink-0 inline w-4 h-4 mr-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                        </svg>
                        <span class="sr-only">Info</span>
                        <div>
                        <span class="font-medium">{{ Session::get('success') }}</span>
                        </div>
                    </div>
                @endif

                @if (Session::has('danger'))
                    <div class="flex items-center p-4 mt-4 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 dark:border-red-800" role="alert">
                        <svg class="flex-shrink-0 inline w-4 h-4 mr-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                        </svg>
                        <span class="sr-only">Info</span>
                        <div>
                            <span class="font-medium">{{ Session::get('danger') }}</span>
                        </div>
                    </div>
                @endif
                <form method="POST" action="{{ route('login.process') }}">
                    @csrf
                    <div class="mt-6">
                        <label for="email" class="text-[15px] font-normal text-white">Email</label>
                        <input type="text" id="email_address" name="email" value="{{ old('email') }}" required autofocus placeholder="Enter your email" class="rounded w-full p-2 mt-2 border border-gray-300 form-control focus:outline-none focus:ring-1 focus:border-cyan-950">
                        @if ($errors->has('success'))
                            <span class="text-danger">{{ $errors->first('email') }}</span>
                        @endif
                    </div>
                    <div class="mt-6">
                        <div class="flex justify-between">
                            <label for="password" class="text-[15px] font-normal text-white">Password</label>
                        </div>
                        <div class="flex items-center">
                            <input name="password" required type="password" id="password" value="" placeholder="Password" class="rounded w-full p-2 border border-gray-300 focus:outline-none focus:ring-1 focus:border-cyan-950">
                            @if ($errors->has('error'))
                             <span class="text-danger">{{ $errors->first('error') }}</span>
                            @endif

                            <button id="showPasswordButton" class="absolute right-12 text-cyan-950 hover:text-cyan-900 focus:outline-none">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0zM12 7a7 7 0 00-7 7 7 7 0 007 7 7 7 0 007-7 7 7 0 00-7-7z"></path></svg>
                            </button>
                        </div>
                        <div class="checkbox">
                            <label>
                                <a href="{{ route('forgot.password') }}" class="text-blue-500">Lupa Password</a>
                            </label>
                        </div>
                    </div>
                    <div class="flex items-center mt-6">
                        <div class="checkbox">
                            <label>
                                <input id="default-checkbox" type="checkbox" value="" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" name="remember"> Remember Me
                            </label>
                        </div>
                    </div>
                    <button type="submit" id="customButton" class="w-full py-2 mt-5 font-normal text-white bg-cyan-950 hover:bg-cyan-900">Sign In</button>
                </form>
                <div class="flex flex-col items-center mt-4">
                    {{-- <span class="text-gray-500">Or Sign In With</span>
                    <div class="grid grid-cols-4 gap-2 mt-2">
                        <a href="">
                            <img class="w-8" src="{{ asset('icon/fb.svg') }}" alt="">
                        </a>
                        <a href="">
                            <img class="w-8" src="{{ asset('icon/google.svg') }}" alt="">
                        </a>
                        <a href="">
                            <img class="w-8" src="{{ asset('icon/twt.svg') }}" alt="">
                        </a>
                        <a href="">
                            <img class="w-8" src="{{ asset('icon/git.svg') }}" alt="">
                        </a>
                    </div> --}}
                </div>
                <div class="mt-10 mb-2 text-center md:mb-12">
                    <span class="text-gray-500">Dont have an account ? <a href="{{ route('register') }}" class="text-sub">Sign Up</a></span>
                </div>
            </div>
            <div>

            </div>
        </div>
    </section>
@endsection

@push('js-custom')
    <script>
        const showPasswordButton = document.getElementById('showPasswordButton');
        const passwordInput = document.getElementById('password');

        showPasswordButton.addEventListener('click', (event) => {
            event.preventDefault(); // Prevent the default button action
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
            } else {
                passwordInput.type = 'password';
            }
        });
    </script>
@endpush
