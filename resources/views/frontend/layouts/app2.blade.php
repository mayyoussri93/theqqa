<!DOCTYPE html>
@if(\App\Models\Language::where('code', Session::get('locale', Config::get('app.locale')))->first()->rtl == 1)
    <html dir="rtl" lang="ar"  prefix="og: https://ogp.me/ns#">
    @else
        <html lang="en" prefix="og: https://ogp.me/ns#">
        @endif

        <head>
       <!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-WENLEWT0LD"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-WENLEWT0LD');
</script>
            <!-- Global site tag (gtag.js) - Google Analytics -->
            <script async src="https://www.googletagmanager.com/gtag/js?id=UA-228838331-1"></script>
            <script>
                window.dataLayer = window.dataLayer || [];
                function gtag(){dataLayer.push(arguments);}
                gtag('js', new Date());

                gtag('config', 'UA-228838331-1');
            </script>

            <!-- Google Tag Manager -->
            <script>
                if(navigator.userAgent.indexOf("Chrome-Lighthouse") == -1) {
                    (function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
                            new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
                        j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
                        'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
                    })(window,document,'script','dataLayer','GTM-N2FZWKC');
                }
            </script>

            <!-- Required meta tags -->
            <meta name="csrf-token" content="{{ csrf_token() }}">
            <meta name="app-url" content="{{ getBaseURL() }}">
            <meta name="file-base-url" content="{{ getFileBaseURL() }}">
            <meta charset="utf-8">
            <!--<meta http-equiv="X-UA-Compatible" content="IE=edge">-->
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta name="robots" content="index, follow">
            <meta name="description" content="@yield('meta_description', get_setting('meta_description') )" />
            <meta name="keywords" content="@yield('meta_keywords', get_setting('meta_keywords') )">

            <!-- Schema.org markup for Google+ -->


            <!-- Twitter Card data -->
            <meta name="twitter:card" content="@yield('meta_product_twitter', get_setting('meta_title') )">
            <meta name="twitter:site" content="@yield('meta_keywords_twitter', get_setting('meta_keywords') )">
            <meta name="twitter:title" content="@yield('meta_title_twitter', get_setting('meta_title') )">
            <meta name="twitter:description" content="@yield('meta_description_twitter', get_setting('meta_description') ){{ get_setting('meta_description') }}">
            <meta name="twitter:creator" content="@yield('meta_creator_twitter', get_setting('meta_title') )">
            <meta name="twitter:image" content="{{ uploaded_asset(get_setting('meta_image')) }}">

            <!-- Open Graph data -->
            <meta property="og:title" content="{{ get_setting('meta_title') }}" />
            <meta property="og:type" content="website" />
            <meta property="og:url" content="{{ route('home') }}" />
            <meta property="og:image" content="{{ uploaded_asset(get_setting('meta_image')) }}" />
            <meta property="og:description" content="{{ get_setting('meta_description') }}" />
            <meta property="og:site_name" content="{{ env('APP_NAME') }}" />


            <meta property="og:title" content="@yield('meta_og_title', get_setting('meta_title'))" />
            <meta property="og:type" content="website" />
            <meta property="og:url" content="@yield('meta_og_url', get_setting('home'))" />
            <meta property="og:image" content="{{ uploaded_asset(get_setting('meta_image')) }}" />
            <meta property="og:description" content="@yield('meta_og_description', get_setting('meta_description'))" />
            <meta property="og:site_name" content="{{ env('APP_NAME') }}" />

        @yield('meta')

        <!-- title -->
            <title>@yield('meta_title', get_setting('meta_title')) </title>
            <!-- favicon -->
            <link rel="icon" type="image/x-icon" href="{{ uploaded_asset(get_setting('site_icon')) }}">

            <meta name="facebook-domain-verification" content="xzriovd2wahlxglii9zvaqy6xbfv9c" />

            <script>
                !function (w, d, t) {
                    w.TiktokAnalyticsObject=t;var ttq=w[t]=w[t]||[];ttq.methods=["page","track","identify","instances","debug","on","off","once","ready","alias","group","enableCookie","disableCookie"],ttq.setAndDefer=function(t,e){t[e]=function(){t.push([e].concat(Array.prototype.slice.call(arguments,0)))}};for(var i=0;i<ttq.methods.length;i++)ttq.setAndDefer(ttq,ttq.methods[i]);ttq.instance=function(t){for(var e=ttq._i[t]||[],n=0;n<ttq.methods.length;n++)ttq.setAndDefer(e,ttq.methods[n]);return e},ttq.load=function(e,n){var i="https://analytics.tiktok.com/i18n/pixel/events.js";ttq._i=ttq._i||{},ttq._i[e]=[],ttq._i[e]._u=i,ttq._t=ttq._t||{},ttq._t[e]=+new Date,ttq._o=ttq._o||{},ttq._o[e]=n||{};var o=document.createElement("script");o.type="text/javascript",o.async=!0,o.src=i+"?sdkid="+e+"&lib="+t;var a=document.getElementsByTagName("script")[0];a.parentNode.insertBefore(o,a)};

                    ttq.load('CC0DFOBC77UBH2MM1CV0');
                    ttq.page();
                }(window, document, 'ttq');
            </script>
            <script >
                if(navigator.userAgent.indexOf("Chrome-Lighthouse") == -1) {
                    window.woorankAssistantOptions = window.woorankAssistantOptions || {};
                    window.woorankAssistantOptions.url = 'rawafd-najd.com.sa';
                    window.woorankAssistantOptions.assistantPublicKey = '5364d56cd96cc7d562764bc7d7e526a6';
                    window.woorankAssistantOptions.collectWebVitals = true;
                    (function() {
                        var wl = document.createElement('script');  wl.async = true;
                        wl.src = 'https://assistant.woorank.com/hydra/assistantLoader.latest.js';
                        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(wl, s);
                    })();
                }
            </script>


