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
                        <a  href="{{route('clientIndex')}}"> <i class="fa-solid fa-user-hair-mullet me-2"></i>
                            {{translate('طلبات الاستقدام')}}
                        </a>
                        <a href="{{route('user.sponsor_booking_log')}}"> <i class="fa-solid fa-exchange me-2"></i> {{translate('طلبات نقل الكفالة')}} </a>

                        <a  href="{{route('user.booking_log')}}"> <i class="fa-solid fa-user-headset me-2"></i> {{translate('سجل الطلبات')}} </a>
                        <a class="active" href="{{ route('support_ticket.index') }}"> <i class="fa-solid fa-comments me-2"></i> {{translate('الشكاوى ')}}
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
                    <!-- chat -->

                    <section id="chat">
                        <div class="container p-0">
                            <div class="row">
                                <div class="col-lg-4 p-1">
                                    <button class="defaultBtn UsersControl d-lg-none">
                                        <i class="fas fa-comments-alt mx-1"></i> {{translate('المحادثات')}} <span></span>
                                    </button>

                                    <!-- chat users -->
                                    <div class=" Users ">
                                        <div class="UsersHeder">
                                            <h5>  {{translate('المحادثات')}}  </h5>
                                            <span class="closeUsers"> <i class="fal fa-times"></i> </span>

                                        </div>
                                        <button class="defaultBtn mt-1 closeUsers" style="width: -webkit-fill-available;" data-bs-toggle="modal" data-bs-target="#ticket_modal"><span title="{{translate('أبدا محادثة جديدة')}}"></span>
                                            <i class="fa-solid fa-add ms-2"></i> {{translate('أبدا محادثة جديدة')}}</button>
                                        <ul class="nav">

                                            @if(!empty($tickets))
                                                @foreach ($tickets as $key => $ticket)
                                            <li>
                                                <a  href="javascript:void(0)"  onclick="loadChats({{$ticket->id}})" aria-selected="true" >
                                                    <div class="userInfo">
                                                        <div class="userDiv">
                                                        <span class="nameDate">
                                                          <h6 class="name">{{ $ticket->subject }} </h6>
                                                          <span class=" date"> {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$ticket->created_at)->format('F d,Y')}} </span>

                                                        </span>
                                                            <p> {{ $ticket->details }}</p>
                                                            @if ($ticket->status == 'pending')
                                                                <div style="color: #A505A">{{ translate('Pending')}}</div>
                                                            @elseif ($ticket->status == 'open')
                                                                <div style="color: #145e4e">{{ translate('Open')}}</div>
                                                            @else
                                                                <div style="color: #145e4e">{{ translate('Solved')}}</div>
                                                                    @endif
                                                        </div>
                                                    </div>

                                                </a>
                                            </li>


                                                @endforeach
                                            @endif

                                        </ul>

                                    </div>

                                </div>
                                <div class="col-lg-8 p-1">

                                    <div class="open-chat" style="display: none">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </section>



































{{--    <div class="wrapper-contant pt-50 pb-50">--}}
{{--        <div class="container">--}}
{{--            <div class="main-contant wrapper-chat">--}}

{{--                <!---============== START EMPTY CHAT ==================---->--}}

{{--                <!---============== END EMPTY CHAT ==================---->--}}
{{--                <!---============== START CHAT ==================---->--}}
{{--                <div class="chat-list side-list">--}}
{{--                    <div class="chat-sub-header">--}}
{{--                        <h5>{{translate('الشكاوى ')}}</h5>--}}
{{--                        --}}{{-- <div class="close-side">--}}
{{--                            close--}}
{{--                        </div> --}}
{{--                    </div>--}}
{{--                    <div class="wrapper-chat-list">--}}
{{--                        <!--- SINGLE CHAT -->--}}
{{--                        @if(!empty($tickets))--}}
{{--                            @foreach ($tickets as $key => $ticket)--}}
{{--                                <a href="javascript:void(0)"  onclick="loadChats({{$ticket->id}})" >--}}
{{--                                    <div class="single-chat">--}}
{{--                                        <div class="single-chat-text">--}}
{{--                                            <p>{{ $ticket->subject }}</p>--}}
{{--                                            <small>{{ $ticket->details }}</small>--}}


{{--                                        </div>--}}
{{--                                        <div class="date-side">--}}
{{--                                            <small>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$ticket->created_at)->format('F d,Y')}}</small>--}}

{{--                                            @if ($ticket->status == 'pending')--}}
{{--                                                <div class="badge badge-inline badge-danger">{{ translate('Pending')}}</div>--}}
{{--                                            @elseif ($ticket->status == 'open')--}}
{{--                                                <div class="badge badge-inline badge-secondary">{{ translate('Open')}}</div>--}}
{{--                                            @else--}}
{{--                                                <div class="badge badge-inline badge-success">{{ translate('Solved')}}</div>--}}
{{--                                            @endif--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </a>--}}

