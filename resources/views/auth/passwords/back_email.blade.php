@extends('backend.layouts.layout')

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



    <div class="auth-wrapper d-flex no-block justify-content-center align-items-center" style="background:#ffffff no-repeat center center;">
        <div class="auth-box p-4 bg-white rounded">
            <div>
                <div class="logo text-center">
                    <span class="db"><img src="{{static_asset('front_asset/img/logo_w.png')}}" alt="logo" style="width: auto; height: 200px" alt="logo" /></span>
                    <h5 class="font-weight-medium mb-3 mt-1">{{translate('أعادة تعين كلمة المرور')}}</h5>
                </div>
                <!-- Form -->
                <div class="row mt-4">
                    <div class="col-12">
                        <form class="form-horizontal  needs-validation" novalidate method="POST" action="{{ route('password.email') }}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">


                            <div class="form-floating mb-3">
                                <input type="email" class="form-control form-input-bg" id="tb-email" placeholder="name@example.com" name="email" value="{{ old('email') }}"  required>
                                <label for="tb-email">{{translate('البريد الالكترونى')}}</label>
                                <div class="invalid-feedback">
                                    {{translate('برجاء ادخال البريد الالكترونى')}}
                                </div>
                            </div>




                            <div class="d-flex align-items-stretch">
                                <button type="submit" class="btn btn-info d-block w-100">{{translate('ارسال رمز أعادة التعين')}} </button>
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
