<!DOCTYPE html>
<html lang="en">
<head>
  @include('partials.head')
</head>
<body>
  
  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top d-flex align-items-center">
    @include('partials.header')
  </header>
  <!-- End Header -->

  @yield('hero')

  <!-- Main -->
  <main id="main">
    @yield('content')
  </main>

  <!-- Footer -->
  @include('partials.footer')

  <!-- Back to top -->
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- JS Files -->
  @include('partials.script')
  @yield('script')

</body>

</html>