{{--                            @endforeach--}}
{{--                        @endif--}}
{{--                    </div>--}}
{{--                    <div class="footer-chat-list">--}}
{{--                        <div class="btn main-btn rounded">--}}
{{--                            <i class="fas fa-plus"></i>--}}
{{--                            <a href="#" data-toggle="modal" data-target="#ticket_modal">{{translate('أبدا محادثة جديدة')}}</a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}



{{--                <div class="open-chat" style="display: none">--}}

{{--                </div>--}}
{{--                <!---============== END CHAT ==================---->--}}



{{--            </div>--}}
{{--        </div>--}}

{{--    </div>--}}

    <div class="modal fade" id="ticket_modal" tabindex="-1" aria-labelledby="locationModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="locationModalLabel">{{ translate('انشاء شكوى او استفسار')}}</h5>
                    <button type="button" class="btn-close close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-start">
                    <form class="row needs-validation " novalidate action="{{ route('support_ticket.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <label class="form-label" for="validationCustom02">{{translate('موضوع الشكوى')}}</label>
                        <select class="form-control form-select  "
                                data-placeholder="{{translate('اختر الموضوع')}}" name="main_subject"
                                tabindex="1" id="office_dropdown" required>
                            <option  value=""> {{translate('اختار ')}}</option>
                            <option  value="contract"> {{translate('العقود')}}</option>
                            <option  value="reservation"> {{translate('طلبات الاستقدام')}}</option>
                            <option  value="enquiry"> {{translate('استفسار')}}</option>

                        </select>
                        <div id="remove_profile_dropdown">
                            <label class="form-label" for="validationCustom02">{{translate('تحديد العقد او الطلب')}}</label>
                            <select class=" form-control form-select"
                                    data-placeholder="{{translate('اختر الملف')}}" name="profile_dropdown"
                                    tabindex="1" id="profile_dropdown"  >
                                <option  value=""> {{translate('اختار ')}}</option>
                            </select>
                            <div class="valid-feedback">
                                {{translate("برجاء تحديد اختيارك")}}
                            </div>
                        </div>

                            <label  class="form-label">{{ translate('عنوان الشكوى')}}</label>
                            <input type="text" class="form-control mb-3" placeholder="{{ translate('Subject')}}" name="subject" required>
                        <div class="valid-feedback">{{translate('صحيح')}}</div>
                        <div class="invalid-feedback">{{translate('هذا الحقل مطلوب')}}</div>

                            <label  class="form-label">{{ translate('تفاصيل الشكوى')}}</label>
                            <textarea type="text" class="form-control"  name="details" placeholder="{{ translate('اكتب رسالتك')}}" data-buttons="bold,underline,italic,|,ul,ol,|,paragraph,|,undo,redo" required></textarea>
                        <div class="valid-feedback">{{translate('صحيح')}}</div>
                        <div class="invalid-feedback">{{translate('هذا الحقل مطلوب')}}</div>
{{--                            <label class="col-form-label">{{ translate('Photo') }}</label>--}}
{{--                            <input type="file" name="attachments" class="form-control">--}}

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"> {{ translate('إلغاء')}} </button>
                            <button type="submit" class="btn btn-success"> {{ translate('ارسال')}} </button>
                        </div>
                    </form>
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
@section('script')
    <script>
        // category Users
        $(".UsersControl").on('click', function () {
            $(".Users").removeClass("hideUsers").addClass("showUsers");
        });
        $(".closeUsers").on('click', function () {
            $(".Users").removeClass("showUsers").addClass("hideUsers");
        });
    </script>
    <script>
        function loadChats(el){
            $.post('{{ route('support_ticket.refresh') }}', {_token:'{{ @csrf_token() }}', ticket_id:el}, function(data){
                $('.open-chat') .empty();
                $('.open-chat').show();


                console.log(data);

                $(data).appendTo('.open-chat');

                // AIZ.extra.scrollToBottom();

                $('#ticket-reply-form').on('submit',function(e){
                    e.preventDefault();
                    sendMessage();
                });

            })
        }


    </script>
    <script type="text/javascript">

        $(document).on('click','.chat-attachment',function(){
            AIZ.uploader.trigger(
                this,
                'direct',
                'all',
                '',
                true,
                function(files){
                    $('#attachment').val(files);
                    submit_reply();
                }
            );
        });
    </script>
    <script type="text/javascript">
        function submit_reply(status){
            $('input[name=status]').val(status);
            if($('input[name=chat__input]').val()){
                $('#ticket-reply-form').submit();
            }
        }
        $(document).ready(function () {
            /*------------------------------------------
            --------------------------------------------
            Country Dropdown Change Event
            --------------------------------------------
            --------------------------------------------*/
            $('#office_dropdown').on('change', function () {
                var idOffice = this.value;
                $("#profile_dropdown").html('');
                $('#profile_dropdown').prop('required', false)
                if (idOffice != 'enquiry') {

                    $('#remove_profile_dropdown').show();

                    $.ajax({
                        url: "{{route('support_ticket.front_date_res')}}",
                        type: "post",
                        data: {
                            ticket_type: idOffice,
                            _token: '{{csrf_token()}}'
                        },
                        dataType: 'json',
                        success: function (result) {
                            console.log(result.id);

                            $('#profile_dropdown').prop('required', true).html('<option value="">{{translate('اختار الملف')}}</option>');

                            $.each(result, function (key, value) {
                                console.log(value);
                                $("#profile_dropdown").append('<option value="' + value.id
                                    + '">' + value.cv.passport_id + ' - ' + value.user.name + '</option>');
                            });

                        },

                    });
                } else {

                    $('#remove_profile_dropdown').hide();

                }

            });

        });
    </script>
@endsection


