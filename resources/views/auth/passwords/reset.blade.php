@extends('backend.layouts.layout')

@section('content')
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
                        <form class="form-horizontal  needs-validation" novalidate method="POST" action="{{ route('password.update') }}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">




                            <div class="form-floating mb-3">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $email ?? old('email') }}" placeholder="{{ translate('Email') }}" required autofocus>
                                <label for="tb-email">{{translate('البريد الالكترونى')}}</label>
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                            </div>

                            <div class="form-floating mb-3">
                                <input id="code" type="text" class="form-control{{ $errors->has('code') ? ' is-invalid' : '' }}" name="code" value="{{ old('code') }}" placeholder="Code" required autofocus>
                                <label for="tb-code">{{translate('الكود')}}</label>
                                @if ($errors->has('code'))
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('code') }}</strong>
                                </span>
                                @endif
                            </div>

                            <div class="form-floating mb-3">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="{{ translate('New Password') }}" required>
                                <label for="tb-password">{{translate('كلمة المرور')}}</label>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                                @endif
                            </div>

                            <div class="form-floating mb-3">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="{{ translate('Confirm Password') }}" required>
                                <label for="tb-password">{{translate('تاكيد كلمة المرور')}}</label>

                            </div>



                            <div class="d-flex align-items-stretch">
                                <button type="submit" class="btn btn-info d-block w-100">{{translate('تغير كلمة المرور')}} </button>
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
@endsection