@extends('frontend.layouts.app')
<?php
$title_seo=get_seo_title_setting(request()->path()).Request::getRequestUri();
$desc_seo=get_seo_description_setting(request()->path()). json_encode( request()->query());
$keys_seo=get_seo_keys_setting(request()->path());

?>
@section('meta_title'){{$title_seo}}  @stop
@section('meta_description'){{$desc_seo}}@stop
@section('meta_keywords')        {{$desc_seo}}@stop

@section('meta')
    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name" content="{{$title_seo}}">
    <meta itemprop="description" content="{{$desc_seo}}">

@endsection
<!-- Twitter Card data -->

@section('meta_product_twitter'){{$title_seo}}  @stop
@section('meta_title_twitter'){{$title_seo}}  @stop
@section('meta_keywords_twitter')   {{$desc_seo}} @stop
@section('meta_description_twitter')     {{$desc_seo}} @stop
@section('meta_creator_twitter')        {{$title_seo}}  @stop

<!-- Open Graph data -->
@section('meta_og_title')        {{$title_seo}}  @stop
@section('meta_og_url')      {{Request::fullUrl() }}  @stop
@section('meta_og_description')        {{$desc_seo}} @stop

@section('style')
    <style>
        .watch-more {
            display: inline-block;
            color: #424B5A;
            font-size: 14px;
            text-decoration: none;
            margin-top: 15px;

            &:hover,
            &:focus,
            &:active {
                color: #626e84;
            }
        }

        /* The Modal (background) */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.4);
        }
        .video-popup {
            display: none;
            z-index: 2;
            position: absolute;
            top: 20%;
            left: 50%;
            -webkit-transform: translateX(-50%);
            transform: translateX(-50%);
            border: 1px solid #ccc;
            padding: 10px 20px;
            background-color: #fff;
            border-radius: 4px;

            &.visible {
                display: block;
            }

            .close {
                position: absolute;
                right: 8px;
                /*top: -3px;*/
                font-weight: 900;
                font-size: 50px;
                color: black;
                padding: 5px 10px;
                border-bottom: none;
                cursor: pointer;
            }
        }

        .video-wrapper {
            width: 1200px;
            margin: 30px auto;

            @media only screen and (max-width: 560px) {
                width: 250px;
            }

            .video-container {
                position: relative;
                padding-bottom: 55.25%;
                height: 0;
                overflow: hidden;

                iframe {
                    position: absolute;
                    top: 0;
                    left: 0;
                    width: 100%;
                    height: 100%;
                }
            }
        }



    </style>
@endsection
@section('link')
    <link rel="canonical" href="{{Request::fullUrl() }}" />
