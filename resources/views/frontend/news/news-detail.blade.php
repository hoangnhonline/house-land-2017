@extends('frontend.layout') 

@include('frontend.partials.meta') 

@section('content')
<div class="block2 block-breadcrumb">
  <div class="container">
    <ul class="breadcrumb">
      <li><a href="{{ route('home') }}" title="Trở về trang chủ">Trang chủ</a></li>            
      <li class="active">{!! $cateDetail->name !!}</li>
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
					<p class="text">{!! $detail->content !!}</p>					
					
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
  
@stop