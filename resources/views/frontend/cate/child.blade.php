@extends('frontend.layout')
@include('frontend.partials.meta')
@section('content')

<div class="block2 block-breadcrumb">
	<div class="container">
		<ul class="breadcrumb">
			<li><a href="{{ route('home') }}">Trang chủ</a></li>
			<li><a href="{{ route('cate-parent', [$cateDetail->cateParent->slug]) }}">{!! $cateDetail->cateParent->name !!}</a></li>
			<li class="active">{!! $cateDetail->name !!}</li>
		</ul>
	</div>
</div><!-- /block-breadcrumb -->

<div class="block2 block-ct-pro block-title-commom block-repadding">
	<div class="container">
		<div class="block2 block-title">
			<h1>
				<i class="fa fa-home"></i>
				{!! $cateDetail->name !!}
			</h1>	
		</div>
		<div class="block-content">
			<div class="row">
				@if($productList)
			  	@foreach($productList as $product)				
				<div class="col-sm-4 col-xs-6 box-item">
					<div class="item">
						<div class="thumb">
							<a href="{{ route('product', [$product->slug, $product->id ])}}"><img src="{{ $product->image_url ? Helper::showImageThumb($product->image_url) : URL::asset('public/assets/images/no-img.png') }}" alt="{!! $product->title !!}"></a>
						</div>
						<div class="des">
							<p class="code"><span>Mã sản phẩm: </span>{!! $product->code !!}</p>
							<a href="{{ route('product', [$product->slug, $product->id ])}}" title="{!! $product->title !!}">{!! $product->title !!}</a>							
						</div>
					</div><!-- /item -->
				</div>

				@endforeach
		  		@endif			  	
			</div>
			<nav class="block-pagination">
				{{ $productList->links() }}
			</nav><!-- /block-pagination -->
		</div>
		
	</div>
</div><!-- /block-product -->	

@endsection