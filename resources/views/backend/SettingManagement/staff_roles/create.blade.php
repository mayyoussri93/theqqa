@extends('backend.layouts.app')

@section('content')




    <div class="page-wrapper">

        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="row page-titles">
            <div class="col-md-5 col-12 align-self-center">
                <h3 class="text-themecolor mb-0">{{translate('اضافة')}}</h3>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{route('website.main')}}">{{translate('الصفحة الرئيسية')}}</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0)">{{translate('الاعدادات')}}</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0)">{{translate('طقم العمل')}}</a></li>
                    <li class="breadcrumb-item active">{{translate('اذونات العمل')}}</li>
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
                <form action="{{ route('roles.store') }}" class="needs-validation"  method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3 contact-age2">
                                <label>{{ translate('المسمى الوظيفى') }} <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" placeholder="{{ translate('المسمى الوظيفى') }}" name=" name" required>
                                <div class="valid-feedback">
                                    {{translate("برجاء ادخال المسمى الوظيفى")}}
                                </div>
                            </div>

                            <!-- 8. Card Header -->
                            <br>

                            <div class="row">
                                <div class="d-flex align-items-stretch">
                                    <div class="card w-100">
                                        <div class="card-header bg-warning">
                                            <h4 class="mb-0 text-white">{{translate('لوحة التحكم')}}</h4></div>
                                        <div class="card-body">
                                            <div class="mb-2 bt-switch">
                                                <div class="row py-2">
                                                    <div class="col-md-4 col-xl-3">
                                                        <span class="fs-3 ">{{translate('إحصائيات لوحة التحكم')}}</span>
                                                    </div>
                                                    <div class="col-md-8 col-xl-9">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning"  type="checkbox"  name="permissions[]"  id="warning-outline-check" value="188" >
                                                            <label class="form-check-label" for="warning-outline-check">{{translate('عرض احصائيات الاعداد')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning"  type="checkbox"  name="permissions[]"  id="warning-outline-check" value="201" >
                                                            <label class="form-check-label" for="warning-outline-check">{{translate('اجمالى احصائيات الاعداد')}}</label>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="row py-2">
                                                    <div class="col-md-4 col-xl-3">
                                                    </div>
                                                    <div class="col-md-8 col-xl-9">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning"  type="checkbox"  name="permissions[]"  id="warning2-outline-check" value="189" >
                                                            <label class="form-check-label" for="warning2-outline-check">{{translate('عرض احصائيات عقود فى انتظار الاعتماد')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning"  type="checkbox"  name="permissions[]"  id="warning2-outline-check" value="202" >
                                                            <label class="form-check-label" for="warning2-outline-check">{{translate('اجمالى احصائيات عقود فى انتظار الاعتماد')}}</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row py-2">
                                                    <div class="col-md-4 col-xl-3">
                                                    </div>
                                                    <div class="col-md-8 col-xl-9">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning"  type="checkbox"  name="permissions[]"  id="warning3-outline-check" value="190" >
                                                            <label class="form-check-label" for="warning3-outline-check">{{translate('عرض احصائيات الموظفين اليومية')}}</label>
                                                        </div>
                                                        {{--                                                        <div class="form-check form-check-inline">--}}
                                                        {{--                                                            <input class="form-check-input warning check-outline outline-warning"  type="checkbox"  name="permissions[]"  id="warning3-outline-check" value="203" >--}}
                                                        {{--                                                            <label class="form-check-label" for="warning3-outline-check">{{translate('اجمالى احصائيات الموظفين اليومية')}}</label>--}}
                                                        {{--                                                        </div>--}}

                                                    </div>
                                                </div>
                                                <div class="row py-2">
                                                    <div class="col-md-4 col-xl-3">
                                                    </div>
                                                    <div class="col-md-8 col-xl-9">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning"  type="checkbox"  name="permissions[]"  id="warning4-outline-check" value="191" >
                                                            <label class="form-check-label" for="warning4-outline-check">{{translate('عرض احصائيات المكاتب')}}</label>
                                                        </div>
                                                        {{--                                                        <div class="form-check form-check-inline">--}}
                                                        {{--                                                            <input class="form-check-input warning check-outline outline-warning"  type="checkbox"  name="permissions[]"  id="warning4-outline-check" value="204" >--}}
                                                        {{--                                                            <label class="form-check-label" for="warning4-outline-check">{{translate('اجمالى احصائيات المكاتب')}}</label>--}}
                                                        {{--                                                        </div>--}}

                                                    </div>
                                                </div>
                                                <div class="row py-2">
                                                    <div class="col-md-4 col-xl-3">
                                                    </div>
                                                    <div class="col-md-8 col-xl-9">

                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning"  type="checkbox"  name="permissions[]"  id="warning4-outline-check" value="192" >
                                                            <label class="form-check-label" for="warning4-outline-check">{{translate('عرض احصائيات الحجوزات المتاخرة')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning"  type="checkbox"  name="permissions[]"  id="warning4-outline-check" value="205" >
                                                            <label class="form-check-label" for="warning4-outline-check">{{translate('اجمالى احصائيات الحجوزات المتاخرة')}}</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row py-2">
                                                    <div class="col-md-4 col-xl-3">
                                                    </div>
                                                    <div class="col-md-8 col-xl-9">

                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning"  type="checkbox"  name="permissions[]"  id="warning4-outline-check" value="193" >
                                                            <label class="form-check-label" for="warning4-outline-check">{{translate('عرض احصائيات العقود الحالية والسابقة')}}</label>
                                                        </div>
                                                        {{--                                                        <div class="form-check form-check-inline">--}}
                                                        {{--                                                            <input class="form-check-input warning check-outline outline-warning"  type="checkbox"  name="permissions[]"  id="warning4-outline-check" value="206" >--}}
                                                        {{--                                                            <label class="form-check-label" for="warning4-outline-check">{{translate('اجمالى احصائيات العقود الحالية والسابقة')}}</label>--}}
                                                        {{--                                                        </div>--}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="d-flex align-items-stretch">
                                    <div class="card w-100">
                                        <div class="card-header bg-warning">
                                            <h4 class="mb-0 text-white">{{translate('ادارة العملاء')}}</h4></div>
                                        <div class="card-body">

                                            <div class="mb-2 bt-switch">
                                                <div class="row py-2">
                                                    <div class="col-md-4 col-xl-3">
                                                        <span class="fs-3 ">{{translate('قائمة العملاء')}}</span>
                                                    </div>
                                                    <div class="col-md-8 col-xl-9">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning-outline-check" value="1"  >
                                                            <label class="form-check-label" for="warning-outline-check">{{translate('تعديل')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning2-outline-check" value="2"   >
                                                            <label class="form-check-label" for="warning2-outline-check">{{translate('اضافة')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning3-outline-check" value="3"  >
                                                            <label class="form-check-label" for="warning3-outline-check">{{translate('مسح')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning4-outline-check" value="4"  >
                                                            <label class="form-check-label" for="warning4-outline-check">{{translate('عرض')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning4-outline-check" value="149"  >
                                                            <label class="form-check-label" for="warning4-outline-check">{{translate('التعليق')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning4-outline-check" value="126"  >
                                                            <label class="form-check-label" for="warning4-outline-check">{{translate('الرسائل المرسلة')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning2-outline-check" value="236"  >
                                                            <label class="form-check-label" for="warning2-outline-check">{{translate('ارسال رساله للعميل')}}</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                {{--                                                <div class="row py-2">--}}
                                                {{--                                                    <div class="col-md-4 col-xl-3">--}}
                                                {{--                                                        <span class="fs-3 ">{{translate('العملاء المحتملين')}}</span>--}}
                                                {{--                                                    </div>--}}
                                                {{--                                                    <div class="col-md-8 col-xl-9">--}}
                                                {{--                                                        <div class="form-check form-check-inline">--}}
                                                {{--                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning-outline-check" value="5"  >--}}
                                                {{--                                                            <label class="form-check-label" for="warning-outline-check">{{translate('تعديل')}}</label>--}}
                                                {{--                                                        </div>--}}
                                                {{--                                                        <div class="form-check form-check-inline">--}}
                                                {{--                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning2-outline-check" value="6"  >--}}
                                                {{--                                                            <label class="form-check-label" for="warning2-outline-check">{{translate('اضافة')}}</label>--}}
                                                {{--                                                        </div>--}}
                                                {{--                                                        <div class="form-check form-check-inline">--}}
                                                {{--                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning3-outline-check" value="7"  >--}}
                                                {{--                                                            <label class="form-check-label" for="warning3-outline-check">{{translate('مسح')}}</label>--}}
                                                {{--                                                        </div>--}}
                                                {{--                                                        <div class="form-check form-check-inline">--}}
                                                {{--                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning4-outline-check" value="8"  >--}}
                                                {{--                                                            <label class="form-check-label" for="warning4-outline-check">{{translate('عرض')}}</label>--}}
                                                {{--                                                        </div>--}}
                                                {{--                                                    </div>--}}
                                                {{--                                                </div>--}}
                                                <div class="row py-2">
                                                    <div class="col-md-4 col-xl-3">
                                                        <span class="fs-3 ">{{translate('سنترال الرقم الموحد')}}</span>
                                                    </div>
                                                    <div class="col-md-8 col-xl-9">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning-outline-check" value="9"  >
                                                            <label class="form-check-label" for="warning-outline-check">{{translate('تعديل')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning2-outline-check" value="10"  >
                                                            <label class="form-check-label" for="warning2-outline-check">{{translate('ادخال')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning3-outline-check" value="11"  >
                                                            <label class="form-check-label" for="warning3-outline-check">{{translate('مسح')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning4-outline-check" value="12"  >
                                                            <label class="form-check-label" for="warning4-outline-check">{{translate('عرض')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning4-outline-check" value="223"  >
                                                            <label class="form-check-label" for="warning4-outline-check">{{translate('جميع البيانات')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning2-outline-check" value="245"  >
                                                            <label class="form-check-label" for="warning2-outline-check">{{translate('تحويل المكالمة الفائتة')}}</label>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="row py-2">
                                                    <div class="col-md-4 col-xl-3">
                                                        <span class="fs-3 ">{{translate('اتصل بنا')}}</span>
                                                    </div>
                                                    <div class="col-md-8 col-xl-9">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning-outline-check" value="13"  >
                                                            <label class="form-check-label" for="warning-outline-check">{{translate('تغير الحالة')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning2-outline-check" value="14"  >
                                                            <label class="form-check-label" for="warning2-outline-check">{{translate('الرد على العميل')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning3-outline-check" value="15"  >
                                                            <label class="form-check-label" for="warning3-outline-check">{{translate('مسح')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning4-outline-check" value="16"  >
                                                            <label class="form-check-label" for="warning4-outline-check">{{translate('عرض')}}</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                {{--                                                <div class="row py-2">--}}
                                                {{--                                                    <div class="col-md-4 col-xl-3">--}}
                                                {{--                                                        <span class="fs-3 ">{{translate('التذكرة')}}</span>--}}
                                                {{--                                                    </div>--}}
                                                {{--                                                    <div class="col-md-8 col-xl-9">--}}
                                                {{--                                                        <div class="form-check form-check-inline">--}}
                                                {{--                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning-outline-check" value="127"  >--}}
                                                {{--                                                            <label class="form-check-label" for="warning-outline-check">{{translate('اضافة')}}</label>--}}
                                                {{--                                                        </div>--}}
                                                {{--                                                        <div class="form-check form-check-inline">--}}
                                                {{--                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning-outline-check" value="17"  >--}}
                                                {{--                                                            <label class="form-check-label" for="warning-outline-check">{{translate('العرض')}}</label>--}}
                                                {{--                                                        </div>--}}
                                                {{--                                                        <div class="form-check form-check-inline">--}}
                                                {{--                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning2-outline-check" value="18"   >--}}
                                                {{--                                                            <label class="form-check-label" for="warning2-outline-check">{{translate('الرد على العميل')}}</label>--}}
                                                {{--                                                        </div>--}}
                                                {{--                                                    </div>--}}
                                                {{--                                                </div>--}}
                                                {{--                                                <div class="row py-2">--}}
                                                {{--                                                    <div class="col-md-4 col-xl-3">--}}
                                                {{--                                                        <span class="fs-3 ">{{translate('المشتركين')}}</span>--}}
                                                {{--                                                    </div>--}}
                                                {{--                                                    <div class="col-md-8 col-xl-9">--}}
                                                {{--                                                        <div class="form-check form-check-inline">--}}
                                                {{--                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning3-outline-check" value="19"  >--}}
                                                {{--                                                            <label class="form-check-label" for="warning3-outline-check">{{translate('مسح')}}</label>--}}
                                                {{--                                                        </div>--}}
                                                {{--                                                        <div class="form-check form-check-inline">--}}
                                                {{--                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning4-outline-check" value="20"  >--}}
                                                {{--                                                            <label class="form-check-label" for="warning4-outline-check">{{translate('عرض')}}</label>--}}
                                                {{--                                                        </div>--}}
                                                {{--                                                    </div>--}}
                                                {{--                                                </div>--}}
                                                <div class="row py-2">
                                                    <div class="col-md-4 col-xl-3">
                                                        <span class="fs-3 ">{{translate('متابعة العملاء')}}</span>
                                                    </div>
                                                    <div class="col-md-8 col-xl-9">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning-outline-check" value="137"  >
                                                            <label class="form-check-label" for="warning-outline-check">{{translate('عرض')}}</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="d-flex align-items-stretch">
                                    <div class="card w-100">
                                        <div class="card-header bg-warning">
                                            <h4 class="mb-0 text-white">{{translate('ادارة التقارير')}}</h4></div>
                                        <div class="card-body">

                                            <div class="mb-2 bt-switch">
                                                <div class="row py-2">
                                                    <div class="col-md-4 col-xl-3">
                                                        <span class="fs-3 ">{{translate('العقود')}}</span>
                                                    </div>
                                                    <div class="col-md-8 col-xl-9">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning-outline-check" value="290"  >
                                                            <label class="form-check-label" for="warning-outline-check">{{translate('عرض')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning2-outline-check" value="291"  >
                                                            <label class="form-check-label" for="warning2-outline-check">{{translate('اكسيل')}}</label>
                                                        </div>

                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="d-flex align-items-stretch">
                                    <div class="card w-100">
                                        <div class="card-header bg-warning">
                                            <h4 class="mb-0 text-white">{{translate('ادارة المكاتب الخارجية')}}</h4></div>
                                        <div class="card-body">

                                            <div class="mb-2 bt-switch">
                                                <div class="row py-2">
                                                    <div class="col-md-4 col-xl-3">
                                                        <span class="fs-3 ">{{translate('المكتب الخارجى')}}</span>
                                                    </div>
                                                    <div class="col-md-8 col-xl-9">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning-outline-check" value="25"  >
                                                            <label class="form-check-label" for="warning-outline-check">{{translate('تعديل')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning2-outline-check" value="26"  >
                                                            <label class="form-check-label" for="warning2-outline-check">{{translate('اضافة')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning3-outline-check" value="27"  >
                                                            <label class="form-check-label" for="warning3-outline-check">{{translate('مسح')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning4-outline-check" value="28"  >
                                                            <label class="form-check-label" for="warning4-outline-check">{{translate('عرض')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning4-outline-check" value="147"  >
                                                            <label class="form-check-label" for="warning4-outline-check">{{translate('تعليق')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning4-outline-check" value="148"  >
                                                            <label class="form-check-label" for="warning4-outline-check">{{translate('جميع السيرة الذاتية لهذا المكتب')}}</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row py-2">
                                                    <div class="col-md-4 col-xl-3">
                                                        <span class="fs-3 ">{{translate('ملفات المكتب الخارجى')}}</span>
                                                    </div>
                                                    <div class="col-md-8 col-xl-9">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning-outline-check" value="29"  >
                                                            <label class="form-check-label" for="warning-outline-check">{{translate('تعديل')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning2-outline-check" value="30"  >
                                                            <label class="form-check-label" for="warning2-outline-check">{{translate('اضافة')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning3-outline-check" value="31"   >
                                                            <label class="form-check-label" for="warning3-outline-check">{{translate('مسح')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning4-outline-check" value="32"   >
                                                            <label class="form-check-label" for="warning4-outline-check">{{translate('عرض')}}</label>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="d-flex align-items-stretch">
                                    <div class="card w-100">
                                        <div class="card-header bg-warning">
                                            <h4 class="mb-0 text-white">{{translate('ادارة السيرة الذاتية')}}</h4></div>
                                        <div class="card-body">

                                            <div class="mb-2 bt-switch">
                                                <div class="row py-2">
                                                    <div class="col-md-4 col-xl-3">
                                                        <span class="fs-3 ">{{translate('السيرة الذاتية')}}</span>
                                                    </div>
                                                    <div class="col-md-8 col-xl-9">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning-outline-check" value="250"  >
                                                            <label class="form-check-label" for="warning-outline-check">{{translate('دمج التصميم الموحد')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning-outline-check" value="33"  >
                                                            <label class="form-check-label" for="warning-outline-check">{{translate('تعديل')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning2-outline-check" value="34"   >
                                                            <label class="form-check-label" for="warning2-outline-check">{{translate('اضافة')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning3-outline-check" value="35"  >
                                                            <label class="form-check-label" for="warning3-outline-check">{{translate('مسح')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning4-outline-check" value="36"  >
                                                            <label class="form-check-label" for="warning4-outline-check">{{translate('عرض')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning4-outline-check" value="37"  >
                                                            <label class="form-check-label" for="warning4-outline-check">{{translate('تعليق')}}</label>
                                                        </div>

                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning2-outline-check" value="21"  >
                                                            <label class="form-check-label" for="warning2-outline-check">{{translate('باك اوت')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning2-outline-check" value="22"  >
                                                            <label class="form-check-label" for="warning2-outline-check">{{translate('تغير حالة الحجز')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning2-outline-check" value="150"  >
                                                            <label class="form-check-label" for="warning2-outline-check">{{translate('ادخال السيرة الذاتية')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning2-outline-check" value="231"  >
                                                            <label class="form-check-label" for="warning2-outline-check">{{translate('عرض الطلب الاستقدام او العقد')}}</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row py-2">
                                                    <div class="col-md-4 col-xl-3">
                                                        <span class="fs-3 ">{{translate('بيانات السيرة الذاتية')}}</span>
                                                    </div>
                                                    <div class="col-md-8 col-xl-9">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning-outline-check" value="38"  >
                                                            <label class="form-check-label" for="warning-outline-check">{{translate('تعديل')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning2-outline-check" value="39"  >
                                                            <label class="form-check-label" for="warning2-outline-check">{{translate('اضافة')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning3-outline-check" value="40"  >
                                                            <label class="form-check-label" for="warning3-outline-check">{{translate('مسح')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning4-outline-check" value="41"  >
                                                            <label class="form-check-label" for="warning4-outline-check">{{translate('عرض')}}</label>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="row py-2">
                                                    <div class="col-md-4 col-xl-3">
                                                        <span class="fs-3 ">{{translate('استرجاع السيرة الذاتية')}}</span>
                                                    </div>
                                                    <div class="col-md-8 col-xl-9">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning-outline-check" value="159"  >
                                                            <label class="form-check-label" for="warning-outline-check">{{translate('تعديل')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning3-outline-check" value="173"  >
                                                            <label class="form-check-label" for="warning3-outline-check">{{translate('ارجاع متاح')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning3-outline-check" value="160"  >
                                                            <label class="form-check-label" for="warning3-outline-check">{{translate('مسح')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning4-outline-check" value="161"  >
                                                            <label class="form-check-label" for="warning4-outline-check">{{translate('عرض')}}</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row py-2">
                                                    <div class="col-md-4 col-xl-3">
                                                        <span class="fs-3 ">{{translate('السيرة الذاتية الممسوحة')}}</span>
                                                    </div>
                                                    <div class="col-md-8 col-xl-9">

                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning3-outline-check" value="178"  >
                                                            <label class="form-check-label" for="warning3-outline-check">{{translate('ارجاع متاح')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning4-outline-check" value="179"  >
                                                            <label class="form-check-label" for="warning4-outline-check">{{translate('عرض')}}</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row py-2">
                                                    <div class="col-md-4 col-xl-3">
                                                        <span class="fs-3 ">{{translate('تقرير السير')}}</span>
                                                    </div>
                                                    <div class="col-md-8 col-xl-9">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning-outline-check" value="294"  >
                                                            <label class="form-check-label" for="warning-outline-check">{{translate('عرض')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning2-outline-check" value="295"  >
                                                            <label class="form-check-label" for="warning2-outline-check">{{translate('اكسيل')}}</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="d-flex align-items-stretch">
                                    <div class="card w-100">
                                        <div class="card-header bg-warning">
                                            <h4 class="mb-0 text-white">{{translate('ادارة الايواء')}}</h4></div>
                                        <div class="card-body">

                                            <div class="mb-2 bt-switch">
                                                <div class="row py-2">
                                                    <div class="col-md-4 col-xl-3">
                                                        <span class="fs-3 ">{{translate('اضافة عقد مختصر للايواء')}}</span>
                                                    </div>
                                                    <div class="col-md-8 col-xl-9">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning2-outline-check" value="244"  >
                                                            <label class="form-check-label" for="warning2-outline-check">{{translate('اضافة')}}</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row py-2">
                                                    <div class="col-md-4 col-xl-3">
                                                        <span class="fs-3 ">{{translate('اضافة عاملة للايواء')}}</span>
                                                    </div>
                                                    <div class="col-md-8 col-xl-9">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning2-outline-check" value="51"  >
                                                            <label class="form-check-label" for="warning2-outline-check">{{translate('اضافة')}}</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                   <div class="row py-2">
                                                    <div class="col-md-4 col-xl-3">
                                                        <span class="fs-3 ">{{translate('طلبات نقل الكفالة')}}</span>
                                                    </div>
                                                    <div class="col-md-8 col-xl-9">
                                                      <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning2-outline-check" value="277"   >
                                                            <label class="form-check-label" for="warning2-outline-check">{{translate('طلبات نقل الكفالة')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning-outline-check" value="278"  >
                                                            <label class="form-check-label" for="warning-outline-check">{{translate('نموذج الاستلام')}}</label>
                                                        </div>


                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning4-outline-check" value="279"   >
                                                            <label class="form-check-label" for="warning4-outline-check">{{translate('عرض العقد')}}</label>
                                                        </div>


                                                      <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning-outline-check" value="280"  >
                                                            <label class="form-check-label" for="warning-outline-check">{{translate('عرض الجميع')}}</label>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="row py-2">
                                                    <div class="col-md-4 col-xl-3">
                                                        <span class="fs-3 ">{{translate('داخل الايواء')}}</span>
                                                    </div>
                                                    <div class="col-md-8 col-xl-9">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning2-outline-check" value="261"   >
                                                            <label class="form-check-label" for="warning2-outline-check">{{translate('ترعب/ﻻ ترغب بالعمل')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning-outline-check" value="263"  >
                                                            <label class="form-check-label" for="warning-outline-check">{{translate('نموذج الاستلام')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning3-outline-check" value="238"   >
                                                            <label class="form-check-label" for="warning3-outline-check">{{translate('ترحيل العاملة')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning4-outline-check" value="53"   >
                                                            <label class="form-check-label" for="warning4-outline-check">{{translate('عرض العقد')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning-outline-check" value="50"  >
                                                            <label class="form-check-label" for="warning-outline-check">{{translate('تعديل')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning-outline-check" value="264"  >
                                                            <label class="form-check-label" for="warning-outline-check">{{translate('مسح')}}</label>
                                                        </div>

{{--                                                        <div class="form-check form-check-inline">--}}
{{--                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning2-outline-check" value="262"   >--}}
{{--                                                            <label class="form-check-label" for="warning2-outline-check">{{translate('طلب نقل الكفالة')}}</label>--}}
{{--                                                        </div>--}}
{{--                                                        <div class="form-check form-check-inline">--}}
{{--                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning2-outline-check" value="265"   >--}}
{{--                                                            <label class="form-check-label" for="warning2-outline-check">{{translate('الظهور بالموقع')}}</label>--}}
{{--                                                        </div>--}}
{{--                                                      --}}
{{--                                                        <div class="form-check form-check-inline">--}}
{{--                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning-outline-check" value="265"  >--}}
{{--                                                            <label class="form-check-label" for="warning-outline-check">{{translate('ملاحظات')}}</label>--}}
{{--                                                        </div>--}}
                                                    </div>
                                                </div>
                                                <div class="row py-2">
                                                    <div class="col-md-4 col-xl-3">
                                                        <span class="fs-3 ">{{translate('متاح للنقل')}}</span>
                                                    </div>
                                                    <div class="col-md-8 col-xl-9">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning2-outline-check" value="43"  >
                                                            <label class="form-check-label" for="warning2-outline-check">{{translate('طلب نقل كفالة')}}</label>
                                                        </div>

                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning-outline-check" value="269"  >
                                                            <label class="form-check-label" for="warning-outline-check">{{translate('نموذج الاستلام')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning2-outline-check" value="265"   >
                                                            <label class="form-check-label" for="warning2-outline-check">{{translate('الظهور بالموقع')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning-outline-check" value="270"  >
                                                            <label class="form-check-label" for="warning-outline-check">{{translate('تعديل')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning4-outline-check" value="271"   >
                                                            <label class="form-check-label" for="warning4-outline-check">{{translate('عرض العقد')}}</label>
                                                        </div>

                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning-outline-check" value="272"  >
                                                            <label class="form-check-label" for="warning-outline-check">{{translate('مسح')}}</label>
                                                        </div>

                                                    </div>
                                                </div>


                                                <div class="row py-2">
                                                    <div class="col-md-4 col-xl-3">
                                                        <span class="fs-3 ">{{translate('مرحلة الترحيل')}}</span>
                                                    </div>
                                                    <div class="col-md-8 col-xl-9">
                                                         <div class="form-check form-check-inline">
                                                         <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning-outline-check" value="207"  >
                                                         <label class="form-check-label" for="warning-outline-check">{{translate('عرض الجميع')}}</label>
                                                         </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning-outline-check" value="208"  >
                                                            <label class="form-check-label" for="warning-outline-check">{{translate('عرض العقد')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning2-outline-check" value="209"  >
                                                            <label class="form-check-label" for="warning2-outline-check">{{translate('ترغب بالعمل')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning4-outline-check" value="267"   >
                                                            <label class="form-check-label" for="warning4-outline-check">{{translate('اجراء مسؤل السكن')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning4-outline-check" value="268"   >
                                                            <label class="form-check-label" for="warning4-outline-check">{{translate('اجراء خدمة العملاء')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning4-outline-check" value="210"   >
                                                            <label class="form-check-label" for="warning4-outline-check">{{translate('تغير حالات الترحيل')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning4-outline-check" value="266"   >
                                                            <label class="form-check-label" for="warning4-outline-check">{{translate('ملاحظات الايواء')}}</label>
                                                        </div>


                                                    </div>
                                                </div>

                                                <div class="row py-2">
                                                    <div class="col-md-4 col-xl-3">
                                                        <span class="fs-3 ">{{translate('تم الترحيل')}}</span>
                                                    </div>
                                                    <div class="col-md-8 col-xl-9">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning-outline-check" value="273"  >
                                                            <label class="form-check-label" for="warning-outline-check">{{translate('عرض الجميع')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning-outline-check" value="274"  >
                                                            <label class="form-check-label" for="warning-outline-check">{{translate('عرض العقد')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning2-outline-check" value="275"  >
                                                            <label class="form-check-label" for="warning2-outline-check">{{translate('نموذج الاستلام')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning4-outline-check" value="276"   >
                                                            <label class="form-check-label" for="warning4-outline-check">{{translate('ملاحظات الايواء')}}</label>
                                                        </div>


                                                    </div>
                                                </div>
                                                <div class="row py-2">
                                                    <div class="col-md-4 col-xl-3">
                                                        <span class="fs-3 ">{{translate('مرحلة التجربة')}}</span>
                                                    </div>
                                                    <div class="col-md-8 col-xl-9">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning4-outline-check" value="247"   >
                                                            <label class="form-check-label" for="warning4-outline-check">{{translate('عرض الجميع')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning-outline-check" value="246"  >
                                                            <label class="form-check-label" for="warning-outline-check">{{translate('تعديل')}}</label>
                                                        </div>


                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning4-outline-check"  value="248" >
                                                            <label class="form-check-label" for="warning4-outline-check">{{translate('تاكيد نقل')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning4-outline-check"  value="249" >
                                                            <label class="form-check-label" for="warning4-outline-check">{{translate('إلغاء نقل ')}}</label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row py-2">
                                                    <div class="col-md-4 col-xl-3">
                                                        <span class="fs-3 ">{{translate('تم تأكيد النقل')}}</span>
                                                    </div>
                                                    <div class="col-md-8 col-xl-9">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning-outline-check" value="42"  >
                                                            <label class="form-check-label" for="warning-outline-check">{{translate('تعديل')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning4-outline-check" value="45"   >
                                                            <label class="form-check-label" for="warning4-outline-check">{{translate('عرض الجميع')}}</label>
                                                        </div>
{{--                                                        <div class="form-check form-check-inline">--}}
{{--                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning4-outline-check"  value="212" >--}}
{{--                                                            <label class="form-check-label" for="warning4-outline-check">{{translate('اللغاء نقل ')}}</label>--}}
{{--                                                        </div>--}}
                                                    </div>
                                                </div>

                                                <div class="row py-2">
                                                    <div class="col-md-4 col-xl-3">
                                                        <span class="fs-3 ">{{translate('بيانات الايواء')}}</span>
                                                    </div>
                                                    <div class="col-md-8 col-xl-9">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning-outline-check" value="46"  >
                                                            <label class="form-check-label" for="warning-outline-check">{{translate('تعديل')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning2-outline-check" value="47"  >
                                                            <label class="form-check-label" for="warning2-outline-check">{{translate('اضافة')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning3-outline-check" value="48"  >
                                                            <label class="form-check-label" for="warning3-outline-check">{{translate('مسح')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning4-outline-check" value="49"   >
                                                            <label class="form-check-label" for="warning4-outline-check">{{translate('عرض')}}</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row py-2">
                                                    <div class="col-md-4 col-xl-3">
                                                        <span class="fs-3 ">{{translate('فشل التجربة')}}</span>
                                                    </div>
                                                    <div class="col-md-8 col-xl-9">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning4-outline-check" value="211"   >
                                                            <label class="form-check-label" for="warning4-outline-check">{{translate('عرض الجميع')}}</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row py-2">
                                                    <div class="col-md-4 col-xl-3">
                                                        <span class="fs-3 ">{{translate('تقرير الايواء')}}</span>
                                                    </div>
                                                    <div class="col-md-8 col-xl-9">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning-outline-check" value="292"  >
                                                            <label class="form-check-label" for="warning-outline-check">{{translate('عرض')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning2-outline-check" value="293"  >
                                                            <label class="form-check-label" for="warning2-outline-check">{{translate('اكسيل')}}</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="d-flex align-items-stretch">
                                    <div class="card w-100">
                                        <div class="card-header bg-warning">
                                            <h4 class="mb-0 text-white">{{translate('ادارة الماليه')}}</h4></div>
                                        <div class="card-body">

                                            <div class="mb-2 bt-switch">


                                                <div class="row py-2">
                                                    <div class="col-md-4 col-xl-3">
                                                        <span class="fs-3 ">{{translate('الطلبات الماليه')}}</span>
                                                    </div>
                                                    <div class="col-md-8 col-xl-9">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning-outline-check" value="217"  >
                                                            <label class="form-check-label" for="warning-outline-check">{{translate('اضافة')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning-outline-check" value="218"  >
                                                            <label class="form-check-label" for="warning-outline-check">{{translate('عرض')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning-outline-check" value="219"  >
                                                            <label class="form-check-label" for="warning-outline-check">{{translate('عرض جميع الطلبات')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning-outline-check" value="220"  >
                                                            <label class="form-check-label" for="warning-outline-check">{{translate('تعديل')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning2-outline-check" value="221"  >
                                                            <label class="form-check-label" for="warning2-outline-check">{{translate('تغير حالة الطلب')}}</label>
                                                        </div>

                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning4-outline-check" value="222"   >
                                                            <label class="form-check-label" for="warning4-outline-check">{{translate('تفاصيل الطلب')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning4-outline-check" value="237"   >
                                                            <label class="form-check-label" for="warning4-outline-check">{{translate('مسح الطلب')}}</label>
                                                        </div>
                                                        {{--                                                        <div class="form-check form-check-inline">--}}
                                                        {{--                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning4-outline-check" value="239"   >--}}
                                                        {{--                                                            <label class="form-check-label" for="warning4-outline-check">{{translate('قفل مراجعة الطلبات')}}</label>--}}
                                                        {{--                                                        </div>--}}
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning4-outline-check" value="240"   >
                                                            <label class="form-check-label" for="warning4-outline-check">{{translate('فلترة جميع المسوقات')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning4-outline-check" value="239"   >
                                                            <label class="form-check-label" for="warning4-outline-check">{{translate('نغير حالة الطلب عند قيد المراجعه')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning4-outline-check" value="241"  >
                                                            <label class="form-check-label" for="warning4-outline-check">{{translate("نغير حالة الطلب عند تحت الاجراء")}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning4-outline-check" value="242" >
                                                            <label class="form-check-label" for="warning4-outline-check">{{translate('نغير حالة الطلب عند تم السداد')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning4-outline-check" value="243"  >
                                                            <label class="form-check-label" for="warning4-outline-check">{{translate('نغير حالة الطلب عند طلب غير مكتمل')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning4-outline-check" value="604"  >
                                                            <label class="form-check-label" for="warning4-outline-check">{{translate('نغير حالة الطلب عند طلب مرفوض')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning4-outline-check" value="605" >
                                                            <label class="form-check-label" for="warning4-outline-check">{{translate('اعتماد الطلبات')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning4-outline-check" value="800" >
                                                            <label class="form-check-label" for="warning4-outline-check">{{translate(' عرض الطلبات المعتمدة')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning4-outline-check" value="260"  >
                                                            <label class="form-check-label" for="warning4-outline-check">{{translate('تعزيز الطلب')}}</label>
                                                        </div>

                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning4-outline-check" value="600"  >
                                                            <label class="form-check-label" for="warning4-outline-check">{{translate('طلبات العلاقات الخارجية')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning4-outline-check" value="601"  >
                                                            <label class="form-check-label" for="warning4-outline-check">{{translate('طلبات الموارد البشرية')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning4-outline-check" value="602"  >
                                                            <label class="form-check-label" for="warning4-outline-check">{{translate('طلبات المبيعات ')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning4-outline-check" value="603"  >
                                                            <label class="form-check-label" for="warning4-outline-check">{{translate('طلبات التسويق')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning4-outline-check" value="704"  >
                                                            <label class="form-check-label" for="warning4-outline-check">{{translate('طلبات تقنية المعلومات')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning4-outline-check" value="705"  >
                                                            <label class="form-check-label" for="warning4-outline-check">{{translate('طلبات قسم المالية ')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning4-outline-check" value="606"  >
                                                            <label class="form-check-label" for="warning4-outline-check">{{translate('طلبات رئيس مجلس الادارة  ')}}</label>
                                                        </div>
{{--                                                        <div class="form-check form-check-inline">--}}
{{--                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning4-outline-check" value="607"  >--}}
{{--                                                            <label class="form-check-label" for="warning4-outline-check">{{translate('طلبات عامة')}}</label>--}}
{{--                                                        </div>--}}
{{--                                                        <div class="form-check form-check-inline">--}}
{{--                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning4-outline-check" value="608"  >--}}
{{--                                                            <label class="form-check-label" for="warning4-outline-check">{{translate('طلباتي الخاصة')}}</label>--}}
{{--                                                        </div>--}}
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning4-outline-check" value="609" >
                                                            <label class="form-check-label" for="warning4-outline-check">{{translate(' عرض جميع الطلبات الاخرى')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning4-outline-check" value="610"  >
                                                            <label class="form-check-label" for="warning4-outline-check">{{translate(' تحويل الي قسم')}}</label>
                                                        </div>


                                                    </div>
                                                </div>

                                                {{--                                        <div class="row py-2">--}}
                                                {{--                                            <div class="col-md-4 col-xl-3">--}}
                                                {{--                                                <span class="fs-3 ">{{translate('طلبات اخري')}}</span>--}}
                                                {{--                                            </div>--}}
                                                {{--                                            <div class="col-md-8 col-xl-9">--}}
                                                {{--                                                <div class="form-check form-check-inline">--}}
                                                {{--                                                    <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning-outline-check" value="317"  >--}}
                                                {{--                                                    <label class="form-check-label" for="warning-outline-check">{{translate('اضافة')}}</label>--}}
                                                {{--                                                </div>--}}
                                                {{--                                                <div class="form-check form-check-inline">--}}
                                                {{--                                                    <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning-outline-check" value="318"  >--}}
                                                {{--                                                    <label class="form-check-label" for="warning-outline-check">{{translate('عرض')}}</label>--}}
                                                {{--                                                </div>--}}
                                                {{--                                                <div class="form-check form-check-inline">--}}
                                                {{--                                                    <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning-outline-check" value="319"  >--}}
                                                {{--                                                    <label class="form-check-label" for="warning-outline-check">{{translate('عرض جميع الطلبات')}}</label>--}}
                                                {{--                                                </div>--}}
                                                {{--                                                <div class="form-check form-check-inline">--}}
                                                {{--                                                    <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning-outline-check" value="320"  >--}}
                                                {{--                                                    <label class="form-check-label" for="warning-outline-check">{{translate('تعديل')}}</label>--}}
                                                {{--                                                </div>--}}
                                                {{--                                                <div class="form-check form-check-inline">--}}
                                                {{--                                                    <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning2-outline-check" value="321"  >--}}
                                                {{--                                                    <label class="form-check-label" for="warning2-outline-check">{{translate('تغير حالة الطلب')}}</label>--}}
                                                {{--                                                </div>--}}

                                                {{--                                                <div class="form-check form-check-inline">--}}
                                                {{--                                                    <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning4-outline-check" value="322"   >--}}
                                                {{--                                                    <label class="form-check-label" for="warning4-outline-check">{{translate('تفاصيل الطلب')}}</label>--}}
                                                {{--                                                </div>--}}
                                                {{--                                                <div class="form-check form-check-inline">--}}
                                                {{--                                                    <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning4-outline-check" value="337"   >--}}
                                                {{--                                                    <label class="form-check-label" for="warning4-outline-check">{{translate('مسح الطلب')}}</label>--}}
                                                {{--                                                </div>--}}
                                                {{--                                                --}}{{--                                                        <div class="form-check form-check-inline">--}}
                                                {{--                                                --}}{{--                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning4-outline-check" value="239"   >--}}
                                                {{--                                                --}}{{--                                                            <label class="form-check-label" for="warning4-outline-check">{{translate('قفل مراجعة الطلبات')}}</label>--}}
                                                {{--                                                --}}{{--                                                        </div>--}}
                                                {{--                                                <div class="form-check form-check-inline">--}}
                                                {{--                                                    <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning4-outline-check" value="340"   >--}}
                                                {{--                                                    <label class="form-check-label" for="warning4-outline-check">{{translate('فلترة جميع المسوقات')}}</label>--}}
                                                {{--                                                </div>--}}
                                                {{--                                                <div class="form-check form-check-inline">--}}
                                                {{--                                                    <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning4-outline-check" value="339"   >--}}
                                                {{--                                                    <label class="form-check-label" for="warning4-outline-check">{{translate('نغير حالة الطلب عند قيد المراجعه')}}</label>--}}
                                                {{--                                                </div>--}}
                                                {{--                                                <div class="form-check form-check-inline">--}}
                                                {{--                                                    <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning4-outline-check" value="341"  >--}}
                                                {{--                                                    <label class="form-check-label" for="warning4-outline-check">{{translate("نغير حالة الطلب عند تحت الاجراء")}}</label>--}}
                                                {{--                                                </div>--}}
                                                {{--                                                <div class="form-check form-check-inline">--}}
                                                {{--                                                    <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning4-outline-check" value="342" >--}}
                                                {{--                                                    <label class="form-check-label" for="warning4-outline-check">{{translate('نغير حالة الطلب عند تم السداد')}}</label>--}}
                                                {{--                                                </div>--}}
                                                {{--                                                <div class="form-check form-check-inline">--}}
                                                {{--                                                    <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning4-outline-check" value="343"  >--}}
                                                {{--                                                    <label class="form-check-label" for="warning4-outline-check">{{translate('نغير حالة الطلب عند طلب غير مكتمل')}}</label>--}}
                                                {{--                                                </div>--}}

                                                {{--                                            </div>--}}
                                                {{--                                        </div>--}}
                                                <!--================اضافة بيمشنز اعدادات الطلبات الاخري===============-->
                                                <div class="row py-2">
                                                    <div class="col-md-4 col-xl-3">
                                                        <span class="fs-3 ">{{translate('إعدادات الطلبات الاخري')}}</span>
                                                    </div>
                                                    <div class="col-md-8 col-xl-9">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning-outline-check" value="217"  >
                                                            <label class="form-check-label" for="warning-outline-check">{{translate('اضافة ')}}</label>
                                                        </div>

                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning-outline-check" value="219"  >
                                                            <label class="form-check-label" for="warning-outline-check">{{translate('عرض')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning4-outline-check" value="220"   >
                                                            <label class="form-check-label" for="warning4-outline-check">{{translate('تعديل نوع الطلب')}}</label>
                                                        </div>

                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning4-outline-check" value="237"  >
                                                            <label class="form-check-label" for="warning4-outline-check">{{translate('مسح نوع الطلب')}}</label>
                                                        </div>

                                                    </div>
                                                </div>




                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!--===========row py-2 end==========-->





                            <div class="row">
                                <div class="d-flex align-items-stretch">
                                    <div class="card w-100">
                                        <div class="card-header bg-warning">
                                            <h4 class="mb-0 text-white">{{translate('ادارة طلبات الأستقدام')}}</h4></div>
                                        <div class="card-body">

                                            <div class="mb-2 bt-switch">
                                                <div class="row py-2">
                                                    <div class="col-md-4 col-xl-3">
                                                        <span class="fs-3 ">{{translate('طلبات الاستقدام')}}</span>
                                                    </div>
                                                    <div class="col-md-8 col-xl-9">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning-outline-check" value="54"   >
                                                            <label class="form-check-label" for="warning-outline-check">{{translate('عرض الطلب')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning2-outline-check" value="55"   >
                                                            <label class="form-check-label" for="warning2-outline-check">{{translate('اضافة')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning3-outline-check" value="56"   >
                                                            <label class="form-check-label" for="warning3-outline-check">{{translate('مسح')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning4-outline-check" value="57"   >
                                                            <label class="form-check-label" for="warning4-outline-check">{{translate('عرض')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning4-outline-check" value="128"   >
                                                            <label class="form-check-label" for="warning4-outline-check">{{translate('جميع الطلبات')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning4-outline-check" value="172"   >
                                                            <label class="form-check-label" for="warning4-outline-check">{{translate('تحديث حالة مرحلة الاجراءات')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning4-outline-check" value="58"   >
                                                            <label class="form-check-label" for="warning4-outline-check">{{translate('تحديث حالة التعاقد')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning4-outline-check" value="59"   >
                                                            <label class="form-check-label" for="warning4-outline-check">{{translate('تغير خدمة العملاء')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning4-outline-check" value="60"   >
                                                            <label class="form-check-label" for="warning4-outline-check">{{translate('تغير السيرة الذاتيه')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning"  type="checkbox"  name="permissions[]"  id="warning4-outline-check" value="199"  >
                                                            <label class="form-check-label" for="warning4-outline-check">{{translate('الاضافة بواسطة')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning"  type="checkbox"  name="permissions[]"  id="warning4-outline-check" value="200"  >
                                                            <label class="form-check-label" for="warning4-outline-check">{{translate('هاتف العميل')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning2-outline-check" value="232"  >
                                                            <label class="form-check-label" for="warning2-outline-check">{{translate('عرض  العقد')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning2-outline-check" value="234"  >
                                                            <label class="form-check-label" for="warning2-outline-check">{{translate('ارسال رساله للعميل')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning2-outline-check" value="235"  >
                                                            <label class="form-check-label" for="warning2-outline-check">{{translate('الرسائل المرسلة للعميل')}}</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row py-2">
                                                    <div class="col-md-4 col-xl-3">
                                                        <span class="fs-3 ">{{translate('طلبات الاستقدام الملغى')}}</span>
                                                    </div>
                                                    <div class="col-md-8 col-xl-9">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning3-outline-check" value="61"    >
                                                            <label class="form-check-label" for="warning3-outline-check">{{translate('ارجاع الاتاحه')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning4-outline-check" value="62"  >
                                                            <label class="form-check-label" for="warning4-outline-check">{{translate('عرض')}}</label>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="row py-2">
                                                    <div class="col-md-4 col-xl-3">
                                                        <span class="fs-3 ">{{translate('طلبات الاستقدام الخاصة')}}</span>
                                                    </div>
                                                    <div class="col-md-8 col-xl-9">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning-outline-check" value="63"  >
                                                            <label class="form-check-label" for="warning-outline-check">{{translate('معاينة الطلب')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning2-outline-check" value="64"  >
                                                            <label class="form-check-label" for="warning2-outline-check">{{translate('الرد على العميل')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning3-outline-check" value="65"  >
                                                            <label class="form-check-label" for="warning3-outline-check">{{translate('مسح')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning4-outline-check" value="66"  >
                                                            <label class="form-check-label" for="warning4-outline-check">{{translate('عرض')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning4-outline-check" value="67"  >
                                                            <label class="form-check-label" for="warning4-outline-check">{{translate('الرسائل المرسلة')}}</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row py-2">
                                                    <div class="col-md-4 col-xl-3">
                                                        <span class="fs-3 ">{{translate('متابعة طلبات الاستقدام')}}</span>
                                                    </div>
                                                    <div class="col-md-8 col-xl-9">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning3-outline-check" value="138"  >
                                                            <label class="form-check-label" for="warning3-outline-check">{{translate('عرض')}}</label>
                                                        </div>


                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="d-flex align-items-stretch">
                                    <div class="card w-100">
                                        <div class="card-header bg-warning">
                                            <h4 class="mb-0 text-white">{{translate('ادارة الشكاوى')}}</h4></div>
                                        <div class="card-body">

                                            <div class="mb-2 bt-switch">
                                                <div class="row py-2">
                                                    <div class="col-md-4 col-xl-3">
                                                        <span class="fs-3 ">{{translate('الشكاوى')}}</span>
                                                    </div>
                                                    <div class="col-md-8 col-xl-9">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning-outline-check" value="139"  >
                                                            <label class="form-check-label" for="warning-outline-check">{{translate('مشاهدة الشكوى')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning-outline-check" value="140"  >
                                                            <label class="form-check-label" for="warning-outline-check">{{translate('جميع الشكوى')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning-outline-check" value="141"  >
                                                            <label class="form-check-label" for="warning-outline-check">{{translate('ارسال رسالة نصية')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning2-outline-check" value="142"  >
                                                            <label class="form-check-label" for="warning2-outline-check">{{translate('عرض')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning2-outline-check" value="143"  >
                                                            <label class="form-check-label" for="warning2-outline-check">{{translate('اضافة')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning3-outline-check" value="144"  >
                                                            <label class="form-check-label" for="warning3-outline-check">{{translate('تغير الحالة')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning4-outline-check" value="145"  >
                                                            <label class="form-check-label" for="warning4-outline-check">{{translate('حذف')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning4-outline-check" value="146"  >
                                                            <label class="form-check-label" for="warning4-outline-check">{{translate('تحويل الشكوى')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning4-outline-check" value="1001"  >
                                                            <label class="form-check-label" for="warning4-outline-check">{{translate('تعديل الشكوى')}}</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="d-flex align-items-stretch">
                                    <div class="card w-100">
                                        <div class="card-header bg-warning">
                                            <h4 class="mb-0 text-white">{{translate('ادارة العقود')}}</h4></div>
                                        <div class="card-body">

                                            <div class="mb-2 bt-switch">
                                                <div class="row py-2">
                                                    <div class="col-md-4 col-xl-3">
                                                        <span class="fs-3 ">{{translate('العقود')}}</span>
                                                    </div>
                                                    <div class="col-md-8 col-xl-9">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning-outline-check" value="68"  >
                                                            <label class="form-check-label" for="warning-outline-check">{{translate('مشاهدة العقد')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning-outline-check" value="129"  >
                                                            <label class="form-check-label" for="warning-outline-check">{{translate('جميع العقود')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning-outline-check" value="69"  >
                                                            <label class="form-check-label" for="warning-outline-check">{{translate('تعديل')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning2-outline-check" value="70"  >
                                                            <label class="form-check-label" for="warning2-outline-check">{{translate('اضافة')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning3-outline-check" value="71"  >
                                                            <label class="form-check-label" for="warning3-outline-check">{{translate('ملاحظه')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning4-outline-check" value="72"  >
                                                            <label class="form-check-label" for="warning4-outline-check">{{translate('عرض')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning4-outline-check" value="73"  >
                                                            <label class="form-check-label" for="warning4-outline-check">{{translate('تحديث الحالة')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning2-outline-check" value="158"  >
                                                            <label class="form-check-label" for="warning2-outline-check">{{translate('ادخال العقود')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning2-outline-check" value="163"  >
                                                            <label class="form-check-label" for="warning2-outline-check">{{translate('مرتجع')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning2-outline-check" value="224"  >
                                                            <label class="form-check-label" for="warning2-outline-check">{{translate('طلب الاستقدام')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning2-outline-check" value="233"  >
                                                            <label class="form-check-label" for="warning2-outline-check">{{translate('ترتيب الطباعة بالاقدم')}}</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row py-2">
                                                    <div class="col-md-4 col-xl-3">
                                                        <span class="fs-3 ">{{translate('اعتماد العقود')}}</span>
                                                    </div>
                                                    <div class="col-md-8 col-xl-9">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning-outline-check" value="118"  >
                                                            <label class="form-check-label" for="warning-outline-check">{{translate('مشاهدة العقد')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning-outline-check" value="130"  >
                                                            <label class="form-check-label" for="warning-outline-check">{{translate('جميع اعتماد العقود')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning-outline-check" value="151"  >
                                                            <label class="form-check-label" for="warning-outline-check">{{translate('تعديل')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning3-outline-check" value="74"  >
                                                            <label class="form-check-label" for="warning3-outline-check">{{translate('اعتماد')}}</label>
                                                        </div>

                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning4-outline-check" value="75"  >
                                                            <label class="form-check-label" for="warning4-outline-check">{{translate('حذف')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning4-outline-check" value="76"   >
                                                            <label class="form-check-label" for="warning4-outline-check">{{translate('عرض')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning2-outline-check" value="164"  >
                                                            <label class="form-check-label" for="warning2-outline-check">{{translate('مرتجع')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning2-outline-check" value="225"  >
                                                            <label class="form-check-label" for="warning2-outline-check">{{translate('طلب الاستقدام')}}</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row py-2">
                                                    <div class="col-md-4 col-xl-3">
                                                        <span class="fs-3 ">{{translate('العقود الجديدة')}}</span>
                                                    </div>
                                                    <div class="col-md-8 col-xl-9">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning-outline-check" value="119"  >
                                                            <label class="form-check-label" for="warning-outline-check">{{translate('مشاهدة العقد')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning-outline-check" value="131"  >
                                                            <label class="form-check-label" for="warning-outline-check">{{translate('جميع العقود')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning-outline-check" value="154"  >
                                                            <label class="form-check-label" for="warning-outline-check">{{translate('تعديل')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning-outline-check" value="77"  >
                                                            <label class="form-check-label" for="warning-outline-check">{{translate('الانتقال الى مساند')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning2-outline-check" value="78"   >
                                                            <label class="form-check-label" for="warning2-outline-check">{{translate('العودة اللى اعتماد العقود')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning4-outline-check" value="79"  >
                                                            <label class="form-check-label" for="warning4-outline-check">{{translate('عرض')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning2-outline-check" value="165"  >
                                                            <label class="form-check-label" for="warning2-outline-check">{{translate('مرتجع')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning2-outline-check" value="226"  >
                                                            <label class="form-check-label" for="warning2-outline-check">{{translate('طلب الاستقدام')}}</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row py-2">
                                                    <div class="col-md-4 col-xl-3">
                                                        <span class="fs-3 ">{{translate('مساند')}}</span>
                                                    </div>
                                                    <div class="col-md-8 col-xl-9">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning-outline-check" value="120"  >
                                                            <label class="form-check-label" for="warning-outline-check">{{translate('مشاهدة العقد')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning-outline-check" value="132"  >
                                                            <label class="form-check-label" for="warning-outline-check">{{translate('جميع العقود')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning-outline-check" value="157"  >
                                                            <label class="form-check-label" for="warning-outline-check">{{translate('تعديل')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning-outline-check" value="80"  >
                                                            <label class="form-check-label" for="warning-outline-check">{{translate('التفويض الألكترونى')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning2-outline-check" value="81"  >
                                                            <label class="form-check-label" for="warning2-outline-check">{{translate('العودة اللى العقود الجديدة')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning4-outline-check" value="82"  >
                                                            <label class="form-check-label" for="warning4-outline-check">{{translate('عرض')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning2-outline-check" value="166"  >
                                                            <label class="form-check-label" for="warning2-outline-check">{{translate('مرتجع')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning2-outline-check" value="227"  >
                                                            <label class="form-check-label" for="warning2-outline-check">{{translate('طلب الاستقدام')}}</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row py-2">
                                                    <div class="col-md-4 col-xl-3">
                                                        <span class="fs-3 ">{{translate('التفويض الألكترونى')}}</span>
                                                    </div>
                                                    <div class="col-md-8 col-xl-9">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning-outline-check" value="121"  >
                                                            <label class="form-check-label" for="warning-outline-check">{{translate('مشاهدة العقد')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning-outline-check" value="133"  >
                                                            <label class="form-check-label" for="warning-outline-check">{{translate('جميع العقود')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning-outline-check" value="153"  >
                                                            <label class="form-check-label" for="warning-outline-check">{{translate('تعديل')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning-outline-check" value="83"  >
                                                            <label class="form-check-label" for="warning-outline-check">{{translate('التفييز')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning2-outline-check" value="84"  >
                                                            <label class="form-check-label" for="warning2-outline-check">{{translate('الرجوع لمساند')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning4-outline-check" value="85"  >
                                                            <label class="form-check-label" for="warning4-outline-check">{{translate('عرض')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning2-outline-check" value="167"  >
                                                            <label class="form-check-label" for="warning2-outline-check">{{translate('مرتجع')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning2-outline-check" value="228"  >
                                                            <label class="form-check-label" for="warning2-outline-check">{{translate('طلب الاستقدام')}}</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row py-2">
                                                    <div class="col-md-4 col-xl-3">
                                                        <span class="fs-3 ">{{translate('التفييز')}}</span>
                                                    </div>
                                                    <div class="col-md-8 col-xl-9">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning-outline-check" value="122"  >
                                                            <label class="form-check-label" for="warning-outline-check">{{translate('مشاهدة العقد')}}</label>
                                                        </div>

                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning-outline-check" value="134"  >
                                                            <label class="form-check-label" for="warning-outline-check">{{translate('جميع العقود')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning-outline-check" value="156"  >
                                                            <label class="form-check-label" for="warning-outline-check">{{translate('تعديل')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning-outline-check" value="86"  >
                                                            <label class="form-check-label" for="warning-outline-check">{{translate('التذكرة')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning2-outline-check" value="87"  >
                                                            <label class="form-check-label" for="warning2-outline-check">{{translate('الرجوع لتفويض')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning4-outline-check" value="88"  >
                                                            <label class="form-check-label" for="warning4-outline-check">{{translate('عرض')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning2-outline-check" value="168"  >
                                                            <label class="form-check-label" for="warning2-outline-check">{{translate('مرتجع')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning2-outline-check" value="229"  >
                                                            <label class="form-check-label" for="warning2-outline-check">{{translate('طلب الاستقدام')}}</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row py-2">
                                                    <div class="col-md-4 col-xl-3">
                                                        <span class="fs-3 ">{{translate('التذكرة')}}</span>
                                                    </div>
                                                    <div class="col-md-8 col-xl-9">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning-outline-check" value="123"  >
                                                            <label class="form-check-label" for="warning-outline-check">{{translate('مشاهدة العقد')}}</label>
                                                        </div>

                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning-outline-check" value="135"  >
                                                            <label class="form-check-label" for="warning-outline-check">{{translate('جميع العقود')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning-outline-check" value="155"  >
                                                            <label class="form-check-label" for="warning-outline-check">{{translate('تعديل')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning-outline-check" value="89"  >
                                                            <label class="form-check-label" for="warning-outline-check">{{translate('تم الوصول')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning2-outline-check" value="90"  >
                                                            <label class="form-check-label" for="warning2-outline-check">{{translate('الرجوع لتفييز')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning4-outline-check" value="91"  >
                                                            <label class="form-check-label" for="warning4-outline-check">{{translate('عرض')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning2-outline-check" value="169"  >
                                                            <label class="form-check-label" for="warning2-outline-check">{{translate('مرتجع')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning2-outline-check" value="230"  >
                                                            <label class="form-check-label" for="warning2-outline-check">{{translate('طلب الاستقدام')}}</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row py-2">
                                                    <div class="col-md-4 col-xl-3">
                                                        <span class="fs-3 ">{{translate('مرحلة الوصول')}}</span>
                                                    </div>
                                                    <div class="col-md-8 col-xl-9">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning-outline-check" value="180"  >
                                                            <label class="form-check-label" for="warning-outline-check">{{translate('مشاهدة العقد')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning-outline-check" value="181"  >
                                                            <label class="form-check-label" for="warning-outline-check">{{translate('جميع العقود')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning-outline-check" value="182"  >
                                                            <label class="form-check-label" for="warning-outline-check">{{translate('تعديل')}}</label>
                                                        </div>
                                                        {{--                                                        <div class="form-check form-check-inline">--}}
                                                        {{--                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning-outline-check" value="183"  >--}}
                                                        {{--                                                            <label class="form-check-label" for="warning-outline-check">{{translate('تحت الضمان')}}</label>--}}
                                                        {{--                                                        </div>--}}
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning2-outline-check" value="184"  >
                                                            <label class="form-check-label" for="warning2-outline-check">{{translate('الرجوع لتذكره')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning4-outline-check" value="185"  >
                                                            <label class="form-check-label" for="warning4-outline-check">{{translate('عرض')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning2-outline-check" value="186"  >
                                                            <label class="form-check-label" for="warning2-outline-check">{{translate('مرتجع')}}</label>
                                                        </div>

                                                    </div>
                                                </div>
                                                {{--                                                <div class="row py-2">--}}
                                                {{--                                                    <div class="col-md-4 col-xl-3">--}}
                                                {{--                                                        <span class="fs-3 ">{{translate('تحت الضمان')}}</span>--}}
                                                {{--                                                    </div>--}}
                                                {{--                                                    <div class="col-md-8 col-xl-9">--}}
                                                {{--                                                        <div class="form-check form-check-inline">--}}
                                                {{--                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning-outline-check" value="124"  >--}}
                                                {{--                                                            <label class="form-check-label" for="warning-outline-check">{{translate('مشاهدة العقد')}}</label>--}}
                                                {{--                                                        </div>--}}
                                                {{--                                                        <div class="form-check form-check-inline">--}}
                                                {{--                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning-outline-check" value="136"  >--}}
                                                {{--                                                            <label class="form-check-label" for="warning-outline-check">{{translate('جميع العقود')}}</label>--}}
                                                {{--                                                        </div>--}}
                                                {{--                                                        <div class="form-check form-check-inline">--}}
                                                {{--                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning-outline-check" value="152"  >--}}
                                                {{--                                                            <label class="form-check-label" for="warning-outline-check">{{translate('تعديل')}}</label>--}}
                                                {{--                                                        </div>--}}
                                                {{--                                                        <div class="form-check form-check-inline">--}}
                                                {{--                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning2-outline-check" value="92"   >--}}
                                                {{--                                                            <label class="form-check-label" for="warning2-outline-check">{{translate('الرجوع لتذكرة')}}</label>--}}
                                                {{--                                                        </div>--}}
                                                {{--                                                        <div class="form-check form-check-inline">--}}
                                                {{--                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning4-outline-check" value="93"  >--}}
                                                {{--                                                            <label class="form-check-label" for="warning4-outline-check">{{translate('عرض')}}</label>--}}
                                                {{--                                                        </div>--}}
                                                {{--                                                        <div class="form-check form-check-inline">--}}
                                                {{--                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning2-outline-check" value="170"  >--}}
                                                {{--                                                            <label class="form-check-label" for="warning2-outline-check">{{translate('مرتجع')}}</label>--}}
                                                {{--                                                        </div>--}}

                                                {{--                                                    </div>--}}
                                                {{--                                                </div>--}}
                                                <div class="row py-2">
                                                    <div class="col-md-4 col-xl-3">
                                                        <span class="fs-3 ">{{translate('مرتجع')}}</span>
                                                    </div>
                                                    <div class="col-md-8 col-xl-9">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning4-outline-check" value="171"  >
                                                            <label class="form-check-label" for="warning4-outline-check">{{translate('عرض')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning4-outline-check" value="344"  >
                                                            <label class="form-check-label" for="warning4-outline-check">{{translate('رجوع العقد')}}</label>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="row py-2">
                                                    <div class="col-md-4 col-xl-3">
                                                        <span class="fs-3 ">{{translate('متاخر بالوصول')}}</span>
                                                    </div>
                                                    <div class="col-md-8 col-xl-9">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning-outline-check" value="194"   >
                                                            <label class="form-check-label" for="warning-outline-check">{{translate('مشاهدة العقد')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning-outline-check" value="195"  >
                                                            <label class="form-check-label" for="warning-outline-check">{{translate('جميع العقود')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning-outline-check" value="196"  >
                                                            <label class="form-check-label" for="warning-outline-check">{{translate('تعديل')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning4-outline-check" value="197"   >
                                                            <label class="form-check-label" for="warning4-outline-check">{{translate('عرض')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning2-outline-check" value="198"  >
                                                            <label class="form-check-label" for="warning2-outline-check">{{translate('مرتجع')}}</label>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="d-flex align-items-stretch">
                                    <div class="card w-100">
                                        <div class="card-header bg-warning">
                                            <h4 class="mb-0 text-white">{{translate('ادارة خدمات التاجير')}}</h4></div>
                                        <div class="card-body">

                                            <div class="mb-2 bt-switch">
                                                <div class="row py-2">
                                                    <div class="col-md-4 col-xl-3">
                                                        <span class="fs-3 ">{{translate('عمالة التأجير')}}</span>
                                                    </div>
                                                    <div class="col-md-8 col-xl-9">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning-outline-check" value="281"  >
                                                            <label class="form-check-label" for="warning-outline-check">{{translate('تعديل')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning2-outline-check" value="282"  >
                                                            <label class="form-check-label" for="warning2-outline-check">{{translate('اضافة عقد ايجار')}}</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row py-2">
                                                    <div class="col-md-4 col-xl-3">
                                                        <span class="fs-3 ">{{translate('جميع عقود التأجير')}}</span>
                                                    </div>
                                                    <div class="col-md-8 col-xl-9">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning-outline-check" value="283"  >
                                                            <label class="form-check-label" for="warning-outline-check">{{translate('تعديل')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning2-outline-check" value="284"  >
                                                            <label class="form-check-label" for="warning2-outline-check">{{translate('عرض العقد')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning3-outline-check" value="285"   >
                                                            <label class="form-check-label" for="warning3-outline-check">{{translate('مسح')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning4-outline-check" value="286"   >
                                                            <label class="form-check-label" for="warning4-outline-check">{{translate('عرض الجميع')}}</label>
                                                        </div>

                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning4-outline-check" value="288"   >
                                                            <label class="form-check-label" for="warning4-outline-check">{{translate('اغلاق حالة العقد')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning4-outline-check" value="289"   >
                                                            <label class="form-check-label" for="warning4-outline-check">{{translate('فتح حالة العقد')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning4-outline-check" value="287"  >
                                                            <label class="form-check-label" for="warning4-outline-check">{{translate('تنزيل عقد التاجير')}}</label>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="d-flex align-items-stretch">
                                    <div class="card w-100">
                                        <div class="card-header bg-warning">
                                            <h4 class="mb-0 text-white">{{translate('الاعدادات')}}</h4></div>
                                        <div class="card-body">

                                            <div class="mb-2 bt-switch">
                                                <div class="row py-2">
                                                    <div class="col-md-4 col-xl-3">
                                                        <span class="fs-3 ">{{translate('اعدادات الصفحة الرئيسية')}}</span>
                                                    </div>
                                                    <div class="col-md-8 col-xl-9">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning4-outline-check" value="94"  >
                                                            <label class="form-check-label" for="warning4-outline-check">{{translate('عرض وتعديل')}}</label>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="row py-2">
                                                    <div class="col-md-4 col-xl-3">
                                                        <span class="fs-3 ">{{translate('اعدادات جميع الصفحات')}}</span>
                                                    </div>
                                                    <div class="col-md-8 col-xl-9">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning3-outline-check" value="95"  >
                                                            <label class="form-check-label" for="warning3-outline-check">{{translate('عرض وتعديل')}}</label>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="row py-2">
                                                    <div class="col-md-4 col-xl-3">
                                                        <span class="fs-3 ">{{translate('الترجمه')}}</span>
                                                    </div>
                                                    <div class="col-md-8 col-xl-9">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning-outline-check" value="174"   >
                                                            <label class="form-check-label" for="warning-outline-check">{{translate('تعديل')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning2-outline-check" value="175"  >
                                                            <label class="form-check-label" for="warning2-outline-check">{{translate('اضافة')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning2-outline-check" value="176"  >
                                                            <label class="form-check-label" for="warning2-outline-check">{{translate('مسح')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning4-outline-check" value="177"  >
                                                            <label class="form-check-label" for="warning4-outline-check">{{translate('مشاهدة')}}</label>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="row py-2">
                                                    <div class="col-md-4 col-xl-3">
                                                        <span class="fs-3 ">{{translate('ارسال رسائل عبر الهاتف')}}</span>
                                                    </div>
                                                    <div class="col-md-8 col-xl-9">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning4-outline-check" value="96"  >
                                                            <label class="form-check-label" for="warning4-outline-check">{{translate('عرض')}}</label>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="row py-2">
                                                    <div class="col-md-4 col-xl-3">
                                                        <span class="fs-3 ">{{translate('ارسال رسائل عبر البريد')}}</span>
                                                    </div>
                                                    <div class="col-md-8 col-xl-9">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning4-outline-check" value="97"  >
                                                            <label class="form-check-label" for="warning4-outline-check">{{translate('عرض')}}</label>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="row py-2">
                                                    <div class="col-md-4 col-xl-3">
                                                        <span class="fs-3 ">{{translate('التوظيف')}}</span>
                                                    </div>
                                                    <div class="col-md-8 col-xl-9">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning-outline-check" value="98"   >
                                                            <label class="form-check-label" for="warning-outline-check">{{translate('تعديل')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning2-outline-check" value="99"  >
                                                            <label class="form-check-label" for="warning2-outline-check">{{translate('اضافة')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning2-outline-check" value="100"  >
                                                            <label class="form-check-label" for="warning2-outline-check">{{translate('مسح')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning4-outline-check" value="101"  >
                                                            <label class="form-check-label" for="warning4-outline-check">{{translate('عرض')}}</label>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="row py-2">
                                                    <div class="col-md-4 col-xl-3">
                                                        <span class="fs-3 ">{{translate('المتقدمين للوظائف')}}</span>
                                                    </div>
                                                    <div class="col-md-8 col-xl-9">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning2-outline-check" value="102"   >
                                                            <label class="form-check-label" for="warning2-outline-check">{{translate('مسح')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning4-outline-check" value="103"  >
                                                            <label class="form-check-label" for="warning4-outline-check">{{translate('عرض')}}</label>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="row py-2">
                                                    <div class="col-md-4 col-xl-3">
                                                        <span class="fs-3 ">{{translate('التدريب')}}</span>
                                                    </div>
                                                    <div class="col-md-8 col-xl-9">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning-outline-check" value="104"  >
                                                            <label class="form-check-label" for="warning-outline-check">{{translate('تعديل')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning2-outline-check" value="105"   >
                                                            <label class="form-check-label" for="warning2-outline-check">{{translate('اضافة')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning2-outline-check" value="106"  >
                                                            <label class="form-check-label" for="warning2-outline-check">{{translate('مسح')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning4-outline-check" value="107"  >
                                                            <label class="form-check-label" for="warning4-outline-check">{{translate('عرض')}}</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row py-2">
                                                    <div class="col-md-4 col-xl-3">
                                                        <span class="fs-3 ">{{translate('المتقدمين لتدريب')}}</span>
                                                    </div>
                                                    <div class="col-md-8 col-xl-9">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning2-outline-check" value="108"   >
                                                            <label class="form-check-label" for="warning2-outline-check">{{translate('مسح')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning4-outline-check" value="109"   >
                                                            <label class="form-check-label" for="warning4-outline-check">{{translate('عرض')}}</label>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="row py-2">
                                                    <div class="col-md-4 col-xl-3">
                                                        <span class="fs-3 ">{{translate('الموظفين')}}</span>
                                                    </div>
                                                    <div class="col-md-8 col-xl-9">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning-outline-check" value="110"  >
                                                            <label class="form-check-label" for="warning-outline-check">{{translate('تعديل')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning2-outline-check" value="111"   >
                                                            <label class="form-check-label" for="warning2-outline-check">{{translate('اضافة')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning3-outline-check" value="112"  >
                                                            <label class="form-check-label" for="warning3-outline-check">{{translate('مسح')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning4-outline-check" value="113"   >
                                                            <label class="form-check-label" for="warning4-outline-check">{{translate('عرض')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning4-outline-check" value="187"   >
                                                            <label class="form-check-label" for="warning4-outline-check">{{translate('اختار مسؤل الخارجية')}}</label>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="row py-2">
                                                    <div class="col-md-4 col-xl-3">
                                                        <span class="fs-3 ">{{translate('اذونات الموظفين')}}</span>
                                                    </div>
                                                    <div class="col-md-8 col-xl-9">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning-outline-check" value="114"  >
                                                            <label class="form-check-label" for="warning-outline-check">{{translate('تعديل')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning2-outline-check" value="115"  >
                                                            <label class="form-check-label" for="warning2-outline-check">{{translate('اضافة')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning3-outline-check" value="116"  >
                                                            <label class="form-check-label" for="warning3-outline-check">{{translate('مسح')}}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning4-outline-check" value="117"  >
                                                            <label class="form-check-label" for="warning4-outline-check">{{translate('عرض')}}</label>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="row py-2">
                                                    <div class="col-md-4 col-xl-3">
                                                        <span class="fs-3 ">{{translate('تحركات الموظفين')}}</span>
                                                    </div>
                                                    <div class="col-md-8 col-xl-9">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning4-outline-check" value="162"  >
                                                            <label class="form-check-label" for="warning4-outline-check">{{translate('عرض')}}</label>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
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

        </div>
    </div>







@endsection
@section('script')

    <script>
        // $(".bt-switch input[type='checkbox'], .bt-switch input[type='radio']").bootstrapSwitch();
        // var radioswitch = function() {
        //     var bt = function() {
        //         $(".radio-switch").on("switch-change", function() {
        //             $(".radio-switch").bootstrapSwitch("toggleRadioState")
        //         }), $(".radio-switch").on("switch-change", function() {
        //             $(".radio-switch").bootstrapSwitch("toggleRadioStateAllowUncheck")
        //         }), $(".radio-switch").on("switch-change", function() {
        //             $(".radio-switch").bootstrapSwitch("toggleRadioStateAllowUncheck", !1)
        //         })
        //     };
        //     return {
        //         init: function() {
        //             bt()
        //         }
        //     }
        // }();
        // $(document).ready(function() {
        //     radioswitch.init()
        // });
    </script>
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
