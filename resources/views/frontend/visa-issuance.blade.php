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
    <!-- ================ spinner ================= -->
    <div class="spinner">
        <div class="sk-folding-cube">
            <div class="sk-cube1 sk-cube"></div>
            <div class="sk-cube2 sk-cube"></div>
            <div class="sk-cube4 sk-cube"></div>
            <div class="sk-cube3 sk-cube"></div>
        </div>
    </div>
    <!-- ================ spinner ================= -->
    <!-- ================ visa ================= -->
    <section class="visa">
        <div class="container">
            <h1 class="wow fadeInUp">{{translate(get_setting('vise_topbar_title'))}}</h1>
            <h4 class="wow fadeInUp">
                {{translate(get_setting('vise_topbar_description'))}}
            </h4>
        </div>

    </section>
    <!-- ================ /visa ================= -->
    <!-- ================ recruitment Visa ================= -->

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
{{--            <li style="color: #A505A">--}}
{{--                <a href="{{url()->current()}}" class="active"  style="color: #A505A">  {{translate('إصدار التأشيرة')}} </a>--}}
{{--            </li>--}}
        </ul>
    </section>
    <section class="recruitmentVisa">

        <div class="container">
            <div class="row">
                <!-- tabs -->
                <div class="col-md-3 col-lg-2 p-2 nav" role="tablist">
                    <!-- button -->
                    <button class="nav-link active" id="newAccount-tab" data-bs-toggle="pill" data-bs-target="#newAccount">
                        <i class="fa-solid fa-user-plus"></i>
                        <p> {{translate(get_setting('vise_topbar_title_type_1'))}} </p>
                    </button>
                    <!-- button -->
                    <button class="nav-link" id="haveAccount-tab" data-bs-toggle="pill" data-bs-target="#haveAccount">
                        <i class="fa-solid fa-user-check"></i>
                        <p>{{translate(get_setting('vise_topbar_title_type_2'))}}</p>
                    </button>
                </div>
                <!-- content -->
                <div class="col-md-9 col-lg-10 p-2 p-md-4  tab-content">
                    <!-- new account -->
                    <div class="tab-pane fade show active" id="newAccount">

                        <h4 class=" secondaryTitle"> {{ translate(get_setting('vise_newuser_title_1')) }} </h4>
                        <h6 class="thirdTitle">{{translate(get_setting('vise_newuser_title_2')) }}
                            <a href="{{ get_setting('vise_newuser_link') }}" target="_blank" rel="noopener">
                                {{translate(get_setting('vise_newuser_link')) }}
                               </a>
                        </h6>
                        <!-- step -->
                        <div class="step">
                            <div class="head">
                                <h5>{{translate(get_setting('vise_newuser_title')) }}</h5>
                            </div>
                            <div class="info">
                                <p>
                                    {{translate(get_setting('vise_newuser_description'))}}
                                </p>
                            </div>
                            <!-- single step -->
                            <div class="secondaryTitle">{{ translate(get_setting('vise_newuser_tab1_1_title')) }}</div>
                            <ul>
                                @if (get_setting('vise_newuser_tab1_1_steps') != null)
                                    @foreach (json_decode( get_setting('vise_newuser_tab1_1_steps'), true) as $key => $value)
                                        <li>{{ translate($value) }}</li>
                                    @endforeach
                                @endif
                            </ul>
                            <div class="info">
                                <p>
                                    {{ translate(get_setting('vise_newuser_tab1_1_info')) }}
                                </p>
                            </div>


                            <!-- single step -->
                            <div class="secondaryTitle">{{ translate(get_setting('vise_newuser_tab1_2_title')) }}</div>
                            <ul>
                                @if (get_setting('vise_newuser_tab1_2_steps') != null)
                                    @foreach (json_decode( get_setting('vise_newuser_tab1_2_steps'), true) as $key => $value)
                                        <li>{{ translate($value) }}</li>
                                    @endforeach
                                @endif
                            </ul>
                            <div class="info">
                                <p>
                                    {{ translate(get_setting('vise_newuser_tab1_2_info')) }}
                                </p>
                            </div>

                        </div>

                        <!-- requirement -->
                        <div class="requirement">
                            <h4 class="secondaryTitle">
                                {{ translate(get_setting('vise_newuser_tab2_title')) }}
                            </h4>
                            <ul>
                                @if (get_setting('vise_newuser_requirements_22') != null)
                                    @foreach (json_decode( get_setting('vise_newuser_requirements_22'), true) as $key => $value)
                                        <li>{{ translate($value)}}</li>
                                    @endforeach
                                @endif
                            </ul>

                        </div>

                        <!-- step -->
                        <div class="step">
                            <div class="head">
                                <h5>
                                    {{ translate(get_setting('vise_newuser_tab3_title')) }}
                                </h5>
                            </div>

                            <ul>
                                @if (get_setting('vise_newuser_tab3_1_steps') != null)
                                    @foreach (json_decode( get_setting('vise_newuser_tab3_1_steps'), true) as $key => $value)
                                        <li>{{ translate($value) }}</li>
                                    @endforeach
                                @endif
                            </ul>
                            <div class="info">
                                <p>
                                    {{ translate(get_setting('vise_newuser_tab3_1_info')) }}
                                </p>
                            </div>

                        </div>
                        <!-- step -->
                        <div class="step">
                            <div class="head">
                                <h5>    {{ translate(get_setting('vise_newuser_tab4_title')) }} </h5>
                            </div>
                            <!-- single step -->
                            <div class="secondaryTitle">
                                {{ translate(get_setting('vise_newuser_tab4_1_title')) }}
                            </div>
                            <ul>
                                @if (get_setting('vise_newuser_tab4_1_steps') != null)
                                    @foreach (json_decode( get_setting('vise_newuser_tab4_1_steps'), true) as $key => $value)
                                        <li>{{ translate($value) }}</li>
                                    @endforeach
                                @endif
                            </ul>
                            <!-- single step -->
                            <div class="secondaryTitle">      {{ translate(get_setting('vise_newuser_tab4_2_title')) }}  </div>
                            <ul>
                                @if (get_setting('vise_newuser_tab4_2_steps') != null)
                                    @foreach (json_decode( get_setting('vise_newuser_tab4_2_steps'), true) as $key => $value)
                                        <li>{{ translate($value) }}</li>
                                    @endforeach
                                @endif
                            </ul>
                            <!-- single step -->
                            <div class="secondaryTitle">
                                {{ translate(get_setting('vise_newuser_tab4_3_title')) }}
                            </div>
                            <ul>
                                @if (get_setting('vise_newuser_tab4_3_steps') != null)
                                    @foreach (json_decode( get_setting('vise_newuser_tab4_3_steps'), true) as $key => $value)
                                        <li>{{translate($value) }}</li>
                                    @endforeach
                                @endif
                            </ul>
                            <div class="info">
                                <p>
                                    {{ translate(get_setting('vise_newuser_tab4_3_info')) }}
                                </p>
                            </div>

                        </div>

                        <h4 class="secondaryTitle">
                            {{ translate(get_setting('vise_newuser_info_1')) }}

                        </h4>

                    </div>
                    <!-- have account -->
                    <div class="tab-pane fade" id="haveAccount">


                        <h4 class=" secondaryTitle"> {{ translate(get_setting('vise_have_acc_title_1')) }} </h4>
                        <h6 class="thirdTitle"> {{ translate(get_setting('vise_have_acc_title_2')) }}
                            <a href="{{ get_setting('vise_have_acc_link') }}" target="_blank" rel="noopener">
                                {{ translate(get_setting('vise_have_acc_link')) }}
                            </a>
                        </h6>

                        <!-- requirement -->
                        <div class="requirement">
                            <h4 class="secondaryTitle">       {{ translate(get_setting('vise_have_acc_tab2_title')) }} </h4>
                            <ul>
                                @if (get_setting('vise_have_acc_requirements_22') != null)
                                    @foreach (json_decode( get_setting('vise_have_acc_requirements_22'), true) as $key => $value)
                                        <li>{{ translate($value) }}</li>
                                    @endforeach
                                @endif
                            </ul>

                        </div>

                        <!-- step -->
                        <div class="step">
                            <div class="head">
                                <h5>
                                    {{translate(get_setting('vise_have_acc_tab3_title')) }}
                                </h5>
                            </div>

                            <ul>
                                @if (get_setting('vise_have_acc_tab3_1_steps') != null)
                                    @foreach (json_decode( get_setting('vise_have_acc_tab3_1_steps'), true) as $key => $value)
                                        <li>{{ translate($value) }}</li>
                                    @endforeach
                                @endif
                            </ul>
                            <div class="info">
                                <p>
                                    {{ translate(get_setting('vise_have_acc_tab3_1_info')) }}
                                </p>
                            </div>

                        </div>
                        <!-- step -->
                        <div class="step">
                            <div class="head">
                                <h5>                             {{ translate(get_setting('vise_have_acc_tab4_title')) }}
                                </h5>
                            </div>
                            <!-- single step -->
                            <div class="secondaryTitle">  {{ translate(get_setting('vise_have_acc_tab4_1_title')) }} </div>
                            <ul>
                                @if (get_setting('vise_have_acc_tab4_1_steps') != null)
                                    @foreach (json_decode( get_setting('vise_have_acc_tab4_1_steps'), true) as $key => $value)
                                        <li>{{ translate($value) }}</li>
                                    @endforeach
                                @endif
                            </ul>
                            <!-- single step -->
                            <div class="secondaryTitle">   {{ translate(get_setting('vise_have_acc_tab4_2_title')) }} </div>
                            <ul>
                                @if (get_setting('vise_have_acc_tab4_2_steps') != null)
                                    @foreach (json_decode( get_setting('vise_have_acc_tab4_2_steps'), true) as $key => $value)
                                        <li>{{ translate($value) }}</li>
                                    @endforeach
                                @endif
                            </ul>
                            <!-- single step -->
                            <div class="secondaryTitle">  {{ translate(get_setting('vise_have_acc_tab4_3_title')) }} </div>
                            <ul>
                                @if (get_setting('vise_have_acc_tab4_3_steps') != null)
                                    @foreach (json_decode( get_setting('vise_have_acc_tab4_3_steps'), true) as $key => $value)
                                        <li>{{ translate($value) }}</li>
                                    @endforeach
                                @endif
                            </ul>
                            <div class="info">
                                <p>
                                    {{ translate(get_setting('vise_have_acc_tab4_3_info')) }}
                                </p>
                            </div>

                        </div>


                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ================ /recruitment Visa ================= -->


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