@extends('front.layout.app')

@section('title', 'Halman Kontak Detail - ' . env('APP_NAME'))

@push('css-custom')
    <style>
        .sidebar {
            height: auto;
            overflow-y: auto;
            overflow-x: hidden;
            position: -webkit-sticky;
            position: sticky;
            top: 15%;
        }

        .iti { width: 100%; }
    </style>
@endpush

@section('content')
<section class="relative">
    <img src="https://images.unsplash.com/photo-1583037189850-1921ae7c6c22?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mjk2fHxob3RlbCUyMGxvYmJ5fGVufDB8fDB8fHww&auto=format&fit=crop&w=1470&h=300" alt="banner" class="max-w-full mx-auto filter brightness-50">
    <div class="absolute inset-0 flex items-center justify-center">
        <span class="px-1 py-1 text-lg font-bold text-white md:px-5 md:text-5xl md:py-7 text-center">Contact and Billing Details</span>
    </div>
</section>

@if(session()->has('cart_room_id'))
@php
    $arr_cart_room_id = session()->get('cart_room_id', []);
    $arr_cart_checkin_date = session()->get('cart_checkin_date', []);
    $arr_cart_checkout_date = session()->get('cart_checkout_date', []);
    $arr_cart_adult = session()->get('cart_adult', []);
    $arr_cart_children = session()->get('cart_children', []);
    $total_price = 0;
    $total_item = count($arr_cart_room_id);
