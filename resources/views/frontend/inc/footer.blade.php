<section class="footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 p-2 py-4">
                @if(get_setting('footer_logo') != null)
                    <a href="{{ route('home') }}"> <img class="logo"
                                                        src="{{ uploaded_asset(get_setting('footer_logo')) }}"
                                                        loading="lazy" alt="{{ env('APP_NAME') }}"></a>
                @else
                    <a href="{{ route('home') }}"> <img class="logo" src="{{ static_asset('v3_assets/img/wlogo.svg') }}"
                                                        loading="lazy" alt="{{ env('APP_NAME') }}"></a>
                @endif
                <p class="info">
                    {{ translate(get_setting('title_about_us_description')) }}
                </p>
                <div class="socialIcons">
                    @if ( get_setting('facebook_link') !=  null )
                        <a href="{{ get_setting('facebook_link') }}" target="_blank" rel="noopener"
                           title="facebook link"><i class="fab fa-facebook-f"></i></a>
                    @endif
                    @if ( get_setting('twitter_link') !=  null )
                        <a href="{{ get_setting('twitter_link') }}" target="_blank" rel="noopener" title="twitter link"><i
                                    class="fab fa-twitter"></i></a>
                    @endif
                    @if ( get_setting('instagram_link') !=  null )
                        <a href="{{ get_setting('instagram_link') }}" target="_blank" rel="noopener"
                           title="instagram link"><i class="fab fa-instagram"></i></a>
                    @endif
                    @if ( get_setting('linkedin_link') !=  null )
                        <a href="{{ get_setting('linkedin_link') }}" target="_blank" rel="noopener"
                           title="linkedin link"><i class="fab fa-linkedin"></i></a>
                    @endif
                    @if ( get_setting('youtube_link') !=  null )
                        <a href="{{ get_setting('youtube_link') }}" target="_blank" rel="noopener" title="youtube link"><i
                                    class="fab fa-youtube"></i></a>
                    @endif
                    @if ( get_setting('tiktok_link') !=  null )
                        <a href="{{ get_setting('tiktok_link') }}" target="_blank" rel="noopener" title="tiktok link">
                            <img style="width: 16px;height: 16px" alt="tiktok" src="{{static_asset('v3_assets/img/tiktok.png')}}">
                        </a>
                    @endif
                        @if ( get_setting('snap_link') !=  null )
                            <a href="{{ get_setting('snap_link') }}" target="_blank" rel="noopener" title="snap link"><i
                                        class="fab fa-snapchat"></i></a>
                        @endif
                </div>
            </div>
            <div class=" col-sm-6 col-lg-3 p-2 py-4">
                <h5 class="head"> {{translate('خدمتنا')}} </h5>
                <div class="Links">
                    <ul>
                        @if ( get_setting('widget_one_labels') !=  null )
                            @foreach (json_decode( get_setting('widget_one_labels'), true) as $key => $value)
                                <li>
                                    <a href="{{ route(json_decode( get_setting('widget_one_links'), true)[$key]) }}">
                                        {{ translate($value) }}
                                    </a>
                                </li>

                            @endforeach
{{--                                <li>--}}
{{--                                    <a href="{{ route(json_decode( get_setting('widget_one_links'), true)[$key]) }}">--}}
{{--                                        {{ translate('رقم مسؤول نقل الكفالة : 0548454148') }}--}}
{{--                                    </a>--}}
{{--                                </li>--}}
                                @if(!empty(get_setting('contact_by_phone_transfer1')))
                                    <li>
                                        <a href="">
                                            {{translate('رقم مسؤول نقل الكفالة : ')}}  {{ get_setting('contact_by_phone_transfer1')  }}
                                        </a>
                                    </li>
                                @endif
                                @if(!empty(get_setting('contact_by_phone_transfer2')))
                                    <li>
                                        <a href="">
                                            {{translate('رقم مسؤول نقل الكفالة : ')}}  {{ get_setting('contact_by_phone_transfer2') }}
                                        </a>
                                    </li>
                                @endif

                        @endif
                    </ul>
                </div>
            </div>
            <div class=" col-sm-6 col-lg-5 p-2 py-4">
                <h5 class="head"> {{translate('المزيد')}} </h5>
                <div class="Links">
                    <div class="more">
                        <p><i class="fa-solid fa-map-location me-1"></i> {{translate('عنوان مقرنا').' : '}} </p>
                        <a href="#"> {{translate( get_setting('contact_address')) }}</a>
                    </div>
                    <div class="more">
                        <p><i class="fas fa-envelope me-1"></i> {{translate('البريد الالكتروني').' : '}} </p>
                        <a href="{{'mailto:'.get_setting('contact_email')}}">
                            {{get_setting('contact_email')}}
                        </a>
                    </div>
                    <div class="more">
                        <p><i class="fa-solid fa-phone me-1"></i> {{translate('المبيعات').' : '}}</p>
                        <a href="{{ 'tel:'.get_setting('contact_phone_1') }}"> {{ get_setting('contact_phone_1') }} </a>
                    </div>
                    <div class="more">
                        <p></p>
                        <a href="{{ 'tel:'.get_setting('contact_phone_2') }}"> {{ get_setting('contact_phone_2') }} </a>
                    </div>
                    <div class="more">
                        <p><i class="fa-solid fa-message-question me-1"></i>{{translate('الشكاوي والاقتراحات').' : '}}
                        </p>
                        <a href="{{ 'tel:'.get_setting('contact_phone') }}"> {{ get_setting('contact_phone') }} </a>
                    </div>
                    <div class="more">
                        <p><i class="fa-solid fa-info-circle"></i> {{translate('رقم السجل التجارى للمنشأة ').' : '}}
                        </p>
                        <a href="{{ 'tel:'.get_setting('contact_phone') }}"> {{ get_setting('ministry_commerce_num') }} </a>
                    </div>
                    <div class="more">
                        <p>
                            <i class="fa-solid fa-industry"></i> {{translate(' رقم المنشأة لدى وزارة الموارد البشرية ').' : '}}
                        </p>
                        <a href="{{ 'tel:'.get_setting('contact_phone') }}"> {{ get_setting('ministry_human_num') }} </a>
                    </div>
                </div>
                <div class="OurSupport">
                    <p style="text-align:right">
                        <a href="{{ get_setting('ma3rof_link') }}" target="_blank" rel="noopener noreferrer">
                            <img data-original="https://www.tarafalamal.sa/public/maroof.webp" alt="{{ get_setting('ma3rof_link') }}"  class="lazyimgs" height= "20px" width="20px" style="-o-object-fit: contain;object-fit: contain;margin: 0 5px;">
                        </a>
                        <a href="{{ get_setting('musaned_link') }}" target="_blank" rel="noopener noreferrer">
                            <img data-original="https://www.tarafalamal.sa/public/musaned.webp" alt="{{ get_setting('musaned_link') }}" class="lazyimgs" height="20px"  width="20px" style=";-o-object-fit: contain;object-fit: contain;margin: 0 5px;">
                        </a>
                        <a href="https://www.rawafdnajd.sa/public/sa1.webp"  target="_blank" rel="noopener noreferrer">
                            <img data-original="https://www.tarafalamal.sa/public/sa1.webp" alt="https://www.tarafalamal.sa/public/sa1.webp" height="20px"   width="20px" style="-o-object-fit: contain;object-fit: contain;margin: 0 5px;" class="lazyimgs">
                        </a>


                    </p>
                </div>
            </div>
        </div>
        <div class="Copyright">

            <p>
                {{translate('جميع الحقوق محفوظة')}}<a target="_blank" rel="noopener"
                                                      href="/">&nbsp; {{ translate(env('APP_NAME')) }} </a> &copy;
                <script>
                    document.write(new Date().getFullYear())
                </script>


            </p>

        </div>
    </div>
