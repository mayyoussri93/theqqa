@php use App\Models\Nationality; @endphp
@php use App\Models\RecruitmentRequirementDetail; @endphp
@php use Carbon\Carbon; @endphp
@php use Illuminate\Support\Facades\Cache; @endphp
@extends('frontend.layouts.app')
@section('content')

    <!-- ================ spinner ================= -->
    <div class="spinner">
        <div class="sk-folding-cube">

            @if (get_setting('home_slider_images') != null)
                @foreach ($slider_images as $key => $value)
                    <div class="{{'sk-cube1'. ($key+1) .' sk-cube'}}"></div>
                @endforeach
            @endif
        </div>
    </div>
{{--<div class="ads-popup-main">--}}
{{--    <div class="ads-popup">--}}
{{--        <div class="ads-float-popup popup-ani">--}}
{{--            <header>--}}
{{--                <img src="{{asset('v3_assets/img/logo.svg')}}" alt="logo"/>--}}
{{--            </header>--}}
{{--            <div class="ads-content">--}}
{{--                <div class="button-float-ads">--}}
{{--                    <button class="btn-close" href="#">--}}

{{--                    </button>--}}
{{--                </div>--}}
{{--                <h1>مطلوب موظفات مبيعات</h1>--}}
{{--                <h3>وخدمة عملاء</h3>--}}
{{--                <div class="ads-img">--}}
{{--                    <img src="{{static_asset('v3_assets/img/employ.png')}}" alt="ads-image"/>--}}
{{--                </div>--}}
{{--                <a href="{{route('frontend.job.get-started')}}"--}}
{{--                   class="defaultBtn">--}}
{{--                    قدم الان--}}
{{--                    <span></span>--}}
{{--                </a>--}}
{{--                <div class="ads-detail">--}}
{{--                    <ul class="list-unstyled">--}}
{{--                        <li>أوغندا</li>--}}
{{--                        <li> كينيا </li>--}}
{{--                        <li> بنجلادش </li>--}}
{{--                        <li> الفلبين </li>--}}
{{--                        <li> الهند </li>--}}
{{--                        <li> موريتانيا </li>--}}
{{--                        <li> جيبوتى </li>--}}
{{--                    </ul>--}}
{{--                </div>--}}

