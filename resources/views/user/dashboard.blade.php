@extends('user.layout.app')

@section('title', 'Dashboard')

@section('content')
    @if (Session::has('success'))
    <div class="alert alert-primary" role="alert">
        {{ Session::get('success') }}
    </div>
    @endif
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="row">
            <div class="mb-4 col-12 col-xl-8 mb-xl-0">
                <h3 class="font-weight-bold">@if(Auth::check())Welcome {{ Auth::user()->name }}!@else Please log in to see your name.@endif</h3>
                <h6 class="mb-0 font-weight-normal">Hi {{ Auth::user()->name }} How's your day ? Want to take a rest ?</h6>
            </div>
            </div>
        </div>
    </div>
    <div class="container mx-auto rounded mw-100" style="background-color: #ffffff;">
        <div class="d-flex flex-column justify-content-around p-6 px-lg-5 w-100">
            <h3 class="mt-5 font-weight-bold">My Profile</h3>
            <div class="d-flex my-5 w-10">
                <img class="rounded-circle mr-3" style="width: 90px; height: 90px; object-fit: cover;" src="{{ Auth::user()->avatar ? asset('uploads/' . Auth::user()->avatar) : asset('/img/faces/avatar.jpg') }}" alt="profile"/>
                <div class="">
                    <p class="text-muted">Name :<span class="mx-1 font-weight-bold" style="color: #3f3f3f;">{{ Auth::user()->name }}</span></p>
                    <p class="text-muted">Phone Number :<span class="mx-1 font-weight-bold" style="color: #3f3f3f;">{{ '+62-' . join('-', str_split(Auth::user()->phone, 4)) }}</span></p>
                    <p class="text-muted">Email :<span class="mx-1 font-weight-bold" style="color: #3f3f3f;">{{ Auth::user()->email }}</span></p>
                </div>
                <div class="mx-5">
                    <p class="text-muted">Country :<span class="mx-1 font-weight-bold" style="color: #3f3f3f;">{{ Auth::user()->country }}</span></p>
                    <p class="text-muted">Address :<span class="mx-1 font-weight-bold" style="color: #3f3f3f;">{{ Auth::user()->address }}</span></p>
                </div>
            </div>

        </div>
        <div class="d-flex flex-column align-items-end">
            @if (auth()->user()->email_verified_at == null)
            <button class="btn btn-primary mb-5 " onclick="window.location.href='{{ route('verification') }}'">Verifikasi Email</button>
            @else
            <form action="{{ route('user.delete', Auth::user()->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger mb-5">Hapus Akun</button>
            </form>
            @endif
        </div>
        
    </div>
@endsection
