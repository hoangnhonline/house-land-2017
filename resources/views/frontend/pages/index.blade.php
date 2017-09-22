@extends('frontend.layout') 
  
@include('frontend.partials.meta')
@section('content')
<div class="wrapper">
		<div class="block2 block-breadcrumb">
			<div class="container">
				<ul class="breadcrumb">
					<li><a href="{{ route('home')}}">Trang chủ</a></li>
					<li class="active">{!! $detailPage->title !!}</li>
				</ul>
			</div>
		</div><!-- /block-breadcrumb -->
		<div class="container">
			<div class="block-page-about">
				<div class="block-title-commom">
					<div class="block block-title">
						<h1>
							<i class="fa fa-home"></i>
							{!! $detailPage->title !!}
						</h1>
					</div>
				</div>
				<div class="block-article">
					<div class="block block-content">						
						{!! $detailPage->content !!}
					</div>
				</div>
			</div>
		</div><!-- /container-->
		@if($slug == 'gioi-thieu')
		<div class="block-members">
			<div class="container">
				<div class="block-title">
					<h2>BAN LÃNH ĐẠO</h2>
				</div>
				@if($memberList->count() > 0)
				<div class="block-content">
					<ul  class="owl-carousel owl-theme" data-nav="true" data-autoplayTimeout="700" data-autoplay="true" data-margin="30" data-responsive='{"0":{"items":1},"480":{"items":2},"600":{"items":2},"768":{"items":3},"800":{"items":3},"992":{"items":5}}' data-center="true" data-loop="true">
						@foreach($memberList as $member)
						<li class="item">
							<img src="{{ Helper::showImage($member->image_url) }}" alt="{!! $member->name !!}">
							<p class="name">{!! $member->name !!}</p>
							<p class="position">{!! $member->chuc_vu !!}</p>
						</li>
						@endforeach
					</ul>
				</div>
				@endif
			</div>
		</div><!-- /block-members-->
		@endif
	</div><!-- /wrapper-->
@stop
  