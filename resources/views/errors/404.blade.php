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
			<img src="{{ static_asset('v3_assets/img/404.webp') }}" alt="{{ env('APP_NAME') }}">
			<h2> {{translate('خطأ')}} <span> 404 </span> - {{translate('لم يتم العثور على الصفحة')}} </h2>
			<p> {{translate('ربما تمت إزالة الصفحة التي تبحث عنها مع تغيير اسمها أو عدم توفرها مؤقتًا')}}. </p>
			<a class="defaultBtn " href="{{route('home')}}"><span></span>  {{translate('العودة الي الصفحة الرئيسية')}}  <i class="fa-regular fa-left-long ms-2"></i> </a>

		</div>
	</div>
</section>
@endsection
