@if (count($cvs)>0)
        @foreach($cvs  as $key=> $cv)
            <div class="col-md-6 col-lg-4 p-2">
                <div class="workerCv">

                    <div class="swiper workerCvSlider ">
                        <div class="swiper-wrapper">
                            <!-- cv image -->

                            @if(!empty($cv->images))

                                @foreach(json_decode($cv->images) as $key2=>$val2)
                                        <?php

                                        $agent = new \Jenssegers\Agent\Agent();

                                        ?>
                                    @if($key2 ==0 && !empty($cv->new_image))
                                        <div class="swiper-slide ">
                                            <a data-fancybox="{{'user'.($key+1).'-CV'}}" href="{{static_asset($cv->new_image)}}">
                                                <img alt="{{request()->path()}}" data-original="{{static_asset($cv->new_image)}}" src="{{static_asset($cv->new_image)}}"  class=" lazyimgs"  width="100%" height="100%" alt="{{ env('APP_NAME') }}"  >
                                                {{--                                                            <p  class="fs-6 px-lg-5 " style="  position: absolute; top: 50px;left:-41px;background-color: gold;color: #fff;pointer-events: none;font-weight: bold;-webkit-transform: rotate(-45deg);-moz-transform: rotate(-45deg);">خصومات شهر الخير </p>--}}
                                            </a>
                                        </div>
                                    @endif

                                    <div class="swiper-slide ">
                                        <a data-fancybox="{{'user'.($key+1).'-CV'}}" href="{{static_asset(ltrim($val2, '/'))}}">
                                            <img  data-original="{{static_asset(ltrim($val2, '/'))}}" src="{{static_asset(ltrim($val2, '/'))}}" class="lazyimgs lazyimgs" @if($agent->isPhone() && $key !=0) loading="lazy" @endif width="100%" height="100%" alt="{{ env('APP_NAME') }}"  >
                                        </a>
                                    </div>

                                @endforeach
                            @endif
                        </div>
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                    </div>

                    <ul class="info">
                        <li>
                            <h6>{{translate('الجنسية')}} : </h6>
                            <p>  {{$cv->nationality->name??''}} </p>
                        </li>
                        <li>
                            <h6>{{translate('المهنة')}} :</h6>
                            <p>  {{$cv->recruitmentFormOccupation->name??''}}  </p>
                        </li>
                        <li>
                            <h6> {{translate('الديانة')}} :</h6>
                            <p>  {{$cv->recruitmentFormReligion->name??''}}</p>
                        </li>
                        <li>
                            <h6>{{translate('سعر الاستقدام')}} : </h6>
                            <p>
                                @if($cv->service_price !=null)
                                    {{  $cv->service_price }}
                                @elseif($cv->nationality !=null)
                                    {{translate($cv->nationality->salary) }}

                                @else
                                    "--"
                                @endif
                                {{translate('ريال')}}
                            </p>
                        </li>

                        <li>
                            <h6>{{translate(' الحالة الاجتماعية')}} :</h6>
                            <span> {{$cv->recruitmentFormSocialStatus->name??''}}</span>

                        </li>

                        <li>
                            <h6> {{translate('الخبرة العملية')}} : </h6>
                            <p> {{$cv->recruitmentFormExperience->name??''}}</p>
                        </li>
                    </ul>
                    <div class="text-center pt-4">
                        <p style="color: red; border:red; border-width:1px; border-style:solid;">{{translate('لضمان حقك، لا يتم سداد الرسوم بعد الحجز إلا عند طريق منصة مساند')}}</p>

                        <br>
                        @if($cv->is_booking==0 )

                            <a  href="javascript:void(0)" class="defaultBtn " onclick="copyUrl(this)" data-url="{{$cv->id}}"><span></span> {{translate('حجز السيرة الذاتية')}} </a>
                        @else
                            <a  href="javascript:void(0)" class="defaultBtn"><span></span> {{translate('محجوز')}} </a>
                        @endif
                        <a  class="defaultBtn "  @if(!empty($cv->images)&& json_decode($cv->images) !=[]) href="{{static_asset(json_decode($cv->images)[0])}}" download @endif style="background-color: white;color: #A505A;border-color: #A505A"  ><span></span> {{translate('تنزيل السيرة الذاتية')}} </a>
                        @if(!empty($cv->url))
                        <a  href="javascript:void(0)" data-url="{{$cv->url}}" class=" defaultBtn watch-more"> {{translate("فديو العامل/ة")}} </a>
                        @endif
                    </div>
                </div>
            </div>






        @endforeach


@else
    <section class="pageError">
        <div class="container">
            <div class="notFound">
                <img src="{{ static_asset('assets/img/empty_state.jpg') }}" alt="{{ env('APP_NAME') }}">
                <h3> {{translate("ما لقيت طلبك ؟! لا تشيل هم وتواصل معنا ")}}. </h3>
                <br>
                {{--                                <a class="defaultBtn " href="@auth{{route('recruitment.request')}}@else {{ route('user.login')}}@endif"><span></span> {{translate(' طلب خاص')}} </a>--}}
                <a class="defaultBtn"  href="tel:8003030309"><span></span> {{translate('اتصال مباشر')}} </a>

            </div>
        </div>
    </section>
@endif


