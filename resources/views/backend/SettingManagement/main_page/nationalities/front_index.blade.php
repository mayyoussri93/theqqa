<div class="card card-body">
    <div class="table-responsive  table-sm ">
        <table class="table  table-sm  search-table    table-hover table-striped table-bordered display">
            <thead class="bg-success text-white">
            <th>
                #
            </th>
            <th>{{translate('الاسم')}}</th>
            <th>{{translate('متاح فى الصفحة الرئيسية')}}</th>
            </thead>
            <tbody>
            <!-- row -->
{{--            @foreach(\App\Models\Nationality::get() as $key => $country)--}}

{{--                <tr class="search-items">--}}
{{--                    <td>--}}
{{--                        {{$key+1}}--}}
{{--                    </td>--}}
{{--                    <td>--}}
{{--                        <div class="d-flex align-items-center">--}}
{{--                            <div class="ms-3">--}}
{{--                                <div class="user-meta-info">--}}
{{--                                    <h6 class="user-name mb-0 font-weight-medium" data-name="{{ $country->name }}">{{ $country->name }}</h6>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </td>--}}




{{--                    <td>--}}
{{--                        <div class="mb-2 mb-sm-0 d-inline-block"><input type="checkbox"  data-toggle="toggle" data-onstyle="info" onchange="update_status2(this)" value="{{ $country->id }}" type="checkbox" <?php if($country->apper_home == 1) echo "checked";?>></div>--}}
{{--                    </td>--}}

{{--                </tr>--}}
{{--                <!-- /.row -->--}}
{{--            @endforeach--}}
            </tbody>
        </table>
    </div>
</div>