@extends('frontend.layouts.app')


@section('meta_title'){{translate('اختر احد مندوب خدمة العملاء').'  '.Request::getRequestUri().' .'}}  @stop
@section('meta_description'){{ translate('اختر احد مندوبي خدمة العملاء لنقل الكفالة').'  '.Request::getRequestUri().' .'}}@stop
@section('meta_keywords')       {{translate('اختر احد مندوبي خدمة العملاء')}} @stop

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
   <!-- ================ for seo ================= -->
    <h1 style="display: none">{{translate('مندوبي خدمة العملاء')}}</h1>
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
    <!-- ================ select Customer Service ================= -->
    <section class="selectCustomerService">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 p-2">
                    <div class="headTitle">
                        <h2>{{translate('اختر احد مندوبي خدمة العملاء')}} </h2>
                        <p>
                            {{translate('يرجى اختيار احد ممثلي خدمة العملاء لمواصلة نقل الكفالة')}}
                        </p>
                    </div>

                        <form    @auth action="{{route('request_transfer_sponsorship')}}" method="post"    @else  action="{{route('user.registration')}}"  method="get"   @endauth  class="needs-validation" novalidate >
                            @csrf

                             <input type="hidden" name="cv_sponsorship_id" value="{{$cv_sponsorship_id}}">

                                    <div class="choose row">
                                        @foreach($staffs as $key=>$val)
                                            @if(!empty($val->user))


                                                <div  class="customerOption col-md-4 wow fadeInUp">
                                                    <input type="radio" class="btn-check" name="sponsor_staff_id" id="{{'option'.$key}}" value="{{$val->user->id}}" required>
                                                    <label class="btn btn-outline" for="{{'option'.$key}}">
                                                        <img src="{{ static_asset('v3_assets/img/avater2.webp') }}" alt="{{ env('APP_NAME') }}">
                                                        <span>  {{translate($val->user->name)}}</span>
                                                    </label>
                                                    @if($loop->last)
                                                        <div class="valid-feedback">{{translate('صحيح')}}</div>
                                                        <div class="invalid-feedback">{{translate('يرجي اختيار احد ممثلي خدمة العملاء')}}</div>
                                                    @endif
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                    <div class=" pt-4 p-2 text-center">
                                        <button class="defaultBtn" type="submit">
                                            <p class="px-5"> {{translate('تأكيد')}} </p>
                                            <span></span>
                                        </button>
                                    </div>
                                </form>




{{--                        <div class="choose row">--}}
{{--                            @foreach($staffs as $key=>$val)--}}
{{--                                @if(!empty($val->user))--}}

                                   <?php
                                  // $whats  = preg_replace('/[^0-9]/', '',  $val->user->whatsapp_phone);
                                  ?>
{{--                                    <a href="{{'https://api.whatsapp.com/send?phone='.$whats.'&text='.$passport_id.': اريد نقل الكفالة لرقم جواز السفر '}}" class="customerOption wow fadeInUp col-md-4">--}}
{{--                                        <label class="btn btn-outline" for="{{'option'.$key}}">--}}
{{--                                            <img src="{{ static_asset('v3_assets/img/avater2.webp') }}" alt="{{ env('APP_NAME') }}">--}}
{{--                                            <span>  {{translate($val->user->name)}}</span>--}}
{{--                                        </label>--}}

{{--                                    </a>--}}
{{--                                @endif--}}
{{--                            @endforeach--}}
{{--                        </div>--}}

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
