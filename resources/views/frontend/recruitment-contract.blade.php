@extends('frontend.layouts.app')
@section('meta_title'){{get_seo_title_setting(request()->path())}}  @stop
@section('meta_description'){{get_seo_description_setting(request()->path())}}@stop
@section('meta_keywords'){{get_seo_keys_setting(request()->path())}}@stop

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
    <!-- ================ recruitment contract ================= -->
    <section class="recruitmentContract">
        <div class="container">
            <h1 class="wow fadeInUp"> {{translate(get_setting('recruitment_contract_title_1'))}} </h1>
            <h4 class="wow fadeInUp">
                {{translate(get_setting('recruitment_contract_description_1'))}}

            </h4>
        </div>
    </section>
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
                <a href="{{url()->current()}}" class="active"  style="color: #A505A">  {{translate('تعاقد الإستقدام')}} </a>
            </li>
        </ul>
    </section>

    <!-- ================ /recruitment contract ================= -->

    <!-- ================ /arrive Worker ================= -->
    <div class="arriveWorker">
        <div class="container">
            <!-- arrive Worker Info -->
            <div class="arriveWorkerInfo">
                <div class="image wow fadeInUp">
                    <img src="{{uploaded_asset(get_setting('recruitment_contract_image_2'))}}" alt=" {{translate(get_setting('recruitment_contract_title_1'))}} ">
                </div>
                <div class="info wow fadeInUp">
                    <p>

                        {{translate(get_setting('recruitment_contract_description_2'))}}

                    </p>
                    <a class="defaultBtn " href="{{route(get_setting('recruitment_contract_link_2'))}}"><span></span>   {{translate('أبدا الاستقدام')}} <i class="fa-regular fa-left-long ms-2"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- ================ /happy Clients ================= -->

    <!-- ================ Recruitments ================= -->
    <section class="recruitments">
        <div class="container">
            <div class="headTitle wow fadeInUp">
                <h2>{{translate(' عمليات الاستقدام')}} </h2>
            </div>
            <div class="recruitmentsteps row">
                <!-- recruitment step -->
                @foreach($all_recruitment_steps as $key=>$val)
                    <div class="col-sm-6 col-lg-3 rCol px-2 py-5">
                        <div class="rStep wow fadeInUp ">
                            <span class="num"> {{$key+1}} </span>
                            <h5> {{translate($val->title)}} </h5>
                            <p>    {{translate($val->description)}} </p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>


    <!-- ================ happy Clients ================= -->
    <section class="happyClients">
        <div class="container">
            <div class="row flex-wrap">
                @if (get_setting('recruitment_contract_roles_images') != null)
                    @foreach (json_decode(get_setting('recruitment_contract_roles_images'), true) as $key => $value)

                        <div class="col p-2">
                            <div class="specifications wow fadeInUp">
                                <i class="fa-duotone @if($key==0) fa-stopwatch @elseif($key==1) fa-hexagon-check @elseif($key==2) fa-handshake @endif"></i>
                                <h1 class="odometer" data-count="{{translate(json_decode(get_setting('recruitment_contract_roles_number'), true)[$key]) }}">00</h1>
                                <h5>
                                    {{ translate(json_decode(get_setting('recruitment_contract_roles_title'), true)[$key]) }}
                                </h5>
                            </div>
                        </div>
                    @endforeach
                @endif

            </div>
        </div>
    </section>
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