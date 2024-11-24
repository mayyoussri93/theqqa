@extends('frontend.layouts.app')
@section('meta_title'){{get_seo_title_setting(request()->path())}}  @stop
@section('meta_description'){{get_seo_description_setting(request()->path())}}@stop
@section('meta_keywords')        {{get_seo_keys_setting(request()->path())}}@stop

@section('meta')
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name" content="{{get_seo_title_setting(request()->path())}} ">
    <meta itemprop="description" content="{{get_seo_description_setting(request()->path())}}">

    <!-- Twitter Card data -->



    @section('meta_product_twitter'){{get_seo_title_setting(request()->path())}}  @stop
    @section('meta_title_twitter'){{get_seo_title_setting(request()->path())}}  @stop
    @section('meta_keywords_twitter')   {{get_seo_keys_setting(request()->path())}} @stop
    @section('meta_description_twitter')     {{get_seo_description_setting(request()->path())}} @stop
    @section('meta_creator_twitter')        {{get_seo_title_setting(request()->path())}}  @stop

    <!-- Open Graph data -->
    @section('meta_og_title')        {{get_seo_title_setting(request()->path())}}  @stop
    @section('meta_og_url')      {{Request::fullUrl() }}  @stop
    @section('meta_og_description')        {{get_seo_description_setting(request()->path())}} @stop


