@extends('front.auth.layouts.app')

@section('title', 'Sign Up -' . env('APP_NAME'))

@section('content')
    <section>
        <div class="grid items-center justify-center grid-cols-1 px-4 py-3 md:px-20 md:py-6 md:grid-cols-12">
            <div style="border-radius: 20px; background: rgba(255, 255, 255, 0.4); backdrop-filter: blur(10px);" class="col-span-5 p-6 shadow-md">
                <form class="px-3" action="{{ route('register.process') }}" method="POST">
                    @csrf
                    <div class="flex flex-col text-center">
                        <span class="text-[24px] font-logo whitespace-nowrap text-gray-950">Hotel Citra Megah</span>
                        <span class="text-white">Please enter your data Here.</span>
                    </div>
                    <div class="mt-6">
                        <label for="name" class="text-[15px] font-normal text-white">Name</label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" required autofocus placeholder="Enter your name*" class="w-full p-2 mt-2 border border-gray-300 focus:outline-none focus:ring-1 focus:border-cyan-950 form-control">
                        @if ($errors->has('name'))
                                      <span class="text-danger">{{ $errors->first('name') }}</span>
                        @endif
                    </div>
                    <div class="mt-6">
                        <label for="email" class="text-[15px] font-normal text-white">Email</label>
                        <input type="text" id="email_address" name="email" value="{{ old('email') }}" required autofocus placeholder="Enter your email*" class="form-control w-full p-2 mt-2 border border-gray-300 focus:outline-none focus:ring-1 focus:border-cyan-950">
                        @if ($errors->has('email'))
                                      <span class="text-danger">{{ $errors->first('email') }}</span>
                        @endif
                    </div>
                    <div class="mt-6">
                        <label for="nama" class="text-[15px] font-normal text-white">Phone Number</label>
                        <input type="number" id="phone" value="{{ old('phone') }}" wire:model.lazy="phone" name="phone" placeholder="+62-821-4221-1200" class="w-full p-2 mt-2 border {{ $errors->has('phone') ? 'border-red-500' : 'border-gray-300' }} focus:outline-none focus:ring-1 focus:border-cyan-950">
                        @if ($errors->has('phone'))
                            <p class="text-sm text-red-500 ">{{ $errors->first('phone') }}</p>
                        @endif
                    </div>
                    <div class="mt-6">
                        <div class="flex justify-between">
                            <label for="password" class="text-[15px] font-normal text-white">Password</label>
                        </div>
                        <div>
                            <div class="flex items-center">
                                <input type="password" id="password" value="{{ old('password') }}" name="password" required placeholder="••••••••" class="form-control w-full p-2 border border-gray-300 focus:outline-none focus:ring-1 focus:border-cyan-950">

                                <button id="showPasswordButton" class="absolute right-12 text-cyan-950 hover:text-cyan-900 focus:outline-none">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0zM12 7a7 7 0 00-7 7 7 7 0 007 7 7 7 0 007-7 7 7 0 00-7-7z"></path></svg>
                                </button>
                            </div>
                            @if ($errors->has('password'))
                                <span class="text-sm text-red-500 ">{{ $errors->first('password') }}</span>
                            @endif
                        </div>
                        <div class="mt-6">
                            <label for="nama" class="text-[15px] font-normal text-white">Konfirmasi Password</label>
                            <input type="password" id="password_confirmation" name="password_confirmation" required placeholder="••••••••" class="w-full p-2 border border-gray-300 {{ $errors->has('password_confirmation') ? 'border-red-500' : 'border-gray-300' }} focus:outline-none focus:ring-1 focus:border-cyan-950">
                            @if ($errors->has('password_confirmation'))
                                <p class="text-sm text-red-500 ">{{ $errors->first('password_confirmation') }}</p>
                            @endif
                        </div>
                    </div>
                    <div class="flex items-center mt-6">
                        <input id="default-checkbox" type="checkbox" value="" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <span class="text-[16px] font-normal text-dark ms-2">Remember Me</span>
                    </div>
                    <button id="customButton" name="button" type="submit" class="w-full py-2 mt-5 font-normal text-white bg-cyan-950 hover:bg-cyan-900">Register</button>
                </form>
                <div class="mt-10 mb-12 text-center">
                    <span class="text-white">Have an account ? <a href="{{route('login')}}" class="text-sub">Sign In</a></span>
                </div>
            </div>
            <div class="col-span-7 text-gray-100 none md:block ms-16">
                <span class="self-center text-[24px] font-logo whitespace-nowrap">Hotel Citra Megah</span>
                <h2 class="w-full mt-5 text-2xl font-medium md:w-3/4 md:text-5xl">Selamat Datang Di Hotel Citra Megah</h2>
                <p class="mb-3 mt-7">Hotel Citra Megah - Hotel bintang lima terbaik di Indonesia</p>
            </div>

        </div>
    </section>
@endsection

@push('js-custom')
    <script>
        const showPasswordButton = document.getElementById('showPasswordButton');
        const passwordInput = document.getElementById('password');
        const confirmationPasswordInput = document.getElementById('password_confirmation');

        showPasswordButton.addEventListener('click', (event) => {
            event.preventDefault();
            if ((passwordInput.type === 'password') && (confirmationPasswordInput.type === 'password')) {
                passwordInput.type = 'text';
                confirmationPasswordInput.type = 'text';
            } else {
                passwordInput.type = 'password';
                confirmationPasswordInput.type = 'password';
            }
        });
    </script>
@endpush
