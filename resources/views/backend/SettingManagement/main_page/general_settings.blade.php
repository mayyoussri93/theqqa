<div class="card">
    <div class="card-body">
        <form class="needs-validation"
              novalidate action="{{ route('business_settings.update') }}" method="POST"
              enctype="multipart/form-data">
            @csrf

                <div class="mb-3 row">
                    <label  class="col-sm-3 text-end control-label col-form-label" for="validationCustom01">{{translate('عنوان النظام')}}</label>
                    <div class="col-sm-9">
                    <input type="hidden" name="types[]" value="site_name">
                    <input type="text" name="site_name" class="form-control" value="{{ get_setting('site_name') }}" required>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label  class="col-sm-3 text-end control-label col-form-label" >{{translate('لوجو النظام - الابيض')}}</label>
                    <div class="col-sm-9">
                    <div class="input-group" data-toggle="aizuploader" data-type="image">
                        <div class="input-group-prepend">
                            <div class="input-group-text bg-soft-secondary">{{ translate('Browse') }}</div>
                        </div>
                        <div class="form-control file-amount">{{ translate('Choose Files') }}</div>
                        <input type="hidden" name="types[]" value="system_logo_white">
                        <input type="hidden" name="system_logo_white" value="{{ get_setting('system_logo_white') }}" class="selected-files">
                    </div>
                    <div class="file-preview box sm"></div>
                    <small>{{ translate('Will be used in admin panel side menu + Admin login page') }}</small>
                    </div>
                </div>


                <div class="mb-3 row">

                    <label  class="col-sm-3 text-end control-label col-form-label" >{{translate('لوجو النظام - الاسود')}}</label>
                    <div class="col-sm-9">
                    <div class="input-group" data-toggle="aizuploader" data-type="image">
                        <div class="input-group-prepend">
                            <div class="input-group-text bg-soft-secondary">{{ translate('Browse') }}</div>
                        </div>
                        <div class="form-control file-amount">{{ translate('Choose Files') }}</div>
                        <input type="hidden" name="types[]" value="system_logo_black">
                        <input type="hidden" name="system_logo_black" value="{{ get_setting('system_logo_black') }}" class="selected-files">
                    </div>
                    <div class="file-preview box sm"></div>
                    <small>{{ translate('Will be used in admin panel topbar in mobile') }}</small>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label  class="col-sm-3 text-end control-label col-form-label" for="validationCustom01">{{translate('عنوان النظام الامامى')}}</label>
                    <div class="col-sm-9">
                    <input type="hidden" name="types[]" value="website_name">
                    <input type="text" name="website_name" class="form-control" value="{{ get_setting('website_name') }}" required>
                    </div>
                </div>

                <div class="mb-3 row">

                    <label  class="col-sm-3 text-end control-label col-form-label" for="validationCustom01">{{translate('Site Motto for backend')}}</label>
                    <div class="col-sm-9">
                    <input type="hidden" name="types[]" value="site_motto">
                    <input type="text" name="site_motto" class="form-control" value="{{ get_setting('site_motto') }}" required>
                    </div>
                </div>


                <div class="mb-3 row">
                    <label  class="col-sm-3 text-end control-label col-form-label" >{{translate('ايقون الموقع')}}</label>
                    <div class="col-sm-9">
                    <div class="input-group" data-toggle="aizuploader" data-type="image">
                        <div class="input-group-prepend">
                            <div class="input-group-text bg-soft-secondary">{{ translate('Browse') }}</div>
                        </div>
                        <div class="form-control file-amount">{{ translate('Choose Files') }}</div>
                        <input type="hidden" name="types[]" value="site_icon">
                        <input type="hidden" name="site_icon" value="{{ get_setting('site_icon') }}" class="selected-files">
                    </div>
                    <div class="file-preview box sm"></div>
                    <small>{{ translate('Will be used in admin panel topbar in mobile') }}</small>
                    </div>
                </div>



            <div class="p-3 ">
                <div class="text-end">
                    <button type="submit" class="btn btn-info rounded-pill px-4 waves-effect waves-light">   {{translate('حفظ')}}</button>

                </div>
            </div>
        </form>

        <div class=" mb-3 row ">
        <label  class="col-sm-3 text-end control-label col-form-label">{{translate('تفعيل وضع الصيانة')}}</label>
        <div class="col-sm-9">
            <div class="mb-2 mb-sm-0 d-inline-block  form-check form-switch">
                <input type="checkbox" data-toggle="toggle" data-onstyle="outline-success" data-offstyle="outline-danger" onchange="updateSettings(this, 'maintenance_mode')" <?php if(get_setting('maintenance_mode') == 1) echo "checked";?>  >

            </div>
        </div>
        </div>
    </div>
</div>