@endsection
@section('content')
    <!-- ================ for seo ================= -->
    <h1 style="display: none">{{get_seo_h1_setting(request()->path()).'  '.(Request::query()==[])?(Request::getRequestUri()):Request::query()['page'].' .'}}</h1>
    <!-- ================  for seo ================= -->

    <!-- ================ spinner ================= -->
    <div class="spinner">
        <div class="sk-folding-cube">
            <div class="sk-cube1 sk-cube"></div>
            <div class="sk-cube2 sk-cube"></div>
            <div class="sk-cube4 sk-cube"></div>
            <div class="sk-cube3 sk-cube"></div>
        </div>
    </div>
    <!-- Main Banner  -->
    <section  class="mainBanner" >
                <button onclick="goBack()" class="Back">
                    <i class="fas fa-angle-left"></i>
                </button>
                <ul>
                    <li>
                        <a href="{{ route('home') }}"> {{translate('الرئيسية')}} </a>
                    </li>
                    <li>
                        <a href="{{route('all_cvs')}}" class="active"> {{translate('طلب استقدام')}} </a>
                    </li>
                </ul>
        <figure>
            <svg xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none" x="0px" y="0px" viewBox="0 0 300 100"
                 style="margin-bottom:-35px;enable-background:new 0 0 300 100" class="injected-svg js-svg-injector"
                 data-parent="#SVGwave1BottomSMShape">
                <g>
                    <path class="wave-bottom-1-sm-0" fill="#fdfdfd" opacity=".8"
                          d="M10.9,63.9c0,0,42.9-34.5,87.5-14.2c77.3,35.1,113.3-2,146.6-4.7C293.7,41,315,61.2,315,61.2v54.4H10.9V63.9z">
                    </path>
                    <path class="wave-bottom-1-sm-0" fill="#fdfdfd" opacity=".6"
                          d="M-55.7,64.6c0,0,42.9-34.5,87.5-14.2c77.3,35.1,113.3-2,146.6-4.7c48.7-4.1,69.9,16.2,69.9,16.2v54.4H-55.7     V64.6z">
                    </path>
                    <path class="wave-bottom-1-sm-0 " fill="#fdfdfd" opacity=".4" fill-opacity="0"
                          d="M23.4,118.3c0,0,48.3-68.9,109.1-68.9c65.9,0,98,67.9,98,67.9v3.7H22.4L23.4,118.3z"></path>
                    <path class="wave-bottom-1-sm-0" fill="#fdfdfd"
                          d="M-54.7,83c0,0,56-45.7,120.3-27.8c81.8,22.7,111.4,6.2,146.6-4.7c53.1-16.4,104,36.9,104,36.9l1.3,36.7l-372-3     L-54.7,83z">
                    </path>
                </g>
            </svg>
        </figure>
    </section>
    <!-- ================ spinner ================= -->
    <section class="filter">
        <div class="container">
            <h4 class="px-3"> {{translate('بحث متقدم')}} </h4>
            <form action="" method="GET" class="row align-items-center align-items-md-end">
                <div class="col-sm-10 col-md-8 p-2">
                    <div class="row flex-wrap">
                        <!-- age -->
                        @if(count($ages) > 0)
                            <div class="col p-1">
                                <label for="age"> <i class="fa-duotone fa-hourglass me-1"></i> {{translate('العمر')}} </label>
                                <select  id="age" name="age"  class="select2WithoutSearch select2">
                                    <option value="" selected > {{translate('الكل')}} </option>
                                    @foreach ($ages as $key => $value)

                                        <option value="{{ $value->id }}" >{{$value->name.translate('سنة')}} </option>
                                    @endforeach
                                </select>
                                </select>
                            </div>
                        @endif
                        @if(count($jobs) > 0)
                            <!-- Occupation -->
                            <div class="col p-1">
                                <label for="job"> <i class="fa-duotone fa-briefcase me-1"></i>  {{translate('المهنة')}} </label>
                                <select  id="job" name="job" class="select2WithoutSearch select2" >
                                    <option value="" selected > {{translate('الكل')}} </option>
                                    @foreach ($jobs as $key => $value)
                                        <option value="{{ $value->id }}" >{{ translate($value->name) }}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endif
                        @if(count($religions) > 0)
                            <!-- Occupation -->
                            <div class="col p-1">
                                <label for="religion"> <i class="fa-solid fa-kaaba me-1"></i>  {{translate('الديانة')}} </label>
                                <select  id="religion" name="religion" class="select2WithoutSearch select2" >
                                    <option value="" selected > {{translate('الكل')}} </option>
                                    @foreach ($religions as $key => $value)
                                        <option value="{{ $value->id }}" >{{ translate($value->name) }}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endif
                        @if(count($experiences) > 0)
                            <!-- Occupation -->
                            <div class="col p-1">
                                <label for="religion"> <i class="fa-duotone fa-star me-1"></i>  {{translate('الخبره')}} </label>
                                <select  id="experience" name="experience" class="select2WithoutSearch select2">
                                    <option value="" selected > {{translate('الكل')}} </option>
                                    @foreach ($experiences as $key => $value)
                                        <option value="{{ $value->id }}" >{{ translate($value->name) }}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endif
                        @if(count($nationalities) > 0)
                            <!-- Nationality -->
                            <div class="col p-1">
                                <label for="nationality"> <i class="fa-duotone fa-flag me-1"></i> {{translate('الجنسية')}} </label>
                                <select  id="nationality" name="nationality"  class="select2WithoutSearch select2">
                                    <option value="" selected > {{translate('الكل')}} </option>
                                    @foreach (\App\Models\Nationality::where('status', 1)->get() as $key => $country)
                                        <option value="{{ $country->id }}" @isset($_GET['nationality'])@if($_GET['nationality']== $country->id ) selected @endif @endisset >{{ translate($country->name) }}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-sm-2 col-md-4 p-1 d-flex align-items-center justify-content-end flex-wrap">
                    <a href="{{route('all_cvs')}}" id="SearchResetButton" type="button" class=" btn clear m-1 " style="display: none"> {{translate('مسح')}}
                        <span></span>
                    </a>
                    <button id="SearchWorkerButton"  type="submit" class="defaultBtn m-1" >{{translate('تطبيق')}}
                        <span></span>
                    </button>
                </div>
            </form>
        </div>
    </section>

    <section class="allWorkers">
        <div class="container">
            <div >


                    <div  class="row" id="hereWillDisplayAllWorker">
                        @include('frontend.reservation.reservation_worker.workers_page')
                    </div>


                    {{--------------   load more  -----------------}}
                    <div style="{{$last_page == $current_page ?"display:none !important;":""}}"
                         class="d-flex align-items-center justify-content-center py-5 " id="buttonOfFilter">
                        <button id="load_more_button" class="defaultBtn" type="button">
                             {{translate('تحميل المزيد')}}
                        </button>
                    </div>



            </div>
            <!-- custom Order -->
            <div class="alert  fade show customOrder wow fadeInUp" role="alert">
                <button type="button" class="btn-close p-2" data-bs-dismiss="alert" aria-label="Close"></button>
                <h6>{{translate('يمكننا توفير العمالة المناسبة طبقا لمواصفاتك الخاصه')}} </h6>


                <a href="@auth{{route('recruitment.request')}}@else {{ route('user.login')}}@endif" class="defaultBtn mx-1">
                    {{translate('تقديم طلب خاص')}}
                    <span></span>
                </a>

            </div>
            <!-- end custom Order -->
        </div>
        <!-- Modal -->
    </section>



    <!-- The Modal -->
    <div id="modal" class="modal">
    <div class="video-popup">
        <a class="close">&times;</a>
        <!-- Modal content -->
        <div class="video-wrapper">
            <div class="video-container">
                <iframe width="1200" height="675"  id="cv_url_ifram" src="" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
        </div>
    </div>
    </div>

