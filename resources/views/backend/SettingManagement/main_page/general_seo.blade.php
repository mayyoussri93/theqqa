<div class="card">
                   
                 
                    <div class="card-body">
                        <h4 class=" card-title">{{translate('اعدادات السيو')}}</h4>

                        <form action="{{ route('business_settings.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            
                          
                                <div class="mb-3 row">
                                   <label  class="col-sm-3 text-end control-label col-form-label" >{{ translate('Meta عنوان') }}</label>
                                    <div class="col-sm-9">
                                    <input type="hidden" name="types[]" value="meta_title">
                                    <input type="text" class="form-control" placeholder="Title" name="meta_title" value="{{ get_setting('meta_title') }}">
                                    </div>
                                </div>
                       
                                <div class="mb-3 row">
                                    <label class="col-sm-3 text-end control-label col-form-label" >{{ translate('Meta وصف') }}</label>
                                    <div class="col-sm-9">
                                    <input type="hidden" name="types[]" value="meta_description">
                                    <textarea class="resize-off form-control" placeholder="Description" rows="5" name="meta_description">{{  get_setting('meta_description') }}</textarea>
                                    </div>
                                </div>
                           
                            <div class="form-group row">
                               <label  class="col-sm-3 text-end control-label col-form-label" >{{ translate('Meta صورة') }}</label>
                                <div class="col-sm-9">
                                <div class="input-group " data-toggle="aizuploader" data-type="image">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text bg-soft-secondary">{{ translate('Browse') }}</div>
                                    </div>
                                    <div class="form-control file-amount">{{translate('اختار الملف')}}</div>
                                    <input type="hidden" name="types[]" value="meta_image">
                                    <input type="hidden" name="meta_image" value="{{ get_setting('meta_image') }}" class="selected-files">
                                </div>
                                <div class="file-preview box"></div>
                                </div>
                            </div>
                            <div class="form-group row">
                               <label  class="col-sm-3 text-end control-label col-form-label" >{{ translate('الكلمات') }}</label>
                                <div class="col-sm-9">
                                    <input type="hidden" name="types[]" value="meta_keywords">
                                    <textarea class="resize-off form-control" id="meta_keywords" placeholder="Keyword, Keyword" rows="10" name="meta_keywords[]">{{ get_setting('meta_keywords') }}</textarea>
                                    <small class="text-muted">{{ translate('Separate with Enter') }}</small>
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
   
