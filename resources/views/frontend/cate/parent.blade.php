@extends('frontend.layout')
@include('frontend.partials.meta')
@section('content')

<div class="block block-breadcrumb">
	<div class="container">
		<ul class="breadcrumb">
			<li><a href="{{ route('home') }}">Trang chủ</a></li>		
			<li class="active">{!! $parentDetail->name !!}</li>
		</ul>
	</div>
</div><!-- /block-breadcrumb -->
<div class="block block_big-title">
	<div class="container">
		<h2>{!! $parentDetail->name !!}</h2>
		<p class="desc">{!! $parentDetail->description !!}</p>
	</div>
</div><!-- /block_big-title -->
@if($cateList)
@foreach($cateList as $cate)
@if(isset($productArr[$cate->id]) && count($productArr[$cate->id]) > 0 )
<div class="block block-product block-title-commom">
	<div class="container">
		<div class="block block-title">
			<h2>
				<i class="fa fa-home"></i>
				<a href="{{ route('cate', [$parentDetail->slug, $cate->slug]) }}" title="{!! $cate->name !!}">{!! $cate->name !!}</a>
			</h2>	
		</div>
		<div class="block-content">
			<ul class="owl-carousel owl-theme owl-style2" data-nav="true" data-dots="false" data-margin="30" data-responsive='{"0":{"items":1},"480":{"items":2},"600":{"items":2},"768":{"items":3},"800":{"items":3},"992":{"items":4}}'>
			  	
			  	@foreach($productArr[$cate->id] as $product)
			  	<li class="item">
			  		<div class="thumb">
			  			<a href="{{ route('product', [$product->slug, $product->id ])}}" title="{!! $product->title !!}">
			  				<img src="{{ Helper::showImageThumb($product->image_url) }}" alt="{!! $product->title !!}">
			  			</a>
			  		</div>
			  		<div class="title">
			  			<h2>{!! $product->title !!}</h2>
			  		</div>
		  		</li>
		  		@endforeach	  		
		</div>
	</div>
</div><!-- /block-product -->	
@endif
@endforeach
@endif
@endsection