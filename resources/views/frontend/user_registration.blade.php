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
            <button onclick="goBack()" class="Back">
                <i class="fas fa-angle-left"></i>
            </button>
            <ul>
                <li>
                    <a href="{{ route('home') }}"> {{translate('الرئيسية')}} </a>
                </li>
                <li>
                    <a href="{{ route('user.registration') }}" class="active"> {{translate('انشاء حساب')}} </a>
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
        <!-- register form -->
        <section class="account">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-lg-6 m-auto p-2">
                        <div class="card">
                            <img class="loginImg" src="{{static_asset('v3_assets/img/register.svg')}}"  alt="{{request()->path()}}" >

                            <form class="row needs-validation " novalidate action="{{ route('register') }}" method="POST">
                                    @csrf
                                <div class="col-12 p-2">
                                    <label for="name" class="form-label"> <i class="fas fa-user me-2"></i>{{translate('الاسم كامل')}}<span class="text-danger">*</span></label>
                                    <input type="text" name="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"   placeholder="{{translate('أدخل اسمك بالكامل')}}"
                                           id="fisrtNameId"  pattern="^{5,15}$" required autofocus>
                                    @if ($errors->has('name'))
                                        <span class="text-danger error-text">
                                        {{ $errors->first('name') }}
                                    </span>
                                    @endif
                                    <div class="valid-feedback">{{translate('صحيح')}}</div>
                                    <div class="invalid-feedback">{{translate('طول النص 5 الى 15')}}</div>
                                </div>
                                <div class="col-12 p-2">
                                    <label for="Phone" class="form-label"> <i class="fas fa-phone-alt me-2"></i> {{translate('رقم الهاتف')}}
                                        <span class="text-danger">*</span> </label>
                                    <input type="tel" placeholder="966/05********" id="tel"
                                           class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}"
                                           value="{{ old('phone') }}" name="phone" maxlength="13" minlength="10" pattern="^((?:[+?0?0?966]+)(?:\s?\d{2})(?:\s?\d{7}))$"  required/>
                                    @if ($errors->has('phone'))
                                        <span class="text-danger error-text phone_err">
                                          <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                    @endif
                                    <div id="phoneValid" class="valid-feedback">{{translate('صحيح')}}</div>

                                    <div id="phoneinValid"  class="invalid-feedback">{{translate('يجب ان يكون الهاتف على الصيغة 966/05********')}}</div>
                                </div>

                                <div class="col-md-6 p-2">
                                    <label for="password" class="form-label "> <i class="fas fa-key me-2"></i> {{translate('الرقم السري')}}<span class="text-danger">*</span></label>
                                    <input type="password" id="pwdId"
                                           class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                           placeholder="{{  translate('Password') }}" name="password"  minlength="6"   title="{{translate('Must contain at least one number and one uppercase and lowercase letter, and at least 6 or more characters')}}" required>

                                    @if ($errors->has('password'))
                                        <span class="text-danger error-text name_err">
                                          <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                    <div   class="valid-feedback">{{translate('صحيح')}}</div>
                                    <div class="invalid-feedback">{{translate('طول كلمة السر يجب ان يكون اكثر من 6')}}</div>

                                </div>
                                <input type="hidden" name="country_code" value="">

                                <div class="col-md-6 p-2">
                                    <label for="repetPassword" class="form-label myCpwdClass"> <i class="fas fa-key me-2"></i>
                                        {{translate('تأكيد الرقم السري')}}<span class="text-danger">*</span>
                                    </label>
                                    <input type="password" class="form-control" id="cPwdId" minlength="6" name="password_confirmation"   title="{{translate('Must contain at least one number and one uppercase and lowercase letter, and at least 6 or more characters')}}"  placeholder="*****" required>
                                    <div  id="cPwdValid" class="valid-feedback">{{translate('كلمة السر متطابقة')}}</div>
                                    <div  id="cPwdInvalid"  class="invalid-feedback">{{translate('يجب ان تكون كلمة السر وتاكيد كلة السر متماثلتان')}}</div>
                                </div>
                                <div class="col-12 pt-4 p-2 text-center">
                                    <button class="defaultBtn " id="submitBtn" type="submit">
                                        <p class="px-5"> {{translate('ارسال')}} </p>
                                        <span></span>
                                    </button>
                                </div>

                            </form>
                            <p class="text-center pt-4 pb-2"> {{translate('بالفعل لدى حساب ؟')}} <a href="{{ route('user.login') }}">  {{ translate('Login')}} </a> </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>