{{--            <script >--}}
{{--                            if(navigator.userAgent.indexOf("Chrome-Lighthouse") == -1) {--}}
{{--                window.woorankAssistantOptions = window.woorankAssistantOptions || {};--}}
{{--                window.woorankAssistantOptions.url = 'rawafd-najd.com.sa';--}}
{{--                window.woorankAssistantOptions.assistantPublicKey = '5364d56cd96cc7d562764bc7d7e526a6';--}}
{{--                window.woorankAssistantOptions.collectWebVitals = true;--}}
{{--                (function() {--}}
{{--                    var wl = document.createElement('script');  wl.async = true;--}}
{{--                    wl.src = 'https://assistant.woorank.com/hydra/assistantLoader.latest.js';--}}
{{--                    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(wl, s);--}}
{{--                })();--}}
{{--                            }--}}
{{--            </script>--}}





            <script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "ProfessionalService",
  "name": "روافد نجد للاستقدام",
  "image": "https://www.rawafdnajd.sa/",
  "@id": "https://www.rawafdnajd.sa/",
  "url": "https://www.rawafdnajd.sa/",
  "description": "مكتب روافد نجد للإستقدام العمالة المنزلية في الرياض - المملكة العربية السعودية، يقوم بتقديم خدمات الإستقدام للعمالة المنزلية، اصدار التأشيرات استقدام بأسعار تنافسية وسريع، دعم متكامل في منصة مساند برنامج العمالة المنزلية" ,
  "telephone": "0550061304",
  "address": {
    "@type": "PostalAddress",
    "streetAddress": "طريق الدمام الفرعي، غرناطة",
    "addressLocality": "الرياض",
    "postalCode": "13242",
    "addressCountry": "SA",
    "addressRegion": "Riyadh"
  },
  "priceRange": "$$"
},
  "geo": {
    "@type": "GeoCoordinates",
    "latitude": "24.807378773948404,",
    "longitude": "46.75665397666289"
  },
  "sameAs": [
    "https://twitter.com/rawafdnajd",
    "https://www.instagram.com/rawafdnajd/"
  ],
  "openingHoursSpecification": {
    "@type": "OpeningHoursSpecification",
    "dayOfWeek": [
      "Monday",
      "Tuesday",
      "Wednesday",
      "Thursday",
      "Friday",
      "Saturday",
      "Sunday"
    ],
    "opens": "00:00",
    "closes": "23:59"
  }

</script>
            

            <!-- Bootstrap -->
        @if(\App\Models\Language::where('code', Session::get('locale', Config::get('app.locale')))->first()->rtl == 1)
            <link rel="stylesheet" href="{{ static_asset('v3_assets/css/bootstrap.rtl.min.css') }}">
            @else
                <link rel="stylesheet" href="{{ static_asset('v3_assets/css/bootstrap.min.css') }}">
            @endif
        <!-- Font Awesome -->
