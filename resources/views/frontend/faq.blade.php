@extends('frontend.layouts.app')

@php
    $data=implode(',',\App\Models\FrequentlyQuestioned::pluck('question')->toArray());
@endphp
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
@section('link')

<link rel="canonical" href="{{Request::fullUrl() }}" />
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
    <section class="mainBanner logs_m" style="background-image:none;     padding: 30px 100px 10px;">
        <button onclick="goBack()" class="Back">
            <i class="fas fa-angle-left"></i>
        </button>
        <ul style="color: #A505A">
            <li style="color: #A505A">
                <a href="{{ route('home') }}" style="color: #A505A"> {{translate('الرئيسية')}} </a>
            </li>

            <li style="color: #A505A">
                <a href="{{url()->current()}}" class="active"  style="color: #A505A">  {{translate('الاسئلةالشائعة')}} </a>
            </li>
        </ul>
    </section>
    <!-- ================ faq ================= -->
    <section class="faq">
        <div class="container">
            <div class="headTitle wow fadeInUp">
                <h2> {{translate('الاسئلةالشائعة')}} </h2>
            </div>
            @foreach( \App\Models\FrequentlyQuestioned::get() as $key=>$value)
                <div class="accordion" id="faqAccordion">
                    <!-- question -->
                    <div class="accordion-item wow fadeInUp">
                        <h2 class="accordion-header">
                            <button class="accordion-button" data-bs-toggle="collapse" data-bs-target="#question{{$key}}"
                                    aria-controls="question{{$key}}">
                                {{translate($value->question)}}
                            </button>
                        </h2>
                        <div id="question{{$key}}" class="accordion-collapse collapse @if($key==0) show @endif" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                {!!translate($value->answer)!!}
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </section>
    <!-- ================ /faq ================= -->


@endsection
