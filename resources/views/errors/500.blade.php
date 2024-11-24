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
			<img src="{{ static_asset('assets/img/500.svg') }}" alt="{{ env('APP_NAME') }}">
			<h2> {{translate('خطأ')}} <span> 500 </span> - {{translate('يوجد خطأ فنى')}} </h2>
			<p> {{translate("ناسف لأخباركم بذلك ، كما نرجو منكم تزويدنا بالرابط للصفحة الحالية الموجود بها ألخطإ وار ساله لقسم الدعم الفني .")}}. </p>

			<a class="defaultBtn " href="https://api.whatsapp.com/send?phone=966594249640"><span></span>  {{translate('الدعم الفني')}}   </a>
			<a class="defaultBtn " href="{{route('home')}}"><span></span>  {{translate(' الصفحة الرئيسية')}}   </a>

		</div>
	</div>
</section>
@endsection