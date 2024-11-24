@extends('frontend.layouts.app')
<?php
$title_seo=get_seo_title_setting(request()->path()).Request::getRequestUri();
$desc_seo=get_seo_description_setting(request()->path()). json_encode( request()->query());
$keys_seo=get_seo_keys_setting(request()->path());

?>
@section('meta_title'){{$title_seo}}  @stop
@section('meta_description'){{$desc_seo}}@stop
@section('meta_keywords')        {{$desc_seo}}@stop

@section('meta')
    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name" content="{{$title_seo}}">
    <meta itemprop="description" content="{{$desc_seo}}">

@endsection
    <!-- Twitter Card data -->

    @section('meta_product_twitter'){{$title_seo}}  @stop
    @section('meta_title_twitter'){{$title_seo}}  @stop
    @section('meta_keywords_twitter')   {{$desc_seo}} @stop
    @section('meta_description_twitter')     {{$desc_seo}} @stop
    @section('meta_creator_twitter')        {{$title_seo}}  @stop

    <!-- Open Graph data -->
    @section('meta_og_title')        {{$title_seo}}  @stop
    @section('meta_og_url')      {{Request::fullUrl() }}  @stop
    @section('meta_og_description')        {{$desc_seo}} @stop


@section('link')
    <link rel="canonical" href="{{Request::fullUrl() }}" />
