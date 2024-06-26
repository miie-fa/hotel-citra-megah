@extends('front.layout.app')

@section('title', 'Halaman Pembayaran - ' . env('APP_NAME'))

@push('css-custom')
<style>
    .sidebar {
        height: 90vh;
        overflow-y: auto;
        overflow-x: hidden;
        position: -webkit-sticky;
        position: sticky;
        top: 13%;
    }

    .tabs__buttons--container {
        display: flex;
        margin-bottom: 1rem;
    }

    .tabs__tab-btn {
        background: none;
        border: none;
        padding: 1rem 2rem;
        cursor: pointer;
        border-bottom: solid 3px #81c784;
    }

    .tabs__tab-btn--not-selected {
        border-bottom-color: #eeeeee;
    }

    .tabs__tab-btn:hover {
        background-color: #eeeeee;
        transition: 0.3s;
    }

    .tabs__tab--hide {
        display: none;
    }

    .tabs__tab--show {
        display: block;
    }

    .tabs__tab {
        animation: tabApear 0.6s;
    }

    @keyframes tabApear {
        from {
            opacity: 0;
        }

        to {
            opacity: 1;
        }
    }

    swiper-container {
        width: 340px;
        height: 420px;
    }

</style>
@endpush

@section('content')
<section class="relative">
    <img src="https://images.unsplash.com/photo-1518458028785-8fbcd101ebb9?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&h=300" alt="banner" class="max-w-full mx-auto filter brightness-50">
    <div class="absolute inset-0 flex items-center justify-center">
        <span class="px-1 py-1 text-lg font-bold text-white md:px-5 md:text-5xl md:py-7 text-center">Payment</span>
    </div>
</section>

@if(session()->has('cart_room_id') && count(session('cart_room_id')) > 0)
    @php
    $arr_cart_room_id = session()->get('cart_room_id', []);
    $arr_cart_checkin_date = session()->get('cart_checkin_date', []);
    $arr_cart_checkout_date = session()->get('cart_checkout_date', []);
    $arr_cart_adult = session()->get('cart_adult', []);
    $arr_cart_children = session()->get('cart_children', []);
    $total_price = 0;
    $total_item = count($arr_cart_room_id);
    @endphp
@else
    @php
        session()->flash('message', 'Keranjang belanja kosong.');
    @endphp
    <script>window.location = "{{ route('home') }}";</script>
