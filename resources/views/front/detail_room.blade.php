@extends('front.layout.app')

@section('title', $detail_room->name)

@push('css-custom')
    <style>
        /* .sidebar {
            height: 93vh;
            overflow: auto;
            position: -webkit-sticky;
            position: sticky;
            top: 12%;
            z-index: 50;
        } */

        .thumbnails {
            display: flex;
            margin: -4rem auto 0;
            padding: 0;
            z-index: 100;
            justify-content: center;
        }

        .thumbnail {
            width: 70px;
            height: 70px;
            z-index: 100;
            overflow: hidden;
            list-style: none;
            margin: 0 0.2rem;
            cursor: pointer;
            opacity: 0.3;
        }

        .thumbnail.is-active {
            opacity: 1;
            z-index: 100;
        }

        .thumbnail img {
            width: 100%;
            height: auto;
        }

        .review-box {
            position: relative;
        }

        .review-authors {
            position: absolute;
            left: 0;
            top: 0;
            width: 70px;
            height: 70px;
            background: #fff;
            border-radius: 5px;
            overflow: hidden;
        }

        .review-content::before {
            content: '';
            height: 0;
            width: 0;
            position: absolute;
            display: block;
            border-width: 10px 12px 10px 0;
            border-style: solid;
            border-color: transparent #e5e7eb;
            top: 15px;
            left: -18px;
        }
    </style>
@endpush

@section('content')
{{-- Banner --}}
<section class="relative">
    <img src="{{ asset('storage/'. $detail_room['featured_photo'][0]) }}" alt="banner" style="width: 100%; max-height: 100vh;" class="max-w-full mx-auto filter brightness-50">
    <div class="absolute inset-0 flex items-center justify-center">
        <span class="px-1 py-1 text-lg font-bold text-white md:px-5 md:text-5xl md:py-7 text-center">{{ $detail_room->name }} Detail</span>
    </div>
</section>