<link rel="stylesheet" href="{{ static_asset('v3_assets/css/fontawesome.min.css') }}">


            <!-- swiper -->
             <!--<link rel="stylesheet" href="{{ static_asset('v3_assets/css/swiper-bundle.min.css') }}">-->
   <link rel="preload" href="{{ static_asset('v3_assets/css/swiper-bundle.min.css') }}" as="style" onload="this.onload=null;this.rel='stylesheet'">
                <noscript><link rel="stylesheet" href="{{ static_asset('v3_assets/css/swiper-bundle.min.css') }}"></noscript>
            <!-- animate -->

        <link rel="stylesheet" href="{{ static_asset('v3_assets/css/animate.min.css') }}">
        
        <link rel="stylesheet" href="{{ static_asset('v3_assets/css/select2.min.css') }}">

            <!-- img gallery -->
             
        <link rel="stylesheet" href="{{ static_asset('v3_assets/css/jquery.fancybox.min.css') }}">
            <!-- toastr -->
    
        <link rel="stylesheet" href="{{ static_asset('v3_assets/css/toastr.min.css') }}">
        <link rel="stylesheet" href="{{ static_asset('v3_assets/css/odometer.min.css') }}">
            <!-- Custom style  -->
            @if(\App\Models\Language::where('code', Session::get('locale', Config::get('app.locale')))->first()->rtl == 1)
            
                <link rel="stylesheet" href="{{ static_asset('v3_assets/css/style.css') }}">
            @else
                <link rel="stylesheet" href="{{ static_asset('v3_assets/css/styleEN.css') }}">
            @endif

            @yield('style')
            @php
                echo get_setting('header_script');
            @endphp

            <link rel="canonical" href="{{Request::fullUrl() }}" />

{{--<script>--}}
{{--    (function(){--}}
{{--        var script = documnet.createElement('script')--}}
{{--        script.id = 'a7d9b0a4-6049-4148'--}}

{{--    )--}}
{{--    })--}}
{{--</script>--}}


        </head>

        <body>


        <style>
            @media (max-width: 768px) {
                .logs_m {
                    padding: 70px 15px 45px !important ;
                }
            }
        </style>
        @if(Request::url()!=route('select_staff_whatsapp'))

            <script type="text/javascript" id="zsiqchat">var $zoho=$zoho || {};$zoho.salesiq = $zoho.salesiq || {widgetcode: "9bb46bf8f27654c0c55a16e33a04912a0028b7f02ecbdd206459c2d572f1a780", values:{},ready:function(){}};var d=document;s=d.createElement("script");s.type="text/javascript";s.id="zsiqscript";s.defer=true;s.src="https://salesiq.zoho.com/widget";t=d.getElementsByTagName("script")[0];t.parentNode.insertBefore(s,t);</script>
        @endif
{{--        <!-- Clixtell Tracking Code -->--}}
{{--        <script type='text/javascript'>--}}
{{--            var script=document.createElement('script');--}}
{{--            var prefix=document.location.protocol;--}}
{{--            script.async=true;script.type='text/javascript';--}}
{{--            var target=prefix + '//scripts.clixtell.com/track.js';--}}
{{--            script.src=target;var elem=document.head;--}}
{{--            elem.appendChild(script);--}}
{{--        </script>--}}
        <!-- Google Tag Manager (noscript) -->
        <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-N2FZWKC"
                          height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
        <!-- End Google Tag Manager (noscript) -->


        <img style="display:none" alt="facebook"
             src="https://www.facebook.com/tr?id=397276135708327&ev=PageView&noscript=1"
        />
       
       <!--<script>-->
       <!--    document.addEventListener('contextmenu', event => event.preventDefault());-->
       <!--</script>-->

       

        <!-- ================ Header ================= -->
        <div class="sticky-top">

            @include('frontend.inc.nav')
            @include('flash::message')
        </div>
        <!-- ================ /Header ================= -->
        <!--(((((((((((((((((((((((()))))))))))))))))))))))-->
        <!--((((((((((((((((((( content )))))))))))))))))))-->
        <!--(((((((((((((((((((((((()))))))))))))))))))))))-->
        @yield('content')
        <!--(((((((((((((((((((((((()))))))))))))))))))))))-->
        <!--((((((((((((((((( / content )))))))))))))))))))-->
        <!--(((((((((((((((((((((((()))))))))))))))))))))))-->
        <!-- ================ Footer ================= -->
        <!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog"  aria-hidden="true">
            <div class="modal-dialog" role="document" style="    max-width: 1000px;
      margin: 30px auto;">
                <div class="modal-content">


                    <div class="modal-body">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></span>
                        </button>
                        <!-- 16:9 aspect ratio -->
                        <div class="ratio ratio-16x9">
                            <iframe class="embed-responsive-item"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                    allowfullscreen="" id="video"  ></iframe>
                        </div>


                    </div>

                </div>
            </div>
        </div>

            @include('frontend.inc.footer')

        <!-- ================ /Footer ================= -->
        <!--////////////////////////////////////////////////////////////////////////////////-->
        <!--////////////////////////////////////////////////////////////////////////////////-->
        <!--////////////////////////////////////////////////////////////////////////////////-->
        <!--/////////////////////////////JavaScript/////////////////////////////////////////-->
        <!--////////////////////////////////////////////////////////////////////////////////-->
        <!--////////////////////////////////////////////////////////////////////////////////-->
        <!--////////////////////////////////////////////////////////////////////////////////-->
        <script src="{{ static_asset('v3_assets/js/jquery.min.js') }}"></script>
        <script src="{{ static_asset('v3_assets/js/bootstrap.min.js') }}"></script>
        <script src="{{ static_asset('v3_assets/js/popper.min.js') }}"></script>
        <script src="{{ static_asset('v3_assets/js/jquery.appear.js') }}"></script>
        <script src="{{ static_asset('v3_assets/js/wow.js') }}"></script>
        <script  src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/8.3.2/swiper-bundle.min.js"></script>
<!--<script src="{{ static_asset('v3_assets/js/swiper-bundle.min.js') }}"></script>-->
        <script defer src="{{ static_asset('v3_assets/js/select2.min.js') }}"></script>
        <script defer src="{{ static_asset('v3_assets/js/jquery.fancybox.min.js') }}"></script>
        <script defer src="{{ static_asset('v3_assets/js/toastr.min.js') }}"></script>
        <script  defer src="{{ static_asset('v3_assets/js/odometer.min.js') }}" ></script>
        <script src="{{ static_asset('v3_assets/js/Custom.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.lazyload/1.9.1/jquery.lazyload.min.js"></script>

        @yield('script')

        <script>
            $(document).ready(function() {

                    $(".lazyimgs").lazyload();
// Gets the video src from the data-src on each button

                var $videoSrc;


                $('.divButton').click(function() {
                    $videoSrc = $('.video-btn').data( "src") ;
                    $('#myModal').modal('toggle');


                });
                $('.video-btn').click(function() {
                    $videoSrc = $(this).data( "src" );
                });



// when the modal is opened autoplay it
                $('#myModal').on('shown.bs.modal', function (e) {

// set the video src to autoplay and not to show related video. Youtube related video is like a box of chocolates... you never know what you're gonna get
                    $("#video").attr('src',$videoSrc + "?autoplay=1&amp;modestbranding=1&amp;showinfo=0" );
                })



// stop playing the youtube video when I close the modal
                $('#myModal').on('hide.bs.modal', function (e) {
                    // a poor man's stop video
                    $("#video").attr('src','');
                })






// document ready
            });



            // toastr.success(" مرحبا بك في روافد نجد ");
            // toastr.warning(" مرحبا بك في روافد نجد ");
            // toastr.info(" مرحبا بك في روافد نجد ");
            // toastr.error(" مرحبا بك في روافد نجد ");
        </script>
        <script>
            function goBack() {
                window.history.back();
            };
            function change_lang_new(locale) {
                console.log(locale);
                $.post('{{ route('language.change') }}',{_token: '{{ csrf_token() }}', locale:locale}, function(data){
                    window.location.href=data;

                });
            }
            $(document).ready(function () {
                $('.supportBtnToggle').click(function () {
                    $('.links').slideToggle(300);
                });


                setTimeout(function(){
                    $("div.alert").remove();
                }, 5000 ); // 5 secs
            });

        </script>
        <!-- Google Tag Manager (noscript) -->
      


        </body>

        </html>