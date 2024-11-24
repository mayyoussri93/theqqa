<style>
    .dropdown-submenu {
        position: relative;
    }

    .dropdown-submenu a::after {
        transform: rotate(-90deg);
        position: absolute;
        right: 6px;
        top: .8em;
    }

    .dropdown-submenu .dropdown-menu {
        top: 0;
        left: 100%;
        margin-left: .1rem;
        margin-right: .1rem;
    }
    .topbar .top-navbar .navbar-nav > .nav-item > .nav-link {
        font-size:16px;
    }
</style>
<header class="topbar">
    <nav class="navbar top-navbar navbar-expand-md navbar-dark">
        <div class="navbar-header">

            <!-- This is for the sidebar toggle which is visible on mobile only -->
            <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i
                        class="ti-menu ti-close"></i></a>
            <!-- ============================================================== -->
            <!-- Logo -->
            <!-- ============================================================== -->
            <a class="navbar-brand" href="{{ route('website.main') }}">
                <!-- Logo icon -->
                @php
//                    $logo = uploaded_asset(get_setting('system_logo_white')) ;
                $logo = static_asset('front_asset\img\logo.png')  ;
                @endphp
                <a href="{{route('website.main')}}" class="logo-icon">
                    <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->

                    @if($logo != null)
                        <!-- Dark Logo icon -->
                        <img src="{{$logo}}" alt="{{ get_setting('website_name') }}" style="width: 150px; height: 50px; border-radius: 20px;margin-right: 4px ; padding-left:4px ;" class="dark-logo  " />
                    @else
                        <!-- Light Logo icon -->
                        <img src="{{ static_asset('logo.svg') }}"  class="light-logo w-100" alt="{{ get_setting('website_name') }}">
                    @endif
                </a>
                <!--End Logo icon -->
                <!-- Logo text -->
{{--                <span class="logo-text">--}}
{{--                            <!-- dark Logo text -->--}}
{{--                            <img src="../assets/images/logo-text.png" alt="homepage" class="dark-logo" />--}}
{{--                    <!-- Light Logo text -->--}}
{{--                            <img src="../assets/images/logo-light-text.png" class="light-logo" alt="homepage" />--}}
{{--                 </span>--}}
            </a>
            <!-- ============================================================== -->
            <!-- End Logo -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Toggle which is visible on mobile only -->
            <!-- ============================================================== -->
            <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)"
               data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
               aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i
                        class="ti-more"></i></a>
        </div>
        <!-- ============================================================== -->
        <!-- End Logo -->
        <!-- ============================================================== -->
        <div class="navbar-collapse collapse" id="navbarSupportedContent">
            <!-- ============================================================== -->
            <!-- toggle and nav items -->
            <!-- ============================================================== -->


            <ul class="navbar-nav me-auto">
                <!-- This is  -->
                <li class="nav-item"> <a
                            class="nav-link sidebartoggler d-none d-md-block waves-effect waves-dark"
                            href="javascript:void(0)"><i class="ti-menu text-white"></i></a> </li>

                <!-- ============================================================== -->
                <!-- End Mega Menu -->
                <!-- ============================================================== -->
            </ul>
            <!-- ============================================================== -->
            <!-- Right side toggle and nav items -->
            <!-- ============================================================== -->
            <ul class="navbar-nav">




                <li class="nav-item ">
                    <a class="nav-link dropdown-toggle waves-effect waves-dark" href="#" data-bs-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false">
                        <img src="{{static_asset('v4_assets/assets/images/users/1.jpg')}}" alt="user" width="30" class="profile-pic rounded-circle" />
                    </a>
                    <div class="dropdown-menu dropdown-menu-end user-dd animated flipInY">
                        <div class="d-flex no-block align-items-center p-3 bg-info text-white mb-2">
                            <div class=""><img src="{{static_asset('v4_assets/assets/images/users/1.jpg')}}" alt="user" class="rounded-circle" width="60"></div>
                            <div class="ms-2">
                                <h4 class="mb-0 text-white">{{Auth::user()->name}}</h4>
                                <p class=" mb-0">{{Auth::user()->email . '--'.Auth::user()->user_type}}</p>
                            </div>
                        </div>
                        <a class="dropdown-item" href="{{ route('profile.index') }}"><i data-feather="user" class="feather-sm text-success me-1 ms-1"></i>
                            {{translate('حسابى')}}
                        </a>




                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('website.main') }}"><i data-feather="settings" class="feather-sm text-warning me-1 ms-1"></i>
                                {{translate('اعدادت الموقع')}}
                            </a>


                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('logout')}}"><i data-feather="log-out"
                                                             class="feather-sm text-danger me-1 ms-1"></i> {{translate('تسجيل الخروج')}}</a>


                    </div>
                </li>

            </ul>
        </div>
    </nav>
</header>