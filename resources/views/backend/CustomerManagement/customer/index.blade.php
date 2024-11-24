@extends('backend.layouts.app')

@section('content')
    <div class="page-wrapper">

        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="row page-titles">
            <div class="col-md-5 col-12 align-self-center">
                <h3 class="text-themecolor mb-0">{{translate('جميع العملاء')}}</h3>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a
                                href="{{route('website.main')}}">{{translate('الصفحة الرئيسية')}}</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0)">{{translate('العملاء')}}</a></li>
                    <li class="breadcrumb-item active">{{translate('قائمة العملاء')}}</li>
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
                    <div class=" card-body  collapse show">

{{--                        <form class="" id="sort_customers" action="" method="GET">--}}
{{--                            @csrf--}}
                            <div class="row">
                                <div class="col-md-3">
                                    <input type="text" class="form-control" id="sort_search" name="sort_search"
                                           @isset($sort_search) value="{{ $sort_search }}"
                                           @endisset placeholder="{{translate('ابحث فى العملاء')}}">
                                </div>
                                <div class="col-md-4">

                                    <div class='input-group mb-3'>
                                        <input type='text' class="form-control aiz-date-range" id="date_range"
                                               name="date_range"
                                               @isset($date_range) value="{{ $date_range }}" @endisset
                                               placeholder="{{ translate('مدى التاريخ') }}"
                                               data-separator=" - " autocomplete="off" data-advanced-range="true"/>

                                        <span class="input-group-text">
                                            <i data-feather="calendar" class="feather-sm"></i>
                                        </span>

                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <select class="form-control " id="status" name="status">
                                        <option value=" ">{{ translate('اختار الحالة') }}</option>
                                        <option value="1"
                                                @if ($status == 1) selected @endif>{{ translate('محجوز') }}</option>
                                        <option value="2"
                                                @if ($status == 2) selected @endif>{{ translate('غير محجوز') }}</option>
                                    </select>
                                </div>
                                <div class="col-md-2 text-end">

                                @if(count($_GET)>0 )

                                    <a href="{{route('customers.index')}}"  id="cancel_request" class="btn btn-danger">
                                        {{translate('إلغاء البحث')}}
                                    </a>
                                    @endif
                                        <button id="btnSubmit" class="btn btn-info">
                                            {{translate('بحث')}}
                                        </button>




                                </div>
                                </div>
{{--                        </form>--}}
                            </div>
                    <div class="card-footer  bg-white ">
                        <div class="text-end ">
                            {{--                                    <div class="action-btn show-btn">--}}
                            @if(Auth::user()->user_type == 'admin' || in_array('3', json_decode(Auth::user()->staff->role->permissions)))
                            <a href="javascript:void(0)"
                               class="  delete-multiple btn-outline-orange btn me-2  ">
                                <i data-feather="trash-2" class="feather-sm fill-white me-1"></i>
                                {{translate('مسح جميع المحدد')}}</a>
                            @endif
                            @if(Auth::user()->user_type == 'admin' || in_array('149', json_decode(Auth::user()->staff->role->permissions)))
                                <a href="javascript:void(0)"
                                   class="  ban-multiple btn-outline-orange btn me-2  ">
                                    <i data-feather="slash" class="feather-sm fill-white me-1"></i>
                                    {{translate('تعليق العملاء')}}</a>
                            @endif
                        </div>
                    </div>

                </div>


                </div>



            <!-- Modal -->
            <div class="card card-body">
                <div class="table-responsive  table-sm ">
                    <table class="table  table-sm  search-table table-striped table-bordered display v-middle"
                           id="customer_list">
                        <thead class="bg-success text-white headf">
                        <th>
                         #
                        </th>
                        <th>{{translate('اسم العميل')}}</th>
                        <th>{{translate('الهاتف')}}</th>
                        <th data-breakpoints="lg">{{translate('تاريخ التسجيل')}}</th>
                        <th>{{translate('حالة المستخدم')}}</th>
                        <th>{{translate('يوجد حجز')}}</th>
                        <th>{{translate('الاجراءات')}}</th>
                        </thead>
                        <tbody class="bodyf">

                        </tbody>
                    </table>
                    {{--                                            <div class="aiz-pagination">--}}
                    {{--                                                {{ $customers->appends(request()->input())->links() }}--}}
                    {{--                                            </div>--}}
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

    <div class="modal fade" id="reservation_user" tabindex="-1" role="dialog" aria-labelledby="addContactModalTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header d-flex align-items-center">
                    <h5 class="modal-title">{{translate('حجز السيرة الذاتيه')}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="addContactModalTitle" class="needs-validation"
                      action="{{ route('booking_cv_request.store') }}" method="POST">
                    <div class="modal-body">
                        <div class="add-contact-box">
                            <div class="add-contact-content">
                                @csrf
                                <div class="form-group row">

                                    <input type="hidden" name="customer_id" id="customer_id">
                                    <div class="mb-3">
                                        <label>{{ translate('اختار السيرة الذاتية') }}</label>
                                        <select class="form-control select2 " data-live-search="true" style="width: 100%; height:36px;" name="cv_id" required>
                                            <option value=" ">   {{translate('اختر السيرة')}} </option>
                                            @foreach(\App\Models\Cv::isRecruitment()->sold()->booking()->get() as $key=>$val)
                                                <option value="{{$val->id}}"
                                                        @if($val->id == old('cv_id')) selected @endif>   {{$val->passport_id}}</option>
                                            @endforeach

                                        </select>
                                        <div class="valid-feedback">
                                            {{translate("برجاء اختار السيرة الذاتية")}}

                                        </div>
                                    </div>

                                </div>

                                @if(Auth::user()->user_type == 'admin')
                                    <div class="form-group row ">
                                        <div class="mb-3">
                                            <label>{{ translate('الطلب تابع') }}</label>

                                            <select class="form-control" data-live-search="true" name="administrator_id"
                                                    required>
                                                <option value="">   {{translate('اختر المندوب')}} </option>
                                                @foreach(\App\Models\Staff::whereHas('user')->where('apper_back',1)->get() as $key=>$val)
                                                    <option value="{{$val->user->id}}"
                                                            @if($val->user->id == old('administrator_id')) selected @endif>   {{$val->user->name}}</option>
                                                @endforeach
                                            </select>
                                            <div class="valid-feedback">
                                                {{translate("برجاء اختار المندوب")}}

                                            </div>
                                        </div>
                                    </div>
                                @endif


                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success  px-4">{{translate('حفظ')}}</button>
                        <button type="button" class="btn btn-danger  px-4"
                                data-bs-dismiss="modal"> {{translate('اغلاق')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


        <div class="modal fade" id="sendSmsModal" tabindex="-1" role="dialog" aria-labelledby="addnotesmodalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content border-0">
                <div class="modal-header bg-info text-white">
                    <h5 class="modal-title text-white">{{translate('ارسال رسالة نصية')}}</h5>
                    <button type="button" class=" btn-close btn-close-white close"  data-bs-dismiss="modal" aria-label="Close">
                    </button>

                </div>
                <form   class="needs-validation" action="{{route('massage.send')}}"
                      enctype="multipart/form-data"
                      method="POST" novalidate>
                    <div class="modal-body">
                        <div class="add-contact-box">
                            <div class="add-contact-content">
                                @csrf
                                <input type="hidden" name="user_id" id="user_id">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3 contact-cost">
                                            <label class="">{{ translate('ارسال رسالة نصيه') }}</label>
                                            <textarea id="textarea1" name="content" placeholder="{{translate('ارسال رسالة')}}" class="message-type-box form-control border-8 required" type="text" required></textarea>


                                            <span class="validation-text text-danger"></span>
                                        </div>
                                    </div>
                                </div>

                                <br>

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button  type="submit"  class="btn btn-success  px-4">{{translate('ارسال')}}</button>
                        <button type="button" class="btn btn-danger  px-4" data-bs-dismiss="modal"> {{translate('غلق')}}</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

@endsection

@section('modal')
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
        var table = $('#customer_list').DataTable({
                dom: 'Bflrtip',
                searching: false,
               "processing": true,
               "serverSide": true,
                 "orderClasses": false,  "ordering": false ,
               "deferRender": true,


            "lengthMenu": [
                [10,50,100,1000, 2000, 3000, -1],
                [10,50,100,1000, 2000, 3000, 'All'],
            ],



            ajax: {
                    url: "{{ route('customers.index') }}",
                    data: function (d) {
                            d.status=$('#status').val(),
                            d.date_range=$('#date_range').val(),
                            d.sort_search=$('#sort_search').val()
                    }
                },
                columns: [
                    {
                        "data": 'choose'
                    },
                    {data: 'name', name: 'name'},
                    {data: 'phone', name: 'phone'},
                    {data: 'created_at', name: 'created_at'},

                    {data: 'user_status', name: 'user_status'},

                    {data: 'status', name: 'status'},
                    {data: 'actions', name: 'actions'},
                ],
                buttons: [
                    {
                        extend: 'print',
                        text: 'طباعة',
                        title:"قائمة العملاء",
                        exportOptions: {
                            columns: [ 1,2,3,4]
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
                        title:"قائمة العملاء",
                        exportOptions: {
                            columns: [ 1,2,3,4]
                        },
                    }





                ],
            createdRow: function (row, data, index) {
                //
                // if the second column cell is blank apply special formatting
                //

                    $(row).addClass("search-items");

            },
                fixedColumns:   {
                    left: 1,
                    right: 1
                },
                "pageLength": 10,
                "paging": true
            });
function send_sms(id) {
            $("#sendSmsModal").modal("show");
            $('#user_id').val(id);
            // if(status !="sms"){
            //     $('#status').val('pending');
            // }

        }

        $("#btnSubmit").click(function(){
             if($("#cancel_request").html()==undefined && $('.cancel_request_add').hide())  {
                $('   <a  href="{{route('customers.index')}}" class="btn btn-danger  cancel_request_add " style="margin:5px 5px 5px 5px;">{{translate('إلغاء البحث')}}</a>').insertAfter("#btnSubmit");
            }
            table.ajax.reload();
        });


        $('.buttons-copy, .buttons-csv, .buttons-print, .buttons-pdf, .buttons-excel').addClass('btn btn-primary mr-1');
    </script>
    <script type="text/javascript">
        $(function () {

            $('#reservation_user .select2').select2({
                dropdownParent: $('#reservation_user')
            });
            $("#btn-add-contact").on("click", function (event) {
                $("#addContactModal #btn-add").show();
                $("#addContactModal #btn-edit").hide();
                $("#addContactModal").modal("show");
            });



            function deleteContact() {

                    $(document).on('click', '.delete', function (event) {
                    event.preventDefault();
                    var tr=  $(this);
                    var a = $(this).data("href");
                    $.get(a, {_token: '{{ @csrf_token() }}'}, function (data) {
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
                $(".contact-chkbox:checked").each(function () {// iterate over same class spans
                    span_array.push($(this).val());// push span text to array
                });
                var final_string = span_array.join(); //join array value as string
                var data = {ids: final_string};
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{route('bulk-customer-delete')}}",
                    type: 'POST',
                    data: data,
                    cache: false,

                    success: function (response) {
                        if (response == 1) {
                            // location.reload();
                            AIZ.plugins.notify('success', 'تم المسح بنجاح للعملاء الذى ليس لديهم طلب استقدام');

                        }else {
                            AIZ.plugins.notify('error', 'رجاء تحديد العملاء');

                        }
                    }
                });


                var inboxCheckboxParents = $(".contact-chkbox:checked").parents(
                    ".search-items"
                );

                inboxCheckboxParents.remove();

            });
            $(".ban-multiple").on("click", function () {

                $(".contact-chkbox:checked").each(function () {
                    var imageURI = $(this).val();
                    console.log(imageURI);
                });

                span_array = [];//define array
                $(".contact-chkbox:checked").each(function () {// iterate over same class spans
                    span_array.push($(this).val());// push span text to array
                });
                var final_string = span_array.join(); //join array value as string
                var data = {ids: final_string};
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{route('bulk_customer_ban')}}",
                    type: 'POST',
                    data: data,
                    cache: false,

                    success: function (response) {
                        if (response == 1) {
                            // location.reload();
                            AIZ.plugins.notify('success', 'تم تعليق للعملاء المحدد');

                        }else {
                            AIZ.plugins.notify('error', 'رجاء تحديد العملاء');

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

        function reservation_user(user_id) {
            $('#reservation_user').modal('show', {backdrop: 'static'});
            $('#customer_id').val(user_id);
        }

    </script>

@endsection