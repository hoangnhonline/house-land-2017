@extends('frontend.layout')

@include('frontend.partials.meta')

@include('frontend.home.slider')

@section('content')
<div class="block block_big-title" style="margin-bottom:0px">
  <div class="container">
    <h1 data-text="2" @if($isEdit) class="edit" @endif>{!! $textList[2] !!}</h1>
    @if($settingArr['gioi_thieu_chung'] != '')
    <p class="desc">
      {!! $settingArr['gioi_thieu_chung'] !!}
    </p>
    @endif
  </div>
</div><!-- /block_big-title -->
@if($hotCateList)
@foreach($hotCateList as $hotCate)
<div class="block2 block-btn-slide block-ct-pro block-title-commom">
      <div class="container">
        <div class="block2 block-title">
          <h2>
            
              <i class="fa fa-home"></i>
              @if($hotCate->type == 1)
              <a href="{{ route('cate-parent', [$parentArr[$hotCate->object_id]->slug]) }}" title="{!! $hotCate->title !!}">{!! $hotCate->title !!}</a>
              @else
              <a href="{{ route('cate', [$cateArr[$hotCate->object_id]->cateParent->slug, $cateArr[$hotCate->object_id]->slug]) }}" title="{!! $hotCate->title !!}">{!! $hotCate->title !!}</a>
              @endif
            
          </h2>
        </div>
        <div class="block-content">
          <div class="owl-carousel owl-theme owl-style2" data-nav="true" data-dots="false" data-margin="12" data-responsive='{"0":{"items":1},"480":{"items":2},"600":{"items":2},"768":{"items":3},"800":{"items":3},"992":{"items":3}}'>
            @if($productHot[$hotCate->id])
            @foreach($productHot[$hotCate->id] as $product) 
            <div class="item">
              <div class="thumb">
                <a href="{{ route('product', [$product->slug, $product->id ]) }}" title="{!! $product->title !!}">
                <img src="{{ Helper::showImageThumb($product->image_url) }}" alt="{!! $product->title !!}">
              </a>
              </div>
              <div class="des">
                <p class="code"><span>Mã sản phẩm: </span>{!! $product->code !!}</p>
                <a href="{{ route('product', [$product->slug, $product->id ]) }}" title="{!! $product->title !!}">{!! $product->title !!}</a>                
              </div>
            </div><!-- /item -->
            @endforeach
            @endif 
          </div>
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
  <img src="{{ Helper::showImage($banner->image_url) }}" alt="banner ads {{ $i }}">
  @if($banner->ads_url !='')
  </a>
  @endif
</div><!-- item-slide -->
@endforeach
@endif
<div class="block block_big-title" style="margin-bottom:0px">
  <div class="container">
    <h2 data-text="3" @if($isEdit) class="edit" @endif>{!! $textList[3] !!}</h2>
    @if($settingArr['gioi_thieu_tin_tuc'] != '')
    <p class="desc">
      {!! $settingArr['gioi_thieu_tin_tuc'] !!}
    </p>
    @endif
  </div>
</div><!-- /block_big-title -->

<div class="block2 block-news block-title-commom">
  <div class="container">
    <div class="block-content row">
      @if($articlesCateHot->count() > 0)
      @foreach($articlesCateHot as $cateHot)
      <div class="col-sm-6 col-xs-12 block-news-left">
        <div class="block2 block-title">
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
              <img src="{{ $articles->image_url ? Helper::showImage($articles->image_url) : URL::asset('public/assets/images/no-image.jpg') }}" alt="{!! $articles->title !!}">
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
      <h3><span @if($isEdit) class="edit" @endif data-text="8">{!! $textList[8] !!}</span></h3>
      <div class="desc @if($isEdit) edit @endif" data-text="9">{!! $textList[9] !!}</div>
      <div class="row">
        <ul class="list">
          <li class="col-sm-3 col-xs-12">
            <p class="img"><img src="{{ Helper::showImage($settingArr['icon_nam_hinh_thanh']) }}" alt="{!! $settingArr['so_nam'] !!} năm hình thành và phát triển"></p>
            <p class="number"><span class="counter">{!! $settingArr['so_nam'] !!}</span> năm</p>
            <p class="info">{!! $settingArr['so_nam'] !!} năm hình thành và phát triển</p>
          </li>
          <li class="col-sm-3 col-xs-12">
            <p class="img"><img src="{{ Helper::showImage($settingArr['icon_kien_truc_su']) }}" alt="{!! $settingArr['so_kien_truc_su'] !!} kiến trúc sư và kỹ sư"></p>
            <p class="number"><span class="counter">{!! $settingArr['so_kien_truc_su'] !!}</span></p>
            <p class="info">{!! $settingArr['so_kien_truc_su'] !!} kiến trúc sư và kỹ sư</p>
          </li>
          <li class="col-sm-3 col-xs-12">
            <p class="img"><img src="{{ Helper::showImage($settingArr['icon_cong_nhan']) }}" alt="{!! $settingArr['so_cong_nhan'] !!} công nhân lành nghề"></p>
            <p class="number"><span class="counter">{!! $settingArr['so_cong_nhan'] !!}</span></p>
            <p class="info">{!! $settingArr['so_cong_nhan'] !!} công nhân lành nghề</p>
          </li>
          <li class="col-sm-3 col-xs-12">
            <p class="img"><img src="{{ Helper::showImage($settingArr['icon_cong_trinh']) }}" alt="{!! $settingArr['so_cong_trinh'] !!} công trình đã thực hiện"></p>
            <p class="number"><span class="counter">{!! $settingArr['so_cong_trinh'] !!}</span></p>
            <p class="info">{!! $settingArr['so_cong_trinh'] !!} công trình đã thực hiện</p>
          </li>
        </ul>
      </div>
    </div>
  </div>
</div><!-- /block-number -->
@stop