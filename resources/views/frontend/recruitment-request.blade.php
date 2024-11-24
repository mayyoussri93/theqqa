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
                <a href="{{route('all_cvs')}}"> {{translate('طلب استقدام')}} </a>
            </li>
            <li>
                <a href="{{route('recruitment.request')}}" class="active"> {{translate('تقديم طلب خاص')}}</a>
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
    <!-- Main Banner  -->
    <!-- ================ recruitment Request ================= -->
    <section class="recruitmentRequest">
        <div class="container">
            <div class="headTitle">
                <h2>{{translate('طلب استقدام العمالة المنزلية')}}    </h2>
                <p>

                    {{translate(' يسرنا أن نرحب بك للاطلاع على خدماتنا، نحن نسعى جاهدين لتقديم أفضل خدمات  الإستقدام للعمالة المنزلية. لتقديم طلب إستقدام العمالة المنزلية نرجو تعبئة كامل البيانات بشكل صحيح')}}
                </p>
            </div>
            <!-- recruitment Request Form -->

                <form class="recruitmentRequest needs-validation" novalidate  action="{{route('recruitment.request.save')}}" method="POST" enctype="multipart/form-data" id="choice_form ">
                    @csrf
                <div class="row justify-content-center">
                    <div class="col-md-4 pb-3 p-2">
                        <!-- formCard -->
                        <div class="formCard">
                            <div class="head">
                                <h5> {{translate('بيانات صاحب العمل')}} </h5>
                            </div>
                            <div class="row">
                                <div class="col-12 pb-3 p-2">
                                    <label for="name" class="form-label"> <i class="fas fa-user me-2"></i>{{translate('الاسم الكامل')}} </label>
                                    <input type="text" class="form-control" id="name" name="name"   value="{{auth::user()->name}}" required placeholder="{{translate('ادخل اسمك بالكامل كما في الهوية')}}">
                                    <div class="valid-feedback">{{translate('صحيح')}}</div>
                                    <div class="invalid-feedback">{{translate('هذا الحقل مطلوب')}}</div>
                                </div>
                                <div class="col-12 pb-3 p-2">
                                    <label for="Phone" class="form-label"> <i class="fas fa-phone-alt me-2"></i> {{translate('رقم الهاتف')}} </label>
                                    <input type="tel" class="form-control" id="Phone"  name="phone" placeholder="{{translate('ادخل رقم جوالك')}}" value="{{auth::user()->phone}}" maxlength="10" minlength="10" pattern="/^(:?(\+)|(00))?(:?966)?+(5|05)([503649187])([0-9]{7})$/" required>
                                    <div class="valid-feedback">{{translate('صحيح')}}</div>
                                    <div class="invalid-feedback">{{translate('هذا الحقل مطلوب')}}</div>
                                </div>
                                <div class="col-12 pb-3 p-2">
                                    <label for="city" class="form-label"> <i class="fa-solid fa-city me-2"></i>  {{translate('المدينه')}} </label>
                                    <select name="address"  id="city" class="select2" required>
                                        <option value="">{{translate('اختار المدينة')}}</option>
                                        @foreach (\App\Models\City::where('country_id', 190)->get() as $key => $val)
                                            <option value="{{ $val->name }}" @if(old('address')== $val->name ) selected @endif>{{ translate($val->name) }}</option>
                                        @endforeach
                                    </select>
                                    <div class="valid-feedback">{{translate('صحيح')}}</div>
                                    <div class="invalid-feedback">{{translate('هذا الحقل مطلوب')}}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8 pb-3 p-2">
                        <!-- formCard -->
                        <div class="formCard">
                            <div class="head">
                                <h5>  {{translate('بيانات العامل المنزلى')}} </h5>
                            </div>
                            <div class="row">
{{--                                <div class="col-sm-12 pb-3 p-2">--}}
{{--                                    <label for="" class="form-label"> {{translate('رقم التأشيرة')}} </label>--}}
{{--                                    <input type="text" class="form-control" name="visa_id" placeholder="{{translate('ادخل رقم التأشيرة المصدرة')}}">--}}
{{--                                    <span class="hint">   {{translate('فى حالة عدم اصدار تأشيرة بعد يمكنك التعرف عن طريق')}} <a href="{{route('visa.issuance')}}">--}}
{{--                                            {{translate('إصدار التأشيرة')}} </a> </span>--}}

