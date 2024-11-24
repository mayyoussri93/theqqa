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
    <div class="spinner">
        <div class="sk-folding-cube">
            <div class="sk-cube1 sk-cube"></div>
            <div class="sk-cube2 sk-cube"></div>
            <div class="sk-cube4 sk-cube"></div>
            <div class="sk-cube3 sk-cube"></div>
        </div>
    </div>
    <!-- ================ spinner ================= -->

    <!-- policies -->
    <section class="policies">
        <div class="container">

            <h1 class="wow fadeInUp">{{translate(get_setting('policy_recruitment_title'))}} </h1>
            <h4 class="wow fadeInUp">
                {{translate(get_setting('policy_recruitment_description'))}}
            </h4>

            <div class="links wow fadeInUp">
                @if (get_setting('policy_recruitment_pdfs') != null)
                    @foreach (json_decode(get_setting('policy_recruitment_pdfs'), true) as $key => $value)

                        @php
                            $attachment = \App\Models\Upload::find($value);

                        @endphp

                <a href="{{ uploaded_asset($value)}}" target="_blank" rel="noopener"> <i class="fa-solid fa-file-pdf me-2" ></i> {{ translate($attachment->file_original_name) }} </a>
                    @endforeach
                @endif
            </div>

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

            <li style="color: #145e4e">
                <a href="{{url()->current()}}" class="active"  style="color: #145e4e">  {{translate('سياسات الاستقدام')}} </a>
            </li>
        </ul>
    </section>
    <!-- contact Form -->
    <section class="contactForm">
        <div class="container">
            <div class="row">
                <div class="col-md-6 p-2  mb-5 mb-md-0 wow fadeInUp">
                    <div class="headTitle text-start">
                        <h2> {{translate('تواصل معنا')}}  </h2>
                        <p>   {{translate('اطلب عاملتك الان وسيقوم فريق خدمة العملاء لدينا بالتواصل معك بأسرع وقت')}}</p>
                    </div>
                    <form   action="javascript:void(0)" method="post" class="row needs-validation" novalidate>
                        <div class="col-md-12 p-2">
                            <label class="form-label"> <i class="fas fa-user me-2"></i> {{translate('الاسم كامل').'*'}}</label>
                            <input type="text"  name="name" id="contact_name" class="form-control" required>
                            <div class="valid-feedback">{{translate('صحيح')}}</div>
                            <div class="invalid-feedback">{{translate('هذا الحقل مطلوب')}}</div>
                        </div>
                        <div class="col-md-6 p-2">
                            <label class="form-label"><i class="fas fa-phone-alt me-2"></i> {{translate('رقم الهاتف ').'*'}} </label>
                            <input type="number" name="phone" id="contact_phone" class="form-control" required>
                            <div class="valid-feedback">{{translate('صحيح')}}</div>
                            <div class="invalid-feedback">{{translate('هذا الحقل مطلوب')}}</div>
                        </div>
                        <div class="col-md-6 p-2">
                            <label class="form-label"> <i class="fa-solid fa-comment-lines me-2"></i>{{translate('الموضوع').'*'}} </label>
                            <select  name="subject"  class="form-control" required=""   id="contact_subject" >
                                <option value="استفسار">{{translate('استفسار')}}</option>
                                <option value="شكوي">{{translate('شكوي')}}</option>
                                <option value="اقتراح">{{translate('اقتراح')}} </option>
                            </select>
                            <div class="valid-feedback">{{translate('صحيح')}}</div>
                            <div class="invalid-feedback">{{translate('هذا الحقل مطلوب')}}</div>

                        </div>
                        <div class="col-md-12 p-2">
                            <label class="form-label"> <i class="fas fa-feather-alt me-2"></i> {{translate('اكتب رسالتك').'*'}} </label>
                            <textarea class="form-control"  id="contact_massage" name="massage" rows="5" required></textarea>
                            <div class="valid-feedback">{{translate('صحيح')}}</div>
                            <div class="invalid-feedback">{{translate('هذا الحقل مطلوب')}}</div>

                        </div>
                        <div class="col-md-12 text-center p-2">
                            <button type="submit" class="defaultBtn bttn-submit"> {{translate('ارسال')}} <i class="fas fa-paper-plane ms-2" ></i>
                                <span></span>
                            </button>
                        </div>
                    </form>

                </div>
                <div class="col-md-6 p-2 wow fadeInUp">
                    <section class="googleMap ">
                        <iframe
                                src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d57946.84623396069!2d46.75688!3d24.806481!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xc74fdd6f15256594!2z2YXZg9iq2Kgg2LHZiNin2YHYryDZhtis2K8g2YTZhNil2LPYqtmC2K_Yp9mF!5e0!3m2!1sar!2ssa!4v1650724949947!5m2!1sar!2ssa"
                                frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </section>
                </div>
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
@section('script')
                                    <script type="text/javascript" src="https://unpkg.com/default-passive-events"></script>

                                    <script type="text/javascript">
                                        $(document).ready(function () {
                                            $(".bttn-submit").click(function (e) {
                                                e.preventDefault();

                                                var _token = '{{ @csrf_token() }}';
                                                var name = $("#contact_name").val();
                                                var email ='';
                                                var phone = $("#contact_phone").val();
                                                var subject = $("#contact_subject").val();
                                                var massage = $("#contact_massage").val();
                                                $.ajax({
                                                    url: "{{route('contact_us_send')}}",
                                                    type: 'POST',
                                                    data: {_token: _token, email: email, name: name, phone: phone, massage: massage, subject: subject},
                                                    success: function (data) {
                                                        console.log(data.error)
                                                        if ($.isEmptyObject(data.error)) {
                                                            $("#contact_name").val('');
                                                            $("#contact_phone").val('');
                                                            $("#contact_massage").val('');
                                                            $('.invalid-feedback').hide();
                                                            $("html, body").animate({
                                                                scrollTop: 0
                                                            }, 1000);
                                                            toastr.success(data.success);
                                                        } else {
                                                            printErrorMsg(data.error);

                                                        }
                                                    }
                                                });
                                            });

                                            function printErrorMsg(msg) {
                                                $.each(msg, function (key, value) {
                                                    console.log(key);
                                                    $('.' + key + '_err').text(value);
                                                });
                                            }
                                        });
                                    </script>
@endsection
