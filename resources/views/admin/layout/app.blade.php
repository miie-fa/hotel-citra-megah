<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>@yield('title') | Admin Panel</title>
  @include('admin.layout.css')
  @stack('css-custom')
  <link rel="shortcut icon" href="images/favicon.png" />
  <style>
  /* Sidebar Styles */
  #sidebar {
    overflow-y: auto;
    height: calc(80vh - 40px); /* Adjust this to fit your design */
  }

  #content-pages {
    overflow-y: auto;
    height: calc(80vh - 40px); /* Adjust this to fit your design */
  }

  /* Scrollbar Styles */
  ::-webkit-scrollbar {
    width: 10px;
  }

  ::-webkit-scrollbar-track {
    background: #f1f1f1;
  }

  ::-webkit-scrollbar-thumb {
    background: #888;
  }

  ::-webkit-scrollbar-thumb:hover {
    background: #555;
  }
</style>

</head>
<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    @include('admin.layout.navbar')
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_settings-panel.html -->
      @include('admin.layout.sidebar')
      @include('admin.layout.theme')
      <!-- partial -->
      <div class="main-panel" id="content-pages">
        <div class="content-wrapper">
        @yield('content')
        @include('admin.layout.footer')
        </div>
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  @include('admin.layout.script')
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
</body>
</html>
