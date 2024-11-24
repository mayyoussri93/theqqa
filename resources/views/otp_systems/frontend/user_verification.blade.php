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
    <h1 style="display: none">{{translate('انشاء حساب')}} </h1>
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
                    <a href="{{route('verification')}}" class="active"> {{translate('كود التفعيل')}} </a>
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
                            <img class="loginImg" src="{{ static_asset('v3_assets/img/code.svg') }}" alt="">
                            <form action="{{ route('verification.submit') }}" method="POST"  class="row">
                                    @csrf
                                <div class="col-12 p-2 text-center">
                                    <label class="form-label">  {{translate(' برجاء كتابة كود التفعيل المرسل الى الرقم')}} <span>   <?php echo substr(auth::user()->phone,0, -7) . 'xxxxxxx'; ?> </span> </label>
                                    <br>
{{--                                    <label class="form-label">  {{translate(' استخدم  كود التفعيل 2244 مؤقتا')}}  </label>--}}
                                    <div class="vCode " id="vCode" >
                                        <input type="number"  name="verification_code[0]" class="vCode-input mx-1" max="9" maxlength="1">
                                        <input type="number"  name="verification_code[1]" class="vCode-input mx-1" max="9" maxlength="1">
                                        <input type="number"  name="verification_code[2]" class="vCode-input mx-1" max="9" maxlength="1">
                                        <input type="number"  name="verification_code[3]" class="vCode-input mx-1" max="9"  maxlength="1">
                                    </div>
                                </div>
                                <div class="col-12 p-2 text-center">
                                    <button class="defaultBtn " type="submit">
                                        <p class="px-5"> {{translate('تأكيد')}} </p>
                                        <span></span>
                                    </button>
                                </div>
                            </form>
                            <p class="text-center pt-4 pb-2"> {{translate('لم يصلنى كود التفعيل')}} <a href="{{ route('verification.phone.resend') }}">   {{translate('إعادة ارسال')}} </a> </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>







@endsection

@section('script')
    <!-- BS JavaScript -->
    <script>

        window.onload = function () {
            if (typeof history.pushState === "function") {


                history.pushState("jibberish", null, null);
                window.onpopstate = function () {
                    history.pushState('newjibberish', null, null);
                };
            }
            else {
                var ignoreHashChange = true;

                window.onhashchange = function () {
                    if (!ignoreHashChange) {
                        ignoreHashChange = true;
                        window.location.hash = Math.random();
                    }
                    else {

                        ignoreHashChange = true;
                    }
                };
            }
        };

        const inputElements = [...document.querySelectorAll('input.vCode-input')]

        inputElements.forEach((ele,index)=>{
            ele.addEventListener('keydown',(e)=>{
                // if the keycode is backspace & the current field is empty
                // focus the input before the current. Then the event happens
                // which will clear the "before" input box.
                if(e.keyCode === 8 && e.target.value==='') inputElements[Math.max(0,index-1)].focus()
            })
            ele.addEventListener('input',(e)=>{
                // take the first character of the input
                // this actually breaks if you input an emoji like 👨‍👩‍👧‍👦....
                // but I'm willing to overlook insane security code practices.
                const [first,...rest] = e.target.value
                e.target.value = first ?? '' // first will be undefined when backspace was entered, so set the input to ""
                const lastInputBox = index===inputElements.length-1
                const insertedContent = first!==undefined
                if(insertedContent && !lastInputBox) {
                    // continue to input the rest of the string
                    inputElements[index+1].focus()
                    inputElements[index+1].value = rest.join('')
                    inputElements[index+1].dispatchEvent(new Event('input'))
                }
            })
        })


    </script>
@endsection
