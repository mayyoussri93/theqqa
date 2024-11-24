@extends('frontend.layouts.app')

@section('content')
    <div class="spinner">
        <div class="sk-folding-cube">
            <div class="sk-cube1 sk-cube"></div>
            <div class="sk-cube2 sk-cube"></div>
            <div class="sk-cube4 sk-cube"></div>
            <div class="sk-cube3 sk-cube"></div>
        </div>
    </div>
    <!-- ================ spinner ================= -->
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
                        <a  href="{{route('clientIndex')}}"> <i class="fa-solid fa-user-hair-mullet me-2"></i>
                            {{translate('طلبات الاستقدام')}}
                        </a>
                        <a class="active" href="{{route('user.sponsor_booking_log')}}"> <i class="fa-solid fa-exchange me-2"></i> {{translate('طلبات نقل الكفالة')}} </a>

                        <a  href="{{route('user.booking_log')}}"> <i class="fa-solid fa-user-headset me-2"></i> {{translate('سجل الطلبات')}} </a>
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
                    <!-- order  -->
                    <?php
                    $logs= \App\Models\RequestTransferSponsorship::where('user_id',Auth::user()->id)->orderBy('created_at', 'desc')->paginate(10);

                    ?>
                    @foreach($logs as $key=>$val3)
                        <?php
                            $images=$val3->cvPreviousSponsor->contract->reservation->cv->images;
                            $val=$val3->cvPreviousSponsor->contract->reservation;
                            ?>
                    <div class="order mb-2">
                        <div class="row">
                            <div class="col-sm-4 p-2">
                                <div class="swiper workerCvSlider ">
                                    <div class="swiper-wrapper">
                                        <!-- cv image -->
                                        @if(!empty($images))
                                            @foreach(json_decode($images) as $key2=>$val2)
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
                            <div class="col-sm-8 p-2">
                                <ul class="info">
                                    <li>
                                        <h6>  {{translate('الجنسية')}} </h6>
                                        <p>{{($val->nationality !=null)?$val->nationality->name:"--"}}  </p>

                                    </li>
                                    <li>
                                        <h6>{{translate('المهنة')}} : </h6>
                                        {{($val->cv!=null)?(($val->cv->recruitmentFormOccupation!=null)?$val->cv->recruitmentFormOccupation->name:"--"):"--"}}
                                    </li>
                                    <li>
                                        <h6> {{translate('رقم جواز السفر')}} : </h6>
                                        <p>
                                            {{($val->cv!=null)?$val->cv->passport_id:"--"}}
                                        </p>
                                    </li>
                                    <li>
                                        <h6>  {{translate('تاريخ الحجز')}} </h6>
                                        <p>  {{date('d-m-Y h:i a', strtotime($val3->created_at))}}</p>

                                    </li>
                                    <li>
                                        <h6>  {{translate('مسؤل النقل')}} </h6>
                                        <p>  {{($val3->admin!=null)?$val3->admin->name :"--"}}</p>

                                    </li>
                                </ul>

                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>


    <ul class="pagination wow fadeInUp">
        {{ $logs->links() }}
    </ul>
    <div class="modal fade" id="closeModal" tabindex="-1" aria-labelledby="locationModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="locationModalLabel">  {{translate('تسجيل الخروج')}}</h5>
                    <button type="button" class="btn-close close" data-bs-dismiss="modal" aria-label="Close"></button>
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
