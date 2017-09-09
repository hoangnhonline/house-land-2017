@extends('frontend.layout')

@include('frontend.partials.meta')

@include('frontend.home.slider')

@section('content')
<div class="block block_big-title">
  <div class="container">
    <h2>BẤT ĐỘNG SẢN HOUSELAND</h2>
    <p class="desc">
      {!! $settingArr['gioi_thieu_chung'] !!}
    </p>
  </div>
</div><!-- /block_big-title -->
@if($cateParentHot)
@foreach($cateParentHot as $parent)
<div class="block block-product block-title-commom">
  <div class="container">
    <div class="block block-title">
      <h2>
        <i class="fa fa-home"></i>
        <a href="{{ route('cate-parent', [$parent->slug]) }}" title="{!! $parent->name !!}">{!! $parent->name !!}</a>
      </h2>
    </div>
    <div class="block-content">
      <ul class="owl-carousel owl-theme owl-style2" data-nav="true" data-dots="false" data-margin="30" data-responsive='{"0":{"items":1},"480":{"items":2},"600":{"items":2},"768":{"items":3},"800":{"items":3},"992":{"items":4}}'>
          @if($productParentHot[$parent->id])
          @foreach($productParentHot[$parent->id] as $product)         
          <li class="item">
            <div class="thumb">
              <a href="{{ route('product', [$product->slug, $product->id ]) }}" title="{!! $product->title !!}">
                <img src="{{ Helper::showImageThumb($product->image_url) }}" alt="{!! $product->title !!}">
              </a>
            </div>
            <div class="title">
              <h2><a href="{{ route('product', [$product->slug, $product->id ]) }}" title="{!! $product->title !!}">{!! $product->title !!}</a></h2>
            </div>
          </li>
          @endforeach
          @endif
    </div>
  </div>
</div><!-- /block_big-title -->
@endforeach
@endif
<?php 
$bannerArr = DB::table('banner')->where(['object_id' => 5, 'object_type' => 3])->orderBy('display_order', 'asc')->get();
?>
@if($bannerArr)
<?php $i = 0; ?>
@foreach($bannerArr as $banner)
<?php $i++; ?>
<div class="block block-banner">
  @if($banner->ads_url !='')
  <a href="{{ $banner->ads_url }}" title="banner ads {{ $i }}">
  @endif
  <img class="lazy" data-original="{{ Helper::showImage($banner->image_url) }}" alt="banner ads {{ $i }}">
  @if($banner->ads_url !='')
  </a>
  @endif
</div><!-- item-slide -->
@endforeach
@endif
<div class="block block_big-title">
  <div class="container">
    <h2>TIN TỨC BẤT ĐỘNG SẢN</h2>
    <p class="desc">
      {!! $settingArr['gioi_thieu_tin_tuc'] !!}
    </p>
  </div>
</div><!-- /block_big-title -->

<div class="block block-news block-title-commom">
  <div class="container">
    <div class="block-content row">
      @if($articlesCateHot->count() > 0)
      @foreach($articlesCateHot as $cateHot)
      <div class="col-sm-6 col-xs-12 block-news-left">
        <div class="block block-title">
          <h2>
            <i class="fa fa-home"></i>
            {!! $cateHot->name !!}
          </h2> 
        </div>
        @if(isset($articlesArr[$cateHot->id]) && $articlesArr[$cateHot->id]->count() > 0)
        <ul class="block-content">
          <?php $i = 0; ?>
          @foreach($articlesArr[$cateHot->id] as $articles)
          <?php $i++;?>
          <li class="@if($i == 1) first @else item @endif">
            <div class="thumb">
              <a href="{{ route('news-detail', ['slug' => $articles->slug, 'id' => $articles->id]) }}" title="{!! $articles->title !!}">
              <img class="lazy" data-original="{{ Helper::showImage($articles->image_url) }}" alt="{!! $articles->title !!}">
              </a>
            </div>
            <div class="des">
              <h2 class="title"><a href="{{ route('news-detail', ['slug' => $articles->slug, 'id' => $articles->id]) }}" title="{!! $articles->title !!}">{!! $articles->title !!}</a></h2>
              <p class="date-post"><i class="fa fa-calendar"></i> {{ date('d/m/Y', strtotime($articles->created_at)) }}</p>
              @if($i == 1) 
              <p class="description">{!! $articles->description!!}</p>
              @endif
            </div>
          </li><!-- /item -->          
          @endforeach        
        </ul>
        @endif
      </div><!-- /block-news-left -->
      @endforeach
      @endif
      <div class="clearfix"></div>
    </div>
  </div>
