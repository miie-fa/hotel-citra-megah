@extends('front.layout.app')

@section('title', 'Rooms')

@push('css-custom')
    <style>
        /* Style untuk tombol Jumlah Tamu */
        .guests-button {
            background-color: white;
            border: 1px solid #ccc;
            padding: 8px 10px;
            cursor: pointer;
            font-size: 14.5px;
            transition: background-color 0.3s, border-color 0.3s;
        }

        .guests-button:hover {
            background-color: #f5f5f5;
            border-color: #aaa;
        }

        /* Style untuk dropdown */
        .guests-dropdown-content {
            display: none;
            background-color: white;
            border: 1px solid #ccc;
            padding: 16px;
            position: absolute;
            z-index: 1;
        }

        .guests-dropdown-content .guests-group {
            margin-bottom: 16px;
        }

        /* Style untuk tombol "+" dan "-" */
        .counter-button {
            background-color: #f5f5f5;
            border: none;
            padding: 4px 8px;
            font-size: 14px;
            cursor: pointer;
        }

        .counter-value {
            margin: 0 8px;
        }

        /* Style untuk tombol Apply */

        .apply-button:hover {
            background-color: #0056b3;
        }

        /* 3 */
        .custom-btn-room {
            width: 130px;
            height: 40px;
            color: #fff;
            border-radius: 5px;
            padding: 10px 25px;
            font-family: 'Lato', sans-serif;
            font-weight: 500;
            background: transparent;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            display: inline-block;
            box-shadow:inset 2px 2px 2px 0px rgba(255,255,255,.5),
            7px 7px 20px 0px rgba(0,0,0,.1),
            4px 4px 5px 0px rgba(0,0,0,.1);
            outline: none;
        }

        .btn-3 {
            background: rgb(0,172,238);
            background: linear-gradient(0deg, rgba(0,172,238,1) 0%, rgba(2,126,251,1) 100%);
            width: 130px;
            height: 40px;
            line-height: 42px;
            padding: 0;
            border: none;
        }
        .btn-3 span {
            position: relative;
            display: block;
            width: 100%;
            height: 100%;
        }
        .btn-3:before,
        .btn-3:after {
            position: absolute;
            content: "";
            right: 0;
            top: 0;
            background: rgba(2,126,251,1);
            transition: all 0.3s ease;
        }
        .btn-3:before {
            height: 0%;
            width: 2px;
        }
        .btn-3:after {
            width: 0%;
            height: 2px;
        }
        .btn-3:hover{
            background: transparent;
            box-shadow: none;
        }
        .btn-3:hover:before {
            height: 100%;
        }
        .btn-3:hover:after {
            width: 100%;
        }
        .btn-3 span:hover{
            color: rgba(2,126,251,1);
        }
        .btn-3 span:before,
        .btn-3 span:after {
            position: absolute;
            content: "";
            left: 0;
            bottom: 0;
            background: rgba(2,126,251,1);
            transition: all 0.3s ease;
        }
        .btn-3 span:before {
            width: 2px;
            height: 0%;
        }
        .btn-3 span:after {
            width: 0%;
            height: 2px;
        }
        .btn-3 span:hover:before {
            height: 100%;
        }
        .btn-3 span:hover:after {
            width: 100%;
        }

    </style>
@endpush

