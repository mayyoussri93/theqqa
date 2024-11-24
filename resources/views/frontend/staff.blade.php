
@php use Carbon\Carbon; @endphp
@php use Illuminate\Support\Facades\Cache; @endphp
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
    <section class="section reqruitment-request-steps">

        <h1 style="display: none">{{get_seo_h1_setting(request()->path())}} </h1>

        <div class="container">
            <div class="headTitle text-start wow fadeInUp">
                <h2>{{translate('خدمة العملاء والمبيعات')}} </h2>
                <p> {{translate('يمكنك التواصل مع طاقمنا المميز بكل سهولة ويسر')}} </p>
            </div>
            <div class="row gap-4 justify-content-center">

                <div class="col-lg-3 col-md-6 col-12 p-4">
                    <div class="icon">
                        <img alt="{{request()->path()}}"src="{{static_asset('v3_assets/img/cust_1.png') }}" >
                    </div>
                    <h3> {{translate('الرقم المجاني')}}</h3>
                    {{--                        <div class="row">--}}
                    {{--                            <div class="icon_wh">--}}
                    {{--                                <a  href="{{$link_wh}}">--}}
                    {{--                                    <button >--}}
                    {{--                                        <img  src="{{static_asset('v3_assets/img/wh_icon.png') }}" >--}}
                    {{--                                    </button>--}}
                    {{--                                </a>--}}
                    {{--                            </div>--}}
                    <div class="icon_wh">
                        <a  href="tel:8003030309">
                            <button >
                                <img  alt="{{request()->path()}}" src="{{static_asset('v3_assets/img/call_icon.png') }}" >
                            </button>
                        </a>
                    </div>
                </div>

                @foreach($staffs as $key=>$val)
                    @if(!empty($val->user))
                        @if($val->role_id==4 &&$val->is_apper==1)

                            <?php
                            $whats  = preg_replace('/[^0-9]/', '',  $val->user->whatsapp_phone);
                            $link_wh='https://api.whatsapp.com/send?phone='.$whats;
                            $link_call='tel:'.$whats;

                            ?>


                        <div class="col-lg-3 col-md-6 col-12 p-4">
                            <div class="icon">
                                <img   alt="{{request()->path()}}" src="{{static_asset('v3_assets/img/cust_1.png') }}" >
                            </div>
                            <h3> {{translate($val->user->name)}}</h3>
                            <div class="row">
                                <div class="icon_wh">
                                    <a  href="{{$link_wh}}">
                                        <button >
                                            <img   alt="{{request()->path()}}" src="{{static_asset('v3_assets/img/wh_icon.png') }}" >
                                        </button>
                                    </a>
                                </div>
                                <div class="icon_wh">
                                    <a  href="{{$link_call}}">
                                        <button >
                                            <img   alt="{{request()->path()}}" src="{{static_asset('v3_assets/img/call_icon.png') }}" >
                                        </button>
                                    </a>
                                </div>
                            </div>

                        </div>
                    @endif
                    @endif
                @endforeach



                    </div>


            </div>

        </div>
    </section>


@endsection
