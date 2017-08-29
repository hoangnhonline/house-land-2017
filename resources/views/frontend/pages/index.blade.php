@extends('frontend.layout') 
  
@include('frontend.partials.meta')
@section('content')
<div class="wrapper">
		<div class="block block-breadcrumb">
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
						<h2>
							<i class="fa fa-home"></i>
							{!! $detailPage->title !!}
						</h2>
					</div>
				</div>
				<div class="block-article">
					<div class="block block-content">						
						{!! $detailPage->content !!}
					</div>
				</div>
			</div>
		</div><!-- /container-->
		<!--<div class="block-members">
			<div class="container">
				<div class="block-title">
					<h2>BAN LÃNH ĐẠO</h2>
				</div>
				<div class="block-content">
					<ul  class="owl-carousel owl-theme" data-nav="true" data-autoplayTimeout="700" data-autoplay="true" data-margin="30" data-responsive='{"0":{"items":1},"480":{"items":2},"600":{"items":2},"768":{"items":3},"800":{"items":3},"992":{"items":5}}' data-center="true" data-loop="true">
						<li class="item">
							<img src="images/about/member1.jpg" alt="brand1">
							<p class="name">Họ tên thành viên ban quản trị</p>
							<p class="position">Chức vụ hiện tại của thành viên</p>
						</li>
						<li class="item">
							<img src="images/about/member2.jpg" alt="brand2">
							<p class="name">Họ tên thành viên ban quản trị</p>
							<p class="position">Chức vụ hiện tại của thành viên</p>
						</li>
						<li class="item">
							<img src="images/about/member3.jpg" alt="brand3">
							<p class="name">Họ tên thành viên ban quản trị</p>
							<p class="position">Chức vụ hiện tại của thành viên</p>
						</li>
						<li class="item">
							<img src="images/about/member4.jpg" alt="brand4">
							<p class="name">Họ tên thành viên ban quản trị</p>
							<p class="position">Chức vụ hiện tại của thành viên</p>
						</li>
						<li class="item">
							<img src="images/about/member5.jpg" alt="brand5">
							<p class="name">Họ tên thành viên ban quản trị</p>
							<p class="position">Chức vụ hiện tại của thành viên</p>
						</li>
						<li class="item">
							<img src="images/about/member4.jpg" alt="brand6">
							<p class="name">Họ tên thành viên ban quản trị</p>
							<p class="position">Chức vụ hiện tại của thành viên</p>
						</li>
						<li class="item">
							<img src="images/about/member3.jpg" alt="brand1">
							<p class="name">Họ tên thành viên ban quản trị</p>
							<p class="position">Chức vụ hiện tại của thành viên</p>
						</li>
						<li class="item">
							<img src="images/about/member2.jpg" alt="brand2">
							<p class="name">Họ tên thành viên ban quản trị</p>
							<p class="position">Chức vụ hiện tại của thành viên</p>
						</li>
						<li class="item">
							<img src="images/about/member1.jpg" alt="brand3">
							<p class="name">Họ tên thành viên ban quản trị</p>
							<p class="position">Chức vụ hiện tại của thành viên</p>
						</li>
						<li class="item">
							<img src="images/about/member5.jpg" alt="brand4">
							<p class="name">Họ tên thành viên ban quản trị</p>
							<p class="position">Chức vụ hiện tại của thành viên</p>
						</li>
						<li class="item">
							<img src="images/about/member2.jpg" alt="brand5">
							<p class="name">Họ tên thành viên ban quản trị</p>
							<p class="position">Chức vụ hiện tại của thành viên</p>
						</li>
						<li class="item">
							<img src="images/about/member3.jpg" alt="brand6">
							<p class="name">Họ tên thành viên ban quản trị</p>
							<p class="position">Chức vụ hiện tại của thành viên</p>
						</li>
					</ul>
				</div>
			</div>
		</div><!-- /block-members-->
	</div><!-- /wrapper-->
@stop
  