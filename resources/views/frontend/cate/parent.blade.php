@extends('frontend.layout')
@include('frontend.partials.meta')
@section('content')

<div class="block2 block-breadcrumb">
	<div class="container">
		<ul class="breadcrumb">
			<li><a href="{{ route('home') }}">Trang chủ</a></li>		
			<li class="active">{!! $parentDetail->name !!}</li>
		</ul>
	</div>
</div><!-- /block-breadcrumb -->
<div class="block block_big-title" style="margin-bottom:0px">
	<div class="container">
		<h1>{!! $parentDetail->name !!}</h1>
		<p class="desc">{!! $parentDetail->description !!}</p>
	</div>
</div><!-- /block_big-title -->
@if($cateList)
@foreach($cateList as $cate)
@if(isset($productArr[$cate->id]) && count($productArr[$cate->id]) > 0 )
<div class="block2 block-btn-slide block-ct-pro block-title-commom">
	<div class="container">
		<div class="block2 block-title">
			<h2>
				<i class="fa fa-home"></i>
				<a href="{{ route('cate', [$parentDetail->slug, $cate->slug]) }}" title="{!! $cate->name !!}">{!! $cate->name !!}</a>
			</h2>	
		</div>
		<div class="block-content">
			<ul class="owl-carousel owl-theme owl-style2" data-nav="true" data-dots="false" data-margin="12" data-responsive='{"0":{"items":1},"480":{"items":2},"600":{"items":2},"768":{"items":3},"800":{"items":3},"992":{"items":3}}'>
			  	
			  	@foreach($productArr[$cate->id] as $product)
			  	<li class="item">
			  		<div class="thumb">
			  			<a href="{{ route('product', [$product->slug, $product->id ])}}" title="{!! $product->title !!}">
			  				<img src="{{ $product->image_url ? Helper::showImageThumb($product->image_url) : URL::asset('public/assets/images/no-img.png') }}" alt="{!! $product->title !!}">
			  			</a>
			  		</div>
			  		<div class="des">
		                <p class="code"><span>Mã sản phẩm: </span>{!! $product->code !!}</p>
		                <a href="{{ route('product', [$product->slug, $product->id ]) }}" title="{!! $product->title !!}">{!! $product->title !!}</a>                
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