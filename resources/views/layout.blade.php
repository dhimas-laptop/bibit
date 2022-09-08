<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bibit Gratis</title>

    <link rel="stylesheet" href="{{ asset('vendor/adminlte/css/adminlte.min.css') }}">
    <link href="{{asset('vendor/fontawesome/css/all.min.css')}}" rel="stylesheet">
    @yield('css')
</head>
<body>
  @include('sweetalert::alert')
    <header class="p-3 text-bg-custom" style="background: lightgreen">
        <div class="container">
          <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
              <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap"><use xlink:href="#bootstrap"></use></svg>
            </a>
    
            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
              <li><img src="{{ asset('img/logo.png') }}" alt="AdminLTE Logo" width="40px" height="40px" style="opacity: .8">
                <span class="brand-text font-weight-light" onclick="route('/')">SMART-BIBIT</span></li>
            </ul>
    
          </div>
        </div>
      </header>

    @yield('content')
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.min.js"></script>
    <script src="{{ asset('vendor/fontawesome/js/all.min.js')}}"></script>
    <script src="{{ asset('vendor/adminlte/js/adminlte.min.js')}}"></script>

    @yield('script')
</body>
</html>

