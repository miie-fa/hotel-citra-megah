<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>@yield('title') | User Dashboard</title>
  @include('user.layout.css')
  @stack('css-custom')
  <link rel="shortcut icon" href="{{ asset('storage/' . $settings->favicon )}}" type="image/x-icon">
</head>
<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    @include('user.layout.navbar')
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_settings-panel.html -->
      @include('user.layout.sidebar')
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
        @yield('content')
        @include('user.layout.footer')
        </div>
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  @include('user.layout.script')
  @stack('js-custom')
</body>
</html>
