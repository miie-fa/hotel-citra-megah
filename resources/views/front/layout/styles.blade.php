<!-- All CSS -->
{{-- <link rel="stylesheet" href="{{ asset('dist-front/css/bootstrap.min.css') }}"> --}}
<link rel="stylesheet" href="{{ asset('dist-front/css/jquery-ui.css') }}">
<link rel="stylesheet" href="{{ asset('dist-front/css/animate.min.css') }}">
<link rel="stylesheet" href="{{ asset('dist-front/css/magnific-popup.css') }}">
<link rel="stylesheet" href="{{ asset('dist-front/css/owl.carousel.min.css') }}">
<link rel="stylesheet" href="{{ asset('dist-front/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('dist-front/css/select2-bootstrap.min.css') }}">
<link
  rel="stylesheet"
  href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css"
/>
<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
<link rel="stylesheet" href="{{ asset('dist-front/css/sweetalert2.min.css') }}">
<link rel="stylesheet" href="{{ asset('dist-front/css/spacing.css') }}">
{{-- <link rel="stylesheet" href="{{ asset('dist-front/css/font-awesome.min.css') }}"> --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="{{ asset('dist-front/css/daterangepicker.css') }}">
<link rel="stylesheet" href="{{ asset('dist-front/css/meanmenu.css') }}">
<link href=" https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css " rel="stylesheet">
<link rel="stylesheet" href="{{ asset('dist-front/css/iziToast.min.css') }}">
<style>
    .navbar {
    z-index: 100; /* Atur nilai z-indeks yang sesuai */
    }

    /* Atur z-indeks untuk elemen DateRangePicker */
    .daterangepicker {
        z-index: 50; /* Atur nilai z-indeks yang lebih rendah dari navbar */
    }

    .custom-btn {
        width: auto;
        height: 40px;
        color: #fff;
        padding: 10px 10px;
        font-family: 'Lato', sans-serif;
        font-weight: 500;
        font-size: 14px;
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

    /* 15 */
    .btn-15 {
        background: #233876;
        border: none;
        z-index: 1;
    }
    .btn-15:after {
        position: absolute;
        content: "";
        width: 0;
        height: 100%;
        top: 0;
        right: 0;
        z-index: -1;
        background-color: #663dff;
        box-shadow:inset 2px 2px 2px 0px rgba(255,255,255,.5),
        7px 7px 20px 0px rgba(0,0,0,.1),
        4px 4px 5px 0px rgba(0,0,0,.1);
        transition: all 0.3s ease;
    }
    .btn-15:hover {
        color: #fff;
    }
    .btn-15:hover:after {
        left: 0;
        width: 100%;
    }
    .btn-15:active {
        top: 2px;
    }
</style>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@18.1.1/build/css/intlTelInput.css">
<link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
  />
{{-- <link rel="stylesheet" href="{{ url('dist-front/css/style.css') }}"> --}}
