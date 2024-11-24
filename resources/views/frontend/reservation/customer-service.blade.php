@extends('frontend.layouts.app')

@section('content')
<style>
    @media (max-width:481px) {
        .selectCustomerService .choose {
            display: block;
        }
        .selectCustomerService .choose .customerOption {
            width:100%!important;
}
    }
</style>
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
    <!-- ================ select Customer Service ================= -->
    <section class="selectCustomerService">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 p-2">
                    <div class="headTitle">
                        <h2>{{translate('اختر احد مندوبي خدمة العملاء')}} </h2>
                        <p>
                            {{translate('يرجى اختيار احد ممثلي خدمة العملاء لمواصلة إتمام التعاقد واكمال الإستقدام')}}
                        </p>
                    </div>

@if(isset($res_id))
                        <form  action="{{route('select_service_save')}}" method="post"  class="needs-validation" novalidate >
                            @csrf
                        <input type="hidden" name="rest_id" value="{{$res_id}}">
                        @elseif(isset($cv_id))
                                <form  action="{{route('user.registration')}}" method="get"  class="needs-validation" novalidate >
                                    @csrf
                            <input type="hidden" name="cv_id" value="{{$cv_id}}">
                        @endif
                            <div class="choose row">
                            @foreach($staffs as $key=>$val)
                                @if(!empty($val->user))


                                    <div  class="customerOption col-md-4 wow fadeInUp">
                                        <input type="radio" class="btn-check" name="staff_name" id="{{'option'.$key}}" value="{{$val->user->id}}" required>
                                        <label class="btn btn-outline" for="{{'option'.$key}}">
                                            <img src="{{ static_asset('v3_assets/img/avater2.webp') }}" alt="{{ env('APP_NAME') }}">
                                            <span>  {{translate($val->user->name)}}</span>
                                        </label>
                                        @if($loop->last)
                                        <div class="valid-feedback">{{translate('صحيح')}}</div>
                                        <div class="invalid-feedback">{{translate('يرجي اختيار احد ممثلي خدمة العملاء')}}</div>
                                            @endif
                                    </div>
                                @endif
                            @endforeach
                        </div>
                        <div class=" pt-4 p-2 text-center">
                            <button class="defaultBtn" type="submit">
                                <p class="px-5"> {{translate('تأكيد')}} </p>
                                <span></span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('script')

    <script>
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


    </script>

@endsection
