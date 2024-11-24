<!-- ================ NavBar ================= -->
@php
    $header_logo = get_setting('header_logo');
@endphp
<nav class="navbar mainNav navbar-expand-lg navbar-light">
    <div class="container">
        <div class=" d-flex align-items-center">
            <a class="navbar-brand" href="{{ route('home') }}">
                <img class="logo" src="{{ uploaded_asset($header_logo) }}" alt="{{ env('APP_NAME') }}"  />

            </a>
        </div>
        <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navContent" aria-controls="navContent"
                aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navContent">
            <ul class="navbar-nav align-items-center ms-auto my-3 my-lg-0">
                <li class="nav-item">
                    <a class="nav-link  @if(Request::url()==route('home')) active @endif" href="{{ route('home') }}"> {{translate('الرئيسية')}} </a>
                </li>
                @auth
                    @if(!isAdmin()&& auth()->user()->user_type != 'staff')
                        <li class="nav-item">
                            <a class="nav-link @if(Request::url()==route('clientIndex')) active @endif" href="{{route('clientIndex')}}"> {{translate('لوحة التحكم')}} </a>
                        </li>
                    @endif
                @endauth
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle @if(Request::url()==route('all_cvs') or Request::url()==route('allSponsorCvs') ) active @endif" href="#" id="navbarDropdown_1" data-bs-toggle="dropdown">
                        {{translate('خدماتنا')}}
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown_1">
                        @if ( get_setting('header_menu_labels_3') !=  null )
                            @foreach (json_decode( get_setting('header_menu_labels_3'), true) as $key => $value)
                             <li>   <a class="dropdown-item" href="{{ route(json_decode( get_setting('header_menu_links_3'), true)[$key]) }}">{{translate($value)}} </a> </li>


                            @endforeach
                        @endif
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle
                     @if(Request::url()==route('frontend.select-worker') or Request::url()==route('frontend.recruitment-contract') or Request::url()==route('frontend.get-started')  ) active @endif" href="#" id="navbarDropdown_1" data-bs-toggle="dropdown">
                        {{translate('رحلة الاستقدام')}}
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown_1">
                        @if ( get_setting('header_menu_labels_4') !=  null )
                            @foreach (json_decode( get_setting('header_menu_labels_4'), true) as $key => $value)
                                <li>   <a class="dropdown-item" href="{{route(json_decode( get_setting('header_menu_links_4'), true)[$key]) }}">{{translate($value)}} </a> </li>
                            @endforeach
                        @endif
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle @if(Request::url()==route('recruitment.policies') or Request::url()==route('musaned.details')  ) active @endif" href="#" id="navbarDropdown_1" data-bs-toggle="dropdown">
                        {{translate('عن الاستقدام')}}
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown_1">
                        @if ( get_setting('header_menu_labels_5') !=  null )
                            @foreach (json_decode( get_setting('header_menu_labels_5'), true) as $key => $value)
                                <li>   <a class="dropdown-item" href="{{ route(json_decode( get_setting('header_menu_links_5'), true)[$key]) }}">{{translate($value)}} </a> </li>


                            @endforeach
                        @endif
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle @if( Request::url()==route('frontend.contact-us') or Request::url()==route('frontend.recruitment-contract') or Request::url()==route('frontend.get-started')  ) active @endif" href="#" id="navbarDropdown_1" data-bs-toggle="dropdown">
                        {{translate('الدعم')}}
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown_1">
                        @if ( get_setting('header_menu_labels_6') !=  null )
                            @foreach (json_decode( get_setting('header_menu_labels_6'), true) as $key => $value)
                                <li>   <a class="dropdown-item" href="{{ route(json_decode( get_setting('header_menu_links_6'), true)[$key]) }}">{{translate($value)}} </a> </li>
                            @endforeach
                        @endif
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link  @if(Request::url()==route('frontend.job.get-started')) active @endif" href="{{route('frontend.job.get-started')}}">
                        {{ translate("انضم ألينا") }}
                    </a>
                </li>
{{--                <li class="nav-item">--}}
{{--                    <a class="nav-link" href="{{ route('maaroufa_service')}}">--}}
{{--                        خدمة معروفة--}}
{{--                    </a>--}}
{{--                </li>--}}
                @php
                    if(Session::has('locale')){
                        $locale = Session::get('locale', Config::get('app.locale'));
                    }
                    else{
                        $locale = 'ar';
                    }
                @endphp
                <li class=" nav-item language dropdown">
                    <a class=" dropdown-toggle" href="#" id="navbarDropdown_2" data-bs-toggle="dropdown">
                        <i class="fa-solid fa-globe me-2"></i>
                        <!-- اللغة -->
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown_2">

{{--                            @foreach (\App\Models\Language::all() as $key => $language)--}}
                            <li>
                            <a class="dropdown-item" href="javascript:void(0)"  onclick="change_lang_new('en') "   > <img src="{{ static_asset('v3_assets/img/en.svg') }}" alt="{{ env('APP_NAME') }}"> {{ translate('English') }} </a>
                            </li>
                        <li>
                            <a class="dropdown-item" href="javascript:void(0)"  onclick="change_lang_new('ar')"   > <img src="{{ static_asset('v3_assets/img/sa.svg') }}" alt="{{ env('APP_NAME') }}"> {{ translate('Arabic') }} </a>
                        </li>
{{--                            @endforeach--}}


                    </ul>
                </li>
                 @auth
                    @php $noti_num = \App\Utility\NotificationUtility::get_my_notifications(10,true,true); @endphp

                <!-- If the user is logged in -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                       aria-expanded="false">
                        <!-- <i class="fas fa-user-circle fa-2x"></i> -->
                        <img class="userImg me-2" src="{{ static_asset('v3_assets/img/avatar.webp') }}" alt="{{ env('APP_NAME') }}">
                        <p> {{translate('حسابي')}} </p>
                    </a>
                    <ul class="dropdown-menu text-start" aria-labelledby="navbarDropdown">
                        @if(!isAdmin()&& auth()->user()->user_type != 'staff')

                            <li><a class="dropdown-item" href="{{route('clientIndex')}}"> <i class="fa-solid fa-tachometer me-1"></i> {{translate('لوحة التحكم')}}</a></li>

                            <li><a class="dropdown-item" href="{{route('user.booking_log')}}"> <i class="fa-solid fa-user-hair-mullet me-1"></i>  {{translate('سجل الطلبات')}}</a></li>
                        <li><a class="dropdown-item" href="{{ route('frontend.notifications') }}"> <i class="fas fa-bell me-1"></i>
                                {{translate('الإشعارات')}}
                                @if($noti_num != 0)
                                    <span class="badge badge-danger" style=" background: red; ">{{  $noti_num }}</span>
                                @endif
                            </a>
                        </li>

                        @endif
                        <li><a class="dropdown-item" href="{{ route('logout') }}"><i class="fas fa-power-off me-1"></i> {{translate('تسجبل الخروج')}} </a></li>
                    </ul>
                </li>
                 @else

                <li class="nav-item">
                    <a class="defaultBtn " href="{{ route('user.login') }}"><span></span> {{ translate('Login')}} </a>
                </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
<!-- ================ /NavBar ================= -->