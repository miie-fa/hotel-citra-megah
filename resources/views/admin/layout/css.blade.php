<!-- plugins:css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('vendors/feather/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/ti-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/css/vendor.bundle.base.css') }}">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{ asset('vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/ti-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('js/select.dataTables.min.css') }}">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('css/vertical-layout-light/style.css') }}">
    <link rel="stylesheet" href="{{ asset('dist-front/css/iziToast.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist-front/css/sweetalert2.min.css') }}">
    {{-- FilePond CSS --}}
    <script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>
    <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
    <!-- endinject -->
    <style>
        .search {
            position: relative;
            margin: 0 auto;
        }
        .search input {
            height: 3em;
            width: 100%;
            padding: 0 10px 0 15px;
            border: 1px solid;
            border-color: #a8acbc #babdcc #c0c3d2;
            -webkit-appearance: textfield;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
            -webkit-box-shadow: inset 0 1px #e5e7ed, 0 1px #fcfcfc;
            box-shadow: inset 0 1px #e5e7ed, 0 1px #fcfcfc;
        }
        .search input:focus {
            outline: 0;
            border-color: #66b1ee;
            -webkit-box-shadow: 0 0 2px rgba(85, 168, 236, 0.9);
            box-shadow: 0 0 2px rgba(85, 168, 236, 0.9);
        }
        .search input:focus + .search-ac {
            display: block;
        }

        .search-ac {
            padding: 0;
            margin: 0;
            display: none;
            position: absolute;
            top: 35px;
            left: 0;
            right: 0;
            z-index: 10;
            background: #fdfdfd;
            border: 1px solid;
            border-color: #cbcfe2 #c8cee7 #c4c7d7;
            border-radius: 3px;
            background-image: -webkit-linear-gradient(top, #fdfdfd, #eceef4);
            background-image: -moz-linear-gradient(top, #fdfdfd, #eceef4);
            background-image: -o-linear-gradient(top, #fdfdfd, #eceef4);
            background-image: linear-gradient(to bottom, #fdfdfd, #eceef4);
            -webkit-box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
        }
        .search-ac:hover {
            display: block;
        }
        .search-ac li {
            display: block;
        }
        .search-ac li:first-child {
            margin-top: -1px;
        }
        /*.search-ac li:first-child:before, .search-ac li:first-child:after {
        content: '';
        display: block;
        width: 0;
        height: 0;
        position: absolute;
        //left: 50%;
        margin-left: -5px;
        border: 5px outset transparent;
        }*/
        .search-ac li:first-child:before {
            border-bottom: 5px solid #c4c7d7;
            top: -11px;
        }
        .search-ac li:first-child:after {
            border-bottom: 5px solid #fdfdfd;
            top: -10px;
        }
        .search-ac li:first-child:hover:before, .search-ac li:first-child:hover:after {
            display: none;
        }
        .search-ac li:last-child {
            margin-bottom: -1px;
        }
        .search-ac a {
            display: block;
            position: relative;
            margin: 0 -1px;
            padding: 6px 40px 6px 10px;
            color: #808394;
            font-weight: 500;
            text-decoration: none;
            text-shadow: 0 1px white;
            border: 1px solid transparent;
            border-radius: 3px;
        }
        .search-ac a span {
            font-weight: 200;
        }
        .search-ac a:before {
            content: '';
            position: absolute;
            top: 50%;
            right: 10px;
            margin-top: -9px;
            width: 18px;
            height: 18px;
            background: url("../img/arrow.png") 0 0 no-repeat;
        }
        .search-ac a:hover {
            color: white;
            text-shadow: 0 -1px rgba(0, 0, 0, 0.3);
            background: #338cdf;
            border-color: #2380dd #2179d5 #1a60aa;
            background-image: -webkit-linear-gradient(top, #59aaf4, #338cdf);
            background-image: -moz-linear-gradient(top, #59aaf4, #338cdf);
            background-image: -o-linear-gradient(top, #59aaf4, #338cdf);
            background-image: linear-gradient(to bottom, #59aaf4, #338cdf);
            -webkit-box-shadow: inset 0 1px rgba(255, 255, 255, 0.2),
                0 1px rgba(0, 0, 0, 0.08);
            box-shadow: inset 0 1px rgba(255, 255, 255, 0.2), 0 1px rgba(0, 0, 0, 0.08);
        }

        :-moz-placeholder {
            color: #a7aabc;
            font-weight: 200;
        }

        ::-webkit-input-placeholder {
            color: #a7aabc;
            font-weight: 200;
            line-height: 14px;
        }

        ::-webkit-search-decoration, ::-webkit-search-cancel-button {
            -webkit-appearance: none;
        }

        .lt-ie9 .search input {
            line-height: 26px;
        }
    </style>
