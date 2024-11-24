@extends('backend.layouts.app')

@section('content')
    <div class="page-wrapper">

        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="row page-titles">
            <div class="col-md-5 col-12 align-self-center">
                <h3 class="text-themecolor mb-0">{{translate('جميع اتصل بنا')}}</h3>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{route('website.main')}}">{{translate('الصفحة الرئيسية')}}</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0)">{{translate('الدعم')}}</a></li>
                    <li class="breadcrumb-item active">{{translate('اتصل بنا')}}</li>
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
                    <div class="card-header  d-flex align-items-center bg-purple">
                        <h4 class="card-title mb-0 text-white"> {{translate('بحث')}}</h4>
                        <div class="card-actions ms-auto">
                            <a class="text-white " data-action="collapse"><i class="ti-minus"></i></a>
                            <a class="text-white ms-1" data-action="close">X</a>
                        </div>
                    </div>
                    <div class=" card-body">

                            <div class="row">
                                <div class="col-md-2 ">
                                    <input type="text" class="form-control product-search" id="search" name="search"  @isset($sort_search) value="{{ $sort_search }}" @endisset placeholder="{{translate('ابحث بالاسم ورقم الهاتف')}}">
                                </div>
                                <div class="col-md-2 ">
                                    <input type="text" class="form-control  aiz-date-range" id="data" name="date"  placeholder="{{ translate('مدى التاريخ') }}"
                                           data-separator=" - "  autocomplete="off"  data-advanced-range="true"  value="{{$date}}">
                                </div>


                                <div class="col-md-2 ">
                                <select class="form-control form-select select2"
                                        data-placeholder="{{translate('اختار الموضوع')}}"
                                        tabindex="1"  name="subject_status" id="booking_status" >
                                    <option value="" selected >{{translate('اختار الموضوع')}}</option>
                                    <option value="استفسار" @if ($subject_status == 'استفسار') selected @endif> {{translate('استفسار')}}</option>
                                    <option value="شكوي" @if ($subject_status == 'شكوي') selected @endif>{{translate('شكوي')}}</option>
                                    <option value="اقتراح" @if ($subject_status == 'اقتراح') selected @endif>{{translate('اقتراح')}}</option>

                                </select>
                                </div>
                                <div class="col-md-2 ">
                                    <select class="form-control form-select select2"
                                            data-placeholder="{{translate('اختار الحالة')}}"
                                            tabindex="1"  name="status" id="status" >
                                        <option value="" selected >{{translate('اختار الحالة')}}</option>
                                        <option value="1" @if ($status == '1') selected @endif> {{translate('تم التواصل')}}</option>
                                        <option value="0" @if ($status == '0') selected @endif>{{translate('لم يتم التواصل')}}</option>

                                    </select>
                                </div>

                                <div class="col-md-4 text-end">

                                    @if(count($_GET)>0 )
                                        <a  href="{{ route('contact_us.index') }}" id="cancel_request" class="btn btn-danger">{{translate('إلغاء البحث')}}</a>
                                    @endif
                                    <button id="btnSubmit" type="submit" class="btn btn-info">{{translate('بحث')}}</button>
                                </div>

                            </div>
{{--                        </form>--}}
                    </div>

                </div>
                <!-- Modal -->
                <div class="card card-body">
                <div class="table-responsive  table-sm ">
                        <table  class="table  table-sm  search-table table-striped table-bordered display v-middle" id="contact_list">
                             <thead class="bg-success text-white">
                            <th>
                                #
                            </th>
                            <th>{{translate('اسم العميل')}}</th>
                            <th>{{translate('الموضوع')}}</th>
                            <th>{{translate('الهاتف')}}</th>
                            <th>{{translate('التاريخ')}}</th>
                            <th>{{translate('الحاله')}}</th>
                            <th>{{translate('ملاحظات')}}</th>
                            <th>{{translate('الاجراءات')}}</th>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                        {{--                        <div class="aiz-pagination">--}}
                        {{--                            {{ $customers->appends(request()->input())->links() }}--}}
                        {{--                        </div>--}}
                    </div>
                </div>
            </div>
            <!-- -------------------------------------------------------------- -->
            <!-- End PAge Content -->
            <!-- -------------------------------------------------------------- -->
        </div>

        <!-- -------------------------------------------------------------- -->
        <!-- End Container fluid  -->
        <!-- -------------------------------------------------------------- -->
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
@endsection
@section('modal')



    <div class="modal fade" id="contact_us_modal" tabindex="-1" role="dialog" aria-labelledby="addContactModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header d-flex align-items-center">
                    <h5 class="modal-title">{{translate('نص الرسالة')}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="add-contact-box">
                        <div class="add-contact-content">
                            <p id="massage_contact" ></p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">

                    <button class="btn btn-danger  px-4" data-bs-dismiss="modal"> {{translate('اغلاق')}}</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="reply_contact_us_modal" tabindex="-1" role="dialog" aria-labelledby="addContactModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header d-flex align-items-center">
                    <h5 class="modal-title">{{translate('ارسال رسالة للمرسل عبر الهاتف')}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="add-contact-box">
                        <div class="add-contact-content">
                            <form id="addContactModalTitle"  action="{{ route('contact_us.send_reply') }}" method="POST" >
                                @csrf
                                <input type="hidden" name="phone" id="contact_us_phone_selected">


                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3 contact-cost">
                                            <textarea rows="8" class="form-control"  name="massage" placeholder="{{translate('المحتوى')}}" required></textarea>

                                            <span class="validation-text text-danger"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button class="btn btn-success  px-4" type="submit"> {{translate('ارسال')}}</button>

                                    <button class="btn btn-danger  px-4" data-bs-dismiss="modal"> {{translate('اغلاق')}}</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="modal fade" id="status_modal" tabindex="-1" role="dialog" aria-labelledby="addContactModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header d-flex align-items-center">
                    <h5 class="modal-title">{{translate('اضافة ملاحظة')}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="add-contact-box">
                        <div class="add-contact-content">
                            <form id="addContactModalTitle"  action="{{ route('contact_us_change_status') }}" method="POST" >
                                @csrf
                                <input type="hidden" name="id" id="contact_id">

                                {{--                                <div class="row">--}}
                                {{--                                    <div class="col-md-12">--}}
                                {{--                                        <div class="mb-3 contact-name">--}}
                                {{--                                            <input type="text"  name="subject" id="subject" class="form-control" placeholder="{{translate('الموضوع')}}" required>--}}

                                {{--                                            <span class="validation-text text-danger"></span>--}}
                                {{--                                        </div>--}}
                                {{--                                    </div>--}}
                                {{--                                </div>--}}
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3 contact-cost">
                                            <textarea rows="8" class="form-control"  name="notes" placeholder="{{translate('تسجيل ملاحظات التواصل مع العميل')}}" required></textarea>

                                            <span class="validation-text text-danger"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button class="btn btn-success  px-4" type="submit"> {{translate('ارسال')}}</button>

                                    <button class="btn btn-danger  px-4" data-bs-dismiss="modal"> {{translate('اغلاق')}}</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
@section('script')
    <script src="{{ static_asset('v4_assets/assets/extra-libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
    {{--    <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.flash.min.js"></script>--}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js"></script>
    <script>

        var table = $('#contact_list').DataTable({
                dom: 'Bflrtip',
                  searching: false,
            "processing": true,
            "serverSide": true,
              "orderClasses": false,  "ordering": false ,
            "deferRender": true,    "lengthMenu": [
                [10,50,100, -1],
                [10,50,100, 'All'],
            ],
                ajax: {
                    url: "{{ route('contact_us.index') }}",
                    data: function (d) {
                        d.search=$('#search').val(),
                            d.date=$('#data').val(),
                            d.subject_status=$('#booking_status').val(),
                            d.status = $('#status').val()


                    }

                },
                columns: [
                    {
                        "data": 'DT_RowIndex', orderable: false, searchable: false
                    },
                    {data: 'name', name: 'name'},
                    {data: 'subject', name: 'subject'},
                    {data: 'phone', name: 'phone'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'status', name: 'status'},
                    {data: 'notes', name: 'notes'},
                    {data: 'actions', name: 'actions'},


                ],
                createdRow: function (row, data, index) {
                    $(row).addClass("search-items");
                },
                buttons: [
                    {
                        extend: 'print',
                        text: 'طباعة',
                        title:"قائمة اتصل بنا",

                        exportOptions: {
                            columns: [ 1,2,3,4,5,6]
                        },
                        autoPrint: true,

                        customize: function ( win ) {
                            $(win.document.body).css('direction', 'rtl');
                            $(win.document.body)
                                .css( 'font-size', '10pt' )
                                .prepend(
                                    '<img src="https://www.rawafdnajd.sa/public/uploads/all/JCPBAUETuvcBfdMAhh9jjkqAp9L5g08SCTscSLPO.svg" style=" position:absolute; top:1px; left:0px;" width="140px" height="50px"/>'
                                );

                            $(win.document.body).find( 'table tr:first' )
                                .addClass( 'compact' )
                                .css( {'background-color':'#A505A',
                                    'color': 'white',});
                        }

                    },
                    {
                        extend: 'excel',
                        text: 'اكسيل',
                        title:"قائمة اتصل بنا",

                        exportOptions: {
                            columns: [ 1,2,3,4,5,6]
                        },
                    }





                ],
                fixedColumns:   {
                    left: 1,
                    right: 1
                },
                "pageLength": 10,
                "paging": true
            });
        $("#btnSubmit").click(function(){
            if($("#cancel_request").html()==undefined && $('.cancel_request_add').hide()) {
                $('<a href="{{route('contact_us.index')}}" class="btn btn-danger  cancel_request_add " style="margin:5px 5px 5px 5px;">{{translate('إلغاء البحث')}}</a>').insertAfter("#btnSubmit");
            }
            table.ajax.reload();
        });

        $('.buttons-copy, .buttons-csv, .buttons-print, .buttons-pdf, .buttons-excel').addClass('btn btn-primary mr-1');
    </script>
    <script type="text/javascript">

        // function show_contact_us_details(massage) {
        //     $('#contact_us_modal').modal('show', {backdrop: 'static'});
        //     $("#massage_contact").text(massage);
        //
        // }
        $(document).on('click', '.show_contact_us_details', function (event) {

            event.preventDefault();
            $('#contact_us_modal').modal('show', {backdrop: 'static'});
            $("#massage_contact").text($(this).data("msg"));
        });
        $(document).on('click', '.reply_contact_us', function (event) {
            console.log($(this).data("name"),$(this).data("email"))
            event.preventDefault();

            $('#reply_contact_us_modal').modal('show', {backdrop: 'static'});
            $("#contact_us_id").text($(this).data("name"));
            $("#contact_us_phone_selected").val($(this).data("phone"));
        });

    </script>

    <script type="text/javascript">
        $(function () {
            function checkall(clickchk, relChkbox) {
                var checker = $("#" + clickchk);
                var multichk = $("." + relChkbox);

                checker.click(function () {
                    multichk.prop("checked", $(this).prop("checked"));
                    $(".show-btn").toggle();
                });
            }

            checkall("contact-check-all", "contact-chkbox");

            $("#input-search").on("keyup", function () {
                var rex = new RegExp($(this).val(), "i");
                $(".search-table .search-items:not(.header-item)").hide();
                $(".search-table .search-items:not(.header-item)")
                    .filter(function () {
                        return rex.test($(this).text());
                    })
                    .show();
            });

            $("#btn-add-contact").on("click", function (event) {
                $("#addContactModal #btn-add").show();
                $("#addContactModal #btn-edit").hide();
                $("#addContactModal").modal("show");
            });

            function deleteContact() {
               $(document).on('click', '.delete', function (event) {
                    var tr=$(this);
                    event.preventDefault();

                    var a = $(this).data("href");
                    $.get(a, {_token:'{{ @csrf_token() }}'}, function(data){

                        tr.parents(".search-items").remove();
                        AIZ.plugins.notify('success', data.msg);

                    })
                    /* Act on the event */
                });
            }



            $(".delete-multiple").on("click", function () {

                $(".contact-chkbox:checked").each(function () {
                    var imageURI = $(this).val();
                    console.log(imageURI);
                });

                span_array = [];//define array
                $(".contact-chkbox:checked").each(function(){// iterate over same class spans
                    span_array.push($(this).val());// push span text to array
                });
                var final_string = span_array.join(); //join array value as string
                var data = {ids:final_string};
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{route('bulk-customer-delete')}}",
                    type: 'POST',
                    data: data,
                    cache: false,

                    success: function (response) {
                        if(response == 1) {
                            // location.reload();
                        }
                    }
                });


                var inboxCheckboxParents = $(".contact-chkbox:checked").parents(
                    ".search-items"
                );

                inboxCheckboxParents.remove();

            });
            deleteContact();
        });
        function change_status(id){
            $('#status_modal').modal('show', {backdrop: 'static'});
            $("#contact_id").val(id);
            // if(el.checked){
            //     var status = 1;
            // }
            // else{
            //     var status = 0;
            // }

            {{--$.post('{{ route('contact_us_change_status') }}', {_token:'{{ csrf_token() }}', id:id, status:status}, function(data){--}}
            {{--    if(data == 1){--}}
            {{--        AIZ.plugins.notify('success', 'تم تحديث الحالة بنجاح');--}}
            {{--    }--}}
            {{--    else{--}}
            {{--        AIZ.plugins.notify('danger', 'برجاء المحاولة مره اخرى');--}}
            {{--    }--}}
            {{--});--}}
        }
    </script>


@endsection