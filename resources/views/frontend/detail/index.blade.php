@extends('frontend.layout')

@include('frontend.partials.meta')
@section('content')
<div class="block2 block-breadcrumb">
	<div class="container">
		<ul class="breadcrumb">
			<li><a href="{{ route('home') }}">Trang chủ</a></li>			
			<li><a href="{{ route('cate-parent', [$detail->cateParent->slug]) }}">{!! $detail->cateParent->name !!}</a></li>
			<li><a href="{{ route('cate', [$detail->cateParent->slug, $detail->cate->slug]) }}">{!! $detail->cate->name !!}</a></li>
			<li class="active">{!! $detail->title !!}</li>
		</ul>
	</div>
</div><!-- /block-breadcrumb -->
<div class="block2 block-two-col container" style="margin-bottom:10px">
	<div class="row">
		<div class="col-sm-9 col-xs-12 block-col-left">
			<div class="block-title-commom block-detail">
				<div class="block2 block-title"  style="margin-bottom:15px">
					<h2>
						<i class="fa fa-home"></i>
						{!! $detail->cate->name !!}
					</h2>
				</div>
				<div class="block-content">
					<div class="block block-slide-detail" style="margin-bottom:10px">
						<!-- Place somewhere in the <body> of your page -->
						@if($detail->is_slider == 1)
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
						@endif
					</div><!-- /block-slide-detail -->
					<div class="block block-share" id="share-buttons" style="margin-bottom:10px">
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
					
					@if($detail->content != '' || $detail->thong_so != '' || $detail->tien_do != '' || $detail->hoi_dap != '')
					<div class="block block-tabs"  style="margin-bottom:15px">
					 	<!-- Nav tabs -->
						<ul class="nav nav-tabs" role="tablist">
							@if($detail->content != '')
							<li role="presentation" class="active"><a href="#tab1" aria-controls="tab1" role="tab" data-toggle="tab">Thông tin dự án</a></li>
							@endif			
							@if(!empty($arrThongSo))				
							<li role="presentation"><a href="#tab2" aria-controls="tab2" role="tab" data-toggle="tab">Thông số dự án</a></li>							
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
								<h1 class="title">{!! $detail->title !!}</h1>
								<div class="reviews-summary" id="rating-summary" itemscope itemtype="http://schema.org/Review">
									
			                    </div><!-- /reviews-summary -->
			                    <div class="block-author">
			                    	<ul>
			                    		<li>
			                    			<span>Tác giả:</span>
			                    			<span class="name">{!! $detail->createdUser->display_name !!}</span>
			                    		</li>
			                    		<li>
			                    			{!! date('d/m/Y', strtotime($detail->created_at)) !!}
			                    		</li>
			                    		<li>
			                    			{!! Helper::view($detail->id, 1) !!} lượt xem
			                    		</li>
			                    	</ul>
			                    </div>
								<div class="block-editor-content">{!! $detail->content !!}</div>
								<div class="clearfix"></div>
							</div>
							@endif
							@if(!empty($arrThongSo))
							<div role="tabpanel" class="tab-pane" id="tab2">
							@foreach($thongsoList as $ts)                        
							@if(isset($arrThongSo[$ts->id]) && $arrThongSo[$ts->id] != '')
	                        <li>
								<span>{!! $ts->name !!}:</span>
								<strong>{!! isset($arrThongSo[$ts->id]) ? $arrThongSo[$ts->id] : "" !!}</strong>
							</li>
							@endif
                        	@endforeach
								<div class="clearfix"></div>
							</div>
							@endif
							@if($detail->tien_do != '')
							<div role="tabpanel" class="tab-pane" id="tab3">
								<div class="block-editor-content">{!! $detail->tien_do !!}</div>
								<div class="clearfix"></div>
							</div>
							@endif
							@if($detail->hoi_dap != '')
							<div role="tabpanel" class="tab-pane" id="tab4">
								<div class="block-editor-content">{!! $detail->hoi_dap !!}</div>
								<div class="clearfix"></div>
							</div>
							@endif
						</div>
					</div><!-- /block-tabs-->
					@endif
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
		@include('frontend.detail.sidebar')
	</div>
</div><!-- /block_big-title -->
<input type="hidden" id="rating-route" value="{{ route('rating') }}">
<form id="rating-form">
	{{ csrf_field() }}
	<input type="hidden" id="object_id" name="object_id" value="{{ $detail->id }}">
	<input type="hidden" id="object_type" name="object_type" value="2">
	<input type="hidden" id="score" name="score" value="">
</form>
@stop
@section('js')
<!-- Flexslider -->
    <script src="{{ URL::asset('public/assets/lib/flexslider/jquery.flexslider-min.js') }}"></script>
    <script src="{{ URL::asset('public/assets/lib/starrating/js/star-rating.js') }}"></script> 
	<script type="text/javascript">
		$(document).ready(function(){
			$.ajax({
		        url : $('#rating-route').val(),
		        type : 'POST',
		        dataType : 'html',
		        data : $('#rating-form').serialize(),
		        success : function(data){
		            $('#rating-summary').html(data);
		            var $input = $('input.rating');
		            if ($input.length) {
		                $input.removeClass('rating-loading').addClass('rating-loading').rating();
		            }
		        }
	   		});
		});
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
