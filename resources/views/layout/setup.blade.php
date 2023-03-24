<!DOCTYPE html>
<html lang=en>
<head>
    <base href>
    <meta charset=utf-8 />
    <title>{{ __('Cài đặt') }}</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Quicksand">
    <link rel="stylesheet" href="{{ asset('setup/css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{ asset('setup/css/style.css')}}">
    <link rel="stylesheet" href="{{ asset('setup/css/fontawesome.min.css')}}">
    <link rel="stylesheet" href="{{ asset('setup/css/font-awesome-animation.css')}}">
</head>
<body>
<div class="background">
    <div class="container-progress container">
        <div class="row text-center section-setup">
            <div class="col-12">
                <h1>{{ __('Cài đặt') }}</h1>
            </div>
        </div>
        @yield('content')
    </div>
</div>
<script src="{{ asset('setup/js/jquery.min.js')}}"></script>
<script src="{{ asset('setup/js/tippy.all.min.js')}}"></script>
<script src="{{ asset('assets/js/axios.js') }}"></script>
@stack('scripts')
</body>
</html>
