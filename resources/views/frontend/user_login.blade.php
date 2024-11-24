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
    <h1 style="display: none">{{get_seo_h1_setting(request()->path())}} </h1>
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
        <button onclick="goBack()"  class="Back">
            <i class="fas fa-angle-left"></i>
        </button>
        <ul>
            <li>
                <a href="{{ route('home') }}"> {{translate('الرئيسية')}} </a>
            </li>
            <li>
                <a href="{{ route('user.login') }}" class="active">{{ translate('Login')}} </a>
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
    <!-- login form -->
    <section class="account">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-lg-6 m-auto p-2">
                    <div class="card">
                        <img class="loginImg" src="{{ static_asset('v3_assets/img/login.svg') }}"  alt="{{ env('APP_NAME') }}">

                        <form class="row  needs-validation " novalidate  method="POST" role="form" action="{{ route('login') }}">
                            @csrf
                            <div class="col-12 p-2">
                                <label for="phone" class="form-label"> <i class="fas fa-phone me-2"></i> {{translate('رقم الهاتف')}} </label>
                                <input type="tel" maxlength="13" id="tel" minlength="10" pattern="^((?:[+?0?0?966]+)(?:\s?\d{2})(?:\s?\d{7}))$" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus  placeholder="{{translate(' ادخل رقم الهاتف')}}">
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-12 p-2">
                                <label for="password" class="form-label"> <i class="fas fa-key me-2"></i> {{translate('الرقم السري')}} </label>
                                <input id="pwdId" type="password" minlength="6" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required placeholder="*****">
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="col-12 p-2">
                                <div class="d-flex justify-content-between ">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="remember"> {{ translate('Remember Me') }} </label>
                                    </div>
                                        <a href="{{ route('password.request') }}"> {{translate('Forgot password ?')}} </a>

                                </div>
                            </div>
                            <div class="col-12 p-2 text-center">
                                <button class="defaultBtn " type="submit">
                                    <p class="px-5"> {{ translate('Login') }} </p>
                                    <span></span>
                                </button>
                            </div>
                        </form>
                        <p class="text-center pt-4 pb-2">{{translate(' ليس لديك حساب ؟')}} <a href="{{ route('user.registration') }}"> {{translate('تسجيل حساب جديد')}} </a> </p>
                    </div>
                </div>
            </div>
        </div>
    </section>







@endsection


@section('script')

    <script>


        $(document).ready(function(){
            // ----------- Set all elements as INVALID ------------
            $('#tel').on('keyup', function () {
                var text=  toEnglishNumber($('#tel').val())
                $('#tel').val(text);
            });
            function toEnglishNumber(strNum) {
                var ar = '٠١٢٣٤٥٦٧٨٩'.split('');
                var en = '0123456789'.split('');
                strNum = strNum.replace(/[٠١٢٣٤٥٦٧٨٩]/g, x => en[ar.indexOf(x)]);
                strNum = strNum.replace(/[^\d]/g, '');
                // $('#template').validate();
                return strNum;
            }

            // $('#pwdId').on('keyup', function () {
            //     var text=  toEnglishNumber($('#pwdId').val())
            //     $('#pwdId').val(text);
            // });

            // ------------------------------------------------------
        });
    </script>
@endsection