@section('content')
    <section class="relative">
        <img src="{{ asset('image/Rectangle-3.jpg') }}" alt="banner" class="h-auto max-w-full mx-auto filter brightness-50">
        <div class="absolute inset-0 flex items-center justify-center">
            <span class="px-1 py-1 text-lg font-medium text-white md:px-5 md:text-5xl md:py-7">Rooms</span>
        </div>
    </section>

    {{--Heading Content--}}
    {{-- <section class="max-w-screen-xl mx-auto mt-14">
        <div class="flex flex-col px-4 lg:px-28">
            <h2 class="mb-2 text-2xl font-bold text-gray-800 md:text-3xl">Ruangan Hotel Citra Megah</h2>
            <p class="text-gray-800">Hotel Citra Megah memiliki beberapa ruangan yang tentunya sangat cocok dengan selera anda, dengan tampilan, <br>
                kualitas dan fasilitas yang sangat terjamin untuk menunjang berbagai kebutuhan sehari hari anda, dan kami siap 24 jam <br>
                melayani anda jika membutuhkan bantuan apapun, ayo segera pesan kamar di bawah ini dan dapatkan diskonnya di <br>
                pemesanan pertama anda !.
            </p>
        </div>
    </section> --}}

    {{--Section Card --}}
    <section class="relative max-w-screen-xl lg:pb-[4em] md:pb-5 mx-auto search-section lg:mt-0 mt-4">
        <div class="container px-4 mx-auto md:absolute lg:bottom-5">
            <div class="flex justify-center">
                <div style="background-color: #1D7C82" class="w-full max-w-5xl p-6 bg-white rounded-md shadow-md">
                    <form action="{{ route('cart_submit') }}" method="POST">
                        @csrf
                        @method('POST')
                        <div class="flex flex-col gap-y-3 sm:gap-y-0 md:flex md:flex-row md:gap-3 md:justify-center md:items-center md:w-full">
                            <div class="md:w-1/4">
                                <select id="room_id" name="room_id" class="bg-gray-50 border @error('room_id') border-red-600 @enderror border-gray-300 text-gray-900 text-sm focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 ">
                                <option selected disabled>Pilih Room</option>
                                @foreach ($rooms as $room)
                                    <option value="{{ $room->id }}">{{ $room->name }}</option>
                                @endforeach
                                </select>
                            </div>
                            <div class="md:w-1/4">
                                <input type="text" id="checkin_checkout" name="checkin_checkout" value="{{  old('checkin_checkout') }}" placeholder="Check In & Check Out" class="bg-gray-50 border @error('checkin_checkout') border-red-600 @enderror border-gray-300 text-gray-900 text-sm focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" autocomplete="off"/>
                            </div>
                            <div class="">
                                <input type="number" min="0" name="adult" value="{{  old('adult') }}" placeholder="Adults" class="bg-gray-50 border border-gray-300 @error('adult') border-red-600 @enderror text-gray-900 text-sm focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"/>
                            </div>
                            <div class="">
                                <input type="number" min="0" name="children" value="{{  old('children') }}" placeholder="Children" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"/>
                            </div>
                            <div class="mt-3 md:w-1/6 md:mt-0">
                                <button type="submit" class="w-full px-4 py-2 text-white transition duration-100 ease-in-out bg-cyan-950 hover:bg-cyan-900 hover:scale-105">Book Now</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    {{--Pilih Kamar--}}
    <section class="max-w-screen-xl mx-auto">
        <div class="grid grid-cols-1 gap-6 px-10 mt-4 mb-14 lg:px-20 lg:grid-cols-12 max-w-screen">
            @if ($rooms->count() == 0)
                <div class="lg:col-span-12 text-center text-2xl font-bold">
                    No Rooms To Display.
                </div>
            @endif
            <!-- Card Kamar -->

                @foreach ($rooms as $room)
                    <div class="h-auto transition-all duration-300 shadow-sm bg-gray-50 hover:shadow-xl lg:col-span-12 hover:-translate-y-3">
                        <div class="flex flex-col border rounded-lg lg:grid md:flex-row lg:grid-cols-12">
                            <div class="col-span-4">
                                    @if(count($room['featured_photo']) > 0)
                                        <a href="{{ route('detail_room', $room->slug) }}"><img height="40" width="700" src="{{ asset('storage/' . $room['featured_photo'][0] ) }}" class="rounded-s-lg"></a>
                                    @endif
                            </div>
                            <div class="flex flex-col justify-center w-full col-span-5 px-5 py-4 lg:py-0">
                                <a href="{{ route('detail_room', $room->slug) }}"><h3 class="text-2xl font-medium duration-300 hover:text-cyan-600">{{ $room->name }}</h3></a>
                                <div class="flex items-center mb-5">
                                    <div class="flex">
                                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M8.7316 0.666687L10.7896 7.00069L17.4496 7.00069L12.0616 10.9153L14.1196 17.2493L8.7316 13.3347L3.34357 17.2493L5.40162 10.9153L0.0135899 7.00069L6.67356 7.00069L8.7316 0.666687Z" fill="#FFB800"/>
                                        </svg>
                                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M8.7316 0.666687L10.7896 7.00069L17.4496 7.00069L12.0616 10.9153L14.1196 17.2493L8.7316 13.3347L3.34357 17.2493L5.40162 10.9153L0.0135899 7.00069L6.67356 7.00069L8.7316 0.666687Z" fill="#FFB800"/>
                                        </svg>
                                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M8.7316 0.666687L10.7896 7.00069L17.4496 7.00069L12.0616 10.9153L14.1196 17.2493L8.7316 13.3347L3.34357 17.2493L5.40162 10.9153L0.0135899 7.00069L6.67356 7.00069L8.7316 0.666687Z" fill="#FFB800"/>
                                        </svg>
                                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M8.7316 0.666687L10.7896 7.00069L17.4496 7.00069L12.0616 10.9153L14.1196 17.2493L8.7316 13.3347L3.34357 17.2493L5.40162 10.9153L0.0135899 7.00069L6.67356 7.00069L8.7316 0.666687Z" fill="#FFB800"/>
                                        </svg>
                                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M8.7316 0.666687L10.7896 7.00069L17.4496 7.00069L12.0616 10.9153L14.1196 17.2493L8.7316 13.3347L3.34357 17.2493L5.40162 10.9153L0.0135899 7.00069L6.67356 7.00069L8.7316 0.666687Z" fill="#FFB800"/>
                                        </svg>
                                    </div>
                                    <div class="ms-1">
                                        <span class="text-sm text-gray-500">(150) |</span>
                                        <span class="mb-2 text-sm text-sub">
                                            @if ($room->total_rooms == 0)
                                                <span class="text-red-500">Habis, tunggu di lain hari</span>
                                            @elseif ($room->total_rooms <= 10)
                                                Tersisa {{ $room->total_rooms }} kamar lagi
                                            @else
                                                Tersedia
                                            @endif
                                        </span>
                                    </div>
                                </div>
                                <div class="text-[14px] text-gray-700 mb-10">
                                    <p>{!! Str::limit($room->description, 100) !!}</p>
                                </div>
                                <div class="grid grid-cols-10">
                                    @php
                                        $arr = $room->amenities;
                                        for($j=0;$j<count($arr);$j++) {
                                            $temp_row = \App\Models\Amenity::where('id',$arr[$j])->first();
                                            echo '
                                                <button class="w-8 h-8 text-gray-600 border border-gray-300 rounded-md" title="'.$temp_row->name.'"><i class="'.$temp_row->icon.'"></i></button>
                                            ';
                                        }
                                    @endphp
                                </div>
                            </div>
                            <div class="flex flex-col items-center justify-center col-span-3 py-5 border-s lg:py-0">
                                <div class="flex flex-col mb-10 text-center">
                                    <p class="text-xl font-medium text-gray-900">{{ 'Rp ' . number_format($room->price, 2) }}</p>
                                    <div class="text-sm font-light uppercase text-sub">Per Malam</div>
                                </div>
                                <div class="">
                                    @if ($room->total_rooms == 0)
                                        <a href="{{ route('detail_room', $room->slug) }}"><button id="select-room-button-{{ $room->slug }}" class="cursor-not-allowed custom-btn-room btn-3" disabled><span>Not Available</span></button></a>
                                    @elseif ($room->total_rooms <= 10)
                                        <a href="{{ route('detail_room', $room->slug) }}"><button id="select-room-button-{{ $room->slug }}" class="custom-btn-room btn-3"><span>See Detail</span></button></a>
                                    @else
                                        <a href="{{ route('detail_room', $room->slug) }}"><button id="select-room-button-{{ $room->slug }}" class="custom-btn-room btn-3"><span>See Detail</span></button></a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            <!-- Ringkasan Pemesanan -->
            {{-- <div class="lg:col-span-4">
                <div class="h-auto bg-gray-100 shadow-md p-7">
                    <h2 class="mb-4 text-2xl font-medium">Ringkasan Pemesanan</h2>
                    <div class="mb-4">
                        <div class="flex">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M9 1V3H15V1H17V3H21C21.5523 3 22 3.44772 22 4V20C22 20.5523 21.5523 21 21 21H3C2.44772 21 2 20.5523 2 20V4C2 3.44772 2.44772 3 3 3H7V1H9ZM20 10H4V19H20V10ZM15.0355 11.136L16.4497 12.5503L11.5 17.5L7.96447 13.9645L9.37868 12.5503L11.5 14.6716L15.0355 11.136ZM7 5H4V8H20V5H17V6H15V5H9V6H7V5Z" fill="#162034"/>
                            </svg>
                            <span class="text-sub text-light ms-1">Check In</span>
                        </div>
                        <input type="text" id="checkin-text" class="block w-full p-2 mt-2 text-gray-900 border border-gray-300 bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" disabled>
                    </div>
                    <div class="mb-4">
                        <div class="flex">
                            <svg width="21" height="20" viewBox="0 0 21 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M7.3999 2V0H5.3999V2H1.3999C0.847622 2 0.399902 2.44772 0.399902 3V19C0.399902 19.5523 0.847622 20 1.3999 20H19.3999C19.9522 20 20.3999 19.5523 20.3999 19V3C20.3999 2.44772 19.9522 2 19.3999 2H15.3999V0H13.3999V2H7.3999ZM2.3999 9H18.3999V18H2.3999V9ZM2.3999 4H5.3999V5H7.3999V4H13.3999V5H15.3999V4H18.3999V7H2.3999V4ZM8.27852 9.9644L10.3999 12.0858L12.5211 9.9644L13.9354 11.3785L11.8141 13.5001L13.9353 15.6212L12.5212 17.0354L10.3999 14.9143L8.27845 17.0354L6.86432 15.6211L8.9856 13.5001L6.86426 11.3785L8.27852 9.9644Z" fill="#162034"/>
                            </svg>
                            <span class="text-sub text-light ms-1">Check Out</span>
                        </div>
                        <input type="text" id="checkout-text" class="block w-full p-2 mt-2 text-gray-900 border border-gray-300 bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" disabled>
                    </div>
                    <div class="mb-4">
                        <div class="flex">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M21 19H23V21H1V19H3V4C3 3.44772 3.44772 3 4 3H14C14.5523 3 15 3.44772 15 4V19H19V11H17V9H20C20.5523 9 21 9.44772 21 10V19ZM5 5V19H13V5H5ZM7 11H11V13H7V11ZM7 7H11V9H7V7Z" fill="#162034"/>
                            </svg>
                            <span class="text-sub text-light ms-1">Hotel</span>
                        </div>
                        <div class="flex">
                            <span class="text-sm text-gray-700" id="hotel-name-summary">Pilih Hotel</span>
                            <span class="text-sm text-gray-700 ms-1" id="room-name-summary">| Pilih Kamar</span>
                            <span class="hidden text-sm text-gray-700 ms-1" id="room-id-summary"></span>
                        </div>
                        <hr class="h-px my-1 bg-gray-800 border-2 rounded-lg ">
                        <div class="flex justify-between">
                            <p class="font-light text-sub"><span id="nights-summary">-</span> malam</p>
                            <span class="font-semibold" id="room-price-summary">Rp 0</span>
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-between">
                            <span>Jumlah Orang :</span>
                            <span id="guests-summary">0 Dewasa, 0 Anak</span>
                        </div>
                        <hr class="my-1 border border-dashed border-cyan-600">
                        <div class="flex justify-between">
                            <span class="text-xl font-medium">Total:</span>
                            <span class="text-xl font-medium" id="total-room-price">Rp 0</span>
                            <span class="hidden text-xl font-medium" id="total-room-price-hidden">0</span>
                        </div>
                    </div>
                </div>
                <button id="kirim_data" class="w-full py-3 mt-5 font-normal text-white bg-cyan-950 hover:bg-cyan-900">Lanjutkan Pemesanan</button>
            </div> --}}
        </div>
    </section>

    {{-- <script>
        var splide = new Splide( '.splide', {
            type   : 'loop',
            drag   : 'free',
            perPage: 3,
        } );

        splide.mount();

        $(function() {
            const guestsButton = $("#guests-button");
            const guestsDropdown = $("#guests-dropdown-content");
            const adultsCountSpan = $("#adults-count");
            const childrenCountSpan = $("#children-count");

            guestsButton.on("click", function() {
                guestsDropdown.toggle();
            });

            $("#adults-increase").on("click", function() {
                const currentCount = parseInt(adultsCountSpan.text());
                adultsCountSpan.text(currentCount + 1);
            });

            $("#adults-decrease").on("click", function() {
                const currentCount = parseInt(adultsCountSpan.text());
                if (currentCount > 0) {
                    adultsCountSpan.text(currentCount - 1);
                }
            });

            $("#children-increase").on("click", function() {
                const currentCount = parseInt(childrenCountSpan.text());
                childrenCountSpan.text(currentCount + 1);
            });

            $("#children-decrease").on("click", function() {
                const currentCount = parseInt(childrenCountSpan.text());
                if (currentCount > 0) {
                    childrenCountSpan.text(currentCount - 1);
                }
            });

            $("#apply-button").on("click", function() {
                const adultsCount = parseInt(adultsCountSpan.text());
                const childrenCount = parseInt(childrenCountSpan.text());

                const guestText = `${adultsCount} Dewasa, ${childrenCount} Anak`;
                $("#guests-button").text("Tamu: " + guestText);
                $("#guests-summary").text(guestText);
                $("#guests-dropdown-content").hide();
            });

            $(document).on("click", function(event) {
                if (!$(event.target).closest(".guests-dropdown").length) {
                    guestsDropdown.hide();
                }
            });

            // CheckIn & CheckOut
            $(document).ready(function() {
                const roomsData = [
                    @foreach($rooms as $item)
                        { id: {{ $item->id }}, name: "{{ $item->name }}", price: {{ $item->price }} },
                    @endforeach
                ];

                let selectedRoom = null;
                let nights = 0;

                roomsData.forEach(function(room) {
                    const selectButton = $("#select-room-button-" + room.id);

                    selectButton.click(function() {
                        const roomId = room.id;
                        const roomName = room.name;
                        const roomPrice = room.price;
                        selectedRoom = room;
                        updateTotalRoomPrice();

                        const roomIdSummary = document.getElementById('room-id-summary');
                        const roomNameSummary = document.getElementById('room-name-summary');
                        const roomPriceSummary = document.getElementById('room-price-summary');

                        if (roomNameSummary.textContent.includes(',')) {
                            roomNameSummary.textContent = roomNameSummary.textContent.replace(/,\s*/, '');
                        }

                        roomIdSummary.textContent = `${roomId}`;
                        roomNameSummary.textContent = `${roomName}`;
                        roomPriceSummary.textContent = `Rp ${roomPrice.toLocaleString('id-ID', { minimumFractionDigits: 2 })}`;
                    });
                });

                function updateTotalRoomPrice() {
                    if (selectedRoom !== null) {
                        const roomPrice = selectedRoom.price;
                        const totalRoomPrice = roomPrice * nights;
                        const totalRoomPriceElement = document.getElementById('total-room-price');
                        const totalRoomPriceElementHidden = document.getElementById('total-room-price-hidden');

                        totalRoomPriceElement.textContent = `${totalRoomPrice.toLocaleString('id-ID', { minimumFractionDigits: 2 })}`;
                        totalRoomPriceElementHidden.textContent = `${totalRoomPrice}`;
                    }
                }

                const checkinInput = $("#checkin-input");
                const checkoutInput = $("#checkout-input");

                $.datepicker.setDefaults($.datepicker.regional['id']);

                checkinInput.datepicker({
                    dateFormat: "D, dd M yy",
                    minDate: 0,
                    onSelect: function(selectedDate) {
                        const checkinDate = checkinInput.datepicker("getDate");
                        const options = { weekday: 'long', day: 'numeric', month: 'long', year: 'numeric' };
                        const checkinText = checkinDate.toLocaleDateString('in-ID', options);

                        document.getElementById('checkin-text').value = checkinText;

                        // Set minDate dan nilai input checkout jika checkinDate dipilih
                        checkoutInput.datepicker("option", "minDate", selectedDate);
                        checkoutInput.val(selectedDate);
                    }
                });

                checkoutInput.datepicker({
                    dateFormat: "D, dd M yy",
                    beforeShowDay: function(date) {
                        const checkinDate = checkinInput.datepicker("getDate");

                        if (!checkinDate) {
                            return [true, ""];
                        }

                        return [date.getTime() > checkinDate.getTime(), ""];
                    },
                    onSelect: function(selectedDate) {
                        const checkoutDate = checkoutInput.datepicker("getDate");
                        const options = { weekday: 'long', day: 'numeric', month: 'long', year: 'numeric' };
                        const checkoutText = checkoutDate.toLocaleDateString('in-ID', options);

                        document.getElementById('checkout-text').value = checkoutText;

                        const oneDay = 24 * 60 * 60 * 1000;
                        const checkinDate = checkinInput.datepicker("getDate");
                        nights = Math.round(Math.abs((checkoutDate - checkinDate) / oneDay));
                        updateTotalRoomPrice();

                        if (nights === 0) {
                            document.getElementById('nights-summary').textContent = "";
                        } else {
                            document.getElementById('nights-summary').textContent = `${nights}`;
                        }
                    }
                });
            });

            $(document).ready(function() {
                $("#hotel").on("change", function() {
                    const selectedHotel = $(this).val();
                    $("#hotel-name-summary").text(selectedHotel);
                });
            });
        });

        $(document).ready(function() {
            $("#kirim_data").on("click", function() {
                const checkinText = $("#checkin-text").val();
                const checkoutText = $("#checkout-text").val();
                const nightCount = $("#nights-summary").text();
                const hotelName = $("#hotel").val();
                const roomId = $("#room-id-summary").text();
                const roomNameSummary = $("#room-name-summary").text();
                const childCount = $("#children-count").text();
                const adultCount = $("#adults-count").text();
                const totalRoomPrice = $("#total-room-price-hidden").text();

                $.ajax({
                    type: "POST",
                    url: "{{ route('proses_pemesanan') }}",
                    data: {
                        checkinText: checkinText,
                        checkoutText: checkoutText,
                        nightCount: nightCount,
                        hotelName: hotelName,
                        roomId: roomId,
                        roomNameSummary: roomNameSummary,
                        childCount: childCount,
                        adultCount: adultCount,
                        totalRoomPrice: totalRoomPrice,
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
    </script> --}}
@endsection
