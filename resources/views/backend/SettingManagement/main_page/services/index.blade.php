
            <div class="widget-content searchable-container list">
                <div class="card card-body">
                    <div class="row">
                        <div class="col-md-4 col-xl-2">
                            <h4 class="card-title">
                                {{translate('خدمات ')}}
                            </h4>
{{--                            <form id="sort_brands" method="get">--}}
{{--                                <input type="text" class="form-control product-search" id="input-search" name="search"@isset($sort_search) value="{{ $sort_search }}" @endisset placeholder="{{translate('ابحث فى خدمتنا')}}">--}}
{{--                            </form>--}}
                        </div>
                        <div class="col-md-8 col-xl-10 text-end d-flex justify-content-md-end justify-content-center mt-3 mt-md-0">

                                <a href="{{route('services.create')}}"  class="btn btn-primary">

                                {{translate('اضافة')}}</a>
                        </div>
                    </div>
                </div>
                <!-- Modal -->
                <div class="card card-body">
                    <div class="table-responsive  table-sm ">
                        <form class="needs-validation"
                              action="{{ route('business_settings.update')}}"
                              method="POST" novalidate>
                            @csrf
                            <h4 class="card-title">
                                {{translate('خدمات ')}}
                            </h4>
                            <input type="hidden" name="types[]" value="home_service_title1">
                            <input type="hidden" name="types[]" value="home_service_title2">

                            <div class="mb-3 row">
                                <label class="col-sm-3 text-end control-label col-form-label" for="validationCustomUsername">{{translate('العنوان الرئيسى')}}</label>

                                <div class="col-sm-9">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="{{translate('العنوان الرئيسى')}}" name="home_service_title1" value="{{ get_setting('home_service_title1') }}" >
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-3 text-end control-label col-form-label" for="validationCustomUsername">{{translate('العنوان الفرعى')}}</label>

                                <div class="col-sm-9">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="{{translate('العنوان الفرع')}}" name="home_service_title2" value="{{ get_setting('home_service_title2') }}" >
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-info rounded-pill px-4 waves-effect waves-light">   {{translate('حفظ')}}</button>

                        </form>
                        <table class="table  table-sm  search-table    table-hover table-striped table-bordered display">
                             <thead class="bg-success text-white headf">
                            <th>
                         #
                            </th>
                            <th>{{translate('العنوان')}}</th>
                            <th>{{translate('الاجراءات')}}</th>
                            </thead>
                            <tbody class="bodyf">
                            <!-- row -->
                            @foreach(\App\Models\Brand::orderBy('name', 'asc')->get() as $key => $value)

                                <tr class="search-items-service">
                                    <td>
                                      {{$key+1}}
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="{{ uploaded_asset($value->logo) }}" data-img="{{ uploaded_asset($value->logo) }}" class="rounded-circle user-img" alt="{{translate('خدمتنا')}}" width="60">

                                            <div class="ms-3">
                                                <div class="user-meta-info">
                                                    <h6 class="user-name mb-0 font-weight-medium" data-name="{{$value->name}}">{{$value->name}}</h6>
                                                    {{--												<small class="user-work text-muted" data-occupation="Web Developer">Web Developer</small>--}}
                                                </div>
                                            </div>
                                        </div>
                                    </td>



                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-light-secondary  text-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-cog"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                            <a href="{{route('services.edit', ['id'=>$value->id, 'lang'=>env('DEFAULT_LANGUAGE')] )}}"  class="dropdown-item">{{translate('تعديل')}}</a>

                                            <a href="javascript:void(0)" class="dropdown-item delete_service "  data-href="{{route('services.destroy', $value->id)}}">{{translate('مسح')}}</a>

                                        </div>
                                        </div>
                                    </td>
                                </tr>
                                <!-- /.row -->
                            @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>