<!DOCTYPE html>
<html lang=en>

<head>
    <base href>
    <meta charset=utf-8/>
    <title>{{ config('app.name') }}</title>
    <meta name=csrf-token content="{{ csrf_token() }}">
    <meta name=viewport content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <link href="//fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet"/>
    <link href="{{ asset('/assets/css/themes/layout/header/base/light.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('/assets/css/themes/layout/header/menu/light.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('/assets/css/themes/layout/brand/light.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('/assets/css/themes/layout/aside/light.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('/assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('/assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('/assets/css/style.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('/assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('images/favicon/favicon.ico') }}" rel="shortcut icon"/>
    @include('component.admin.style')
</head>
<body id="kt_body" class="page-loading-enabled page-loading header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">
<div class="page-loader page-loader-logo">
    <div class="spinner spinner-primary"></div>
</div>
@include('component.admin.header_mobile')
<div class="d-flex flex-column flex-root">
    <div class="d-flex flex-row flex-column-fluid page">
        @include('component.admin.menu')
        <div class="d-flex flex-column flex-row-fluid wrapper" id=kt_wrapper>
            @include('component.admin.header')
            <div class="content d-flex flex-column flex-column-fluid" id=kt_content>
                <div class="d-flex flex-column-fluid">
                    <div class=container>
                        @yield('content')
                    </div>
                </div>
            </div>
            @include('component.admin.footer')
        </div>
    </div>
</div>
@include('component.admin.sidebar')
</body>
<script>let KTAppSettings = { "breakpoints": { "sm": 576, "md": 768, "lg": 992, "xl": 1200, "xxl": 1400 }, "colors": { "theme": { "base": { "white": "#ffffff", "primary": "#3699FF", "secondary": "#E5EAEE", "success": "#1BC5BD", "info": "#8950FC", "warning": "#FFA800", "danger": "#F64E60", "light": "#E4E6EF", "dark": "#181C32" }, "light": { "white": "#ffffff", "primary": "#E1F0FF", "secondary": "#EBEDF3", "success": "#C9F7F5", "info": "#EEE5FF", "warning": "#FFF4DE", "danger": "#FFE2E5", "light": "#F3F6F9", "dark": "#D6D6E0" }, "inverse": { "white": "#ffffff", "primary": "#ffffff", "secondary": "#3F4254", "success": "#ffffff", "info": "#ffffff", "warning": "#ffffff", "danger": "#ffffff", "light": "#464E5F", "dark": "#ffffff" } }, "gray": { "gray-100": "#F3F6F9", "gray-200": "#EBEDF3", "gray-300": "#E4E6EF", "gray-400": "#D1D3E0", "gray-500": "#B5B5C3", "gray-600": "#7E8299", "gray-700": "#5E6278", "gray-800": "#3F4254", "gray-900": "#181C32" } }, "font-family": "Poppins" };</script>
<script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
<script src="{{ asset('assets/plugins/custom/prismjs/prismjs.bundle.js') }}"></script>
<script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
<script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
<script src="{{ asset('assets/js/scripts.js') }}"></script>
<script src="{{ asset('assets/js/axios.js') }}"></script>
@include('component.admin.script')
@stack('scripts')
</html>
