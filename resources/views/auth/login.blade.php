@extends('backend.layouts.layout')

@section('content')
    @php
//        $header_logo = get_setting('header_logo');
    @endphp

    <div class="auth-wrapper d-flex no-block justify-content-center align-items-center" style="background:#ffffff no-repeat center center;">
        <div class="auth-box p-4 bg-white rounded">
            <div>
                <div class="logo text-center">
                    <span class="db"><img src="{{static_asset('front_asset/img/logo_w.png')}}" alt="logo" style="width: auto; height: 200px" /></span>
                    <h5 class="font-weight-medium mb-3 mt-1">{{translate('تسجيل الدخول')}}</h5>
                </div>
                <!-- Form -->
                <div class="row mt-4">
                    <div class="col-12">
                        <form class="form-horizontal  needs-validation" novalidate method="POST" action="{{ route('login') }}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <div class="form-floating mb-3">
                                <input type="email" class="form-control form-input-bg" id="tb-email" placeholder="name@example.com" name="email" value="{{ old('email') }}"  required>
                                <label for="tb-email">{{translate('البريد الالكترونى')}}</label>
                                <div class="invalid-feedback">
                                    {{translate('برجاء ادخال البريد الالكترونى')}}
                                </div>
                            </div>

                            <div class="form-floating mb-3">
{{--                                <input type="password" class="form-control form-input-bg" id="text-password" placeholder="*****" required  name="password">--}}
{{--                                <label for="text-password">{{translate('الرقم المرور')}}</label>--}}
                                <label for="text-password" class="form-label" >{{translate(' كلمة المرور')}}</label>
                                <div class="input-group" style=" height: 50px;  border-right: 1px solid #808080;" id="password"  >

                                    <input type="password" class="form-control border-end-0" id="text-password" name="password" placeholder="************"> <a style="border: 1px solid; margin-right: 0px;" onclick="myFunction()"  href="javascript:;" class="input-group-text bg-transparent"><i class="fa fa-eye-slash"  aria-hidden="true"  ></i></a>

                                </div>
                                <div class="invalid-feedback">
                                    {{translate('برجاء ادخال الرقم المرور')}}
                                </div>
                            </div>

                            <div class="d-flex align-items-center mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="r-me1"  name="remember" checked >
                                    <label class="form-check-label" for="r-me1">
                                        {{translate('تذكرنى')}}
                                    </label>
                                    <div class="invalid-feedback">
                                    </div>
                                </div>

                            </div>

                            <div class="d-flex align-items-stretch">
                                <button type="submit" class="btn btn-info d-block w-100">{{translate('تسجيل الدخول')}} </button>
                            </div>
                            <div class="form-group mb-0 mt-4">
                                <div class="col-sm-12 justify-content-center d-flex">
                                    <a href="{{ route('password_request_back') }}" class="text-info font-weight-medium ms-1">{{translate('هل نسيت كلمة المرور ؟')}} </a>
                                </div>
                            </div>

                        </form>


                    </div>
                </div>
            </div>
        </div>
    </div>






@endsection

@section('script')
    <script type="text/javascript">
        $('#to-recover').on("click", function() {
            $("#loginform").hide();
            $("#recoverform").fadeIn();
        });

        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function () {
            'use strict'

            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.querySelectorAll('.needs-validation')

            // Loop over them and prevent submission
            Array.prototype.slice.call(forms)
                .forEach(function (form) {
                    form.addEventListener('submit', function (event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }

                        form.classList.add('was-validated')
                    }, false)
                })
        })()
    </script>
    <Script>

        function myFunction() {
            var x = document.getElementById("text-password");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }

    </Script>
@endsection