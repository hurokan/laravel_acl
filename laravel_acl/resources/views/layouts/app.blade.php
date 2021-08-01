<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="description" content="">

    <meta name="author" content="">

    <meta name="keywords" content="">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <link rel="apple-touch-icon" sizes="57x57" href="{{asset('assets/images/fivicon/apple-icon-57x57.png')}}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{asset('assets/images/fivicon/apple-icon-60x60.png')}}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{asset('assets/images/fivicon/apple-icon-72x72.png')}}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{asset('assets/images/fivicon/apple-icon-76x76.png')}}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{asset('assets/images/fivicon/apple-icon-114x114.png')}}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{asset('assets/images/fivicon/apple-icon-120x120.png')}}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{asset('assets/images/fivicon/apple-icon-144x144.png')}}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{asset('assets//images/fivicon/apple-icon-152x152.png')}}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('assets/images/fivicon/apple-icon-180x180.png')}}">
    <link rel="icon" type="image/png" sizes="192x192"  href="{{asset('assets/images/fivicon/android-icon-192x192.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('assets/images/fivicon/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{asset('assets/images/fivicon/apple-icon-57x57.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('assets/images/fivicon/favicon-16x16.png')}}">
    <link rel="manifest" href="{{asset('assets/images/fivicon/manifest.json')}}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/ms-icon-144x144.png{{asset('assets/images/fivicon/apple-icon-57x57.png')}}">
    <meta name="theme-color" content="#ffffff">

    <!-- Mobile Specific Meta  -->

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- CSS -->

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('assets/app/css/bootstrap.min.css')}}">

    <!-- Jquery ui CSS -->
    <link rel="stylesheet" href="{{asset('assets/app/css/jquery-ui.css')}}">


    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="{{asset('assets/app/css/font-awosome.css')}}">


    <!-- Flaticon CSS -->
    <link rel="stylesheet" href="{{asset('assets/app/flat-font/flaticon.css')}}">


    <!-- Nav Menu CSS -->
    <link rel="stylesheet" href="{{asset('assets/app/css/sm-core-css.css')}}">
    <link rel="stylesheet" href="{{asset('assets/app/css/sm-mint.css')}}">
    <link rel="stylesheet" href="{{asset('assets/app/css/sm-style.css')}}">

    <!-- Animate CSS -->
    <link rel="stylesheet" href="{{asset('assets/app/css/aos.css')}}">
    <link rel="stylesheet" href="{{asset('assets/app/css/animate.min.css')}}">
{{--    <link rel="stylesheet" href="{{asset('assets/app/css/magnific-popup.css')}}">--}}
    <link rel="stylesheet" href="{{asset('assets/app/css/swiper.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/app/css/3d-slider.css')}}">
    <link rel="stylesheet" href="{{asset('assets/app/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/app/css/owl.theme.default.min.css')}}">


    <!-- Main StyleSheet CSS -->
    <link rel="stylesheet" href="{{asset('assets/app/css/style.css')}}">
    <!--select2--------->
    <link href="{{asset('assets/libs/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- Favicon -->

    <link rel="shortcut icon" type="image/png" href="{{asset('assets/images/fivicon/favicon.ico')}}">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->

    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->

    <!--[if lt IE 9]>

    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>

    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>

    <![endif]-->

    <title id="app_title">{{ config('app.name', 'Laravel ACS.') }}</title>
{{--    <link rel='stylesheet' href='https://unpkg.com/vue-agile@latest/dist/VueAgile.css'>--}}
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">


    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/app/css/custom.css') }}" rel="stylesheet">
</head>
<body class="">
<!---Preloder-->
<div id="preloader"></div>
<!-- /Preloder-->
<!--Scroll Top-->
<button class="scroll-top scroll-to-target" data-target="html">
    <!--   <i class="fas fa-angle-up scrollup-icon"></i> -->
    <i class="flaticon-next scrollup-icon"></i>
</button>
<!--Scroll Top-->

<!-- Header -->
@include('layouts.partial.app-header')
    <div>
        <main>
            @yield('content')
        </main>
    </div>

    <!-- Scripts -->

    @include('layouts.partial.app-footer')


<!-- Scripts -->
<script src="{{ asset('js/app.js') }}" defer></script>

<!-- jQuery Plugin -->

<script src="{{asset('assets/app/js/jquery-3.4.1.min.js')}}"></script>

<!-- Bootstrap JS -->
<script src="{{asset('assets/app/js/bootstrap.min.js')}}"></script>

<!-- Aos Js Plugin-->
<script src="{{asset('assets/app/js/aos.js')}}"></script>

<!-- Jquery ui JS-->
<script src="{{asset('assets/app/js/jquery-ui.js')}}"></script>

<!--  Nav  -->
<script src="{{asset('assets/app/js/jquery.smartmenus.js')}}"></script>
<!--select2--->
<script src="{{asset('assets/libs/select2/js/select2.min.js')}}"></script>
<!--Js Plugins-->
<script src='https://unpkg.com/vue-agile@latest'></script>
<script src="{{asset('assets/app/js/swiper.min.js')}}"></script>
<script src='{{asset('assets/app/js/owl.carousel.min.js')}}'></script>
<!-- Main Script -->
<script src="{{asset('assets/app/js/theme.js')}}"></script>

<script>

</script>

</body>
</html>
