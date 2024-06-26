@extends('front.layout.app')

@section('title', 'Contact Us')

@section('content')
    {{-- Banner --}}
    <section class="relative">
        <img src="{{ asset('image/banner-contact.png') }}" alt="banner" class="h-auto max-w-full mx-auto filter brightness-50">
        <div class="absolute inset-0 flex items-center justify-center">
            <span class="px-1 py-1 text-2xl font-medium text-white md:px-5 md:text-5xl md:py-7">Contact Us</span>
        </div>
    </section>


    {{-- FAQ --}}
    <section class="mb-20">
        <div class="flex flex-col max-w-screen-xl mx-auto px-7 lg:items-center mt-7">
            <p class="px-0 text-gray-600 lg:text-center lg:w-3/5 mb-14">Apakah Anda memiliki pertanyaan, permintaan khusus, atau ingin mendapatkan informasi lebih lanjut tentang Hotel Vista Indah? Kami dengan senang hati siap membantu Anda. Silakan hubungi kami melalui salah satu opsi di bawah ini:</p>
            <h2 href="" class="text-2xl font-semibold text-gray-800 lg:text-3xl">INFO KONTAK</h2>
            <p class="mt-2 text-gray-600">Hubungi kami melalui email atau telepon, berikut adalah info kontak kami:</p>
            <div class="grid gap-12 mt-10 md:grid-cols-2 lg:grid-cols-3">
                <div class="flex items-center">
                    <svg width="54" height="54" viewBox="0 0 54 54" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M42.749 8.9996H11.249C9.45881 8.9996 7.74192 9.71076 6.47605 10.9766C5.21018 12.2425 4.49902 13.9594 4.49902 15.7496V38.2496C4.49902 40.0398 5.21018 41.7567 6.47605 43.0226C7.74192 44.2884 9.45881 44.9996 11.249 44.9996H42.749C44.5392 44.9996 46.2561 44.2884 47.522 43.0226C48.7879 41.7567 49.499 40.0398 49.499 38.2496V15.7496C49.499 13.9594 48.7879 12.2425 47.522 10.9766C46.2561 9.71076 44.5392 8.9996 42.749 8.9996ZM41.8265 13.4996L28.5965 26.7296C28.3874 26.9405 28.1385 27.1079 27.8643 27.2221C27.5901 27.3363 27.2961 27.3951 26.999 27.3951C26.702 27.3951 26.4079 27.3363 26.1337 27.2221C25.8595 27.1079 25.6107 26.9405 25.4015 26.7296L12.1715 13.4996H41.8265ZM44.999 38.2496C44.999 38.8463 44.762 39.4186 44.34 39.8406C43.9181 40.2626 43.3458 40.4996 42.749 40.4996H11.249C10.6523 40.4996 10.08 40.2626 9.65803 39.8406C9.23608 39.4186 8.99902 38.8463 8.99902 38.2496V16.6721L22.229 29.9021C23.4947 31.1662 25.2103 31.8762 26.999 31.8762C28.7878 31.8762 30.5034 31.1662 31.769 29.9021L44.999 16.6721V38.2496Z" fill="#1D7C82"/>
                    </svg>
                    <div class="ml-3">
                        <span class="text-sm font-light text-sub">Email</span>
                        <h5 class="text-lg font-medium text-gray-800">{{ $settings->email }}</h5>
                    </div>
                </div>
                <div class="flex items-center">
                    <svg width="56" height="54" viewBox="0 0 56 54" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M45.3607 29.2502C44.8474 29.2502 44.3107 29.0927 43.7974 28.9802C42.7579 28.7593 41.7363 28.466 40.7407 28.1027C39.6583 27.7229 38.4684 27.7426 37.4001 28.158C36.3318 28.5734 35.4606 29.3551 34.9541 30.3527L34.4407 31.3652C32.1681 30.1461 30.0797 28.6319 28.2341 26.8652C26.4019 25.0854 24.8316 23.0717 23.5674 20.8802L24.5474 20.2502C25.5819 19.7617 26.3925 18.9216 26.8233 17.8915C27.2541 16.8613 27.2745 15.714 26.8807 14.6702C26.5102 13.7081 26.2062 12.7235 25.9707 11.7227C25.8541 11.2277 25.7607 10.7102 25.6907 10.1927C25.4074 8.60781 24.5465 7.17258 23.2632 6.14545C21.9798 5.11832 20.3583 4.56678 18.6907 4.59016H11.6907C10.6851 4.58106 9.68931 4.78099 8.77105 5.17635C7.85279 5.57172 7.03365 6.15323 6.36939 6.8813C5.70514 7.60936 5.21137 8.4669 4.9217 9.39552C4.63202 10.3241 4.55324 11.302 4.69072 12.2627C5.93378 21.6888 10.3981 30.4469 17.3786 37.1536C24.359 43.8603 33.4577 48.1333 43.2374 49.2977H44.1241C45.8447 49.3001 47.506 48.6913 48.7907 47.5877C49.5289 46.951 50.1186 46.1706 50.5208 45.2979C50.923 44.4252 51.1287 43.4801 51.1241 42.5252V35.7752C51.0955 34.2123 50.5053 32.7074 49.4542 31.5174C48.4031 30.3274 46.9563 29.5261 45.3607 29.2502ZM46.5274 42.7502C46.527 43.0696 46.456 43.3853 46.3192 43.6763C46.1824 43.9673 45.983 44.2268 45.7341 44.4377C45.4733 44.6547 45.1685 44.8169 44.839 44.9137C44.5095 45.0106 44.1627 45.04 43.8207 45.0002C35.0822 43.9197 26.9653 40.0648 20.7504 34.0433C14.5355 28.0219 10.5763 20.1767 9.49739 11.7452C9.46026 11.4156 9.4928 11.0822 9.59306 10.765C9.69332 10.4479 9.85922 10.1537 10.0807 9.90016C10.2994 9.66016 10.5685 9.4678 10.8703 9.3359C11.172 9.204 11.4994 9.13557 11.8307 9.13516H18.8307C19.3733 9.12352 19.9032 9.29464 20.3291 9.61907C20.7549 9.9435 21.0502 10.4009 21.1641 10.9127C21.2574 11.5277 21.3741 12.1352 21.5141 12.7352C21.7836 13.9212 22.1423 15.0868 22.5874 16.2227L19.3207 17.6852C19.0414 17.8087 18.7902 17.9843 18.5814 18.2018C18.3727 18.4192 18.2105 18.6743 18.1043 18.9523C17.9981 19.2304 17.9498 19.526 17.9624 19.822C17.9749 20.1181 18.048 20.4089 18.1774 20.6777C21.5355 27.6139 27.3176 33.1895 34.5107 36.4277C35.0788 36.6527 35.716 36.6527 36.2841 36.4277C36.5751 36.3273 36.8425 36.1722 37.0708 35.9713C37.2991 35.7705 37.4838 35.5279 37.6141 35.2577L39.0607 32.1077C40.267 32.5236 41.4981 32.8693 42.7474 33.1427C43.3696 33.2777 43.9996 33.3902 44.6374 33.4802C45.1681 33.5899 45.6424 33.8747 45.9789 34.2853C46.3153 34.696 46.4928 35.2069 46.4807 35.7302L46.5274 42.7502Z" fill="#1D7C82"/>
                    </svg>
                    <div class="ml-3">
                        <span class="text-sm font-light text-sub">No Telepon</span>
                        <h5 class="text-lg font-medium text-gray-800">{{ $settings->phone }}</h5>
                    </div>
                </div>
                <div class="flex items-center">
                    <svg width="56" height="54" viewBox="0 0 56 54" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M45.3607 29.2502C44.8474 29.2502 44.3107 29.0927 43.7974 28.9802C42.7579 28.7593 41.7363 28.466 40.7407 28.1027C39.6583 27.7229 38.4684 27.7426 37.4001 28.158C36.3318 28.5734 35.4606 29.3551 34.9541 30.3527L34.4407 31.3652C32.1681 30.1461 30.0797 28.6319 28.2341 26.8652C26.4019 25.0854 24.8316 23.0717 23.5674 20.8802L24.5474 20.2502C25.5819 19.7617 26.3925 18.9216 26.8233 17.8915C27.2541 16.8613 27.2745 15.714 26.8807 14.6702C26.5102 13.7081 26.2062 12.7235 25.9707 11.7227C25.8541 11.2277 25.7607 10.7102 25.6907 10.1927C25.4074 8.60781 24.5465 7.17258 23.2632 6.14545C21.9798 5.11832 20.3583 4.56678 18.6907 4.59016H11.6907C10.6851 4.58106 9.68931 4.78099 8.77105 5.17635C7.85279 5.57172 7.03365 6.15323 6.36939 6.8813C5.70514 7.60936 5.21137 8.4669 4.9217 9.39552C4.63202 10.3241 4.55324 11.302 4.69072 12.2627C5.93378 21.6888 10.3981 30.4469 17.3786 37.1536C24.359 43.8603 33.4577 48.1333 43.2374 49.2977H44.1241C45.8447 49.3001 47.506 48.6913 48.7907 47.5877C49.5289 46.951 50.1186 46.1706 50.5208 45.2979C50.923 44.4252 51.1287 43.4801 51.1241 42.5252V35.7752C51.0955 34.2123 50.5053 32.7074 49.4542 31.5174C48.4031 30.3274 46.9563 29.5261 45.3607 29.2502ZM46.5274 42.7502C46.527 43.0696 46.456 43.3853 46.3192 43.6763C46.1824 43.9673 45.983 44.2268 45.7341 44.4377C45.4733 44.6547 45.1685 44.8169 44.839 44.9137C44.5095 45.0106 44.1627 45.04 43.8207 45.0002C35.0822 43.9197 26.9653 40.0648 20.7504 34.0433C14.5355 28.0219 10.5763 20.1767 9.49739 11.7452C9.46026 11.4156 9.4928 11.0822 9.59306 10.765C9.69332 10.4479 9.85922 10.1537 10.0807 9.90016C10.2994 9.66016 10.5685 9.4678 10.8703 9.3359C11.172 9.204 11.4994 9.13557 11.8307 9.13516H18.8307C19.3733 9.12352 19.9032 9.29464 20.3291 9.61907C20.7549 9.9435 21.0502 10.4009 21.1641 10.9127C21.2574 11.5277 21.3741 12.1352 21.5141 12.7352C21.7836 13.9212 22.1423 15.0868 22.5874 16.2227L19.3207 17.6852C19.0414 17.8087 18.7902 17.9843 18.5814 18.2018C18.3727 18.4192 18.2105 18.6743 18.1043 18.9523C17.9981 19.2304 17.9498 19.526 17.9624 19.822C17.9749 20.1181 18.048 20.4089 18.1774 20.6777C21.5355 27.6139 27.3176 33.1895 34.5107 36.4277C35.0788 36.6527 35.716 36.6527 36.2841 36.4277C36.5751 36.3273 36.8425 36.1722 37.0708 35.9713C37.2991 35.7705 37.4838 35.5279 37.6141 35.2577L39.0607 32.1077C40.267 32.5236 41.4981 32.8693 42.7474 33.1427C43.3696 33.2777 43.9996 33.3902 44.6374 33.4802C45.1681 33.5899 45.6424 33.8747 45.9789 34.2853C46.3153 34.696 46.4928 35.2069 46.4807 35.7302L46.5274 42.7502Z" fill="#1D7C82"/>
                    </svg>
                    <div class="ml-3">
                        <span class="text-sm font-light text-sub">FAX</span>
                        <h5 class="text-lg font-medium text-gray-800">0{{ $settings->fax }}</h5>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Formulir Pesan --}}
    <section class="max-w-screen-xl px-4 mx-auto mt-10 mb-16 md:px-10 lg:px-28">
        <div class="flex flex-col px-5 pt-5 rounded-md shadow-lg lg:px-16 bg-footer shadow-gray-600">
            <div class="mt-3 lg:pe-56">
                <h2 class="text-2xl font-medium text-gray-100">Form Kontak</h2>
                <p class="text-left text-gray-200">Isilah formulir kontak di bawah ini dengan pertanyaan atau pesan Anda, dan kami akan merespons secepat mungkin.</p>
            </div>
            <hr class="h-px my-2 bg-gray-500 border-0 dark:bg-gray-700">
            @if (Session::has('success'))
            <div class="flex items-center p-4 text-sm text-green-800 border border-green-300 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 dark:border-green-800" role="alert">
                <svg class="flex-shrink-0 inline w-4 h-4 mr-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                  <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                </svg>
                <span class="sr-only">Info</span>
                <div>
                  <span class="font-medium">{{ Session::get('success') }}</span>
                </div>
            </div>
            @endif
            <form method="POST" action="{{ route('send.contact') }}" enctype="multipart/form-data">
                @csrf
                <div class="grid grid-cols-1 mt-6 lg:grid-cols-2 lg:gap-x-10 gap-y-4">
                    <div>
                        <label for="nama-depan" class="block mb-1 font-medium text-gray-200">Nama Depan</label>
                        <input name="nama_depan" type="text" id="nama-depan" class="w-full p-3 text-sm text-gray-900 bg-gray-100 border-0 focus:ring-blue-200 focus:border-blue-500" required>
                    </div>
                    <div>
                        <label for="nama-belakang" class="block mb-1 font-medium text-gray-200">Nama Belakang</label>
                        <input name="nama_belakang" type="text" id="nama-belakang" class="w-full p-3 text-sm text-gray-900 bg-gray-100 border-0 focus:ring-blue-200 focus:border-blue-500" required>
                    </div>
                    <div>
                        <label for="nomer" class="block mb-1 font-medium text-gray-200">Nomor Telephone</label>
                        <input name="phone" type="number" id="nomer" oninput="this.value = this.value.replace(/[^0-9]/g, '')" min="0" class="w-full p-3 text-sm text-gray-900 bg-gray-100 border-0 focus:ring-blue-200 focus:border-blue-500" required>
                    </div>
                    <div>
                        <label for="email" class="block mb-1 font-medium text-gray-200">Alamat Email</label>
                        <input name="email" type="email" id="email" class="w-full p-3 text-sm text-gray-900 bg-gray-100 border-0 focus:ring-blue-200 focus:border-blue-500" required>
                    </div>
                </div>
                <div class="mt-5">
                    <label for="message" class="block mb-1 font-medium text-gray-200">Pesan</label>
                    <textarea name="pesan" id="message" rows="4" class="w-full col-span-2 p-3 text-sm text-gray-900 bg-gray-100 border-0 focus:ring-blue-200 focus:border-blue-500"></textarea>
                </div>
                <div class="flex justify-center">
                    <button class="px-8 py-2 mt-5 text-sm text-white mb-7 bg-sub hover:bg-cyan-600">Kirim Pesan</button>
                </div>
            </form>
        </div>
    </section>

    {{-- Featured --}}
    {{-- <section class="hidden max-w-screen-xl mx-auto mb-16 md:block">
        <div class="px-28 mt-14">
            <div class="relative flex justify-center text-left md:p-0">
                <div class="w-[65em]">
                    <img src="{{ asset('image/kemudahan.png') }}">
                </div>
                <div class="absolute top-9 flex flex-col h-auto py-8 shadow-xl bg-sub px-7 left-[28em]">
                    <h5 class="mb-2 text-2xl font-semibold text-gray-100 uppercase">Kemudahan Resespionis</h5>
                    <p class="text-gray-100">
                        Kami memiliki resepsionis yang siap membantu Anda 24/7. Jadi, jangan ragu untuk menghubungi kami kapan saja. Kami akan dengan senang hati menjawab pertanyaan Anda atau membantu Anda dengan permintaan khusus.<br><br>

                        Apapun yang Anda butuhkan, tim Hotel Vista Indah siap memberikan pelayanan terbaik kepada Anda. Kami berkomitmen untuk merespons dengan cepat dan memberikan solusi yang memenuhi kebutuhan Anda.<br><br>

                        Terima kasih atas minat dan kepercayaan Anda pada Hotel Vista Indah. Kami berharap dapat membantu Anda dan menyambut kedatangan Anda dengan hangat.
                    </p>
                </div>
            </div>
        </div>
    </section> --}}

    {{-- G-Maps Embed --}}
    <section class="max-w-screen-xl px-6 mx-auto mb-10 lg:mb-28 sm:px-12 md:px-20 lg:px-28">
        <div class="relative overflow-hidden">
            <h2 class="mb-1 text-2xl font-medium text-gray-800">Kantor Pusat</h2>
            <p class="w-2/3 mb-6 text-sm text-gray-800">{{ $settings->address }}</p>
            <div class="relative overflow-hidden" style="padding-top: 56.25%;">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3953.5708975968896!2d110.42029637421521!3d-7.729100992289137!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a5e7c20d2559f%3A0xd648398dc4db70c6!2sPondok%20Informatika%20Al-Madinah%20-%20Pondok%20IT!5e0!3m2!1sid!2sid!4v1691550551724!5m2!1sid!2sid"
                        class="absolute top-0 left-0 w-full h-full" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
        </div>
    </section>

@endsection
