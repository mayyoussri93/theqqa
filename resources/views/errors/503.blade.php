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


<section class="pageError">
	<div class="container">
		<div class="notFound">
			<img src="{{ static_asset('assets/img/maintainance.svg') }}" alt="{{ env('APP_NAME') }}">
			<h2> {{translate('الموقع تحت الصيانة يرجي التواصل معنا علي عن طريق الواتساب والاتصال')}} </h2>
			<p>{{translate('سنعود فى اقرب وقت')}}</p>
			   <?php
        $whats  = preg_replace('/[^0-9]/', '','966550061304');
        $link='https://api.whatsapp.com/send?phone='.$whats;
        ?>
            <a class="defaultBtn " href="{{$link}}"><span></span>  {{translate('التواصل عبر الواتس اب')}}  <i class="   fa-left-long ms-2 fa-brands fa-whatsapp"></i> </a>

    <a class="defaultBtn " href="{{ 'tel:8003030309' }}"><span></span>  {{translate('الاتصال عبر الهاتف')}}  <i class="fa-light fa-phone fa-left-long ms-2"></i> </a>


		</div>
	</div>
</section>
@endsection