@endif
<section class="max-w-screen-xl py-10 mx-auto lg:px-20">
    <div class="grid grid-cols-3 gap-5">
        <div class="col-span-2">
            <div class="">
                <h1 class="mb-2 text-2xl font-medium">Contact Details</h1>
                <div class="w-full overflow-x-auto">
                    <table class="min-w-full text-gray-800">
                        <tbody>
                        <!-- Baris 1 -->
                        <tr>
                            <td class="w-1/4 py-2 font-medium">Full Name*</td>
                            <td class="py-2">{{ session()->get('billing_name') }}</td>
                        </tr>
                        <!-- Baris 2 -->
                        <tr>
                            <td class="py-2 font-medium">Email*</td>
                            <td class="py-2">{{ session()->get('billing_email') }}</td>
                        </tr>
                        <!-- Baris 3 -->
                        <tr>
                            <td class="py-2 font-medium">Phone*</td>
                            <td class="py-2">{{ session()->get('billing_phone') }}</td>
                        </tr>
                        <tr>
                            <td class="py-2 font-medium">Address*</td>
                            <td class="py-2">{{ session()->get('billing_address') }}</td>
                        </tr>
                        <tr>
                            <td class="py-2 font-medium">Country*</td>
                            <td class="py-2">{{ session()->get('billing_country') }}</td>
                        </tr>
                        <tr>
                            <td class="py-2 font-medium">Notes*</td>
                            <td class="py-2">{{ session()->get('billing_notes') }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="mt-6 border-t-2">
                <h1 class="mt-4 mb-2 text-2xl font-medium">Cart Details</h1>
                <div class="w-full overflow-x-auto">
                    <table class="w-full text-left text-gray-800 dark:text-gray-400">
                        <tbody>
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
                            <tr class="border-b">
                                <td class="py-2">
                                    {{ $room_data->name }}
                                    <br class="mb-1">
                                    ({{ $arr_cart_checkin_date[$i] }} - {{ $arr_cart_checkout_date[$i] }})
                                    <br class="mb-1">
                                    Adult: {{ $arr_cart_adult[$i] }}, Children: {{ $arr_cart_children[$i] ?? '-' }}
                                </td>
                                <td class="">
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
                                </td>
                            </tr>
                            @php
                            $total_price = $total_price+($room_data->price*$diff);
                            }
                            @endphp
                            <tr>
                                <td class=""><b>Grand Total:</b></td>
                                <td class="p_price"><b>Rp {{ number_format($total_price, 0, ',', '.') ?? 0 }}</b></td>
                            </tr>
                            @else
                                @php
                                session()->flash('error', 'Ada sesuatu yang salah.');
                                @endphp
                                <script>window.location = "{{ route('home') }}";</script>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-span-1 p-6 text-gray-800 rounded-lg shadow-lg">
            <h1 class="mb-2 text-2xl font-medium">Payment Method</h1>
            <div>
                <select name="payment_method" id="paymentMethodChange" autocomplete="off" class="mt-5 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 select2">
                    <option selected >Choose Payment Method</option>
                    <option value="Ipaymu">Ipaymu</option>
                    <option value="PayAtHotel">Pay At Hotel</option>
                    {{-- <option value="Develop Test">Developer Test</option>
                    <option value="PayPal">PayPal</option>
                    <option value="Stripe">Stripe</option> --}}
                </select>

                <div class="ipaymu mt_20">
                    <div>
                        <img src="https://my.ipaymu.com/asset/images/logo-ipaymu/ipaymu-text-plus-blue.png" alt="ipaymu-logo" width="100">
                        <form action="{{ route('ipaymu',$total_price) }}" method="post">
                            @csrf
                            <button type="submit" class="w-2/4 py-2 mt-5 font-normal text-white rounded-md bg-cyan-950 hover:bg-cyan-900">IPAYMU</button>
                        </form>
                    </div>
                </div>

                <div class="pay_at_hotel mt_20">
                    <div>
                        <img src="https://metroparkviewhotel.com/wp-content/uploads/2021/12/icon-pay-hotel-200px.png" alt="pay_at_hotel-logo" width="150">
                        <form action="{{ route('pay_at_hotel',$total_price) }}" method="post">
                            @csrf
                            <button type="submit" class="w-2/4 py-2 mt-5 font-normal text-white rounded-md bg-cyan-950 hover:bg-cyan-900">PAY NOW</button>
                        </form>
                    </div>
                </div>


                {{-- <div class="paypal mt_20">
                    <h4>Pay with PayPal</h4>
                    <div id="paypal-button"><a href="{{ route('make.payment') }}" class="w-full bg-indigo-500 uppercase rounded-xl font-extrabold text-white px-6 h-8">Pay with PayPal👉</a></div>
                </div>

                <div class="stripe mt_20">
                    <h4>Pay with Stripe</h4>
                    @php
                    $cents = $total_price*100;
                    $customer_email = session()->get('billing_email');
                    $stripe_publishable_key = 'pk_test_51LT28GF67T3XLjgLXbAMW8YNgvDyv6Yrg7mB6yHJhfmWgLrAL79rSBPvxcbKrsKtCesqJmxlOd259nMrNx4Qlhoa00zX7rOhOq';
                    @endphp
                    <form action="{{ route('pay_at_hotel',$total_price) }}" method="post">
                        @csrf

                    </form>
                </div> --}}
            </div>
        </div>
    </div>
</section>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.20/dist/sweetalert2.all.min.js"></script>
@php
$client = 'ARw2VtkTvo3aT7DILgPWeSUPjMK_AS5RlMKkUmB78O8rFCJcfX6jFSmTDpgdV3bOFLG2WE-s11AcCGTD';
@endphp
<script>
    paypal.Button.render({
		env: 'sandbox',
		client: {
			sandbox: '{{ $client }}',
			production: '{{ $client }}'
		},
		locale: 'en_US',
		style: {
			size: 'medium',
			color: 'blue',
			shape: 'rect',
		},
		// Set up a payment
		payment: function (data, actions) {
			return actions.payment.create({
				redirect_urls:{
					return_url: '{{ url("payment/paypal/$total_price") }}'
				},
				transactions: [{
					amount: {
						total: '{{ $total_price }}',
						currency: 'USD'
					}
				}]
			});
		},
		// Execute the payment
		onAuthorize: function (data, actions) {
			return actions.redirect();
		}
	}, '#paypal-button');
</script>
@endsection

@push('js-custom')
@endpush