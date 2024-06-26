<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title', 'Judul Default')</title>
        <link rel="shortcut icon" href="{{ asset('storage/' . $settings->favicon )}}" type="image/x-icon">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.23/dist/sweetalert2.min.css">
        <script src=" https://cdn.jsdelivr.net/npm/sweetalert2@11.7.23/dist/sweetalert2.all.min.js "></script>
        @vite(['resources/css/app.css','resources/js/app.js'])

        <!-- Styles -->
        @include('front.layout.styles')
        <style>
            :root {
                --primary-color: #1d7c82;
                --body-fonts: "Helvetica", "Arial", sans-serif;
                --line-height: 1.5;
                --scrollbarBG: #CFD8DC;
                --thumbBG: #90A4AE;
            }
            html {
                scroll-behavior: smooth;
            }

            body::-webkit-scrollbar {
                width: 11px;
            }
            body {
                scrollbar-width: thin;
                scrollbar-color: var(--thumbBG) var(--scrollbarBG);
            }

            body::-webkit-scrollbar-track {
                background: transparent;
            }

            body::-webkit-scrollbar-thumb {
                background-color: var(--thumbBG) ;
                border-radius: 6px;
                border: 3px solid var(--scrollbarBG);
            }

            @font-face {
                font-family: 'font-logo';
                src: url('{{ asset('fonts/font-logo.woff') }}') format('truetype');
            }

            .font-logo {
                font-family: 'font-logo', sans-serif;
            }

            bg-primary {
                background: var(--bg-primary);
            }
            .nav-up {
                top: -100px;
            }

            .navbar {
                transition: all 0.5s ease;
                background-color: transparent;
                border-bottom-left-radius: 10px;
                border-bottom-right-radius: 10px;
            }


            .navbar.scrolled {
                background-color: rgba(255, 255, 255, 0.683);
                backdrop-filter: blur(10px);
                transform: translateY(0); /* Tampilkan navbar */
            }

            .sticky-navbar {
                position: fixed;
                top: 0;
                width: 100%;
            }

            nav.hide {
                transform: translateY(-100%);
            }

            .float{
                position:fixed;
                width:60px;
                height:60px;
                bottom:30px;
                right:30px;
                background-color:#25d366;
                color:#FFF;
                border-radius:50px;
                text-align:center;
                font-size:30px;
                box-shadow: 2px 2px 3px #999;
                z-index:100;
            }

            .my-float{
                margin-top:16px;
            }

            .bounce {
                animation: bounce 2s infinite;
            }

            @keyframes bounce {
                0%,
                25%,
                50%,
                75%,
                100% {
                    transform: translateY(0);
                }
                40% {
                    transform: translateY(-20px);
                }
                60% {
                    transform: translateY(-12px);
                }
            }

        </style>
        @stack('css-custom')
    </head>
    <body>

        @include('front.layout.navbar')

        @yield('content')

        @include('front.layout.footer')
        <a href="https://api.whatsapp.com/send?phone={{ $settings->phone }}" class="float bounce" target="_blank">
            <i class="fa-brands fa-whatsapp my-float"></i>
        </a>
        @include('front.layout.scripts')

        @stack('js-custom')
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

        <!--Start of Tawk.to Script-->
        {{-- <script type="text/javascript">
            var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
            (function(){
            var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
            s1.async=true;
            s1.src='https://embed.tawk.to/6500055a0f2b18434fd801f6/1ha419rgm';
            s1.charset='UTF-8';
            s1.setAttribute('crossorigin','*');
            s0.parentNode.insertBefore(s1,s0);
            })();
        </script> --}}
        <script>
            var navbar = document.getElementById('navbar');
            var navbarItems = document.querySelectorAll('#navbar-ul a'); // Select the <a> elements within #navbar-ul
            var scrolled = false;
            var sticky = navbar.offsetTop;

            window.onscroll = function() {
                if (window.pageYOffset > 100 && !scrolled) {
                    navbar.classList.add('scrolled');
                    navbar.classList.add('text-black');
                    navbar.classList.remove('text-white');

                    navbarItems.forEach(function(item) {
                        item.classList.add('md:text-black');
                        item.classList.remove('md:text-white');
                        if (item.classList.contains('active')) {
                            item.classList.add('md:text-teal-800'); // Add the class for the active item
                        }
                    });

                    scrolled = true;
                } else if (window.pageYOffset <= 100 && scrolled) {
                    navbar.classList.remove('scrolled');
                    navbar.classList.remove('text-black');
                    navbar.classList.add('text-white');

                    navbarItems.forEach(function(item) {
                        item.classList.remove('md:text-black');
                        item.classList.add('md:text-white');
                        if (item.classList.contains('active')) {
                            item.classList.add('md:text-teal-800'); // Add the class for the active item
                        }
                    });

                    scrolled = false;
                }

                if (window.pageYOffset >= sticky) {
                    navbar.classList.add("sticky-navbar");
                } else {
                    navbar.classList.remove("sticky-navbar");
                }
            };

            const header = document.querySelector("nav");
            let lastScrollPosition = 0;

            window.addEventListener("scroll", () => {
                let currentScrollPosition = window.pageYOffset;

                if (currentScrollPosition - lastScrollPosition > 0) {
                    header.classList.add("hide");
                } else {
                    header.classList.remove("hide");
                }
                lastScrollPosition = currentScrollPosition;
            });
            </script>
        <!--End of Tawk.to Script-->
    </body>
</html>
