
@extends('frontend.layouts.app')
@section('meta_title'){{get_seo_title_setting(request()->path()).json_encode(request()->query())}}  @stop
@section('meta_description'){{get_seo_description_setting(request()->path()).json_encode(request()->query())}}@stop
@section('meta_keywords')        {{get_seo_keys_setting(request()->path())}}@stop

@section('meta')
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name" content="{{get_seo_title_setting(request()->path())}} ">
    <meta itemprop="description" content="{{get_seo_description_setting(request()->path())}}">

    <!-- Twitter Card data -->
@endsection


    @section('meta_product_twitter'){{get_seo_title_setting(request()->path())}}  @stop
    @section('meta_title_twitter'){{get_seo_title_setting(request()->path())}}  @stop
    @section('meta_keywords_twitter')   {{get_seo_keys_setting(request()->path())}} @stop
    @section('meta_description_twitter')     {{get_seo_description_setting(request()->path())}} @stop
    @section('meta_creator_twitter')        {{get_seo_title_setting(request()->path())}}  @stop

    <!-- Open Graph data -->
    @section('meta_og_title')        {{get_seo_title_setting(request()->path())}}  @stop
    @section('meta_og_url')      {{Request::fullUrl() }}  @stop
    @section('meta_og_description')        {{get_seo_description_setting(request()->path())}} @stop



@section('link')

<link rel="canonical" href="{{Request::fullUrl() }}" />
@endsection
@section('content')
    <!-- ================ for seo ================= -->
    <h1 style="display: none">{{ get_seo_h1_setting(request()->path()).'  '.Request::getRequestUri().' .'}}</h1>
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
    <section class="mainBanner logs_m" style="background-image:none;     padding: 30px 100px 10px;">
        <button onclick="goBack()" class="Back">
            <i class="fas fa-angle-left"></i>
        </button>
        <ul style="color: #A505A">
            <li style="color: #145e4e">
                <a href="{{ route('home') }}" style="color: #145e4e"> {{translate('الرئيسية')}} </a>
            </li>

            <li style="color: #145e4e">
                <a href="{{url()->current()}}" class="active"  style="color: #145e4e">  {{translate('نقل الكفالة')}} </a>
            </li>
        </ul>
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
                                @foreach(\App\Models\RecruitmentFormAge::all() as $key=>$val)
                                    <option value="{{$val->id}}" @if($select_age== $val->id)selected @endif> {{$val->name.translate('سنة')}}</option>
                                @endforeach
                            </select>
                        </div>
                        <!-- Occupation -->

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
                    @if(isset($select_nationality)||$select_age)
                        <a href="{{route('allSponsorCvs')}}" type="button" class=" btn clear m-1 "> {{translate('مسح')}}
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
            @foreach($all_cvs as $key =>$val_sponsor)
                <?php
                        $val=$val_sponsor->contract->reservation;
                    ?>
                @if(!empty(json_decode($val->cv)))
                <!-- cv -->

                    <div class="col-md-6 col-lg-4 p-2">
                        <div class="workerCv">

                            <div class="swiper workerCvSlider ">

                                @if(empty($val->cv->transfer_pic))
                                <div class="swiper-wrapper">
                                    <!-- cv image -->
                                    @if(!empty(json_decode($val->cv->images)))
                                        @foreach(json_decode($val->cv->images) as $key2=>$val2)
                                            <div class="swiper-slide ">
                                                <?php
                                                $agent = new \Jenssegers\Agent\Agent();
                                                ?>
                                            @if($key2 ==0 && !empty($val->cv->new_image))
                                                <div class="swiper-slide ">
                                                    <a data-fancybox="{{'user'.($key+1).'-CV'}}" href="{{static_asset($val->cv->new_image)}}">
                                                        <img data-original="{{static_asset($val->cv->new_image)}}"  class=" lazyimgs"  width="100%" height="100%" alt="{{ env('APP_NAME') }}"  >
                                                    </a>
                                                </div>
                                            @endif
                                            </div>
                                            <div class="swiper-slide ">
                                                    <?php

                                                    $agent = new \Jenssegers\Agent\Agent();
                                                    ?>
                                                <a data-fancybox="{{'user'.($key+1).'-CV'}}" href="{{static_asset($val2)}}">
                                                    <img data-original="{{static_asset($val2)}}" src="{{static_asset($val2)}}" class="lazyimgs" @if($agent->isPhone() && $key !=0) loading="lazy" @endif  alt="{{ env('APP_NAME') }}"  >
                                                </a>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                                <div class="swiper-button-next"></div>
                                <div class="swiper-button-prev"></div>
                                @else
                                <img src="{{static_asset($val->cv->transfer_pic)}}" class="w-100" alt="{{'not added yet'}}">
                                @endif
                            </div>

                            <ul class="info">
                                <li>
                                    <h6>{{translate('الجنسية')}} : </h6>
                                    <p>{{($val->cv->nationality !=null)?translate($val->cv->nationality->name):"--"}}  </p>
                                </li>
                                <li>
                                    <h6> {{translate('الديانة')}} :</h6>
                                    <p> {{($val->cv->recruitmentFormReligion !=null)?translate($val->cv->recruitmentFormReligion->name):"--"}} </p>
                                </li>
                                <li>
                                    <h6> {{translate('العمر')}} : </h6>
                                    <p> {{($val->cv_id !=null)?translate($val->cv->age_id):"--"}} </p>
                                </li>
                                <li>
                                    <h6>{{translate('رسوم نقل الكفاله')}}  :</h6>
                                    <p> {{ $val->cv->nationality->sponsor_salary.translate(" ريال ")}} </p>
                                </li>
                                <li>
                                    <h6>{{translate('رقم الجواز')}}  :</h6>
                                    <p> {{$val->cv->passport_id??"--"}} </p>
                                </li>
                                <li>
                                    <h6>{{translate('مدة العمل عند الكفيل السابق')}}  :</h6>
                                    <p> {{($val->contract->durationWorkSponsor !=null)?$val->contract->duration_type.' '.translate($val->contract->durationWorkSponsor->name):"--"}} </p>
                                </li>


                            </ul>
                            <div class="text-center pt-4">
                                <?php
                                $whats  = preg_replace('/[^0-9]/', '',  get_setting('cvs_previous_sponsor_whatsapp'));
                                ?>
{{--                                    <a   class="defaultBtn" href="{{'https://api.whatsapp.com/send?phone='.$whats.'&text='.$val->cv->passport_id.': اريد نقل الكفالة لرقم جواز السفر '}}" >{{translate('احجز الأن')}}</a>--}}
                                    <a   class="defaultBtn" href="{{route('chooseSponsorService',['cv_sponsorship_id'=>$val_sponsor->id])}}" >{{translate('احجز الأن')}}</a>

{{--                                    chooseSponsorService--}}
                            </div>
                        </div>
                    </div>
                @endif
                @endforeach
            </div>
            <!-- pagination -->
            <ul class="pagination wow fadeInUp">
                {{ $all_cvs->links() }}
            </ul>



        </div>
    </section>



















@endsection

 
@section('script')

@endsection