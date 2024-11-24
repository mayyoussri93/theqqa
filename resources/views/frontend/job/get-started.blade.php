@extends('frontend.layouts.app')
@php
    $data=implode(',',\App\Models\CommonTopic::pluck('main_name')->toArray());
@endphp
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
{{--    <h1 style="display: none">{{get_seo_h1_setting(request()->path())}}</h1>--}}
    <!-- ================  for seo =================-->
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
                <a href="{{route('frontend.job.get-started')}}" class="active">  {{translate('التقدم لطلب وظيفة')}}</a>
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
    <!-- ================ supportPage ================= -->
    <section class="supportPage">
        <div class="container">

            <style>
                .nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active {
                    background-color: #f1f4d9;
                }
            </style>
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="job-tab" data-bs-toggle="tab" data-bs-target="#job" type="button" role="tab" aria-controls="job" aria-selected="false" style=" color: #A505A;">{{translate('الوظائف')}}</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link " id="trainee-tab" data-bs-toggle="tab" data-bs-target="#trainee" type="button" role="tab" aria-controls="trainee" aria-selected="true" style="color: #145e4e;">{{translate('التدريب')}}</button>
                    </li>


                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div class="tab-pane active " id="job" role="tabpanel" aria-labelledby="job-tab">
                        <div class="row">
                        <div class="col-md-4 p-2">
                            <!-- faq -->
                            <div class="supportFaq">
                                <div class="headTitle text-start wow fadeInUp">
                                    <h2> {{translate('تفاصيل الوظائف')}} </h2>
                                </div>
                                <div class="accordion" id="faqAccordion">
                                    <!-- question -->
                                    @foreach( \App\Models\Job::where('is_active', 1)->get() as $key=>$value)
                                        @if(!empty($value->requirements) or !empty($value->tasks))
                                        <div class="accordion-item wow fadeInUp">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button" data-bs-toggle="collapse" data-bs-target="#question{{$key}}"
                                                        aria-controls="question{{$key}}">
                                                    {{translate($value->title)}}
                                                </button>
                                            </h2>
                                            <div id="question{{$key}}" class="accordion-collapse collapse @if($key==0) show @endif" data-bs-parent="#faqAccordion">
                                                <div class="accordion-body">
                                                    <h6 class=" secondaryTitle">
                                                        {{translate('المتطلبات'.' : ')}}
                                                    </h6>
                                                    <div class="accordion-body">
                                                        @foreach(explode(',',$value->requirements ) as $key2 =>$val)

                                                            <p>            <i class="fas fa-dot-circle small" style="color: #145e4e"></i> {{' - '.$val }}</p>
                                                        @endforeach
                                                    </div>
                                                    <h6 class=" secondaryTitle">
                                                        {{translate('مهام العمل'.' : ')}}

                                                    </h6>
                                                    <div class="accordion-body">
                                                        @foreach(explode(',',$value->tasks ) as $key2 =>$val)

                                                            <p>            <i class="fas fa-dot-circle small" style="color: #145e4e"></i> {{' - '.$val }}</p>
                                                        @endforeach
                                                    </div>
                                                    {{--                                            {!!translate($value->answer)!!}--}}
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                    @endforeach

                                </div>
                            </div>
                        </div>
                        <div class="col-md-8 p-2">
                            <!-- trending  -->
                            <div class="trending">
                                {{--                        <div class="headTitle text-start wow fadeInUp">--}}
                                {{--                            <h1> {{translate('تفاصيل الوظائف')}} </h1>--}}
                                {{--                        </div>--}}
                                <form class="recruitmentRequest needs-validation" novalidate  action="{{route('saveApplicant')}}" method="POST" enctype="multipart/form-data" id="choice_form ">
                                    @csrf
                                    <div class="row justify-content-center">
                                        <!-- formCard -->
                                        <div >
                                            <div class="row">
                                                <div class="col-12 pb-3 p-2">
                                                    <label for="name" class="form-label"> <i class="fas fa-user me-2"></i>{{translate('الاسم الكامل')}} </label>
                                                    <input type="text" class="form-control" id="name" name="name"    required placeholder="{{translate('ادخل اسمك بالكامل كما في الهوية')}}">
                                                    <div class="valid-feedback">{{translate('صحيح')}}</div>
                                                    <div class="invalid-feedback">{{translate('هذا الحقل مطلوب')}}</div>
                                                </div>
                                                <div class="col-12 pb-3 p-2">
                                                    <label for="Phone" class="form-label"> <i class="fas fa-phone-alt me-2"></i> {{translate('الجوال')}} </label>
                                                    <input type="tel" class="form-control" id="Phone"  name="phone" placeholder="{{translate('ادخل رقم جوالك')}}"  maxlength="10" minlength="10" pattern="/^(:?(\+)|(00))?(:?966)?+(5|05)([503649187])([0-9]{7})$/" required>
                                                    <div class="valid-feedback">{{translate('صحيح')}}</div>
                                                    <div class="invalid-feedback">{{translate('هذا الحقل مطلوب')}}</div>
                                                </div>
                                                <div class="col-12 pb-3 p-2">
                                                    <label for="Phone" class="form-label"> <i class="fas fa-spider-web me-2"></i> {{translate('البريد الالكترونى')}} </label>
                                                    <input type="email" class="form-control" id="email"  name="email" placeholder="{{translate('ادخل رقم البريد الالكترونى')}}"   required>
                                                    <div class="valid-feedback">{{translate('صحيح')}}</div>
                                                    <div class="invalid-feedback">{{translate('هذا الحقل مطلوب')}}</div>
                                                </div>
                                                <div class="col-12 pb-3 p-2">
                                                    <label for="city" class="form-label"> <i class="fas fa-list-dots  me-2"></i>  {{translate('الوظائف')}} </label>
                                                    <select name="job_id"  id="job_id" class="select2" required>
                                                        <option value="">{{translate('اختار الوظيفة')}}</option>
                                                        @foreach (\App\Models\Job::where('is_active', 1)->get() as $key => $val)
                                                            <option value="{{ $val->id }}" @if(old('job_id')== $val->id ) selected @endif>{{ translate($val->title) }}</option>
                                                        @endforeach
                                                    </select>
                                                    <div class="valid-feedback">{{translate('صحيح')}}</div>
                                                    <div class="invalid-feedback">{{translate('هذا الحقل مطلوب')}}</div>
                                                </div>
                                                <div>
                                                    <label for="formFileLg" class="form-label"><i class="fas fa-file-alt me-2"></i>{{translate(' السيرة الذاتية')}}</label>

                                                    <input type="file" class="form-control form-control-lg" id="name" name="cv_files"   required placeholder="{{translate('السيرة الذاتية')}}" >
                                                    <div class="valid-feedback">{{translate('صحيح')}}</div>
                                                    <div class="invalid-feedback">{{translate('هذا الحقل مطلوب')}}</div>
                                                </div>
                                                <div class="col-sm-12 pb-3 p-2">

                                                    <label for="">{{translate('ملاحظات')}}</label>
                                                    <textarea class="form-control" id="" placeholder="{{translate('هل لديك ملاحظات؟')}}" name="nots" rows="5"></textarea>
                                                </div>
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
                        </div>
                        </div>
                    </div>
                    <div class="tab-pane  " id="trainee" role="tabpanel" aria-labelledby="trainee-tab">
                        <div class="row">
                        <div class="col-md-4 p-2">
                            <!-- faq -->
                            <div class="supportFaq">
                                <div class="headTitle text-start wow fadeInUp">
                                    <h2> {{translate('تفاصيل التدريب')}} </h2>
                                </div>
                                <div class="accordion" id="faqAccordion">
                                    <!-- question -->
                                    @foreach( \App\Models\Training::where('is_active', 1)->get() as $key=>$value)
                                        @if(!empty($value->requirements) or !empty($value->tasks))

                                        <div class="accordion-item wow fadeInUp">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button" data-bs-toggle="collapse" data-bs-target="#question{{$key}}"
                                                        aria-controls="question{{$key}}">
                                                    {{translate($value->title)}}
                                                </button>
                                            </h2>
                                            <div id="question{{$key}}" class="accordion-collapse collapse @if($key==0) show @endif" data-bs-parent="#faqAccordion">
                                                <div class="accordion-body">
                                                    <h6 class=" secondaryTitle">
                                                        {{translate('المتطلبات'.' : ')}}
                                                    </h6>
                                                    <div class="accordion-body">
                                                        @foreach(explode(',',$value->requirements ) as $key2 =>$val)

                                                            <p>            <i class="fas fa-dot-circle small" style="color: #145e4e"></i> {{' - '.$val }}</p>
                                                        @endforeach
                                                    </div>
                                                    <h6 class=" secondaryTitle">
                                                        {{translate('مهام التدريب'.' : ')}}

                                                    </h6>
                                                    <div class="accordion-body">
                                                        @foreach(explode(',',$value->tasks ) as $key2 =>$val)

                                                            <p>            <i class="fas fa-dot-circle small" style="color: #145e4e"></i> {{' - '.$val }}</p>
                                                        @endforeach
                                                    </div>
                                                    {{--                                            {!!translate($value->answer)!!}--}}
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                        
                                    @endforeach

                                </div>
                            </div>
                        </div>
                        <div class="col-md-8 p-2">
                            <!-- trending  -->
                            <div class="trending">
                                {{--                        <div class="headTitle text-start wow fadeInUp">--}}
                                {{--                            <h1> {{translate('تفاصيل الوظائف')}} </h1>--}}
                                {{--                        </div>--}}
                                <form class="recruitmentRequest needs-validation" novalidate  action="{{route('saveApplicant')}}" method="POST" enctype="multipart/form-data" id="choice_form ">
                                    @csrf
                                    <div class="row justify-content-center">
                                        <!-- formCard -->
                                        <div >
                                            <div class="row">

                                                <div class="col-12 pb-3 p-2">
                                                    <label for="name" class="form-label"> <i class="fas fa-user me-2"></i>{{translate('الاسم الكامل')}} </label>
                                                    <input type="text" class="form-control" id="name" name="name"    required placeholder="{{translate('ادخل اسمك بالكامل كما في الهوية')}}">
                                                    <div class="valid-feedback">{{translate('صحيح')}}</div>
                                                    <div class="invalid-feedback">{{translate('هذا الحقل مطلوب')}}</div>
                                                </div>
                                                <div class="col-12 pb-3 p-2">
                                                    <label for="Phone" class="form-label"> <i class="fas fa-phone-alt me-2"></i> {{translate('الجوال')}} </label>
                                                    <input type="tel" class="form-control" id="Phone"  name="phone" placeholder="{{translate('ادخل رقم جوالك')}}"  maxlength="10" minlength="10" pattern="/^(:?(\+)|(00))?(:?966)?+(5|05)([503649187])([0-9]{7})$/" required>
                                                    <div class="valid-feedback">{{translate('صحيح')}}</div>
                                                    <div class="invalid-feedback">{{translate('هذا الحقل مطلوب')}}</div>
                                                </div>
                                                <div class="col-12 pb-3 p-2">
                                                    <label for="Phone" class="form-label"> <i class="fas fa-spider-web me-2"></i> {{translate('البريد الالكترونى')}} </label>
                                                    <input type="email" class="form-control" id="email"  name="email" placeholder="{{translate('ادخل رقم البريد الالكترونى')}}"   required>
                                                    <div class="valid-feedback">{{translate('صحيح')}}</div>
                                                    <div class="invalid-feedback">{{translate('هذا الحقل مطلوب')}}</div>
                                                </div>
                                                <div class="col-12 pb-3 p-2">
                                                    <label for="city" class="form-label"> <i class="fas fa-list-dots  me-2"></i>  {{translate('الاقسام')}} </label>
                                                    <select name="training_id"  id="training_id" class="select2" required>
                                                        <option value="">{{translate('اختار القسم')}}</option>
                                                        @foreach (\App\Models\Training::where('is_active', 1)->get() as $key => $val)
                                                            <option value="{{ $val->id }}" @if(old('training_id')== $val->id ) selected @endif>{{ translate($val->title) }}</option>
                                                        @endforeach
                                                    </select>
                                                    <div class="valid-feedback">{{translate('صحيح')}}</div>
                                                    <div class="invalid-feedback">{{translate('هذا الحقل مطلوب')}}</div>
                                                </div>

                                                <div>
                                                    <label for="formFileLg" class="form-label"><i class="fas fa-file-alt me-2"></i>{{translate(' السيرة الذاتية')}}</label>

                                                    <input type="file" class="form-control form-control-lg" id="name" name="cv_files"   required placeholder="{{translate('السيرة الذاتية')}}" >
                                                    <div class="valid-feedback">{{translate('صحيح')}}</div>
                                                    <div class="invalid-feedback">{{translate('هذا الحقل مطلوب')}}</div>
                                                </div>
                                                <div class="col-sm-12 pb-3 p-2">

                                                    <label for="">{{translate('ملاحظات')}}</label>
                                                    <textarea class="form-control" id="" placeholder="{{translate('هل لديك ملاحظات؟')}}" name="nots" rows="5"></textarea>
                                                </div>
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
                        </div>
                        </div>
                    </div>

                </div>



        </div>
    </section>





@endsection
