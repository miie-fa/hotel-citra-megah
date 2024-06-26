@extends('front.layout.app')

@section('title', 'Cart')

@push('css-custom')
    <style>
    </style>
@endpush

@section('content')
<section class="relative">
    <img src="https://images.unsplash.com/photo-1606402179428-a57976d71fa4?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1374&h=300&q=80" alt="banner" class="max-w-full mx-auto filter brightness-50">
    <div class="absolute inset-0 flex items-center justify-center">
        <span class="px-1 py-1 text-lg font-bold text-white md:px-5 md:text-5xl md:py-7 text-center">Cart</span>
    </div>
</section>

@php
    $arr_cart_room_id = session()->get('cart_room_id', []);
    $arr_cart_checkin_date = session()->get('cart_checkin_date', []);
    $arr_cart_checkout_date = session()->get('cart_checkout_date', []);
    $arr_cart_adult = session()->get('cart_adult', []);
    $arr_cart_children = session()->get('cart_children', []);
    $total_price = 0;
    $total_item = count($arr_cart_room_id);
@endphp
<section>
    <div class="container mx-auto mt-10">
        <div class="flex my-10 bg-gray-100 shadow-md">
            <div class="w-3/4 px-10 py-10 bg-white">
                <div class="flex justify-between pb-8 border-b">
                    <h1 class="text-2xl font-semibold">Price Summary and Additional Services</h1>

                    <h2 class="text-2xl font-semibold">{{ $total_item ?? 0 }} Items</h2>
                </div>
                    {{-- Head Card --}}
                    {{-- <div class="flex mt-10 mb-5">
                        <h3 class="w-2/5 text-xs font-semibold text-gray-600 uppercase">Room Details</h3>
                        <h3 class="w-1/5 text-xs font-semibold text-center text-gray-600 uppercase">Price/night</h3>
                        <h3 class="w-1/5 text-xs font-semibold text-center text-gray-600 uppercase">Checkin</h3>
                        <h3 class="w-1/5 text-xs font-semibold text-center text-gray-600 uppercase">Checkout</h3>
                        <h3 class="w-1/5 text-xs font-semibold text-center text-gray-600 uppercase">Guests</h3>
                        <h3 class="w-1/5 text-xs font-semibold text-center text-gray-600 uppercase">Total</h3>
                    </div> --}}
                    @if(session()->has('cart_room_id'))
                        @php
                            $arr_cart_room_id = session()->get('cart_room_id', []);
                            $arr_cart_room_name = session()->get('cart_room_name', []);
                            $arr_cart_checkin_date = session()->get('cart_checkin_date', []);
                            $arr_cart_checkout_date = session()->get('cart_checkout_date', []);
                            $arr_cart_adult = session()->get('cart_adult', []);
                            $arr_cart_children = session()->get('cart_children', []);
                            $total_price = 0;
                            $total_item = count($arr_cart_room_id);
                        @endphp
                        {{-- Body Card --}}

                        @foreach ($arr_cart_room_id as $i => $room_id)
                            @php
                                $room_data = DB::table('rooms')->where('id', $room_id)->first();
                                $photoUrls = json_decode($room_data->featured_photo);
                                $checkin_date = $arr_cart_checkin_date[$i];
                                $checkout_date = $arr_cart_checkout_date[$i];
                                $adults = $arr_cart_adult[$i];
                                $children = $arr_cart_children[$i];

                                $checkin = strtotime(str_replace('/', '-', $checkin_date));
                                $checkout = strtotime(str_replace('/', '-', $checkout_date));
                                $diff = ($checkout - $checkin) / 60 / 60 / 24;
                                $subtotal = $room_data->price * $diff;
                                $total_price += $subtotal;
                            @endphp
                            <div class="flex flex-col px-8 py-5 hover:bg-gray-100">
                                <div class="flex">
                                    @foreach ($photoUrls as $photo)
                                        @if ($loop->first)
                                        <div class="w-40">
                                            <img class="h-24 rounded-lg" src="{{ asset('storage/'. $photo) }}" alt="{{ $room_data->name }}">
                                        </div>
                                        @endif
                                        @if ($loop->index >= 1)
                                            @break
                                        @endif
                                    @endforeach
                                    <div class="flex flex-col justify-between flex-grow py-4 ml-1">
                                        <span class="text-2xl font-medium">{{ $room_data->name }}</span>
                                        <div class="text-[17px] text-gray-500 font-semilight">
                                            <span class="">{{ date('M j, Y', strtotime(str_replace('/', '-', $arr_cart_checkin_date[$i]))) }} -</span>
                                            <span class="text-[17px] text-gray-500 font-semilight">{{ date('M j, Y', strtotime(str_replace('/', '-', $arr_cart_checkout_date[$i]))) }}</span>
                                            ( <span class="night">{{ $diff }}</span><span class="text-[17px] text-gray-500 font-semilight"> Nights )</span>
                                        </div>
                                        <span class="text-xs text-red-500"></span>
                                    </div>
                                </div>

                                <div class="flex justify-between mt-7">
                                    <div>
                                        <span class="text-lg font-medium">
                                            {{ $arr_cart_adult[$i] }} Adult @if ($arr_cart_children == 1) {{ $arr_cart_children[$i] }} Childrens @else 0 Childrens @endif
                                        </span>
                                        <span class="text-gray-800">
                                            ( price breakdown )
                                        </span>
                                    </div>
                                    <div class="flex align-items-center">
                                        <span class="text-[19px] text-gray-500 font-normal">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                                        <a href="{{ route('cart_delete',$arr_cart_room_id[$i]) }}" class="text-[16px] ms-4 font-semibold text-gray-500 hover:text-red-500"><i class="fa-solid fa-trash"></i></a>
                                    </div>

                                </div>

                                <div>
                                    <div class="mt-7">
                                        @foreach ($services as $service)
                                            @if ($service->status == 1)
                                                <div class="flex items-center mb-4">
                                                    <input id="service_{{ $service->id.$arr_cart_room_id[$i] }}" type="checkbox" value="{{ $service->price }}" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600 checkbox-{{ $arr_cart_room_id[$i] }}">
                                                    <label for="service_{{ $service->id }}" class="ml-2 font-normal text-gray-900 text-md dark:text-gray-300">{{ $service->name }} - {{ 'Rp '.number_format($service->price, 0, ',', '.') }} / {{ $service->detail }}</label>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>

                                    {{-- <div class="flex justify-between mt-5">
                                        <div>
                                            <span class="text-lg font-medium">
                                                Additional Services Total
                                            </span>
                                        </div>
                                        <div class="flex align-items-center">
                                            <span id="total-price_{{ $arr_cart_room_id[$i] }}" class="text-[19px] text-gray-500 font-normal">Rp 0</span>
                                        </div>
                                    </div> --}}
                                    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                                    <script>
                                        $(document).ready(function () {
                                            const checkboxes = $('.checkbox-{{ $arr_cart_room_id[$i] }}');
                                            const totalPriceElement = $('#total-price_{{ $arr_cart_room_id[$i] }}');
                                            const nightCount = {{ $diff }};
                                            const guestCount = {{ $adults }};
                                            const totalAdditional = $('#additional-service-total');

                                            checkboxes.change(function () {
                                                let total = 0;

                                                checkboxes.each(function () {
                                                    if ($(this).is(':checked')) {
                                                        total += parseFloat($(this).val());
                                                    }
                                                });

                                                total *= guestCount;

                                                totalPriceElement.text('Rp ' + total.toFixed(0).replace(/\B(?=(\d{3})+(?!\d))/g, ","));

                                                let totalExtraService = 0;

                                                totalPriceElement.each(function () {
                                                        totalExtraService += parseFloat($(this).text());
                                                })

                                                console.log(totalExtraService);

                                                totalAdditional.text('Rp ' + totalExtraService.toFixed(0).replace(/\B(?=(\d{3})+(?!\d))/g, ","));
                                            });


                                        });
                                    </script>
                                </div>
                            </div>

                        @endforeach

                            @php
                            $total_price = number_format($total_price, 0, ',', '.');
                            @endphp
                    @else
                        <div class="items-center px-6 py-5 -mx-8 text-center hover:bg-gray-100 jus">
                            <div class="text-center text-red-600">Rooms Booked is empty !!</div>
                        </div>
                    @endif

                <a href="{{ route('rooms') }}" class="flex mt-10 text-sm font-semibold text-indigo-600">
                <svg class="w-4 mr-2 text-indigo-600 fill-current" viewBox="0 0 448 512"><path d="M134.059 296H436c6.627 0 12-5.373 12-12v-56c0-6.627-5.373-12-12-12H134.059v-46.059c0-21.382-25.851-32.09-40.971-16.971L7.029 239.029c-9.373 9.373-9.373 24.569 0 33.941l86.059 86.059c15.119 15.119 40.971 4.411 40.971-16.971V296z"/></svg>
                    Continue Bookings
                </a>
            </div>

            <div id="summary" class="w-1/4 px-8 py-10">
                <h1 class="pb-8 text-2xl font-semibold border-b">Order Summary</h1>
                <div class="flex justify-between mt-10 mb-5">
                    <span class="text-sm font-semibold">Sub Total</span>
                    <span class="text-sm font-semibold text-gray-700">Rp {{ $total_price ?? 0 }}</span>
                </div>
                {{-- <div class="flex justify-between mt-5 mb-5">
                    <span class="text-sm font-semilight">Additional Services</span>
                    <span id="additional-service-total" class="text-sm font-semibold text-gray-500">Rp </span>
                </div> --}}
                <div class="mt-8 border-t">
                    <div class="flex justify-between py-6 font-semibold text-md">
                        <span>Grand Total</span>
                        <span>Rp {{ $total_price ?? 0 }}</span>
                    </div>
                    <a href="{{ route('checkout') }}">
                        <button class="w-full py-3 text-sm font-semibold text-white uppercase bg-indigo-500 hover:bg-indigo-600">Checkout</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('js-custom')
@endpush