{{--                                </div>--}}
                                <div class="col-sm-6 pb-3 p-2">
                                    <label for="" class="form-label">{{translate('الجنسية المطلوبة')}}  </label>
                                    <select name="nationality_id" id="" class="select2">
                                        <option value="" selected disabled>{{translate('اختار الجنسية')}}</option>
                                        @foreach (\App\Models\Nationality::where('status', 1)->get() as $key => $country)
                                            <option value="{{ $country->id }}" @if(old('nationality_id')== $country->name ) selected @endif>{{ translate($country->name) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-6 pb-3 p-2">
                                    <label for="" class="form-label">{{translate('المهنة المطلوبة')}} </label>
                                    <select name="occuption_id" id="" class="select2">
                                        <option value="" selected disabled>  {{translate(' اختر ')}} </option>
                                        @foreach (\App\Models\RecruitmentFormOccupation::get() as $key => $value)
                                            <option value="{{ $value->id }}" @if(old('occuption_id')== $value->name ) selected @endif>{{ translate($value->name) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-6 pb-3 p-2">
                                    <label for="" class="form-label"> {{translate('الحالة الاجتماعية المطلوبة')}} </label>
                                    <select name="social_id" id="" class="select2">
                                        <option value=" " selected disabled>{{translate(' اختر الحالة الاجتماعية للعامل')}}</option>
                                        @foreach (\App\Models\RecruitmentFormSocialStatus::get() as $key => $value)
                                            <option value="{{ $value->id }}" @if(old('social_id')== $value->name ) selected @endif>{{ translate($value->name) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-6 pb-3 p-2">
                                    <label for="" class="form-label"> {{translate('العمر المطلوب')}} </label>
                                    <select name="age_id" id="" class="select2">
                                        <option  value=" " selected disabled> {{translate('اختر الفئة العمرية للعامل المطلوب')}}</option>
                                        @foreach (\App\Models\RecruitmentFormAge::get() as $key => $value)
                                            <option value="{{ $value->id }}" @if(old('age_id')== $value->name ) selected @endif>{{ translate($value->name) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-4 pb-3 p-2">
                                    <label for="" class="form-label"> {{translate('ديانة العامل')}} </label>
                                    <div class="pt-1">
                                        @foreach(\App\Models\RecruitmentFormReligion::get() as $key=>$val)
                                            <div class="form-check px-4">
                                                <input class="form-check-input" type="radio" name="region_id" id="{{'inlineRegion'.$key}}" value="{{$val->id}}" @if(old('region_id')== $val->id ) checked @endif>
                                                <label class="form-check-label" for="{{'inlineRegion'.$key}}">
                                                    {{translate($val->name)}}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col-sm-4 pb-3 p-2">
                                    <label for="" class="form-label"> {{translate('اللغة التى يتحدث بها العامل')}}</label>
                                    <div class="pt-1">
                                        @foreach(\App\Models\RecruitmentFormLanguage::get() as $key=>$val)
                                            <div class="form-check px-4">
                                                <input class="form-check-input" type="radio" name="lang_id" id="{{'inlineLang'.$key}}" value="{{$val->id}}"  @if(old('lang_id')== $val->id ) checked @endif>
                                                <label class="form-check-label" for="{{'inlineLang'.$key}}">
                                                    {{translate($val->name)}}
                                                </label>
                                            </div>
                                        @endforeach

                                    </div>
                                </div>
                                <div class="col-sm-4 pb-3 p-2">
                                    <label for="" class="form-label"> {{translate('حالة العامل')}} </label>
                                    <div class="pt-1">
                                        @foreach(\App\Models\RecruitmentFormExperience::get() as $key=>$val)
                                            <div class="form-check px-4">
                                                <input class="form-check-input" type="radio" name="exper_id" id="{{'inlineExp'.$key}}" value="{{$val->id}}"  @if(old('exper_id')== $val->id ) checked @endif>
                                                <label class="form-check-label" for="{{'inlineExp'.$key}}">
                                                    {{translate($val->name)}}
                                                </label>
                                            </div>
                                        @endforeach

                                    </div>
                                </div>
                                <div class="col-sm-12 pb-3 p-2">

                                    <label for="">{{translate('متطلبات اخرى')}}</label>
                                    <textarea class="form-control" id="" placeholder="{{translate('هل لديك متطلبات خاصة للعامل؟')}}" name="requirement_id" rows="5"></textarea>
                                </div>
                            </div>
                            <!-- submit -->
                            <div class="col-12 pt-4 p-2 text-center">
                                <button class="defaultBtn " type="submit">
                                    <p class="px-5"> {{translate('ارسال')}} </p>
                                    <span></span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>


@endsection

@section('script')










    </script>

@endsection