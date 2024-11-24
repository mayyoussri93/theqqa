<div class="col-12">
    <div class="card">


        <form class="form-horizontal needs-validation"
              action="{{ route('business_settings.update')}}"
              method="POST" novalidate>
            @csrf
            <div class="card-body">
                <h4 class="card-title">{{translate('صورة الشريط العلوى')}}</h4>
                <div class="mb-3 row">
                    <label for="fname"
                           class="col-sm-3 text-end control-label col-form-label">{{translate('صورة الشريط العلوى')}}</label>
                    <div class="col-sm-9">
                        <div class=" input-group " data-toggle="aizuploader" data-type="image">
                            <div class="input-group-prepend">
                                <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse') }}</div>
                            </div>
                            <div class="form-control file-amount">{{translate('اختار الملف')}}</div>
                            <input type="hidden" name="types[]" value="header_logo">
                            <input type="hidden" name="header_logo" class="selected-files"
                                   value="{{ get_setting('header_logo') }}">
                        </div>
                        <div class="file-preview"></div>
                        <div class="valid-feedback">
                            {{translate("برجاء ادخال الصورة")}}

                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <h4 class="card-title">{{translate('زر التوجية العلوى')}}</h4>
                <div class="mb-3 row">
                    <input type="hidden" name="types[]" value="header_key_labels_3">
                    <input type="hidden" name="types[]" value="header_key_links_3">
                    <label for="fname" class="col-sm-3 text-end control-label col-form-label"></label>

                    <div class="col-sm-4">
                        <label for="validationCustomUsername">{{translate('نص الزر')}}</label>
                        <div class="input-group">

                            <input type="text" class="form-control" placeholder=" {{translate("نص الزر")}}"
                                   name="header_key_labels_3" value="{{ get_setting('header_key_labels_3')??'' }}">

                            <div class="invalid-feedback">
                                {{translate("برجاء ادخال العنوان")}}
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <label for="validationCustomUsername">{{translate('الرابط')}}</label>
                        <div class="input-group">
                            <input type="text" class="form-control"
                                   placeholder="{{ translate('route name') }}" name="header_key_links_3"
                                   value="{{  get_setting('header_key_links_3')??''}}">

                            <div class="invalid-feedback">
                                {{translate("برجاء ادخال الرابط")}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <hr>
            <div class="card-body">
                <h4 class="card-title">{{translate('ترتيب العنوان العلوي')}}</h4>
                <div class="home-target3"><input type="hidden" name="types[]" value="header_menu_links_3">
                    <input type="hidden" name="types[]" value="header_menu_labels_3">
                    @if (get_setting('header_menu_labels_3') != null)
                        @foreach (json_decode(get_setting('header_menu_labels_3'), true) as $key => $value)
                            <div data-repeater-item class="mb-3 row">
                                <label for="fname" class="col-sm-3 text-end control-label col-form-label"></label>

                                <div class="col-sm-4">
                                    <label for="validationCustomUsername">{{translate('العنوان')}}</label>
                                    <div class="input-group">

                                        <input type="text" class="form-control" placeholder=" {{translate("العنوان")}}"
                                               name="header_menu_labels_3[]" value="{{ $value }}">

                                        <div class="invalid-feedback">
                                            {{translate("برجاء ادخال العنوان")}}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label for="validationCustomUsername">{{translate('الرابط')}}</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control"
                                               placeholder="{{ translate('route name') }}" name="header_menu_links_3[]"
                                               value="{{ json_decode(App\Models\BusinessSetting::where('type', 'header_menu_links_3')->first()->value, true)[$key] }}">

                                        <div class="invalid-feedback">
                                            {{translate("برجاء ادخال الرابط")}}
                                        </div>
                                    </div>
                                </div>


                                <div class="col-sm-1">

                                    <button data-repeater-delete="" class="btn btn-danger waves-effect waves-light"
                                            type="button" data-toggle="remove-parent" data-parent=".row">
                                        <i data-feather="x-circle" class="feather-sm fill-white"></i>
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
		                                                            <div  class="mb-3 row">
		                                                                                                                        <label for="fname" class="col-sm-3 text-end control-label col-form-label"></label>

                                                                                  <div class="col-sm-4">
                                                                    <label for="validationCustomUsername">{{translate('العنوان')}}</label>
                                                                    <div class="input-group">

                                                                        <input type="text" class="form-control" placeholder=" {{translate("العنوان")}}" name="header_menu_labels_3[]" >

                                                                        <div class="invalid-feedback">
                                                                            {{translate("برجاء ادخال العنوان")}}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label for="validationCustomUsername" >{{translate('الرابط')}}</label>
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control" placeholder="{{ translate('route name') }}" name="header_menu_links_3[]" >

                                                                        <div class="invalid-feedback">
                                                                            {{translate("برجاء ادخال الرابط")}}
                                        </div>
                                    </div>
                                </div>


                        <div class="col-sm-1">
                            <button data-repeater-delete="" class="btn btn-danger waves-effect waves-light" type="button"  data-toggle="remove-parent" data-parent=".row">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-circle feather-sm fill-white"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>
                            </button>
                            </div>

            </div>'
                                data-target=".home-target3">
                            <i data-feather="plus-circle" class="feather-sm ms-2 fill-white"></i>
                            {{ translate('اضافة') }}
                        </button>
                    </div>
                </div>

            </div>

            <hr>


            <div class="p-3">
                <div class="text-end">
                    <button type="submit"
                            class="btn btn-info rounded-pill px-4 waves-effect waves-light">   {{translate('حفظ')}}</button>
                </div>
            </div>
        </form>
    </div>
</div>