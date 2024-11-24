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
                    <!-- ================ routeNav ================= -->
                    <div class="routeNav">
                        <button onclick="goBack()" class="Back">
                            <i class="fas fa-angle-right"></i>
                        </button>
                        <ul>
                            <li>
                                <a href="{{route('clientIndex')}}"> {{translate('طلبات الاستقدام')}} </a>
                            </li>
                            <li>
                                <a href="{{route('choose_customer_service',$current_res->id)}}" class="active"> {{translate('تفاصيل الطلب')}} </a>
                            </li>
                        </ul>
                    </div>
                    <!-- ================ /routeNav ================= -->
                    <!-- status -->
                    @php
                        $booking_status = $current_res->status;
                    @endphp
                    <div class="status">
                        <ol>
                            <li @if(in_array($booking_status,[13])) class="completed" @endif >
                                <p>{{translate('مرتجع')}} </p>
                            </li>
                            <li @if(in_array($booking_status,[1,2,3,4,5,6,7,8,9,10,11,12,14])) class="completed" @endif >
                                <p>{{translate('اختيار العمالة')}} </p>
                            </li>
                            <li @if(in_array($booking_status,[2,3,4,5,6,7,8,9,10,11,12,14])) class="completed" @endif>
                                <p>{{translate('حجز السيره الذاتية')}} </p>
                            </li>
                            <li @if(in_array($booking_status,[3,4,5,6,7,8,9,10,11,12,14])) class="completed" @endif>
                                <p>{{translate('اختار احد ممثلى خدمة العملاء')}} </p>
                            </li>
                            <li @if(in_array($booking_status,[4,5,6,7,8,9,10,11,12,14])) class="completed" @endif>
                                <p>{{translate('مرحلة الاجراءات')}} </p>
                            </li>
                            <li @if(in_array($booking_status,[4,5,6,7,8,9,10,11,12])) class="completed" @endif>
                                <p>{{translate('تم التعاقد')}}</p>
                            </li>
                            <li @if(in_array($booking_status,[5,6,7,8,9,10,11,12])) class="completed" @endif>
                                <p> {{translate('عقود غير معتمدة')}} </p>
                            </li>
                            <li @if(in_array($booking_status,[6,7,8,9,10,11,12])) class="completed" @endif>
                                <p>{{translate('اعتماد العقد')}} </p>
                            </li>
                            <li @if(in_array($booking_status,[7,8,9,10,11,12])) class="completed" @endif>
                                <p> {{translate('عقد جديد')}} </p>
                            </li>
                            <li @if(in_array($booking_status,[8,9,10,11,12])) class="completed" @endif>
                                <p>{{translate('مساند')}} </p>
                            </li>
                            <li @if(in_array($booking_status,[9,10,11,12])) class="completed" @endif>
                                <p>{{translate('التفويض')}} </p>
                            </li>
                            <li @if(in_array($booking_status,[10,11,12])) class="completed" @endif>
                                <p>{{translate('التفييز')}} </p>
                            </li>
                            <li @if(in_array($booking_status,[11,12])) class="completed" @endif>
                                <p>{{translate('التذكرة')}} </p>
                            </li>

                            <li @if(in_array($booking_status,[12])) class="completed" @endif>
                                <p>{{translate('تم تسليم العامل')}} </p>
                            </li>




                        </ol>
                    </div>
                    <!-- order -->
                    <div class="order">
                        <div class="row">
                            <div class="col-sm-6 p-2">
                                <div class="swiper workerCvSlider ">
                                    <div class="swiper-wrapper">
                                        <!-- cv image -->
                                        @if(!empty($current_res->cv->images))
                                            @foreach(json_decode($current_res->cv->images) as $key2=>$val2)
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
                                <ul class="info">
                                    <li>
                                        <h6>{{translate('الجنسية')}} : </h6>
                                        <p>{{($current_res->cv->nationality !=null)?$current_res->cv->nationality->name:"--"}}  </p>
                                    </li>
                                    <li>
                                        <h6>{{translate('المهنة')}} :</h6>
                                        <p> {{($current_res->cv->recruitmentFormOccupation !=null)?$current_res->cv->recruitmentFormOccupation->name:"--"}}  </p>
                                    </li>
                                    <?php $res_status=\App\Models\ReservationStatus::find($current_res->status);?>

                                    <li>
                                        <h6>  {{translate('حالة الاستقدام')}} </h6>

                                        <p> {{translate($res_status->title)}} </p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- customerInfo -->
                    <div class="selectedCustomerInfo">
                        <div class="row">
                            <div class="col-md-6 p-1">
                                <?php $user=$current_res->Adminstaff;
                            $whats  = preg_replace('/[^0-9]/', '',  $user->whatsapp_phone);
                            $link='https://api.whatsapp.com/send?phone='.$whats;

                                ?>
                                <div class="info">
                                    <img src="{{ static_asset('v3_assets/img/avater2.webp') }}" alt="{{ env('APP_NAME') }}">
                                    <div class="text">
                                        <h5>{{$user->name}}</h5>
                                        <p>{{translate('خدمة العملاء')}}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 col-md-3 p-1">
                                <a class="contact" href="{{$link}}" target="_blank" rel="noopener">
                                    <i class="me-2 fa-brands fa-whatsapp-square"></i>
                                    <p>{{translate('تواصل عير الواتس اب')}}</p>
                                </a>
                            </div>
                            <div class="col-6 col-md-3 p-1">
                                <a class="contact" href="{{'tel:'.$user->phone}}" target="_blank" rel="noopener">
                                    <i class="me-2 fa-solid fa-square-phone"></i>
                                    <p>{{translate('تواصل عبر الهاتف')}} </p>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="selectedCustomer">
                        @if(in_array($current_res->status,[1,2,3]))
                            <button type="button" data-id="{{$current_res->id}}" class="btn clear m-1  pull-left cancel_res_model" style="float: left;color: red;font-size: x-small;" data-bs-toggle="modal" data-bs-target="#cancelledModal">      {{translate('إلغاء الطلب')}}</button>
                        @endif
                        @if($res_status->id==3)
                                <h6>{{translate(" يرجى التواصل مع  ")}}<span> {{$user->name}} </span>{{translate(" الذى قمت باختياره فى خلال ").get_setting('reservation_timer').translate("  ساعة حتى لا يتم إلغاء حجز السيرة الذاتية" )}}</h6>

                        @else
                                    <h6>{{translate('سوف توصل العمالة فى خلال')}} <span> {{get_setting('worker_recruitment_timer')}} </span> {{translate('يوم كحد اقصى')}} </h6>

                                @endif
                        <div id="timer">
                            <div id="days"></div>
                            <div id="hours"></div>
                            <div id="minutes"></div>
                            <div id="seconds"></div>
                        </div>

                        <h6> {{translate($res_status->title)}}</h6>
                        <!-- button for modal -->
{{--                                @if($res_status->id!=3)--}}
{{--                        @if($res_status->id==4 && empty($current_res->address))--}}
{{--                        <button class="defaultBtn mt-4" data-bs-toggle="modal" data-bs-target="#locationModal"><span></span>--}}
{{--                                {{translate('اختيار موقع تسلم العمالة')}}--}}
{{--                            <i class="fa-solid fa-map-location ms-2"></i> </button>--}}
{{--                    @else--}}
{{--                            <span  class=" mt-4">{{$current_res->address}}</span>--}}
{{--                                @if(!empty($current_res->date_arrived))--}}
{{--                            <p  class=" mt-4">{{translate('تاريخ الوصول'). ' : '.$current_res->date_arrived }}</p>--}}
{{--                                    @endif--}}

