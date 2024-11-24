@extends('backend.layouts.app')

@section('content')
    <div class="page-wrapper">

        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="row page-titles">
            <div class="col-md-5 col-12 align-self-center">
                <h3 class="text-themecolor mb-0">{{translate('اعدادات')}}</h3>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{route('website.main')}}">{{translate('الصفحة الرئيسية')}}</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0)">{{translate('الاعدادات')}}</a></li>
                    <li class="breadcrumb-item active">{{translate('Stmp')}}</li>
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
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-megna rounded-top">
                <h5 class="text-white card-title">{{translate('SMTP Settings')}}</h5>
            </div>
            <div class="card-body">
                <form class="form-horizontal" action="{{ route('env_key_update.update') }}" method="POST">
                    @csrf
                    <div class="form-group row  mb-3">
                        <input type="hidden" name="types[]" value="MAIL_DRIVER">
                        <label >{{translate('Type')}}</label>

                            <select class="form-control  mb-2 mb-md-0" name="MAIL_DRIVER" onchange="checkMailDriver()">
                                <option value="sendmail" @if (env('MAIL_DRIVER') == "sendmail") selected @endif>{{ translate('Sendmail') }}</option>
                                <option value="smtp" @if (env('MAIL_DRIVER') == "smtp") selected @endif>{{ translate('SMTP') }}</option>
                                <option value="mailgun" @if (env('MAIL_DRIVER') == "mailgun") selected @endif>{{ translate('Mailgun') }}</option>
                            </select>

                    </div>
                    <div id="smtp">
                        <div class="form-group row  mb-3">
                            <input type="hidden" name="types[]" value="MAIL_HOST">

                                <label class="col-from-label">{{translate('MAIL HOST')}}</label>

                                <input type="text" class="form-control" name="MAIL_HOST" value="{{  env('MAIL_HOST') }}"  placeholder="{{ translate('MAIL HOST') }}">

                        </div>
                        <div class="form-group row  mb-3">
                            <input type="hidden" name="types[]" value="MAIL_PORT">

                                <label class="col-from-label">{{translate('MAIL PORT')}}</label>

                                <input type="text" class="form-control" name="MAIL_PORT" value="{{  env('MAIL_PORT') }}" placeholder="{{ translate('MAIL PORT') }}">
                        </div>
                        <div class="form-group row  mb-3">
                            <input type="hidden" name="types[]" value="MAIL_USERNAME">

                                <label class="col-from-label">{{translate('MAIL USERNAME')}}</label>

                                <input type="text" class="form-control" name="MAIL_USERNAME" value="{{  env('MAIL_USERNAME') }}" placeholder="{{ translate('MAIL USERNAME') }}">
                        </div>
                        <div class="form-group row  mb-3">
                            <input type="hidden" name="types[]" value="MAIL_PASSWORD">

                                <label class="col-from-label">{{translate('MAIL PASSWORD')}}</label>

                                <input type="text" class="form-control" name="MAIL_PASSWORD" value="{{  env('MAIL_PASSWORD') }}" placeholder="{{ translate('MAIL PASSWORD') }}">

                        </div>
                        <div class="form-group row  mb-3">
                            <input type="hidden" name="types[]" value="MAIL_ENCRYPTION">

                                <label class="col-from-label">{{translate('MAIL ENCRYPTION')}}</label>

                                <input type="text" class="form-control" name="MAIL_ENCRYPTION" value="{{  env('MAIL_ENCRYPTION') }}" placeholder="{{ translate('MAIL ENCRYPTION') }}">

                        </div>
                        <div class="form-group row  mb-3">
                            <input type="hidden" name="types[]" value="MAIL_FROM_ADDRESS">

                                <label class="col-from-label">{{translate('MAIL FROM ADDRESS')}}</label>

                                <input type="text" class="form-control" name="MAIL_FROM_ADDRESS" value="{{  env('MAIL_FROM_ADDRESS') }}" placeholder="{{ translate('MAIL FROM ADDRESS') }}">

                        </div>
                        <div class="form-group row  mb-3">
                            <input type="hidden" name="types[]" value="MAIL_FROM_NAME">

                                <label class="col-from-label">{{translate('MAIL FROM NAME')}}</label>

                                <input type="text" class="form-control" name="MAIL_FROM_NAME" value="{{  env('MAIL_FROM_NAME') }}" placeholder="{{ translate('MAIL FROM NAME') }}">

                        </div>
                    </div>
                    <div id="mailgun">
                        <div class="form-group row  mb-3">
                            
                            <input type="hidden" name="types[]" value="MAILGUN_DOMAIN">

                                <label class="col-from-label">{{translate('MAILGUN DOMAIN')}}</label>

                                <input type="text" class="form-control" name="MAILGUN_DOMAIN" value="{{  env('MAILGUN_DOMAIN') }}" placeholder="{{ translate('MAILGUN DOMAIN') }}">

                        </div>
                        <div class="form-group row  mb-3">
                            <input type="hidden" name="types[]" value="MAILGUN_SECRET">
                                <label class="col-from-label">{{translate('MAILGUN SECRET')}}</label>

                                <input type="text" class="form-control" name="MAILGUN_SECRET" value="{{  env('MAILGUN_SECRET') }}" placeholder="{{ translate('MAILGUN SECRET') }}">
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
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">

            <div class="card-header bg-megna rounded-top">
                <h5 class="text-white card-title">{{translate('SMTP تجربة اعدادات')}}</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('test.smtp') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <input type="email" class="form-control" name="email" value="{{ auth()->user()->email }}" placeholder="{{ translate('Enter your email address') }}">
                        </div>
                        <div class="button-group text-end">
                            <button type="submit" class="btn btn-success l px-4">
                                <div class="d-flex align-items-center">
                                    <i data-feather="save" class="feather-sm me-1 fill-icon"></i>
                                    {{translate('ارسال بريد تجريبى')}}
                                </div>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="card">
            <div class="card-header bg-megna rounded-top">
                <h5 class="text-white card-title">{{translate('الخطوات')}}</h5>
            </div>
            <div class="card-body">
                <p class="text-danger">{{ translate('Please be carefull when you are configuring SMTP. For incorrect configuration you will get error at the time of order place, new registration, sending newsletter.') }}</p>
                <h6 class="text-muted">{{ translate('For Non-SSL') }}</h6>
                <ul class="list-group">
                    <li class="list-group-item text-dark">{{ translate('Select sendmail for Mail Driver if you face any issue after configuring smtp as Mail Driver ') }}</li>
                    <li class="list-group-item text-dark">{{ translate('Set Mail Host according to your server Mail Client Manual Settings') }}</li>
                    <li class="list-group-item text-dark">{{ translate('Set Mail port as 587') }}</li>
                    <li class="list-group-item text-dark">{{ translate('Set Mail Encryption as ssl if you face issue with tls') }}</li>
                </ul>
                <br>
                <h6 class="text-muted">{{ translate('For SSL') }}</h6>
                <ul class="list-group mar-no">
                    <li class="list-group-item text-dark">{{ translate('Select sendmail for Mail Driver if you face any issue after configuring smtp as Mail Driver') }}</li>
                    <li class="list-group-item text-dark">{{ translate('Set Mail Host according to your server Mail Client Manual Settings') }}</li>
                    <li class="list-group-item text-dark">{{ translate('Set Mail port as 465') }}</li>
                    <li class="list-group-item text-dark">{{ translate('Set Mail Encryption as ssl') }}</li>
                </ul>
            </div>
        </div>
    </div>
</div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')

    <script type="text/javascript">
        $(document).ready(function(){
            checkMailDriver();
        });
        function checkMailDriver(){
            if($('select[name=MAIL_DRIVER]').val() == 'mailgun'){
                $('#mailgun').show();
                $('#smtp').hide();
            }
            else{
                $('#mailgun').hide();
                $('#smtp').show();
            }
        }
    </script>

@endsection
