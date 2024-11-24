@extends('frontend.layouts.app')

@section('content')

        <!-- ================ spinner ================= -->
        <div class="spinner">
            <div class="sk-folding-cube">
                <div class="sk-cube1 sk-cube"></div>
                <div class="sk-cube2 sk-cube"></div>
                <div class="sk-cube4 sk-cube"></div>
                <div class="sk-cube3 sk-cube"></div>
            </div>
        </div>
        <!-- ================ spinner ================= -->
        <!-- ================ for seo ================= -->
        <h1 style="display: none">{{get_seo_h1_setting(request()->path())}} </h1>
        <!-- ================  for seo ================= -->

        <!-- ================ profile ================= -->
        <section class="profile">
            <div class="container ">
                <!-- user Header  -->
                <div class=" userHeader">
                    <div class="userInfo">
                        <div class="d-flex flex-wrap align-items-center">
                            <img src="{{ static_asset('v3_assets/img/avatar.webp') }}" alt="{{ env('APP_NAME') }}" class="me-3">
                            <div class="userName">
                                <h3>{{Auth::user()->name}}</h3>
                                <p> {{Auth::user()->phone}} </p>
                            </div>
                        </div>
                        <div class="control">
                            <a  data-bs-toggle="modal" data-bs-target="#closeModal"  title="{{translate('تسجبل الخروج')}} "><i class="fas fa-power-off"></i></a>
                        </div>
                    </div>
                </div>
                <!-- /user Header  -->
                <div class="row">
                    <!-- links -->
                    <div class="col-md-4 col-lg-3 p-1">
                        <div class="profileNavCol">
                            @php
                                $support_ticket = DB::table('tickets')
                                            ->where('client_viewed', 0)
                                            ->where('user_id', Auth::user()->id)
                                            ->count();
                                 $noti_num = \App\Utility\NotificationUtility::get_my_notifications(10,true,true);

                            @endphp
                            <a class="active" href="{{route('clientIndex')}}"> <i class="fa-solid fa-user-hair-mullet me-2"></i>
                                {{translate('طلبات الاستقدام')}}
                            </a>
                            <a href="{{route('user.sponsor_booking_log')}}"> <i class="fa-solid fa-exchange me-2"></i> {{translate('طلبات نقل الكفالة')}} </a>

                            <a href="{{route('user.booking_log')}}"> <i class="fa-solid fa-user-headset me-2"></i> {{translate('سجل الطلبات')}} </a>
                            <a href="{{ route('support_ticket.index') }}"> <i class="fa-solid fa-comments me-2"></i> {{translate('الشكاوى ')}}
                                @if($support_ticket > 0)<span class="badge badge-inline badge-success">{{ $support_ticket }}</span> @endif
                            </a>
                            <a href="{{ route('frontend.notifications') }}"> <i class="fas fa-bell me-2"></i> {{translate('الاشعارات')}}
                                @if($noti_num > 0)  <span class="badge badge-danger" style=" background: red; ">{{  $noti_num }}</span> @endif
                            </a>
                            <a href="{{ route('profile') }}"><i class="fas fa-cog me-2"></i>{{translate('اعدادات الحساب')}} </a>
                            <a href="{{ route('logout') }}"><i class="fas fa-power-off me-2"></i>{{translate('تسجبل الخروج')}}  </a>
                        </div>
                    </div>
                    <!-- content -->
                    <div class=" col-md-8 col-lg-9 p-2 profileContent">
                        <a href="{{route('all_cvs')}}" class="newOrder">
                            <i class="fa-duotone fa-file-circle-plus"></i>
                            <p> {{translate('تقديم طلب استقدام جديد')}} </p>
                        </a>
                    @php
                    $all_resvation=\App\Models\Reservation::where('user_id',auth::user()->id)->whereHas('cv',  function ($q)  {
                        $q->where('cv_rev_type', 1 );
                    })->get();
                    @endphp
                        <!-- orders -->
                        <div class="row">
                        @if(!empty($all_resvation))
                            @foreach($all_resvation as $key =>$val)
                         
                            <div class="col-lg-6 p-2">
                                <div class="order">
                                    <div class="row">
                                        <div class="col-sm-6 p-2">
                                            <div class="swiper workerCvSlider ">
                                                <div class="swiper-wrapper">

                                                    @if(!empty($val->cv->images))
                                                    @foreach(json_decode($val->cv->images) as $key2=>$val2)
                                                        <div class="swiper-slide ">
                                                            <a data-fancybox="user1-CV" href="{{static_asset($val2)}}">
                                                                <img src="{{static_asset($val2)}}"  lazy="loading" alt="{{ env('APP_NAME') }}"  >
                                                            </a>
                                                        </div>
                                                    @endforeach
                                                        @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 p-2">
                                            @if(in_array($val->status,[1,2,3]))
                                            <button type="button" data-id="{{$val->id}}" class="btn clear m-1  pull-left cancel_res_model" style="float: left;color: red;font-size: x-small;" data-bs-toggle="modal" data-bs-target="#locationModal">   {{translate('إلغاء الطلب')}}</button>
                                            @endif
                                            <ul class="info">
                                                <li>
                                                    <h6> {{translate('الجنسية')}}  :</h6>
                                                    <p>{{($val->nationality !=null)?$val->nationality->name:"--"}}  </p>
                                                </li>
                                                <li>
                                                    <h6> {{translate('المهنة')}} : </h6>
                                                    <p> {{($val->recruitmentFormOccupation !=null)?$val->recruitmentFormOccupation->name:"--"}} </p>
                                                </li>
                                                <?php $res_status=\App\Models\ReservationStatus::find($val->status);?>


                                            </ul>
                                        </div>
                                    </div>

                                    <div class="profileCustomerInfo">
                                        <div class="info">
                                            <img src="{{static_asset('v3_assets/img/avater2.webp')}}" alt="{{ env('APP_NAME') }}">
                                            <div class="text">
                                                @if(in_array($res_status->id,[3,4,6,5,7,8,9,10,11,12,13,14,15]))
                                                   <h6> {{!empty($val->Adminstaff)?$val->Adminstaff->name:""}} </h6>
                                                @else
                                                    <h6>{{translate('لم يتم اختيار احد خدمة العملاء بعد')}}</h6>
                                                @endif
                                                <p>{{translate('خدمة العملاء')}}</p>
                                            </div>
                                        </div>
                                        <div class="contact">
                                            @if(in_array($res_status->id,[3,4,6,5,7,8,9,10,11,12,13,14,15]))
                                            <a href="{{route('reservation_details',$val->id)}}">
                                                <p> {{translate('التفاصيل')}}  </p>
                                                <i class="fa-duotone fa-left-long ms-1"></i>
                                            </a>
{{--                                            @elseif($res_status->id=="3")--}}
{{--                                                <a href="{{route('count_timer',$val->id)}}">--}}
{{--                                                    <p>    {{translate('اكمل طلبك')}} </p>--}}
{{--                                                    <i class="fa-duotone fa-left-long ms-1"></i>--}}
{{--                                                </a>--}}
                                            @elseif($res_status->id=="1" or $res_status->id=="2"  )
                                                <a href="{{route('choose_customer_service',$val->id)}}">
                                                    <p>    {{translate('اكمل طلبك')}} </p>
                                                    <i class="fa-duotone fa-left-long ms-1"></i>
                                                </a>

                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                                @endforeach
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- ================ /profile ================= -->

        <div class="modal fade" id="locationModal" tabindex="-1" aria-labelledby="locationModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="locationModalLabel">  {{translate('الغاء الطلب')}}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-start">
                        <label class="form-label"> <i class="fas fa-code-pull-request-closed me-2"></i>   {{translate('هل تريد الغاء الطلب بالفعل ؟')}} </label>

                    </div>
                    <div class="modal-footer">
                        <a class="btn btn-success cansel_res"  style="padding: 0.48rem 0.9rem;" > {{translate('تاكيد')}} </a>

                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"> {{translate('الغاء')}} </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="closeModal" tabindex="-1" aria-labelledby="locationModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="locationModalLabel">  {{translate('تسجيل الخروج')}}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-start">
                        <label class="form-label"> <i class="fas fa-code-pull-request-closed me-2"></i>   {{translate('هل تريد الخروج ؟')}} </label>

                    </div>
                    <div class="modal-footer">
                        <a class="btn btn-success " href="{{ route('logout') }}" style="padding: 0.48rem 0.9rem;" > {{translate('تاكيد')}} </a>

                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"> {{translate('الغاء')}} </button>
                    </div>
                </div>
            </div>
        </div>
@endsection
@section('script')

    <script type="text/javascript">
        $(document).on("click", ".cancel_res_model", function () {
            var myBookId = $(this).data('id');
            $(".cansel_res").attr("href", "/start/new/reservation/" + myBookId);


        });
    </script>

@endsection