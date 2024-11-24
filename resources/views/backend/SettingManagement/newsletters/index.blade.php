@extends('backend.layouts.app')

@section('content')
    <div class="page-wrapper">

        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="row page-titles">
            <div class="col-md-5 col-12 align-self-center">
                <h3 class="text-themecolor mb-0">{{translate('بريد الالكترونى')}}</h3>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{route('website.main')}}">{{translate('الصفحة الرئيسية')}}</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0)">{{translate('التسويق')}}</a></li>
                    <li class="breadcrumb-item active">{{translate('بريد الالكترونى')}}</li>
                </ol>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <!-- -------------------------------------------------------------- -->
        <!-- Container fluid  -->
        <!-- -------------------------------------------------------------- -->
        <div class="container-fluid">
            <!-- -------------------------------------------------------------- -->
            <!-- Start Page Content -->
            <!-- -------------------------------------------------------------- -->
            <div class="widget-content searchable-container list">
                <div class="card card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">

                                <div class="card-body bg-megna rounded-top">
                                    <h4 class="text-white card-title">{{translate('البيانات')}}</h4>
                                </div>
                                <div class="card-body">
                                    <form class="needs-validation"
                                          action="{{ route('newsletters.send') }}"
                                          method="POST" novalidate>
                                        @csrf
                                        <div class="row">

                                            <div class="col-md-12 mb-3">
                                                <label for="validationCustom03">{{translate('بريد المشتركين')}} </label>
                                                <select class="form-control " name="subscriber_emails[]" multiple >
                                                    @foreach($subscribers as $subscriber)
                                                        <option value="{{$subscriber->email}}">{{$subscriber->email}}</option>
                                                    @endforeach
                                                </select>
                                                <div class="invalid-feedback">
                                                    {{translate("برجاء تحديد اختيارك")}}

                                                </div>

                                            </div>



                                        </div>
                                        <div class="row">
                                            <div class="col-md-12 mb-3">
                                                <label for="validationCustom03">{{translate('موضوع البريد')}} </label>
                                                <input type="text" class="form-control" name="subject" id="subject" required>

                                                <div class="invalid-feedback">
                                                    {{ translate('برجاء ادخال الموضوع')}}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12 mb-3">
                                                <label for="validationCustomUsername">{{translate('تفاصيل البريد')}}</label>
                                                <div class="input-group">

                                                    <textarea rows="8" class="form-control "  name="content" required></textarea>

                                                    <div class="invalid-feedback">
                                                        {{translate("برجاء ادخال الوصف")}}
                                                    </div>
                                                </div>
                                            </div>

                                        </div>


                                        <div class="button-group text-end">


                                        <button type="submit" class="btn btn-success  px-4">
                                            <div class="d-flex align-items-center">
                                                <i data-feather="save" class="feather-sm me-1 fill-icon"></i>
                                                {{translate('حفظ')}}
                                            </div>
                                        </button>

                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- -------------------------------------------------------------- -->
        <!-- footer -->
        <!-- -------------------------------------------------------------- -->
        <footer class="footer text-center">
             {{ translate('جميع الحقوق محفوظة لروافد نجد') }}
        </footer>
        <!-- -------------------------------------------------------------- -->
        <!-- End footer -->
        <!-- -------------------------------------------------------------- -->

    </div>
@endsection

@section('script')

    <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function () {
            'use strict';
            window.addEventListener('load', function () {
                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                var forms = document.getElementsByClassName('needs-validation');
                // Loop over them and prevent submission
                var validation = Array.prototype.filter.call(forms, function (form) {
                    form.addEventListener('submit', function (event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();
    </script>
@endsection