{{--                <div class="button-float-ads">--}}
{{--                    <div class="wrap">--}}
{{--                       اغلاق--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}

{{--    </div>--}}
{{--</div>--}}
    <!-- ================ spinner ================= -->
    <!-- ================ mainSlider ================= -->
    <section class="MainSlider">
        <div class="swiper MainSlider-container ">
            <div class="swiper-wrapper">
                <!-- swiper-slide -->
                @if (get_setting('home_slider_images') != null)
                    @foreach ($slider_images as $key => $value)
                        <!-- swiper-slide -->
                        <div class="swiper-slide  mainSlideItem"
                             style="background-image:url({{ uploaded_asset($slider_images[$key])}})">
                            <div class=" info">
                                <h4 class="hint"> {{ translate(json_decode(get_setting('home_slider_title_1'), true)[$key]) }}</h4>
                                <h2 class="sliderTitle"> {{ translate(json_decode(get_setting('home_slider_title_2'), true)[$key]) }} </h2>
                                @if(isset(json_decode(get_setting('home_slider_link'), true)[$key]))
                                    <a href="{{route( json_decode(get_setting('home_slider_link'), true)[$key] )}}"
                                       class="defaultBtn"> <i class="fa-solid fa-briefcase me-2"></i>
                                        {{ translate(json_decode(get_setting('home_slider_title_link'), true)[$key]) }}
                                        <span></span>
                                    </a>
                                @endif

                            </div>
                        </div>
                    @endforeach
                @endif

            </div>
            <div class="swiper-pagination"></div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </section>

    <!-- ============= Features =============  -->
    <section class="Features">
        <div class="container">
            <div class="row align-items-center g-3 pb-5">
                <div class="col-md-6">
                    <div class="aboutUs">
                        <h1 class="wow fadeInUp"> {{translate('من نحن')}}</h1>
                        <p class="wow fadeInUp">
                            {{ translate(get_setting('home_who_desc'))}}
                        </p>
                    </div>
                </div>
                <div class="col-md-6 d-none d-md-block">
                    <div class="aboutImg wow fadeInUp">
                        <img  class=" lazyimgs" data-original="{{uploaded_asset(get_setting('home_who_images'))}}"
                             alt="من نحن">
                    </div>
                </div>
            </div>
            <div class="Feature">
                <div class="row flex-wrap">
                    <!-- single Feature -->

                    @if (get_setting('home_banner1_images') != null)
                        @foreach ($banner_1_imags as $key => $value)
                            <!-- single Feature -->
                            <div class="col p-2 singleFeature wow fadeInUp">
                                <div class="info">
                                    <div class="content">

                                        <div class="icon">
                                            <i class="@if($key==0) fa-solid fa-headset  @elseif($key==1) fa-solid fa-laptop @elseif($key==2) fa-solid fa-users-gear @endif "></i>
                                        </div>
                                        <h3>
                                            {{ translate(json_decode(get_setting('home_banner1_title'), true)[$key]) }}
                                        </h3>
                                        <p>
                                            {{ translate(json_decode(get_setting('home_banner1_dec'), true)[$key])}}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- ============= ourServices =============  -->
    <section class="ourServices">
        <div class="container">
            <!--  section Top -->
            <div class="sectionTop">
                <div class="headTitle text-start wow fadeInUp">
                    <h2> {{translate('خدمات ')}} </h2>
                    <p> {{translate('تعرف علي الخدمات التي نقدمها للمجتمع ...')}}</p>
                </div>
                <!-- siper conrtol -->
                <div class="swiperBtns" data-aos="fade-up">
                    <div class="servicesSliderPrev swiper-button-prev"></div>
                    <div class="servicesSliderNext swiper-button-next"></div>
                </div>
            </div>
            <!-- slider -->
            <div class="swiper servicesSlider">
                <div class="swiper-wrapper">
                    <!-- slide -->
                    @if(isset($all_brands)&& !empty($all_brands))
                        @foreach($all_brands as $key=>$value)
                            <div class="swiper-slide">
                                <div class="flipCard" data-aos="zoom-in-up">
                                    <div class="cardFront"
                                         style="background: linear-gradient(to top, #000000a3, #0000001a), url({{ uploaded_asset($value->logo) }});">
                                        <div class="content">
                                            <h3> {{translate($value->name)}} </h3>
                                            <a href="{{route($value->link)}}" class="animatedLink">
                                                <i class="fa-light fa-bullseye-arrow"><span></span></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="cardBack">
                                        <div class="content">
                                            <img class=" lazyimgs"
                                                 data-original="{{static_asset('v3_assets/img/logo.svg')}}"
                                                 src="{{static_asset('v3_assets/img/logo.svg')}}"
                                                 alt="{{translate($value->name)}}">
                                            <h3> {{translate($value->name)}}</h3>
                                            <p>
                                                {{translate( $value->description)}}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </section>
    <!-- reqruitment-request-steps -->
    <section class="section reqruitment-request-steps">


        <div class="container">
            <div class="headTitle text-start wow fadeInUp">
                <h2>{{translate('خدمة العملاء والمبيعات')}} </h2>
                <p> {{translate('يمكنك التواصل مع طاقمنا المميز بكل سهولة ويسر')}} </p>
            </div>
            <div class="row gap-4 justify-content-center">
                @foreach($staffs as $key=>$val)
                    @if(!empty($val->user))

                            <?php
                            $whats  = preg_replace('/[^0-9]/', '',  $val->user->whatsapp_phone);
                            $link_wh='https://api.whatsapp.com/send?phone='.$whats;
                            $link_call='tel:'.$whats;

                            ?>


                        <div class="col-lg-3 col-md-6 col-12 p-4">
                            <div class="icon">
{{--                                @if($val->user->id == 4781)--}}
{{--                                    <img  alt="{{request()->path()}}" src="{{static_asset('v3_assets/img/avatar.webp') }}" >--}}
{{--                                @else--}}
                                <img  alt="{{request()->path()}}" src="{{static_asset('v3_assets/img/cust_1.png') }}" >
{{--                                @endif--}}
                            </div>
                            <h3> {{translate($val->user->name)}}</h3>
                            <div class="row">
                                <div class="icon_wh">
                                    <a  href="{{$link_wh}}">
                                    <button >
                                        <img  alt="{{request()->path()}}" src="{{static_asset('v3_assets/img/wh_icon.png') }}" >
                                    </button>
                                    </a>
                                </div>
                                <div class="icon_wh">
                                    <a  href="{{$link_call}}">
                                    <button >
                                        <img  alt="{{request()->path()}}" src="{{static_asset('v3_assets/img/call_icon.png') }}" >
                                    </button>
                                    </a>
                                </div>
                            </div>

                        </div>
                    @endif
                @endforeach

            </div>
        </div>
    </section>
    <!-- ============= countries =============  -->
    <section class="countries">
        <div class="container">
            <!-- Section Title -->
            <div class="headTitle text-lg-center wow fadeInUp">
                <h2 style="color:#d4af37">{{translate('عروضنا غير')}} </h2>
                <p style="color:#d4af37" > {{translate('يمكنك اختيار الدوالة التي تتم عملية الاستقدام منها')}} </p>
            </div>
            <div class="allCountries">
                <div class="row justify-content-center">

                    @foreach (Nationality::where('status', 1)->where('apper_home', 1)->get() as $key => $country)

                        <div class="col-6 col-md-3 p-1 wow flipInY">
                            <div class="country">
                                @if(!empty($country->flag_image))
                                    <img class=" lazyimgs" data-original="{{static_asset($country->flag_image)}}"
                                         alt="{{ translate($country->name) }}">

                                @else
                                    <img class=" lazyimgs"
                                         data-original="{{ static_asset('v3_assets/img/countries/'.$country->code.'.png') }}"
                                         alt="{{ translate($country->name) }}">

                                @endif
                                <h2> {{ translate($country->name) }} </h2>
                                @if(!empty($country->key_comment))

                                    <p>{{$country->key_comment}}</p>
                                @else
                                    <p>{{translate('مدة الاستقدام في خلال')." 30 ".translate(' يوم')}} </p>
                                @endif
                                    <h4>{{$country->salary.translate(' ريال')}} </h4>
<br>
                                    <a href="{{route('all_cvs',['nationality'=> $country->id])}}" class="animatedLink">
                                    {{translate('اطلب الآن')}}
                                    <i class="fa-regular fa-left-long ms-2"><span></span></i>
                                </a>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </section>
    <!-- ================ happy Clients ================= -->
    <section class="happyClients">

        <div class="container">
            <div class="headTitle text-start wow fadeInUp">
                <h2> {{translate('احصائيات')}} </h2>
                <p> {{translate('احصائيات نفتخر فيها  ...')}}</p>
            </div>
            <div class="row flex-wrap">
                @if (get_setting('recruitment_contract_roles_images') != null)
                    @foreach (json_decode(get_setting('recruitment_contract_roles_images'), true) as $key => $value)

                        <div class="col p-2">
                            <div class="specifications wow fadeInUp">
                                <i class="fa-duotone @if($key==0) fa-stopwatch @elseif($key==1) fa-hexagon-check @elseif($key==2) fa-handshake @endif"></i>
                                <h1 class="odometer" data-count="{{translate(json_decode(get_setting('recruitment_contract_roles_number'), true)[$key]) }}">00</h1>
                                <h5>
                                    {{ translate(json_decode(get_setting('recruitment_contract_roles_title'), true)[$key]) }}
                                </h5>
                            </div>
                        </div>
                    @endforeach
                @endif

            </div>
        </div>
    </section>

    <!-- ================ requirements ================= -->

    <section class="requirements">
        <div class="container">
            <div class="headTitle">
                <h2 class="wow fadeInUp"> {{translate('متطلبات الإستقدام')}} </h2>
                <p class="wow fadeInUp"> {{translate('هذه هي المتطلبات التي تحتاجها للاستقدام ...')}} </p>
            </div>
            <div class="row">
                @foreach($all_recruitment_requirements as $key=>$value)
                    <div class="col-md-6 p-2">
                        <div class="requirement">
                            <div class="head wow fadeInUp">
                                <h4>  {{translate($value->title)}}</h4>
                                @if(!empty($value->description))
                                    <p>
                                        {{translate($value->description)}}
                                        @if(!empty($value->link))
                                            <a href="{{$value->link}}"> {{translate('من هنا')}}</a>
                                        @endif
                                    </p>
                                @endif
                            </div>
                            @php
                                $req_detail = RecruitmentRequirementDetail::where('recruitment_requirement_id', $value->id)->get();
                            @endphp
                            <ul>
                                @foreach($req_detail as $key2 =>$value2)
                                    <li class="wow fadeInUp">
                                        <div class="icon">
                                            <i class="fa-regular @if($key2==0) fa-passport @elseif($key2==1) fa-calendar-lines-pen @elseif($key2==2) fa-address-card @elseif($key2==3) fa-headset @elseif($key2==4) fa-building-columns   @endif"></i>
                                        </div>
                                        <p>    {{translate($value2->title)}} </p>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </section>


    <!--<section class="requirements">-->
    <!--    <div class="container">-->
    <!--        <div class="row viedo-container">-->
    <!--            <div class="col-12">-->

    <!--                <iframe  height="450" width="100%" src="https://www.youtube.com/embed/uNmeLE5I4fs?autoplay=1"-->
    <!--                         title="روافد نجد للاستقدام" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--</section>-->
    <!-- ================ contact Form ================= -->
    <section class="contactForm">
        <div class="container">
            <div class="row">
                <div class="col-md-6 p-2  mb-5 mb-md-0 wow fadeInUp">
                    <div class="headTitle text-start">
                        <h2> {{translate('تواصل معنا')}}  </h2>
                        <p>   {{translate('فريق الدعم الفنى معك على مدار الساعة لخدمتك وللأجابة عن أسئلتكم واستفساراتكم')}}</p>
                    </div>
                    <form action="javascript:void(0)" method="post" class="row needs-validation" novalidate>
                        <div class="col-md-12 p-2">
                            <label class="form-label" for="contact_name"> <i
                                        class="fas fa-user me-2"></i> {{translate('الاسم كامل').'*'}}</label>
                            <input type="text" name="name" id="contact_name" class="form-control" required>
                            <div class="invalid-feedback  name_err"></div>
                            <div class="valid-feedback">{{translate('صحيح')}}</div>
                            <div class="invalid-feedback">{{translate('هذا الحقل مطلوب')}}</div>
                        </div>
                        <div class="col-md-6 p-2">
                            <label class="form-label" for="contact_phone"><i
                                        class="fas fa-phone-alt me-2"></i> {{translate('رقم الهاتف ').'*'}} </label>
                            <input type="number" name="phone" id="contact_phone" class="form-control" required>
                            <div class="invalid-feedback phone_err"></div>
                            <div class="valid-feedback">{{translate('صحيح')}}</div>
                            <div class="invalid-feedback ">{{translate('هذا الحقل مطلوب')}}</div>
                        </div>
                        <div class="col-md-6 p-2">
                            <label class="form-label" for="contact_subject"> <i
                                        class="fa-solid fa-comment-lines me-2"></i>{{translate('الموضوع').'*'}} </label>
                            <select name="subject" class="form-control" required id="contact_subject">
                                <option value="">{{translate('اختار')}}</option>

                                <option value="استفسار">{{translate('استفسار')}}</option>
                                <option value="شكوي">{{translate('شكوي')}}</option>
                                <option value="اقتراح">{{translate('اقتراح')}} </option>
                            </select>
                            <div class="invalid-feedback subject_err"></div>
                            <div class="valid-feedback">{{translate('صحيح')}}</div>
                            <div class="invalid-feedback">{{translate('هذا الحقل مطلوب')}}</div>

                        </div>
                        <div class="col-md-12 p-2">
                            <label class="form-label" for="contact_massage"> <i
                                        class="fas fa-feather-alt me-2"></i> {{translate('اكتب رسالتك').'*'}} </label>
                            <textarea class="form-control" id="contact_massage" name="massage" rows="5"
                                      required></textarea>
                            <div class="invalid-feedback massage_err"></div>
                            <div class="valid-feedback">{{translate('صحيح')}}</div>
                            <div class="invalid-feedback">{{translate('هذا الحقل مطلوب')}}</div>
                        </div>
                        <div class="col-md-12 text-center p-2">
                            <button type="submit" class="defaultBtn bttn-submit"> {{translate('ارسال')}} <i
                                        class="fas fa-paper-plane ms-2"></i>
                                <span></span>
                            </button>
                        </div>
                    </form>

                </div>
                <div class="col-md-6 p-2 wow fadeInUp">
                    <section class="googleMap ">
{{--                        <iframe--}}
{{--                                src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d57946.84623396069!2d46.75688!3d24.806481!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xc74fdd6f15256594!2z2YXZg9iq2Kgg2LHZiNin2YHYryDZhtis2K8g2YTZhNil2LPYqtmC2K_Yp9mF!5e0!3m2!1sar!2ssa!4v1650724949947!5m2!1sar!2ssa"--}}
{{--                                style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0" loading="lazy"--}}
{{--                                referrerpolicy="no-referrer-when-downgrade">--}}
{{--                        </iframe>--}}
                        {!! get_setting('our_location') !!}
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
                    @foreach($all_recruitment_references as $key=>$val )
                        <div class="swiper-slide">
                            <div class="referenceLogo ">
                                <img class=" lazyimgs" data-original="{{ uploaded_asset($val->image) }}"
                                     alt="{{$val->title}}">
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
                var email = '';
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
                $('.invalid-feedback').show();
                $.each(msg, function (key, value) {
                    console.log(key);
                    $('.' + key + '_err').text(value);
                });
            }
        });

        new Swiper('.reviewsSlider', {
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            centeredSlides: false,
            loop: true,
            autoHeight: false,
            speed: 3000,
            autoplay: {
                delay: 500,
                disableOnInteraction: false,
            },
            breakpoints: {
                // when window width is <= 499px
                499: {
                    slidesPerView: 1,
                    spaceBetween: 30
                },
                // when window width is <= 999px
                999: {
                    slidesPerView: 3,
                    spaceBetween: 30
                }
            }
        });
        //         new Swiper(".reviewsSlider",{
        //                 navigation: {
        //                     nextEl: '.swiper-button-next',
        //                     prevEl: '.swiper-button-prev',
        //                 },
        //             slidesPerView: "auto",
        //             spaceBetween: 5,
        //
        //             centeredSlides:!0,
        //             loop:true,
        //             speed:8000,
        //                 autoplay: {
        //                     delay: 1500,
        //                     disableOnInteraction: false,
        //                 },
        // })
    </script>
@endsection