@extends('backend.layouts.app')

@section('content')
    <div class="page-wrapper">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="row page-titles">
            <div class="col-md-5 col-12 align-self-center">
                <h3 class="text-themecolor mb-0">{{translate('اضافة الاسئلة الشائعة')}}</h3>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{route('website.main')}}">{{translate('الصفحة الرئيسية')}}</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0)">{{translate('بيانات الموضوعات الشائعة')}}</a></li>
                    <li class="breadcrumb-item active">{{translate('الاسئلة الشائعة')}}</li>
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
                                <div class="border-bottom title-part-padding">
                                    <h4 class="card-title mb-0">{{translate('الاضافة')}}</h4>
                                </div>
                                <div class="card-body">
                                    <form class="needs-validation" action="{{ route('frequently_questioned_create') }}"
                                          method="POST" novalidate>
                                        @csrf

                                        <div class="row">
                                            <div class="col-md-12 mb-3">
                                                <label for="validationCustom01">{{translate('السؤال')}}</label>
                                                <input type="text" class="form-control" id="validationCustom01"
                                                       placeholder="{{translate('السؤال')}}" name="question"
                                                       value="{{old('question')}}" required>
                                                <div class="valid-feedback">
                                                    {{translate("برجاء ادخال السؤال")}}

                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12 mb-3">
                                                <label for="validationCustomUsername">{{translate('الاجابة')}}</label>
                                                <div class="input-group">
                                                    <textarea cols="80" id="testedit2" name="answer" rows="10" data-sample="3" data-sample-short required></textarea>
                                                    <div class="invalid-feedback">
                                                        {{translate("برجاء ادخال الاجابة")}}
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
                                        <a href="{{route('website.other_pages')}}"
                                           class="btn btn-danger  px-4 ms-2 text-white">{{translate('عودة الى القائمة')}}</a>
                                        {{--                        <button class="btn btn-info mt-3 rounded-pill px-4" type="submit">{{translate('حفظ')}}</button>--}}
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
    <script src="{{ static_asset('v4_assets/assets/libs/ckeditor/ckeditor.js') }}"></script>
    <script>
        CKEDITOR.replace('testedit2', {
            height: 400 ,
            width: '100%'
        });
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


