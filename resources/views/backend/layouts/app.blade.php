<!doctype html>
@if (\App\Models\Language::where('code', Session::get('locale', Config::get('app.locale')))->first()->rtl == 1)
    <html dir="rtl" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @else
        <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
        @endif
        <head>
            <meta name="csrf-token" content="{{ csrf_token() }}">
            <meta name="app-url" content="{{ getBaseURL() }}">
            <meta name="file-base-url" content="{{ getFileBaseURL() }}">
            <!-- Required meta tags -->
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
            <!-- Favicon -->
            <link rel="icon" href="{{ uploaded_asset(get_setting('site_icon')) }}">
            <title>{{ get_setting('website_name') }}</title>

            <link rel="{{ route('website.main') }}" href="{{route('website.main')}}/" />


            <link href="{{static_asset('v4_assets')}}/assets/extra-libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css"
                  rel="stylesheet" type="text/css"/>
            <link href="{{static_asset('v4_assets')}}/assets/extra-libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css"
                  rel="stylesheet" type="text/css"/>

            <!-- Responsive datatable examples -->

            <link href="{{static_asset('v4_assets')}}/assets/extra-libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css"
                  rel="stylesheet" type="text/css"/>
            <link href="{{static_asset('v4_assets')}}/assets/extra-libs/datatables.net/css/jquery.dataTables.min.css"
                  rel="stylesheet" type="text/css"/>

            <?php
            $currrent_url=str_replace(url('/'), '', url()->current());
            ?>
                    <!-- Favicon icon -->
            <link rel="icon" type="image/png" sizes="16x16" href="{{ uploaded_asset(get_setting('site_icon')) }}">
            @if($currrent_url=="/admin" )
                <link rel="stylesheet" href="{{ static_asset('v4_assets/assets/libs/fullcalendar/dist/fullcalendar.min.css') }}"   />
                <link rel="stylesheet" href="{{ static_asset('v4_assets/assets/libs/apexcharts/dist/apexcharts.css') }}">
            @endif
            <link rel="stylesheet" type="text/css" href="{{ static_asset('v4_assets/assets/libs/daterangepicker/daterangepicker.css') }}">
            @if($currrent_url!="/admin" )
                <link rel="stylesheet" href="{{ static_asset('v4_assets/assets/extra-libs/custom-switch/bootstrap4-toggle.min.css') }}">
                <link href="{{ static_asset('v4_assets/assets/extra-libs/datatables.net-bs4/css/dataTables.bootstrap4.css') }}" rel="stylesheet">
                <link rel="stylesheet" href="{{ static_asset('v4_assets/assets/libs/select2/dist/css/select2.min.css') }}">
                <link rel="stylesheet" type="text/css" href="{{ static_asset('v4_assets/assets/libs/jquery-steps/jquery.steps.css') }}">
                <link rel="stylesheet" type="text/css" href="{{ static_asset('v4_assets/assets/libs/jquery-steps/steps.css') }}">
            @endif
            <!-- Custom CSS -->
            <link rel="stylesheet" href="{{ static_asset('v4_assets/dist/css/style.min.css') }}">

            <link rel="stylesheet" href="{{ static_asset('assets/css/aiz-core.css') }}">
            <link rel="stylesheet" href="{{ static_asset('v4_assets/bootstrap-hijri-datepicker/css/bootstrap-datetimepicker.min.css') }}">
            <script>
                var AIZ = AIZ || {};
                AIZ.local = {
                    nothing_selected: '{{ translate('Nothing selected') }}',
                    nothing_found: '{{ translate('Nothing found') }}',
                    choose_file: '{{ translate('اختار الملف') }}',
                    file_selected: '{{ translate('File selected') }}',
                    files_selected: '{{ translate('Files selected') }}',
                    add_more_files: '{{ translate('Add more files') }}',
                    adding_more_files: '{{ translate('Adding more files') }}',
                    drop_files_here_paste_or: '{{ translate('Drop files here, paste or') }}',
                    browse: '{{ translate('Browse') }}',
                    upload_complete: '{{ translate('Upload complete') }}',
                    upload_paused: '{{ translate('Upload paused') }}',
                    resume_upload: '{{ translate('Resume upload') }}',
                    pause_upload: '{{ translate('Pause upload') }}',
                    retry_upload: '{{ translate('Retry upload') }}',
                    cancel_upload: '{{ translate('Cancel upload') }}',
                    uploading: '{{ translate('Uploading') }}',
                    processing: '{{ translate('Processing') }}',
                    complete: '{{ translate('Complete') }}',
                    file: '{{ translate('File') }}',
                    files: '{{ translate('Files') }}',
                }
            </script>

            <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
            <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
            <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
            <![endif]-->

        </head>

        <body class="">
        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <div class="loader">
            <span class="spinner"></span>
        </div>
        <!-- ============================================================== -->
        <!-- Main wrapper - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <div id="main-wrapper">
            <!-- ============================================================== -->
            <!-- Topbar header - style you can find in pages.scss -->
            <!-- ============================================================== -->
            @include('backend.inc.admin_nav')

            <!-- ============================================================== -->
            <!-- End Topbar header -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Left Sidebar - style you can find in sidebar.scss  -->
            <!-- ============================================================== -->
            @include('backend.inc.admin_sidenav')


            <!-- ============================================================== -->
            <!-- End Left Sidebar - style you can find in sidebar.scss  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Page wrapper  -->
            <!-- ============================================================== -->

            @yield('content')


            <!-- ============================================================== -->
            <!-- End Page wrapper  -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Wrapper -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- customizer Panel -->
        <!-- ============================================================== -->
        {{--        @include('backend.inc.logs')--}}

        @yield('modal')

        <script  src="{{ static_asset('assets/js/vendors.js') }}"></script>
        <script  src="{{ static_asset('assets/js/aiz-core.js') }}"></script>

        <script src="{{ static_asset('v4_assets/assets/libs/jquery/dist/jquery.min.js') }}"></script>
        <!-- Bootstrap tether Core JavaScript -->

        <script src="{{ static_asset('v4_assets/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
        <!-- apps -->
        <script src="{{ static_asset('v4_assets/dist/js/app.min.js') }}"></script>
        <script src="{{ static_asset('v4_assets/dist/js/app.init.js') }}"></script>
        {{--  <script src="{{ static_asset('v4_assets/dist/js/app-style-switcher.js') }}"></script>--}}
        <!-- slimscrollbar scrollbar JavaScript -->
        <script src="{{ static_asset('v4_assets/assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js') }}">
        </script>
        <script src="{{ static_asset('v4_assets/assets/extra-libs/sparkline/sparkline.js') }}"></script>
        <!--Wave Effects -->
        <script src="{{ static_asset('v4_assets/dist/js/waves.js') }}"></script>
        <!--Menu sidebar -->
        <script src="{{ static_asset('v4_assets/dist/js/sidebarmenu.js') }}"></script>
        <!--Custom JavaScript -->
        <script src="{{ static_asset('v4_assets/dist/js/feather.min.js') }}"></script>
        <script src="{{ static_asset('v4_assets/dist/js/custom.min.js') }}"></script>
        <script  src="{{ static_asset('v4_assets/assets/libs/daterangepicker/daterangepicker.js') }}"></script>
        <script  src="{{ static_asset('v4_assets/assets/libs/jquery-validation/dist/jquery.validate.min.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/jquery.validation/1.15.0/additional-methods.min.js"></script>

        <!-- Required datatable js -->
        <script src="{{static_asset('v4_assets')}}/assets/extra-libs/datatables.net/js/jquery.dataTables.min.js"></script>
        <script src="{{static_asset('v4_assets')}}/assets/extra-libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
        <!-- Buttons examples -->
        <!-- Responsive examples -->
        <script src="{{static_asset('v4_assets')}}/assets/extra-libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
        <script
                src="{{static_asset('v4_assets')}}/assets/extra-libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>

        <!--This page JavaScript -->
        @if($currrent_url=="/admin" )
            <script src="{{static_asset('v4_assets/assets/libs/moment/min/moment.min.js')}}"></script>
            <script src="{{ static_asset('v4_assets/assets/libs/fullcalendar/dist/fullcalendar.min.js') }}"></script>
            <script  src="{{ static_asset('v4_assets/assets/libs/apexcharts/dist/apexcharts.min.js') }}"></script>
        @endif
        {{--    <script src="{{ static_asset('v4_assets/assets/extra-libs/prism/prism.js') }}"></script>--}}


        @if($currrent_url!="/admin" )
            <script src="{{ static_asset('v4_assets/assets/extra-libs/custom-switch/bootstrap4-toggle.min.js') }}"></script>
            <script src="{{ static_asset('v4_assets/assets/libs/select2/dist/js/select2.full.min.js') }}"></script>
            <script src="{{ static_asset('v4_assets/assets/libs/select2/dist/js/select2.min.js') }}"></script>
            <script src="{{ static_asset('v4_assets/dist/js/pages/forms/select2/select2.init.js') }}"></script>
        @endif

        @yield('script')

        <script type="text/javascript">
            (function () {
                'use strict';
                if(jQuery.validator) {
                    jQuery.extend(jQuery.validator.messages, {
                        required: "برجاء ادخال الحقل",
                        email: "الرجاء إدخال عنوان بريد إلكتروني صالح",
                        url: "الرجاء إدخال عنوان URL صالح",
                        date: "الرجاء إدخال تاريخ صالح.",
                        number: "لرجاء إدخال أرقام فقط",
                        maxlength: jQuery.validator.format("يُرجى عدم إدخال أكثر من {0} حرفًا"),
                        minlength: jQuery.validator.format("يُرجى إدخال {0} حرفًا على الأقل."),
                        rangelength: jQuery.validator.format("الرجاء إدخال قيمة يتراوح طولها بين {0} و {1} حرفًا."),
                        range: jQuery.validator.format("الرجاء إدخال قيمة بين {0} و {1}."),
                        max: jQuery.validator.format("الرجاء إدخال قيمة أقل من أو تساوي {0}"),
                        min: jQuery.validator.format("الرجاء إدخال قيمة أكبر من أو تساوي {0}."),
                        digits:"برجاء ادخال ارقام فقط",
                        accept:"برجاء ادخال الملف بالصيغة الصحيحة",
                        pattern:"برجاء ادخال الحقل بالصيغة المطلوبة",
                        equalTo:"يجب ان تكون كلمة المرور وتاكيد كلة المرور متماثلتان"
                    });
                }
            })();
            $('.daterange').on('click', function(e) {
                e.preventDefault();
                $(this).attr("autocomplete", "off");
            });

            $('.daterange').daterangepicker({
                autoUpdateInput: false,
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf(
                        'month')]
                }
            });
            @foreach (session('flash_notification', collect())->toArray() as $message)
            AIZ.plugins.notify('{{ $message['level'] }}', '{{ $message['message'] }}');
            @endforeach
            function change_lang_new(locale) {
                console.log(locale);
                $.post('{{ route('language.change') }}', {
                    _token: '{{ csrf_token() }}',
                    locale: locale
                }, function(data) {
                    location.reload();
                });
            }
            if ($('#lang-change').length > 0) {
                $('#lang-change .dropdown-menu a').each(function() {
                    $(this).on('click', function(e) {
                        e.preventDefault();
                        var $this = $(this);
                        var locale = $this.data('flag');
                        $.post('{{ route('language.change') }}', {
                            _token: '{{ csrf_token() }}',
                            locale: locale
                        }, function(data) {
                            location.reload();
                        });
                    });
                });
            }

            function update_seen_notfication(id, link) {
                $.post('{{ route('update_admin_seen_notfication') }}', {
                    _token: '{{ csrf_token() }}',
                    id: id
                }, function(data) {
                    console.log(link);
                    window.location.href = link;
                    // $('#bid_for_project').modal('show');
                    // $('#bid_for_modal_body').html(data);
                })
                // $('#reply_contact_us_modal').modal('show', {backdrop: 'static'});
                // $("#contact_us_id").text(id.email);
                // $("#contact_us_email_selected").val(id.email);
            }
        </script>

        </body>

        </html>
