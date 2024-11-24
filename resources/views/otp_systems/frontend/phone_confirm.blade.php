@extends('frontend.layouts.app')

@section('content')

    <div class="wrapper-contant wrapper-contant-sm mt-4 mb-5">
        <div class="container">
            <div class="m-auto w-75">
                <div class="row box-shadow-gray">
                    <div class="col-md-6">
                        <div class="wrapper-icon-center">
                            <div class="icon-center text-center">
                                {{-- <i class="far fa-check-circle"></i> --}}
                                <img src="{{ static_asset('v2_assets/img/checkicon.svg') }}" class="w-75" alt="">
                            </div>
                            <p>{{translate('تم تأكيد رقم الهاتف')}}</p>
                        </div>
                    </div>
                    <div class="col-md-6 px-0">
                        <img src="{{ static_asset('v2_assets/img/clean.png') }}" alt="" class="">
                        <div class="layer-img-pink" ></div>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')
    <script>
        window.onload = function () {
            window.setTimeout(function() {
                window.location.href = "{{$rediret_url}}";
            }, 2000);
        }
    </script>
@endsection