@endphp
@endif
<section class="mx-auto max-w-screen-x">
        <div class="flex flex-col justify-around p-6 lg:px-24">
            <h2 class="mb-10 font-semibold text-gray-800 lg:w-3/5 lg:text-3xl">Contact and Billing Details</h2>

            <div class="grid grid-cols-1 gap-6 mt-4 mb-10 md:grid-cols-12">
                <!-- Form Pemesanan -->

                    <div class="lg:col-span-8">
                        @auth
                            @php
                                if(session()->has('billing_name')) {
                                    $billing_name = session()->get('billing_name');
                                } else {
                                    $billing_name = Auth::user()->name;
                                }

                                if(session()->has('billing_email')) {
                                    $billing_email = session()->get('billing_email');
                                } else {
                                    $billing_email = Auth::user()->email;
                                }

                                if(session()->has('billing_phone')) {
                                    $billing_phone = session()->get('billing_phone');
                                } else {
                                    $billing_phone = Auth::user()->phone;
                                }

                                if(session()->has('billing_country')) {
                                    $billing_country = session()->get('billing_country');
                                } else {
                                    $billing_country = Auth::user()->country;
                                }

                                if(session()->has('billing_address')) {
                                    $billing_address = session()->get('billing_address');
                                } else {
                                    $billing_address = Auth::user()->address;
                                }

                                if(session()->has('billing_notes')) {
                                    $billing_notes = session()->get('billing_notes');
                                } else {
                                    $billing_notes = Auth::user()->state;
                                }
                            @endphp
                        @endauth
                        <div>
                            <h2 class="mb-5 text-lg font-medium text-gray-800 dark:text-white">Billing Details</h2>
                            @auth
                            <div class="p-4 mt-6 mb-4 text-sm text-green-800 bg-green-200 rounded-lg" role="alert">
                                <div class="flex justify-between">
                                    <div><i class="p-1 bg-gray-300 rounded-full fa-solid fa-check me-2"></i>Logged in as, {{ Auth::user()->name }}!</div>
                                    <a href="{{ route('logout') }}">Logout</a>
                                </div>
                            </div>
                            <div>
                                <form class="">
                                    <div class="mb-4">
                                        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                                            <input type="text" id="name" name="billing_name" value="{{ $billing_name }}" class="w-full p-2 mt-2 border border-gray-300 rounded-md md:col-span-2 focus:outline-none focus:ring-1 focus:border-cyan-950">
                                            <input type="text" id="email" name="billing_email" placeholder="Email*" value="{{ $billing_email }}" class="w-full p-2 mt-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:border-cyan-950">
                                            <input type="text" id="phone" name="billing_phone" placeholder="Phone" value="{{ $billing_phone }}" class="w-full p-2 mt-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:border-cyan-950">
                                            <span class="text-[12px] italic font-normal text-sub -mt-2">Email ini akan menjadi tujuan pengiriman konfirmasi Anda.</span>
                                        </div>
                                    </div>
                                    <div class="mb-4">
                                        <label for="nama" class="text-[1.3em] font-medium text-gray-800">Alamat</label>
                                        <div class="w-full mb-3">
                                            <select id="country" name="billing_country" class="w-2/4 p-2 mt-2 text-black placeholder-gray-400 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:border-cyan-950" id="">
                                                <option class="" selected>{{ $billing_country ?? 'Pilih Negara' }}</option>
                                                <option value="indonesia">Indonesia</option>
                                            </select>
                                        </div>
                                        <textarea id="address" name="billing_address" rows="4" class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:border-cyan-950" placeholder="Alamat Tempat Tinggal Sekarang (Optional)">{{ $billing_address }}</textarea>
                                    </div>
                                    <div class="mb-4">
                                        <label for="detail" class="text-[1.3em] font-medium text-gray-800">Additional Notes <span class="text-sub">(optional)</span></label>
                                        <textarea id="detail" name="billing_notes" rows="4" class="w-full p-2 mt-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:border-cyan-950" ></textarea>
                                    </div>
                                </form>
                            </div>
                            @else
                            <span class="text-sm font-normal text-sub">Login atau daftar untuk pemesanan lebih cepat *</span>
                            <div class="mt-3 mb-4 border-b border-gray-200 dark:border-gray-700">
                                <ul class="grid grid-cols-3 -mb-px text-sm font-medium text-center" id="myTab" data-tabs-toggle="#myTabContent" role="tablist">
                                    <li class="" role="presentation">
                                        <button class="inline-block p-4 border-b-2 rounded-t-lg" id="profile-tab" data-tabs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Existing Customer Login</button>
                                    </li>
                                    <li class="" role="presentation">
                                        <button class="inline-block p-4 border-b-2 rounded-t-lg" id="dashboard-tab" data-tabs-target="#dashboard" type="button" role="tab" aria-controls="dashboard" aria-selected="false">Create new Account</button>
                                    </li>
                                    <li class="" role="presentation">
                                        <button class="inline-block p-4 border-b-2 rounded-t-lg" id="settings-tab" data-tabs-target="#settings" type="button" role="tab" aria-controls="settings" aria-selected="false">Checkout as Guest</button>
                                    </li>
                                </ul>
                            </div>

                            <div id="myTabContent">

                                {{-- Login --}}
                                <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                    <form action="{{ route('login.process') }}" method="POST">
                                        @csrf
                                        <div class="mb-6">
                                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                                            <input type="email" id="email" name="email" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" placeholder="Email Address" required>
                                        </div>
                                        <div class="mb-6">
                                            <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                                            <input type="password" id="password" name="password" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" placeholder="Password" required>
                                        </div>
                                        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Login</button>
                                    </form>
                                </div>

                                {{-- Register --}}
                                <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
                                    <form action="{{ route('register.process') }}" method="POST">
                                        @csrf
                                        @method('POST')
                                        <div class="mb-6">
                                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your Name</label>
                                            <input name="name" type="text" id="name" value="{{ old('name') }}" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" required>
                                        </div>
                                        <div class="mb-6">
                                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your email</label>
                                            <input name="email" type="email" id="email" value="{{ old('email') }}" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" required>
                                        </div>
                                        <div class="mb-6">
                                            <label for="phone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your Phone</label>
                                            <input name="phone" type="number" id="phone" value="{{ old('phone') }}" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" required>
                                        </div>
                                        <div class="mb-6">
                                            <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your password</label>
                                            <input name="password" type="password" id="password" value="{{ old('password') }}" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" required>
                                        </div>
                                        <div class="mb-6">
                                            <label for="repeat-password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Repeat password</label>
                                            <input name="password_confirmation" type="password" id="repeat-password" value="{{ old('password_confirmation') }}" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" required>
                                        </div>
                                        <div class="flex items-start mb-6">
                                            <div class="flex items-center h-5">
                                                <input id="terms" type="checkbox" value="" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800" required>
                                            </div>
                                            <label for="terms" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">I agree with the <a href="#" class="text-blue-600 hover:underline dark:text-blue-500">terms and conditions</a></label>
                                        </div>
                                        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Register new account</button>
                                    </form>
                                </div>

                                {{-- New Guest --}}
                                <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="settings" role="tabpanel" aria-labelledby="settings-tab">
                                    <form class="">
                                        <div class="mb-4">
                                            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                                                <input type="text" id="billing_name" name="billing_name" value=""  placeholder="Nama*" class="w-full p-2 mt-2 border border-gray-300 rounded-md md:col-span-2 focus:outline-none focus:ring-1 focus:border-cyan-950">
                                                <input type="text" id="billing_email" name="billing_email" placeholder="Email*" value="" class="w-full p-2 mt-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:border-cyan-950">
                                                <input type="text" id="billing_phone" name="billing_phone" placeholder="Nomor Telepon*" class="w-full p-2 mt-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:border-cyan-950">
                                                <span class="text-[12px] italic font-normal text-sub -mt-2">Email ini akan menjadi tujuan pengiriman konfirmasi Anda.</span>
                                            </div>
                                        </div>
                                        <div class="mb-4">
                                            <label for="nama" class="text-[1.3em] font-medium text-gray-800">Alamat</label>
                                            <div class="w-full mb-3 rounded-md">
                                                <select id="billing_country" name="billing_country" class="w-2/4 p-2 mt-2 text-black placeholder-gray-400 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:border-cyan-950" id="">
                                                    <option class="" selected disabled>Negara*</option>
                                                    <option value="indonesia">Indonesia</option>
                                                </select>
                                            </div>
                                            <textarea id="billing_address" name="billing_address" rows="4" class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:border-cyan-950" placeholder="Alamat Tempat Tinggal Sekarang (Optional)"></textarea>
                                        </div>
                                        <div class="mb-4">
                                            <label for="billing_notes" class="text-[1.3em] font-medium text-gray-800">Detail dan Preferensi Tambahan <span class="text-sub">(optional)</span></label>
                                            <textarea id="billing_notes" name="billing_notes" rows="4" class="w-full p-2 mt-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:border-cyan-950" placeholder="Alamat Tempat Tinggal Sekarang (Optional)"></textarea>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <div class="flex items-start mt-6">
                                <div class="flex items-center h-5">
                                    <input id="terms" type="checkbox" value="" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800" required>
                                </div>
                                <label for="terms" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">I agree with the <a href="#" class="text-blue-600 hover:underline dark:text-blue-500">terms and conditions</a></label>
                            </div>
                            @endauth
                        </div>
                    </div>

                <!-- Ringkasan Pemesanan -->
                <form class="lg:col-span-4 sidebar" action="{{ route('payment') }}" method="POST">
                @csrf

                <div>
                    @if (!empty($arr_cart_room_id))
                    @php
                        $arr_cart_room_id = array();
                        $i=0;
                        foreach(session()->get('cart_room_id') as $value) {
                            $arr_cart_room_id[$i] = $value;
                            $i++;
                        }

                        $arr_cart_checkin_date = array();
                        $i=0;
                        foreach(session()->get('cart_checkin_date') as $value) {
                            $arr_cart_checkin_date[$i] = $value;
                            $i++;
                        }

                        $arr_cart_checkout_date = array();
                        $i=0;
                        foreach(session()->get('cart_checkout_date') as $value) {
                            $arr_cart_checkout_date[$i] = $value;
                            $i++;
                        }

                        $arr_cart_adult = array();
                        $i=0;
                        foreach(session()->get('cart_adult') as $value) {
                            $arr_cart_adult[$i] = $value;
                            $i++;
                        }

                        $arr_cart_children = array();
                        $i=0;
                        foreach(session()->get('cart_children') as $value) {
                            $arr_cart_children[$i] = $value;
                            $i++;
                        }

                        $total_price = 0;
                        for($i=0;$i<count($arr_cart_room_id);$i++)
                        {
                        $room_data = DB::table('rooms')->where('id',$arr_cart_room_id[$i])->first();
                    @endphp
                    <div class="flex justify-between px-2 mt-2 mb-2">
                        <span class="text-sm font-semibold">Sub Total Room {{ $arr_cart_room_id[$i] }}</span>
                        <span class="text-sm font-semibold text-gray-700">
                            @php
                                $d1 = explode('/',$arr_cart_checkin_date[$i]);
                                $d2 = explode('/',$arr_cart_checkout_date[$i]);
                                $d1_new = $d1[2].'-'.$d1[1].'-'.$d1[0];
                                $d2_new = $d2[2].'-'.$d2[1].'-'.$d2[0];
                                $t1 = strtotime($d1_new);
                                $t2 = strtotime($d2_new);
                                $diff = ($t2-$t1)/60/60/24;
                                echo 'Rp '.number_format($room_data->price*$diff, 0, ',', '.');
                            @endphp
                        </span>
                    </div>
                    @php
                        $total_price = $total_price+($room_data->price*$diff);
                    }
                    @endphp
                        <div class="px-2 mt-8 border-t">
                            <div class="flex justify-between py-6 font-semibold text-md">
                                <span>Grand Total</span>
                                <span>Rp {{ number_format($total_price, 0, ',', '.') ?? 0 }}</span>
                            </div>
                        </div>
                    @else
                        @php
                            session()->flash('error', 'Keranjang belanja kosong.');
                        @endphp
                        <script>window.location = "{{ route('home') }}";</script>
                    @endif
                    <button type="submit" class="w-full py-3 mt-5 font-bold text-white uppercase bg-cyan-950 hover:bg-cyan-900">PAY NOW</button>
                </div>
                <div class="hidden">
                    @auth
                        @php
                            if(session()->has('billing_name')) {
                                $billing_name = session()->get('billing_name');
                            } else {
                                $billing_name = Auth::user()->name;
                            }

                            if(session()->has('billing_email')) {
                                $billing_email = session()->get('billing_email');
                            } else {
                                $billing_email = Auth::user()->email;
                            }

                            if(session()->has('billing_phone')) {
                                $billing_phone = session()->get('billing_phone');
                            } else {
                                $billing_phone = Auth::user()->phone;
                            }

                            if(session()->has('billing_country')) {
                                $billing_country = session()->get('billing_country');
                            } else {
                                $billing_country = Auth::user()->country;
                            }

                            if(session()->has('billing_address')) {
                                $billing_address = session()->get('billing_address');
                            } else {
                                $billing_address = Auth::user()->address;
                            }

                            if(session()->has('billing_notes')) {
                                $billing_notes = session()->get('billing_notes');
                            } else {
                                $billing_notes = Auth::user()->state;
                            }
                        @endphp
                    @endauth
                    <div>
                        <h2 class="mb-5 text-lg font-medium text-gray-800 dark:text-white">Billing Details</h2>
                        @auth
                        <div class="p-4 mt-6 mb-4 text-sm text-green-800 bg-green-200 rounded-lg" role="alert">
                            <div class="flex justify-between">
                                <div><i class="p-1 bg-gray-300 rounded-full fa-solid fa-check me-2"></i>Logged in as, {{ Auth::user()->name }}!</div>
                                <a href="{{ route('logout') }}">Logout</a>
                            </div>
                        </div>
                        <div>
                            <form class="">
                                <div class="mb-4">
                                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                                        <input type="text" id="name" name="billing_name" value="{{ $billing_name }}" class="w-full p-2 mt-2 border border-gray-300 rounded-md md:col-span-2 focus:outline-none focus:ring-1 focus:border-cyan-950">
                                        <input type="text" id="email" name="billing_email" placeholder="Email*" value="{{ $billing_email }}" class="w-full p-2 mt-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:border-cyan-950">
                                        <input type="text" id="phone" name="billing_phone" placeholder="Phone" value="{{ $billing_phone }}" class="w-full p-2 mt-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:border-cyan-950">
                                        <span class="text-[12px] italic font-normal text-sub -mt-2">Email ini akan menjadi tujuan pengiriman konfirmasi Anda.</span>
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <label for="nama" class="text-[1.3em] font-medium text-gray-800">Alamat</label>
                                    <div class="w-full mb-3">
                                        <select id="country" name="billing_country" class="w-2/4 p-2 mt-2 text-black placeholder-gray-400 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:border-cyan-950" id="">
                                            <option class="" selected>{{ $billing_country ?? 'Pilih Negara' }}</option>
                                            <option value="indonesia">Indonesia</option>
                                        </select>
                                    </div>
                                    <textarea id="address" name="billing_address" rows="4" class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:border-cyan-950" placeholder="Alamat Tempat Tinggal Sekarang (Optional)">{{ $billing_address }}</textarea>
                                </div>
                                <div class="mb-4">
                                    <label for="detail" class="text-[1.3em] font-medium text-gray-800">Additional Notes <span class="text-sub">(optional)</span></label>
                                    <textarea id="detail" name="billing_notes" rows="4" class="w-full p-2 mt-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:border-cyan-950" ></textarea>
                                </div>
                            </form>
                        </div>
                        @endauth
                </div>
            </div>
        </div>
    </form>
