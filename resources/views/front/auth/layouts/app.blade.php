<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title', 'Hotel Citra Megah')</title>
        <link rel="shortcut icon" href="{{ asset('storage/' . $settings->favicon )}}" type="image/x-icon">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.20/dist/sweetalert2.min.css">
        <link href="{{ asset('css/tailwind.css') }}" rel="stylesheet">
        @vite(['resources/css/app.css','resources/js/app.js'])
        <style>
            @font-face {
                font-family: 'font-logo';
                src: url('{{ asset('fonts/font-logo.woff') }}') format('truetype');
            }

            .font-logo {
                font-family: 'font-logo', sans-serif;
            }
        </style>
    </head>
    <body class="bg-fixed bg-center bg-no-repeat bg-cover bg-gradient-to-b from-blue-500 to-blue-900" style="background-image: url({{ asset('image/bg-auth.jpg') }})">
    @yield('content')

    @stack('js-custom')
    @include('front.layout.scripts')
    <script src="{{ asset('dist-front/js/iziToast.min.js') }}"></script>
    @if($errors->any())
            @foreach($errors->all() as $error)
                <script>
                    iziToast.error({
                        title: '',
                        position: 'topRight',
                        message: '{{ $error }}',
                    });
                </script>
            @endforeach
        @endif
        @if(session()->get('error'))
            <script>
                iziToast.error({
                    title: '',
                    position: 'topRight',
                    message: '{{ session()->get('error') }}',
                });
            </script>
        @endif

        @if(session()->get('success'))
            <script>
                iziToast.success({
                    title: '',
                    position: 'topRight',
                    message: '{{ session()->get('success') }}',
                });
            </script>
        @endif
    </body>
</html>
