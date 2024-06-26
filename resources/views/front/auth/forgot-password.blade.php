@extends('front.auth.layouts.app')

@section('title', 'Reset Password -' . env('APP_NAME'))

@section('content')
    <section>
        <div class="px-96 mt-28">
            <div style="border-radius: 20px; background: rgba(255, 255, 255, 0.4); backdrop-filter: blur(10px);" class="col-span-5 p-6 shadow-md">
                @if (Session::has('message'))
                    <div class="flex items-center p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
                        <svg class="flex-shrink-0 inline w-4 h-4 mr-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                        </svg>
                        <span class="sr-only">Info</span>
                        <div>
                        <span class="font-medium">{{ Session::get('message') }}</span>
                        </div>
                    </div>
                @endif
                @csrf
                <div class="flex flex-col text-center mb-10">
                    <span class="text-[24px] font-logo whitespace-nowrap text-gray-950">Hotel Citra Megah</span>
                    <span class="text-gray-950">Please enter your email for reset password.</span>
                </div>
                <form action="{{ route('forgot.password.post') }}" method="POST">
                    @csrf
                    <div>
                        <label for="email_address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your Email</label>
                            <input type="text" id="email_address" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="name@gmail.com" name="email" required autofocus>
                            @if ($errors->has('email'))
                                <p class="text-sm text-red-600 dark:text-red-500"><span class="font-medium">{{ $errors->first('email') }}</p>
                            @endif
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary mt-8">
                            Send Password Reset Link
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
