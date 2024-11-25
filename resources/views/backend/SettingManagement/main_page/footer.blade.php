<div class="col-12">
        <div class="card">
                <form class="needs-validation form-horizontal"
                      action="{{ route('business_settings.update')}}"
                      method="POST" novalidate>
                    @csrf
                    <div class="card-body">
                        <h4 class="card-title text-start">{{translate('البيانات')}}</h4>
{{--                        <div class="mb-3 row">--}}
{{--                            <label for="fname" class="col-sm-3 text-end control-label col-form-label">{{translate('صورة الشريط السفلى')}}</label>--}}
{{--                            <div class="col-sm-9">--}}
{{--                                <div class=" input-group " data-toggle="aizuploader" data-type="image">--}}
{{--                                    <div class="input-group-prepend">--}}
{{--                                        <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse') }}</div>--}}
{{--                                    </div>--}}
{{--                                    <div class="form-control file-amount">{{translate('اختار الملف')}}</div>--}}
{{--                                    <input type="hidden" name="types[]" value="footer_logo">--}}
{{--                                    <input type="hidden" name="footer_logo" class="selected-files"--}}
{{--                                           value="{{ get_setting('footer_logo') }}">--}}
{{--                                </div>--}}
{{--                                <div class="file-preview"></div>--}}
{{--                                <div class="valid-feedback">--}}
{{--                                    {{translate("برجاء ادخال الصورة")}}--}}

{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                        <div class="mb-3 row">
                            <label for="lname" class="col-sm-3 text-end control-label col-form-label">{{translate('وصف تواصل معنا')}}</label>
                            <div class="col-sm-9">
                                <input type="hidden" name="types[]" value="title_about_us_description">
                                <textarea name="title_about_us_description" class="form-control"
                                          required>@php echo get_setting('title_about_us_description'); @endphp</textarea>
                                <div class="valid-feedback">
                                    {{translate("برجاء ادخال الوصف")}}

                                </div>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="email1" class="col-sm-3 text-end control-label col-form-label">{{ translate('رقم التواصل معنا') }}</label>
                            <div class="col-sm-9">
                                <input type="hidden" name="types[]" value="contact_phone_1">
                                <input type="text" class="form-control"
                                       placeholder="{{ translate('رقم التواصل معنا') }}"
                                       name="contact_phone_1"
                                       value="{{ get_setting('contact_phone_1') }}">
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="cono1" class="col-sm-3 text-end control-label col-form-label">{{ translate('التواصل عبر الهاتف') }}</label>
                            <div class="col-sm-9">
                                <input type="hidden" name="types[]" value="contact_by_phone">
                                <input type="text" class="form-control"
                                       placeholder="{{ translate('التواصل عبر الهاتف') }}"
                                       name="contact_by_phone"
                                       value="{{ get_setting('contact_by_phone') }}">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="email1" class="col-sm-3 text-end control-label col-form-label">{{ translate('التواصل عبر البريد') }}</label>
                            <div class="col-sm-9">
                                <input type="hidden" name="types[]" value="contact_email">
                                <input type="text" class="form-control"
                                       placeholder="{{ translate('التواصل عبر البريد') }}"
                                       name="contact_email" value="{{ get_setting('contact_email') }}">
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="com1" class="col-sm-3 text-end control-label col-form-label">
                                {{ translate('عنوان مقرنا') }}
                            </label>
                            <div class="col-sm-9">
                                <input type="hidden" name="types[]" value="contact_address">
                                <input type="text" class="form-control" name="contact_address"
                                       value="{{ get_setting('contact_address') }}">
                            </div>
                        </div>


                    </div>
                    <hr>
                    <div class="card-body">
                    <h4 class="card-title text-start">{{translate('عدادات الشريط السفلى')}}</h4>
                    <div class="mb-3 row">
                        <label for="com1" class="col-sm-3 text-end control-label col-form-label">{{translate('العنوان')}}</label>
                        <div class="col-sm-9">
                            <input type="hidden" name="types[]" value="widget_one">
                            <input type="text" class="form-control"
                                   placeholder=" {{translate("العنوان")}}" name="widget_one"
                                   value="{{ get_setting('widget_one') }}">
                            <div class="invalid-feedback">
                                {{translate("برجاء ادخال العنوان")}}
                            </div>
                        </div>
                    </div>
                    <div class="home-target">
                        <input type="hidden" name="types[]" value="widget_one_labels">
                        <input type="hidden" name="types[]" value="widget_one_links">
                        @if (get_setting('widget_one_labels') != null)
                            @foreach (json_decode(get_setting('widget_one_labels'), true) as $key => $value)
                                <div data-repeater-item class="row mb-3">
                                    <label for="fname" class="col-sm-3 text-end control-label col-form-label"></label>

                                    <div class="col-sm-4">
                                        <label for="validationCustomUsername">{{translate('العنوان')}}</label>
                                        <div class="input-group">

                                            <input type="text" class="form-control"
                                                   placeholder=" {{translate("العنوان")}}"
                                                   name="widget_one_labels[]"
                                                   value="{{ $value }}">

                                            <div class="invalid-feedback">
                                                {{translate("برجاء ادخال العنوان")}}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="validationCustomUsername">{{translate('عنوان الرابط')}}</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control"
                                                   placeholder="{{ translate('عنوان الرابط') }}"
                                                   name="widget_one_links[]"
                                                   value="{{ json_decode(App\Models\BusinessSetting::where('type', 'widget_one_links')->first()->value, true)[$key] }}">

                                            <div class="invalid-feedback">
                                                {{translate("برجاء ادخال عنوان الرابط")}}
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-sm-1">
                                        <button data-repeater-delete=""
                                                class="btn btn-danger waves-effect waves-light"
                                                type="button" data-toggle="remove-parent"
                                                data-parent=".row">
                                            <i data-feather="x-circle"
                                               class="feather-sm fill-white"></i>
                                        </button>
                                    </div>
                                </div>

                            @endforeach
                        @endif
                    </div>
                        <div class="p-3 ">
                            <div class="text-end">
                    <button
                            type="button"
                            class="btn btn-primary rounded-pill px-4 waves-effect waves-light"
                            data-toggle="add-more"
                            data-content='
		                                                            <div  class="row mb-3">
		          <label for="fname" class="col-sm-3 text-end control-label col-form-label"></label>

                                                                                  <div class="col-sm-4">
                                                                    <label for="validationCustomUsername">{{translate('العنوان')}}</label>
                                                                    <div class="input-group">

                                                                        <input type="text" class="form-control" placeholder=" {{translate("العنوان")}}" name="widget_one_labels[]" >

                                                                        <div class="invalid-feedback">
                                                                            {{translate("برجاء ادخال العنوان")}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <label for="validationCustomUsername">{{translate('عنوان الرابط')}}</label>
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control" placeholder="{{translate('عنوان الرابط')}}" name="widget_one_links[]" >

                                                                        <div class="invalid-feedback">
                                                                            {{translate("برجاء ادخال غنوان الرابط")}}
                                    </div>
                                </div>
                            </div>


                    <div class="col-sm-1">
                        <button data-repeater-delete="" class="btn btn-danger waves-effect waves-light" type="button"  data-toggle="remove-parent" data-parent=".row">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-circle feather-sm fill-white"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>
                        </button>
                                                                   </div>
        </div>'
                            data-target=".home-target">
                        <i data-feather="plus-circle"
                           class="feather-sm ms-2 fill-white"></i>
                        {{ translate('اضافة') }}
                    </button>
                            </div>
                        </div>
                </div>
                    <hr>
                    <div class="card-body">
                        <h4 class="card-title text-start">{{translate('روابط التواصل الاجتماعية')}}</h4>
                        <div class="mb-3 row">
                            <label for="com1" class="col-sm-3 text-end control-label col-form-label">
                                <span class="input-group-text"><i class="mdi mdi-facebook"></i></span>
                            </label>
                            <div class="col-sm-9">
                                <input type="hidden" name="types[]" value="facebook_link">
                                <input type="text" class="form-control" placeholder="http://"
                                       name="facebook_link"
                                       value="{{ get_setting('facebook_link')}}">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="com1" class="col-sm-3 text-end control-label col-form-label">
                                 <span class="input-group-text"><i class="mdi mdi-twitter"></i></span>
                            </label>
                            <div class="col-sm-9">
                                <input type="hidden" name="types[]" value="twitter_link">
                                <input type="text" class="form-control" placeholder="http://"
                                       name="twitter_link" value="{{ get_setting('twitter_link')}}">
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="com1" class="col-sm-3 text-end control-label col-form-label">
                                   <span class="input-group-text"><i
                                               class="mdi mdi-youtube-play"></i></span>
                            </label>
                            <div class="col-sm-9">
                                <input type="hidden" name="types[]" value="youtube_link">
                                <input type="text" class="form-control" placeholder="http://"
                                       name="youtube_link" value="{{ get_setting('youtube_link')}}">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="com1" class="col-sm-3 text-end control-label col-form-label">
                                <span class="input-group-text"><i class="mdi mdi-linkedin"></i></span>

                            </label>
                            <div class="col-sm-9">
                                <input type="hidden" name="types[]" value="linkedin_link">
                                <input type="text" class="form-control" placeholder="http://"
                                       name="linkedin_link"
                                       value="{{ get_setting('linkedin_link')}}">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="com1" class="col-sm-3 text-end control-label col-form-label">
                                <span class="input-group-text"><i class="mdi mdi-snapchat"></i></span>
                            </label>
                            <div class="col-sm-9">
                                <input type="hidden" name="types[]" value="snap_link">
                                <input type="text" class="form-control" placeholder="http://"
                                       name="snap_link" value="{{ get_setting('snap_link')}}">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="com1" class="col-sm-3 text-end control-label col-form-label">
                                <span class="input-group-text"><img style="width: 16px;height: 16px" src="{{static_asset('v3_assets/img/tiktok.svg')}}"></span>
                            </label>
                            <div class="col-sm-9">
                                <input type="hidden" name="types[]" value="tiktok_link">
                                <input type="text" class="form-control" placeholder="http://"
                                       name="tiktok_link" value="{{ get_setting('tiktok_link')}}">
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="card-body">
                        <h4 class="card-title text-start">{{translate('ضع فريم الموقع من جوجل ماب')}}</h4>

                        <div class="mb-3 row">
                            <label for="com1" class="col-sm-3 text-end control-label col-form-label">
                                {{ translate('ضع فريم الموقع من جوجل ماب') }}
                            </label>
                            <div class="col-sm-9">
                                <input type="hidden" name="types[]" value="our_location">
                                <input type="text" class="form-control" name="our_location"
                                       value="{{ get_setting('our_location') }}">
                            </div>
                        </div>
                    </div>
                    <div class="p-3 ">
                    <div class="text-end">
                        <button type="submit" class="btn btn-info rounded-pill px-4 waves-effect waves-light">   {{translate('حفظ')}}</button>

                    </div>
                </div>
            </form>
        </div>
    </div>
