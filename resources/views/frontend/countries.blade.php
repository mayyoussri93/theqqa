@php use App\Models\Nationality; @endphp
@php use App\Models\RecruitmentRequirementDetail; @endphp
@php use Carbon\Carbon; @endphp
@php use Illuminate\Support\Facades\Cache; @endphp

@extends('frontend.layouts.app')
@section('content')
<!-- ============= countries =============  -->
<section class="countries">
    <div class="container">
        <!-- Section Title -->
        <div class="headTitle text-start wow fadeInUp">
            <h2>{{translate(' دول الاستقدام')}} </h2>
            <p> {{translate('يمكنك اختيار الدوالة التي تتم عملية الاستقدام منها')}} </p>
        </div>
        <div class="allCountries">
            <div class="row justify-content-center">

                @foreach (Nationality::where('status', 1)->where('apper_home', 1)->get() as $key => $country)

                    <div class="col-6 col-md-3 p-1 wow flipInY">
                        <div class="country">
                            @if(!empty($country->flag_image))
                                <img class=" lazyimgs" data-original="{{static_asset($country->flag_image)}}"
                                     alt="{{ translate($country->name) }}">

                            @else
                                <img class=" lazyimgs"
                                     data-original="{{ static_asset('v3_assets/img/countries/'.$country->code.'.png') }}"
                                     alt="{{ translate($country->name) }}">

                            @endif

                            <h2> {{ translate($country->name) }} </h2>
                            <!--<p>{{translate('مدة الاستقدام في خلال').$country->priod.translate(' يوم')}} </p>-->
                            @if(!empty($country->key_comment))
                                <p>{{$country->key_comment}}</p>
                            @else
                                <p>{{translate('مدة الاستقدام في خلال')." 30 ".translate(' يوم')}} </p>
                            @endif
                            <a href="{{route('all_cvs',['nationality_id'=> $country->id])}}" class="animatedLink">
                                {{translate('اطلب الآن')}}
                                <i class="fa-regular fa-left-long ms-2"><span></span></i>
                            </a>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
</section>

{{--<div class="container">--}}
{{--    <!-- Section Title -->--}}
{{--    <div class="headTitle text-start wow fadeInUp">--}}
{{--        <h2>{{translate(' دول الاستقدام')}} </h2>--}}
{{--        <p> {{translate('يمكنك اختيار الدوالة التي تتم عملية الاستقدام منها')}} </p>--}}
{{--    </div>--}}
{{--    <section class="articles row justify-content-center">--}}
{{--        @foreach (Nationality::where('status', 1)->where('apper_home', 1)->get() as $key => $country)--}}

{{--                    <article >--}}
{{--                        <div class="article-wrapper ">--}}
{{--                            <figure>--}}
{{--                                @if(!empty($country->flag_image))--}}
{{--                                    <img class=" lazyimgs" src="{{static_asset($country->flag_image)}}"--}}
{{--                                         alt="{{ translate($country->name) }}" />--}}
{{--                                @else--}}
{{--                                    <img class=" lazyimgs"--}}
{{--                                         src="{{ static_asset('v3_assets/img/countries/'.$country->code.'.png') }}"--}}
{{--                                         alt="{{ translate($country->name) }}">--}}
{{--                                @endif--}}
{{--                            </figure>--}}

{{--                            <div class="article-body">--}}
{{--                                <h2>{{ translate($country->name) }}</h2>--}}
{{--                                {{translate('مدة الاستقدام في خلال').$country->priod.translate(' يوم')}}--}}
{{--                                @if(!empty($country->key_comment))--}}
{{--                                    <p>--}}
{{--                                        {{$country->key_comment}}--}}
{{--                                    </p>--}}
{{--                                @else--}}
{{--                                    <p>{{translate('مدة الاستقدام في خلال')." 30 ".translate(' يوم')}} </p>--}}
{{--                                @endif--}}
{{--                                <a href="{{route('all_cvs',['nationality_id'=> $country->id])}}" class="animatedLink">--}}
{{--                                    {{translate('اطلب الآن')}}--}}
{{--                                    <i class="fa-regular fa-left-long ms-2"><span></span></i>--}}
{{--                                </a>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </article>--}}
{{--        @endforeach--}}
{{--    </section>--}}

{{--</div>--}}



@endsection