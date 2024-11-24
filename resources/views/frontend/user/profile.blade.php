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
                        <a href="{{route('user.sponsor_booking_log')}}"> <i class="fa-solid fa-exchange me-2"></i> {{translate('طلبات نقل الكفالة')}} </a>

                        <a href="{{route('user.booking_log')}}"> <i class="fa-solid fa-user-headset me-2"></i> {{translate('سجل الطلبات')}} </a>
                        <a href="{{ route('support_ticket.index') }}"> <i class="fa-solid fa-comments me-2"></i> {{translate('الشكاوى ')}}
                            @if($support_ticket > 0)<span class="badge badge-inline badge-success">{{ $support_ticket }}</span> @endif
                        </a>
                        <a  href="{{ route('frontend.notifications') }}"> <i class="fas fa-bell me-2"></i> {{translate('الاشعارات')}}
                            @if($noti_num > 0)  <span class="badge badge-danger" style=" background: red; ">{{  $noti_num }}</span> @endif
                        </a>
                        <a  class="active"  href="{{ route('profile') }}"><i class="fas fa-cog me-2"></i>{{translate('اعدادات الحساب')}} </a>
                        <a href="{{ route('logout') }}"><i class="fas fa-power-off me-2"></i>{{translate('تسجبل الخروج')}}  </a>

                    </div>
                </div>
                <!-- content -->
                <div class=" col-md-8 col-lg-9 p-2 profileContent">
                    <div class="editProfile">
                        <div class="head">
                            <h5> <i class="fas fa-user me-2"></i> {{translate('البيانات الشخصية')}} </h5>
                        </div>
                            <form  class="row needs-validation" novalidate  action="{{ route('customer.profile.update') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                            <div class="col-12 p-2">
                                <label for="name" class="form-label"> <i class="fas fa-user me-2"></i> {{translate('الاسم الكامل')}} </label>
                                <input type="text" class="form-control" placeholder="{{translate('ادخل اسمك بالكامل كما في الهوية')}}" name="name" value="{{ Auth::user()->name }}" required>
                                <div class="valid-feedback">{{translate('صحيح')}}</div>
                                <div class="invalid-feedback">{{translate('هذا الحقل مطلوب')}}</div>
                            </div>
                            <div class="col-md-12 p-2">
                                <label class="form-label"> <i class="fas fa-city me-2"></i> {{translate('المدينه')}}  </label>
                                <input type="text" class="form-control" placeholder="{{translate('اختار مدينتك')}}" name="city" value="{{Auth::user()->city}}">

{{--                                <select class="select2WithoutSearch"  placeholder="{{translate('اختار دولتك')}}" name="city" required>--}}
{{--                                    @foreach (\App\Models\City::where('country_id', 190)->get() as $key => $country)--}}
{{--                                        <option value="{{ $country->name }}" @if(Auth::user()->city== $country->name ) selected @endif>{{ translate($country->name) }}</option>--}}
{{--                                    @endforeach--}}
{{--                                </select>--}}
                            </div>
                                <input type="hidden" name="country" value="المملكة العربية السعودية">

                                <div class="col-md-6 p-2">
                                <label for="password" class="form-label"> <i class="fas fa-key me-2"></i> {{translate('الرقم السرى')}} </label>
                                <input type="password" class="form-control" id="password" placeholder="*****"  name="new_password">
                            </div>
                            <div class="col-md-6 p-2">
                                <label for="repetPassword" class="form-label"> <i class="fas fa-key me-2"></i>{{translate('تأكيد الرقم السرى')}}
                                </label>
                                <input type="password" class="form-control" id="repetPassword" placeholder="*****" name="confirm_password">
                            </div>



                            <div class="col-12 pt-4 p-2 text-center">
                                <button class="defaultBtn " type="submit">
                                    <p class="px-5"> {{translate('تأكيد')}} </p>
                                    <span></span>
                                </button>
                            </div>
                        </form>
                    </div>
                    <!--  -->
                    <div class="editProfile">
                        <div class="head">

                            <h5> <i class="fas fa-key me-2"></i>   {{translate('إعدادات الهاتف')}} </h5>
                        </div>
                            <form class="row" action="{{route('change.phone')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                            <div class="col-12 p-2 ">
                                <label for="Phone" class="form-label"> <i class="fas fa-phone-alt me-2"></i> {{translate('رقم الهاتف')}} </label>
                                <div class="input-group">
                                <input type="number" class="form-control" id="Phone" name="phone" @if (Auth::user()->phone != null) value="{{ Auth::user()->phone }}" @endif  required placeholder="05***********">
                                @if (Auth::user()->phone_verified_at == null)
                                <div class="input-group-append">
                                        <input type="number" class="form-control" name="verification_code"  placeholder="{{translate('ادخل كود الهاتف')}}" >
                                </div>

                                <div class="text-white bg-danger input-group-prepend text-center font-weight-bold">
                                                    {{ translate('UnVerified') }}
                                                    <i class="fa fa-close"></i>
                                        </div>
                                    @else
                                        <div class="text-white bg-success input-group-prepend  text-center font-weight-bold">
                                                    {{ translate('Verified') }}
                                                    <i class="fa fa-check"></i>
                                                </div>
                                    @endif
                                @error('phone')
                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                                </div>
                            </div>
                                @if (Auth::user()->phone_verified_at == null)
                                    <div class="col-12 pt-4 p-2 tab-content ">
                                        <span>{{translate('لم يصلنى كود التفعيل')}}</span>
                                            <a href="{{ route('verification.phone.resend') }}" style="color: #A505A">  {{translate(' إعادة ارسال')}} </a>

                                    </div>
                                @endif
                            <div class="col-12 pt-4 p-2 text-center">
                                <button class="defaultBtn " type="submit">
                                    <p class="px-5"> {{translate('تأكيد')}} </p>
                                    <span></span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>



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


@section('modal')

@endsection

@section('script')
    <script type="text/javascript">


        $('.new-email-verification').on('click', function() {
            $(this).find('.loading').removeClass('d-none');
            $(this).find('.default').addClass('d-none');
            var email = $("input[name=email]").val();

            $.post('{{ route('user.new.verify') }}', {_token:'{{ csrf_token() }}', email: email}, function(data){
                data = JSON.parse(data);
                $('.default').removeClass('d-none');
                $('.loading').addClass('d-none');
                if(data.status == 2)
                    AIZ.plugins.notify('warning', data.message);
                else if(data.status == 1)
                    AIZ.plugins.notify('success', data.message);
                else
                    AIZ.plugins.notify('danger', data.message);
            });
        });


    </script>
@endsection
