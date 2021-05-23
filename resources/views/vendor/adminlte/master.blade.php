<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    {{-- Base Meta Tags --}}
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Custom Meta Tags --}}
    @yield('meta_tags')

    {{-- Title --}}
    <title>
        @yield('title_prefix', config('adminlte.title_prefix', ''))
        @yield('title', config('adminlte.title', 'AdminLTE 3'))
        @yield('title_postfix', config('adminlte.title_postfix', ''))
    </title>

    {{-- Custom stylesheets (pre AdminLTE) --}}
    @yield('adminlte_css_pre')

    {{-- Base Stylesheets --}}
    @if (!config('adminlte.enabled_laravel_mix'))
        <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}">
        <link rel="stylesheet" href="{{ asset('vendor/overlayScrollbars/css/OverlayScrollbars.min.css') }}">

        {{-- Configured Stylesheets --}}
        @include('adminlte::plugins', ['type' => 'css'])

        <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/adminlte.min.css') }}">
        {{-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic"> --}}

        <link rel="stylesheet" href='https://mmwebfonts.comquas.com/fonts/?font=pyidaungsu' />
        <link rel="stylesheet" href="//fonts.googleapis.com/earlyaccess/notosansmyanmarui.css" />
        <style type="text/css" media="screen">
            /* @font-face {
                font-family:'Noto Sans Myanmar';
                src:local('Noto Sans Myanmar'), url('https://www.mmwebfonts.com/fonts/NotoSansMyanmar-Regular.woff') format('woff'), url('https://www.mmwebfonts.com/fonts/NotoSansMyanmar-Regular.ttf') format('ttf');
            }

            @font-face {
                font-family:'Noto Sans Myanmar';
                src:local('Noto Sans Myanmar'), url('https://www.mmwebfonts.com/fonts/NotoSansMyanmar-Bold.woff') format('woff'), url('https://www.mmwebfonts.com/fonts/NotoSansMyanmar-Bold.ttf') format('ttf');
                font-weight:bold;
            }


            body{
                 font-family: "Noto Sans Myanmar","Pyidaungsu" !important;
            } */

            @font-face {
                font-family: "Telenor";
                src: url({{ asset('fonts/telenor/Telenor.woff') }});
            }

            @font-face {
                font-family: "Telenor";
                src: url({{ asset('fonts/telenor/Telenor-Bold.woff') }});
                font-weight: bold;
            }

            @charset "UTF-8";

            /* * {
                font-family: Telenor, sans-serif !important;
                font-size: 1rem;
                font-weight: 400;
            } */

            html,
            body {
                font-family: Telenor, sans-serif !important;
                /* line-height: 1.15; */
                -webkit-text-size-adjust: 100%;
                -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
            }

            .unicode {
                font-family: Telenor, sans-serif !important;
            }

            .help-block {
                color: red;
                font-family: Telenor, sans-serif !important;
                font-size: 12px;
            }

            label {
                font-size: 12px;
            }

            p,
            h1,
            h2,
            h3,
            h4,
            h5,
            h6,
            .h1,
            .h2,
            .h3,
            .h4,
            .h5,
            .h6,
            table,
            .table,
            input,
            select {
                font-family: Telenor, sans-serif !important;
            }

            /*  h3 {
              font-size: 16px  !important;
            }*/

            /* h5 {
                font-size: 14px  !important;
            }*/

            a,
            p,
            .btn,
            .page-link {
                font-size: 12px !important;
            }

            .size,
            .select2-selection__placeholder,
            .select2-selection__rendered,
            .select2-results__option {
                font-family: Telenor, sans-serif !important;
                font-size: 12px;
            }

            label,
            strong,
            input,
            select,
            textarea,
            table,
            tr,
            td {
                font-family: Telenor, sans-serif !important;
                font-size: 12px !important;
            }

        </style>
    @else
        <link rel="stylesheet" href="{{ mix(config('adminlte.laravel_mix_css_path', 'css/app.css')) }}">
    @endif

    {{-- Livewire Styles --}}
    @if (config('adminlte.livewire'))
        @if (app()->version() >= 7)
            @livewireStyles
        @else
            <livewire:styles />
        @endif
    @endif

    {{-- Custom Stylesheets (post AdminLTE) --}}
    @yield('adminlte_css')

    {{-- Favicon --}}
    <link rel="icon" type="image/png" href="{{ asset('vendor/adminlte/dist/img/linn.png') }}">
    @if (config('adminlte.use_ico_only'))
        <link rel="shortcut icon" href="{{ asset('favicons/favicon.ico') }}" />
    @elseif(config('adminlte.use_full_favicon'))
        <link rel="shortcut icon" href="{{ asset('favicons/favicon.ico') }}" />
        <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('favicons/apple-icon-57x57.png') }}">
        <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('favicons/apple-icon-60x60.png') }}">
        <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('favicons/apple-icon-72x72.png') }}">
        <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('favicons/apple-icon-76x76.png') }}">
        <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('favicons/apple-icon-114x114.png') }}">
        <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('favicons/apple-icon-120x120.png') }}">
        <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('favicons/apple-icon-144x144.png') }}">
        <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('favicons/apple-icon-152x152.png') }}">
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicons/apple-icon-180x180.png') }}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicons/favicon-16x16.png') }}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicons/favicon-32x32.png') }}">
        <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('favicons/favicon-96x96.png') }}">
        <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('favicons/android-icon-192x192.png') }}">
        <link rel="manifest" href="{{ asset('favicons/manifest.json') }}">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="{{ asset('favicon/ms-icon-144x144.png') }}">
    @endif


    <link rel="stylesheet" type="text/css" href="{{ asset('css/custom.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('toastr/toastr.min.css') }}">

</head>

<body class="@yield('classes_body')" @yield('body_data')>

    {{-- Body Content --}}
    @yield('body')

    {{-- Base Scripts --}}
    @if (!config('adminlte.enabled_laravel_mix'))
        <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('vendor/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
        <script src="{{ asset('toastr/toastr.min.js') }}"></script>


        {{-- Configured Scripts --}}
        @include('adminlte::plugins', ['type' => 'js'])

        <script src="{{ asset('vendor/adminlte/dist/js/adminlte.min.js') }}"></script>
    @else
        <script src="{{ mix(config('adminlte.laravel_mix_js_path', 'js/app.js')) }}"></script>
    @endif

    {{-- Livewire Script --}}
    @if (config('adminlte.livewire'))
        @if (app()->version() >= 7)
            @livewireScripts
        @else
            <livewire:scripts />
        @endif
    @endif

    {{-- Custom Scripts --}}
    @yield('adminlte_js')

</body>

</html>
