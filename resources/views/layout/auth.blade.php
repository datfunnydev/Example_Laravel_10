<!DOCTYPE html>
<html lang=en>

<head>
    <meta charset=utf-8>
    <title>{{ config('app.name') }}</title>
    <meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name=viewport>
    <meta content="{{ csrf_token() }}" name=csrf-token>
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel=stylesheet>
    <link href="{{ asset('assets/css/pages/login/login-2.css') }}" rel=stylesheet>
    <link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel=stylesheet>
    <link href="{{ asset('assets/css/style.bundle.css') }}" rel=stylesheet>
    <link href="{{ asset('images/favicon/favicon.ico') }}" rel="shortcut icon"/>
</head>
<body id="kt_body"
      class="page-loading-enabled page-loading header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">
<div class="page-loader page-loader-logo">
    <div class="spinner spinner-primary"></div>
</div>
<div class="d-flex flex-column flex-root">
    <div class="bg-white d-flex flex-column flex-column-fluid flex-lg-row login login-2 login-signin-on" id=kt_login>
        <div class="d-flex flex-row-auto login-aside order-2 order-lg-1 overflow-hidden position-relative">
            <div class="d-flex flex-column flex-column-fluid justify-content-between px-7 px-lg-35 py-9 py-lg-13">
                <span class="pt-2 text-center">
                    <img alt class=max-h-75px id="logo" src="{{ asset('images/logo/logo.png') }}"/>
                </span>
                <div class="d-flex flex-center flex-column flex-column-fluid">
                    <div class="login-form login-signin py-11">
                        @include('auth.singin')
                    </div>
                    <div class="login-forgot login-form pt-11">
                        @include('auth.forgot_pass')
                    </div>
                    <div class="login-form login-reset pt-11">
                        @include('auth.reset_pass')
                    </div>
                </div>
            </div>
        </div>
        <div class="content d-flex flex-column order-1 order-lg-2 pb-0 w-100" style=background-color:#b1dced>
            <div class="d-flex flex-column justify-content-center pt-5 pt-lg-40 pt-md-5 pt-sm-5 px-7 px-lg-0 text-center">
                <h3 class="display4 font-weight-bolder my-7 text-dark" style=color:#986923>{{ config('app.name') }}</h3>
                <p class="font-size-h2-md font-size-lg font-weight-bolder opacity-70 text-dark">{{__('Hệ thống quản lý tăng lượt xem Youtube, Quảng Ninh News')}}
            </div>
            <div class="bgi-no-repeat bgi-position-x-center bgi-position-y-bottom content-img d-flex flex-row-fluid"
                 style="background-image:url({{asset('assets/media/svg/illustrations/login-visual-2.svg')}})">
            </div>
        </div>
    </div>
</div>
<script>let KTAppSettings = { "breakpoints": { "sm": 576, "md": 768, "lg": 992, "xl": 1200, "xxl": 1400 }, "colors": { "theme": { "base": { "white": "#ffffff", "primary": "#3699FF", "secondary": "#E5EAEE", "success": "#1BC5BD", "info": "#8950FC", "warning": "#FFA800", "danger": "#F64E60", "light": "#E4E6EF", "dark": "#181C32" }, "light": { "white": "#ffffff", "primary": "#E1F0FF", "secondary": "#EBEDF3", "success": "#C9F7F5", "info": "#EEE5FF", "warning": "#FFF4DE", "danger": "#FFE2E5", "light": "#F3F6F9", "dark": "#D6D6E0" }, "inverse": { "white": "#ffffff", "primary": "#ffffff", "secondary": "#3F4254", "success": "#ffffff", "info": "#ffffff", "warning": "#ffffff", "danger": "#ffffff", "light": "#464E5F", "dark": "#ffffff" } }, "gray": { "gray-100": "#F3F6F9", "gray-200": "#EBEDF3", "gray-300": "#E4E6EF", "gray-400": "#D1D3E0", "gray-500": "#B5B5C3", "gray-600": "#7E8299", "gray-700": "#5E6278", "gray-800": "#3F4254", "gray-900": "#181C32" } }, "font-family": "Poppins" };</script>
<script src="{{ url('assets/plugins/global/plugins.bundle.js') }}"></script>
<script src="{{ url('assets/js/scripts.bundle.js') }}"></script>
<script src="{{ url('assets/js/scripts.js') }}"></script>
<script src="{{ url('assets/js/axios.js') }}"></script>
<script type="text/javascript">
    let _login = $('#kt_login');
    let _showForm = function (form) {
        let cls = 'login-' + form + '-on';
        form = 'kt_login_' + form + '_form';
        _login.removeClass('login-forgot-on');
        _login.removeClass('login-signin-on');
        _login.removeClass('login-reset-on');
        _login.addClass(cls);
        KTUtil.animateClass(KTUtil.getById(form), 'animate__animated animate__backInUp');
    }
</script>
@include('component.admin.script')
@stack('scripts')
</body>
