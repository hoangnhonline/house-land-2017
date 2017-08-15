@section('slider')
<?php 
if(!isset($project_id)){
	$bannerArr = DB::table('banner')->where(['object_id' => 1, 'object_type' => 3])->orderBy('display_order', 'asc')->get();
}else{
	if($tab_id == 1){
		$bannerArr =  DB::table('banner')->where(['object_id' => $project_id, 'object_type' => 4])->orderBy('display_order', 'asc')->get();
	}else{
		$bannerArr = (object)[];
	}
	
}

?>
@if(\Request::route()->getName() == 'detail-project' || \Request::route()->getName() == 'tab')
@if($bannerArr)
<section class="block block-2-col container" style="margin-bottom:-10px !important;">
	<div class="row">		
		<div class="col-sm-12 col-xs-12">
			<div class="block-slider-home">
				<div class="owl-carousel dotsData owl-style2" data-nav="true" data-margin="0" data-items='1' data-autoplayTimeout="500" data-autoplay="true" data-loop="true">
					<?php $i = 0; ?>
					@foreach($bannerArr as $banner)
					 <?php $i++; ?>
					<div class="item-slide" data-dot="{{ $i }}">
						@if($banner->ads_url !='')
						<a href="{{ $banner->ads_url }}">
						@endif
							<img src="{{ Helper::showImage($banner->image_url) }}" alt="slide {{ $i }}">
						@if($banner->ads_url !='')
						</a>
						@endif
					</div><!-- item-slide1 -->
					@endforeach							
				</div>
			</div><!-- /block-slider -->
		</div><!-- /col-sm-8 col-xs-12 -->
	</div>
</section><!-- /block-2-col -->
@endif
@else
<section class="block block-2-col container">
	<div class="row">
		<div class="col-sm-3 col-xs-12">
			<div class="block-searh-bar">
				<article class="block-box-search block-box-search-home">
					<div class="block-title">
					<?php $type = isset($type) ? $type : 1 ; ?>
						<ul class="nav nav-tabs" role="tablist">
							<li role="presentation" class="{{ (isset($type) && $type == 1) ? "active" : "" }}"><a href="javascript:void(0)" data-type="1" aria-controls="bdsb" role="tab" data-toggle="tab">BDS BÁN</a></li>
							<li role="presentation" class="{{ (isset($type) && $type == 2) ? "active" : "" }}"><a href="javascript:void(0)" data-type="2" aria-controls="bdsct" role="tab" data-toggle="tab">BDS CHO THUÊ</a></li>
						</ul>
					</div>
					<div class="block-contents">
					 	<!-- Tab panes -->
						<div class="tab-content">
							<div role="tabpanel" class="tab-pane active" id="bdsb">

								<form action="{{ route('search') }}" method="GET" accept-charset="utf-8" class="search-content-input selectpicker-cus block-hover-selectpicker">
							    	<input type="hidden" name="type" id="type" value="{{ isset($type) ? $type : 1 }}">
							    	<div class="row-select">
										<div class="form-group">
											<select class="selectpicker form-control" data-live-search="true" name="estate_type_id" id="estate_type_id">
												<option value="">Loại bất động sản</option>
												@foreach($banList as $ban)
												<option @if(isset($estate_type_id) && $estate_type_id == $ban->id) selected @endif class="option-lv1" value="{{ $ban->id }}">{{ $ban->name }}</option>
												@endforeach
											</select>
										</div>											
										<div class="form-group">
												<select class="selectpicker form-control" data-live-search="true" id="city_id" name="city_id">
													<option value="">Tỉnh/TP</option>
													@foreach($cityList as $city)
													<option @if(isset($city_id) && $city_id == $city->id) selected @endif value="{{ $city->id }}">{{ $city->name }}</option>
													@endforeach
												</select>
											</div>
											<div class="form-group">
												<select class="selectpicker form-control" data-live-search="true" id="district_id" name="district_id">
													<option value="">Quận/Huyện</option>
													<?php 
													if(isset($city_id)){
													$districtList = App\Models\District::where('city_id', $city_id)->get();
													}
													?>
													@foreach($districtList as $district)
													<option @if(isset($district_id) && $district_id == $district->id) selected @endif value="{{ $district->id }}">{{ $district->name }}</option>
													@endforeach
												</select>
											</div>
										<div class="form-group">
											<select class="selectpicker form-control" id="ward_id" name="ward_id" data-live-search="true">
												<option value="">Phường/Xã</option>
											</select>
										</div>
										<div class="form-group">
											<select class="selectpicker form-control" id="street_id" name="street_id" data-live-search="true">
												<option value="">Đường/Phố</option>
											</select>
										</div>										
										<div class="form-group">
											<select class="selectpicker form-control" data-live-search="true" name="price_id" id="price_id">
												<option value="">Mức giá</option>
												@foreach($priceList as $price)
												<option @if(isset($price_id) && $price_id == $price->id) selected @endif value="{{ $price->id }}">{{ $price->name }}</option>
												@endforeach
											</select>
										</div>
										<div class="form-group">
											<select class="selectpicker form-control" id="area_id" name="area_id" data-live-search="true">
												<option value="">Diện tích</option>
												@foreach($areaList as $area)
												<option @if(isset($area_id) && $area_id == $area->id) selected @endif value="{{ $area->id }}">{{ $area->name }}</option>
												@endforeach
											</select>
										</div>																					
										<div class="form-group">
											<button type="submit" id="btnSearch" class="btn btn-success"><i class="fa fa-search"></i> Tìm Kiếm</button>
										</div>
									</div>
						    	</form>
							</div>								
						</div>
					</div>
				</article><!-- /block-box-search -->				
			</div>
		</div><!-- /col-sm-4 col-xs-12 -->
		<div class="col-sm-9 col-xs-12">
			<div class="block-slider-home">
				<div class="owl-carousel dotsData owl-style2" data-nav="true" data-margin="0" data-items='1' data-autoplayTimeout="500" data-autoplay="true" data-loop="true">
					<?php $i = 0; ?>
					@foreach($bannerArr as $banner)
					 <?php $i++; ?>
					<div class="item-slide" data-dot="{{ $i }}">
						@if($banner->ads_url !='')
						<a href="{{ $banner->ads_url }}">
						@endif
							<img src="{{ Helper::showImage($banner->image_url) }}" alt="slide {{ $i }}">
						@if($banner->ads_url !='')
						</a>
						@endif
					</div><!-- item-slide1 -->
					@endforeach							
				</div>
			</div><!-- /block-slider -->
		</div><!-- /col-sm-8 col-xs-12 -->
	</div>
	</section><!-- /block-2-col -->
@endif

@endsection