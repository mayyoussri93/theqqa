<!DOCTYPE html>
{{--@if(\App\Models\Language::where('code', Session::get('locale', Config::get('app.locale')))->first()->rtl == 1)--}}
{{--<html dir="rtl" lang="{{ str_replace('_', '-', app()->getLocale()) }}"  prefix="og: https://ogp.me/ns#">--}}
{{--@else--}}
<html lang="en" prefix="og: https://ogp.me/ns#">
{{--@endif--}}
<head>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="app-url" content="{{ getBaseURL() }}">
    <meta name="file-base-url" content="{{ getFileBaseURL() }}">

    <title>@yield('meta_title', get_setting('website_name'))</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="index, follow">
    <meta name="description" content="@yield('meta_description', get_setting('meta_description') )" />
    <meta name="keywords" content="@yield('meta_keywords', get_setting('meta_keywords') )">

    <link rel="canonical" href="https://www.rawafd-najd.com.sa/" />
    <meta property="og:locale" content="ar_AR" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="مكتب استقدام - روافد نجد للأستقدام" />
    <meta property="og:description" content="@yield('meta_description', get_setting('meta_description') )" />
    <meta property="og:url" content="https://www.rawafd-najd.com.sa/" />
    <meta property="og:site_name" content="مكتب استقدام - روافد نجد للاستقدام " />
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title"content="مكتب استقدام - روافد نجد للاستقدام " />
    <meta name="twitter:description" content="@yield('meta_description', get_setting('meta_description') )"/>
    <meta name="twitter:site" content="@rawafdnajd" />




    @yield('meta')



    <!-- Favicon -->
    <link rel="icon" href="{{ uploaded_asset(get_setting('site_icon')) }}">


<!-- bootstrap core CSS -->
<link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
    <link rel="preload" as="style" href="{{ static_asset('v2_assets/css/bootstrap.min.css') }}" onload="this.rel='stylesheet'">

    <!-- font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <!-- owl carousel -->
    <link href="{{ static_asset('v2_assets/css/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ static_asset('v2_assets/css/owl.theme.default.min.css') }}" rel="stylesheet">


        <!-- venobox css -->
        <link rel="preload" as="style" href="{{ static_asset('v2_assets/css/venobox.css') }}" onload="this.rel='stylesheet'">
        <!-- datepicker css -->

        <link rel="stylesheet" href="{{ static_asset('v2_assets/css/datepicker.min.css') }}">
        <link rel="stylesheet" href="{{ static_asset('v2_assets/timer/css/demo.css') }}">

        <!-- custom styles for this template -->

        <style>
            @import url("{{ static_asset('v2_assets/css/all.min.css') }}");
            @import url("{{ static_asset('v2_assets/css/custom.css') }}");
            @import url("{{ static_asset('v2_assets/css/responsive.css') }}");
            @import url("{{ static_asset('v2_assets/css/helper.css') }}");
        </style>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/jquery.classycountdown@1.0.1/css/jquery.classycountdown.min.css">
        <link rel="stylesheet" href="{{ static_asset('assets/css/aiz-core.css') }}">



           <!--====== Style css ======-->
   @if(\App\Models\Language::where('code', Session::get('locale', Config::get('app.locale')))->first()->rtl == 1)
   <link rel="stylesheet" href="{{ static_asset('v2_assets/css/ar_style.css') }}" />

    @else
    <link rel="stylesheet" href="{{ static_asset('v2_assets/css/en_style.css') }}" />

    @endif

<!-- End Google Tag Manager -->


</head>

@php
    echo get_setting('header_script');
@endphp

</head>
<body>
{{--<div id="preloader">--}}
{{--    <div class="spinner-grow" role="status"> <span class="sr-only">Loading...</span> </div>--}}
{{--</div>--}}



@yield('content')



    <!--Modal: Name-->
      <!--Modal: Name-->
      <!-- START CHAT-->
      <div id="body">



        </div>
      <!-- END CHAT -->
    <!-- SCRIPTS -->

<script src="{{ static_asset('assets/js/vendors.js') }}"></script>
{{-- <script src="{{ static_asset('assets/js/aiz-core.js') }}"></script> --}}

<!-- js files -->
<script src="{{ static_asset('v2_assets/js/jquery-3.5.1.min.js') }}"></script>
<script src="https://code.jquery.com/jquery-migrate-1.4.1.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>

<script src="{{ static_asset('v2_assets/js/bootstrap.bundle.min.js') }}"></script>
<!-- counter js -->

<script src="{{ static_asset('v2_assets/js/waypoints.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery-Knob/1.2.13/jquery.knob.min.js" integrity="sha512-NhRZzPdzMOMf005Xmd4JonwPftz4Pe99mRVcFeRDcdCtfjv46zPIi/7ZKScbpHD/V0HB1Eb+ZWigMqw94VUVaw==" crossorigin="anonymous"></script>
<!-- jQuery throttle-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-throttle-debounce/1.1/jquery.ba-throttle-debounce.min.js" integrity="sha512-JZSo0h5TONFYmyLMqp8k4oPhuo6yNk9mHM+FY50aBjpypfofqtEWsAgRDQm94ImLCzSaHeqNvYuD9382CEn2zw==" crossorigin="anonymous"></script>
<script src={{ static_asset('v2_assets/timer/dist/jquery-countdowngampang.min.js')}}></script>
<!-- venobox js -->
<script src="{{ static_asset('v2_assets/js/venobox.min.js') }}"></script>
<script src="{{ static_asset('v2_assets/js/datepicker.min.js') }}"></script>
<script src="{{ static_asset('v2_assets/js/owl.carousel.min.js') }}"></script>

<!-- portfolio js -->
<script src="{{ static_asset('v2_assets/js/jquery.mixitup.min.js') }}"></script>
<!-- datepicker js -->

<script src="{{ static_asset('v2_assets/js/custom.js') }}"></script>
@yield('script')


</body>
</html>