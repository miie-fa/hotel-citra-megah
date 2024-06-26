@extends('front.layout.app')

@section('title', 'Home')

@push('css-custom')
    <style>
        swiper-container {
        width: 100%;
        height: 100%;
        }

        swiper-slide {
        text-align: center;
        font-size: 18px;
        background: #fff;
        display: flex;
        justify-content: center;
        align-items: center;
        }

        swiper-slide img {
        display: block;
        width: 100%;
        height: 100%;
        object-fit: cover;
        }

        .autoplay-progress {
        position: absolute;
        right: 16px;
        bottom: 16px;
        z-index: 10;
        width: 48px;
        height: 48px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        color: var(--swiper-theme-color);
        }

        .autoplay-progress svg {
        --progress: 0;
        position: absolute;
        left: 0;
        top: 0px;
        z-index: 10;
        width: 100%;
        height: 100%;
        stroke-width: 4px;
        stroke: var(--swiper-theme-color);
        fill: none;
        stroke-dashoffset: calc(125.6 * (1 - var(--progress)));
        stroke-dasharray: 125.6;
        transform: rotate(-90deg);
        }
    </style>
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
        #parallax-world-of-ugg .section-overlay-mask {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: black;
            opacity: 0.7;
        }

        /* Section - Parallax */
        /**************************/
        #parallax-world-of-ugg .parallax-one {
            padding-top: 50px;
            padding-bottom: 50px;
            overflow: hidden;
            position: relative;
            width: 100%;
            background-image: url({{ asset('storage/' . $home->sec_3_image) }});
            background-attachment: fixed;
            background-size: cover;
            -moz-background-size: cover;
            -webkit-background-size: cover;
            background-repeat: no-repeat;
            background-position: top center;
        }

        /* Media Queries */
        /**************************/
        @media screen and (max-width: 767px) {
            #parallax-world-of-ugg .parallax-one {
                padding-top: 100px;
                padding-bottom: 100px;
            }
        }

        .zoom {
            animation: scale 30s linear infinite;
        }

        @keyframes scale {
            50% {
                -webkit-transform:scale(1.2);
                -moz-transform:scale(1.2);
                -ms-transform:scale(1.2);
                -o-transform:scale(1.2);
                transform:scale(1.1);
            }
        }
        .icon-scroll,
        .icon-scroll:before {
            position: absolute;
            z-index: 50;
            left: 50%
        }
        .icon-scroll {
            width: 30px;
            height: 50px;
            margin-left: -20px;
            bottom: 10px;
            margin-top: -35px;
            border: 2px solid #fff;
            border-radius: 25px
        }
        @media (max-width: 767px) {
            .icon-scroll {
                position: relative
            }
        }
        .icon-scroll:before {
            content: '';
            width: 8px;
            height: 8px;
            background: #fff;
            margin-left: -4px;
            top: 8px;
            border-radius: 4px;
            animation-duration: 1.5s;
            animation-iteration-count: infinite;
            animation-name: scroll
        }
        @keyframes scroll {
            0% {
                opacity: 1
            }
            100% {
                opacity: 0;
                transform: translateY(26px)
            }
        }
    </style>
@endpush

