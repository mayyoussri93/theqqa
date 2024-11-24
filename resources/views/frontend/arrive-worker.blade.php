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
    <!-- ================ for seo ================= -->
    <h1 style="display: none">{{get_seo_h1_setting(request()->path())}} </h1>
    <!-- ================  for seo ================= -->

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
                <a href="{{url()->current()}}" class="active"  style="color: #A505A">  {{translate('وصول العمالة')}} </a>
            </li>
        </ul>
    </section>
    <!-- ================ /arrive Worker ================= -->
    <div class="arriveWorker">
        <div class="container">
            <!-- arrive Worker Info -->
            <div class="arriveWorkerInfo">
                <div class="image wow fadeInUp">
                    <img src="{{ uploaded_asset(get_setting('arrive_worker_image_1')) }}" alt=" {{translate(get_setting('arrive_worker_title_1'))}} ">
                </div>
                <div class="info wow fadeInUp">
                    <h3> {{translate(get_setting('arrive_worker_title_1'))}} </h3>
                    <p>
                        {{translate(get_setting('arrive_worker_description_1'))}}
                    </p>
                    <h5>{{translate(get_setting('arrive_worker_info_1'))}} </h5>
                </div>
            </div>
            <!-- arrive Worker Info -->
            <div class="arriveWorkerInfo">
                <div class="image wow fadeInUp">
                    <img src="{{ uploaded_asset(get_setting('arrive_worker_image_2')) }}" alt="{{translate((get_setting('arrive_worker_title_2')))}}">
                </div>
                <div class="info wow fadeInUp">
                    <h3>  {{translate((get_setting('arrive_worker_title_2')))}} </h3>
                    <p>
                        {{translate((get_setting('arrive_worker_description_2')))}}

                    </p>
                </div>
            </div>
        </div>
    </div>
    <!-- ================ references ================= -->
    <section class="references">
        <div class="container">
            <div class="swiper referencesSlider ">
                <div class="swiper-wrapper">
                    @foreach(\App\Models\RecruitmentReference::all() as $key=>$val )
                        <div class="swiper-slide">
                            <div class="referenceLogo ">
                                <img src="{{ uploaded_asset($val->image) }}" alt="{{ env('APP_NAME') }}"  >
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </section>



@endsection
