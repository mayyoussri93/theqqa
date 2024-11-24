<div class="col-12">
                            <div class="card">





                                    <form class="needs-validation"
                                          action="{{ route('musaned.edit') }}"
                                          method="POST" novalidate>
                                        @csrf
                                        <div class="card-body">
                                            <h4 class=" card-title">{{translate('البيانات')}}</h4>

                                            <div class="mb-3 row">
                                                <label   class="col-sm-3 text-end control-label col-form-label" for="validationCustom01">{{translate('العنوان')}}</label>
                                                <div class="col-sm-9">
                                                <input type="text" placeholder="{{translate('العنوان الاول')}}"  id="validationCustom01" name="musaned_title"  value="{{get_setting('musaned_title')}}" class="form-control" required>
                                                <div class="valid-feedback">
                                                    {{translate("برجاء ادخال العنوان")}}
                                                </div>
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label   class="col-sm-3 text-end control-label col-form-label" for="validationCustom03">{{translate('الصورة')}} </label>
                                                <div class="col-sm-9">
                                                <div class="input-group" data-toggle="aizuploader" data-type="image">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text bg-soft-secondary font-weight-medium">{{translate('تصفح')}}</div>
                                                    </div>
                                                    <div class="form-control file-amount">{{translate('اختار الملف')}}</div>
                                                    <input type="hidden" name="musaned_image" value="{{get_setting('musaned_image')}}" class="selected-files">
                                                </div>
                                                <div class="file-preview box sm">
                                                </div>
                                                <div class="invalid-feedback">
                                                    {{ translate('الصورة مطلوبة')}}
                                                </div>
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label   class="col-sm-3 text-end control-label col-form-label" for="validationCustomUsername">{{translate('الوصف')}}</label>
                                                <div class="col-sm-9">
                                                <div class="input-group">

                                                    <textarea name="musaned_description" rows="5"       placeholder="{{translate('الوصف')}}"  class="form-control" required>  {{get_setting('musaned_description')}} </textarea>

                                                    <div class="invalid-feedback">
                                                        {{translate("برجاء ادخال الوصف")}}
                                                    </div>
                                                </div>
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label   class="col-sm-3 text-end control-label col-form-label" for="validationCustom03">{{translate('Logo')}} </label>
                                                <div class="col-sm-9">
                                                <div class="input-group" data-toggle="aizuploader" data-type="image">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text bg-soft-secondary font-weight-medium">{{translate('تصفح')}}</div>
                                                    </div>
                                                    <div class="form-control file-amount">{{translate('اختار الملف')}}</div>
                                                    <input type="hidden" name="musaned_logo" value="{{get_setting('musaned_logo')}}" class="selected-files">
                                                </div>
                                                <div class="file-preview box sm">
                                                </div>
                                                <div class="invalid-feedback">
                                                    {{ translate('الصورة مطلوبة')}}
                                                </div>
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label   class="col-sm-3 text-end control-label col-form-label" for="validationCustom01">{{translate('العنوان الثانى')}}</label>
                                                <div class="col-sm-9">
                                                <input type="hidden" name="types[]" value="arrive_worker_title_2">

                                                <input type="text" placeholder="{{translate('العنوان الثانى')}}" id="validationCustom01" name="arrive_worker_title_2"  value="{{get_setting('arrive_worker_title_2')}}" class="form-control" required>
                                                <div class="valid-feedback">
                                                    {{translate("برجاء ادخال العنوان")}}

                                                </div>
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label   class="col-sm-3 text-end control-label col-form-label" for="validationCustomUsername">{{translate('فديو')}}</label>
                                                <div class="col-sm-9">
                                                <div class="input-group">

                                                    <input type="url" name="musaned_video" value="{{get_setting('musaned_video')}}" class="form-control" required>

                                                    <div class="invalid-feedback">
                                                        {{translate("برجاء ادخال الفديو")}}
                                                    </div>
                                                </div>
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label   class="col-sm-3 text-end control-label col-form-label" for="validationCustomUsername">{{translate('الوصف')}}</label>
                                                <div class="col-sm-9">
                                                <div class="input-group">
                                                    <input type="hidden" name="types[]" value="arrive_worker_description_2">

                                                    <textarea name="arrive_worker_description_2" rows="5"       placeholder="{{translate('الوصف')}}"  class="form-control" required>  {{get_setting('arrive_worker_description_2')}} </textarea>

                                                    <div class="invalid-feedback">
                                                        {{translate("برجاء ادخال الوصف")}}
                                                    </div>
                                                </div>
                                                </div>
                                            </div>