{{-- Content --}}
<section class="max-w-screen-xl px-5 py-8 mx-auto mt-5 lg:px-20">
    <div class="grid grid-cols-12 gap-6 lg:wrapper">
        {{-- Detail Room --}}
        <div class="col-span-12 lg:col-span-8 main md:col-span-7 left">
            <div class="content">

                {{-- Room Content --}}
                <div>
                    <section id="main-carousel" class="splide" aria-label="My Awesome Gallery">
                        <div class="splide__track">
                            <ul class="splide__list">
                                {{-- <li class="splide__slide">
                                    <a href="{{ asset('uploads/'. $detail_room->featured_photo) }}" class="popup-image">
                                        <img class="w-full h-full img-thumbnail" src="{{ asset('uploads/'. $detail_room->featured_photo) }}" alt="Featured Photo">
                                    </a>
                                </li> --}}
                                @foreach ($detail_room['featured_photo'] as $photo)
                                <li class="splide__slide">
                                    <a href="{{ asset('storage/'. $photo) }}" class="popup-image">
                                        <img src="{{ asset('storage/'. $photo) }}" alt="">
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </section>

                    <ul id="thumbnails" class="thumbnails">
                        @foreach ($detail_room['featured_photo'] as $photo)
                        <li class="thumbnail">
                            <img src="{{ asset('storage/'. $photo) }}" alt="">
                        </li>
                        @endforeach
                    </ul>

                    {{-- Room Features --}}
                    <div class="flex justify-around items-center mt-6 mb-14">
                        <div class="flex flex-col justify-center items-center">
                            <div class="w-12 h-14">
                                <svg fill="#878787" width="50px" height="50px" viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M23.313 26.102l-6.296-3.488c2.34-1.841 2.976-5.459 2.976-7.488v-4.223c0-2.796-3.715-5.91-7.447-5.91-3.73 0-7.544 3.114-7.544 5.91v4.223c0 1.845 0.78 5.576 3.144 7.472l-6.458 3.503s-1.688 0.752-1.688 1.689v2.534c0 0.933 0.757 1.689 1.688 1.689h21.625c0.931 0 1.688-0.757 1.688-1.689v-2.534c0-0.994-1.689-1.689-1.689-1.689zM23.001 30.015h-21.001v-1.788c0.143-0.105 0.344-0.226 0.502-0.298 0.047-0.021 0.094-0.044 0.139-0.070l6.459-3.503c0.589-0.32 0.979-0.912 1.039-1.579s-0.219-1.32-0.741-1.739c-1.677-1.345-2.396-4.322-2.396-5.911v-4.223c0-1.437 2.708-3.91 5.544-3.91 2.889 0 5.447 2.44 5.447 3.91v4.223c0 1.566-0.486 4.557-2.212 5.915-0.528 0.416-0.813 1.070-0.757 1.739s0.446 1.267 1.035 1.589l6.296 3.488c0.055 0.030 0.126 0.063 0.184 0.089 0.148 0.063 0.329 0.167 0.462 0.259v1.809zM30.312 21.123l-6.39-3.488c2.34-1.841 3.070-5.459 3.070-7.488v-4.223c0-2.796-3.808-5.941-7.54-5.941-2.425 0-4.904 1.319-6.347 3.007 0.823 0.051 1.73 0.052 2.514 0.302 1.054-0.821 2.386-1.308 3.833-1.308 2.889 0 5.54 2.47 5.54 3.941v4.223c0 1.566-0.58 4.557-2.305 5.915-0.529 0.416-0.813 1.070-0.757 1.739 0.056 0.67 0.445 1.267 1.035 1.589l6.39 3.488c0.055 0.030 0.126 0.063 0.184 0.089 0.148 0.063 0.329 0.167 0.462 0.259v1.779h-4.037c0.61 0.46 0.794 1.118 1.031 2h3.319c0.931 0 1.688-0.757 1.688-1.689v-2.503c-0.001-0.995-1.689-1.691-1.689-1.691z"></path>
                                </svg>
                            </div>
                            <h2 class="text-gray-600 text-sm">{{ $detail_room->adults + $detail_room->childrens }} Guests</h2>
                        </div>
                        <div class="flex flex-col justify-center items-center">
                            <div class="w-11 h-14">
                                <svg width="50px" height="50px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M22 22L2 22" stroke="#878787" stroke-width="1.5" stroke-linecap="round"/>
                                    <path d="M2 11L6.06296 7.74968M22 11L13.8741 4.49931C12.7784 3.62279 11.2216 3.62279 10.1259 4.49931L9.34398 5.12486" stroke="#878787" stroke-width="1.5" stroke-linecap="round"/>
                                    <path d="M15.5 5.5V3.5C15.5 3.22386 15.7239 3 16 3H18.5C18.7761 3 19 3.22386 19 3.5V8.5" stroke="#878787" stroke-width="1.5" stroke-linecap="round"/>
                                    <path d="M4 22V9.5" stroke="#878787" stroke-width="1.5" stroke-linecap="round"/>
                                    <path d="M20 9.5V13.5M20 22V17.5" stroke="#878787" stroke-width="1.5" stroke-linecap="round"/>
                                    <path d="M15 22V17C15 15.5858 15 14.8787 14.5607 14.4393C14.1213 14 13.4142 14 12 14C10.5858 14 9.87868 14 9.43934 14.4393M9 22V17" stroke="#878787" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M14 9.5C14 10.6046 13.1046 11.5 12 11.5C10.8954 11.5 10 10.6046 10 9.5C10 8.39543 10.8954 7.5 12 7.5C13.1046 7.5 14 8.39543 14 9.5Z" stroke="#878787" stroke-width="1.5"/>
                                    </svg>
                            </div>
                            <h2 class="text-gray-600 text-sm">{{ $detail_room->size }} cm²</h2>
                        </div>
                        <div class="flex flex-col justify-center items-center">
                            <div class="w-11 h-14">
                                <svg width="50px" height="50px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M19 20V18.5M5 20V18.5" stroke="#878787" stroke-width="1.5" stroke-linecap="round"/>
                                    <path d="M2 15C2 14.0681 2 13.6022 2.15224 13.2346C2.35523 12.7446 2.74458 12.3552 3.23463 12.1522C3.60218 12 4.06812 12 5 12H19C19.9319 12 20.3978 12 20.7654 12.1522C21.2554 12.3552 21.6448 12.7446 21.8478 13.2346C22 13.6022 22 14.0681 22 15C22 15.9319 22 16.3978 21.8478 16.7654C21.6448 17.2554 21.2554 17.6448 20.7654 17.8478C20.3978 18 19.9319 18 19 18H5C4.06812 18 3.60218 18 3.23463 17.8478C2.74458 17.6448 2.35523 17.2554 2.15224 16.7654C2 16.3978 2 15.9319 2 15Z" stroke="#878787" stroke-width="1.5"/>
                                    <path d="M21 12C21 8.22876 21 6.34315 19.8284 5.17157C18.6569 4 16.7712 4 13 4H11C7.22876 4 5.34315 4 4.17157 5.17157C3 6.34315 3 8.22876 3 12" stroke="#878787" stroke-width="1.5"/>
                                    <path d="M18.5 12V10.5C18.5 8.61438 18.5 7.67157 17.9142 7.08579C17.3284 6.5 16.3856 6.5 14.5 6.5H9.5C7.61438 6.5 6.67157 6.5 6.08579 7.08579C5.5 7.67157 5.5 8.61438 5.5 10.5V12" stroke="#878787" stroke-width="1.5"/>
                                    <path d="M12 7V12" stroke="#878787" stroke-width="1.5"/>
                                </svg>
                            </div>
                            <h2 class="text-gray-600 text-sm">{{ $detail_room->bed_type }} Bed</h2>
                        </div>
                        <div class="flex flex-col justify-center items-center">
                            <div class="w-14 h-14">
                                <svg width="50px" height="50px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 20.5C12.6493 20.5 13.364 20.4831 14.0982 20.4555C14.3558 20.4458 14.4845 20.441 14.7053 20.4186C17.983 20.0867 20.7773 17.1854 20.9859 13.8977C21 13.6762 21 13.4784 21 13.0827C21 13.0059 21 12.9675 20.9979 12.9351C20.9653 12.4339 20.5661 12.0347 20.0649 12.0021C20.0325 12 19.9941 12 19.9173 12M4.08268 12C4.00591 12 3.96752 12 3.93511 12.0021C3.43395 12.0347 3.0347 12.4339 3.00211 12.9351C3 12.9675 3 13.0059 3 13.0827C3 13.4784 3 13.6762 3.01406 13.8977C3.19458 16.742 5.31032 19.2971 8 20.1495" stroke="#878787" stroke-width="1.5" stroke-linecap="round"/>
                                    <path d="M6 20L5 22" stroke="#878787" stroke-width="1.5" stroke-linecap="round"/>
                                    <path d="M18 20L19 22" stroke="#878787" stroke-width="1.5" stroke-linecap="round"/>
                                    <path d="M2 12H14M22 12H18" stroke="#878787" stroke-width="1.5" stroke-linecap="round"/>
                                    <path d="M2.25 13C2.25 13.4142 2.58579 13.75 3 13.75C3.41421 13.75 3.75 13.4142 3.75 13H2.25ZM7.59973 3.49934L8.29609 3.22079L8.29609 3.22079L7.59973 3.49934ZM7.97885 4.44713L8.30713 5.12147L7.97885 4.44713ZM6.36212 6.19232L7.05701 6.47451L6.36212 6.19232ZM10.577 4.37783L10.2824 5.06753L10.577 4.37783ZM6.34559 8.74156L5.6478 9.01651C5.72221 9.20535 5.86997 9.35596 6.05735 9.43396C6.24473 9.51197 6.45572 9.51069 6.64215 9.43044L6.34559 8.74156ZM12.3063 6.17548L12.6029 6.86436C12.975 6.70417 13.1526 6.27744 13.0041 5.90053L12.3063 6.17548ZM3.75 13V4.38516H2.25V13H3.75ZM5.38516 2.75C6.05379 2.75 6.65506 3.15708 6.90338 3.77788L8.29609 3.22079C7.81998 2.0305 6.66715 1.25 5.38516 1.25V2.75ZM3.75 4.38516C3.75 3.48209 4.48209 2.75 5.38516 2.75V1.25C3.65366 1.25 2.25 2.65366 2.25 4.38516H3.75ZM6.90338 3.77788L7.2825 4.72568L8.67521 4.16859L8.29609 3.22079L6.90338 3.77788ZM7.04337 8.46661C6.80167 7.85321 6.78638 7.14092 7.05701 6.47451L5.66723 5.91014C5.24692 6.94515 5.26959 8.05665 5.6478 9.01651L7.04337 8.46661ZM12.0098 5.4866L6.04903 8.05268L6.64215 9.43044L12.6029 6.86436L12.0098 5.4866ZM10.2824 5.06753C10.9039 5.33307 11.367 5.83741 11.6086 6.45043L13.0041 5.90053C12.6258 4.94029 11.887 4.12189 10.8717 3.68813L10.2824 5.06753ZM7.05701 6.47451C7.31118 5.8486 7.76827 5.3838 8.30713 5.12147L7.65058 3.77279C6.78337 4.19496 6.06253 4.93671 5.66723 5.91014L7.05701 6.47451ZM8.30713 5.12147C8.91452 4.82579 9.62506 4.78672 10.2824 5.06753L10.8717 3.68813C9.79386 3.22768 8.62874 3.29661 7.65058 3.77279L8.30713 5.12147Z" fill="#878787"/>
                                </svg>
                            </div>
                            <h2 class="text-gray-600 text-sm">{{ $detail_room->total_bathrooms }} Bath</h2>
                        </div>
                    </div>

                    <div class="text-gray-600">
                        <p class="mt-3">{!! $detail_room->description !!}</p>
                    </div>
                </div>

                {{-- Room Amenity --}}
                <div class="mt-7">
                    <h2 class="mb-3 text-2xl font-medium text-gray-800">Fasilitas</h2>
                    <div class="grid grid-cols-2 lg:grid-cols-3 gap-x-6 gap-y-3">
                        @php
                        $arr = $detail_room->amenities;
                        for($j=0;$j<count($arr);$j++) {
                            $temp_row = \App\Models\Amenity::where('id',$arr[$j])->first();
                            echo '<div class="px-4 py-3 text-sm font-semibold text-gray-700">';
                            echo '<button class="w-8 h-8 border border-gray-300 rounded-md"><i class="'.$temp_row->icon.'"></i></button> '.$temp_row->name;
                            echo '</div>';
                        }
                        @endphp
                    </div>
                </div>

                {{-- Room Features --}}
                {{-- <div class="mt-7">
                    <h2 class="mb-3 text-2xl font-medium text-gray-800">Features</h2>
                    <div class="table-responsive">
                        <table class="w-full text-left text-gray-700 table-fixed">
                            <tbody>
                                <tr class="border-b-2">
                                    <th class="w-1/2 px-4 py-2">Size of Room</th>
                                    <td class="w-1/2 px-4 py-2">{{ $detail_room->size }} m²</td>
                                </tr>
                                <tr class="border-b-2">
                                    <th class="w-1/2 px-4 py-2">Bed Type</th>
                                    <td class="w-1/2 px-4 py-2">{{ $detail_room->bed_type }}</td>
                                </tr>
                                <tr class="border-b-2">
                                    <th class="w-1/2 px-4 py-2">Number of Bathrooms</th>
                                    <td class="w-1/2 px-4 py-2">{{ $detail_room->total_bathrooms }}</td>
                                </tr>
                                <tr class="border-b-2 ">
                                    <th class="w-1/2 px-4 py-2">Number of Guests</th>
                                    <td class="w-1/2 px-4 py-2">{{ $detail_room->total_guests }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div> --}}

                {{-- Room Videos --}}
                @if($detail_room->video_id != '')
                <div class="mt-7">
                    <h2 class="mb-3 text-2xl font-medium text-gray-800">Video</h2>
                    <div class="relative pb-96">
                        <iframe class="absolute top-0 left-0 h-[100%] w-[100%]" width="420" height="315" src="https://www.youtube.com/embed/{{ $detail_room->video_id }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                </div>
                @endif

                {{-- @foreach ($rooms_comment as $room)
                    <div class="room">
                        <h2>{{ $room->name }}</h2>

                        @if ($room->orders->where('status', 'success')->count() > 0)
                            <div class="comments">
                                <h3>Comments:</h3>

                                @foreach ($room->comments as $comment)
                                    <div class="comment">
                                        <h4>{{ $comment->user->name }}</h4>
                                        <p>{{ $comment->content }}</p>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                @endforeach --}}



                {{-- Room Reviews --}}
                <div class="mb-5 mt-7">
                    <h2 class="mb-3 text-2xl font-medium text-gray-800">Reviews</h2>
                    @foreach ($comments as $comment)
                    <div class="mt-6 review-box">
                        <figure class="review-authors">
                            <img class="h-auto rounded-lg" src="{{ asset('storage/' . $comment->user->avatar) ?? '' }}" alt="avatar">
                        </figure>
                        <div class="relative px-5 py-3 ml-24 border border-gray-200 border-s-8">
                            <div class="review-content">
                                <div class="flex items-center mb-4 space-x-4">
                                    <div class="space-y-1 font-medium dark:text-white">
                                        <div class="flex items-center mb-1">
                                            <svg class="w-4 h-4 mr-1 text-yellow-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                                <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                                            </svg>
                                            <svg class="w-4 h-4 mr-1 text-yellow-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                                <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                                            </svg>
                                            <svg class="w-4 h-4 mr-1 text-yellow-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                                <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                                            </svg>
                                            <svg class="w-4 h-4 mr-1 text-yellow-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                                <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                                            </svg>
                                            <svg class="w-4 h-4 mr-1 text-gray-300 dark:text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                                <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                                            </svg>
                                        </div>
                                        <p class="font-normal text-gray-600">{{ $comment->user->name }} - {{ $comment->user->country ?? '0' }}</p>
                                    </div>
                                </div>
                                <p class="mb-3 text-gray-500 dark:text-gray-400">{{ $comment->content }}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Reserve Form --}}
        <div class=" rounded-full col-span-12 lg:col-span-4 sidebar md:col-span-5 right">
            <div style="background-color: #1d7b82ec" class=" rounded-lg w-full max-w-5xl p-6 mb-4 bg-white shadow-md">
                <h2 class="text-2xl font-medium text-white">Room Price per Night</h2>
                <hr class="h-px bg-gray-200 border-0 dark:bg-gray-700">
                <h2 class="mt-4 text-xl font-semibold text-white">{{ 'Rp ' . number_format($detail_room->price, 2) }}</h2>
            </div>
            <div style="background-color: #1d7b82ec" class="w-full max-w-5xl p-6 bg-white rounded-lg shadow-md">
                <form action="{{ route('cart_submit') }}" method="POST">
                    @csrf
                    @method('POST')
                    <h2 class="text-2xl font-medium text-white">Reserve This Room</h2>
                    <hr class="h-px bg-gray-200 border-0 dark:bg-gray-700">
                    <div class="grid mt-4 gap-y-5">
                        <input type="text" name="room_id" value="{{ $detail_room->id }}" class="hidden">
                        <div class="text-sm text-white">
                            <label for="checkin_checkout">Check in & Check out</label>
                            <input type="text" id="checkin_checkout" value="{{ old('checkin_checkout') }}" name="checkin_checkout" value="" placeholder="Check In & Check Out" class="bg-gray-50 mb-2 border border-gray-300 text-gray-900 text-sm @error('checkin_checkout') border-red-600 @enderror focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 mt-2 rounded-md" autocomplete="off"/>
                            @error('checkin_checkout')
                                <p id="outlined_error_help" class="text-xs text-red-600 dark:text-red-400"><span class="font-medium">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="text-sm text-white">
                            <label for="adult">Adult</label>
                            {{-- <input type="number" min="0" max="2" id="adult" name="adult" value="" placeholder="Adults" class="bg-gray-50 mb-2 border border-gray-300 text-gray-900 text-sm @error('adult') border-red-600 @enderror focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"/> --}}
                            <select name="adult" id="adult" class="rounded-lg bg-gray-50 mb-2 border border-gray-300 text-gray-900 text-sm @error('adult') border-red-600 @enderror focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option  value="" {{ old('adult') == '' ? 'selected' : '' }}>0</option>
                                @for ($i = 1; $i <= $detail_room->adults; $i++ )
                                    <option value="{{ $i }}" {{ old('adult') == $i ? 'selected' : '' }}>{{ $i }}</option>
                                @endfor
                            </select>
                            @error('adult')
                                <p id="outlined_error_help" class="text-xs text-red-600 dark:text-red-400"><span class="font-medium">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="text-sm text-white">
                            <label for="children">Children</label>
                            {{-- <input type="number" min="0" id="children" name="children" value="" placeholder="Children" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"/> --}}
                            <select name="children" id="children" class="rounded-lg bg-gray-50 mb-2 border border-gray-300 text-gray-900 text-sm @error('children') border-red-600 @enderror focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option value="" {{ old('children') == '' ? 'selected' : '' }}>0</option>
                                @for ($i = 1; $i <= $detail_room->childrens; $i++ )
                                    <option value="{{ $i }}" {{ old('children') == $i ? 'selected' : '' }}>{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="">
                            <button type="submit" class="rounded-lg w-full px-4 py-2 text-white transition duration-100 ease-in-out bg-cyan-950 hover:bg-cyan-900 hover:scale-105">Book Now</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection

@push('js-custom')
    <script>
        var splide = new Splide( '#main-carousel', {
        pagination: false,
        rewind : true,
        } );


        var thumbnails = document.getElementsByClassName( 'thumbnail' );
        var current;


        for ( var i = 0; i < thumbnails.length; i++ ) {
        initThumbnail( thumbnails[ i ], i );
        }


        function initThumbnail( thumbnail, index ) {
        thumbnail.addEventListener( 'click', function () {
            splide.go( index );
        } );
        }


        splide.on( 'mounted move', function () {
        var thumbnail = thumbnails[ splide.index ];


        if ( thumbnail ) {
            if ( current ) {
            current.classList.remove( 'is-active' );
            }


            thumbnail.classList.add( 'is-active' );
            current = thumbnail;
        }
        } );


        splide.mount();
    </script>
@endpush
