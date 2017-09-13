@extends('frontend.layout') 
  
@include('frontend.partials.meta')
@section('content')
<div class="block block-breadcrumb">
	<div class="container">
		<ul class="breadcrumb">
			<li><a href="{{ route('home')}}">Trang chủ</a></li>
			<li><a href="{{ route('services')}}">Dịch vụ</a></li>
			<li class="active">{!! $detail->title !!}</li>
		</ul>
	</div>
</div><!-- /block-breadcrumb -->
<div class="block block-two-col container">
	<div class="row">
		<div class="col-sm-9 col-xs-12 block-col-left">
			<div class="block-title-commom block-quote clearfix">
				<div class="block block-title">
					<h2>
						<i class="fa fa-home"></i>
						{!! $detail->title !!}
					</h2>
				</div>
				<div class="block-content">					
					<form class="block-form">
						<div class="row">
							<div class="form-group col-sm-6 col-xs-12">
				              	<select class="form-control" name="kien_truc_thiet_ke" id="kien_truc_thiet_ke">
								    <option value="">Kiến trúc...</option>
								    @foreach($arrSetting['kien_truc_thiet_ke'] as $value)
								    <option value="{!! $value->id !!}">{!! $value->name !!}</option>
								    @endforeach
								</select>
							</div>
							<div class="form-group col-sm-6 col-xs-12">
				              	<select class="form-control" name="hinh_thuc_kien_truc" id="hinh_thuc_kien_truc">
				              		<option value="">Hình thức kiến trúc...</option>
								    @foreach($arrSetting['hinh_thuc_kien_truc'] as $value)
								    <option value="{!! $value->id !!}">{!! $value->name !!}</option>
								    @endforeach
								</select>
							</div>
						</div>
						<div class="row">
							<div class="form-group col-sm-6 col-xs-12">
				              	<select class="form-control" name="so_tang_thiet_ke">
								    <option value="">Số tầng thiết kế ...</option>
								    @foreach($arrSetting['so_tang_thiet_ke'] as $value)
								    <option value="{!! $value->id !!}">{!! $value->name !!}</option>
								    @endforeach
								</select>
							</div>
							<div class="form-group col-sm-6 col-xs-12">
				              	<select class="form-control" name="mat_tien" id="mat_tien">
				              		<option value="">Mặt tiền...</option>
								    @foreach($arrSetting['mat_tien'] as $value)
								    <option value="{!! $value->id !!}">{!! $value->name !!}</option>
								    @endforeach
								</select>
							</div>
						</div>
						<div class="row">
							<div class="form-group col-sm-6 col-xs-12">
								<input type="text" class="form-control" name="chieu_dai" id="chieu_dai" placeholder="Diện tích khu đất dài...(*)">
							</div>
							<div class="form-group col-sm-6 col-xs-12">
								<input type="text" class="form-control" id="chieu_rong" name="chieu_rong" placeholder="Diện tích khu đất rộng...(*)">
							</div>
						</div>
						<div class="row">
							<div class="form-group col-sm-6 col-xs-12">
								<input type="text" class="form-control" name="full_name" id="full_name" placeholder="Tên khách hàng...(*)">
							</div>
							<div class="form-group col-sm-6 col-xs-12">
								<input type="text" class="form-control" id="phone" name="phone" placeholder="Số điện thoại...(*)">
							</div>
						</div>						
						<div class="row">
							<div class="form-group col-sm-12 col-xs-12">
								<input type="text" class="form-control" id="email" name="email" placeholder="Email">
							</div>							
						</div>		
						<div class="row">
							<div class="form-group col-sm-12 col-xs-12">
								<textarea name="" rows="4" class="form-control" placeholder="Ghi chú"></textarea>
							</div>
						</div>
						<div class="row">
							<div class="form-group col-sm-12 col-xs-12">
								<button type="button" class="btn btn-prmary btn-view">Xem báo giá</button>
							</div>
						</div>
					</form>
				</div>
			</div><!-- /block-ct-news -->
		</div><!-- /block-col-left -->
		<div class="col-sm-3 col-xs-12 block-col-right">
			<div class="block-sidebar">
				<div class="block-module block-links-sidebar">
					<div class="block-title">
						<h2>
							<i class="fa fa-home"></i>
							DANH MỤC DỊCH VỤ
						</h2>
					</div>
					<div class="block-content">
					<ul class="list">
						@foreach($servicesList as $ser)
						<li><a @if(isset($detail) && $detail->id == $ser->id) class="active" @endif href="{{ route('services-detail', [ $ser->slug, $ser->id ]) }}" title="{!! $ser->title !!}">{!! $ser->title !!}</a></li>
						@endforeach
					</ul>
				</div>
				</div>
			</div>
		</div><!-- /block-col-right -->
	</div>
</div><!-- /block_big-title -->	
@stop
  