</div>
                                        <hr>
                                            <div class="card-body">
                                                <h4 class=" card-title">{{translate('خدمات مساند')}}</h4>

                                                <div class="home-target">
                                            @if (get_setting('musaned_services_images') != null)
                                                @foreach (json_decode(get_setting('musaned_services_images'), true) as $key => $value)
                                                            <div data-repeater-item class="row mb-3">
                                                                <label class="col-sm-3 text-end control-label col-form-label" for="validationCustom01"></label>

                                                                <div class="col-sm-4 ">
                                                                    <label   class="col-sm-3 text-end control-label col-form-label" for="validationCustomUsername">{{translate('صورة خدمات مساند')}}</label>

                                                                    <div >
                                                                        <div class="form-group">
                                                                            <div class="input-group" data-toggle="aizuploader" data-type="document">
                                                                                <div class="input-group-prepend">
                                                                                    <div class="input-group-text bg-soft-secondary font-weight-medium">{{translate('تصفح')}}</div>
                                                                                </div>
                                                                                <div class="form-control file-amount">{{translate('اختار الملف')}}</div>
                                                                                <input type="hidden" name="types[]" value="musaned_services_images">
                                                                                <input type="hidden" id="customFile" name="musaned_services_images[]" class="selected-files" value="{{ json_decode(get_setting('musaned_services_images'), true)[$key] }}">
                                                                            </div>
                                                                            <div class="file-preview box sm">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-2">
                                                                    <label   class="col-sm-3 text-end control-label col-form-label" for="validationCustomUsername">{{translate('عنوان خدمات مساند')}}</label>
                                                                    <div class="input-group">

                                                                        <input type="hidden" name="types[]" value="musaned_services_titles">
                                                                        <input type="text" class="form-control" placeholder="{{ translate('عنوان خدمات مساند') }}" name="musaned_services_titles[]" value="{{ json_decode(get_setting('musaned_services_titles'), true)[$key] }}">
                                                                        <div class="invalid-feedback">
                                                                            {{translate("برجاء ادخال العنوان")}}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-2">
                                                                    <label   class="col-sm-3 text-end control-label col-form-label" for="validationCustomUsername">{{translate('وصف خدمات مساند')}}</label>
                                                                    <div class="input-group">
                                                                        <input type="hidden" name="types[]" value="musaned_services_des">
                                                                        <textarea name="musaned_services_des[]" rows="5" placeholder="{{ translate('وصف خدمات مساند') }}"   class="form-control" required>  {{ json_decode(get_setting('musaned_services_des'), true)[$key] }} </textarea>

                                                                        <div class="invalid-feedback">
                                                                            {{translate("برجاء ادخال الوصف")}}
                                                                        </div>
                                                                    </div>
                                                                </div>


                                                                <div class="col-md-1">

                                                                    <button data-repeater-delete="" class="btn btn-danger waves-effect waves-light" type="button"  data-toggle="remove-parent" data-parent=".row">
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
		                                                            <div  class="row mb-3">
		                                                                                                            <label   class="col-sm-3 text-end control-label col-form-label" for="validationCustom01">{{translate('العنوان')}}</label>

                                                                <div class="col-sm-4 ">
                                                                 <label   class="col-sm-3 text-end control-label col-form-label" for="validationCustomUsername">{{translate('صورة خدمات مساند')}}</label>

                                                                    <div >
                                                                        <div class="form-group">
                                                                            <div class="input-group" data-toggle="aizuploader" data-type="document">
                                                                                <div class="input-group-prepend">
                                                                                    <div class="input-group-text bg-soft-secondary font-weight-medium">{{translate('تصفح')}}</div>
                                                                                </div>
                                                                                <div class="form-control file-amount">{{translate('اختار الملف')}}</div>
                                                                                <input type="hidden" name="types[]" value="musaned_services_images">
                                                                                <input type="hidden" id="customFile" name="musaned_services_images[]" class="selected-files" >
                                                                            </div>
                                                                            <div class="file-preview box sm">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-2">
                                                                    <label   class="col-sm-3 text-end control-label col-form-label" for="validationCustomUsername">{{translate('عنوان خدمات مساند')}}</label>
                                                                    <div class="input-group">

                                                                        <input type="hidden" name="types[]" value="musaned_services_titles">
                                                                        <input type="text" class="form-control" placeholder="{{ translate('عنوان خدمات مساند') }}" name="musaned_services_titles[]">
                                                                        <div class="invalid-feedback">
                                                                            {{translate("برجاء ادخال الفديو")}}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-2">
                                                                <label   class="col-sm-3 text-end control-label col-form-label" for="validationCustomUsername">{{translate('وصف خدمات مساند')}}</label>
                                                                    <div class="input-group">
                                                                        <input type="hidden" name="types[]" value="musaned_services_des">
                                                                        <textarea name="musaned_services_des[]" rows="5" placeholder="{{ translate('وصف خدمات مساند') }}"   class="form-control" required> </textarea>
                                                                        <div class="invalid-feedback">
                                                                            {{translate("برجاء ادخال الوصف")}}
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
                                                        <i data-feather="plus-circle" class="feather-sm ms-2 fill-white"></i>
                                                        {{ translate('اضافة') }}
                                                    </button>
                                                    </div>
                                                </div>
                                            </div>
                                        <hr>
                                            <div class="card-body">
                                                <h4 class=" card-title">{{translate('إنطلاق رحلة الاستقدام مع مساند')}}</h4>

                                            <div class="mb-3 row">
                                                <label   class="col-sm-3 text-end control-label col-form-label" for="validationCustomUsername">{{translate('الوصف')}}</label>
                                                <div class="col-sm-9">
                                                <div class="input-group">
                                                    <input type="hidden" name="types[]" value="musaned_journey_description">
                                                                                    <textarea name="musaned_journey_description" rows="5"   class="form-control" required>  {{get_setting('musaned_journey_description')}} </textarea>

                                                    <div class="invalid-feedback">
                                                        {{translate("برجاء ادخال الوصف")}}
                                                    </div>
                                                </div>
                                                </div>
                                            </div>

                                        <div class="home-target2">
                                            @if (get_setting('musaned_journey_images') != null)
                                                @foreach (json_decode(get_setting('musaned_journey_images'), true) as $key => $value)

                                                        <div data-repeater-item class="row mb-3">
                                                            <label   class="col-sm-3 text-end control-label col-form-label" for="validationCustomUsername"></label>

                                                            <div class="col-sm-4 ">
                                                                <label    for="validationCustomUsername">{{translate('صورة مساند')}}</label>


                                                                    <div class="form-group">
                                                                        <div class="input-group" data-toggle="aizuploader" data-type="document">
                                                                            <div class="input-group-prepend">
                                                                                <div class="input-group-text bg-soft-secondary font-weight-medium">{{translate('تصفح')}}</div>
                                                                            </div>
                                                                            <div class="form-control file-amount">{{translate('اختار الملف')}}</div>
                                                                            <input type="hidden" name="types[]" value="musaned_journey_images">
                                                                            <input type="hidden" id="customFile" name="musaned_journey_images[]" class="selected-files" value="{{ json_decode(get_setting('musaned_journey_images'), true)[$key] }}">
                                                                        </div>
                                                                        <div class="file-preview box sm">
                                                                        </div>
                                                                    </div>

                                                            </div>
                                                            <div class="col-sm-4">
                                                                <label   for="validationCustomUsername">{{translate('عنوان مساند')}}</label>
                                                                <div class="input-group">

                                                                    <input type="hidden" name="types[]" value="musaned_journey_titles">
                                                                   <input type="text" class="form-control" placeholder="{{ translate('عنوان مساند') }}" name="musaned_journey_titles[]" value="{{ json_decode(get_setting('musaned_journey_titles'), true)[$key] }}">

                                                                    <div class="invalid-feedback">
                                                                        {{translate("برجاء ادخال العنوان")}}
                                                                    </div>
                                                                </div>
                                                            </div>


                                                            <div class="col-sm-1">

                                                                <button data-repeater-delete="" class="btn btn-danger waves-effect waves-light" type="button"  data-toggle="remove-parent" data-parent=".row">
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
		                                                                                                                <div data-repeater-item class="row mb-3">
		            <label   class="col-sm-3 text-end control-label col-form-label" for="validationCustomUsername"></label>

                                                            <div class="col-sm-4 ">
                                                                <label  for="validationCustomUsername">{{translate('صورة مساند')}}</label>


                                                                    <div class="form-group">
                                                                        <div class="input-group" data-toggle="aizuploader" data-type="document">
                                                                            <div class="input-group-prepend">
                                                                                <div class="input-group-text bg-soft-secondary font-weight-medium">{{translate('تصفح')}}</div>
                                                                            </div>
                                                                            <div class="form-control file-amount">{{translate('اختار الملف')}}</div>
                                                                            <input type="hidden" name="types[]" value="musaned_journey_images">
                                                                            <input type="hidden" id="customFile" name="musaned_journey_images[]" class="selected-files" >
                                                                        </div>
                                                                        <div class="file-preview box sm">
                                                                        </div>
                                                                    </div>

                                                            </div>
                                                            <div class="col-sm-4">
                                                                <label  for="validationCustomUsername">{{translate('عنوان مساند')}}</label>
                                                                <div class="input-group">

                                                                    <input type="hidden" name="types[]" value="musaned_journey_titles">
                                                                   <input type="text" class="form-control" placeholder="{{ translate('عنوان مساند') }}" name="musaned_journey_titles[]" >

                                                                    <div class="invalid-feedback">
                                                                        {{translate("برجاء ادخال العنوان")}}
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="col-sm-1">

                                                    <button data-repeater-delete="" class="btn btn-danger waves-effect waves-light" type="button"  data-toggle="remove-parent" data-parent=".row">
                                                                                                                     <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-circle feather-sm fill-white"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>

                                                    </button>
                                                </div>
                                            </div>
