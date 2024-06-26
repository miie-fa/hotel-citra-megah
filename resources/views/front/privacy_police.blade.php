@extends('front.layout.app')

@section('title', 'Privacy Police')

@push('css-custom')
@endpush

@section('content')
<section class="relative">
    <img src="{{ asset('image/banner-contact.png') }}" alt="banner" class="h-auto max-w-full mx-auto filter brightness-50">
    <div class="absolute inset-0 flex items-center justify-center">
        <span class="px-1 py-1 text-2xl font-medium text-white md:px-5 md:text-5xl md:py-7">{{ $data->title }}</span>
    </div>
</section>

<section class="py-10 px-20">
    {!! $data->content !!}

    <p class="mt-10"><i>Terakhir diperbarui pada tanggal {{ \Carbon\Carbon::parse($data->updated_at)->format('d F Y') }}</i></p>
</section>
@endsection

@push('js-custom')
@endpush