@endsection

@section('script')
    <script>
        $(document).ready(function() {
// Watch More Link click handlers
            const $popup = $('.video-popup');
            const $modal = $('#modal');
            const $closeIcon = $('.close');
            const $watchMoreLink = $('.watch-more');

            $watchMoreLink.click(function(e) {
                $('#cv_url_ifram').attr('src',$(this).data("url"));

                $popup.fadeIn(200);
                $modal.fadeIn(200);
                e.preventDefault();
            });
            $closeIcon.click(function () {
                $popup.fadeOut(200);
                $modal.fadeOut(200);
            });
            // for escape key
            $(document).on('keyup',function(e) {
                if (e.key === "Escape") {
                    $popup.fadeOut(200);
                    $modal.fadeOut(200);
                }
            });
            // click outside of the popup, close it
            $modal.on('click', function(e){
                console.log(":P");
                $popup.fadeOut(200);
                $modal.fadeOut(200);
            });
        });
    </script>
    <script>
        $(document).ready(function () {
            @isset($_GET['nationality'])
                console.log(":pp");
            $('#SearchWorkerButton').trigger('click');

            @endisset
        });
        var loader_html = `
  <div class="col-sm-6 col-md-6 col-lg-4 p-2 loader_html ">
                  <div class="wrapper">
                    <div class="wrapper-cell row">
                       <div class="col-12">
                        <div class="image"></div>
                       </div>
                        <div class="col-12">
                            <div class="text">
                                <div class="text-line"></div>
                                <div class="text-line price"></div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
 <div class="col-sm-6 col-md-6 col-lg-4 p-2 loader_html">
                  <div class="wrapper">
                    <div class="wrapper-cell row">
                       <div class="col-12">
                        <div class="image"></div>
                       </div>
                        <div class="col-12">
                            <div class="text">
                                <div class="text-line"></div>
                                <div class="text-line price"></div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>

        <div class="col-sm-6 col-md-6 col-lg-4 p-2 loader_html">
                  <div class="wrapper">
                    <div class="wrapper-cell row">
                       <div class="col-12">
                        <div class="image"></div>
                       </div>
                        <div class="col-12">
                            <div class="text">
                                <div class="text-line"></div>
                                <div class="text-line price"></div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>

            <div class="col-sm-6 col-md-6 col-lg-4 p-2 loader_html">
                  <div class="wrapper">
                    <div class="wrapper-cell row">
                       <div class="col-12">
                        <div class="image"></div>
                       </div>
                        <div class="col-12">
                            <div class="text">
                                <div class="text-line"></div>
                                <div class="text-line price"></div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>

                <div class="col-sm-6 col-md-6 col-lg-4 p-2 loader_html">
                  <div class="wrapper">
                    <div class="wrapper-cell row">
                       <div class="col-12">
                        <div class="image"></div>
                       </div>
                        <div class="col-12">
                            <div class="text">
                                <div class="text-line"></div>
                                <div class="text-line price"></div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>

                <div class="col-sm-6 col-md-6 col-lg-4 p-2 loader_html">
                  <div class="wrapper">
                    <div class="wrapper-cell row">
                       <div class="col-12">
                        <div class="image"></div>
                       </div>
                        <div class="col-12">
                            <div class="text">
                                <div class="text-line"></div>
                                <div class="text-line price"></div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>`;


        //load more script
        var new_page = 1;
        var url = '{{route('all_cvs')}}';
        @if(isset($transfer))
        var link_only = '{{route('transferService')}}';
        @else
        var link_only = '{{route('all_cvs')}}';
        @endif
        var age = $("#age").val();
        var job = $("#job").val();
        var experience = $("#experience").val();
        var religion = $("#religion").val();
        var nationality = $("#nationality").val();

        $(document).unbind("click").on('click', '#load_more_button', function (e) {
            e.preventDefault()
            ++new_page
            // console.log("new page" , new_page)
            loadMoreData(new_page);
        }) //end fun

        function loadMoreData(new_page) {

            url = link_only + "?page=" + new_page + "&age=" + "" + "&job=" + job + "&nationality=" + nationality + "&religion=" + religion + "&experience=" + experience

            $.ajax({
                url: url,
                type: 'GET',
                beforeSend: function () {
                    $('#hereWillDisplayAllWorker').append(loader_html);
                    $('#load_more_button').html(`<div class="spinner-border mt-1 mb-2" role="status"> </div>`);
                },
                complete: function () {

                },
                success: function (data) {
                    console.log('PPkkk');

                    console.log(data.last_page, data.current_page)
                    if (data.last_page == data.current_page) {
                        document.getElementById("load_more_button").remove();
                    }

                    setTimeout(function () {
                        var elements = document.getElementsByClassName("loader_html");
                        while (elements.length > 0) elements[0].remove();
                        // var elements = document.getElementsByClassName("loader_html");
                        //while (elements.length > 0) elements[0].remove();
                        $('#hereWillDisplayAllWorker').append(data.html);
                        $('#load_more_button').html(`

                   <button id="load_more_button" class="defaultBtn">
                         {{translate('تحميل المزيد')}}
                        <i class="fa-regular fa-left-long ms-2"><span></span></i>
                    </button>
`)


                    }, 100);
                },
                error: function (data) {
                    alert('Something went wrong.');
                }, //end error method

                cache: false,
                contentType: false,
                processData: false
            });

        } //end fun


        $(document).on('click', '#SearchWorkerButton', function (e) {
            e.preventDefault();
            new_page = 1;
            age = $("#age").val();
            job = $("#job").val();
         experience = $("#experience").val();
            religion = $("#religion").val();
            nationality = $("#nationality").val();
            url = link_only + "?page=" + new_page + "&age=" + "" + "&job=" + job + "&nationality=" + nationality + "&religion=" + religion + "&experience=" + experience
            $.ajax({
                url: url,
                type: 'GET',
                beforeSend: function () {
                    $("#hereWillDisplayAllWorker").html(`<div class="spinner">
        <div class="sk-folding-cube">
            <div class="sk-cube1 sk-cube"></div>
            <div class="sk-cube2 sk-cube"></div>
            <div class="sk-cube4 sk-cube"></div>
            <div class="sk-cube3 sk-cube"></div>
        </div>
    </div>`)
                    $('#SearchWorkerButton').attr('disabled', true)
                    $('#SearchWorkerButton').html(`<i class='fa fa-spinner fa-spin '></i>`)
                },
                complete: function () {

                },
                success: function (data) {

                    window.setTimeout(function () {
                        console.log('PPkkk');

                        $("#hereWillDisplayAllWorker").html(data.html)
                        $('#SearchWorkerButton').attr('disabled', false)
                        $('#SearchWorkerButton').html(`  <span></span> {{translate('تطبيق')}}`)
                        console.log(data.last_page, data.current_page)
                        if (data.last_page == data.current_page) {
                            document.getElementById("load_more_button").remove();
                        } else {
                            $("#buttonOfFilter").html(` <button id="load_more_button" class="defaultBtn" type="button">
                             {{translate('تحميل المزيد')}}
                            <i class="fa-regular fa-left-long ms-2"><span></span></i>

                            </button>`)
                        }

                    }, 2000);

                },
                error: function (data) {
                    $('#SearchWorkerButton').attr('disabled', false)
                    $('#SearchWorkerButton').html(`  <span></span> {{translate('تطبيق')}}`)

                }, //end error method

                cache: false,
                contentType: false,
                processData: false
            }); //end ajax
        }); //end submit


        $(document).on('click', '#SearchResetButton', function (e) {
            e.preventDefault()
            console.log(":P");
            var ob = $(this)
            ob.html(`<i class='fa fa-spinner fa-spin '></i>`)
            $(".select2").val(null).trigger("change")
            window.setTimeout(function () {
                ob.html(` {{translate('مسح')}}
                <span></span>`)
            }, 200);
            //make reset for all select2


        })
    </script>

    <script>

        function clear() {
            var job = $('#job').val();
            var age = $('#age').val();
            var experience = $('#experience').val();


            var religion = $('#religion').val();
            var nationality = $('#nationality').val();
            if (job == ''  && nationality == '' && religion == '' && experience=='') {
                $('#SearchResetButton').hide();
                $('#SearchWorkerButton').trigger('click');

            } else {
                $('#SearchResetButton').show();

            }
        }
        $('#job').on('change',function (){
            clear()
        });
        $('#age').on('change',function (){
            clear()
        });
        $('#religion').on('change',function (){
            clear()
        });
        $('#experience').on('change',function (){
            clear()
        });

        $('#nationality').on('change',function (){
            clear()
        });

    </script>

    <script>

        $('.close-recruitment').on('click', function () {
            $(this).closest('div').remove();
        });
        window.onload = function () {
            if (typeof history.pushState === "function") {
                history.pushState("jibberish", null, null);
                window.onpopstate = function () {
                    history.pushState('newjibberish', null, null);
                };
            }
            else {
                var ignoreHashChange = true;
                window.onhashchange = function () {
                    if (!ignoreHashChange) {
                        ignoreHashChange = true;
                        window.location.hash = Math.random();
                    }
                    else {
                        ignoreHashChange = false;
                    }
                };
            }
        };

        function copyUrl(e) {
            var url = $(e).data('url');

            $.post('{{ route('set_reservation_session') }}', {_token:'{{ @csrf_token() }}', cv_id:url}, function(data){
                if( data == '1'){
                    @auth
                    $.post('{{ route('reservation_cv') }}', {_token:'{{ @csrf_token() }}', cv_id:url}, function(data){
                        console.log(data);
                        if( data == '0') {
                            toastr.error("{{translate('ﻻ يمكنك انشاء طلب جديد الان يمكن متابعة طلبك او إلغاء السابق والبدأ فى طلب حجز جديد')}}");
                            window.setTimeout(function() {
                                window.location.href="{{route('clientIndex')}}";
                            }, 5000);
                        }
                        else if( data != '1' &&  data != '2'){
                            window.location.href ='/customer-service/'+data;
                        }
                        else  {
                            window.location.href="{{route('user.registration')}}";
                        }

                    })
                    @else
                            {{--window.location.href="{{route('user.registration')}}";--}}
                        window.location.href="{{route('select_service_cv')}}";
                    @endauth
                }
            })

        }
    </script>

@endsection
