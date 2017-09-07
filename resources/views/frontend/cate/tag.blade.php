@extends('frontend.layout')
@include('frontend.partials.meta')
@section('content')

<div class="block block-breadcrumb">
	<div class="container">
		<ul class="breadcrumb">
			<li><a href="{{ route('home') }}">Trang chủ</a></li>			
			<li class="active">Tags</li>
		</ul>
	</div>
</div><!-- /block-breadcrumb -->
<div class="block block-title-commom">
	<div class="container">
		<div class="block block-title">
			<h2>
				<i class="fa fa-home"></i>
				Tags
			</h2>
		</div>
		<div class="block-content block-ct-pro">
			<h2 class="tit-page3">HIỂN THỊ KẾT QUẢ CHO “{!! $detail->name !!}”</h2>
			<div class="row">
				@if($productList->count() > 0)
			  	@foreach($productList as $product)
				<div class="col-sm-4 col-xs-12">
					<div class="item">
						<div class="thumb">
							<a href="{{ route('product', [$product->slug, $product->id ])}}"><img class="lazy" data-original="{{ Helper::showImageThumb($product->image_url) }}" alt="{!! $product->title !!}"></a>
						</div>
						<div class="des">
							<a href="{{ route('product', [$product->slug, $product->id ])}}" title="{!! $product->title !!}">{!! $product->title !!}</a>
							<p class="code"><span>Mã sản phẩm: </span>{!! $product->code !!}</p>
						</div>
					</div><!-- /item -->
				</div>
				@endforeach
		  		@else
		  		<p style="padding-left:15px">Không tìm thấy dữ liệu!</p>
		  		@endif		  
			</div>
			<nav class="block-pagination">
				{{ $productList->links() }} 
			</nav><!-- /block-pagination -->
		</div>
	</div>
</div><!-- /block_big-title -->
@endsection