@endsection
@section('content')
    <!-- ================ for seo ================= -->
    <h1 style="display: none">{{get_seo_h1_setting(request()->path()).'  '.(Request::query()==[])?(Request::getRequestUri()):Request::query()['page'].' .'}}</h1>
    <!-- ================  for seo ================= -->

    <!-- ================ spinner ================= -->
    <div class="spinner">
        <div class="sk-folding-cube">
            <div class="sk-cube1 sk-cube"></div>
            <div class="sk-cube2 sk-cube"></div>
            <div class="sk-cube4 sk-cube"></div>
            <div class="sk-cube3 sk-cube"></div>
        </div>
    </div>
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
                <a href="{{route('all_cvs')}}" class="active"> {{translate('طلب استقدام')}} </a>
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

    <!-- ================ spinner ================= -->
    <!-- ================ filter ================= -->
    <section class="filter">
        <div class="container">
            <h4 class="px-3"> {{translate('بحث متقدم')}} </h4>
            <form action="" method="GET" class="row align-items-center align-items-md-end">
                <div class="col-sm-10 col-md-8 p-2">
                    <div class="row flex-wrap">
                        <!-- age -->
                        <div class="col p-2">
                            <label for="age"> <i class="fa-duotone fa-hourglass me-1"></i> {{translate('العمر')}} </label>
                            <select id="age" name="age_id" class="select2WithoutSearch">
                                <option value="" selected > {{translate('الكل')}} </option>
                                @foreach (\App\Models\RecruitmentFormAge::get() as $key => $value)

                                    <option value="{{ $value->id }}" @if($select_age== $value->id)selected @endif>{{$value->name.translate('سنة')}} </option>
                                @endforeach
                            </select>
                            </select>
                        </div>
                        <!-- Occupation -->
                        <div class="col p-2">
                            <label for="job"> <i class="fa-duotone fa-briefcase me-1"></i>  {{translate('المهنة')}} </label>
                            <select id="job" name="occupation_id" class="select2WithoutSearch">
                                <option value="" selected > {{translate('الكل')}} </option>
                                @foreach (\App\Models\RecruitmentFormOccupation::get() as $key => $value)
                                    <option value="{{ $value->id }}" @if($select_occupation== $value->id)selected @endif>{{ translate($value->name) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <!-- Nationality -->
                        <div class="col p-2">
                            <label for="nationality"> <i class="fa-duotone fa-flag me-1"></i> {{translate('الجنسية')}} </label>
                            <select id="nationality" name="nationality_id" class="select2WithoutSearch">
                                <option value="" selected > {{translate('الكل')}} </option>
                                @foreach (\App\Models\Nationality::where('status', 1)->get() as $key => $country)
                                    <option value="{{ $country->id }}" @if($select_nationality== $country->id)selected @endif>{{ translate($country->name) }}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                </div>
                <div class="col-sm-2 col-md-4 p-2 d-flex align-items-center justify-content-end flex-wrap">
                    @if(isset($select_nationality)||$select_occupation||$select_age)
                        <a href="{{route('all_cvs')}}" type="button" class=" btn clear m-1 "> {{translate('مسح')}}
                            <span></span>
                        </a>
                    @endif
                    <button type="submit" class="defaultBtn m-1" >{{translate('تطبيق')}}
                        <span></span>
                    </button>
                </div>
            </form>
        </div>
    </section>
    <!-- ================ /filter ================= -->

    <!-- ================ all workers ================= -->
    <section class="allWorkers">
        <div class="container">
            <div class="row">
                @forelse($cv_data as $key =>$val)
                    <!-- cv -->
                        <div class="col-md-6 col-lg-4 p-2">
                            <div class="workerCv">

                                <div class="swiper workerCvSlider ">
                                    <div class="swiper-wrapper">
                                        <!-- cv image -->

                                        @if(!empty($val['images']))

                                            @foreach(json_decode($val['images']) as $key2=>$val2)
                                                    <?php

                                                    $agent = new \Jenssegers\Agent\Agent();

                                                    ?>
                                                @if($key2 ==0 && !empty($val['new_image']))
                                                    <div class="swiper-slide ">
                                                        <a data-fancybox="{{'user'.($key+1).'-CV'}}" href="{{static_asset($val['new_image'])}}">
                                                            <img alt="{{request()->path()}}" data-original="{{static_asset($val['new_image'])}}" src="{{static_asset($val['new_image'])}}"  class=" lazyimgs"  width="100%" height="100%" alt="{{ env('APP_NAME') }}"  >
{{--                                                            <p  class="fs-6 px-lg-5 " style="  position: absolute; top: 50px;left:-41px;background-color: gold;color: #fff;pointer-events: none;font-weight: bold;-webkit-transform: rotate(-45deg);-moz-transform: rotate(-45deg);">خصومات شهر الخير </p>--}}
                                                        </a>
                                                    </div>
                                                @endif

                                                <div class="swiper-slide ">
                                                    <a data-fancybox="{{'user'.($key+1).'-CV'}}" href="{{static_asset(ltrim($val2, '/'))}}">
                                                        <img  data-original="{{static_asset(ltrim($val2, '/'))}}" src="{{static_asset(ltrim($val2, '/'))}}" class="lazyimgs lazyimgs" @if($agent->isPhone() && $key !=0) loading="lazy" @endif width="100%" height="100%" alt="{{ env('APP_NAME') }}"  >
                                                    </a>
                                                </div>

                                            @endforeach
                                        @endif
                                    </div>
                                    <div class="swiper-button-next"></div>
                                    <div class="swiper-button-prev"></div>
                                </div>

                                <ul class="info">
                                    <li>
                                        <h6>{{translate('الجنسية')}} : </h6>
                                        <p>{{$val['nationality'] }}  </p>
                                    </li>
                                    <li>
                                        <h6>{{translate('المهنة')}} :</h6>
                                        <p> {{$val['recruitmentFormOccupation']}}  </p>
                                    </li>
                                    <li>
                                        <h6> {{translate('الديانة')}} :</h6>
                                        <p> {{$val['recruitmentFormReligion']}} </p>
                                    </li>
                                    <li>
                                        <h6>{{translate('سعر الاستقدام')}} : </h6>
                                        <p>
                                                {{  $val['service_price'] .translate('ريال')}}
                                        </p>
                                    </li>

                                    <li>
                                        <h6>{{translate(' الحالة الاجتماعية')}} :</h6>
                                        <span>{{ $val['recruitmentFormSocialStatus'] }}</span>

                                    </li>
                                    <li>
                                            <h6> {{$val['recruitmentFormOccupationName']}} : </h6>
                                            <p> {{$val['recruitmentFormOccupation']}} </p>

                                    </li>
                                    <li>
                                        <h6> {{translate('الخبرة العملية')}} : </h6>
                                        <p> {{$val['recruitmentFormExperience']}} </p>
                                    </li>
                                </ul>
                                <div class="text-center pt-4">
                                    <p style="color: red; border:red; border-width:1px; border-style:solid;">{{translate('لضمان حقك، لا يتم سداد الرسوم بعد الحجز إلا عند طريق منصة مساند')}}</p>

                                    <br>
                                    @if($val['is_booking']==0 )

                                        <a  href="javascript:void(0)" class="defaultBtn " onclick="copyUrl(this)" data-url="{{ $val['id']}}"><span></span> {{translate('حجز السيرة الذاتية')}} </a>
                                    @else
                                        <a  href="javascript:void(0)" class="defaultBtn"><span></span> {{translate('محجوز')}} </a>
                                    @endif
                                    <a  href="javascript:void(0)" class="defaultBtn "  @if(!empty($val['images'])&& json_decode($val['images']) !=[]) href="{{static_asset(json_decode($val['images'])[0])}}" download @endif style="background-color: white;color: #A505A;border-color: #A505A"  ><span></span> {{translate('تنزيل السيرة الذاتية')}} </a>

                                </div>
                            </div>
                        </div>
                       @empty
                    <section class="pageError">
                        <div class="container">
                            <div class="notFound">
                                <img src="{{ static_asset('assets/img/empty_state.jpg') }}" alt="{{ env('APP_NAME') }}">
                                <h3> {{translate("ما لقيت طلبك ؟! لا تشيل هم وتواصل معنا ")}}. </h3>
                                <br>
{{--                                <a class="defaultBtn " href="@auth{{route('recruitment.request')}}@else {{ route('user.login')}}@endif"><span></span> {{translate(' طلب خاص')}} </a>--}}
                                <a class="defaultBtn"  href="tel:8003030309"><span></span> {{translate('اتصال مباشر')}} </a>

                            </div>
                        </div>
                    </section>

                @endforelse
            </div>
            <!-- pagination -->
            <ul class="pagination wow fadeInUp">
                {{ $all_cvs->links() }}
            </ul>

            @if(request()->get('page')== $all_cvs->lastPage() )
                <div class="  fade show customOrder wow fadeInUp" style="position:static;border:2px solid #A505A" role="alert">
                    <button type="button" class="btn-close p-2 close-recruitment" data-bs-dismiss="alert" aria-label="Close"></button>
                    <h5>{{translate('يمكننا توفير العمالة المناسبة طبقا لمواصفاتك الخاصه')}} </h5>
                    <a class="defaultBtn " href="@auth{{route('recruitment.request')}}@else {{ route('user.login')}}@endif"><span></span> {{translate('تقديم طلب خاص')}} </a>

                </div>
            @endif


        </div>


    </section>

    @endsection


    @section('script')
        <script>

            $('.close-recruitment').on('click', function () {
                $(this).closest('div').remove();
            });
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

            function copyUrl(e) {
                var url = $(e).data('url');

                $.post('{{ route('set_reservation_session') }}', {_token:'{{ @csrf_token() }}', cv_id:url}, function(data){
                    if( data == '1'){
                        @auth
                        $.post('{{ route('reservation_cv') }}', {_token:'{{ @csrf_token() }}', cv_id:url}, function(data){
                            console.log(data);
                            if( data == '0') {
                                toastr.error("{{translate('ﻻ يمكنك انشاء طلب جديد الان يمكن متابعة طلبك او إلغاء السابق والبدأ فى طلب حجز جديد')}}");
                                window.setTimeout(function() {
                                    window.location.href="{{route('clientIndex')}}";
                                }, 5000);
                            }
                            else if( data != '1' &&  data != '2'){
                                window.location.href ='/customer-service/'+data;
                            }
                            else  {
                                window.location.href="{{route('user.registration')}}";
                            }

                        })
                        @else
                            {{--window.location.href="{{route('user.registration')}}";--}}
                        window.location.href="{{route('select_service_cv')}}";
                        @endauth
                    }
                })

            }
        </script>


    @endsection