@endsection
@section('script')

<script>


    $(document).ready(function(){
        // ----------- Set all elements as INVALID --------------
        var myInputElements = document.querySelectorAll(".form-control");
        var i;
        // for (i = 0; i < myInputElements.length; i++) {
        //     myInputElements[i].classList.add('is-invalid');
        //     myInputElements[i].classList.remove('is-valid');
        // }
        // ------------ Check passwords similarity --------------
        $('#tel').on('keyup', function () {
           var text=  toEnglishNumber($('#tel').val())
            $('#tel').val(text);

            var char =   $('#tel').val();
            var charLength =   $('#tel').val().length;

            let pattern = /^((?:[+?0?0?966]+)(?:\s?\d{2})(?:\s?\d{7}))$/;
            console.log(char.substring(0,3));

            if (pattern.test(char) && charLength !=11 && ((char.substring(0,3)=='966' && charLength ==12) || (char.substring(0,2)=='05' && charLength ==10) )  ) {
                console.log("p");
                $('#phoneValid').show();
                $('#phoneInvalid').hide();
                $('#tel').removeClass('is-invalid');
                $('#tel').addClass('is-valid');
                $("#submitBtn").attr("disabled",false);
            } else {
                $('#phoneValid').hide();
                $('#phoneInvalid').show();
                $('#tel').removeClass('is-valid');
                $('#tel').addClass('is-invalid');
                $("#submitBtn").attr("disabled",true);
            }



        });
        function toEnglishNumber(strNum) {
            var ar = '٠١٢٣٤٥٦٧٨٩'.split('');
            var en = '0123456789'.split('');
            strNum = strNum.replace(/[٠١٢٣٤٥٦٧٨٩]/g, x => en[ar.indexOf(x)]);
            strNum = strNum.replace(/[^\d]/g, '');
            // $('#template').validate();
            return strNum;
        }

        $('#pwdId, #cPwdId').on('keyup', function () {
            // var text=  toEnglishNumber($('#pwdId').val())
            // $('#pwdId').val(text);
            // var text2=  toEnglishNumber($('#cPwdId').val())
            // $('#cPwdId').val(text2);
            if ($('#pwdId').val() != '' && $('#cPwdId').val() != '' && $('#pwdId').val() == $('#cPwdId').val() ) {
                $('#cPwdValid').show();
                $('#cPwdInvalid').hide();
                $('#cPwdInvalid').html('{{translate('كلمة السر متطابقة')}}').css('color', 'green');
                $('.myCpwdClass').addClass('is-valid');
                $('.myCpwdClass').removeClass('is-invalid');
                $("#submitBtn").attr("disabled",false);
                // $('#submitBtn').addClass('btn-primary').removeClass('btn-secondary');
                for (i = 0; i < myInputElements.length; i++) {
                    var myElement = document.getElementById(myInputElements[i].id);
                    if (myElement.classList.contains('is-invalid')) {
                        $("#submitBtn").attr("disabled",true);
                        // $('#submitBtn').addClass('btn-secondary').removeClass('btn-primary');
                        break;
                    }
                }
            } else {
                $('#cPwdValid').hide();
                $('#cPwdInvalid').show();
                $('#cPwdInvalid').html('{{translate('يجب ان تكون كلمة السر وتاكيد كلة السر متماثلتان')}}').css('color', 'red');
                $('.myCpwdClass').removeClass('is-valid');
                $('.myCpwdClass').addClass('is-invalid');
                $("#submitBtn").attr("disabled",true);
                // $('#submitBtn').addClass('btn-secondary').removeClass('btn-primary');
            }
        });

        // ------------------------------------------------------
    });
</script>
@endsection
