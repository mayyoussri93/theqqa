<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- User profile -->


        <!-- End User profile text-->
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">



                @if(Auth::user()->user_type == 'admin' || array_intersect([94,95,96,97,98,99,100,101,102,103,104,105,106,107,108,109,110,111,112,113,114,115,116,117,162], json_decode(Auth::user()->staff->role->permissions)))

                    <li class="sidebar-item">
                        <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                            <i class="mdi mdi-settings"></i>
                            <span class="hide-menu"> {{translate('الاعدادات')}}</span>
                        </a>
                        <ul aria-expanded="false" class="collapse  first-level">
                                <li class="sidebar-item">
                                    <a href="{{ route('website.main') }}" class="sidebar-link  waves-effect waves-dark {{ areActiveRoutes(['website.main']) }}">
                                        <i class="mdi mdi-adjust"></i><span class="hide-menu"> {{ translate('اعدادات الصفحة الرئيسية') }} </span>
                                    </a>
                                </li>
                            

                                <li class="sidebar-item">

                                    <a href="{{ route('contact_us.index') }}"
                                       data-href="{{areActiveRoutes(['contact_us.index','contact_us.show'])}}"
                                       class="sidebar-link  waves-effect waves-dark">
                                        <span class="hide-menu"> {{ translate('جميع تواصل معنا') }} </span>
                                    </a>
                                </li>
                            <li class="sidebar-item">

                                <a href="{{ route('subscribers.index') }}"
                                   data-href="{{areActiveRoutes(['subscribers.index','subscribers.show'])}}"
                                   class="sidebar-link  waves-effect waves-dark">
                                    <span class="hide-menu"> {{ translate('جميع المشتركين') }} </span>
                                </a>
                                </li>

                        </ul>
                    </li>
                @endif
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
    <!-- Bottom points-->
    <div class="sidebar-footer">

        <a href="{{ route('logout')}}" class="link" data-bs-toggle="tooltip" data-bs-placement="top" title="{{translate('الخروج')}}"><i
                    class="mdi mdi-power"></i></a>

    </div>
    <!-- End Bottom points-->
</aside>