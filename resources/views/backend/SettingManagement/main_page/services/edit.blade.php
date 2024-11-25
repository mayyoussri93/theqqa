@extends('backend.layouts.app')

@section('content')

    <div class="page-wrapper">

        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="row page-titles">
            <div class="col-md-5 col-12 align-self-center">
                <h3 class="text-themecolor mb-0">{{translate('تعديل خدمات ')}}</h3>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item">2{{translate('الصفحة الرئيسية')}}</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0)">{{translate('بيانات الصفحة الرئيسية')}}</a></li>
                    <li class="breadcrumb-item active">{{translate('خدمات ')}}</li>
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
                                    <form class="needs-validation"
                                          action="{{ route('services.update', $brand->id) }}"
                                          method="POST" novalidate>
                                        <input name="_method" type="hidden" value="PATCH">
                                        <input type="hidden" name="lang" value="{{ $lang }}">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="validationCustom01">{{translate('العنوان')}}</label>
                                                <input type="text" class="form-control" id="validationCustom01"
                                                       placeholder="{{translate('العنوان')}}" name="name"
                                                       value="{{ $brand->name }}" required>
                                                <div class="valid-feedback">
                                                    {{translate("برجاء ادخال العنوان")}}

                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="validationCustom02">{{translate('الرابط')}}</label>
                                                <input type="url" class="form-control" id="validationCustom02"
                                                       name="link" placeholder="{{translate('الرابط')}}"
                                                       value="{{ $brand->link }}" >
                                                <div class="valid-feedback">
                                                    {{translate("برجاء ادخال الرابطه")}}
                                                </div>
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="validationCustomUsername">{{translate('الوصف')}}</label>
                                                <div class="input-group">

                                                    <textarea name="description" rows="5" class="form-control"
                                                              placeholder="{{translate('الوصف')}}"
                                                              id="validationCustomUsername"
                                                              required> {{ $brand->description }}</textarea>

                                                    <div class="invalid-feedback">
                                                        {{translate("برجاء ادخال الوصف")}}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="validationCustom03">{{translate('الصورة')}} </label>
                                                <div class="input-group" data-toggle="aizuploader" data-type="image">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text bg-soft-secondary font-weight-medium">{{translate('تصفح')}}</div>
                                                    </div>
                                                    <div class="form-control file-amount">{{translate('اختار الملف')}}</div>
                                                    <input type="hidden" name="logo" id="validationCustom03"
                                                           value="{{$brand->logo}}" class="selected-files"
                                                           required>
                                                </div>
                                                <div class="file-preview box sm">
                                                </div>
                                                <div class="invalid-feedback">
                                                    {{ translate('الصورة مطلوبة')}}
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
                                        <a href="{{route('website.main')}}"
                                           class="btn btn-danger  px-4 ms-2 text-white">{{translate('عودة الى القائمة')}}</a>
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