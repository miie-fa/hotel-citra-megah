@extends('front.layout.app')

@section('title', 'Faqs')

@push('css-custom')
@endpush

@section('content')

<section class="relative">
    <img src="{{ asset('image/banner-contact.png') }}" alt="banner" class="h-auto max-w-full mx-auto filter brightness-50">
    <div class="absolute inset-0 flex items-center justify-center">
        <span class="px-1 py-1 text-2xl font-medium text-white md:px-5 md:text-5xl md:py-7">FAQs</span>
    </div>
</section>

<section class="max-w-screen-xl px-5 py-8 mx-auto mt-5 lg:px-28">
    @if ($faqs->count() > 0)
        @foreach ($faqs as $item)
            @if ($item->status == '1')
            <div id="accordion-open" data-accordion="open">
                <h2 id="accordion-open-heading-{{ $item->id }}">
                    <button type="button" class="flex items-center justify-between w-full p-5 font-medium text-left text-gray-500 border border-b-0 border-gray-200 rounded-t-xl focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-800 dark:border-gray-700 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800" data-accordion-target="#accordion-open-body-{{ $item->id }}" aria-expanded="true" aria-controls="accordion-open-body-{{ $item->id }}">
                    <span class="flex items-center">
                        <svg class="w-5 h-5 mr-2 shrink-0" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"></path></svg> {{ $item->question }}</span>
                    <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5"/>
                    </svg>
                    </button>
                </h2>
                <div id="accordion-open-body-{{ $item->id }}" class="hidden" aria-labelledby="accordion-open-heading-{{ $item->id }}">
                    <div class="p-5 border border-b-0 border-gray-200 dark:border-gray-700 dark:bg-gray-900">
                        <p class="mb-2 text-gray-500 dark:text-gray-400">{{ $item->answer }}</p>
                    </div>
                </div>
            </div>
            @endif
        @endforeach
    @else
    <p class="text-center">Tidak ada pertanyaan yang tersedia saat ini.</p>

    <section class="max-w-screen-xl px-4 mx-auto mt-10 mb-16 md:px-10 lg:px-28">
        <div class="flex flex-col px-5 pt-5 rounded-md shadow-lg lg:px-16 bg-footer shadow-gray-600">
            <div class="mt-3 lg:pe-56">
                <h2 class="text-2xl font-medium text-gray-100">Form Kontak</h2>
                <p class="text-left text-gray-200">Isilah formulir kontak di bawah ini dengan pertanyaan atau pesan Anda, dan kami akan merespons secepat mungkin.</p>
            </div>
            <hr class="h-px my-2 bg-gray-500 border-0 dark:bg-gray-700">
            <form action="">
                <div class="grid grid-cols-1 mt-6 lg:grid-cols-2 lg:gap-x-10 gap-y-4">
                    <div>
                        <label for="nama-depan" class="block mb-1 font-medium text-gray-200">Nama Depan</label>
                        <input type="text" id="nama-depan" class="w-full p-3 text-sm text-gray-900 bg-gray-100 border border-0 focus:ring-blue-200 focus:border-blue-500" required>
                    </div>
                    <div>
                        <label for="nama-belakang" class="block mb-1 font-medium text-gray-200">Nama Belakang</label>
                        <input type="text" id="nama-belakang" class="w-full p-3 text-sm text-gray-900 bg-gray-100 border border-0 focus:ring-blue-200 focus:border-blue-500" required>
                    </div>
                    <div>
                        <label for="nomer" class="block mb-1 font-medium text-gray-200">Nomor Telepone</label>
                        <input type="number" id="nomer" oninput="this.value = this.value.replace(/[^0-9]/g, '')" min="0" class="w-full p-3 text-sm text-gray-900 bg-gray-100 border border-0 focus:ring-blue-200 focus:border-blue-500" required>
                    </div>
                    <div>
                        <label for="email" class="block mb-1 font-medium text-gray-200">Alamat Email</label>
                        <input type="email" id="email" class="w-full p-3 text-sm text-gray-900 bg-gray-100 border border-0 focus:ring-blue-200 focus:border-blue-500" required>
                    </div>
                </div>
                <div class="mt-5">
                    <label for="message" class="block mb-1 font-medium text-gray-200">Pesan</label>
                    <textarea id="message" rows="4" class="w-full col-span-2 p-3 text-sm text-gray-900 bg-gray-100 border border-0 focus:ring-blue-200 focus:border-blue-500"></textarea>
                </div>
                <div class="flex justify-center">
                    <button class="px-8 py-2 mt-5 text-sm text-white mb-7 bg-sub hover:bg-cyan-600">Kirim Pesan</button>
                </div>
            </form>
        </div>
    </section>
    @endif
</section>



@endsection
