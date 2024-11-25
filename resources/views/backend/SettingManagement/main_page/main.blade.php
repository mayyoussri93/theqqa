@extends('backend.layouts.app')

@section('content')
    <div class="page-wrapper">

        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="row page-titles">
            <div class="col-sm-4 col-12 align-self-center">
                <h3 class="text-themecolor mb-0">{{translate('اعدادات الصفحة الرئيسية')}}</h3>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{route('website.main')}}">{{translate('الصفحة الرئيسية')}}</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0)">{{translate('الاعدادات')}}</a></li>

                    <li class="breadcrumb-item active">{{translate('اعدادات الصفحة الرئيسية')}}</li>
                </ol>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <!-- -------------------------------------------------------------- -->
        <!-- Container fluid  -->
        <!-- -------------------------------------------------------------- -->

        <div class="container-fluid note-has-grid">
            <ul class="nav nav-pills p-3 bg-white mb-3 rounded-pill align-items-center">
                <li class="nav-item"> <a href="javascript:void(0)" class="nav-link rounded-pill note-link d-flex align-items-center active px-2 px-md-3 mr-0 mr-md-2"  id="all-category">
                        <i data-feather="list" class="feather-sm fill-white me-1"></i><span class="d-none d-md-block">{{translate('الهيدر')}}</span></a>
                </li>
                <li class="nav-item"> <a href="javascript:void(0)" class="nav-link rounded-pill note-link d-flex align-items-center px-2 px-md-3 mr-0 mr-md-2" id="slider">
                        <i data-feather="sliders" class="feather-sm fill-white me-1"></i><span class="d-none d-md-block">{{translate('السلايدر')}}</span></a>
                </li>
                <li class="nav-item"> <a href="javascript:void(0)" class="nav-link rounded-pill note-link d-flex align-items-center px-2 px-md-3 mr-0 mr-md-2" id="who_us">
                        <i data-feather="info" class="feather-sm fill-white me-1"></i><span class="d-none d-md-block">{{translate('من نحن')}}</span></a>
                </li>
                <li class="nav-item"> <a href="javascript:void(0)" class="nav-link rounded-pill note-link d-flex align-items-center px-2 px-md-3 mr-0 mr-md-2" id="our_advantage">
                        <i data-feather="tag" class="feather-sm fill-white me-1"></i><span class="d-none d-md-block">{{translate('اعمالنا')}}</span></a>
                </li>
                <li class="nav-item"> <a href="javascript:void(0)" class="nav-link rounded-pill note-link d-flex align-items-center px-2 px-md-3 mr-0 mr-md-2" id="our_serivce">
                        <i data-feather="rss" class="feather-sm fill-white me-1"></i><span class="d-none d-md-block">{{translate('خدمات ')}}</span></a>
                </li>
                <li class="nav-item "> <a href="javascript:void(0)" class="nav-link rounded-pill note-link d-flex align-items-center px-2 px-md-3 mr-0 mr-md-2" id="our_client">
                        <i data-feather="book-open" class="feather-sm fill-white me-1"></i><span class="d-none d-md-block">{{translate("عملائنا")}}</span></a>
                </li>
                <li class="nav-item "> <a href="javascript:void(0)" class="nav-link rounded-pill note-link d-flex align-items-center px-2 px-md-3 mr-0 mr-md-2" id="footer">
                        <i data-feather="chevrons-down" class="feather-sm fill-white me-1"></i><span class="d-none d-md-block">{{translate('الفوتر')}}</span></a>
                </li>
                <li class="nav-item "> <a href="javascript:void(0)" class="nav-link rounded-pill note-link d-flex align-items-center px-2 px-md-3 mr-0 mr-md-2" id="public">
                        <i data-feather="settings" class="feather-sm fill-white me-1"></i><span class="d-none d-md-block">{{translate('اعدادات عامه')}}</span></a>
                </li>
                <li class="nav-item "> <a href="javascript:void(0)" class="nav-link rounded-pill note-link d-flex align-items-center px-2 px-md-3 mr-0 mr-md-2" id="seo">
                        <i data-feather="sun" class="feather-sm fill-white me-1"></i><span class="d-none d-md-block">{{translate('اعدادات السيو')}}</span></a>
                </li>
            </ul>
            <div class="tab-content">
                <div  id="note-full-container" class="note-has-grid row">
                    <!-- Row -->
                    <div class="row all-category">
                        @include('backend.SettingManagement.main_page.header')
                    </div>
                    <!-- End Row -->
                    <div class="row slider " style="display: none">
                        <div class="col-12">
                            <form class="needs-validation"
                                  action="{{ route('business_settings.update')}}"
                                  method="POST" novalidate>
                                @csrf
                                <div class="card">

                                    <div class="card-body">
                                        <h4 class="card-title">{{translate('السلايدر')}}</h4>
                                        <div class="home-slider-target">
                                            <input type="hidden" name="types[]" value="home_slider_images">
                                            <input type="hidden" name="types[]" value="home_slider_title_link">
                                            <input type="hidden" name="types[]" value="home_slider_link">
                                            <input type="hidden" name="types[]" value="home_slider_title_2_link">
                                            <input type="hidden" name="types[]" value="home_slider_2_link">
                                            <input type="hidden" name="types[]" value="home_slider_title_1">
                                            <input type="hidden" name="types[]" value="home_slider_title_2">

                                            @if (get_setting('home_slider_images') != null)
                                                @foreach (json_decode(get_setting('home_slider_images'), true) as $key => $value)
                                                    <div class="row gutters-5">
                                                        <div class="col-sm-2">
                                                            <div class="form-group">
                                                                <label for="validationCustomUsername">{{translate('الصورة')}}</label>

                                                                <div class="input-group" data-toggle="aizuploader" data-type="image">
                                                                    <div class="input-group-prepend">
                                                                        <div class="input-group-text bg-soft-secondary font-weight-medium">{{translate('تصفح')}}</div>
                                                                    </div>
                                                                    <div class="form-control file-amount">{{translate('اختار الملف')}}</div>
                                                                    <input type="hidden" name="home_slider_images[]" class="selected-files" value="{{ json_decode(get_setting('home_slider_images'), true)[$key] }}">
                                                                </div>
                                                                <div class="file-preview box sm">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="form-group">
                                                                <label for="validationCustomUsername">{{translate('عنوان المفتاح 1')}} <span class="text-danger">*</span></label>
                                                                <input type="text" class="form-control" placeholder="{{translate('Link Title')}}" name="home_slider_title_link[]" required value="{{ json_decode(get_setting('home_slider_title_link'), true)[$key] }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="form-group">
                                                                <label for="validationCustomUsername">{{translate('رابطة المفتاح 1')}} <span class="text-danger">*</span></label>
                                                                <input type="text" class="form-control" placeholder="{{translate('الرابط')}}" name="home_slider_link[]" required value="{{ json_decode(get_setting('home_slider_link'), true)[$key] }}">
                                                            </div>
                                                        </div>


                                                        <div class="col-sm-2">
                                                            <div class="form-group">
                                                                <label for="validationCustomUsername">{{translate('العنوان')}}</label>
                                                                <input type="text" class="form-control" placeholder="{{translate('Title 1')}}" name="home_slider_title_1[]" value="{{ json_decode(get_setting('home_slider_title_1'), true)[$key] }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <div class="form-group">
                                                                <label for="validationCustomUsername">{{translate('الوصف')}}</label>
                                                                <input type="text" class="form-control" placeholder="{{translate('Title 2')}}" name="home_slider_title_2[]" value="{{ json_decode(get_setting('home_slider_title_2'), true)[$key] }}">
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-1">
                                                            <div class="form-group">
                                                                <button data-repeater-delete="" class="btn btn-danger waves-effect waves-light" type="button"  data-toggle="remove-parent" data-parent=".row">
                                                                    <i data-feather="x-circle" class="feather-sm fill-white"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                        <br>

                                        <div class="p-3">
                                            <div class="text-end">
                                                <button
                                                        type="button"
                                                        class="btn btn-primary rounded-pill px-4 waves-effect waves-light"
                                                        data-toggle="add-more"
                                                        data-content='
							<div class="row gutters-5">
								<div class="col-sm-2">
									<div class="form-group">
									      <label for="validationCustomUsername">{{translate('الصورة')}}</label>
										<div class="input-group" data-toggle="aizuploader" data-type="image">
											<div class="input-group-prepend">
												<div class="input-group-text bg-soft-secondary font-weight-medium">{{translate('تصفح')}}</div>
											</div>
											<div class="form-control file-amount">{{translate('اختار الملف')}}</div>
											<input type="hidden" name="home_slider_images[]" class="selected-files">
										</div>
										<div class="file-preview box sm">
										</div>
									</div>
								</div>

							            <div class="col-sm-2">
                                            <div class="form-group">
                                                <label for="validationCustomUsername">{{translate('عنوان المفتاح 1')}} <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" placeholder="{{translate('Link Title')}}" name="home_slider_title_link[]" required >
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                            	<label for="validationCustomUsername">{{translate('رابطة المفتاح 1')}} <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" placeholder="{{translate('الرابطة')}}" name="home_slider_link[]" required>
                                            </div>
                                        </div>


                                          <div class="col-sm-2">
											<div class="form-group">
												<label for="validationCustomUsername">{{translate('العنوان')}}</label>
												<input type="text" class="form-control" placeholder="{{translate('العنوان 1')}}" name="home_slider_title_1[]" >
											</div>
										</div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                            	<label for="validationCustomUsername">{{translate('الوصف')}}</label>
                                                <input type="text" class="form-control" placeholder="{{translate('الوصف')}}" name="home_slider_title_2[]" >
                                            </div>
                                        </div>

								<div class="col-sm-1">
									<div class="form-group">
									     <button data-repeater-delete="" class="btn btn-danger waves-effect waves-light" type="button"  data-toggle="remove-parent" data-parent=".row">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-circle feather-sm fill-white"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>
                                           </button>
									</div>
								</div>

							</div>'
                                                        data-target=".home-slider-target">
                                                    <i data-feather="plus-circle" class="feather-sm ms-2 fill-white"></i>
                                                    {{ translate('اضافة') }}
                                                </button>
                                                <button type="submit" class="btn btn-info rounded-pill px-4 waves-effect waves-light">   {{translate('حفظ')}}</button>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="row who_us " style="display: none">

                        <div class="row">
                            <div class="col-12">
                                <div class="card">

                                    <form class="needs-validation form-horizontal"
                                          action="{{ route('business_settings.update')}}"
                                          method="POST" novalidate>
                                        @csrf
                                        <input type="hidden" name="types[]" value="home_who_images">
                                        <input type="hidden" name="types[]" value="home_who_desc">
                                        <input type="hidden" name="types[]" value="home_who_title1">
                                        <input type="hidden" name="types[]" value="home_who_title2">
                                        <input type="hidden" name="types[]" value="home_who_button_href">
                                        <input type="hidden" name="types[]" value="home_who_button_title">
                                        <input type="hidden" name="types[]" value="home_who_video_link">


                                        <div class="card-body">
                                            <h4 class="card-title">{{translate('من نحن')}}</h4>
                                            <div class="mb-3 row">
                                                <label for="email1" class="col-sm-3 text-end control-label col-form-label">{{translate('الصورة')}}</label>
                                                <div class="col-sm-9">
                                                    <div class="form-group">
                                                        <div class="input-group" data-toggle="aizuploader" data-type="image">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text bg-soft-secondary font-weight-medium">{{translate('تصفح')}}</div>
                                                            </div>
                                                            <div class="form-control file-amount">{{translate('اختار الملف')}}</div>
                                                            <input type="hidden" name="home_who_images" class="selected-files" value="{{ get_setting('home_who_images')}}">
                                                        </div>
                                                        <div class="file-preview box sm">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-sm-3 text-end control-label col-form-label" for="validationCustomUsername">{{translate('العنوان الرئيسى')}}</label>

                                                <div class="col-sm-9">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" placeholder="{{translate('العنوان الرئيسى')}}" name="home_who_title1" value="{{ get_setting('home_who_title1') }}" >
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-sm-3 text-end control-label col-form-label" for="validationCustomUsername">{{translate('العنوان الفرعى')}}</label>

                                                <div class="col-sm-9">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" placeholder="{{translate('العنوان الفرع')}}" name="home_who_title2" value="{{get_setting('home_who_title2') }}" >
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label for="cono1" class="col-sm-3 text-end control-label col-form-label">{{translate('وصف من نحن')}}</label>
                                                <div class="col-sm-9">
                                                    <textarea class="form-control" rows="8" name="home_who_desc" placeholder="{{translate('من نحن')}}" required> {{ get_setting('home_who_desc')}}</textarea>

                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-sm-3 text-end control-label col-form-label" for="validationCustomUsername">{{translate('عنوان الزر')}}</label>

                                                <div class="col-sm-9">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" placeholder="{{translate('نوان الزر')}}" name="home_who_button_title" value="{{ get_setting('home_who_button_title')}}" >
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-sm-3 text-end control-label col-form-label" for="validationCustomUsername">{{translate('توجية الزر')}}}</label>

                                                <div class="col-sm-9">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" placeholder="{{translate('توجية الزر')}}" name="home_who_button_href" value="{{ get_setting('home_who_button_href') }}" >
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-sm-3 text-end control-label col-form-label" for="validationCustomUsername">{{translate('لينك الفديو')}}}</label>

                                                <div class="col-sm-9">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" placeholder="{{translate('لينك الفديو')}}" name="home_who_video_link" value="{{get_setting('home_who_video_link') }}" >
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="p-3 border-top">
                                            <div class="text-end">
                                                <button type="submit" class="btn btn-info rounded-pill px-4 waves-effect waves-light">Save</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="row our_advantage" style="display: none">
                            <div class="col-12">
                                <div class="card">
                                    <form class="needs-validation"
                                          action="{{ route('business_settings.update')}}"
                                          method="POST" novalidate>
                                        @csrf

                                        <div class="card">

                                            <div class="card-body">
                                                <h4 class=" card-title">{{translate('اعمالنا')}}</h4>
                                                <div class="mb-3 row">
                                                    <label class="col-sm-3 text-end control-label col-form-label" for="validationCustomUsername">{{translate('العنوان الرئيسى')}}</label>

                                                    <div class="col-sm-9">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" placeholder="{{translate('العنوان الرئيسى')}}" name="home_our_work_title1" value="{{ get_setting('home_our_work_title1') }}" >
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mb-3 row">
                                                    <label class="col-sm-3 text-end control-label col-form-label" for="validationCustomUsername">{{translate('العنوان الفرعى')}}</label>

                                                    <div class="col-sm-9">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" placeholder="{{translate('العنوان الفرع')}}" name="home_our_work_title2" value="{{ get_setting('home_our_work_title2')}}" >
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="home-banner1-target">
                                                    <input type="hidden" name="types[]" value="home_banner1_images">
                                                    <input type="hidden" name="types[]" value="home_banner1_links">
                                                    <input type="hidden" name="types[]" value="home_banner1_title">
                                                    <input type="hidden" name="types[]" value="home_banner1_dec">
                                                    <input type="hidden" name="types[]" value="home_our_work_title1">
                                                    <input type="hidden" name="types[]" value="home_our_work_title2">


                                                    @if (get_setting('home_banner1_images') != null)
                                                        @foreach (json_decode(get_setting('home_banner1_images'), true) as $key => $value)
                                                            <div class="row gutters-5">
                                                                <div class="col-sm-4">
                                                                    <label for="validationCustomUsername">{{translate('الصورة')}}</label>

                                                                    <div class="form-group">
                                                                        <div class="input-group" data-toggle="aizuploader" data-type="image">
                                                                            <div class="input-group-prepend">
                                                                                <div class="input-group-text bg-soft-secondary font-weight-medium">{{translate('تصفح')}}</div>
                                                                            </div>
                                                                            <div class="form-control file-amount">{{translate('اختار الملف')}}</div>
                                                                            <input type="hidden" name="home_banner1_images[]" class="selected-files" value="{{ json_decode(get_setting('home_banner1_images'), true)[$key] }}">
                                                                        </div>
                                                                        <div class="file-preview box sm">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-2">
                                                                    <div class="form-group">
                                                                        <label for="validationCustomUsername">{{translate('العنوان')}}</label>
                                                                        <input type="text" class="form-control" placeholder="{{translate('Title 1')}}" name="home_banner1_title[]" value="{{ json_decode(get_setting('home_banner1_title'), true)[$key] }}" >
                                                                    </div>
                                                                </div>

                                                                <div class="col-sm-5">
                                                                    <div class="form-group">
                                                                        <label for="validationCustomUsername">{{translate('الوصف')}}</label>
                                                                        <input type="text" class="form-control" placeholder="{{translate('الوصف')}}" name="home_banner1_dec[]"   value="{{ json_decode(get_setting('home_banner1_dec'), true)[$key] }}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-auto">
                                                                    <div class="form-group">
                                                                        <button data-repeater-delete="" class="btn btn-danger waves-effect waves-light" type="button"  data-toggle="remove-parent" data-parent=".row">
                                                                            <i data-feather="x-circle" class="feather-sm fill-white"></i>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                </div>
                                                <br>

                                                <div class="p-3">
                                                    <div class="text-end">
                                                        <button
                                                                type="button"
                                                                class="btn btn-primary rounded-pill px-4 waves-effect waves-light"
                                                                data-toggle="add-more"
                                                                data-content='
							<div class="row gutters-5">
								<div class="col-sm-4">
									<div class="form-group">
									<label for="validationCustomUsername">{{translate('الصورة')}}</label>

										<div class="input-group" data-toggle="aizuploader" data-type="image">
											<div class="input-group-prepend">
												<div class="input-group-text bg-soft-secondary font-weight-medium">{{translate('تصفح')}}</div>
											</div>
											<div class="form-control file-amount">{{translate('اختار الملف')}}</div>
											<input type="hidden" name="home_banner1_images[]" class="selected-files">
										</div>
										<div class="file-preview box sm">
										</div>
									</div>
								</div>
									<div class="col-sm-2">
									<div class="form-group">
									  <label for="validationCustomUsername">{{translate('العنوان')}}</label>
										<input type="text" class="form-control" placeholder="العنوان" name="home_banner1_title[]">
									</div>
								</div>

								    <div class="col-sm-5">
                                            <div class="form-group">
                                            	<label for="validationCustomUsername">{{translate('الوصف')}}</label>

                                                <input type="text" class="form-control" placeholder="{{translate('الوصف')}}" name="home_banner1_dec[]" >
                                            </div>
                                        </div>
								<div class="col-sm-auto">
									<div class="form-group">
									    <button data-repeater-delete="" class="btn btn-danger waves-effect waves-light" type="button"  data-toggle="remove-parent" data-parent=".row">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-circle feather-sm fill-white"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>
                                           </button>
									</div>
								</div>
							</div>'
                                                                data-target=".home-banner1-target">
                                                            <i data-feather="plus-circle" class="feather-sm ms-2 fill-white"></i>
                                                            {{ translate('اضافة') }}
                                                        </button>
                                                        <button type="submit" class="btn btn-info rounded-pill px-4 waves-effect waves-light">   {{translate('حفظ')}}</button>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </form>
                                </div>
                            </div>
                    </div>
                    <div class="row our_serivce" style="display: none">
                        @include('backend.SettingManagement.main_page.services.index')
                    </div>
                    <div class="row our_client" style="display: none">
                        <div class="col-12">
                            <div class="card">
                                <form class="needs-validation"
                                      action="{{ route('business_settings.update')}}"
                                      method="POST" novalidate>
                                    @csrf

                                    <div class="card">

                                        <div class="card-body">
                                            <h4 class=" card-title">{{translate('عملائنا')}}</h4>
                                            <div class="mb-3 row">
                                                <label class="col-sm-3 text-end control-label col-form-label" for="validationCustomUsername">{{translate('العنوان الرئيسى')}}</label>

                                                <div class="col-sm-9">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" placeholder="{{translate('العنوان الرئيسى')}}" name="home_our_client_title1" value="{{ get_setting('home_our_client_title1') }}" >
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-sm-3 text-end control-label col-form-label" for="validationCustomUsername">{{translate('العنوان الفرعى')}}</label>

                                                <div class="col-sm-9">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" placeholder="{{translate('العنوان الفرع')}}" name="home_our_client_title2" value="{{ get_setting('home_our_client_title2') }}" >
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="home-our_client-target">
                                                <input type="hidden" name="types[]" value="home_our_client_images">
                                                <input type="hidden" name="types[]" value="home_our_client_links">
                                                <input type="hidden" name="types[]" value="home_our_client_title">
                                                <input type="hidden" name="types[]" value="home_our_client_dec">
                                                <input type="hidden" name="types[]" value="home_our_client_title1">
                                                <input type="hidden" name="types[]" value="home_our_client_title2">


                                                @if (get_setting('home_our_client_images') != null)
                                                    @foreach (json_decode(get_setting('home_our_client_images'), true) as $key => $value)
                                                        <div class="row gutters-5">
                                                            <div class="col-sm-4">
                                                                <label for="validationCustomUsername">{{translate('الصورة')}}</label>

                                                                <div class="form-group">
                                                                    <div class="input-group" data-toggle="aizuploader" data-type="image">
                                                                        <div class="input-group-prepend">
                                                                            <div class="input-group-text bg-soft-secondary font-weight-medium">{{translate('تصفح')}}</div>
                                                                        </div>
                                                                        <div class="form-control file-amount">{{translate('اختار الملف')}}</div>
                                                                        <input type="hidden" name="home_our_client_images[]" class="selected-files" value="{{ json_decode(get_setting('home_our_client_images'), true)[$key] }}">
                                                                    </div>
                                                                    <div class="file-preview box sm">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-2">
                                                                <div class="form-group">
                                                                    <label for="validationCustomUsername">{{translate('العنوان')}}</label>
                                                                    <input type="text" class="form-control" placeholder="{{translate('Title 1')}}" name="home_our_client_title[]" value="{{ json_decode(get_setting('home_our_client_title'), true)[$key] }}" >
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-5">
                                                                <div class="form-group">
                                                                    <label for="validationCustomUsername">{{translate('الوصف')}}</label>
                                                                    <input type="text" class="form-control" placeholder="{{translate('الوصف')}}" name="home_our_client_dec[]"   value="{{ json_decode(get_setting('home_our_client_dec'), true)[$key] }}">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-auto">
                                                                <div class="form-group">
                                                                    <button data-repeater-delete="" class="btn btn-danger waves-effect waves-light" type="button"  data-toggle="remove-parent" data-parent=".row">
                                                                        <i data-feather="x-circle" class="feather-sm fill-white"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                            <br>

                                            <div class="p-3">
                                                <div class="text-end">
                                                    <button
                                                            type="button"
                                                            class="btn btn-primary rounded-pill px-4 waves-effect waves-light"
                                                            data-toggle="add-more"
                                                            data-content='
							<div class="row gutters-5">
								<div class="col-sm-4">
									<div class="form-group">
									<label for="validationCustomUsername">{{translate('الصورة')}}</label>

										<div class="input-group" data-toggle="aizuploader" data-type="image">
											<div class="input-group-prepend">
												<div class="input-group-text bg-soft-secondary font-weight-medium">{{translate('تصفح')}}</div>
											</div>
											<div class="form-control file-amount">{{translate('اختار الملف')}}</div>
											<input type="hidden" name="home_our_client_images[]" class="selected-files">
										</div>
										<div class="file-preview box sm">
										</div>
									</div>
								</div>
									<div class="col-sm-2">
									<div class="form-group">
									  <label for="validationCustomUsername">{{translate('العنوان')}}</label>
										<input type="text" class="form-control" placeholder="العنوان" name="home_our_client_title[]">
									</div>
								</div>

								    <div class="col-sm-5">
                                            <div class="form-group">
                                            	<label for="validationCustomUsername">{{translate('الوصف')}}</label>

                                                <input type="text" class="form-control" placeholder="{{translate('الوصف')}}" name="home_our_client_dec[]" >
                                            </div>
                                        </div>
								<div class="col-sm-auto">
									<div class="form-group">
									    <button data-repeater-delete="" class="btn btn-danger waves-effect waves-light" type="button"  data-toggle="remove-parent" data-parent=".row">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-circle feather-sm fill-white"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>
                                           </button>
									</div>
								</div>
							</div>'
                                                            data-target=".home-our_client-target">
                                                        <i data-feather="plus-circle" class="feather-sm ms-2 fill-white"></i>
                                                        {{ translate('اضافة') }}
                                                    </button>
                                                    <button type="submit" class="btn btn-info rounded-pill px-4 waves-effect waves-light">   {{translate('حفظ')}}</button>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>

                    </div>
{{--                    <div class="row recruitment_steps" style="display: none">--}}
{{--                        @include('backend.SettingManagement.main_page.recruitment_steps.index' )--}}
{{--                    </div>--}}
{{--                    <div class="row recruitment_requirements" style="display: none">--}}
{{--                        @include('backend.SettingManagement.main_page.recruitment_requirements.index')--}}
{{--                    </div>--}}
{{--                    <div class="row recruitment_references" style="display: none">--}}
{{--                        @include('backend.SettingManagement.main_page.recruitment_references.index')--}}
{{--                    </div>--}}
                    <div class="row footer" style="display: none">
                        @include('backend.SettingManagement.main_page.footer')
                    </div>
                    <div class="row public" style="display: none">
                        @include('backend.SettingManagement.main_page.general_settings')
                    </div>
                    <div class="row seo" style="display: none">
                        @include('backend.SettingManagement.main_page.general_seo')
                    </div>

                </div>
            </div>

            <!-- Modal Add notes -->
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

  <script src="{{ static_asset('v4_assets/dist/tagify-master/dist/jQuery.tagify.min.js') }}"></script>
    <script src="{{ static_asset('v4_assets/dist/tagify-master/dist/tagify.polyfills.min.js') }}"></script>
    <link href="{{ static_asset('v4_assets/dist/tagify-master/dist/tagify.css') }}" rel="stylesheet" type="text/css" />


    <script src="{{ static_asset('v4_assets/dist/js/pages/notes/notes.js') }}"></script>
    <script type="text/javascript">
        function updateSettings(el, type){
            if($(el).is(':checked')){
                var value = 1;
            }
            else{
                var value = 0;
            }

            $.post('{{ route('business_settings.update.activation') }}', {_token:'{{ csrf_token() }}', type:type, value:value}, function(data){
                if(data == '1'){
                    AIZ.plugins.notify('success', '{{ translate('تم التفعيل بنجاح') }}');
                }
                else{
                    AIZ.plugins.notify('danger', 'Something went wrong');
                }
            });
        }
    </script>
    <script type="text/javascript">

        $(function () {
            var meta_keywords = document.getElementById("meta_keywords")

            tagify = new Tagify(meta_keywords);
            function deleteContact() {
                $(".delete_recruitment_references").on("click", function (event) {

                    event.preventDefault();
                    $(this).parents(".search-items-recruitment-references").remove();
                    var a = $(this).data("href");
                    $.get(a, {_token:'{{ @csrf_token() }}'}, function(data){


                        AIZ.plugins.notify('success', "{{translate('تم الحذف بنجاح')}}");

                    })
                    /* Act on the event */
                });
            }

            deleteContact();

        });
    </script>

    <script type="text/javascript">
        $(function () {
            function deleteContact() {
                $(".delete_recruitment_requirements").on("click", function (event) {

                    event.preventDefault();
                    $(this).parents(".search-items-recruitment-requirements").remove();
                    var a = $(this).data("href");
                    $.get(a, {_token:'{{ @csrf_token() }}'}, function(data){


                        AIZ.plugins.notify('success', "{{translate('تم الحذف بنجاح')}}");

                    })
                    /* Act on the event */
                });
            }
            deleteContact();

        });
    </script>
    <script type="text/javascript">
        $(function () {


            function deleteContact() {
                $(".delete_steps").on("click", function (event) {

                    event.preventDefault();
                    $(this).parents(".search-items-steps").remove();
                    var a = $(this).data("href");
                    $.get(a, {_token:'{{ @csrf_token() }}'}, function(data){


                        AIZ.plugins.notify('success', "{{translate('تم الحذف بنجاح')}}");

                    })
                    /* Act on the event */
                });
            }




            deleteContact();

        });




    </script>
    <script type="text/javascript">
        function update_status2(el){
            if(el.checked){
                var status = 1;
            }
            else{
                var status = 0;
            }
            $.post('{{ route('nationalities.apper.status') }}', {_token:'{{ csrf_token() }}', id:el.value, status:status}, function(data){
                if(data == 1){
                    AIZ.plugins.notify('success', '{{ translate('تم التحديث بنجاح') }}');
                }
                else{
                    AIZ.plugins.notify('danger', '{{ translate('Something went wrong') }}');
                }
            });
        }
        $(function () {

            function deleteContact() {
                $(".delete_service").on("click", function (event) {

                    event.preventDefault();
                    $(this).parents(".search-items-service").remove();
                    var a = $(this).data("href");
                    $.get(a, {_token:'{{ @csrf_token() }}'}, function(data){


                        AIZ.plugins.notify('success', "{{translate('تم الحذف بنجاح')}}");

                    })
                    /* Act on the event */
                });
            }





            deleteContact();

        });




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















