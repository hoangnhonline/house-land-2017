@extends('frontend.layout') 

@include('frontend.partials.meta') 

@section('content')
<div class="block block-breadcrumb">
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
				<div class="block block-aritcle">
					<h2 class="title">{!! $detail->title !!}</h2>
					<p class="text">{!! $detail->content !!}</p>					
				</div>
				<!--<div class="block block-share">
					Share
				</div><!-- /block-share -->				
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