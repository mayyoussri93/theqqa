@extends('frontend.layouts.app')

@section('content')
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
                    <a href="{{ route('password.request') }}" class="active">{{ translate('كلمة السر')}} </a>
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
        <section class="account">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-lg-6 m-auto p-2">
                        <div class="card">
                            <img class="loginImg"  src="{{ static_asset('v3_assets/img/reset.svg') }}"  alt="{{ env('APP_NAME') }}">
                            <form   method="POST" action="{{ route('password.update.phone') }}" class="row">
                                @csrf
                                <input  type="hidden" class="form-control" name="phone" value="{{ $phone}}" required>

                                <div class="col-md-12 p-2">
                                    <label for="password" class="form-label" > <i class="fas fa-code-commit me-2"></i> {{translate('ادخل الكود')}}  </label>
                                    <input type="number" class="form-control"  name="code" value="{{ $email ?? old('code') }}" placeholder="{{translate('ادخل الكود')}}" required>
                                </div>
                                <div class="col-md-6 p-2">
                                    <label for="password" class="form-label"> <i class="fas fa-key me-2"></i> {{translate('الرقم السري الجديد')}}  </label>
                                    <input type="password" class="form-control" name="password" id="password" required placeholder="*****">
                                </div>
                                <div class="col-md-6 p-2">
                                    <label for="repetPassword" class="form-label"> <i class="fas fa-key me-2"></i> {{translate('تأكيد كلمة المرور')}} </label>
                                    <input type="password" class="form-control" id="repetPassword" name="password_confirmation" required placeholder="*****">
                                </div>
                                <div class="col-12 py-4 p-2 text-center">
                                    <button class="defaultBtn " type="submit"> <p class="px-5">  {{ translate('تأكيد') }} </p>
                                        <span></span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>


@endsection
