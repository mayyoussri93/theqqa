{{--@section('style')--}}
{{--    <!-- Swiper CSS -->--}}
{{--    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">--}}

{{--    <!-- Fancybox CSS -->--}}
{{--    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0.0/dist/fancybox.css">--}}
{{--@endsection--}}

@if (count($cvs)>0)
        @foreach($cvs  as $key=> $val_sponsor)

            <div class="col-md-6 col-lg-4 p-2">
                <div class="workerCv">

                    <!-- First Slider: CV Images -->
                    <div class="swiper workerCvSlider">
                            <div class="swiper-wrapper">
                                    <?php
                                    $cv = $val_sponsor->contract->reservation->cv;
                                    $agent = new \Jenssegers\Agent\Agent();
                                    ?>

                                            <!-- Loop through CV Images -->
{{--                                @if(!empty($cv->images))--}}
{{--                                    @foreach(json_decode($cv->images) as $key2 => $cv2)--}}
{{--                                        <div class="swiper-slide">--}}
{{--                                            <a data-fancybox="{{'user'.($key+1).'-Unified'}}" href="{{ static_asset(ltrim($cv2, '/')) }}">--}}
{{--                                                <img--}}
{{--                                                        data-original="{{ static_asset(ltrim($cv2, '/')) }}"--}}
{{--                                                        src="{{ static_asset(ltrim($cv2, '/')) }}"--}}
{{--                                                        class="lazyimgs"--}}
{{--                                                        @if($agent->isPhone() && $key2 != 0) loading="lazy" @endif--}}
{{--                                                        style="width: 100%; height: auto;"--}}
{{--                                                        alt="{{ env('APP_NAME') }}">--}}
{{--                                            </a>--}}
{{--                                        </div>--}}
{{--                                    @endforeach--}}
{{--                                @endif--}}
                                            <!-- Transfer Picture Slide -->
                                @if(!empty($cv->transfer_pic))
                                    <div class="swiper-slide" style="height: auto;width: 900px">
                                        <a data-fancybox="{{'user'.($key+1).'-Unified'}}" href="{{ static_asset($cv->transfer_pic) }}">
                                            <img
                                                    data-original="{{ static_asset($cv->transfer_pic) }}"
                                                    src="{{ static_asset($cv->transfer_pic) }}"
                                                    class="lazyimgs"
                                                    style="width: 100%; height: 100%;"
                                                    alt="{{ env('APP_NAME') }}">
                                        </a>
                                    </div>
                                @endif

                                <!-- Transfer Video Slide -->
                                <!-- Video URL Slide -->
                                @if(!empty($cv->transfer_vedio))
                                    <div class="swiper-slide" style="height: auto;width: 900px">
                                        <iframe src="{{ $cv->transfer_vedio }}" data-fancybox="{{'user'.($key+1).'-Unified'}}"
                                                style=" top: 0; left: 0; width: 100%; height: 100%"
                                                frameborder="0"
                                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                                allowfullscreen>
                                        </iframe>
                                        {{--                                <a data-fancybox="{{'user'.($key+1).'-Unified'}}" href="{{ $cv->transfer_vedio }}">--}}
                                        {{--                                    <video controls style="width: 100%; height: auto;">--}}
                                        {{--                                        <source src="{{ $cv->transfer_vedio }}" data-type="iframe" type="video/mp4">--}}
                                        {{--                                        Your browser does not support the video tag.--}}
                                        {{--                                    </video>--}}
                                        {{--                                </a>--}}
                                    </div>
                                @endif
                            </div>





                            <!-- Swiper Navigation Buttons -->
                            <div class="swiper-button-next"></div>
                            <div class="swiper-button-prev"></div>
                        </div>



                        <ul class="info">
                        <li>
                            <h6 class="data">{{translate('الجنسية')}} : </h6>
                            <p>  {{$cv->nationality->name??''}} </p>
                        </li>
                        <li>
                            <h6> {{translate('الديانة')}} :</h6>
                            <p>  {{$cv->recruitmentFormReligion->name??''}}</p>
                        </li>

                        <li>
                            <h6> {{translate('العمر')}} : </h6>
                            <p> {{$cv->age_id??"--"}} </p>
                        </li>
                        <li>
                            <h6>{{translate('رسوم نقل الكفاله')}}  :</h6>
                            <p> {{ $cv->nationality->sponsor_salary.translate(" ريال ")}} </p>
                        </li>
                        <li>
                            <h6>{{translate('رقم الجواز')}}  :</h6>
                            <p> {{$cv->passport_id??"--"}} </p>
                        </li>
                        <li>
                            <h6>{{translate('مدة العمل عند الكفيل السابق')}}  :</h6>
                            <p> {{($val_sponsor->contract->durationWorkSponsor !=null)?$val_sponsor->contract->duration_type.' '.translate($val_sponsor->contract->durationWorkSponsor->name):"--"}} </p>
                        </li>
                    </ul>
                    <div class="text-center pt-4">
                        <br>
                        <a   class="defaultBtn" href="{{route('chooseSponsorService',['cv_sponsorship_id'=>$val_sponsor->id])}}" >{{translate('احجز الأن')}}</a>
                        <a  class="defaultBtn "  @if(!empty($cv->images)&& json_decode($cv->images) !=[]) href="{{static_asset(json_decode($cv->images)[0])}}" download @endif style="background-color: white;color: #A505A;border-color: #A505A"  ><span></span> {{translate('تنزيل السيرة ')}} </a>
                        @if(!empty($cv->transfer_vedio))
                            @php
                                $videoUrl = $cv->transfer_vedio;
                                // Check if the URL is a YouTube link
                                if (preg_match('/youtu\.be\/|youtube\.com/', $videoUrl)) {
                                    // Extract YouTube video ID from URL
                                    preg_match('/[\\?\\&]v=([^\\?\\&]+)/', $videoUrl, $matches);
                                    $video_id = $matches[1] ?? null;
                                    $embedUrl = $video_id ? "https://www.youtube.com/embed/{$video_id}" : null;
                                }
                            @endphp

                            @if(isset($embedUrl))
                                <!-- Link button for YouTube videos -->
                                <a href="{{ $embedUrl }}" data-fancybox data-type="iframe" class="defaultBtn mx-1">
                                    {{ translate('فيديو') }}
                                    <i class="fa-solid fa-video ms-2"></i>
                                    <span></span>
                                </a>
                            @else
                                <!-- Link button for direct video URLs -->
                                <a href="{{ $videoUrl }}" data-fancybox data-type="iframe" class="defaultBtn mx-1">
                                    {{ translate('فيديو') }}
                                    <i class="fa-solid fa-video ms-2"></i>
                                    <span></span>
                                </a>
                            @endif
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

@section('script')



                    <!-- Swiper JS -->
{{--                    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>--}}

{{--                    <!-- Fancybox JS -->--}}
{{--                    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0.0/dist/fancybox.umd.js"></script>--}}

{{--    <script>--}}
{{--        document.addEventListener('DOMContentLoaded', function () {--}}
{{--            new Swiper('.unifiedSlider', {--}}
{{--                navigation: {--}}
{{--                    nextEl: '.swiper-button-next',--}}
{{--                    prevEl: '.swiper-button-prev',--}}
{{--                },--}}
{{--                lazy: true,--}}
{{--            });--}}
{{--        });--}}

{{--    </script>--}}

@endsection
