<!doctype html>
<html lang="nl">
<head>
    <title>GV</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    @vite('resources/js/myScript.js')
    @vite('resources/js/custom.js')
    @vite('resources/js/bootstrap.js')
    <script src="{{ asset('js/app.js') }}"></script>
{{--    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/favicon.png') }}">--}}
{{--    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicon.png') }}">--}}
{{--    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon.png') }}">--}}
{{--    <link rel="manifest" href="{{ asset('images/favicon.png') }}">--}}
{{--    <link rel="mask-icon" href="{{ asset('images/favicon.png') }}" color="#252525">--}}
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    <meta name="theme-color" content="#ffffff">
{{--    <link href="{{ asset('css/style.css') }}" rel="stylesheet">--}}
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.17/dist/sweetalert2.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/fontawesome.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.17/dist/sweetalert2.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.lordicon.com/bhenfmcm.js"></script>
</head>
<body class="@if (session('SESSION_USER_ROLE') === 'superadmin'|| session('SESSION_USER_ROLE') === 'admin' ) ml-72 @endif">
@include('partials.header')

@yield('content')
@include('partials.footer')

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
<script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick.min.js"></script>

</body>
</html>