'
                                                data-target=".home-target2">
                                            <i data-feather="plus-circle" class="feather-sm ms-2 fill-white"></i>
                                            {{ translate('اضافة') }}
                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        <hr>
                                            <div class="card-body">
                                                <h4 class=" card-title">{{translate('خطوات مساند')}}</h4>
                                                <div class="home-target3">
                                                    @if (get_setting('musaned_steps_images') != null)
                                                        @foreach (json_decode(get_setting('musaned_steps_images'), true) as $key => $value)
                                                            <div >
                                                                <div data-repeater-item class="row mb-3">
                                                                    <label   class="col-sm-3 text-end control-label col-form-label" for="validationCustomUsername"></label>

                                                                    <div class="col-sm-4 ">
                                                                        <label    for="validationCustomUsername">{{translate('صورة خدمات مساند')}}</label>
                                                                            <div class="form-group">
                                                                                <div class="input-group" data-toggle="aizuploader" data-type="document">
                                                                                    <div class="input-group-prepend">
                                                                                        <div class="input-group-text bg-soft-secondary font-weight-medium">{{translate('تصفح')}}</div>
                                                                                    </div>
                                                                                    <div class="form-control file-amount">{{translate('اختار الملف')}}</div>
                                                                                    <input type="hidden" name="types[]" value="musaned_steps_images">
                                                                                    <input type="hidden" id="customFile" name="musaned_steps_images[]" class="selected-files" value="{{ json_decode(get_setting('musaned_steps_images'), true)[$key] }}">
                                                                                </div>
                                                                                <div class="file-preview box sm">
                                                                                </div>
                                                                            </div>
                                                                    </div>
                                                                    <div class="col-sm-2">
                                                                        <label    for="validationCustomUsername">{{translate('عنوان خطوات مساند')}}</label>
                                                                        <div class="input-group">
                                                                            <input type="hidden" name="types[]" value="musaned_steps_titles">
                                                                            <input type="text" class="form-control" placeholder="{{ translate('عنوان خطوات مساند') }}" name="musaned_steps_titles[]" value="{{ json_decode(get_setting('musaned_steps_titles'), true)[$key] }}">
                                                                            <div class="invalid-feedback">
                                                                                {{translate("برجاء ادخال العنوان")}}
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-2">
                                                                        <label   class="col-sm-3 text-end control-label col-form-label" for="validationCustomUsername">{{translate('وصف خدمات مساند')}}</label>
                                                                        <div class="input-group">
                                                                            <input type="hidden" name="types[]" value="musaned_steps_des">
                                                                            <input type="text" class="form-control" placeholder="{{ translate('وصف خدمات مساند') }}" name="musaned_steps_des[]" value="{{ json_decode(get_setting('musaned_steps_des'), true)[$key] }}">
                                                                            <div class="invalid-feedback">
                                                                                {{translate("برجاء ادخال الوصف")}}
                                                                            </div>
                                                                        </div>
                                                                    </div>


                                                                    <div class="col-md-1">

                                                                        <button data-repeater-delete="" class="btn btn-danger waves-effect waves-light" type="button"  data-toggle="remove-parent" data-parent=".row">
                                                                            <i data-feather="x-circle" class="feather-sm fill-white"></i>
                                                                        </button>
                                                                    </div>
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
		                                                                     <div >
                                                                <div data-repeater-item class="row mb-3">
                                                <label   class="col-sm-3 text-end control-label col-form-label" for="validationCustomUsername"></label>

                                                                    <div class="col-sm-4 ">
                                                                        <label   for="validationCustomUsername">{{translate('صورة خدمات مساند')}}</label>
                                                                            <div class="form-group">
                                                                                <div class="input-group" data-toggle="aizuploader" data-type="document">
                                                                                    <div class="input-group-prepend">
                                                                                        <div class="input-group-text bg-soft-secondary font-weight-medium">{{translate('تصفح')}}</div>
                                                                                    </div>
                                                                                    <div class="form-control file-amount">{{translate('اختار الملف')}}</div>
                                                                                    <input type="hidden" name="types[]" value="musaned_steps_images">
                                                                                    <input type="hidden" id="customFile" name="musaned_steps_images[]" class="selected-files" >
                                                                                </div>
                                                                                <div class="file-preview box sm">
                                                                                </div>
                                                                            </div>

                                                                    </div>
                                                                    <div class="col-sm-2">
                                                                        <label   for="validationCustomUsername">{{translate('عنوان خطوات مساند')}}</label>
                                                                        <div class="input-group">
                                                                            <input type="hidden" name="types[]" value="musaned_steps_titles">
                                                                            <input type="text" class="form-control" placeholder="{{ translate('عنوان خطوات مساند') }}" name="musaned_steps_titles[]" >
                                                                            <div class="invalid-feedback">
                                                                                {{translate("برجاء ادخال العنوان")}}
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <label   for="validationCustomUsername">{{translate('وصف خدمات مساند')}}</label>
                                                                        <div class="input-group">
                                                                            <input type="hidden" name="types[]" value="musaned_steps_des">
                                                                            <input type="text" class="form-control" placeholder="{{ translate('وصف خدمات مساند') }}" name="musaned_steps_des[]" >
                                                                            <div class="invalid-feedback">
                                                                                {{translate("برجاء ادخال الوصف")}}
                                                                </div>
                                                            </div>
                                                        </div>


                                                        <div class="col-sm-1">

                                                            <button data-repeater-delete="" class="btn btn-danger waves-effect waves-light" type="button"  data-toggle="remove-parent" data-parent=".row">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-circle feather-sm fill-white"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>

                                                            </button>
                                                        </div>
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
                                            <div class="card-body">
                                                <h4 class=" card-title">{{translate('رسوم مساند')}}</h4>

                                                    <div class="mb-3 row">
                                                        <label   class="col-sm-3 text-end control-label col-form-label" for="validationCustom01">{{translate('العنوان')}}</label>
                                                        <div class="col-sm-9">
                                                        <input type="text" placeholder="{{translate('العنوان')}}"  id="validationCustom01" name="musaned_fees_title"  value="{{get_setting('musaned_fees_title')}}" class="form-control" required>
                                                        <div class="valid-feedback">
                                                            {{translate("برجاء ادخال العنوان")}}
                                                        </div>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3 row">
                                                        <label   class="col-sm-3 text-end control-label col-form-label" for="validationCustom03">{{translate('الصورة')}} </label>
                                                        <div class="col-sm-9">
                                                        <div class="input-group" data-toggle="aizuploader" data-type="image">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text bg-soft-secondary font-weight-medium">{{translate('تصفح')}}</div>
                                                            </div>
                                                            <div class="form-control file-amount">{{translate('اختار الملف')}}</div>
                                                            <input type="hidden" name="musaned_fees_logo" value="{{get_setting('musaned_fees_logo')}}" class="selected-files">
                                                        </div>
                                                        <div class="file-preview box sm">
                                                        </div>
                                                        <div class="invalid-feedback">
                                                            {{ translate('الصورة مطلوبة')}}
                                                        </div>
                                                        </div>

                                                    </div>
                                                    <div class="mb-3 row">
                                                        <label   class="col-sm-3 text-end control-label col-form-label" for="validationCustomUsername">{{translate('الوصف')}}</label>
                                                        <div class="col-sm-9">
                                                        <div class="input-group">
                                                            <textarea name="musaned_fees_description" rows="5"       placeholder="{{translate('الوصف')}}"  class="form-control" required>  {{get_setting('musaned_fees_description')}} </textarea>
                                                            <div class="invalid-feedback">
                                                                {{translate("برجاء ادخال الوصف")}}
                                                            </div>
                                                        </div>
                                                        </div>
                                                    </div>

                                            </div>
                                        <hr>
                                            <div class="card-body">
                                                <h4 class=" card-title">{{translate('تطبيقات مساند')}}</h4>
                                                <div class="mb-3 row">
                                                        <label   class="col-sm-3 text-end control-label col-form-label" for="validationCustom01">{{translate('العنوان')}}</label>
                                                        <div class="col-sm-9">
                                                        <input type="text" placeholder="{{translate('العنوان')}}"  id="validationCustom01" name="musaned_apps_title"  value="{{get_setting('musaned_apps_title')}}" class="form-control" required>
                                                        <div class="valid-feedback">
                                                            {{translate("برجاء ادخال العنوان")}}

                                                        </div>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3 row">
                                                        <label   class="col-sm-3 text-end control-label col-form-label" for="validationCustomUsername">{{translate('الوصف')}}</label>
                                                        <div class="col-sm-9">
                                                        <div class="input-group">

                                                            <textarea name="musaned_apps_description" rows="5"       placeholder="{{translate('الوصف')}}"  class="form-control" required>  {{get_setting('musaned_apps_description')}} </textarea>

                                                            <div class="invalid-feedback">
                                                                {{translate("برجاء ادخال الوصف")}}
                                                            </div>
                                                        </div>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3 row">
                                                        <label   class="col-sm-3 text-end control-label col-form-label" for="validationCustom01">{{translate('رابط اندرويد')}}</label>
                                                        <div class="col-sm-9">
                                                        <input type="url" placeholder="{{translate('رابط اندرويد')}}"  id="validationCustom01" name="musaned_android_link"  value="{{get_setting('musaned_android_link')}}" class="form-control" required>
                                                        <div class="valid-feedback">
                                                            {{translate("برجاء ادخال الرابط")}}

                                                        </div>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3 row">
                                                        <label   class="col-sm-3 text-end control-label col-form-label" for="validationCustom01">{{translate('رابط ايفون')}}</label>
                                                        <div class="col-sm-9">
                                                        <input type="url" placeholder="{{translate('رابط ايفون')}}"  id="validationCustom01" name="musaned_apple_link"  value="{{get_setting('musaned_apple_link')}}" class="form-control" required>
                                                        <div class="valid-feedback">
                                                            {{translate("برجاء ادخال الرابط")}}

                                                        </div>
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