</section>
@endsection

@push('js-custom')
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-element-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.20/dist/sweetalert2.all.min.js"></script>
    <script>
        const input = document.querySelector("#phone");
        window.intlTelInput(input, {
            initialCountry: "auto",
            geoIpLookup: callback => {
                fetch("https://ipapi.co/json")
                .then(res => res.json())
                .then(data => callback(data.country_code))
                .catch(() => callback("us"));
            },
            utilsScript: "/intl-tel-input/js/utils.js?1695806485509" // just for formatting/placeholders etc
        });

        const tabElements = [
            {
                id: 'profile',
                triggerEl: document.querySelector('#profile-tab-example'),
                targetEl: document.querySelector('#profile-example')
            },
            {
                id: 'dashboard',
                triggerEl: document.querySelector('#dashboard-tab-example'),
                targetEl: document.querySelector('#dashboard-example')
            },
            {
                id: 'settings',
                triggerEl: document.querySelector('#settings-tab-example'),
                targetEl: document.querySelector('#settings-example')
            },
            {
                id: 'contacts',
                triggerEl: document.querySelector('#contacts-tab-example'),
                targetEl: document.querySelector('#contacts-example')
            }
        ];

        // options with default values
        const options = {
            defaultTabId: 'settings',
            activeClasses: 'text-blue-600 hover:text-blue-600 dark:text-blue-500 dark:hover:text-blue-400 border-blue-600 dark:border-blue-500',
            inactiveClasses: 'text-gray-500 hover:text-gray-600 dark:text-gray-400 border-gray-100 hover:border-gray-300 dark:border-gray-700 dark:hover:text-gray-300',
            onShow: () => {
                console.log('tab is shown');
            }
        };

        customButton.addEventListener('click', () => {
            Swal.fire({
                html: `
                    <div class="flex flex-col items-center">
                        <img src="{{ asset('icon/check.png') }}" alt="Check Icon" class="w-8 h-8 mt-5 mb-2">
                        <span class="text-lg font-normal text-sub">Terima Kasih</span>
                        <h2 class="mt-3 text-xl font-semibold text-center">Pemesanan anda telah selesai</h2>
                        <span class="text-sm text-center">Terima kasih telah memilih hotel kami sebagai tempat menginap anda</span>
                        <span class="text-[17px] mb-7 mt-7 text-sub text-center">Tunggu beberapa menit, kami akan segera mengirimkan konfirmasi pemesanan ke akun email anda.</span>
                        <div class="flex justify-center space-x-4">
                            <button class="px-3 py-2 text-white text-[15px] bg-cyan-950 hover:bg-cyan-900">
                                Batalkan Pemesanan
                            </button>
                            <button class="px-3 py-2 text-white text-[15px] bg-cyan-950 hover:bg-cyan-900">
                                Cek Pemesanan
                            </button>
                        </div>
                    </div>
                `,
                showCancelButton: false,
                showConfirmButton: false,
            });
        });

        const openModalButton = document.getElementById('openModalButton');
        const closeModalButton = document.getElementById('closeModalButton');
        const modal = document.getElementById('myModal');
        const overlay = document.getElementById('overlay');

        openModalButton.addEventListener('click', () => {
            modal.classList.remove('opacity-0', 'pointer-events-none', 'scale-95');
            overlay.classList.remove('opacity-0', 'pointer-events-none');
            modal.classList.add('opacity-100', 'scale-100');
            overlay.classList.add('opacity-50');
        });

        closeModalButton.addEventListener('click', () => {
            modal.classList.remove('opacity-100', 'scale-100');
            overlay.classList.remove('opacity-50');
            setTimeout(() => {
                modal.classList.add('opacity-0', 'pointer-events-none', 'scale-95');
                overlay.classList.add('opacity-0', 'pointer-events-none');
            }, 300);
        });

        $(document).ready(function() {
            $("#pesan").on("click", function() {
                const userId = $("#user_id").text();
                const name = $("#name").text();
                const email = $("#email").text();
                const phone = $("#phone").text();
                const country = $("#country").text();
                const address = $("#address").text();
                const orderNo = $("#orderNo").text();

                $.ajax({
                    type: "POST",
                    url: "{{ route('proses_pemesanan') }}",
                    data: {
                        name: name,
                        email: email,
                        phone: phone,
                        country: country,
                        address: address,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Pemesanan Berhasil',
                            text: 'Pemesanan berhasil dilakukan!',
                            showCancelButton: true,
                            confirmButtonText: 'Lanjut',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = "/booking/  ";
                            }
                        });
                    },
                    error: function(xhr, status, error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Pemesanan Gagal',
                            text: 'Terjadi kesalahan saat melakukan pemesanan.',
                        });
                    }
                });
            });
        });
    </script>
@endpush
