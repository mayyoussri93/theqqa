@extends('backend.layouts.app')

@section('content')
    <div class="page-wrapper">

        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="row page-titles">
            <div class="col-md-5 col-12 align-self-center">
                <h3 class="text-themecolor mb-0">{{translate('اعدادات الحساب')}}</h3>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">{{translate('الصفحة الرئيسية')}}</a></li>
                    <li class="breadcrumb-item active">{{translate('البيانات')}}</li>
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
                <div class="card">

                    <div class="card-body">
                        <form class="form-horizontal form-material" action="{{ route('profile.update', Auth::user()->id) }}" method="POST" enctype="multipart/form-data">
                            <input name="_method" type="hidden" value="PATCH">
                            @csrf
                            <div class="mb-3">
                                <label class="col-md-12">{{translate('الاسم')}}</label>
                                <div class="col-md-12">
                                    <input type="text" class="form-control form-control-line" placeholder="{{translate('الاسم')}}" name="name" value="{{ Auth::user()->name }}" required>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="example-email" class="col-md-12">{{translate('البريد الالكترونى')}}</label>
                                <div class="col-md-12">
                                    <input type="email" placeholder="{{translate('البريد الالكترونى')}}" class="form-control form-control-line"  name="email" value="{{ Auth::user()->email }}" id="example-email">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="col-md-12">{{translate('كلمة المرور')}}</label>
                                <div class="col-md-12">
                                    <input type="password"   name="new_password" class="form-control form-control-line">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="col-md-12" for="confirm_password">{{translate('تاكيد كلمة المرور')}}</label>
                                <div class="col-md-12">
                                    <input type="password" class="form-control" placeholder="{{translate('تاكيد كلمة المرور')}}" name="confirm_password">
                                </div>
                            </div>

                            <div class="mb-3">
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-success">{{translate('Save')}}</button>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
