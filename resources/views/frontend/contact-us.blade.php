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
    <h1 style="display: none">{{get_seo_h1_setting(request()->path())}}</h1>
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
                <a href="{{route('frontend.contact-us')}}" class="active">  {{translate('تواصل معنا')}}</a>
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
    <!-- mapEarth -->
    <section class="mapEarth">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="worldMap">
                        <div class="earth"></div>
                        <div class="orbic">
                            <svg viewBox="0 0 500 500" width="0" height="0">
                                <g id="orbic_path">
                                    <ellipse cx="250" cy="250" rx="240" ry="100" transform="rotate(-10,250,250)"></ellipse>
                                    <path d="M230,192Q300,25 375,146"></path>
                                    <path d="M375,146Q450,175 410,301"></path>
                                    <path d="M40,234Q300,125 410,301"></path>
                                    <path d="M410,301Q260,165 125,354"></path>
                                    <path d="M125,354Q150,220 230,192"></path>
                                    <path d="M40,234Q130,200 125,354"></path>
                                </g>
                                <g id="orbic_dots">
                                    <defs>
                                        <circle id="orbic_dot" cx="0" cy="0" r="6"></circle>
                                    </defs>
                                    <use id="orbic_dot1" xlink:href="#orbic_dot"></use>
                                    <use id="orbic_dot2" xlink:href="#orbic_dot"></use>
                                    <use id="orbic_dot3" xlink:href="#orbic_dot"></use>
                                    <use id="orbic_dot4" xlink:href="#orbic_dot"></use>
                                    <use id="orbic_dot5" xlink:href="#orbic_dot"></use>
                                </g>
                                <g id="orbic_users">
                                    <image id="orbic_user1" xlink:href="{{static_asset('v3_assets/img/user1.webp')}}" width="20%" height="20%"></image>
                                    <image id="orbic_user2" xlink:href="{{static_asset('v3_assets/img/user2.webp')}}" width="20%" height="20%"></image>
                                    <image id="orbic_user3" xlink:href="{{static_asset('v3_assets/img/user3.webp')}}" width="20%" height="20%"></image>
                                    <image id="orbic_user4" xlink:href="{{static_asset('v3_assets/img/user4.webp')}}" width="20%" height="20%"></image>
                                    <image id="orbic_user5" xlink:href="{{static_asset('v3_assets/img/user5.webp')}}" width="20%" height="20%"></image>
                                </g>
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 pt-lg-5">
                    <h4 class="title"> <span> {{translate('كن علي اتصال')}} </span> </h4>
                    <div class="companyInfo ">
                        <ul>
                            <li class="wow fadeInUp">
                                <span><i class="fa-solid fa-map-location"></i></span>
                                <p class="ms-3">
                                {{translate('عنوان مقرنا')}}
                                    <a href="#!"> {{translate( get_setting('contact_address')) }} </a>
                                </p>
                            </li>
                            <li class="wow fadeInUp">
                                <span><i class="fa-solid fa-phone"></i></span>
                                <p class="ms-3">
                                    {{translate('المبيعات').' : '}}
                                    <a href="{{ 'tel:'.get_setting('contact_phone_1') }}"> {{ get_setting('contact_phone_1') }} </a>
                                    <a href="{{ 'tel:'.get_setting('contact_phone_2') }}"> {{ get_setting('contact_phone_2') }} </a>
                                </p>
                            </li>
                            <li class="wow fadeInUp">
                                <span><i class="fa-solid fa-message-question"></i></span>
                                <p class="ms-3">
                                {{translate('الشكاوي والاقتراحات').' : '}}
                                    <a href="{{ 'tel:'.get_setting('contact_phone') }}">  {{ get_setting('contact_phone') }}  </a>
                                </p>
                            </li>
                            <li class="wow fadeInUp">
                                <span><i class="fas fa-envelope"></i></span>
                                <p class="ms-3">
                                {{translate('البريد الالكتروني').' : '}}
                                <a href="{{'mailto:'.get_setting('contact_email')}}">
                                    {{get_setting('contact_email')}}
                                </a>
                                </p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ================ contact Form ================= -->
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
{{--                        <iframe--}}
{{--                                src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d57946.84623396069!2d46.75688!3d24.806481!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xc74fdd6f15256594!2z2YXZg9iq2Kgg2LHZiNin2YHYryDZhtis2K8g2YTZhNil2LPYqtmC2K_Yp9mF!5e0!3m2!1sar!2ssa!4v1650724949947!5m2!1sar!2ssa"--}}
{{--                                frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0" loading="lazy" referrerpolicy="no-referrer-when-downgrade">--}}
{{--                        </iframe>--}}
                        {!! get_setting('our_location') !!}
                    </section>
                </div>
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