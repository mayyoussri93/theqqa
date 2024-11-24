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
<style>
    @media (max-width:481px) {
        .selectCustomerService .choose {
            display: block;
        }
        .selectCustomerService .choose .customerOption {
            width:100%!important;
}
    }
</style>
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
    <!-- ================ select Customer Service ================= -->
    <section class="selectCustomerService">
        <div class="container">

            <div class="row justify-content-center">
                <h1 style="display: none">{{get_seo_h1_setting(request()->path())}} </h1>

                <div class="col-lg-8 p-2">
                    <div class="headTitle">
                        <h2>{{translate('اختر احد مندوبي خدمة العملاء')}} </h2>
                        <p>
                            {{translate('يمكنك التواصل مع خدمة العملاء عبر الواتس اب')}}
                        </p>
                    </div>


                            <div class="choose row">
                            @foreach($staffs as $key=>$val)
                                @if(!empty($val->user))

                                            <?php
                                            $whats  = preg_replace('/[^0-9]/', '',  $val->user->whatsapp_phone);
                                            $link='https://api.whatsapp.com/send?phone='.$whats;
                                            ?>
                                    <div  class="customerOption col-md-4 wow fadeInUp">
                                        <input type="radio" class="btn-check" name="staff_name" id="{{'option'.$key}}" value="{{$val->user->id}}" required>
                                        <label class="btn btn-outline" for="{{'option'.$key}}">
                                            <img src="{{ static_asset('v3_assets/img/avater2.webp') }}" alt="{{ env('APP_NAME') }}">
                                            <span>  {{translate($val->user->name)}}</span>
                                            <div class=" pt-4 p-2 text-center">
                                                <a class="defaultBtn" href="{{$link}}">
                                                    <p class="px-5"> {{translate('تواصل الأن')}} </p>
                                                    <span></span>
                                                </a>
                                            </div>
                                        </label>


                                    </div>
                                @endif
                            @endforeach
                        </div>


                </div>
            </div>
        </div>
    </section>
@endsection
@section('script')

    <script>
        window.onload = function () {

            if (typeof history.pushState === "function") {
                history.pushState("jibberish", null, null);
                window.onpopstate = function () {
                    history.pushState('newjibberish', null, null);
                };
            }
            else {
                var ignoreHashChange = true;
                window.onhashchange = function () {
                    if (!ignoreHashChange) {
                        ignoreHashChange = true;
                        window.location.hash = Math.random();
                    }
                    else {
                        ignoreHashChange = false;
                    }
                };
            }
        };


    </script>

@endsection