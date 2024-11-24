@extends('backend.layouts.app')

@section('content')

    <div class="page-wrapper">

        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="row page-titles">
            <div class="col-md-5 col-12 align-self-center">
                <h3 class="text-themecolor mb-0">{{translate('تعديل')}}</h3>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{route('website.main')}}">{{translate('الصفحة الرئيسية')}}</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0)">{{translate('الاعدادات')}}</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0)">{{translate('طقم العمل')}}</a></li>
                    <li class="breadcrumb-item active">{{translate('اذونات العمل')}}</li>
                </ol>
            </div>
        </div>
        @php
            $permissions = json_decode($role->permissions);
        @endphp
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
                <form class="p-4" action="{{ route('roles.update', $role->id) }}" class="needs-validation" method="POST">
                    <input name="_method" type="hidden" value="PATCH">
                    <input type="hidden" name="lang" value="{{ $lang }}">
                    @csrf

                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3 contact-age2">
                                <label>{{ translate('المسمى الوظيفى') }}</label>
                                <input type="text" class="form-control" placeholder="{{ translate('المسمى الوظيفى') }}"  value="{{ $role->getTranslation('name', $lang) }}" name="name" required>
                                <div class="valid-feedback">
                                    {{translate("برجاء ادخال المسمى الوظيفى")}}
                                </div>
                            </div>
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
                                                <span class="fs-3 ">{{translate('احصائيات لوحة التجكم')}}</span>
                                            </div>
                                            <div class="col-md-8 col-xl-9">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning"  type="checkbox"  name="permissions[]"  id="warning-outline-check" value="188" @php if(in_array(188, $permissions)) echo "checked"; @endphp>
                                                    <label class="form-check-label" for="warning-outline-check">{{translate('عرض احصائيات الاعداد')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning"  type="checkbox"  name="permissions[]"  id="warning-outline-check" value="201" @php if(in_array(201, $permissions)) echo "checked"; @endphp >
                                                    <label class="form-check-label" for="warning-outline-check">{{translate('اجمالى احصائيات الاعداد')}}</label>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="row py-2">
                                            <div class="col-md-4 col-xl-3">
                                            </div>
                                            <div class="col-md-8 col-xl-9">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning"  type="checkbox"  name="permissions[]"  id="warning2-outline-check" value="189" @php if(in_array(189, $permissions)) echo "checked"; @endphp>
                                                    <label class="form-check-label" for="warning2-outline-check">{{translate('عرض احصائيات عقود فى انتظار الاعتماد')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning"  type="checkbox"  name="permissions[]"  id="warning2-outline-check" value="202" @php if(in_array(202, $permissions)) echo "checked"; @endphp >
                                                    <label class="form-check-label" for="warning2-outline-check">{{translate('اجمالى احصائيات عقود فى انتظار الاعتماد')}}</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row py-2">
                                            <div class="col-md-4 col-xl-3">
                                            </div>
                                            <div class="col-md-8 col-xl-9">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning"  type="checkbox"  name="permissions[]"  id="warning3-outline-check" value="190" @php if(in_array(190, $permissions)) echo "checked"; @endphp >
                                                    <label class="form-check-label" for="warning3-outline-check">{{translate('عرض احصائيات الموظفين اليومية')}}</label>
                                                </div>
                                                {{--                                                <div class="form-check form-check-inline">--}}
                                                {{--                                                    <input class="form-check-input warning check-outline outline-warning"  type="checkbox"  name="permissions[]"  id="warning3-outline-check" value="203" @php if(in_array(203, $permissions)) echo "checked"; @endphp >--}}
                                                {{--                                                    <label class="form-check-label" for="warning3-outline-check">{{translate('اجمالى احصائيات الموظفين اليومية')}}</label>--}}
                                                {{--                                                </div>--}}

                                            </div>
                                        </div>
                                        <div class="row py-2">
                                            <div class="col-md-4 col-xl-3">
                                            </div>
                                            <div class="col-md-8 col-xl-9">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning"  type="checkbox"  name="permissions[]"  id="warning4-outline-check" value="191" @php if(in_array(191, $permissions)) echo "checked"; @endphp>
                                                    <label class="form-check-label" for="warning4-outline-check">{{translate('عرض احصائيات المكاتب')}}</label>
                                                </div>
                                                {{--                                                <div class="form-check form-check-inline">--}}
                                                {{--                                                    <input class="form-check-input warning check-outline outline-warning"  type="checkbox"  name="permissions[]"  id="warning4-outline-check" value="204" @php if(in_array(204, $permissions)) echo "checked"; @endphp >--}}
                                                {{--                                                    <label class="form-check-label" for="warning4-outline-check">{{translate('اجمالى احصائيات المكاتب')}}</label>--}}
                                                {{--                                                </div>--}}

                                            </div>
                                        </div>
                                        <div class="row py-2">
                                            <div class="col-md-4 col-xl-3">
                                            </div>
                                            <div class="col-md-8 col-xl-9">

                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning"  type="checkbox"  name="permissions[]"  id="warning4-outline-check" value="192" @php if(in_array(192, $permissions)) echo "checked"; @endphp >
                                                    <label class="form-check-label" for="warning4-outline-check">{{translate('عرض احصائيات الحجوزات المتاخرة')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning"  type="checkbox"  name="permissions[]"  id="warning4-outline-check" value="205" @php if(in_array(205, $permissions)) echo "checked"; @endphp>
                                                    <label class="form-check-label" for="warning4-outline-check">{{translate('اجمالى احصائيات الحجوزات المتاخرة')}}</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row py-2">
                                            <div class="col-md-4 col-xl-3">
                                            </div>
                                            <div class="col-md-8 col-xl-9">

                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning"  type="checkbox"  name="permissions[]"  id="warning4-outline-check" value="193" @php if(in_array(193, $permissions)) echo "checked"; @endphp>
                                                    <label class="form-check-label" for="warning4-outline-check">{{translate('عرض احصائيات العقود الحالية والسابقة')}}</label>
                                                </div>
                                                {{--                                                <div class="form-check form-check-inline">--}}
                                                {{--                                                    <input class="form-check-input warning check-outline outline-warning"  type="checkbox"  name="permissions[]"  id="warning4-outline-check" value="206" @php if(in_array(206, $permissions)) echo "checked"; @endphp>--}}
                                                {{--                                                    <label class="form-check-label" for="warning4-outline-check">{{translate('اجمالى احصائيات العقود الحالية والسابقة')}}</label>--}}
                                                {{--                                                </div>--}}
                                            </div>
                                        </div>
                                        <div class="row py-2">
                                            <div class="col-md-4 col-xl-3">
                                            </div>
                                            <div class="col-md-8 col-xl-9">

                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning"  type="checkbox"  name="permissions[]"  id="warning4-outline-check" value="203" @php if(in_array(203, $permissions)) echo "checked"; @endphp>
                                                    <label class="form-check-label" for="warning4-outline-check">{{translate('عرض النتيجة')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning"  type="checkbox"  name="permissions[]"  id="warning4-outline-check" value="204" @php if(in_array(204, $permissions)) echo "checked"; @endphp>
                                                    <label class="form-check-label" for="warning4-outline-check">{{translate('اجمالى الحجوزات والعقود فى  النتيجة')}}</label>
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
                                    <h4 class="mb-0 text-white">{{translate('ادارة العملاء')}}</h4></div>
                                <div class="card-body">

                                    <div class="mb-2 bt-switch">
                                        <div class="row py-2">
                                            <div class="col-md-4 col-xl-3">
                                                <span class="fs-3 ">{{translate('قائمة العملاء')}}</span>
                                            </div>
                                            <div class="col-md-8 col-xl-9">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning"  type="checkbox"  name="permissions[]"  id="warning-outline-check" value="1" @php if(in_array(1, $permissions)) echo "checked"; @endphp>
                                                    <label class="form-check-label" for="warning-outline-check">{{translate('تعديل')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning"  type="checkbox"  name="permissions[]"  id="warning2-outline-check" value="2" @php if(in_array(2, $permissions)) echo "checked"; @endphp >
                                                    <label class="form-check-label" for="warning2-outline-check">{{translate('اضافة')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning"  type="checkbox"  name="permissions[]"  id="warning3-outline-check" value="3" @php if(in_array(3, $permissions)) echo "checked"; @endphp>
                                                    <label class="form-check-label" for="warning3-outline-check">{{translate('مسح')}}</label>
                                                </div>

                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning"  type="checkbox"  name="permissions[]"  id="warning4-outline-check" value="4" @php if(in_array(4, $permissions)) echo "checked"; @endphp>
                                                    <label class="form-check-label" for="warning4-outline-check">{{translate('عرض')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning"  type="checkbox"  name="permissions[]"  id="warning4-outline-check" value="149"  @php if(in_array(149, $permissions)) echo "checked"; @endphp>
                                                    <label class="form-check-label" for="warning4-outline-check">{{translate('التعليق')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning"  type="checkbox"  name="permissions[]"  id="warning4-outline-check" value="126"  @php if(in_array(126, $permissions)) echo "checked"; @endphp>
                                                    <label class="form-check-label" for="warning4-outline-check">{{translate('الرسائل المرسلة')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning2-outline-check" value="236" @php if(in_array(236, $permissions)) echo "checked"; @endphp >
                                                    <label class="form-check-label" for="warning2-outline-check">{{translate('ارسال رساله للعميل')}}</label>
                                                </div>
                                            </div>
                                        </div>
                                        {{--                                        <div class="row py-2">--}}
                                        {{--                                            <div class="col-md-4 col-xl-3">--}}
                                        {{--                                                <span class="fs-3 ">{{translate('العملاء المحتملين')}}</span>--}}
                                        {{--                                            </div>--}}
                                        {{--                                            <div class="col-md-8 col-xl-9">--}}
                                        {{--                                                <div class="form-check form-check-inline">--}}
                                        {{--                                                    <input class="form-check-input warning check-outline outline-warning"  type="checkbox"  name="permissions[]"  id="warning-outline-check" value="5" @php if(in_array(5, $permissions)) echo "checked"; @endphp>--}}
                                        {{--                                                    <label class="form-check-label" for="warning-outline-check">{{translate('تعديل')}}</label>--}}
                                        {{--                                                </div>--}}
                                        {{--                                                <div class="form-check form-check-inline">--}}
                                        {{--                                                    <input class="form-check-input warning check-outline outline-warning"  type="checkbox"  name="permissions[]"  id="warning2-outline-check" value="6" @php if(in_array(6, $permissions)) echo "checked"; @endphp>--}}
                                        {{--                                                    <label class="form-check-label" for="warning2-outline-check">{{translate('اضافة')}}</label>--}}
                                        {{--                                                </div>--}}
                                        {{--                                                <div class="form-check form-check-inline">--}}
                                        {{--                                                    <input class="form-check-input warning check-outline outline-warning"  type="checkbox"  name="permissions[]"  id="warning3-outline-check" value="7"@php if(in_array(7, $permissions)) echo "checked"; @endphp >--}}
                                        {{--                                                    <label class="form-check-label" for="warning3-outline-check">{{translate('مسح')}}</label>--}}
                                        {{--                                                </div>--}}
                                        {{--                                                <div class="form-check form-check-inline">--}}
                                        {{--                                                    <input class="form-check-input warning check-outline outline-warning"  type="checkbox"  name="permissions[]"  id="warning4-outline-check" value="8" @php if(in_array(8, $permissions)) echo "checked"; @endphp >--}}
                                        {{--                                                    <label class="form-check-label" for="warning4-outline-check">{{translate('عرض')}}</label>--}}
                                        {{--                                                </div>--}}
                                        {{--                                            </div>--}}
                                        {{--                                        </div>--}}
                                        <div class="row py-2">
                                            <div class="col-md-4 col-xl-3">
                                                <span class="fs-3 ">{{translate('سنترال الرقم الموحد')}}</span>
                                            </div>
                                            <div class="col-md-8 col-xl-9">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning"  type="checkbox"  name="permissions[]"  id="warning-outline-check" value="9" @php if(in_array(9, $permissions)) echo "checked"; @endphp>
                                                    <label class="form-check-label" for="warning-outline-check">{{translate('تعديل')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning"  type="checkbox"  name="permissions[]"  id="warning2-outline-check" value="10" @php if(in_array(10, $permissions)) echo "checked"; @endphp>
                                                    <label class="form-check-label" for="warning2-outline-check">{{translate('ادخال')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning"  type="checkbox"  name="permissions[]"  id="warning3-outline-check" value="11" @php if(in_array(11, $permissions)) echo "checked"; @endphp>
                                                    <label class="form-check-label" for="warning3-outline-check">{{translate('مسح')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning"  type="checkbox"  name="permissions[]"  id="warning4-outline-check" value="12" @php if(in_array(12, $permissions)) echo "checked"; @endphp>
                                                    <label class="form-check-label" for="warning4-outline-check">{{translate('عرض')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning4-outline-check" value="223"  @php if(in_array(223, $permissions)) echo "checked"; @endphp>
                                                    <label class="form-check-label" for="warning4-outline-check">{{translate('جميع البيانات')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning2-outline-check" value="245"   @php if(in_array(245, $permissions)) echo "checked"; @endphp>
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
                                                    <input class="form-check-input warning check-outline outline-warning"  type="checkbox"  name="permissions[]"  id="warning-outline-check" value="13" @php if(in_array(13, $permissions)) echo "checked"; @endphp>
                                                    <label class="form-check-label" for="warning-outline-check">{{translate('تغير الحالة')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning"  type="checkbox"  name="permissions[]"  id="warning2-outline-check" value="14" @php if(in_array(14, $permissions)) echo "checked"; @endphp>
                                                    <label class="form-check-label" for="warning2-outline-check">{{translate('الرد على العميل')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning"  type="checkbox"  name="permissions[]"  id="warning3-outline-check" value="15" @php if(in_array(15, $permissions)) echo "checked"; @endphp>
                                                    <label class="form-check-label" for="warning3-outline-check">{{translate('مسح')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning"  type="checkbox"  name="permissions[]"  id="warning4-outline-check" value="16" @php if(in_array(16, $permissions)) echo "checked"; @endphp>
                                                    <label class="form-check-label" for="warning4-outline-check">{{translate('عرض')}}</label>
                                                </div>
                                            </div>
                                        </div>
                                        {{--                                        <div class="row py-2">--}}
                                        {{--                                            <div class="col-md-4 col-xl-3">--}}
                                        {{--                                                <span class="fs-3 ">{{translate('التذكرة')}}</span>--}}
                                        {{--                                            </div>--}}
                                        {{--                                            <div class="col-md-8 col-xl-9">--}}
                                        {{--                                                <div class="form-check form-check-inline">--}}
                                        {{--                                                    <input class="form-check-input warning check-outline outline-warning"  type="checkbox"  name="permissions[]"  id="warning-outline-check" value="127" @php if(in_array(127, $permissions)) echo "checked"; @endphp >--}}
                                        {{--                                                    <label class="form-check-label" for="warning-outline-check">{{translate('اضافة')}}</label>--}}
                                        {{--                                                </div>--}}
                                        {{--                                                <div class="form-check form-check-inline">--}}
                                        {{--                                                    <input class="form-check-input warning check-outline outline-warning"  type="checkbox"  name="permissions[]"  id="warning-outline-check" value="17" @php if(in_array(17, $permissions)) echo "checked"; @endphp>--}}
                                        {{--                                                    <label class="form-check-label" for="warning-outline-check">{{translate('العرض')}}</label>--}}
                                        {{--                                                </div>--}}
                                        {{--                                                <div class="form-check form-check-inline">--}}
                                        {{--                                                    <input class="form-check-input warning check-outline outline-warning"  type="checkbox"  name="permissions[]"  id="warning2-outline-check" value="18" @php if(in_array(18, $permissions)) echo "checked"; @endphp >--}}
                                        {{--                                                    <label class="form-check-label" for="warning2-outline-check">{{translate('الرد على العميل')}}</label>--}}
                                        {{--                                                </div>--}}
                                        {{--                                            </div>--}}
                                        {{--                                        </div>--}}
                                        {{--                                        <div class="row py-2">--}}
                                        {{--                                            <div class="col-md-4 col-xl-3">--}}
                                        {{--                                                <span class="fs-3 ">{{translate('المشتركين')}}</span>--}}
                                        {{--                                            </div>--}}
                                        {{--                                            <div class="col-md-8 col-xl-9">--}}
                                        {{--                                                <div class="form-check form-check-inline">--}}
                                        {{--                                                    <input class="form-check-input warning check-outline outline-warning"  type="checkbox"  name="permissions[]"  id="warning3-outline-check" value="19" @php if(in_array(19, $permissions)) echo "checked"; @endphp>--}}
                                        {{--                                                    <label class="form-check-label" for="warning3-outline-check">{{translate('مسح')}}</label>--}}
                                        {{--                                                </div>--}}
                                        {{--                                                <div class="form-check form-check-inline">--}}
                                        {{--                                                    <input class="form-check-input warning check-outline outline-warning"  type="checkbox"  name="permissions[]"  id="warning4-outline-check" value="20" @php if(in_array(20, $permissions)) echo "checked"; @endphp>--}}
                                        {{--                                                    <label class="form-check-label" for="warning4-outline-check">{{translate('عرض')}}</label>--}}
                                        {{--                                                </div>--}}
                                        {{--                                            </div>--}}
                                        {{--                                        </div>--}}
                                        <div class="row py-2">
                                            <div class="col-md-4 col-xl-3">
                                                <span class="fs-3 ">{{translate('متابعة العملاء')}}</span>
                                            </div>
                                            <div class="col-md-8 col-xl-9">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning"  type="checkbox"  name="permissions[]"  id="warning-outline-check" value="137" @php if(in_array(137, $permissions)) echo "checked"; @endphp >
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
                                    <h4 class="mb-0 text-white">{{translate('ادارة المكاتب الخارجية')}}</h4></div>
                                <div class="card-body">

                                    <div class="mb-2 bt-switch">
                                        <div class="row py-2">
                                            <div class="col-md-4 col-xl-3">
                                                <span class="fs-3 ">{{translate('المكتب الخارجى')}}</span>
                                            </div>
                                            <div class="col-md-8 col-xl-9">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning"  type="checkbox"  name="permissions[]"  id="warning-outline-check" value="25" @php if(in_array(25, $permissions)) echo "checked"; @endphp>
                                                    <label class="form-check-label" for="warning-outline-check">{{translate('تعديل')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning"  type="checkbox"  name="permissions[]"  id="warning2-outline-check" value="26" @php if(in_array(26, $permissions)) echo "checked"; @endphp>
                                                    <label class="form-check-label" for="warning2-outline-check">{{translate('اضافة')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning"  type="checkbox"  name="permissions[]"  id="warning3-outline-check" value="27" @php if(in_array(27, $permissions)) echo "checked"; @endphp>
                                                    <label class="form-check-label" for="warning3-outline-check">{{translate('مسح')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning"  type="checkbox"  name="permissions[]"  id="warning4-outline-check" value="28" @php if(in_array(28, $permissions)) echo "checked"; @endphp>
                                                    <label class="form-check-label" for="warning4-outline-check">{{translate('عرض')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning"  type="checkbox"  name="permissions[]"  id="warning4-outline-check" value="147" @php if(in_array(147, $permissions)) echo "checked"; @endphp >
                                                    <label class="form-check-label" for="warning4-outline-check">{{translate('تعليق')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning"  type="checkbox"  name="permissions[]"  id="warning4-outline-check" value="148" @php if(in_array(148, $permissions)) echo "checked"; @endphp >
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
                                                    <input class="form-check-input warning check-outline outline-warning"  type="checkbox"  name="permissions[]"  id="warning-outline-check" value="29" @php if(in_array(29, $permissions)) echo "checked"; @endphp>
                                                    <label class="form-check-label" for="warning-outline-check">{{translate('تعديل')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning"  type="checkbox"  name="permissions[]"  id="warning2-outline-check" value="30" @php if(in_array(30, $permissions)) echo "checked"; @endphp>
                                                    <label class="form-check-label" for="warning2-outline-check">{{translate('اضافة')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning"  type="checkbox"  name="permissions[]"  id="warning3-outline-check" value="31" @php if(in_array(31, $permissions)) echo "checked"; @endphp >
                                                    <label class="form-check-label" for="warning3-outline-check">{{translate('مسح')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning"  type="checkbox"  name="permissions[]"  id="warning4-outline-check" value="32" @php if(in_array(32, $permissions)) echo "checked"; @endphp >
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
                                    <h4 class="mb-0 text-white">{{translate('ادارة العقود')}}</h4></div>
                                <div class="card-body">

                                    <div class="mb-2 bt-switch">
                                        <div class="row py-2">
                                            <div class="col-md-4 col-xl-3">
                                                <span class="fs-3 ">{{translate('العقود')}}</span>
                                            </div>
                                            <div class="col-md-8 col-xl-9">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning-outline-check" value="290"  @php if(in_array(290, $permissions)) echo "checked"; @endphp >
                                                    <label class="form-check-label" for="warning-outline-check">{{translate('عرض')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning2-outline-check" value="291"  @php if(in_array(291, $permissions)) echo "checked"; @endphp >
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
                                    <h4 class="mb-0 text-white">{{translate('ادارة السيرة الذاتية')}}</h4></div>
                                <div class="card-body">

                                    <div class="mb-2 bt-switch">
                                        <div class="row py-2">
                                            <div class="col-md-4 col-xl-3">
                                                <span class="fs-3 ">{{translate('السيرة الذاتية')}}</span>
                                            </div>
                                            <div class="col-md-8 col-xl-9">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning"  type="checkbox"  name="permissions[]"  id="warning-outline-check" value="250" @php if(in_array(250, $permissions)) echo "checked"; @endphp>
                                                    <label class="form-check-label" for="warning-outline-check">{{translate('دمج التصميم الموحد')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning"  type="checkbox"  name="permissions[]"  id="warning-outline-check" value="33" @php if(in_array(33, $permissions)) echo "checked"; @endphp>
                                                    <label class="form-check-label" for="warning-outline-check">{{translate('تعديل')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning"  type="checkbox"  name="permissions[]"  id="warning2-outline-check" value="34" @php if(in_array(34, $permissions)) echo "checked"; @endphp >
                                                    <label class="form-check-label" for="warning2-outline-check">{{translate('اضافة')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning"  type="checkbox"  name="permissions[]"  id="warning3-outline-check" value="35" @php if(in_array(35, $permissions)) echo "checked"; @endphp>
                                                    <label class="form-check-label" for="warning3-outline-check">{{translate('مسح')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning"  type="checkbox"  name="permissions[]"  id="warning4-outline-check" value="36" @php if(in_array(36, $permissions)) echo "checked"; @endphp>
                                                    <label class="form-check-label" for="warning4-outline-check">{{translate('عرض')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning"  type="checkbox"  name="permissions[]"  id="warning4-outline-check" value="37" @php if(in_array(37, $permissions)) echo "checked"; @endphp>
                                                    <label class="form-check-label" for="warning4-outline-check">{{translate('تعليق')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning"  type="checkbox"  name="permissions[]"  id="warning2-outline-check" value="21"  @php if(in_array(21, $permissions)) echo "checked"; @endphp>
                                                    <label class="form-check-label" for="warning2-outline-check">{{translate('باك اوت')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning"  type="checkbox"  name="permissions[]"  id="warning2-outline-check" value="22" @php if(in_array(22, $permissions)) echo "checked"; @endphp >
                                                    <label class="form-check-label" for="warning2-outline-check">{{translate('تغير حالة الحجز')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning"  type="checkbox"  name="permissions[]"  id="warning2-outline-check" value="150" @php if(in_array(150, $permissions)) echo "checked"; @endphp  >
                                                    <label class="form-check-label" for="warning2-outline-check">{{translate('ادخال السيرة الذاتية')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning2-outline-check" value="231" @php if(in_array(231, $permissions)) echo "checked"; @endphp  >
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
                                                    <input class="form-check-input warning check-outline outline-warning"  type="checkbox"  name="permissions[]"  id="warning-outline-check" value="38" @php if(in_array(38, $permissions)) echo "checked"; @endphp>
                                                    <label class="form-check-label" for="warning-outline-check">{{translate('تعديل')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning"  type="checkbox"  name="permissions[]"  id="warning2-outline-check" value="39" @php if(in_array(39, $permissions)) echo "checked"; @endphp>
                                                    <label class="form-check-label" for="warning2-outline-check">{{translate('اضافة')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning"  type="checkbox"  name="permissions[]"  id="warning3-outline-check" value="40" @php if(in_array(40, $permissions)) echo "checked"; @endphp>
                                                    <label class="form-check-label" for="warning3-outline-check">{{translate('مسح')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning"  type="checkbox"  name="permissions[]"  id="warning4-outline-check" value="41" @php if(in_array(41, $permissions)) echo "checked"; @endphp>
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
                                                    <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning-outline-check" value="159" @php if(in_array(159, $permissions)) echo "checked"; @endphp >
                                                    <label class="form-check-label" for="warning-outline-check">{{translate('تعديل')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning3-outline-check" value="173" @php if(in_array(173, $permissions)) echo "checked"; @endphp  >
                                                    <label class="form-check-label" for="warning3-outline-check">{{translate('ارجاع متاح')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning3-outline-check" value="160" @php if(in_array(160, $permissions)) echo "checked"; @endphp >
                                                    <label class="form-check-label" for="warning3-outline-check">{{translate('مسح')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning4-outline-check" value="161" @php if(in_array(161, $permissions)) echo "checked"; @endphp >
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
                                                    <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning3-outline-check" value="178"   @php if(in_array(178, $permissions)) echo "checked"; @endphp>
                                                    <label class="form-check-label" for="warning3-outline-check">{{translate('ارجاع متاح')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning4-outline-check" value="179"  @php if(in_array(179, $permissions)) echo "checked"; @endphp >
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
                                                    <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning-outline-check" value="294" @php if(in_array(294, $permissions)) echo "checked"; @endphp >
                                                    <label class="form-check-label" for="warning-outline-check">{{translate('عرض')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning2-outline-check" value="295" @php if(in_array(295, $permissions)) echo "checked"; @endphp >
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
                                                    <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning2-outline-check" value="244" @php if(in_array(244, $permissions)) echo "checked"; @endphp >
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
                                                    <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning2-outline-check" value="51" @php if(in_array(51, $permissions)) echo "checked"; @endphp  >
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
                                                    <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning2-outline-check" value="277"  @php if(in_array(277, $permissions)) echo "checked"; @endphp >
                                                    <label class="form-check-label" for="warning2-outline-check">{{translate('طلبات نقل الكفالة')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning-outline-check" value="278"  @php if(in_array(278, $permissions)) echo "checked"; @endphp>
                                                    <label class="form-check-label" for="warning-outline-check">{{translate('نموذج الاستلام')}}</label>
                                                </div>


                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning4-outline-check" value="279"  @php if(in_array(279, $permissions)) echo "checked"; @endphp >
                                                    <label class="form-check-label" for="warning4-outline-check">{{translate('عرض العقد')}}</label>
                                                </div>


                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning-outline-check" value="280" @php if(in_array(280, $permissions)) echo "checked"; @endphp >
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
                                                    <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning2-outline-check" value="261" @php if(in_array(261, $permissions)) echo "checked"; @endphp   >
                                                    <label class="form-check-label" for="warning2-outline-check">{{translate('ترعب/ﻻ ترغب بالعمل')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning-outline-check" value="263" @php if(in_array(263, $permissions)) echo "checked"; @endphp  >
                                                    <label class="form-check-label" for="warning-outline-check">{{translate('نموذج الاستلام')}}</label>
                                                </div>

                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning3-outline-check" value="238"  @php if(in_array(238, $permissions)) echo "checked"; @endphp >
                                                    <label class="form-check-label" for="warning3-outline-check">{{translate('ترحيل العاملة')}}</label>
                                                </div>

                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning4-outline-check" value="53"  @php if(in_array(53, $permissions)) echo "checked"; @endphp >
                                                    <label class="form-check-label" for="warning4-outline-check">{{translate('عرض العقد')}}</label>
                                                </div>


                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning-outline-check" value="50" @php if(in_array(50, $permissions)) echo "checked"; @endphp >
                                                    <label class="form-check-label" for="warning-outline-check">{{translate('تعديل')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning-outline-check" value="264"  @php if(in_array(264, $permissions)) echo "checked"; @endphp>
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
                                                    <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning2-outline-check" value="43" @php if(in_array(43, $permissions)) echo "checked"; @endphp >
                                                    <label class="form-check-label" for="warning2-outline-check">{{translate('طلب نقل كفالة')}}</label>
                                                </div>

                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning-outline-check" value="269"  @php if(in_array(269, $permissions)) echo "checked"; @endphp>
                                                    <label class="form-check-label" for="warning-outline-check">{{translate('نموذج الاستلام')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning2-outline-check" value="265"  @php if(in_array(265, $permissions)) echo "checked"; @endphp >
                                                    <label class="form-check-label" for="warning2-outline-check">{{translate('الظهور بالموقع')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning-outline-check" value="270"  @php if(in_array(270, $permissions)) echo "checked"; @endphp>
                                                    <label class="form-check-label" for="warning-outline-check">{{translate('تعديل')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning4-outline-check" value="271"  @php if(in_array(271, $permissions)) echo "checked"; @endphp >
                                                    <label class="form-check-label" for="warning4-outline-check">{{translate('عرض العقد')}}</label>
                                                </div>

                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning-outline-check" value="272"  @php if(in_array(272, $permissions)) echo "checked"; @endphp>
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
                                                    <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning-outline-check" value="207"  @php if(in_array(207, $permissions)) echo "checked"; @endphp>
                                                    <label class="form-check-label" for="warning-outline-check">{{translate('عرض الجميع')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning-outline-check" value="208"  @php if(in_array(208, $permissions)) echo "checked"; @endphp>
                                                    <label class="form-check-label" for="warning-outline-check">{{translate('عرض العقد')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning2-outline-check" value="209"  @php if(in_array(209, $permissions)) echo "checked"; @endphp>
                                                    <label class="form-check-label" for="warning2-outline-check">{{translate('ترغب بالعمل')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning4-outline-check" value="267"  @php if(in_array(267, $permissions)) echo "checked"; @endphp >
                                                    <label class="form-check-label" for="warning4-outline-check">{{translate('اجراء مسؤل السكن')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning4-outline-check" value="268"  @php if(in_array(268, $permissions)) echo "checked"; @endphp >
                                                    <label class="form-check-label" for="warning4-outline-check">{{translate('اجراء خدمة العملاء')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning4-outline-check" value="210"   @php if(in_array(210, $permissions)) echo "checked"; @endphp>
                                                    <label class="form-check-label" for="warning4-outline-check">{{translate('تغير حالات الترحيل')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning4-outline-check" value="266"   @php if(in_array(266, $permissions)) echo "checked"; @endphp>
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
                                                    <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning-outline-check" value="273" @php if(in_array(273, $permissions)) echo "checked"; @endphp >
                                                    <label class="form-check-label" for="warning-outline-check">{{translate('عرض الجميع')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning-outline-check" value="274"  @php if(in_array(274, $permissions)) echo "checked"; @endphp>
                                                    <label class="form-check-label" for="warning-outline-check">{{translate('عرض العقد')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning2-outline-check" value="275" @php if(in_array(275, $permissions)) echo "checked"; @endphp >
                                                    <label class="form-check-label" for="warning2-outline-check">{{translate('نموذج الاستلام')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning4-outline-check" value="276"  @php if(in_array(276, $permissions)) echo "checked"; @endphp >
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
                                                    <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning4-outline-check" value="247"  @php if(in_array(247, $permissions)) echo "checked"; @endphp >
                                                    <label class="form-check-label" for="warning4-outline-check">{{translate('عرض الجميع')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning-outline-check" value="246"  @php if(in_array(246, $permissions)) echo "checked"; @endphp>
                                                    <label class="form-check-label" for="warning-outline-check">{{translate('تعديل')}}</label>
                                                </div>


                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning4-outline-check"  value="248" @php if(in_array(248, $permissions)) echo "checked"; @endphp>
                                                    <label class="form-check-label" for="warning4-outline-check">{{translate('تاكيد نقل')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning4-outline-check"  value="249" 249 @php if(in_array(249, $permissions)) echo "checked"; @endphp>
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
                                                    <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning-outline-check" value="42" @php if(in_array(42, $permissions)) echo "checked"; @endphp >
                                                    <label class="form-check-label" for="warning-outline-check">{{translate('تعديل')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning4-outline-check" value="45"  @php if(in_array(45, $permissions)) echo "checked"; @endphp >
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
                                                    <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning-outline-check" value="46" @php if(in_array(46, $permissions)) echo "checked"; @endphp >
                                                    <label class="form-check-label" for="warning-outline-check">{{translate('تعديل')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning2-outline-check" value="47" @php if(in_array(47, $permissions)) echo "checked"; @endphp >
                                                    <label class="form-check-label" for="warning2-outline-check">{{translate('اضافة')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning3-outline-check" value="48" @php if(in_array(48, $permissions)) echo "checked"; @endphp >
                                                    <label class="form-check-label" for="warning3-outline-check">{{translate('مسح')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning4-outline-check" value="49" @php if(in_array(49, $permissions)) echo "checked"; @endphp  >
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
                                                    <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning4-outline-check" value="211"  @php if(in_array(211, $permissions)) echo "checked"; @endphp >
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
                                                    <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning-outline-check" value="292" @php if(in_array(292, $permissions)) echo "checked"; @endphp  >
                                                    <label class="form-check-label" for="warning-outline-check">{{translate('عرض')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning2-outline-check" value="293" @php if(in_array(293, $permissions)) echo "checked"; @endphp  >
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
                                                <span class="fs-3 ">{{translate('الطلبات الماليه (المبيعات - اخري)')}}</span>
                                            </div>
                                            <div class="col-md-8 col-xl-9">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning-outline-check" value="217"  @php if(in_array(217, $permissions)) echo "checked"; @endphp >
                                                    <label class="form-check-label" for="warning-outline-check">{{translate('اضافة')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning-outline-check" value="218"  @php if(in_array(218, $permissions)) echo "checked"; @endphp>
                                                    <label class="form-check-label" for="warning-outline-check">{{translate('عرض')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning-outline-check" value="219" @php if(in_array(219, $permissions)) echo "checked"; @endphp >
                                                    <label class="form-check-label" for="warning-outline-check">{{translate('عرض جميع الطلبات')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning-outline-check" value="220" @php if(in_array(220, $permissions)) echo "checked"; @endphp  >
                                                    <label class="form-check-label" for="warning-outline-check">{{translate('تعديل')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning2-outline-check" value="221" @php if(in_array(221, $permissions)) echo "checked"; @endphp >
                                                    <label class="form-check-label" for="warning2-outline-check">{{translate('تغير حالة الطلب')}}</label>
                                                </div>

                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning4-outline-check" value="222"  @php if(in_array(222, $permissions)) echo "checked"; @endphp  >
                                                    <label class="form-check-label" for="warning4-outline-check">{{translate('تفاصيل الطلب')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning4-outline-check" value="237"  @php if(in_array(237, $permissions)) echo "checked"; @endphp  >
                                                    <label class="form-check-label" for="warning4-outline-check">{{translate('مسح الطلب')}}</label>
                                                </div>
                                                {{--                                                <div class="form-check form-check-inline">--}}
                                                {{--                                                    <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning4-outline-check" value="239"  @php if(in_array(239, $permissions)) echo "checked"; @endphp  >--}}
                                                {{--                                                    <label class="form-check-label" for="warning4-outline-check">{{translate('قفل مراجعة الطلبات')}}</label>--}}
                                                {{--                                                </div>--}}
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning4-outline-check" value="240"  @php if(in_array(240, $permissions)) echo "checked"; @endphp >
                                                    <label class="form-check-label" for="warning4-outline-check">{{translate('فلترة جميع المسوقات')}}</label>
                                                </div>

                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning4-outline-check" value="239"  @php if(in_array(239, $permissions)) echo "checked"; @endphp >
                                                    <label class="form-check-label" for="warning4-outline-check">{{translate('نغير حالة الطلب عند قيد المراجعه')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning4-outline-check" value="241"  @php if(in_array(241, $permissions)) echo "checked"; @endphp >
                                                    <label class="form-check-label" for="warning4-outline-check">{{translate("نغير حالة الطلب عند تحت الاجراء")}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning4-outline-check" value="242"  @php if(in_array(242, $permissions)) echo "checked"; @endphp >
                                                    <label class="form-check-label" for="warning4-outline-check">{{translate('نغير حالة الطلب عند تم السداد')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning4-outline-check" value="243"  @php if(in_array(243, $permissions)) echo "checked"; @endphp >
                                                    <label class="form-check-label" for="warning4-outline-check">{{translate('نغير حالة الطلب عند طلب غير مكتمل')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning4-outline-check" value="604"  @php if(in_array(604, $permissions)) echo "checked"; @endphp >
                                                    <label class="form-check-label" for="warning4-outline-check">{{translate('نغير حالة الطلب عند طلب مرفوض')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning4-outline-check" value="605"  @php if(in_array(605, $permissions)) echo "checked"; @endphp >
                                                    <label class="form-check-label" for="warning4-outline-check">{{translate('اعتماد الطلبات')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning4-outline-check" value="800"  @php if(in_array(800, $permissions)) echo "checked"; @endphp >
                                                    <label class="form-check-label" for="warning4-outline-check">{{translate('عرض الطلبات المعتمدة')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning4-outline-check" value="260"  @php if(in_array(260, $permissions)) echo "checked"; @endphp >
                                                    <label class="form-check-label" for="warning4-outline-check">{{translate('تعزيز الطلب')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning4-outline-check" value="600" @php if(in_array(600, $permissions)) echo "checked"; @endphp >
                                                    <label class="form-check-label" for="warning4-outline-check">{{translate('طلبات العلاقات الخارجية')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning4-outline-check" value="601"  @php if(in_array(601, $permissions)) echo "checked"; @endphp>
                                                    <label class="form-check-label" for="warning4-outline-check">{{translate('طلبات الموارد البشرية')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning4-outline-check" value="602" @php if(in_array(602, $permissions)) echo "checked"; @endphp >
                                                    <label class="form-check-label" for="warning4-outline-check">{{translate('طلبات المبيعات ')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning4-outline-check" value="603" @php if(in_array(603, $permissions)) echo "checked"; @endphp >
                                                    <label class="form-check-label" for="warning4-outline-check">{{translate('طلبات التسويق')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning4-outline-check" value="704" @php if(in_array(704, $permissions)) echo "checked"; @endphp >
                                                    <label class="form-check-label" for="warning4-outline-check">{{translate('طلبات تقنية المعلومات')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning4-outline-check" value="705"  @php if(in_array(705, $permissions)) echo "checked"; @endphp>
                                                    <label class="form-check-label" for="warning4-outline-check">{{translate('طلبات قسم المالية ')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning4-outline-check" value="606" @php if(in_array(606, $permissions)) echo "checked"; @endphp >
                                                    <label class="form-check-label" for="warning4-outline-check">{{translate('طلبات رئيس مجلس الادارة  ')}}</label>
                                                </div>
{{--                                                <div class="form-check form-check-inline">--}}
{{--                                                    <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning4-outline-check" value="607" @php if(in_array(607, $permissions)) echo "checked"; @endphp >--}}
{{--                                                    <label class="form-check-label" for="warning4-outline-check">{{translate('طلبات عامة')}}</label>--}}
{{--                                                </div>--}}
{{--                                                <div class="form-check form-check-inline">--}}
{{--                                                    <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning4-outline-check" value="608" @php if(in_array(608, $permissions)) echo "checked"; @endphp >--}}
{{--                                                    <label class="form-check-label" for="warning4-outline-check">{{translate('طلباتي الخاصة')}}</label>--}}
{{--                                                </div>--}}
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning4-outline-check" value="609" @php if(in_array(609, $permissions)) echo "checked"; @endphp>
                                                    <label class="form-check-label" for="warning4-outline-check">{{translate(' عرض جميع الطلبات الاخرى')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning4-outline-check" value="610" @php if(in_array(610, $permissions)) echo "checked"; @endphp >
                                                    <label class="form-check-label" for="warning4-outline-check">{{translate(' تحويل الي قسم')}}</label>
                                                </div>

                                            </div>
                                        </div> <!--===========row py-2 end==========-->

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

                    <!--=====================ادارة طلبات الخارجية=====================-->
{{--                    <div class="row">--}}
{{--                        <div class="d-flex align-items-stretch">--}}
{{--                            <div class="card w-100">--}}
{{--                                <div class="card-header bg-warning">--}}
{{--                                    <h4 class="mb-0 text-white">{{translate('ادارة طلبات الخارجية')}}</h4></div>--}}
{{--                                <div class="card-body">--}}

{{--                                    <div class="mb-2 bt-switch">--}}


{{--                                        <div class="row py-2">--}}
{{--                                            <div class="col-md-4 col-xl-3">--}}
{{--                                                <span class="fs-3 ">{{translate('طلبات الخارجية')}}</span>--}}
{{--                                            </div>--}}
{{--                                            <div class="col-md-8 col-xl-9">--}}
{{--                                                <div class="form-check form-check-inline">--}}
{{--                                                    <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning-outline-check" value="217"  >--}}
{{--                                                    <label class="form-check-label" for="warning-outline-check">{{translate('اضافة')}}</label>--}}
{{--                                                </div>--}}
{{--                                                <div class="form-check form-check-inline">--}}
{{--                                                    <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning-outline-check" value="218"  >--}}
{{--                                                    <label class="form-check-label" for="warning-outline-check">{{translate('عرض')}}</label>--}}
{{--                                                </div>--}}
{{--                                                <div class="form-check form-check-inline">--}}
{{--                                                    <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning-outline-check" value="219"  >--}}
{{--                                                    <label class="form-check-label" for="warning-outline-check">{{translate('عرض جميع الطلبات')}}</label>--}}
{{--                                                </div>--}}
{{--                                                <div class="form-check form-check-inline">--}}
{{--                                                    <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning-outline-check" value="220"  >--}}
{{--                                                    <label class="form-check-label" for="warning-outline-check">{{translate('تعديل')}}</label>--}}
{{--                                                </div>--}}
{{--                                                <div class="form-check form-check-inline">--}}
{{--                                                    <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning2-outline-check" value="221"  >--}}
{{--                                                    <label class="form-check-label" for="warning2-outline-check">{{translate('تغير حالة الطلب')}}</label>--}}
{{--                                                </div>--}}

{{--                                                <div class="form-check form-check-inline">--}}
{{--                                                    <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning4-outline-check" value="222"   >--}}
{{--                                                    <label class="form-check-label" for="warning4-outline-check">{{translate('تفاصيل الطلب')}}</label>--}}
{{--                                                </div>--}}
{{--                                                <div class="form-check form-check-inline">--}}
{{--                                                    <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning4-outline-check" value="237"   >--}}
{{--                                                    <label class="form-check-label" for="warning4-outline-check">{{translate('مسح الطلب')}}</label>--}}
{{--                                                </div>--}}
{{--                                                --}}{{--                                                        <div class="form-check form-check-inline">--}}
{{--                                                --}}{{--                                                            <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning4-outline-check" value="239"   >--}}
{{--                                                --}}{{--                                                            <label class="form-check-label" for="warning4-outline-check">{{translate('قفل مراجعة الطلبات')}}</label>--}}
{{--                                                --}}{{--                                                        </div>--}}
{{--                                                <div class="form-check form-check-inline">--}}
{{--                                                    <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning4-outline-check" value="240"   >--}}
{{--                                                    <label class="form-check-label" for="warning4-outline-check">{{translate('فلترة جميع المسوقات')}}</label>--}}
{{--                                                </div>--}}
{{--                                                <div class="form-check form-check-inline">--}}
{{--                                                    <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning4-outline-check" value="239"   >--}}
{{--                                                    <label class="form-check-label" for="warning4-outline-check">{{translate('نغير حالة الطلب عند قيد المراجعه')}}</label>--}}
{{--                                                </div>--}}
{{--                                                <div class="form-check form-check-inline">--}}
{{--                                                    <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning4-outline-check" value="241"  >--}}
{{--                                                    <label class="form-check-label" for="warning4-outline-check">{{translate("نغير حالة الطلب عند تحت الاجراء")}}</label>--}}
{{--                                                </div>--}}
{{--                                                <div class="form-check form-check-inline">--}}
{{--                                                    <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning4-outline-check" value="242" >--}}
{{--                                                    <label class="form-check-label" for="warning4-outline-check">{{translate('نغير حالة الطلب عند تم السداد')}}</label>--}}
{{--                                                </div>--}}
{{--                                                <div class="form-check form-check-inline">--}}
{{--                                                    <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning4-outline-check" value="243"  >--}}
{{--                                                    <label class="form-check-label" for="warning4-outline-check">{{translate('نغير حالة الطلب عند طلب غير مكتمل')}}</label>--}}
{{--                                                </div>--}}

{{--                                            </div>--}}
{{--                                        </div>--}}

{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                    <!--=====================نهاية طلبات الخارجية=====================-->

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
                                                    <input class="form-check-input warning check-outline outline-warning"  type="checkbox"  name="permissions[]"  id="warning-outline-check" value="54"  @php if(in_array(54, $permissions)) echo "checked"; @endphp>
                                                    <label class="form-check-label" for="warning-outline-check">{{translate('عرض الطلب')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning"  type="checkbox"  name="permissions[]"  id="warning2-outline-check" value="55"  @php if(in_array(55, $permissions)) echo "checked"; @endphp>
                                                    <label class="form-check-label" for="warning2-outline-check">{{translate('اضافة')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning"  type="checkbox"  name="permissions[]"  id="warning3-outline-check" value="56"  @php if(in_array(56, $permissions)) echo "checked"; @endphp>
                                                    <label class="form-check-label" for="warning3-outline-check">{{translate('مسح')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning"  type="checkbox"  name="permissions[]"  id="warning4-outline-check" value="57"  @php if(in_array(57, $permissions)) echo "checked"; @endphp>
                                                    <label class="form-check-label" for="warning4-outline-check">{{translate('عرض')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning"  type="checkbox"  name="permissions[]"  id="warning4-outline-check" value="128"   @php if(in_array(128, $permissions)) echo "checked"; @endphp >
                                                    <label class="form-check-label" for="warning4-outline-check">{{translate('جميع الطلبات')}}</label>
                                                </div>


                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning4-outline-check" value="172"  @php if(in_array(172, $permissions)) echo "checked"; @endphp  >
                                                    <label class="form-check-label" for="warning4-outline-check">{{translate('تحديث حالة مرحلة الاجراءات')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning4-outline-check" value="58"   @php if(in_array(58, $permissions)) echo "checked"; @endphp >
                                                    <label class="form-check-label" for="warning4-outline-check">{{translate('تحديث حالة التعاقد')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning"  type="checkbox"  name="permissions[]"  id="warning4-outline-check" value="59"  @php if(in_array(59, $permissions)) echo "checked"; @endphp>
                                                    <label class="form-check-label" for="warning4-outline-check">{{translate('تغير خدمة العملاء')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning"  type="checkbox"  name="permissions[]"  id="warning4-outline-check" value="60"  @php if(in_array(60, $permissions)) echo "checked"; @endphp>
                                                    <label class="form-check-label" for="warning4-outline-check">{{translate('تغير السيرة الذاتيه')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning"  type="checkbox"  name="permissions[]"  id="warning4-outline-check" value="199"  @php if(in_array(199, $permissions)) echo "checked"; @endphp>
                                                    <label class="form-check-label" for="warning4-outline-check">{{translate('الاضافة بواسطة')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning"  type="checkbox"  name="permissions[]"  id="warning4-outline-check" value="200"  @php if(in_array(200, $permissions)) echo "checked"; @endphp>
                                                    <label class="form-check-label" for="warning4-outline-check">{{translate('هاتف العميل')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning2-outline-check" value="232" @php if(in_array(232, $permissions)) echo "checked"; @endphp  >
                                                    <label class="form-check-label" for="warning2-outline-check">{{translate('عرض  العقد')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning2-outline-check" value="234"  @php if(in_array(234, $permissions)) echo "checked"; @endphp>
                                                    <label class="form-check-label" for="warning2-outline-check">{{translate('ارسال رساله للعميل')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning2-outline-check" value="235"  @php if(in_array(235, $permissions)) echo "checked"; @endphp>
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
                                                    <input class="form-check-input warning check-outline outline-warning"  type="checkbox"  name="permissions[]"  id="warning3-outline-check" value="61"  @php if(in_array(61, $permissions)) echo "checked"; @endphp >
                                                    <label class="form-check-label" for="warning3-outline-check">{{translate('ارجاع الاتاحه')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning"  type="checkbox"  name="permissions[]"  id="warning4-outline-check" value="62" @php if(in_array(62, $permissions)) echo "checked"; @endphp>
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
                                                    <input class="form-check-input warning check-outline outline-warning"  type="checkbox"  name="permissions[]"  id="warning-outline-check" value="63" @php if(in_array(63, $permissions)) echo "checked"; @endphp>
                                                    <label class="form-check-label" for="warning-outline-check">{{translate('معاينة الطلب')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning"  type="checkbox"  name="permissions[]"  id="warning2-outline-check" value="64" @php if(in_array(64, $permissions)) echo "checked"; @endphp>
                                                    <label class="form-check-label" for="warning2-outline-check">{{translate('الرد على العميل')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning"  type="checkbox"  name="permissions[]"  id="warning3-outline-check" value="65" @php if(in_array(65, $permissions)) echo "checked"; @endphp>
                                                    <label class="form-check-label" for="warning3-outline-check">{{translate('مسح')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning"  type="checkbox"  name="permissions[]"  id="warning4-outline-check" value="66" @php if(in_array(66, $permissions)) echo "checked"; @endphp>
                                                    <label class="form-check-label" for="warning4-outline-check">{{translate('عرض')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning"  type="checkbox"  name="permissions[]"  id="warning4-outline-check" value="67" @php if(in_array(67, $permissions)) echo "checked"; @endphp>
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
                                                    <input class="form-check-input warning check-outline outline-warning"  type="checkbox"  name="permissions[]"  id="warning3-outline-check" value="138"  @php if(in_array(138, $permissions)) echo "checked"; @endphp >
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
                                                    <input class="form-check-input warning check-outline outline-warning"  type="checkbox"  name="permissions[]"  id="warning-outline-check" value="139" @php if(in_array(139, $permissions)) echo "checked"; @endphp  >
                                                    <label class="form-check-label" for="warning-outline-check">{{translate('مشاهدة الشكوى')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning"  type="checkbox"  name="permissions[]"  id="warning-outline-check" value="140" @php if(in_array(140, $permissions)) echo "checked"; @endphp >
                                                    <label class="form-check-label" for="warning-outline-check">{{translate('جميع الشكوى')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning"  type="checkbox"  name="permissions[]"  id="warning-outline-check" value="141"  @php if(in_array(141, $permissions)) echo "checked"; @endphp >
                                                    <label class="form-check-label" for="warning-outline-check">{{translate('ارسال رسالة نصية')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning"  type="checkbox"  name="permissions[]"  id="warning2-outline-check" value="142" @php if(in_array(142, $permissions)) echo "checked"; @endphp >
                                                    <label class="form-check-label" for="warning2-outline-check">{{translate('عرض')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning"  type="checkbox"  name="permissions[]"  id="warning2-outline-check" value="143" @php if(in_array(143, $permissions)) echo "checked"; @endphp >
                                                    <label class="form-check-label" for="warning2-outline-check">{{translate('اضافة')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning"  type="checkbox"  name="permissions[]"  id="warning3-outline-check" value="144" @php if(in_array(144, $permissions)) echo "checked"; @endphp >
                                                    <label class="form-check-label" for="warning3-outline-check">{{translate('تغير الحالة')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning"  type="checkbox"  name="permissions[]"  id="warning4-outline-check" value="145" @php if(in_array(145, $permissions)) echo "checked"; @endphp >
                                                    <label class="form-check-label" for="warning4-outline-check">{{translate('حذف')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning"  type="checkbox"  name="permissions[]"  id="warning4-outline-check" value="146" @php if(in_array(146, $permissions)) echo "checked"; @endphp  >
                                                    <label class="form-check-label" for="warning4-outline-check">{{translate('تحويل الشكوى')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning4-outline-check" value="1001" @php if(in_array(1001, $permissions)) echo "checked"; @endphp  >
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
                                                    <input class="form-check-input warning check-outline outline-warning"  type="checkbox"  name="permissions[]"  id="warning-outline-check" value="68" @php if(in_array(68, $permissions)) echo "checked"; @endphp>
                                                    <label class="form-check-label" for="warning-outline-check">{{translate('مشاهدة العقد')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning"  type="checkbox"  name="permissions[]"  id="warning-outline-check" value="129"  @php if(in_array(129, $permissions)) echo "checked"; @endphp >
                                                    <label class="form-check-label" for="warning-outline-check">{{translate('جميع العقود')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning"  type="checkbox"  name="permissions[]"  id="warning-outline-check" value="69" @php if(in_array(69, $permissions)) echo "checked"; @endphp>
                                                    <label class="form-check-label" for="warning-outline-check">{{translate('تعديل')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning"  type="checkbox"  name="permissions[]"  id="warning2-outline-check" value="70" @php if(in_array(70, $permissions)) echo "checked"; @endphp>
                                                    <label class="form-check-label" for="warning2-outline-check">{{translate('اضافة')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning"  type="checkbox"  name="permissions[]"  id="warning3-outline-check" value="71" @php if(in_array(71, $permissions)) echo "checked"; @endphp>
                                                    <label class="form-check-label" for="warning3-outline-check">{{translate('ملاحظه')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning"  type="checkbox"  name="permissions[]"  id="warning4-outline-check" value="72" @php if(in_array(72, $permissions)) echo "checked"; @endphp>
                                                    <label class="form-check-label" for="warning4-outline-check">{{translate('عرض')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning"  type="checkbox"  name="permissions[]"  id="warning4-outline-check" value="73" @php if(in_array(73, $permissions)) echo "checked"; @endphp>
                                                    <label class="form-check-label" for="warning4-outline-check">{{translate('تحديث الحالة')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning2-outline-check" value="158" @php if(in_array(158, $permissions)) echo "checked"; @endphp >
                                                    <label class="form-check-label" for="warning2-outline-check">{{translate('ادخال العقود')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning2-outline-check" value="163" @php if(in_array(163, $permissions)) echo "checked"; @endphp >
                                                    <label class="form-check-label" for="warning2-outline-check">{{translate('مرتجع')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning2-outline-check" value="224" @php if(in_array(224, $permissions)) echo "checked"; @endphp >
                                                    <label class="form-check-label" for="warning2-outline-check">{{translate('طلب الاستقدام')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning2-outline-check" value="233" @php if(in_array(233, $permissions)) echo "checked"; @endphp   >
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
                                                    <input class="form-check-input warning check-outline outline-warning"  type="checkbox"  name="permissions[]"  id="warning2-outline-check" value="118" @php if(in_array(118, $permissions)) echo "checked"; @endphp >
                                                    <label class="form-check-label" for="warning2-outline-check">{{translate('مشاهدة العقد')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning"  type="checkbox"  name="permissions[]"  id="warning-outline-check" value="130"  @php if(in_array(130, $permissions)) echo "checked"; @endphp >
                                                    <label class="form-check-label" for="warning-outline-check">{{translate('جميع العقود')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning"  type="checkbox"  name="permissions[]"  id="warning3-outline-check" value="74" @php if(in_array(74, $permissions)) echo "checked"; @endphp>
                                                    <label class="form-check-label" for="warning3-outline-check">{{translate('اعتماد')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning"  type="checkbox"  name="permissions[]"  id="warning4-outline-check" value="75" @php if(in_array(75, $permissions)) echo "checked"; @endphp>
                                                    <label class="form-check-label" for="warning4-outline-check">{{translate('حذف')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning"  type="checkbox"  name="permissions[]"  id="warning4-outline-check" value="76" @php if(in_array(76, $permissions)) echo "checked"; @endphp >
                                                    <label class="form-check-label" for="warning4-outline-check">{{translate('عرض')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning2-outline-check" value="164" @php if(in_array(164, $permissions)) echo "checked"; @endphp >
                                                    <label class="form-check-label" for="warning2-outline-check">{{translate('مرتجع')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning2-outline-check" value="225" @php if(in_array(225, $permissions)) echo "checked"; @endphp >
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
                                                    <input class="form-check-input warning check-outline outline-warning"  type="checkbox"  name="permissions[]"  id="warning2-outline-check" value="119" @php if(in_array(119, $permissions)) echo "checked"; @endphp >
                                                    <label class="form-check-label" for="warning2-outline-check">{{translate('مشاهدة العقد')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning"  type="checkbox"  name="permissions[]"  id="warning-outline-check" value="131"  @php if(in_array(131, $permissions)) echo "checked"; @endphp >
                                                    <label class="form-check-label" for="warning-outline-check">{{translate('جميع العقود')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning"  type="checkbox"  name="permissions[]"  id="warning-outline-check" value="77" @php if(in_array(77, $permissions)) echo "checked"; @endphp>
                                                    <label class="form-check-label" for="warning-outline-check">{{translate('الانتقال الى مساند')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning"  type="checkbox"  name="permissions[]"  id="warning2-outline-check" value="78" @php if(in_array(78, $permissions)) echo "checked"; @endphp >
                                                    <label class="form-check-label" for="warning2-outline-check">{{translate('العودة اللى اعتماد العقود')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning"  type="checkbox"  name="permissions[]"  id="warning4-outline-check" value="79" @php if(in_array(79, $permissions)) echo "checked"; @endphp>
                                                    <label class="form-check-label" for="warning4-outline-check">{{translate('عرض')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning2-outline-check" value="165" @php if(in_array(165, $permissions)) echo "checked"; @endphp >
                                                    <label class="form-check-label" for="warning2-outline-check">{{translate('مرتجع')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning2-outline-check" value="226" @php if(in_array(226, $permissions)) echo "checked"; @endphp >
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
                                                    <input class="form-check-input warning check-outline outline-warning"  type="checkbox"  name="permissions[]"  id="warning2-outline-check" value="120" @php if(in_array(120, $permissions)) echo "checked"; @endphp >
                                                    <label class="form-check-label" for="warning2-outline-check">{{translate('مشاهدة العقد')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning"  type="checkbox"  name="permissions[]"  id="warning-outline-check" value="132"  @php if(in_array(132, $permissions)) echo "checked"; @endphp >
                                                    <label class="form-check-label" for="warning-outline-check">{{translate('جميع العقود')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning"  type="checkbox"  name="permissions[]"  id="warning-outline-check" value="80" @php if(in_array(80, $permissions)) echo "checked"; @endphp>
                                                    <label class="form-check-label" for="warning-outline-check">{{translate('التفويض الألكترونى')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning"  type="checkbox"  name="permissions[]"  id="warning2-outline-check" value="81" @php if(in_array(81, $permissions)) echo "checked"; @endphp>
                                                    <label class="form-check-label" for="warning2-outline-check">{{translate('العودة اللى العقود الجديدة')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning"  type="checkbox"  name="permissions[]"  id="warning4-outline-check" value="82" @php if(in_array(82, $permissions)) echo "checked"; @endphp>
                                                    <label class="form-check-label" for="warning4-outline-check">{{translate('عرض')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning"  type="checkbox"  name="permissions[]"  id="warning4-outline-check" value="166" @php if(in_array(166, $permissions)) echo "checked"; @endphp>
                                                    <label class="form-check-label" for="warning4-outline-check">{{translate('مرتجع')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning2-outline-check" value="227" @php if(in_array(227, $permissions)) echo "checked"; @endphp >
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
                                                    <input class="form-check-input warning check-outline outline-warning"  type="checkbox"  name="permissions[]"  id="warning2-outline-check" value="121" @php if(in_array(121, $permissions)) echo "checked"; @endphp >
                                                    <label class="form-check-label" for="warning2-outline-check">{{translate('مشاهدة العقد')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning"  type="checkbox"  name="permissions[]"  id="warning-outline-check" value="133"  @php if(in_array(133, $permissions)) echo "checked"; @endphp >
                                                    <label class="form-check-label" for="warning-outline-check">{{translate('جميع العقود')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning"  type="checkbox"  name="permissions[]"  id="warning-outline-check" value="83" @php if(in_array(83, $permissions)) echo "checked"; @endphp>
                                                    <label class="form-check-label" for="warning-outline-check">{{translate('التفييز')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning"  type="checkbox"  name="permissions[]"  id="warning2-outline-check" value="84" @php if(in_array(84, $permissions)) echo "checked"; @endphp>
                                                    <label class="form-check-label" for="warning2-outline-check">{{translate('الرجوع لتفويض')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning"  type="checkbox"  name="permissions[]"  id="warning4-outline-check" value="85" @php if(in_array(85, $permissions)) echo "checked"; @endphp>
                                                    <label class="form-check-label" for="warning4-outline-check">{{translate('عرض')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning"  type="checkbox"  name="permissions[]"  id="warning4-outline-check" value="167" @php if(in_array(167, $permissions)) echo "checked"; @endphp>
                                                    <label class="form-check-label" for="warning4-outline-check">{{translate('مرتجع')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning2-outline-check" value="225" @php if(in_array(228, $permissions)) echo "checked"; @endphp >
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
                                                    <input class="form-check-input warning check-outline outline-warning"  type="checkbox"  name="permissions[]"  id="warning2-outline-check" value="122" @php if(in_array(122, $permissions)) echo "checked"; @endphp >
                                                    <label class="form-check-label" for="warning2-outline-check">{{translate('مشاهدة العقد')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning"  type="checkbox"  name="permissions[]"  id="warning-outline-check" value="134"  @php if(in_array(134, $permissions)) echo "checked"; @endphp >
                                                    <label class="form-check-label" for="warning-outline-check">{{translate('جميع العقود')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning"  type="checkbox"  name="permissions[]"  id="warning-outline-check" value="86" @php if(in_array(86, $permissions)) echo "checked"; @endphp>
                                                    <label class="form-check-label" for="warning-outline-check">{{translate('التذكرة')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning"  type="checkbox"  name="permissions[]"  id="warning2-outline-check" value="87" @php if(in_array(87, $permissions)) echo "checked"; @endphp>
                                                    <label class="form-check-label" for="warning2-outline-check">{{translate('الرجوع لتفويض')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning"  type="checkbox"  name="permissions[]"  id="warning4-outline-check" value="88" @php if(in_array(88, $permissions)) echo "checked"; @endphp>
                                                    <label class="form-check-label" for="warning4-outline-check">{{translate('عرض')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning"  type="checkbox"  name="permissions[]"  id="warning4-outline-check" value="168" @php if(in_array(168, $permissions)) echo "checked"; @endphp>
                                                    <label class="form-check-label" for="warning4-outline-check">{{translate('مرتجع')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning2-outline-check" value="229" @php if(in_array(229, $permissions)) echo "checked"; @endphp >
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
                                                    <input class="form-check-input warning check-outline outline-warning"  type="checkbox"  name="permissions[]"  id="warning2-outline-check" value="123" @php if(in_array(123, $permissions)) echo "checked"; @endphp >
                                                    <label class="form-check-label" for="warning2-outline-check">{{translate('مشاهدة العقد')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning"  type="checkbox"  name="permissions[]"  id="warning-outline-check" value="135"  @php if(in_array(135, $permissions)) echo "checked"; @endphp >
                                                    <label class="form-check-label" for="warning-outline-check">{{translate('جميع العقود')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning"  type="checkbox"  name="permissions[]"  id="warning-outline-check" value="89" @php if(in_array(89, $permissions)) echo "checked"; @endphp>
                                                    <label class="form-check-label" for="warning-outline-check">{{translate('تم الوصول')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning"  type="checkbox"  name="permissions[]"  id="warning2-outline-check" value="90" @php if(in_array(90, $permissions)) echo "checked"; @endphp>
                                                    <label class="form-check-label" for="warning2-outline-check">{{translate('الرجوع لتفييز')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning"  type="checkbox"  name="permissions[]"  id="warning4-outline-check" value="91" @php if(in_array(91, $permissions)) echo "checked"; @endphp>
                                                    <label class="form-check-label" for="warning4-outline-check">{{translate('عرض')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning"  type="checkbox"  name="permissions[]"  id="warning4-outline-check" value="169" @php if(in_array(169, $permissions)) echo "checked"; @endphp>
                                                    <label class="form-check-label" for="warning4-outline-check">{{translate('مرتجع')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning2-outline-check" value="230" @php if(in_array(230, $permissions)) echo "checked"; @endphp >
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
                                                    <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning-outline-check" value="180" @php if(in_array(180, $permissions)) echo "checked"; @endphp  >
                                                    <label class="form-check-label" for="warning-outline-check">{{translate('مشاهدة العقد')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning-outline-check" value="181"  @php if(in_array(181, $permissions)) echo "checked"; @endphp >
                                                    <label class="form-check-label" for="warning-outline-check">{{translate('جميع العقود')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning-outline-check" value="182" @php if(in_array(182, $permissions)) echo "checked"; @endphp  >
                                                    <label class="form-check-label" for="warning-outline-check">{{translate('تعديل')}}</label>
                                                </div>
                                                {{--                                                <div class="form-check form-check-inline">--}}
                                                {{--                                                    <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning-outline-check" value="183"  @php if(in_array(183, $permissions)) echo "checked"; @endphp >--}}
                                                {{--                                                    <label class="form-check-label" for="warning-outline-check">{{translate('تحت الضمان')}}</label>--}}
                                                {{--                                                </div>--}}
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning2-outline-check" value="184" @php if(in_array(184, $permissions)) echo "checked"; @endphp  >
                                                    <label class="form-check-label" for="warning2-outline-check">{{translate('الرجوع لتذكره')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning4-outline-check" value="185"  @php if(in_array(185, $permissions)) echo "checked"; @endphp >
                                                    <label class="form-check-label" for="warning4-outline-check">{{translate('عرض')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning2-outline-check" value="186" @php if(in_array(186, $permissions)) echo "checked"; @endphp  >
                                                    <label class="form-check-label" for="warning2-outline-check">{{translate('مرتجع')}}</label>
                                                </div>

                                            </div>
                                        </div>
                                        {{--                                        <div class="row py-2">--}}
                                        {{--                                            <div class="col-md-4 col-xl-3">--}}
                                        {{--                                                <span class="fs-3 ">{{translate('تحت الضمان')}}</span>--}}
                                        {{--                                            </div>--}}
                                        {{--                                            <div class="col-md-8 col-xl-9">--}}
                                        {{--                                                <div class="form-check form-check-inline">--}}
                                        {{--                                                    <input class="form-check-input warning check-outline outline-warning"  type="checkbox"  name="permissions[]"  id="warning2-outline-check" value="124" @php if(in_array(124, $permissions)) echo "checked"; @endphp >--}}
                                        {{--                                                    <label class="form-check-label" for="warning2-outline-check">{{translate('مشاهدة العقد')}}</label>--}}
                                        {{--                                                </div>--}}
                                        {{--                                                <div class="form-check form-check-inline">--}}
                                        {{--                                                    <input class="form-check-input warning check-outline outline-warning"  type="checkbox"  name="permissions[]"  id="warning-outline-check" value="136"  @php if(in_array(136, $permissions)) echo "checked"; @endphp >--}}
                                        {{--                                                    <label class="form-check-label" for="warning-outline-check">{{translate('جميع العقود')}}</label>--}}
                                        {{--                                                </div>--}}
                                        {{--                                                <div class="form-check form-check-inline">--}}
                                        {{--                                                    <input class="form-check-input warning check-outline outline-warning"  type="checkbox"  name="permissions[]"  id="warning2-outline-check" value="92" @php if(in_array(92, $permissions)) echo "checked"; @endphp >--}}
                                        {{--                                                    <label class="form-check-label" for="warning2-outline-check">{{translate('الرجوع لتذكرة')}}</label>--}}
                                        {{--                                                </div>--}}
                                        {{--                                                <div class="form-check form-check-inline">--}}
                                        {{--                                                    <input class="form-check-input warning check-outline outline-warning"  type="checkbox"  name="permissions[]"  id="warning4-outline-check" value="93" @php if(in_array(93, $permissions)) echo "checked"; @endphp>--}}
                                        {{--                                                    <label class="form-check-label" for="warning4-outline-check">{{translate('عرض')}}</label>--}}
                                        {{--                                                </div>--}}
                                        {{--                                                <div class="form-check form-check-inline">--}}
                                        {{--                                                    <input class="form-check-input warning check-outline outline-warning"  type="checkbox"  name="permissions[]"  id="warning4-outline-check" value="170" @php if(in_array(170, $permissions)) echo "checked"; @endphp>--}}
                                        {{--                                                    <label class="form-check-label" for="warning4-outline-check">{{translate('مرتجع')}}</label>--}}
                                        {{--                                                </div>--}}

                                        {{--                                            </div>--}}
                                        {{--                                        </div>--}}
                                        <div class="row py-2">
                                            <div class="col-md-4 col-xl-3">
                                                <span class="fs-3 ">{{translate('مرتجع')}}</span>
                                            </div>
                                            <div class="col-md-8 col-xl-9">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning4-outline-check" value="171"   @php if(in_array(171, $permissions)) echo "checked"; @endphp >
                                                    <label class="form-check-label" for="warning4-outline-check">{{translate('عرض')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning4-outline-check" value="344"   @php if(in_array(344, $permissions)) echo "checked"; @endphp >
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
                                                    <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning-outline-check" value="194" @php if(in_array(194, $permissions)) echo "checked"; @endphp  >
                                                    <label class="form-check-label" for="warning-outline-check">{{translate('مشاهدة العقد')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning-outline-check" value="195"  @php if(in_array(195, $permissions)) echo "checked"; @endphp >
                                                    <label class="form-check-label" for="warning-outline-check">{{translate('جميع العقود')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning-outline-check" value="196" @php if(in_array(196, $permissions)) echo "checked"; @endphp  >
                                                    <label class="form-check-label" for="warning-outline-check">{{translate('تعديل')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning4-outline-check" value="197"  @php if(in_array(197, $permissions)) echo "checked"; @endphp >
                                                    <label class="form-check-label" for="warning4-outline-check">{{translate('عرض')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning2-outline-check" value="198" @php if(in_array(198, $permissions)) echo "checked"; @endphp  >
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
                                                    <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning-outline-check" value="281"  @php if(in_array(281, $permissions)) echo "checked"; @endphp >
                                                    <label class="form-check-label" for="warning-outline-check">{{translate('تعديل')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning2-outline-check" value="282" @php if(in_array(282, $permissions)) echo "checked"; @endphp >
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
                                                    <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning-outline-check" value="283" @php if(in_array(283, $permissions)) echo "checked"; @endphp >
                                                    <label class="form-check-label" for="warning-outline-check">{{translate('تعديل')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning2-outline-check" value="284" @php if(in_array(284, $permissions)) echo "checked"; @endphp >
                                                    <label class="form-check-label" for="warning2-outline-check">{{translate('عرض العقد')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning3-outline-check" value="285"  @php if(in_array(285, $permissions)) echo "checked"; @endphp >
                                                    <label class="form-check-label" for="warning3-outline-check">{{translate('مسح')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning4-outline-check" value="286"  @php if(in_array(286, $permissions)) echo "checked"; @endphp >
                                                    <label class="form-check-label" for="warning4-outline-check">{{translate('عرض الجميع')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning4-outline-check" value="288"  @php if(in_array(288, $permissions)) echo "checked"; @endphp >
                                                    <label class="form-check-label" for="warning4-outline-check">{{translate('اغلاق حالة العقد')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning4-outline-check" value="289"  @php if(in_array(289, $permissions)) echo "checked"; @endphp >
                                                    <label class="form-check-label" for="warning4-outline-check">{{translate('فتح حالة العقد')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning4-outline-check" value="287"  @php if(in_array(287, $permissions)) echo "checked"; @endphp >
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
                                                    <input class="form-check-input warning check-outline outline-warning"  type="checkbox"  name="permissions[]"  id="warning4-outline-check" value="94" @php if(in_array(94, $permissions)) echo "checked"; @endphp>
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
                                                    <input class="form-check-input warning check-outline outline-warning"  type="checkbox"  name="permissions[]"  id="warning3-outline-check" value="95" @php if(in_array(95, $permissions)) echo "checked"; @endphp>
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
                                                    <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning-outline-check" value="174"  @php if(in_array(174, $permissions)) echo "checked"; @endphp  >
                                                    <label class="form-check-label" for="warning-outline-check">{{translate('تعديل')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning2-outline-check" value="175"  @php if(in_array(175, $permissions)) echo "checked"; @endphp >
                                                    <label class="form-check-label" for="warning2-outline-check">{{translate('اضافة')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning2-outline-check" value="176"   @php if(in_array(176, $permissions)) echo "checked"; @endphp>
                                                    <label class="form-check-label" for="warning2-outline-check">{{translate('مسح')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning4-outline-check" value="177"   @php if(in_array(177, $permissions)) echo "checked"; @endphp>
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
                                                    <input class="form-check-input warning check-outline outline-warning"  type="checkbox"  name="permissions[]"  id="warning4-outline-check" value="96" @php if(in_array(96, $permissions)) echo "checked"; @endphp>
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
                                                    <input class="form-check-input warning check-outline outline-warning"  type="checkbox"  name="permissions[]"  id="warning4-outline-check" value="97" @php if(in_array(97, $permissions)) echo "checked"; @endphp>
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
                                                    <input class="form-check-input warning check-outline outline-warning"  type="checkbox"  name="permissions[]"  id="warning-outline-check" value="98"  @php if(in_array(98, $permissions)) echo "checked"; @endphp>
                                                    <label class="form-check-label" for="warning-outline-check">{{translate('تعديل')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning"  type="checkbox"  name="permissions[]"  id="warning2-outline-check" value="99" @php if(in_array(99, $permissions)) echo "checked"; @endphp>
                                                    <label class="form-check-label" for="warning2-outline-check">{{translate('اضافة')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning"  type="checkbox"  name="permissions[]"  id="warning2-outline-check" value="100"@php if(in_array(100, $permissions)) echo "checked"; @endphp >
                                                    <label class="form-check-label" for="warning2-outline-check">{{translate('مسح')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning"  type="checkbox"  name="permissions[]"  id="warning4-outline-check" value="101" @php if(in_array(101, $permissions)) echo "checked"; @endphp>
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
                                                    <input class="form-check-input warning check-outline outline-warning"  type="checkbox"  name="permissions[]"  id="warning2-outline-check" value="102" @php if(in_array(102, $permissions)) echo "checked"; @endphp >
                                                    <label class="form-check-label" for="warning2-outline-check">{{translate('مسح')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning"  type="checkbox"  name="permissions[]"  id="warning4-outline-check" value="103" @php if(in_array(103, $permissions)) echo "checked"; @endphp>
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
                                                    <input class="form-check-input warning check-outline outline-warning"  type="checkbox"  name="permissions[]"  id="warning-outline-check" value="104" @php if(in_array(104, $permissions)) echo "checked"; @endphp>
                                                    <label class="form-check-label" for="warning-outline-check">{{translate('تعديل')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning"  type="checkbox"  name="permissions[]"  id="warning2-outline-check" value="105" @php if(in_array(105, $permissions)) echo "checked"; @endphp >
                                                    <label class="form-check-label" for="warning2-outline-check">{{translate('اضافة')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning"  type="checkbox"  name="permissions[]"  id="warning2-outline-check" value="106" @php if(in_array(106, $permissions)) echo "checked"; @endphp>
                                                    <label class="form-check-label" for="warning2-outline-check">{{translate('مسح')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning"  type="checkbox"  name="permissions[]"  id="warning4-outline-check" value="107" @php if(in_array(107, $permissions)) echo "checked"; @endphp>
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
                                                    <input class="form-check-input warning check-outline outline-warning"  type="checkbox"  name="permissions[]"  id="warning2-outline-check" value="108" @php if(in_array(108, $permissions)) echo "checked"; @endphp >
                                                    <label class="form-check-label" for="warning2-outline-check">{{translate('مسح')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning"  type="checkbox"  name="permissions[]"  id="warning4-outline-check" value="109"  @php if(in_array(109, $permissions)) echo "checked"; @endphp>
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
                                                    <input class="form-check-input warning check-outline outline-warning"  type="checkbox"  name="permissions[]"  id="warning-outline-check" value="110" @php if(in_array(110, $permissions)) echo "checked"; @endphp>
                                                    <label class="form-check-label" for="warning-outline-check">{{translate('تعديل')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning"  type="checkbox"  name="permissions[]"  id="warning2-outline-check" value="111" @php if(in_array(111, $permissions)) echo "checked"; @endphp >
                                                    <label class="form-check-label" for="warning2-outline-check">{{translate('اضافة')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning"  type="checkbox"  name="permissions[]"  id="warning3-outline-check" value="112" @php if(in_array(112, $permissions)) echo "checked"; @endphp>
                                                    <label class="form-check-label" for="warning3-outline-check">{{translate('مسح')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning"  type="checkbox"  name="permissions[]"  id="warning4-outline-check" value="113" @php if(in_array(113, $permissions)) echo "checked"; @endphp >
                                                    <label class="form-check-label" for="warning4-outline-check">{{translate('عرض')}}</label>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="row py-2">
                                            <div class="col-md-4 col-xl-3">
                                                <span class="fs-3 ">{{translate('اذونات الموظفين')}}</span>
                                            </div>
                                            <div class="col-md-8 col-xl-9">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning"  type="checkbox"  name="permissions[]"  id="warning-outline-check" value="114" @php if(in_array(114, $permissions)) echo "checked"; @endphp>
                                                    <label class="form-check-label" for="warning-outline-check">{{translate('تعديل')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning"  type="checkbox"  name="permissions[]"  id="warning2-outline-check" value="115" @php if(in_array(115, $permissions)) echo "checked"; @endphp>
                                                    <label class="form-check-label" for="warning2-outline-check">{{translate('اضافة')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning"  type="checkbox"  name="permissions[]"  id="warning3-outline-check" value="116" @php if(in_array(116, $permissions)) echo "checked"; @endphp>
                                                    <label class="form-check-label" for="warning3-outline-check">{{translate('مسح')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning"  type="checkbox"  name="permissions[]"  id="warning4-outline-check" value="117" @php if(in_array(117, $permissions)) echo "checked"; @endphp>
                                                    <label class="form-check-label" for="warning4-outline-check">{{translate('عرض')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning4-outline-check" value="187"  @php if(in_array(187, $permissions)) echo "checked"; @endphp >
                                                    <label class="form-check-label" for="warning4-outline-check">{{translate('اختار مسؤل الخارجية')}}</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row py-2">
                                            <div class="col-md-4 col-xl-3">
                                                <span class="fs-3 ">{{translate('تحركات الموظفين')}}</span>
                                            </div>
                                            <div class="col-md-8 col-xl-9">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input warning check-outline outline-warning" name="permissions[]"  type="checkbox" id="warning4-outline-check" value="162" @php if(in_array(162, $permissions)) echo "checked"; @endphp  >
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
                        <button type="submit" class="btn btn-success l px-4">
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
    <script src="{{ static_asset('v4_assets/dist/tagify-master/dist/jQuery.tagify.min.js') }}"></script>
    <script src="{{ static_asset('v4_assets/dist/tagify-master/dist/tagify.polyfills.min.js') }}"></script>
    <link href="{{ static_asset('v4_assets/dist/tagify-master/dist/tagify.css') }}" rel="stylesheet" type="text/css" />

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
        var input = document.querySelector('input[id=c-code]');
        var input2 = document.querySelector('input[id=c-code2]');
        tagify = new Tagify(input);
        tagify = new Tagify(input2);
    </script>
    <script>
        $(".bt-switch input[type='checkbox'], .bt-switch input[type='radio']").bootstrapSwitch();
        var radioswitch = function() {
            var bt = function() {
                $(".radio-switch").on("switch-change", function() {
                    $(".radio-switch").bootstrapSwitch("toggleRadioState")
                }), $(".radio-switch").on("switch-change", function() {
                    $(".radio-switch").bootstrapSwitch("toggleRadioStateAllowUncheck")
                }), $(".radio-switch").on("switch-change", function() {
                    $(".radio-switch").bootstrapSwitch("toggleRadioStateAllowUncheck", !1)
                })
            };
            return {
                init: function() {
                    bt()
                }
            }
        }();
        $(document).ready(function() {
            radioswitch.init()
        });
    </script>

@endsection
