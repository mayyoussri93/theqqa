@extends('frontend.layouts.app')

@section('meta_title'){{get_seo_title_setting(request()->path())}}  @stop
@section('meta_description'){{get_seo_description_setting(request()->path())}}@stop
@section('meta_keywords')        {{get_seo_keys_setting(request()->path())}}@stop

@section('meta')
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name" content="{{get_seo_title_setting(request()->path())}} ">
    <meta itemprop="description" content="{{get_seo_description_setting(request()->path())}}">

    <!-- Twitter Card data -->



    @section('meta_product_twitter'){{get_seo_title_setting(request()->path())}}  @stop
    @section('meta_title_twitter'){{get_seo_title_setting(request()->path())}}  @stop
    @section('meta_keywords_twitter')   {{get_seo_keys_setting(request()->path())}} @stop
    @section('meta_description_twitter')     {{get_seo_description_setting(request()->path())}} @stop
    @section('meta_creator_twitter')        {{get_seo_title_setting(request()->path())}}  @stop

    <!-- Open Graph data -->
    @section('meta_og_title')        {{get_seo_title_setting(request()->path())}}  @stop
    @section('meta_og_url')      {{Request::fullUrl() }}  @stop
    @section('meta_og_description')        {{get_seo_description_setting(request()->path())}} @stop


@endsection
@section('meta')
    <!-- Schema.org markup for Google+ -->

    <meta itemprop="name" content="{{ get_seo_title_setting(request()->path())}}">
    <meta itemprop="description" content="{{ get_seo_title_setting(request()->path()) }}">
    <meta itemprop="image" content="{{ uploaded_asset($blog->meta_img) }}">

    <!-- Twitter Card data -->
    <meta name="twitter:title" content="{{ get_seo_title_setting(request()->path())}}">
    <meta name="twitter:description" content="{{ get_seo_title_setting(request()->path()) }}">
    <meta name="twitter:creator" content="@author_handle">

    <!-- Open Graph data -->
    <meta property="og:title" content="{{get_seo_title_setting(request()->path())}} " />
    <meta property="og:type" content="blog" />
    <meta property="og:url" content="{{ URL($blog->slug) }}" />
    <meta property="og:description" content="{{get_seo_description_setting(request()->path())}}" />
    <meta property="og:image" content="{{ uploaded_asset($blog->meta_img) }}" />
    <meta property="og:site_name" content="{{ env('APP_NAME') }}" />
@endsection

@section('content')
    <!-- ================ for seo ================= -->
    <h1 style="display: none">{{get_seo_h1_setting(request()->path())}}</h1>
    <!-- ================  for seo =================-->
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
    <!-- Main Banner  -->
    <section class="mainBanner">
        <button onclick="goBack()" class="Back">
            <i class="fas fa-angle-left"></i>
        </button>
        <ul>
            <li>
                <a href="{{ route('home') }}"> {{translate('الرئيسية')}} </a>
            </li>
            <li>
                <a href="{{route('blog')}}"> {{translate('المقالات')}} </a>
            </li>
            <li>
                <a href="{{route('article.details',$blog->id)}}" class="active"> {{translate('تفاصيل المقال')}} </a>
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
    <!-- blog details -->
    <section class="blogDetails">
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-lg-8 p-2 m-auto">
                    <div class="blog">
                        <div class="blog-image">
                            <a href="{{route('article.details',$blog->id)}}"><img src="{{uploaded_asset($blog->banner)}}"  alt="{{ env('APP_NAME')}}"></a>
                        </div>
                        <div class="blog-content">
                            <span class="date"> <i class="fas fa-calendar-alt me-2"></i>
                                {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$blog->created_at)->format('F d,Y')}}
 </span>
                            <a class="blogTitle" href="{{route('article.details',$blog->id)}}">    {{translate($blog->title)}}</a>
                            {!! $blog->description  !!}

                            <div class="share">
                                <p> {{translate('مشاركة المقال')." : "}} </p>
                                <div class="socialIcons">
                                    <a target="_blank" rel="noopener" href='{{"https://www.facebook.com/sharer/sharer.php?u=".Request::url()}}'><i class="fab fa-facebook"></i></a>
                                    <a target="_blank" rel="noopener" href="https://api.whatsapp.com/send?text={{urlencode(Request::url()) }}"><i class="fab fa-whatsapp"></i></a>
                                    <a target="_blank" rel="noopener" href="https://twitter.com/share?url={{urlencode(Request::url())}}"><i class="fab fa-twitter"></i></a>
{{--                                    <a target="_blank" rel="noopener" href="#!"><i class="fas fa-envelope"></i></a>--}}
                                </div>
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
        $(document).ready(function () {


            $.ajax({
                url: "{{route('count_view_blog',$blog->id)}}",
                type: 'GET',
                data: {_token: '{{ @csrf_token() }}'},
                success: function (data) {
                    console.log(data.error)
                    if ($.isEmptyObject(data.error)) {
                        // AIZ.plugins.notify('success', data.success);

                    } else {
                        printErrorMsg(data.error);
                    }
                }
            });

        });
        // When the user scrolls the page, execute myFunction
        window.onscroll = function() {myFunction()};

        function myFunction() {
            var winScroll = document.body.scrollTop || document.documentElement.scrollTop;
            var height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
            var scrolled = (winScroll / height) * 100;
            document.getElementById("myBar").style.width = scrolled + "%";
        }
    </script>




@endsection
