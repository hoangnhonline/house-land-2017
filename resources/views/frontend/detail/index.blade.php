@extends('frontend.layout')

@include('frontend.partials.meta')
@section('content')
<div class="block block-breadcrumb">
	<div class="container">
		<ul class="breadcrumb">
			<li><a href="{{ route('home') }}">Trang chủ</a></li>			
			<li><a href="{{ route('cate-parent', [$detail->cateType->slug, $detail->cateParent->slug]) }}">{!! $detail->cateParent->name !!}</a></li>
			<li><a href="{{ route('cate', [$detail->cateType->slug, $detail->cateParent->slug, $detail->cate->slug]) }}">{!! $detail->cate->name !!}</a></li>
			<li class="active">{!! $detail->title !!}</li>
		</ul>
	</div>
</div><!-- /block-breadcrumb -->
<div class="block block-two-col container">
	<div class="row">
		<div class="col-sm-9 col-xs-12 block-col-left">
			<div class="block-title-commom block-detail">
				<div class="block block-title">
					<h2>
						<i class="fa fa-home"></i>
						{!! $detail->title !!}
					</h2>
				</div>
				<div class="block-content">
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
					<div class="block block-share">
						Share
					</div><!-- /block-share-->
					<div class="block block-tabs">
					 	<!-- Nav tabs -->
						<ul class="nav nav-tabs" role="tablist">
							<li role="presentation" class="active"><a href="#tab1" aria-controls="tab1" role="tab" data-toggle="tab">Mô tả chi tiết</a></li>
							<li role="presentation"><a href="#tab2" aria-controls="tab2" role="tab" data-toggle="tab">Thông số dự án</a></li>
							<li role="presentation"><a href="#tab3" aria-controls="tab3" role="tab" data-toggle="tab">Tiến độ xây dựng</a></li>
							<li role="presentation"><a href="#tab4" aria-controls="tab4" role="tab" data-toggle="tab">Hỏi - Đáp</a></li>
						</ul>
						<!-- Tab panes -->
						<div class="tab-content">
							<div role="tabpanel" class="tab-pane active" id="tab1">
								<h3 class="title">{!! $detail->title !!}</h3>
								<p class="text">{!! $detail->content !!}</p>
							</div>
							<div role="tabpanel" class="tab-pane" id="tab2">{!! $detail->thong_so_chung !!}</div>
							<div role="tabpanel" class="tab-pane" id="tab3">{!! $detail->tien_do !!}</div>
							<div role="tabpanel" class="tab-pane" id="tab4">{!! $detail->hoi_dap !!}</div>
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
			</div><!-- /block-ct-news -->
		</div><!-- /block-col-left -->
		@include('frontend.news.sidebar')
	</div>
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
