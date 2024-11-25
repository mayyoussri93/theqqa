@extends('backend.layouts.app')

@section('content')
    <div class="page-wrapper">

        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="row page-titles">
            <div class="col-md-5 col-12 align-self-center">
                <h3 class="text-themecolor mb-0">{{translate('جميع المشتركين')}}</h3>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{route('website.main')}}">{{translate('الصفحة الرئيسية')}}</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0)">{{translate('التسويق')}}</a></li>
                    <li class="breadcrumb-item active">{{translate('المشتركين')}}</li>
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

                <!-- Modal -->
                <div class="card card-body">
                    <div class="table-responsive  table-sm ">
                        <table class="table  table-sm  search-table    table-hover table-striped table-bordered display">
                             <thead class="bg-success text-white">
                            <th>
                                 #
                            </th>
                            <th>{{translate('البريد الالكترونى')}}</th>
                            <th>{{translate('التاريخ')}}</th>
                            <th>{{translate('الاجراءات')}}</th>
                            </thead>
                            <tbody>
                            <!-- row -->
                                @foreach($subscribers as $key => $subscriber)

                                <tr class="search-items">
                                    <td>
                                  {{$key+1}}
                                    </td>
                                    <td><div class="text-truncate">{{ $subscriber->email }}</div></td>
                                    <td>{{ date('d-m-Y', strtotime($subscriber->created_at)) }}</td>
                                    <td>
                                        @if(Auth::user()->user_type == 'admin' ||  in_array('19', json_decode(Auth::user()->staff->role->permissions)))

                                            <div class="btn-group">
                                                <button type="button" class="btn btn-light-secondary text-secondary dropdown-toggle"
                                                        data-bs-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">
                                                    <i class="fas fa-cog"></i>
                                                </button>
                                                <div class="dropdown-menu">
                                            <a href="javascript:void(0)" class="dropdown-item delete "  data-href="{{route('subscriber.destroy', $subscriber->id)}}">{{translate('مسح')}}</a>
                                                </div>

                                                </div>
                                        @endif
                                    </td>
                                </tr>
                                <!-- /.row -->
                            @endforeach
                            </tbody>
                        </table>
                        <div class="aiz-pagination">
                            {{ $subscribers->appends(request()->input())->links() }}
                        </div>
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

        <!-- -------------------------------------------------------------- -->
        <!-- End footer -->
        <!-- -------------------------------------------------------------- -->

    </div>
@endsection

@section('modal')
@endsection

@section('script')
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
                $(".delete").on("click", function (event) {

                    event.preventDefault();
                    $(this).parents(".search-items").remove();
                    var a = $(this).data("href");
                    $.get(a, {_token:'{{ @csrf_token() }}'}, function(data){


                        AIZ.plugins.notify('success', "{{translate('تم الحذف بنجاح')}}");

                    })
                    /* Act on the event */
                });
            }



            {{--$(".delete-multiple").on("click", function () {--}}
            {{--    var inboxCheckboxParents = $(".contact-chkbox:checked").parents(--}}
            {{--        ".search-items"--}}
            {{--    );--}}


            {{--    inboxCheckboxParents.remove();--}}
            {{--    var a = "{{route('recruitment_steps.all')}}";--}}
            {{--    $.get(a, function(data){--}}
            {{--        AIZ.plugins.notify('success', "{{translate('تم الحذف بنجاح')}}");--}}

            {{--    })--}}




            {{--});--}}

            deleteContact();

        });




    </script>
@endsection