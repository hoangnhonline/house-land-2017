@extends('frontend.layout') 

@include('frontend.partials.meta') 

@section('content')
<div class="block2 block-breadcrumb">
  <div class="container">
    <ul class="breadcrumb">
      <li><a href="{{ route('home') }}" title="Trở về trang chủ">Trang chủ</a></li>            
      <li class="active"><a href="{{ route('news-list', $cateDetail->slug ) }}" title="{!! $cateDetail->name !!}">{!! $cateDetail->name !!}</a></li>
    </ul>
  </div>
</div><!-- /block-breadcrumb -->
<div class="block block-two-col container">
  <div class="row">
    <div class="col-sm-9 col-xs-12 block-col-left">
		<div class="block-title-commom block-dt-news">
			<div class="block block-title">
				<h2>
					<i class="fa fa-home"></i>
					{!! $cateDetail->name !!}
				</h2>
			</div>
			<div class="block-content">
				<div class="block block-article">
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
                    			{!! Helper::view($detail->id, 2) !!} lượt xem
                    		</li>
                    	</ul>
                    </div>
					<div class="block-editor-content">{!! $detail->content !!}</div>
					
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
    @include('frontend.news.sidebar-detail')
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
</script>  
@stop