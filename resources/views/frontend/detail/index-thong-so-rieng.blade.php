@extends('frontend.layout')

@include('frontend.partials.meta')
@section('content')
<div class="block block-breadcrumb">
	<div class="container">
		<ul class="breadcrumb">
			<li><a href="{{ route('home') }}">Trang chủ</a></li>			
			<li><a href="{{ route('cate-parent', [$detail->cateParent->slug]) }}">{!! $detail->cateParent->name !!}</a></li>
			<li><a href="{{ route('cate', [$detail->cateParent->slug, $detail->cate->slug]) }}">{!! $detail->cate->name !!}</a></li>
			<li class="active">{!! $detail->title !!}</li>
		</ul>
	</div>
</div><!-- /block-breadcrumb -->
<div class="block block-two-col container">
	<div class="block block-title-commom block-detail">
		<div class="block block-title">
			<h2>
				<i class="fa fa-home"></i>
				{!! $detail->cate->name !!}
			</h2>
		</div>
		<div class="block-content">
			<div class="row">
				<div class="col-sm-7">
					@if($detail->is_slider == 1)
					<div class="block block-slide-detail">
						<!-- Place somewhere in the <body> of your page -->
						<div id="slider" class="flexslider">
							<ul class="slides">
								@foreach( $hinhArr as $hinh )
								<li><img src="{{ Helper::showImage($hinh['image_url']) }}" alt="{!! $detail->title !!}" /></li>
								@endforeach								
							</ul>
						</div>
						<div id="carousel" class="flexslider">
							<ul class="slides">
								<?php $i = 0; ?>
								@foreach( $hinhArr as $hinh )							
								<li><img src="{{ Helper::showImageThumb($hinh['image_url']) }}" alt="{!! $detail->title !!}" /></li>
								<?php $i++; ?>
								@endforeach
							</ul>
						</div>
					</div><!-- /block-slide-detail -->
					@endif
				</div>
				<div class="col-sm-5">
					<h2 class="tit-page3">THÔNG SỐ DỰ ÁN</h2>
					<ul class="block-detail-info">
						@foreach($thongsoList as $ts)                        
						@if(isset($arrThongSo[$ts->id]) && $arrThongSo[$ts->id] != '')
                        <li>
							<span>{!! $ts->name !!}:</span>
							<strong>{!! isset($arrThongSo[$ts->id]) ? $arrThongSo[$ts->id] : "" !!}</strong>
						</li>
						@endif
                        @endforeach
					</ul>
				</div>
			</div>
			<div class="block block-share" id="share-buttons">
				<div class="share-item">
					<div class="fb-like" data-href="{{ url()->current() }}" data-layout="button_count" data-action="like" data-size="small" data-show-faces="false" data-share="false"></div>
				</div>
				<div class="share-item" style="max-width: 65px;">
					<div class="g-plus" data-action="share"></div>
				</div>
				<div class="share-item">
					<a class="twitter-share-button"
				  href="https://twitter.com/intent/tweet?text={!! $detail->title !!}">
				Tweet</a>
				</div>
				<div class="share-item">
					<div class="addthis_inline_share_toolbox"></div>
				</div>
			</div><!-- /block-share-->
			<div class="block block-tabs">
			 	<!-- Nav tabs -->
				<ul class="nav nav-tabs" role="tablist">
					@if($detail->content != '')
					<li role="presentation" class="active"><a href="#tab1" aria-controls="tab1" role="tab" data-toggle="tab">Mô tả chi tiết</a></li>
					@endif
					@if($detail->tien_do != '')
					<li role="presentation"><a href="#tab3" aria-controls="tab3" role="tab" data-toggle="tab">Tiến độ xây dựng</a></li>
					@endif
					@if($detail->hoi_dap != '')
					<li role="presentation"><a href="#tab4" aria-controls="tab4" role="tab" data-toggle="tab">Hỏi - Đáp</a></li>
					@endif
				</ul>
				<!-- Tab panes -->
				<div class="tab-content">
					@if($detail->content != '')
					<div role="tabpanel" class="tab-pane active" id="tab1">
						<h3 class="title">{!! $detail->title !!}</h3>
						<p class="text">{!! $detail->content !!}</p>
					</div>
					@endif
					@if($detail->tien_do != '')					
					<div role="tabpanel" class="tab-pane" id="tab3">{!! $detail->tien_do !!}</div>
					@endif
					@if($detail->hoi_dap != '')
					<div role="tabpanel" class="tab-pane" id="tab4">{!! $detail->hoi_dap !!}</div>
					@endif
				</div>
			</div><!-- /block-tabs-->
			@if($tagSelected->count() > 0)
			<div class="block-tags">
				<ul>
					<li class="tags-first">Tags:</li>
					<?php $i = 0; ?>
			        @foreach($tagSelected as $tag)
			        <?php $i++; ?>
					<li class="tags-link"><a href="{{ route('tag', $tag->slug) }}" title="{!! $tag->name !!}">{!! $tag->name !!}</a></li>
					@endforeach
				</ul>
			</div><!-- /block-tags -->
			@endif
		</div>
	</div><!-- /block-detail -->
	@if($otherList->count() > 0)
	<div class="block-title-commom block-relative">
		<div class="block block-title">
			<h2>
				<i class="fa fa-home"></i>
				DỰ ÁN LIÊN QUAN
			</h2>
		</div>
		<div class="block-content">
			<ul class="owl-carousel owl-theme owl-style2" data-nav="true" data-center="true" data-loop="false" data-margin="30" data-responsive='{"0":{"items":1},"480":{"items":2},"600":{"items":2},"768":{"items":3},"800":{"items":3},"992":{"items":3}}'>
			  	@foreach($otherList as $product)
			  	<li class="item">
			  		<div class="thumb">
						<a href="{{ route('product', [$product->slug, $product->id ])}}"><img src="{{ Helper::showImageThumb($product->image_url) }}" alt="{!! $product->title !!}"></a>
					</div>
					<div class="des">
						<a href="{{ route('product', [$product->slug, $product->id ])}}" title="{!! $product->title !!}">{!! $product->title !!}</a>
						<p class="code"><span>Mã sản phẩm: </span>{!! $product->code !!}</p>
					</div>
			  		
		  		</li><!-- /item -->			  
		  		@endforeach	
			</ul>
		</div>
	</div><!-- /block-title-commom -->
	@endif
</div><!-- /block_big-title -->
@stop
@section('js')
<!-- Flexslider -->
    <script src="{{ URL::asset('public/assets/lib/flexslider/jquery.flexslider-min.js') }}"></script>    

	<script>
		$(window).load(function() {
			// The slider being synced must be initialized first
			$('#carousel').flexslider({
				animation: "slide",
				controlNav: false,
				animationLoop: true,
				slideshow: true,
				itemWidth: 175,
				itemMargin: 30,
				nextText: "",
				prevText: "",
				asNavFor: '#slider'
			});

			$('#slider').flexslider({
				animation: "fade",
				controlNav: false,
				directionNav: false,
				animationLoop: true,
				slideshow: true,
				animationSpeed: 500,
				sync: "#carousel"
			});
		});
	</script>
@stop