</div><!-- /block-news-->

<div class="block-number">
  <div class="container">
    <div class="block-content">
      <h3><span>CHÚNG TÔI LÀ SỰ LỰA CHỌN ĐÚNG ĐẮN</span></h3>
      <div class="desc">
        {!! $settingArr['su_lua_chon_dung_dan'] !!}
      </div>
      <div class="row">
        <ul class="list">
          <li class="col-sm-3 col-xs-12">
            <p class="img"><img src="{{ Helper::showImage($settingArr['icon_nam_hinh_thanh']) }}" alt="{!! $settingArr['so_nam'] !!} năm hình thành và phát triển"></p>
            <p class="number"><span id="mycountUp1"></span> năm</p>
            <p class="info">{!! $settingArr['so_nam'] !!} năm hình thành và phát triển</p>
          </li>
          <li class="col-sm-3 col-xs-12">
            <p class="img"><img src="{{ Helper::showImage($settingArr['icon_kien_truc_su']) }}" alt="{!! $settingArr['so_kien_truc_su'] !!} kiến trúc sư và kỹ sư"></p>
            <p class="number"><span id="mycountUp2"></span></p>
            <p class="info">{!! $settingArr['so_kien_truc_su'] !!} kiến trúc sư và kỹ sư</p>
          </li>
          <li class="col-sm-3 col-xs-12">
            <p class="img"><img src="{{ Helper::showImage($settingArr['icon_cong_nhan']) }}" alt="{!! $settingArr['so_cong_nhan'] !!} công nhân lành nghề"></p>
            <p class="number"><span id="mycountUp3"></span></p>
            <p class="info">{!! $settingArr['so_cong_nhan'] !!} công nhân lành nghề</p>
          </li>
          <li class="col-sm-3 col-xs-12">
            <p class="img"><img src="{{ Helper::showImage($settingArr['icon_cong_trinh']) }}" alt="{!! $settingArr['so_cong_trinh'] !!} công trình đã thực hiện"></p>
            <p class="number"><span id="mycountUp4"></span></p>
            <p class="info">{!! $settingArr['so_cong_trinh'] !!} công trình đã thực hiện</p>
          </li>
        </ul>
      </div>
    </div>
  </div>
</div><!-- /block-number -->
@stop
@section('js')
<script type="text/javascript">
                    
        var options = {
          useEasing : true,
          useGrouping : true,
          separator : '',
          decimal : '',
          prefix : '',
          suffix : ''
        };

        var mycountUp1 = new CountUp("mycountUp1", 0, {{ $settingArr['so_nam'] }}, 0, 7, options);
        var mycountUp2 = new CountUp("mycountUp2", 0, {{ $settingArr['so_kien_truc_su'] }}, 0, 7, options);
        var mycountUp3 = new CountUp("mycountUp3", 0, {{ $settingArr['so_cong_nhan'] }}, 0, 7, options);
        var mycountUp4 = new CountUp("mycountUp4", 0, {{ $settingArr['so_cong_trinh'] }}, 0, 7, options);
        mycountUp1.start();
        mycountUp2.start();
        mycountUp3.start();
        mycountUp4.start();
    </script>
@stop