@endsection
@section('content')
    <div class="spinner">
        <div class="sk-folding-cube">
            <div class="sk-cube1 sk-cube"></div>
            <div class="sk-cube2 sk-cube"></div>
            <div class="sk-cube4 sk-cube"></div>
            <div class="sk-cube3 sk-cube"></div>
        </div>
    </div>
    <!-- ================ spinner ================= -->
    <section class="mainBanner logs_m" style="background-image:none;     padding: 30px 100px 10px;">
        <button onclick="goBack()" class="Back">
            <i class="fas fa-angle-left"></i>
        </button>
        <ul style="color: #A505A">
            <li style="color: #A505A">
                <a href="{{ route('home') }}" style="color: #A505A"> {{translate('الرئيسية')}} </a>
            </li>

            <li style="color: #A505A">
                <a href="{{url()->current()}}" class="active"  style="color: #A505A">  {{translate('مساند')}} </a>
            </li>
        </ul>
    </section>
    <!-- ================ musaned ================= -->
    <section class="musaned">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 p-2">
                    <div class="intro">
                        <img src="{{ uploaded_asset(get_setting('musaned_logo') ) }}" class="wow fadeInUp" alt="{{get_setting('musaned_title')}}">
                        <h4 class="head wow fadeInUp">{{translate(get_setting('musaned_title'))}}</h4>
                        <p class="info wow fadeInUp">
                            {{translate(get_setting('musaned_description'))}}

                        </p>
                    </div>
                </div>
                <div class="col-md-6 p-2">
                    <div class="introImg">
                        <img src="{{ uploaded_asset(get_setting('musaned_image') ) }}" alt="{{get_setting('musaned_title')}}">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ================ /musaned ================= -->
    <!-- ================ musaned Features ================= -->
    <section class="musanedFeatures">
        <div class="container">
            <div class="musanedServices">
                <div class="headTitle wow fadeInUp">
                    <h2>{{translate('ماذا نقدم')}}</h2>
                    <p>{{translate('خدمات مساند')}}</p>

                </div>
                <iframe src="https://www.youtube.com/embed/wlLjqeDDi2Y"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen=""></iframe>
            </div>
            <div class="Feature">
                <div class="row flex-wrap">
                @if (get_setting('musaned_services_images') != null)
                    @foreach (json_decode(get_setting('musaned_services_images'), true) as $key => $value)
                    <!-- single Feature -->
                    <div class="col p-2 singleFeature wow fadeInUp">
                        <div class="info">
                            <div class="content">
                                <div class="icon">
                                    <i class="fa-solid @if($key==0) fa-badge-check @elseif($key==1) fa-buildings @elseif($key==2) fa-users @endif"></i>
                                </div>
                                <h3>
                                    {{ translate(json_decode(get_setting('musaned_services_titles'), true)[$key]) }}
                                </h3>
                                <p>
                                    {{ translate(json_decode(get_setting('musaned_services_des'), true)[$key]) }}
                                </p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                @endif

                </div>
            </div>
        </div>
    </section>
    <!-- ================ /musaned Features ================= -->
    <!-- ================ musaned recruitment ================= -->
    <section class="musanedRecruitment">
        <div class="container">
            <div class="headTitle wow fadeInUp">
                <h4 class="font-weight-600">{{translate('إنطلاق رحلة')}} </h4>
                <h1> {{translate('الاستقدام مع مساند')}}</h1>
                <p>
                    {{translate(get_setting('musaned_journey_description'))}}

                </p>
            </div>
            <div class="row flex-wrap">
                @if (get_setting('musaned_journey_images') != null)
                    @foreach (json_decode(get_setting('musaned_journey_images'), true) as $key => $value)

                        <div class="col p-2">
                            <div class="specifications wow fadeInUp">
                                <i class="fa-solid @if($key==0) fa-ballot-check @elseif($key==1) fa-briefcase @elseif($key==2) fa-globe @elseif($key==3) fa-globe @endif"></i>
                                <h5>
                                    {{ translate(json_decode(get_setting('musaned_journey_titles'), true)[$key]) }}
                                </h5>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
            <div class="pt-5 mt-5">
                <div class="headTitle wow fadeInUp">
                    <h4 >{{translate('خطوات')}}</h4>
                    <h1> {{translate('الاستقدام مع مساند')}}</h1>
                </div>
                <div class="row flex-wrap">
                @if (get_setting('musaned_steps_images') != null)
                    @foreach (json_decode(get_setting('musaned_steps_images'), true) as $key => $value)

                            <!-- START SINGLE CARD -->

                            <div class="col p-2">
                                <div class="specifications wow fadeInUp">
                                    <i class="fa-solid @if($key ==0) fa-hand-pointer @elseif($key ==1)fa-buildings @elseif($key ==2)fa-file-pen @elseif($key ==3)fa-credit-card @elseif($key ==4) fa-location-crosshairs @endif"></i>
                                    <h5>   {{ translate(json_decode(get_setting('musaned_steps_titles'), true)[$key]) }} </h5>
                                    <p>
                                        {{ translate(json_decode(get_setting('musaned_steps_des'), true)[$key])}}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    @endif

                </div>
            </div>
        </div>
    </section>
    <!-- ================ /musaned recruitment ================= -->
    <!-- ================ musaned Fees ================= -->
    <section class="musanedFees">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-9 p-2">
                    <div class="headTitle wow fadeInUp">
                        <h4> {{translate(get_setting('musaned_fees_title'))}} </h4>
                        <h2>{{translate(' الاستقدام مع مساند')}} </h2>

                    </div>
                    <p>
                        {{translate(get_setting('musaned_fees_description'))}}

                    </p>
                    <div class="images">
                        @foreach(explode(',', get_setting('musaned_fees_logo') )  as $key=>$val)
                            <img src="{{ uploaded_asset($val) }}" alt="{{get_setting('musaned_fees_title')}}">
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ================ /musaned Fees ================= -->
    <!-- ================ musaned app ================= -->
    <section class="musanedApp">
        <div class="container">
            <div class="row">
                <div class="col-md-6 p-0 p-md-2 d-none d-md-block">
                    <div class="appImg">
                        <img src="{{ static_asset('v3_assets/img/app.webp')}}" alt="{{ env('APP_NAME') }}">
                    </div>
                </div>
                <div class="col-md-6 p-2">
                    <div class="info">
                        <img src="{{ static_asset('v3_assets/img/musand.svg')}}" alt="{{ env('APP_NAME') }}">

                        <h4>{{translate(get_setting('musaned_apps_title'))}}</h4>
                        <p>
                            {{translate(get_setting('musaned_apps_description'))}}
                        </p>
                        <div class="appImg d-md-none">
                            <img src="{{ static_asset('v3_assets/img/app.webp')}}" alt="{{ env('APP_NAME') }}">
                        </div>

                        <div class="links">
                            <a href="{{get_setting('musaned_android_link')}}" target="_blank" rel="noopener">

                                <img src="{{ static_asset('v3_assets/img/google-play-android.webp')}}" alt="{{ env('APP_NAME') }}">

                            </a>
                            <a href="{{get_setting('musaned_apple_link')}}" target="_blank" rel="noopener">
                                <img src="{{ static_asset('v2_assets/img/musaned-app-store-apple-iphone-ios.png')}}" alt="{{ env('APP_NAME') }}">

                            </a>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection
