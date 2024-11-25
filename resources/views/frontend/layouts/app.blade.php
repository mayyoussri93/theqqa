<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">

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
    <!-- Favicon -->
    <title>@yield('meta_title', get_setting('meta_title')) </title>
    <!-- favicon -->
    <link rel="icon" type="image/x-icon" href="{{ uploaded_asset(get_setting('site_icon')) }}">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500&family=Roboto:wght@500;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ static_asset('front_asset/lib/animate/animate.min.css') }}" rel="stylesheet">
    <link href="{{ static_asset('front_asset/lib/owlcarousel/assets/owl.carousel.min.css')}}" rel="stylesheet">
    <link href="{{ static_asset('front_asset/lib/lightbox/css/lightbox.min.css')}}" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ static_asset('front_asset/css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ static_asset('front_asset/css/style.css')}}" rel="stylesheet">

    <!-- Toastr -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <!-- Styles -->
<style>
    .googleMap iframe{
        width: -webkit-fill-available;
        height: 300px;
    }
</style>
</head>

<body>
<!-- Spinner Start -->
{{--<div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">--}}
{{--    <div class="spinner-border text-primary" role="status" style="width: 3rem; height: 3rem;"></div>--}}
{{--</div>--}}
<!-- Spinner End -->


<!-- Topbar Start -->
<div class="container-fluid bg-primary text-white d-none d-lg-flex"  style="background-image: linear-gradient(4deg, #2A505A, #2A505A);">
    <div class="container py-3">
        <div class="d-flex align-items-center">
            <a href="/">
                <img class="w-100" src="{{uploaded_asset(get_setting('header_logo'))}}" height="40px" alt="Image">

            </a>
            <div class="ms-auto d-flex align-items-center">
                <small class="ms-4"><i class="fa fa-map-marker-alt me-3"></i>{{translate( get_setting('contact_address')) }}
                </small>
                <small class="ms-4"><i class="fa fa-envelope me-3"></i>
                    <a href="{{'mailto:'.get_setting('contact_email')}}">
                        {{get_setting('contact_email')}}
                    </a></small>
                <small class="ms-4"><i class="fa fa-phone-alt me-3"></i><a href="{{ 'tel:'.get_setting('contact_phone_1') }}"> {{ get_setting('contact_phone_1') }} </a></small>
                <div class="ms-3 d-flex">
                    @if ( get_setting('facebook_link') !=  null )
                        <a class="btn btn-sm-square btn-light text-primary rounded-circle ms-2" href="{{ get_setting('facebook_link') }}"><i class="fab fa-facebook-f"></i></a>

                    @endif
                        @if ( get_setting('youtube_link') !=  null )
                            <a class="btn btn-sm-square btn-light text-primary rounded-circle ms-2" href="{{get_setting('youtube_link')}}}"><i class="fab fa-youtube"></i></a>
                        @endif
                        @if ( get_setting('linkedin_link') !=  null )
                            <a class="btn btn-sm-square btn-light text-primary rounded-circle ms-2" href="{{get_setting('linkedin_link') }}"><i class="fab fa-linkedin-in"></i></a>
                        @endif

                </div>
            </div>
        </div>
    </div>
</div>
<!-- Topbar End -->


<!-- Navbar Start -->
<div class="container-fluid bg-white sticky-top">
    <div class="container">
        <nav class="navbar navbar-expand-lg bg-white navbar-light p-lg-0">
            <a href="/" class="navbar-brand d-lg-none">
                <h1 class="fw-bold m-0">GrowMark</h1>
            </a>
            <button type="button" class="navbar-toggler me-0" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav">



                    @if ( get_setting('header_menu_labels_3') !=  null )
                        @foreach (json_decode( get_setting('header_menu_labels_3'), true) as $key => $value)
                            <li>   <a class="nav-item nav-link" href="{{ json_decode( get_setting('header_menu_links_3'), true)[$key] }}">{{translate($value)}} </a> </li>
                        @endforeach
                    @endif

                </div>
                <div class="ms-auto d-none d-lg-block">
                    <a href="{{get_setting('header_key_links_3')}}" class="btn btn-primary rounded-pill py-2 px-3">{{get_setting('header_key_labels_3')}}</a>
                </div>
            </div>
        </nav>
    </div>
</div>
<!-- Navbar End -->


<!-- Carousel Start -->
<div id="section1" class="container-fluid px-0 mb-5">
    <div id="header-carousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
        <div class="carousel-inner">

            @if (get_setting('home_slider_images') != null)
                @foreach ($slider_images as $key => $value)



                    <div class="carousel-item active">
                        <img class="w-100" src="{{ uploaded_asset($slider_images[$key])}}" alt="Image">
                        <div class="carousel-caption">
                            <div class="container">
                                <div class="row justify-content-start">
                                    <div class="col-lg-7 text-start">
                                        <p class="fs-4 text-white animated slideInRight">{{ translate(json_decode(get_setting('home_slider_title_1'), true)[$key]) }}</p>
                                        <h1 class="display-1 text-white mb-4 animated slideInRight">
                                            {{ translate(json_decode(get_setting('home_slider_title_2'), true)[$key]) }}
                                        </h1>
                                        @if(isset(json_decode(get_setting('home_slider_link'), true)[$key]))
                                            <a href="{{ json_decode(get_setting('home_slider_link'), true)[$key] }}"
                                               class="btn btn-primary rounded-pill py-3 px-5 animated slideInRight">
                                                {{ translate(json_decode(get_setting('home_slider_title_link'), true)[$key]) }}
                                                <span></span>
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif

        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#header-carousel"
                data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#header-carousel"
                data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>
<!-- Carousel End -->




<!-- About Start -->
<div id="section2" class="container-xxl about my-5" style="background: {{uploaded_asset(get_setting('home_who_images'))}} !important">
    <div class="container">
        <div class="row g-0">
            <div class="col-lg-6">
                <div class="h-100 d-flex align-items-center justify-content-center" style="min-height: 300px;">
                    <button type="button" class="btn-play" data-bs-toggle="modal"
                            data-src="{{get_setting('home_who_video_link')}}" data-bs-target="#videoModal">
                        <span></span>
                    </button>
                </div>
            </div>
            <div class="col-lg-6 pt-lg-5 wow fadeIn" data-wow-delay="0.5s">
                <div class="bg-white rounded-top p-5 mt-lg-5">
                    <p class="fs-5 fw-medium text-primary">{{ get_setting('home_who_title1') }}</p>
                    <h1 class="display-6 mb-4">
                        {{get_setting('home_who_title2')}}
                    </h1>
                    <p class="mb-4">
{{get_setting('home_who_desc')}}
                    </p>

                    <a class="btn btn-primary rounded-pill py-3 px-5" href="{{get_setting('home_who_button_href')}}">{{get_setting('home_who_button_title')}}</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- About End -->


<!-- Video Modal Start -->
<div class="modal modal-video fade" id="videoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content rounded-0">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLabel">Youtube Video</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- 16:9 aspect ratio -->
                <div class="ratio ratio-16x9">
                    <iframe class="embed-responsive-item" src="" id="video" allowfullscreen allowscriptaccess="always"
                            allow="autoplay"></iframe>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Video Modal End -->


<!-- Service Start -->
<div id="section3" class="container-xxl py-5">
    <div class="container">
        <div class="text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
            <p class="fs-5 fw-medium text-primary">{{get_setting('home_service_title1')}}</p>
            <h1 class="display-5 mb-5">
                {{get_setting('home_service_title2')}}
            </h1>
        </div>
        <div class="row g-4">
            @if(isset($all_brands)&& !empty($all_brands))
                @foreach($all_brands as $key=>$value)

                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="service-item position-relative h-100">
                            <div class="service-text rounded p-5">
                                <div class="btn-square bg-light rounded-circle mx-auto mb-4" style="width: 64px; height: 64px;">
                                    <img class="img-fluid" src="{{uploaded_asset($value->logo)}}" alt="Icon">
                                </div>
                                <h4 class="mb-3">{{translate($value->name)}}</h4>
                                <p class="mb-0">
                                    {{translate( $value->description)}}
                                </p>
                            </div>
{{--                            <div class="service-btn rounded-0 rounded-bottom">--}}
{{--                                <a class="text-primary fw-medium" href="">Read More<i class="bi bi-chevron-double-right ms-2"></i></a>--}}
{{--                            </div>--}}
                        </div>
                    </div>
                @endforeach
            @endif


        </div>
    </div>
</div>
<!-- Service End -->


<!-- Project Start -->
<div id="section4" class="container-xxl pt-5">
    <div class="container">
        <div class="text-center text-md-start pb-5 pb-md-0 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
            <p class="fs-5 fw-medium text-primary">{{ get_setting('home_our_work_title1') }}</p>
            <h1 class="display-5 mb-5">{{ get_setting('home_our_work_title2') }}</h1>
        </div>
        <div class="owl-carousel project-carousel wow fadeInUp" data-wow-delay="0.1s">

            @if (get_setting('home_banner1_images') != null)
                @foreach (json_decode(get_setting('home_banner1_images'), true) as $key => $value)
                    <div class="project-item mb-5">
                        <div class="position-relative">
                            <img class="img-fluid" src="{{uploaded_asset($value)}}" alt="">
                            <div class="project-overlay">
                                <a class="btn btn-lg-square btn-light rounded-circle m-1" href="{{uploaded_asset($value)}}" data-lightbox="project"><i class="fa fa-eye"></i></a>
                                <a class="btn btn-lg-square btn-light rounded-circle m-1" href="/"><i class="fa fa-link"></i></a>
                            </div>
                        </div>
                        <div class="p-4">
                            <a class="d-block h5" href="">
                                {{ translate(json_decode(get_setting('home_banner1_title'), true)[$key]) }}
                            </a>
                            <span>
                                {{ translate(json_decode(get_setting('home_banner1_dec'), true)[$key])}}
</span>
                        </div>
                    </div>
                @endforeach
            @endif

        </div>
    </div>
</div>
<!-- Project End -->


<!-- Quote Start -->
<div id="section5" class="container-xxl py-5">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                <p class="fs-5 fw-medium text-primary">تواصل معنا</p>
                <h1 class="display-5 mb-4"> نحن هنا لنسبق الخيال</h1>
                <p class="mb-4">
                    نفكّر وننفذ باحترافية ومهنية عالية، نحول أحلامك إلى واقع يبهر الجميع، ونطبق معايير عالمية في خدماتنا التي نقدمها لك.
                </p>
                <a class="d-inline-flex align-items-center rounded overflow-hidden border border-primary" href="{{ 'tel:'.get_setting('contact_phone_1') }}">
                        <span class="btn-lg-square bg-primary" style="width: 55px; height: 55px;">
                            <i class="fa fa-phone-alt text-white"></i>
                        </span>
                    <span class="fs-5 fw-medium mx-4">  {{ get_setting('contact_phone_1') }} </span>
                </a>
            </div>
            <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.5s">
                <h2 class="mb-4">تواصل معنا الان</h2>
                <div class="row g-3">
                    <div class="col-sm-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="contact_name" name="name" placeholder="Your Name">
                            <label for="name">اسمك</label>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" name="phone" id="contact_phone" placeholder="Your Mobile">
                            <label for="mobile">الهاتف</label>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-floating">
                            <textarea class="form-control" id="contact_massage" name="massage" rows="5" required></textarea>
                            <label for="message">رسالتك</label>
                        </div>
                    </div>
                    <div class="col-12 text-center">
                        <button class="btn btn-primary w-100 py-3 defaultBtn bttn-submit"  type="submit">تواصل الان</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Quote Start -->


<!-- Team Start -->
<!--    <div class="container-xxl py-5">-->
<!--        <div class="container">-->
<!--            <div class="text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">-->
<!--                <p class="fs-5 fw-medium text-primary">Our Team</p>-->
<!--                <h1 class="display-5 mb-5">Our Expert People Ready to Help You</h1>-->
<!--            </div>-->
<!--            <div class="row g-4">-->
<!--                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">-->
<!--                    <div class="team-item rounded overflow-hidden pb-4">-->
<!--                        <img class="img-fluid mb-4" src="img/team-1.jpg" alt="">-->
<!--                        <h5>Alex Robin</h5>-->
<!--                        <span class="text-primary">Founder & CEO</span>-->
<!--                        <ul class="team-social">-->
<!--                            <li><a class="btn btn-square" href=""><i class="fab fa-facebook-f"></i></a></li>-->
<!--                            <li><a class="btn btn-square" href=""><i class="fab fa-twitter"></i></a></li>-->
<!--                            <li><a class="btn btn-square" href=""><i class="fab fa-instagram"></i></a></li>-->
<!--                            <li><a class="btn btn-square" href=""><i class="fab fa-linkedin-in"></i></a></li>-->
<!--                        </ul>-->
<!--                    </div>-->
<!--                </div>-->
<!--                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.3s">-->
<!--                    <div class="team-item rounded overflow-hidden pb-4">-->
<!--                        <img class="img-fluid mb-4" src="img/team-2.jpg" alt="">-->
<!--                        <h5>Adam Crew</h5>-->
<!--                        <span class="text-primary">Co Founder</span>-->
<!--                        <ul class="team-social">-->
<!--                            <li><a class="btn btn-square" href=""><i class="fab fa-facebook-f"></i></a></li>-->
<!--                            <li><a class="btn btn-square" href=""><i class="fab fa-twitter"></i></a></li>-->
<!--                            <li><a class="btn btn-square" href=""><i class="fab fa-instagram"></i></a></li>-->
<!--                            <li><a class="btn btn-square" href=""><i class="fab fa-linkedin-in"></i></a></li>-->
<!--                        </ul>-->
<!--                    </div>-->
<!--                </div>-->
<!--                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.5s">-->
<!--                    <div class="team-item rounded overflow-hidden pb-4">-->
<!--                        <img class="img-fluid mb-4" src="img/team-3.jpg" alt="">-->
<!--                        <h5>Boris Johnson</h5>-->
<!--                        <span class="text-primary">Executive Manager</span>-->
<!--                        <ul class="team-social">-->
<!--                            <li><a class="btn btn-square" href=""><i class="fab fa-facebook-f"></i></a></li>-->
<!--                            <li><a class="btn btn-square" href=""><i class="fab fa-twitter"></i></a></li>-->
<!--                            <li><a class="btn btn-square" href=""><i class="fab fa-instagram"></i></a></li>-->
<!--                            <li><a class="btn btn-square" href=""><i class="fab fa-linkedin-in"></i></a></li>-->
<!--                        </ul>-->
<!--                    </div>-->
<!--                </div>-->
<!--                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.7s">-->
<!--                    <div class="team-item rounded overflow-hidden pb-4">-->
<!--                        <img class="img-fluid mb-4" src="img/team-4.jpg" alt="">-->
<!--                        <h5>Robert Jordan</h5>-->
<!--                        <span class="text-primary">Digital Marketer</span>-->
<!--                        <ul class="team-social">-->
<!--                            <li><a class="btn btn-square" href=""><i class="fab fa-facebook-f"></i></a></li>-->
<!--                            <li><a class="btn btn-square" href=""><i class="fab fa-twitter"></i></a></li>-->
<!--                            <li><a class="btn btn-square" href=""><i class="fab fa-instagram"></i></a></li>-->
<!--                            <li><a class="btn btn-square" href=""><i class="fab fa-linkedin-in"></i></a></li>-->
<!--                        </ul>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!-- Team End -->


<!-- Testimonial Start -->
<div id="section6" class="container-xxl pt-5">
    <div class="container">
        <div class="text-center text-md-start pb-5 pb-md-0 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
            <p class="fs-5 fw-medium text-primary">{{ get_setting('home_our_client_title1') }}</p>
            <h1 class="display-5 mb-5">{{ get_setting('home_our_client_title2') }}</h1>
        </div>
        <div class="owl-carousel testimonial-carousel wow fadeInUp" data-wow-delay="0.1s">
            @if (get_setting('home_our_client_images') != null)
                @foreach (json_decode(get_setting('home_our_client_images'), true) as $key => $value)
            <div class="testimonial-item rounded p-4 p-lg-5 mb-5">
                <img class="mb-4" src="{{uploaded_asset(json_decode(get_setting('home_our_client_images'), true)[$key]) }}" alt="">
                <p class="mb-4">{{ json_decode(get_setting('home_our_client_dec'), true)[$key] }}</p>
                <span class="text-primary">{{ json_decode(get_setting('home_our_client_title'), true)[$key] }}</span>
            </div>
                @endforeach
            @endif

        </div>
    </div>
</div>
<div  class="container-xxl pt-5">
    <div class="container">
<!-- Testimonial End -->
<section class="googleMap ">
    {!! get_setting('our_location') !!}

{{--    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d57946.84623396069!2d46.75688!3d24.806481!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xc74fdd6f15256594!2z2YXZg9iq2Kgg2LHZiNin2YHYryDZhtis2K8g2YTZhNil2LPYqtmC2K_Yp9mF!5e0!3m2!1sar!2ssa!4v1650724949947!5m2!1sar!2ssa" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0" loading="lazy" referrerpolicy="no-referrer-when-downgrade"> </iframe>--}}
</section>

    </div>
</div>
<!-- Footer Start -->
<div class="container-fluid bg-dark footer mt-5 py-5 wow fadeIn" data-wow-delay="0.1s" style="background-image: linear-gradient(4deg, #2A505A, #5f4092), url(../digital-marketing-html-template/img/footerthem.png);">
    <div class="container py-5">
        <div class="row g-5">
            <div class="col-lg-3 col-md-6">
                <h4 class="text-white mb-4"></h4>
                <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>{{translate( get_setting('contact_address')) }}</p>
                <p class="mb-2"><i class="fa fa-phone-alt me-3"></i> <a href="{{ 'tel:'.get_setting('contact_by_phone') }}"> {{ get_setting('contact_by_phone') }} </a></p>
                <p class="mb-2"><i class="fa fa-envelope me-3"></i>    <a href="{{'mailto:'.get_setting('contact_email')}}">
                        {{get_setting('contact_email')}}
                    </a></p>
                <div class="d-flex pt-3">
                    @if ( get_setting('twitter_link') !=  null )
                    <a class="btn btn-square btn-light rounded-circle me-2" href="{{ get_setting('twitter_link') }}"><i class="fab fa-twitter"></i></a>
                    @endif
                    @if ( get_setting('facebook_link') !=  null )
                    <a class="btn btn-square btn-light rounded-circle me-2" href="{{ get_setting('facebook_link') }}"><i class="fab fa-facebook-f"></i></a>
                    @endif
                        @if ( get_setting('youtube_link') !=  null )
                    <a class="btn btn-square btn-light rounded-circle me-2" href="{{ get_setting('youtube_link') }}"><i class="fab fa-youtube"></i></a>
                        @endif
                        @if ( get_setting('linkedin_link') !=  null )
                    <a class="btn btn-square btn-light rounded-circle me-2" href="{{get_setting('linkedin_link') }}"><i class="fab fa-linkedin-in"></i></a>
                        @endif
                        @if ( get_setting('snap_link') !=  null )
                            <a class="btn btn-square btn-light rounded-circle me-2" href="{{get_setting('snap_link') }}"><i class="fab fa-snapchat"></i></a>
                        @endif
                        @if ( get_setting('tiktok_link') !=  null )
                            <a class="btn btn-square btn-light rounded-circle me-2" href="  {{ get_setting('tiktok_link')}}"><i class="fab fa-tiktok"></i></a>
                        @endif

                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                @if ( get_setting('widget_one_labels') !=  null )
                <h4 class="text-white mb-4">روابط سريعة</h4>
                    @foreach (json_decode( get_setting('widget_one_labels'), true) as $key => $value)
                            <a class="btn btn-link" href="{{ json_decode( get_setting('widget_one_links'), true)[$key] }}">
                                {{ translate($value) }}
                            </a>
                    @endforeach
                @endif
            </div>
            <div class="col-lg-6 col-md-12">

                <h4 class="text-white mb-4">اشترك بالنشرة البريدية</h4>
                <div class="position-relative w-100">

                    <form class="form-horizontal  needs-validation" novalidate method="POST" action="{{ route('subscribers.store') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input class="form-control bg-transparent w-100 py-3 ps-4 pe-5" type="email" name="email" required placeholder="Your email">
                    <button type="submit" class="btn btn-light py-2 position-absolute top-0 end-0 mt-2 me-2">اشترك الان</button>

                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
<!-- Footer End -->





<!-- Back to Top -->
<a href="#section1" class="btn btn-lg btn-primary btn-lg-square rounded-circle back-to-top"><i class="bi bi-arrow-up"></i></a>


<!-- JavaScript Libraries -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ static_asset('front_asset/lib/wow/wow.min.js')}}"></script>
<script src="{{ static_asset('front_asset/lib/easing/easing.min.js')}}"></script>
<script src="{{ static_asset('front_asset/lib/waypoints/waypoints.min.js')}}"></script>
<script src="{{ static_asset('front_asset/lib/owlcarousel/owl.carousel.min.js')}}"></script>
<script src="{{ static_asset('front_asset/lib/lightbox/js/lightbox.min.js')}}"></script>
<!-- Template Javascript -->
<script src="{{ static_asset('front_asset/js/main.js')}}"></script>
<script>
    $(document).ready(function() {
        toastr.options = {
            'closeButton': true,
            'debug': false,
            'newestOnTop': false,
            'progressBar': false,
            'positionClass': 'toast-top-right',
            'preventDuplicates': false,
            'showDuration': '1000',
            'hideDuration': '1000',
            'timeOut': '5000',
            'extendedTimeOut': '1000',
            'showEasing': 'swing',
            'hideEasing': 'linear',
            'showMethod': 'fadeIn',
            'hideMethod': 'fadeOut',
        }
    });
    $(document).ready(function () {
        $(".bttn-submit").click(function (e) {
            e.preventDefault();

            var _token = '{{ @csrf_token() }}';
            var name = $("#contact_name").val();
            var email = '';
            var phone = $("#contact_phone").val();
            var subject = $("#contact_subject").val();
            var massage = $("#contact_massage").val();
            $.ajax({
                url: "{{route('contact_us_send')}}",
                type: 'POST',
                data: {_token: _token, email: email, name: name, phone: phone, massage: massage, subject: subject},
                success: function (data) {
                    console.log(data.error)
                    if ($.isEmptyObject(data.error)) {
                        $("#contact_name").val('');
                        $("#contact_phone").val('');
                        $("#contact_massage").val('');
                        $('.invalid-feedback').hide();
                        $("html, body").animate({
                            scrollTop: 0
                        }, 1000);
                        toastr.success(data.success);
                    } else {
                        printErrorMsg(data.error);

                    }
                }
            });
        });

        function printErrorMsg(msg) {
            $('.invalid-feedback').show();
            $.each(msg, function (key, value) {
                console.log(key);
                $('.' + key + '_err').text(value);
            });
        }
    });

</script>
</body>

</html>