@section('content')
    {{-- Banner --}}
    <section class="img-home">
        <swiper-container class="mySwiper" effect="fade" loop="true" space-between="30" centered-slides="true" autoplay-delay="7000" autoplay-disable-on-interaction="false">
            @foreach ($sliders as $slider)
            <swiper-slide>
                <div class="relative">
                    <img src="{{ asset('storage/' . $slider->image) }}" alt="Gambar" class="zoom object-cover w-full h-auto filter brightness-50">
                    <div class="relative flex flex-col h-full px-6 md:absolute md:w-2/4 md:top-36 md:left-24 md:right-0 md:bottom-0">
                        <h2 class="mt-3 font-bold text-center text-black md:text-white text-1xl md:text-5xl md:mb-4 md:text-left wow fadeInDown">{{ $slider->title }}</h2>
                        <p class="text-sm text-center text-black md:text-white md:text-left md:w-2/4 wow fadeInUp">{!! $slider->subtitle !!}</p>
                    </div>
                </div>
            </swiper-slide>
            @endforeach
        </swiper-container>
        <a href="#rekomendasi"><div class="icon-scroll"></div></a>
    </section>

    {{-- Search Card --}}
    <section class="relative max-w-screen-xl z-40 mx-auto lg:-pt-10">
        <div class="container px-4 mx-auto md:absolute lg:bottom-20 wow fadeInUp">
            <div class="flex justify-center">
                <div style="background-color: #1d7b829f" class="w-full max-w-5xl p-6 bg-white shadow-md rounded-md ">
                    <form action="{{ route('search_room') }}">
                        <div class="grid gap-3 md:grid-cols-4">
                            <div class="">
                                <label for="" class="rounded-lg block mb-1 text-sm font-medium text-gray-300">Check In & Check Out</label>
                                <input type="text" id="checkin_checkout" name="checkin_checkout" value="{{  old('checkin_checkout') }}" placeholder="Check In & Check Out" class="rounded-lg bg-gray-50 border @error('checkin_checkout') border-red-600 @enderror border-gray-300 text-gray-900 text-sm focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" autocomplete="off">
                            </div>
                            <div class="">
                                <label for="" class="block mb-1 text-sm font-medium text-gray-300">Adult</label>
                                <input type="number" min="0" name="search_adults" value="{{  old('search_adults') }}" placeholder="Adults" class="rounded-lg bg-gray-50 border border-gray-300 @error('adult') border-red-600 @enderror text-gray-900 text-sm focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" autocomplete="off"/>
                            </div>
                            <div class="">
                                <label for="" class="block mb-1 text-sm font-medium text-gray-300">Children</label>
                                <input type="number" min="0" name="search_childrens" value="{{  old('search_childrens') }}" placeholder="Children" class="rounded-lg bg-gray-50 border border-gray-300 text-gray-900 text-sm focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" autocomplete="off"/>
                            </div>
                            <div class="self-end align-bottom">
                                <button type="submit" class="rounded-lg w-full px-4 py-2.5 text-white transition duration-100 ease-in-out bg-cyan-950 hover:bg-cyan-900 hover:-translate-y-1">Check Availability</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    {{-- Rekomendasi --}}
    @if($home->sec_1_is_view == '1')
    <section class="max-w-screen-xl px-20 mx-auto mt-14" id="rekomendasi">
        <div class="flex flex-col">
            <h2 class="mb-2 text-2xl font-bold text-gray-800">{{$home->sec_1_title}}</h2>
            <p class="mb-4 text-sm">{{$home->sec_1_subtitle}}</p>
            <div class="grid w-full grid-cols-1 gap-24 md:grid-cols-3 flex-nowrap md:flex-row md:w-full">
                @foreach ($rooms as $item)
                <div class="rounded-lg relative max-w-xs overflow-hidden font-bold text-center text-dark bg-no-repeat bg-cover hover:cursor-pointer hover:text-cyan-700">
                    <div class="rounded-lg relative max-w-xs overflow-hidden font-bold text-center text-white bg-no-repeat bg-cover hover:cursor-pointer hover:text-cyan-700">
                        <img class="max-w-xs transition duration-1000 ease-in-out hover:scale-110 filter brightnes-50" src="{{ asset('storage/' . $item['featured_photo'][0]) }}" alt="">
                    </div>

                    <h5 class="px-4 py-2 hover:cursor-pointer hover:text-cyan-700 text-left">{{$item->name}}</h5>

                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    @if($home->sec_2_is_view == '1')
    {{-- About Us --}}
    <section class="max-w-screen-xl px-20 py-8 mx-auto mt-16 mb-16">
        <div class="flex justify-around">
            <img src="{{asset('storage/' .$home->sec_2_image) }}" alt="Gambar" width="500" class="flex justify-center object-cover mb-4 md:h-auto me-10">
            <div class="text-center md:text-left">
                <a href="" class="font-semibold text-cyan-700 text-1xl">About Us</a>
                <h1 class="mt-4 text-3xl font-semibold text-gray-800">{{$home->sec_2_title}}</h1>
                <p class="mt-2 text-gray-600 md:w-3/4">{{$home->sec_2_subtitle}}</p>

                <button class="text-sm rounded-lg bg-cyan-950 hover:bg-cyan-900 md:mt-7 mt-5 text-white w-2/4  md:w-2/4 py-1.5 ease-in-out duration-100 transition hover:scale-105">{{$home->sec_2_button}}</button>
            </div>
        </div>
    </section>
    @endif

    {{-- Why Us --}}
    @if($home->sec_3_is_view == '1')
    <section id="parallax-world-of-ugg">
        <div class="parallax-one">
            <div class="flex flex-col items-center justify-center max-w-screen-xl mx-auto text-center">
                <a href="" class="font-medium text-white text-1xl">{{$home->sec_3_title_1}}</a>
                <h2 href="" class="mt-0 text-3xl font-semibold text-white">{{$home->sec_3_subtitle}}</h2>
                <div class="flex flex-col justify-center mt-5 mb-16 md:gap-10 md:flex-row md:mt-16">
                    <div class="flex flex-col items-center justify-center p-5 transition duration-1000 ease-in-out md:p-0 md:w-1/4 hover:scale-110 hover:text-gray-950 hover:cursor-pointer">
                        <img src="{{asset('storage/' .$home->sec_3_icon_1) }}" width="50">
                        <h5 class="mt-5 mb-2 text-lg font-medium text-white">{{$home->sec_3_title_1}}</h5>
                        <p class="text-white">{{$home->sec_3_subtitle_1}}</p>
                    </div>
                    <div class="flex flex-col items-center justify-center p-5 transition duration-1000 ease-in-out md:p-0 md:w-1/4 hover:scale-110 hover:text-gray-950 hover:cursor-pointer">
                        <img src="{{asset('storage/' .$home->sec_3_icon_2) }}" width="50">
                        <h5 class="mt-5 mb-2 text-lg font-medium text-white">{{$home->sec_3_title_2}}</h5>
                        <p class="text-white">{{$home->sec_3_subtitle_2}}</p>
                    </div>
                    <div class="flex flex-col items-center justify-center p-5 transition duration-1000 ease-in-out md:p-0 md:w-1/4 hover:scale-110 hover:text-gray-950 hover:cursor-pointer">
                        <img src="{{asset('storage/' .$home->sec_3_icon_3) }}" width="50">
                        <h5 class="mt-5 mb-2 text-lg font-medium text-white">{{$home->sec_3_title_3}}</h5>
                        <p class="text-white">{{$home->sec_3_subtitle_3}}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    {{-- Kamar Terpopuler --}}
    @if($home->sec_4_is_view == '1')
    <section class="max-w-screen-xl px-20 mx-auto">
        <div class="mb-10 mt-28">
            <div class="flex flex-row justify-between mb-8">
                <h1 class="text-3xl font-medium text-gray-800">{{$home->sec_4_title}}</h1>
                <a href="{{ route('rooms') }}"><button type="button" class="text-white bg-cyan-950 hover:bg-cyan-800 focus:ring-4 focus:ring-blue-300 font-medium text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">{{$home->sec_4_button}}</button></a>
            </div>
            <div class="flex flex-row justify-center gap-16">
                @if ($rooms->where('is_published', 1)->count() > 0)
                    @foreach ($rooms as $room)
                        <div class="max-w-sm bg-gray-100 border border-gray-200 shadow w-80 dark:bg-gray-800 dark:border-gray-700">
                            @if(count($room['featured_photo']) > 0)
                                <a href="{{ route('detail_room', $room->slug) }}"><img class="h-52 w-80" src="{{ asset('storage/' . $room['featured_photo'][0]) }}" alt="" /></a>
                            @endif
                            <div class="p-3">
                                <a href="#">
                                    <h5 class="mb-2 text-xl font-medium tracking-tight text-gray-900 dark:text-white">{{ $room->name }}</h5>
                                </a>
                                <p class="mb-3 font-light text-gray-700 dark:text-gray-400">{!! Str::limit($room->description, 20) !!}</p>
                                <div class="flex flex-row mt-2">
                                    <div class="flex">
                                        <img src="{{ asset('icon/people.svg') }}" alt="">
                                        <span class="text-sm ms-1 text-gray-800">{{ $room->adults + $room->childrens }}</span>
                                    </div>
                                    <div class="flex ms-5">
                                        <img src="{{ asset('icon/bath.svg') }}" alt="">
                                        <span class="text-sm ms-1 text-gray-800">{{ $room->total_bathrooms }}</span>
                                    </div>
                                    <div class="flex ms-5">
                                        <img src="{{ asset('icon/bed.svg') }}" alt="">
                                        <span class="text-sm ms-1 text-gray-800">{{ $room->bed_type }} Bed</span>
                                    </div>
                                </div>
                                <div class="flex flex-row justify-between mt-4">
                                    <h4 class="text-xl font-medium text-gray-800">Rp {{ number_format($room->price / 1000, 0) }}K<span class="text-sm font-normal text-sub">/malam</span></h4>
                                    <a href="{{ route('detail_room', $room->slug) }}" class="inline-flex items-center px-5 py-2 text-sm font-medium text-center text-white bg-teal-600 rounded-md hover:bg-teal-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                        Detail
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                <div>
                    <center class="bg-red-400 text-white px-20">Tidak Ada Kamar Populer</center>
                </div>
                @endif
            </div>
        </div>
    </section>
    @endif

    {{-- Hotel Service --}}
    @if($home->sec_5_is_view == '1')
    <section class="">
        <div class="flex flex-col items-center justify-center max-w-screen-xl mx-auto text-center">
            <a href="" class="mt-16 font-medium text-cyan-700 text-1xl">{{$home->sec_5_title}}</a>
            <h2 href="" class="mt-0 text-3xl font-semibold text-gray-800">{{$home->sec_5_subtitle}}</h2>
            <div class="flex flex-col justify-center mt-5 mb-16 md:gap-16 md:flex-row md:mt-10">
                <div class="flex flex-col items-center justify-center p-5 md:p-0 md:w-1/4 rounded-lg">
                    <img class="rounded-lg h-42 w-96" src="{{asset('storage/' .$home->sec_5_image_1) }}" width="50">
                    <h5 class="mt-3 text-lg font-medium text-gray-800">{{$home->sec_5_title_1}}</h5>
                </div>
                <div class="flex flex-col items-center justify-center p-5 md:p-0 md:w-1/4">
                    <img class="rounded-lg h-42 w-96" src="{{asset('storage/' .$home->sec_5_image_2) }}" width="50">
                    <h5 class="mt-3 text-lg font-medium text-gray-800">{{$home->sec_5_title_2}}</h5>
                </div>
                <div class="flex flex-col items-center justify-center p-5 md:p-0 md:w-1/4">
                    <img class="rounded-lg h-42 w-96" src="{{asset('storage/' .$home->sec_5_image_3) }}" width="50">
                    <h5 class="mt-3 text-lg font-medium text-gray-800">{{$home->sec_5_title_3}}</h5>
                </div>
            </div>
        </div>
    </section>
    @endif

    {{-- Featured --}}
    @if($home->sec_6_is_view == '1')
    <section class="hidden pb-16 bg-gray-100 md:block">
        <div class="flex flex-col items-center justify-center max-w-screen-xl mx-auto text-center">
            <a href="" class="mt-16 font-medium text-cyan-700 text-1xl">{{$home->sec_6_title}}</a>
            <h2 href="" class="mt-0 text-3xl font-semibold text-gray-800">{{$home->sec_6_subtitle}}</h2>
            <div class="px-32 mt-14">
                <div class="flex justify-center text-left md:p-0">
                    <div class="w-full">
                        <img class="" src="{{asset('storage/' .$home->sec_6_image_1) }}">
                    </div>
                    <div class="relative w-full right-6 top-7">
                        <div class="absolute flex flex-col justify-center bg-white border shadow-xl ps-10 pe-14 h-72">
                            <h5 class="mb-2 text-2xl font-normal text-gray-800 font-logo">{{$home->sec_6_title_1}}</h5>
                            <p class="w-full text-gray-600">{{$home->sec_6_subtitle_1}}</p>
                        </div>
                    </div>
                </div>
                <div class="flex justify-center mt-5 text-left md:p-0">
                    <div class="w-full">
                        <img class="" src="{{asset('storage/' .$home->sec_6_image_2) }}">
                    </div>
                    <div class="relative w-full right-6 top-7">
                        <div class="absolute flex flex-col justify-center bg-white border shadow-xl ps-10 pe-14 h-72">
                            <h5 class="mb-2 text-2xl font-normal text-gray-800 font-logo">{{$home->sec_6_title_2}}</h5>
                            <p class="w-full text-gray-600">{{$home->sec_6_subtitle_2}}</p>
                        </div>
                    </div>
                </div>
                <div class="flex justify-center mt-5 text-left md:p-0">
                    <div class="w-full">
                        <img class="" src="{{asset('storage/' .$home->sec_6_image_3) }}">
                    </div>
                    <div class="relative w-full right-6 top-7">
                        <div class="absolute flex flex-col justify-center bg-white border shadow-xl ps-10 pe-14 h-72">
                            <h5 class="mb-2 text-2xl font-normal text-gray-800 font-logo">{{$home->sec_6_title_3}}</h5>
                            <p class="w-full text-gray-600">{{$home->sec_6_subtitle_3}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    {{-- Fasilitas --}}
    @if($home->sec_7_is_view == '1')
    <section class="">
        <div class="flex flex-col items-center justify-center max-w-screen-xl mx-auto text-center">
            <a href="" class="mt-16 font-medium text-cyan-700 text-1xl">{{$home->sec_7_title}}</a>
            <h2 href="" class="mt-0 text-3xl font-semibold text-gray-800">{{$home->sec_7_subtitle}}</h2>
            <div class="grid grid-cols-2 gap-3 px-2 mt-5 mb-5 md:mb-16 lg:grid-cols-4 md:grid-cols-3 md:px-20 md:gap-x-16 md:gap-y-9 md:flex-row md:mt-10">
                @foreach ($amenities as $amenity)
                <div class="rounded-lg flex items-center justify-start px-4 py-3 text-white transition bg-teal-600 w-30 md:w-56 hover:scale-110 hover:cursor-pointer hover:">
                    {{-- <img src="{{ asset('icon/bed-white.svg') }}" alt="" class="me-2"> --}}
                    <i class="{{ $amenity->icon }} fa-xl me-2"></i>
                    <span class="text-left">{{ $amenity->name }}</span>
                </div>
                @endforeach
                {{-- <div class="flex items-center justify-start px-4 py-3 text-white transition bg-teal-600 w-30 md:w-56 hover:scale-110 hover:cursor-pointer hover:">
                    <img src="{{ asset('icon/bed-white.svg') }}" alt="" class="me-2">
                    <span class="text-left">145 Kamar</span>
                </div>
                <div class="flex items-center justify-start px-4 py-3 text-white transition bg-teal-600 w-30 md:w-56 hover:scale-110 hover:cursor-pointer hover:">
                    <img src="{{ asset('icon/restaurant-2-line.svg') }}" alt="" class="me-2">
                    <span class="text-left">Restaurant</span>
                </div>
                <div class="flex items-center justify-start px-4 py-3 text-white transition bg-teal-600 w-30 md:w-56 hover:scale-110 hover:cursor-pointer hover:">
                    <img src="{{ asset('icon/swim.svg') }}" alt="" class="me-2">
                    <span class="text-left">Kolam renang</span>
                </div>
                <div class="flex items-center justify-start px-4 py-3 text-white transition bg-teal-600 w-30 md:w-56 hover:scale-110 hover:cursor-pointer hover:">
                    <img src="{{ asset('icon/masjid.svg') }}" alt="" class="me-2">
                    <span class="text-left">Mushola</span>
                </div>
                <div class="flex items-center justify-start px-4 py-3 text-white transition bg-teal-600 w-30 md:w-56 hover:scale-110 hover:cursor-pointer hover:">
                    <img src="{{ asset('icon/router-line.svg') }}" alt="" class="me-2">
                    <span class="text-left">High speed wifi</span>
                </div>
                <div class="flex items-center justify-start px-4 py-3 text-white transition bg-teal-600 w-30 md:w-56 hover:scale-110 hover:cursor-pointer hover:">
                    <img src="{{ asset('icon/time-line.svg') }}" alt="" class="me-2">
                    <span class="text-left">Layanan 24 jam</span>
                </div>
                <div class="flex items-center justify-start px-4 py-3 text-white transition bg-teal-600 w-30 md:w-56 hover:scale-110 hover:cursor-pointer hover:">
                    <img src="{{ asset('icon/bed-white.svg') }}" alt="" class="me-2">
                    <span class="text-left">Laundry</span>
                </div>
                <div class="flex items-center justify-start px-4 py-3 text-white transition bg-teal-600 w-30 md:w-56 hover:scale-110 hover:cursor-pointer hover:">
                    <img src="{{ asset('icon/taxi-line.svg') }}" alt="" class="me-2">
                    <span class="text-left">Antar jemput</span>
                </div> --}}
            </div>
        </div>
    </section>
    @endif

    {{-- Galeri Kami --}}
    @if($home->sec_8_is_view == '1')
    <section class="">
        <div class="flex flex-col items-center justify-center max-w-screen-xl mx-auto text-center">
            <h2 class="mt-10 text-3xl font-semibold text-gray-800">{{$home->sec_8_title}}</h2>
            <div class="max-w-5xl py-12 mx-auto">
                <div class="variable-width">
                    <div class="carousel-slide">
                    <div class="carousel-image">
                        <img src="https://picsum.photos/400" alt="">
                    </div>
                    </div>
                    <div class="carousel-slide">
                    <div class="carousel-image">
                        <img src="https://picsum.photos/200/300" alt="">
                    </div>
                    </div>
                    <div class="carousel-slide">
                    <div class="carousel-image">
                        <img src="https://picsum.photos/300/500" alt="">
                    </div>
                    </div>
                    <div class="carousel-slide">
                    <div class="carousel-image">
                        <img src="https://picsum.photos/200" alt="">
                    </div>
                    </div>
                    <div class="carousel-slide">
                    <div class="carousel-image">
                        <img src="https://picsum.photos/700" alt="">
                    </div>
                    </div>
                    <div class="carousel-slide">
                    <div class="carousel-image">
                        <img src="https://picsum.photos/600" alt="">
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    {{-- CTA --}}
    @if($home->sec_9_is_view == '1')
    <section class="bg-teal-600">
        <div class="flex flex-col items-center justify-center max-w-screen-xl mx-auto text-center px-7 md:px-0">
            <h2 href="" class="mt-10 text-lg font-medium text-white md:w-3/4 md:text-2xl">{{$home->sec_9_title}}</h2>
            <button class="w-full py-2 mb-10 font-normal text-white bg-gray-800 hover:bg-cyan-900 md:mt-10 md:w-1/5">{{$home->sec_9_button}}</button>
        </div>
    </section>
    @endif
@endsection

@push('js-custom')
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-element-bundle.min.js"></script>
    <script>
        const swiperEl = document.querySelector("swiper-container");
        swiperEl.addEventListener("autoplaytimeleft", (e) => {
        const [swiper, time] = e.detail;
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.variable-width').slick({
                dots: true,
                infinite: true,
                speed: 300,
                slidesToShow: 2,
                centerMode: true,
                variableWidth: true,
                prevArrow: '<button type="button" class="slick-prev"><i class="fas fa-chevron-left"></i></button>',
                nextArrow: '<button type="button" class="slick-next"><i class="fas fa-chevron-right"></i></button>',
                autoplay: true,
                autoplaySpeed: 1000
            });
        });
    </script>
@endpush
