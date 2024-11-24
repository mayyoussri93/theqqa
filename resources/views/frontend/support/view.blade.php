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
    <!-- ================  for seo =================-->
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
    <!-- Main Banner  -->
    <section class="mainBanner">
        <button onclick="goBack()" class="Back">
            <i class="fas fa-angle-left"></i>
        </button>
        <ul>
            <li>
                <a href="{{ route('home') }}"> {{translate('الرئيسية')}} </a>
            </li>
            <li>
                <a href="{{route('frontend.get-started')}}" class="active">  {{translate('مركز المساعدة')}}</a>
            </li>

            <li>
                <a href="#" class="active">{{translate($feq_ques->main_name)}}   </a>
            </li>
        </ul>
        <figure>
            <svg xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none" x="0px" y="0px" viewBox="0 0 300 100"
                 style="margin-bottom:-35px;enable-background:new 0 0 300 100" class="injected-svg js-svg-injector"
                 data-parent="#SVGwave1BottomSMShape">
                <g>
                    <path class="wave-bottom-1-sm-0" fill="#fdfdfd" opacity=".8"
                          d="M10.9,63.9c0,0,42.9-34.5,87.5-14.2c77.3,35.1,113.3-2,146.6-4.7C293.7,41,315,61.2,315,61.2v54.4H10.9V63.9z">
                    </path>
                    <path class="wave-bottom-1-sm-0" fill="#fdfdfd" opacity=".6"
                          d="M-55.7,64.6c0,0,42.9-34.5,87.5-14.2c77.3,35.1,113.3-2,146.6-4.7c48.7-4.1,69.9,16.2,69.9,16.2v54.4H-55.7     V64.6z">
                    </path>
                    <path class="wave-bottom-1-sm-0 " fill="#fdfdfd" opacity=".4" fill-opacity="0"
                          d="M23.4,118.3c0,0,48.3-68.9,109.1-68.9c65.9,0,98,67.9,98,67.9v3.7H22.4L23.4,118.3z"></path>
                    <path class="wave-bottom-1-sm-0" fill="#fdfdfd"
                          d="M-54.7,83c0,0,56-45.7,120.3-27.8c81.8,22.7,111.4,6.2,146.6-4.7c53.1-16.4,104,36.9,104,36.9l1.3,36.7l-372-3     L-54.7,83z">
                    </path>
                </g>
            </svg>
        </figure>
    </section>
    <!-- ================ topics ================= -->
    <section class="topics">
        <div class="container">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-9 p-2">
                        <h3> {{translate($feq_ques->alt_name)}}</h3>
                         @if(!empty($feq_ques->video)&& $feq_ques->video!= "..")
                            <iframe src="{{$feq_ques->video}}" ></iframe>
                         @endif
                        {!! $feq_ques->details !!}
                    </div>
                </div>
            </div>

        </div>
    </section>


@endsection

@section('script')
    <script type="text/javascript">
        function useful_button(url)
        {
            // $("#useful_button").css('background', 'transparent')
            // #125D50
            $("#useful_button").addClass(" main-btn");
            $("#un_useful_button").removeClass("main-btn")

            $.ajax({
                url: url,
                type: 'GET',
                data: {_token: '{{ @csrf_token() }}'},
                success: function (data) {
                    console.log(data.error)
                    if ($.isEmptyObject(data.error)) {
                        AIZ.plugins.notify('success', data.success);

                    } else {
                        printErrorMsg(data.error);
                    }
                }
            });
        }

        function un_useful_button(url)
        {
            // $("#un_useful_button").css('background', '#125D50')

            $("#un_useful_button").addClass("main-btn");
            $("#useful_button").removeClass("main-btn")
            $.ajax({
                url: url,
                type: 'GET',
                data: {_token: '{{ @csrf_token() }}'},
                success: function (data) {
                    console.log(data.error)
                    if ($.isEmptyObject(data.error)) {
                        AIZ.plugins.notify('success', data.success);

                    } else {
                        printErrorMsg(data.error);
                    }
                }
            });
        }
    </script>
@endsection