</section>
<!-- script icons-->
@if(Request::url()!=route('select_staff_whatsapp'))
<div class="support">
    <div class="links">
        <?php
        $whats = preg_replace('/[^0-9]/', '', get_setting('contact_whats_2'));
        $link = 'https://api.whatsapp.com/send?phone=' . $whats;
        ?>

        <a href="https://wa.me/message/IFNC6TVW5EBPH1" target="_blank" rel="noopener" class="whatsapp">
            <i class="fa-brands fa-whatsapp"></i>
        </a>
        <a href="{{ 'tel:'.get_setting('contact_by_phone') }}" target="_blank" rel="noopener" class="call">
            <i class="fa-light fa-phone"></i>
        </a>

    </div>
    <div class="supportBtn supportBtnToggle">
        <i class="fa-solid fa-headset"></i>
    </div>


</div>

<div class="sideSocial d-md-flex">
    @if ( get_setting('facebook_link') !=  null )
        <a href="{{ get_setting('facebook_link') }}" target="_blank" rel="noopener"
           title="facebook link"><i class="fab fa-facebook-f"></i></a>
    @endif
    @if ( get_setting('twitter_link') !=  null )
        <a href="{{ get_setting('twitter_link') }}" target="_blank" rel="noopener" title="twitter link"><i
                    class="fab fa-twitter"></i></a>
    @endif
    @if ( get_setting('instagram_link') !=  null )
        <a href="{{ get_setting('instagram_link') }}" target="_blank" rel="noopener"
           title="instagram link"><i class="fab fa-instagram"></i></a>
    @endif
{{--    @if ( get_setting('linkedin_link') !=  null )--}}
{{--        <a href="{{ get_setting('linkedin_link') }}" target="_blank" rel="noopener"--}}
{{--           title="linkedin link"><i class="fab fa-linkedin"></i></a>--}}
{{--    @endif--}}
{{--    @if ( get_setting('youtube_link') !=  null )--}}
{{--        <a href="{{ get_setting('youtube_link') }}" target="_blank" rel="noopener" title="youtube link"><i--}}
{{--                    class="fab fa-youtube"></i></a>--}}
{{--    @endif--}}
    @if ( get_setting('snap_link') !=  null )
        <a href="{{ get_setting('snap_link') }}" target="_blank" rel="noopener" title="snap link"><i
                    class="fab fa-snapchat"></i></a>
    @endif
    @if ( get_setting('tiktok_link') !=  null )
        <a href="{{ get_setting('tiktok_link') }}" target="_blank" rel="noopener" title="tiktok link">
            <img style="width: 16px;height: 16px"  alt="{{request()->path()}}" src="{{static_asset('v3_assets/img/tiktok_wh.png')}}">
        </a>
    @endif
{{--    <a href="{{'https://www.facebook.com/sharer/sharer.php?u='.url()->current().'&amp;src=sdkpreparse'}}"--}}
{{--       class="facebook" target="_blank"> <i class="fa-brands fa-facebook-f"></i> </a>--}}
{{--    <a href="{{'https://twitter.com/intent/tweet?url='.url()->current()}}" class="twitter" target="_blank"> <i--}}
{{--                class="fa-brands fa-twitter"></i> </a>--}}
{{--    <a href="{{'https://wa.me/?text='.url()->current()}}" class="instagram" target="_blank"> <i--}}
{{--                class="fa-brands fa-whatsapp"></i> </a>--}}
    {{--    <a href="#!" class="snapchat" target="_blank"> <i class="fa-brands fa-snapchat"></i> </a>--}}
</div>
@endif
<?php

?>
        <!--<div class="support divButton" style=" left:auto;right:0;">-->

<!--    <div class="supportBtn divButton "  style="background-color:red    ;-->
<!--">-->
<!--        <a class="video-btn call" target="_blank" rel="noopener" style="background-color:red"  href="" data-bs-toggle="modal" data-src="{{ get_setting('contact_video_info') }}" data-bs-target="#myModal">-->
<!--            <i class="fa-light fa-video" style="background-color:red"></i>-->
<!--        </a>-->

<!--{{--        <i class="fa-solid fa-headset"></i>--}}-->
<!--    </div>-->


<!--</div>-->