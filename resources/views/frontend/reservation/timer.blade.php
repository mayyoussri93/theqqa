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
    <!-- ================ contact Customer Service ================= -->
    <section class="contactCustomerService">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 p-2">
                    <div class="selectedCustomer">
                        <h6>{{translate(" يرجى التواصل مع  ")}}<span> {{$user->name}} </span>{{translate(" الذى قمت باختياره فى خلال ").get_setting('reservation_timer').translate("  ساعة حتى لا يتم إلغاء حجز السيرة الذاتية" )}}
                        </h6>

                        <div id="timer">
                            <div id="days"></div>
                            <div id="hours"></div>
                            <div id="minutes"></div>
                            <div id="seconds"></div>
                        </div>
                    </div>
                    <div class="selectedCustomerInfo">
                        <div class="row">
                            <div class="col-md-6 p-1 wow fadeInUp">
                                <div class="info">
                                    <img src="{{ static_asset('v3_assets/img/avater2.webp') }}" alt="{{ env('APP_NAME') }}">
                                    <div class="text">
                                        <h5>{{$user->name}}</h5>
                                        <p>{{translate('خدمة العملاء')}}</p>
                                    </div>
                                </div>
                            </div>
                            <?php
                            $whats  = preg_replace('/[^0-9]/', '',  $user->whatsapp_phone);
                            $link='https://api.whatsapp.com/send?phone='.$whats;
                            ?>
                            <div class="col-6 col-md-3 p-1 wow fadeInUp">
                                <a class="contact" href="{{$link}}" target="_blank" rel="noopener">
                                    <i class="me-2 fa-brands fa-whatsapp-square"></i>
                                    <p>{{translate('تواصل عير الواتس اب')}}</p>
                                </a>
                            </div>
                            <div class="col-6 col-md-3 p-1 wow fadeInUp">
                                <a class="contact" href="{{'tel:'.$user->phone}}" target="_blank" rel="noopener">
                                    <i class="me-2 fa-solid fa-square-phone"></i>
                                    <p>{{translate('تواصل عبر الهاتف')}} </p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection


@section('script')

    <script>


         function makeTimer() {
             // month , day , year , time24
             var endTime = "{{date( "Y-m-d H:i:s", strtotime( $created)  + get_setting('reservation_timer') * 3600 )}}";
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
         setInterval(function () { makeTimer(); }, 0);
    </script>



@endsection