{{--                    @endif--}}
{{--                            @endif--}}
                        <!-- Modal -->
                    </div>
                </div>
            </div>
        </div>
    </section>
{{--    <div class="modal fade" id="locationModal" tabindex="-1" aria-labelledby="locationModalLabel"--}}
{{--         aria-hidden="true">--}}
{{--        <div class="modal-dialog modal-dialog-centered">--}}
{{--            <div class="modal-content">--}}
{{--                <div class="modal-header">--}}
{{--                    <h5 class="modal-title" id="locationModalLabel">   {{translate('اختيار موقع تسلم العمالة')}}</h5>--}}
{{--                    <button type="button" class="btn-close close" data-bs-dismiss="modal" aria-label="Close"></button>--}}
{{--                </div>--}}
{{--                <div class="modal-body text-start">--}}
{{--                    <label class="form-label"> <i class="fas fa-city me-2"></i> {{translate('المدينة')}} </label>--}}
{{--                    <select class="form-control" name="address"   id="selected_address" required>--}}
{{--                        <option value="">{{translate('اختار المدينة')}}</option>--}}
{{--                        @foreach (\App\Models\City::where('country_id', 190)->get() as $key => $val)--}}
{{--                            <option value="{{ $val->name }}" @if(old('address')== $val->name ) selected @endif>{{translate($val->name) }}</option>--}}
{{--                        @endforeach--}}
{{--                    </select>--}}
{{--                </div>--}}
{{--                <div class="modal-footer">--}}
{{--                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"> {{translate('الغاء')}} </button>--}}
{{--                    <button type="button" class="btn btn-success"  onclick="save_location()"> {{translate('تاكيد')}} </button>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
    <div class="modal fade" id="cancelledModal" tabindex="-1" aria-labelledby="locationModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="locationModalLabel">  {{translate('الغاء الطلب')}}</h5>
                    <button type="button" class="btn-close close" data-bs-dismiss="modal" aria-label="Close"></button>
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
                    <button type="button" class="btn-close close" ></button>
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
    <script>
        {{--function save_location() {--}}

        {{--    var s_address =$('#selected_address').val();--}}


        {{--    if(s_address) {--}}
        {{--        $.post('{{ route('user_location') }}', {--}}
        {{--            _token: '{{ @csrf_token() }}',--}}
        {{--            resv: '{{$current_res->id}}',--}}
        {{--            adds: s_address--}}
        {{--        }, function (data) {--}}
        {{--            $('#locationModal').modal('toggle');--}}

        {{--            toastr.success("{{translate('تم تحديد الموقع بنجاح')}}");--}}
        {{--            setTimeout(function() {--}}
        {{--                location.reload();--}}
        {{--            }, 10000);--}}

        {{--        })--}}
        {{--    }else{--}}
        {{--        toastr.warning("{{translate('لم تقم بتحديد المكان بعد')}}");--}}
        {{--        window.setTimeout(function() {--}}
        {{--            location.reload();--}}
        {{--        }, 1000);--}}
        {{--    }--}}
        {{--}--}}
        @if($res_status->id==3)
        function makeTimer() {
            // month , day , year , time24
            var endTime = "{{date( "Y-m-d H:i:s", strtotime( $current_res->created_at)  + get_setting('reservation_timer') * 3600 )}}";
            endTime = endTime.replace(' ', 'T')
            endTime = new Date(endTime);
             endTime = (Date.parse(endTime)) / 1000;
            var now = new Date();
            var now = (Date.parse(now) / 1000);
            var timeLeft = endTime - now;
            var days = Math.floor(timeLeft / 86400);
            var hours = Math.floor((timeLeft - (days * 86400)) / 3600);
            var minutes = Math.floor((timeLeft - (days * 86400) - (hours * 3600)) / 60);
            var seconds = Math.floor((timeLeft - (days * 86400) - (hours * 3600) - (minutes * 60)));

            $("#days").html(days + "<span> {{translate('يوم')}} </span>");
            $("#hours").html(hours + "<span> {{translate('ساعات')}} </span>");
            $("#minutes").html(minutes + "<span>  {{translate('دقائق')}} </span>");
            $("#seconds").html(seconds + "<span> {{translate('ثواني')}} </span>");
        }
        @else
        function makeTimer() {
            // month , day , year , time24

            var endTime = "{{date('Y-m-d H:i:s', strtotime(date( "Y-m-d H:i:s", strtotime( $current_res->contract_time ) + get_setting('worker_recruitment_timer') * 86400 )))}}";
             endTime = endTime.replace(' ', 'T')
             endTime = new Date(endTime);
            var endTime = (Date.parse(endTime)) / 1000;
            var now = new Date();
            // console.log(now)
            var now = (Date.parse(now) / 1000);
            var timeLeft = endTime - now;
            var days = Math.floor(timeLeft / 86400);
            var hours = Math.floor((timeLeft - (days * 86400)) / 3600);
            var minutes = Math.floor((timeLeft - (days * 86400) - (hours * 3600)) / 60);
            var seconds = Math.floor((timeLeft - (days * 86400) - (hours * 3600) - (minutes * 60)));
            $("#days").html(days + "<span> {{translate('يوم')}} </span>");
            $("#hours").html(hours + "<span> {{translate('ساعات')}} </span>");
            $("#minutes").html(minutes + "<span>  {{translate('دقائق')}} </span>");
            $("#seconds").html(seconds + "<span> {{translate('ثواني')}} </span>");
        }
        @endif


        setInterval(function () { makeTimer(); }, 0);

    </script>
@endsection
