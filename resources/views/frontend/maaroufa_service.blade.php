@php use App\Models\Nationality; @endphp
@php use App\Models\RecruitmentRequirementDetail; @endphp
@php use Carbon\Carbon; @endphp
@php use Illuminate\Support\Facades\Cache; @endphp
@extends('frontend.layouts.app')
@section('content')
    {{--        maroofa service--}}
        <section>
            <!-- ================ Header ================= -->
            <div id="Header" class="sticky-top"></div>
            <!-- ================ /Header ================= -->
            <!--(((((((((((((((((((((((()))))))))))))))))))))))-->
            <!--((((((((((((((((((( content )))))))))))))))))))-->
            <!--(((((((((((((((((((((((()))))))))))))))))))))))-->
            <content>
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
                <!-- ================ musaned ================= -->
                <section class="musaned">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-md-6 p-2">
                                <div class="intro">
                                    <img  alt="{{request()->path()}}" src="{{asset('assets/img/musand.svg')}}" class="wow fadeInUp" >
                                    <h1 class="head wow fadeInUp">خدمة معروفة</h1>
                                    <h3 class="info wow fadeInUp">
                                        هي خدمة تمكنك من استقدام عاملة منزلية مختارة من قبلك.

                                    </h3>
                                </div>
                            </div>
                            <div class="col-md-6 p-2">
                                <div class="introImg">
                                    <img   alt="{{request()->path()}}" src="{{asset('assets/img/know_img.svg')}}" >
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- ================ /musaned ================= -->
                <!-- ================ musaned Features ================= -->
                <section class="musanedFeatures">
                    <div class="container">
                        <div class="musanedServices">
                            <div class="headTitle wow fadeInUp">
                                <h2> مميزات الخدمة </h2>
                            </div>
                            <!-- <iframe src="https://www.youtube.com/embed/wlLjqeDDi2Y"
                              allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                              allowfullscreen=""></iframe> -->
                        </div>
                        <div class="Feature">
                            <div class="row flex-wrap">
                                <!-- single Feature -->
                                <div class="col p-2 singleFeature wow fadeInUp">
                                    <div class="info">
                                        <div class="content">
                                            <div class="icon">
                                                <i class="fa-solid fa-credit-card"></i>
                                            </div>
                                            <h3>الاستقدام بتكلفة أقل</h3>
                                            <br>
                                            <h4 >
                                                تتيح لك الخدمة استقدام عاملة منزلية بتكلفة محددة ومنخفضة.
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                                <!-- single Feature -->
                                <div class="col p-2 singleFeature wow fadeInUp">
                                    <div class="info">
                                        <div class="content">
                                            <div class="icon">
                                                <i class="fa-solid fa-hourglass-clock"></i>                  </div>
                                            <h3>توفير الوقت</h3>
                                            <br>
                                            <h4 >
                                                توفر عليك خدمة معروفة الوقت المستغرق في عملية الاستقدام والبحث عن العاملة المناسبة.
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                                <!-- single Feature -->
                                <div class="col p-2 singleFeature wow fadeInUp">
                                    <div class="info">
                                        <div class="content">
                                            <div class="icon">
                                                <i class="fa-solid fa-users"></i>
                                            </div>
                                            <h3 > اختيار عاملة منزلية معروفة   </h3>
                                            <br>
                                            <h4 >
                                                تمكنك خدمة معروفة من استقدام عاملتك المنزلية بالاسم.
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- ================ /musaned Features ================= -->
                <!-- ================ musaned recruitment ================= -->

                <section class="happyClients">
                    <div class="container">
                        <div class="headTitle wow fadeInUp">
                            <h4> الخطوات  </h4>
                            <h1>لبدأ رحلة الاستقدام الأمثل</h1>
                        </div>
                        <div class="row flex-wrap">
                            <div class="col p-2">
                                <div class="specifications wow fadeInUp">
                                    <img src="{{asset('assets/img/step1.svg')}}"  alt="{{request()->path()}}" class="wow fadeInUp" >

                                    <h2 > اختيار عاملة منزلية معروفة   </h2>
                                    <br>
                                    <h5 >
                                        تمكنك خدمة معروفة من استقدام عاملتك المنزلية بالاسم.
                                    </h5>
                                </div>
                            </div>
                            <div class="col p-2">
                                <div class="specifications wow fadeInUp">
                                    <i class="fa-duotone fa-hexagon-check"></i>
                                    <h2 > اختيار التأشيرة  </h2>
                                    <br>
                                    <h5 >
                                        تمكنك خدمة معروفة من استقدام عاملتك المنزلية بالاسم.
                                    </h5>
                                </div>
                            </div>
                            <div class="col p-2">
                                <div class="specifications wow fadeInUp">
                                    <i class="fa-duotone fa-handshake"></i>
                                    <h2 > اختيار عاملة منزلية معروفة   </h2>
                                    <br>
                                    <h5 >
                                        تمكنك خدمة معروفة من استقدام عاملتك المنزلية بالاسم.
                                    </h5>
                                </div>
                            </div>
                            <div class="col p-2">
                                <div class="specifications wow fadeInUp">
                                    <i class="fa-duotone fa-handshake"></i>
                                    <h2 > اختيار عاملة منزلية معروفة   </h2>
                                    <br>
                                    <h5 >
                                        تمكنك خدمة معروفة من استقدام عاملتك المنزلية بالاسم.
                                    </h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- ================ /musaned recruitment ================= -->
                <!-- ================ musaned Fees ================= -->
                <section class="musanedFees">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-md-9 p-2">
                                <div class="headTitle wow fadeInUp">
                                    <h4> رسوم </h4>
                                    <h2> الاستقدام مع مساند </h2>
                                </div>
                                <p>
                                    سداد رسوم تاشيره العمالة المنزلية الخاصة بك عبر الخدمات الحكوميه في البنك او عن طريق قنوات الدفع عبر
                                    الإنترنت حيث يوفر مساند عدة طرق دفع آمنة ، يمكن للمستخدم اختيار ما هو مناسب من بين مدى أو فيزا أو
                                    ماستركارد
                                </p>
                                <div class="images">
                                    <img  alt="{{request()->path()}}" src="{{asset('assets/img/mc.webp')}}">
                                    <img  alt="{{request()->path()}}" src="{{asset('assets/img/visa.webp')}}">
                                    <img  alt="{{request()->path()}}" src="{{asset('assets/img/mada.webp')}}">
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- ================ /musaned Fees ================= -->
                <!-- ================ musaned app ================= -->
                <section class="musanedApp">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6 p-0 p-md-2 d-none d-md-block">
                                <div class="appImg">
                                    <img  alt="{{request()->path()}}" src="{{asset('assets/img/app.webp')}}" >
                                </div>
                            </div>
                            <div class="col-md-6 p-2">
                                <div class="info">
                                    <img  alt="{{request()->path()}}" src="{{asset('assets/img/musand.svg')}}" >
                                    <h4>تطبيق مساند للجوال لكلى النظامين الاندرويد والايفون </h4>
                                    <p>تطبيق مساند للهاتف المحمول هو تطبيق مدعوم من وزارة العمل في المملكة العربية السعودية لخدمة العمالة
                                        المنزلية حيث يمكنك من خلاله طلب تأشيرة توظيف أو تتبع حالة التأشيرات التي تم طلبها مسبقًا بسهولة ، كما
                                        يمكنك استخدام آلية توثيق العامل.
                                    </p>

                                    <div class="appImg d-md-none">
                                        <img  alt="{{request()->path()}}" src="{{asset('assets/img/app.webp')}}" >
                                    </div>

                                    <div class="links">
                                        <a href="#!" target="_blank">
                                            <img  alt="{{request()->path()}}" src="{{asset('assets/img/google-play-android.webp')}}" >
                                        </a>
                                        <a href="#!" target="_blank">
                                            <img  alt="{{request()->path()}}" src="{{asset('assets/img/apple-iphone-ios.webp')}}" >
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- ================ /musaned app ================= -->
            </content>
        </section>

@endsection