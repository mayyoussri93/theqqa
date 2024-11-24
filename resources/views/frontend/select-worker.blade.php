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
    <!-- ================ select worker ================= -->
    <section class="selectWorker">
        <div class="container">
            <h1 class="wow fadeInUp"> {{translate(get_setting('arrive_select_title_1'))}} </h1>
            <h4 class="wow fadeInUp">
                {{translate(get_setting('arrive_select_description_1'))}}
            </h4>
        </div>
    </section>
    <!-- ================ /select worker ================= -->

    <section class="mainBanner logs_m" style="background-image:none;     padding: 30px 100px 10px;">
        <button onclick="goBack()" class="Back">
            <i class="fas fa-angle-left"></i>
        </button>
        <ul style="color: #A505A">
            <li style="color: #A505A">
                <a href="{{ route('home') }}" style="color: #A505A"> {{translate('الرئيسية')}} </a>
            </li>
            <li style="color: #A505A">
                <a href="{{ route('home') }}" style="color: #A505A"> {{translate('خدمتنا')}} </a>
            </li>
            <li style="color: #A505A">
                <a href="{{url()->current()}}" class="active"  style="color: #A505A">  {{translate('اختيار العمالة')}} </a>
            </li>
        </ul>
    </section>
    <!-- ================ available ================= -->
    <section class="available">
        <div class="container">
            <h4 class="wow fadeInUp">{{translate(get_setting('arrive_select_title_3'))}}</h4>
            <div class="row flex-wrap">
                @if (get_setting('arrive_select_roles_images') != null)
                    @foreach (json_decode(get_setting('arrive_select_roles_images'), true) as $key => $value)
                        <div class="col p-2">
                            <div class="specifications wow fadeInUp">
                                <i class="fa-duotone @if($key==0) fa-briefcase @elseif($key==1) fa-flag @elseif($key==2) fa-hourglass @elseif($key==3) fa-rings-wedding @endif"></i>
                                <h5>
                                    {{ translate(json_decode(get_setting('arrive_select_roles_title'), true)[$key]) }}
                                </h5>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </section>
    <!-- ================ /available ================= -->

    <!-- ================ /arrive Worker ================= -->
    <div class="arriveWorker">
        <div class="container">
            <!-- arrive Worker Info -->
            <div class="arriveWorkerInfo">
                <div class="image wow fadeInUp">
                    <img src="{{uploaded_asset(get_setting('arrive_select_image_2'))}}" alt=" {{translate(get_setting('arrive_select_description_2'))}}">
                </div>
                <div class="info wow fadeInUp">
                    <p>
                        {{translate(get_setting('arrive_select_description_2'))}}

                    </p>
                    <a class="defaultBtn " href="{{route(get_setting('arrive_select_link_2'))}}"><span></span>   {{translate('أبدا الاستقدام')}} <i class="fa-regular fa-left-long ms-2"></i> </a>
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
                                <img src="{{ uploaded_asset($val->image) }}" alt="{{ env('APP_NAME') }}">
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </section>
@endsection
