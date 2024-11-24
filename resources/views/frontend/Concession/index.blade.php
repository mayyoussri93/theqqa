@extends('frontend.layouts.app')

@section('content')

    <div class="row justify-content-center">

        @foreach($housemades as $housemade)
            <div class="col-md-3 mb-3 mt-3">
                <!-- Card -->
                <div class="card">

                    <!-- Card image -->
                    <img class="card-img-top" src="{{static_asset($housemade->image)}}" alt="Card image cap">

                    <!-- Card content -->
                    <div class="card-body">
{{--                        ['name', 'religion','age','experience','experience_years', 'image','note'] card-title --}}
                        <!-- Title -->
                        <h4 class="card-text text-bold fs-1">{{translate('الاسم')}} : {{$housemade->name}}</h4>
                        <hr/>
                        <!-- Text -->
                        <p class="card-text  fs-3">{{translate('الديانة')}} : {{$housemade->religion}}</p>

                        <p class="card-text  fs-3">{{translate('العمر')}} : {{$housemade->age}}</p>

                        <p class="card-text  fs-3">{{translate('دولة الخبرة')}} : {{$housemade->experience}}</p>

                        <p class="card-text  fs-3">{{translate('عدد سنوات الخبرة')}} : {{$housemade->experience_years}} </p>

                        <p class="card-text  fs-3">{{translate('الملاحظة')}} : {{$housemade->note}}</p>
                        <!-- Button -->
{{--                        <a href="#" class="btn btn-primary">Button</a>--}}

                    </div>

                </div>
                <!-- Card -->
            </div>
        @endforeach



{{--        <div class="col-md-3 mb-3 mt-3">--}}
{{--            <!-- Card -->--}}
{{--            <div class="card">--}}

{{--                <!-- Card image -->--}}
{{--                <img class="card-img-top" src="https://mdbootstrap.com/img/Photos/Others/images/43.webp" alt="Card image cap">--}}

{{--                <!-- Card content -->--}}
{{--                <div class="card-body">--}}

{{--                    <!-- Title -->--}}
{{--                    <h4 class="card-title"><a>Card title</a></h4>--}}
{{--                    <!-- Text -->--}}
{{--                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's--}}
{{--                        content.</p>--}}
{{--                    <!-- Button -->--}}
{{--                    <a href="#" class="btn btn-primary">Button</a>--}}

{{--                </div>--}}

{{--            </div>--}}
{{--            <!-- Card -->--}}
{{--        </div>--}}

{{--        <div class="col-md-3 mb-3 mt-3">--}}
{{--            <!-- Card -->--}}
{{--            <div class="card">--}}

{{--                <!-- Card image -->--}}
{{--                <img class="card-img-top" src="https://mdbootstrap.com/img/Photos/Others/images/43.webp" alt="Card image cap">--}}

{{--                <!-- Card content -->--}}
{{--                <div class="card-body">--}}

{{--                    <!-- Title -->--}}
{{--                    <h4 class="card-title"><a>Card title</a></h4>--}}
{{--                    <!-- Text -->--}}
{{--                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's--}}
{{--                        content.</p>--}}
{{--                    <!-- Button -->--}}
{{--                    <a href="#" class="btn btn-primary">Button</a>--}}

{{--                </div>--}}

{{--            </div>--}}
{{--            <!-- Card -->--}}
{{--        </div>--}}

    </div> <!--========== row ===========-->




@endsection