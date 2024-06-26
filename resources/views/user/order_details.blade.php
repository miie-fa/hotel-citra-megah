@extends('user.layout.app')

@section('title', 'Order Detail')

@section('content')
    <section class="container mx-auto rounded mw-100 border border-gray-300" style="background-color: #ffffff;">
        <div class="d-flex flex-column justify-content-around p-6 px-lg-5 w-100">
            <div class="d-flex mt-5">
                <a href="{{route('user.dashboard')}}" class="text-decoration-none"><h5 class="text-muted">Dashboard  > &nbsp;</h5></a>
                <a href="{{route('order')}}" class="text-decoration-none"><h5 class="text-muted">My Bookings  > &nbsp;</h5></a>
                <a href="" class="text-decoration-none"><h5 class="text-dark">Booking Details</h5></a>
            </div>
            <div class="grid grid-cols-1 gap-6 mt-4 mb-10 md:grid-cols-5">
                <!-- Ringkasan Pemesanan -->
                <div class="col-span-5 p-6">
                    <form>
                            <div class="d-flex justify-content-between mb-8">
                            <div class="d-flex gap-4">
                                <img class="my-5 w-50" src="{{ asset('storage/'.$room['featured_photo'][0]) }}" alt="">
                            </div>
                            <div>
                                <span>Status : <span class="text-sub text-secondary">{{ $order->status }}</span></span>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between">
                            <div class="w-50">
                            <h3 class="my-3 font-weight-bold">Order Summary</h3>
                            <hr>
                            <p class="my-2 text-lg text-dark">Order Number : 
                            <span class="text-secondary"> #{{ $order->order_no }} </span>
                            </p>
                            <p class="mb-2 text-lg text-dark">Booking Date :<span class="text-secondary"> {{ $order->booking_date }} </span></p>
                            <br>
                            @foreach ($order_detail as $item)
                            <span class="text-secondary">2 Rooms <br> {{ $item->checkin_date }} - {{ $item->checkout_date }} ({{$item->number_of_nights}} Nights)</span></p>
                            @endforeach
                            </div>
                            <div class="w-25 mt-3">
                                <h3 class="mb-3 font-weight-bold">Contact Detail</h3>
                                <hr>
                                <p class="my-2 text-lg text-dark">Name : <span class="text-secondary">{{ Auth::user()->name }}</span></p>
                                <p class="mb-3 text-lg text-dark">Email : <span class="text-secondary">{{ Auth::user()->email }}</span></p>
                                <p class="mb-3 text-lg text-dark">Phone : <span class="text-secondary">0{{ Auth::user()->phone }}</span></p>
                            </div>
                        </div>
                        <div class="">
                            <h3 class="my-3 font-weight-bold">Price Breakdown</h3>
                            <hr>
                            @foreach ($order_detail as $item)
                            <p>Room Name : <span class="text-secondary">{{ $item->room_name }}</span></p>
                            <p class="my-2 h6 text-dark">Guests : 
                                <span class="text-secondary mb-2">({{ $item->adult }} Adults {{ $item->children ?? 0 }} Childrens) 
                                </span>
                            </p>
                            <p class="text-dark"> Travel Date :
                                <span class="text-secondary">{{ $item->checkin_date }} - {{ $item->checkout_date }}</span>
                              </p>
                            <div class="my-2 d-flex justify-content-between">
                                    <p class="mt-3 h6 text-dark">Room Price : </p>
                                    <p class="text-muted">100.000,00 Rp</p>
                                </div>
                                <hr>
                            </div>                                
                            @endforeach
                            <div class="d-flex justify-content-between">
                                <p class="h5 my-5">Total Price : <span class="text-dark"> {{ $order->paid_amount }} </span></p>
                            </div>
                        </form> 
                    </div> 
                </div>
             </div>
          </section> 
        @endsection