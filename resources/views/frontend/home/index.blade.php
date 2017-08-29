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
        <a href="{{ route('cate-parent', [$parent->type->slug, $parent->slug]) }}" title="{!! $parent->name !!}">{!! $parent->name !!}</a>
      </h2>
    </div>
    <div class="block-content">
      <ul class="owl-carousel owl-theme owl-style2" data-nav="true" data-dots="false" data-margin="30" data-responsive='{"0":{"items":1},"480":{"items":2},"600":{"items":2},"768":{"items":3},"800":{"items":3},"992":{"items":4}}'>
          @if($cateHot[$parent->id])
          @foreach($cateHot[$parent->id] as $cate)
          <li class="item">
            <div class="thumb">
              <a href="{{ route('cate', [$parent->type->slug, $parent->slug, $cate->slug]) }}" title="{!! $cate->name !!}"><img src="{{ Helper::showImageThumb($cate->image_url, 3) }}" alt=""></a>
            </div>
            <div class="title">
              <h2><a href="{{ route('cate', [$parent->type->slug, $parent->slug, $cate->slug]) }}" title="{!! $cate->name !!}">{!! $cate->name !!}</a></h2>
            </div>
          </li>
          @endforeach
          @endif
    </div>
  </div>
</div><!-- /block_big-title -->
@endforeach
@endif

<div class="block block-banner">
  <img src="{{ URL::asset('public/assets/images/banner/1.jpg') }}" alt="">
</div><!-- /block-banner -->

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
      <div class="col-sm-6 col-xs-12 block-news-left">
        <div class="block block-title">
          <h2>
            <i class="fa fa-home"></i>
            NHÀ PHỐ ĐẸP
          </h2> 
        </div>
        <ul class="block-content">
          <li class="first">
            <div class="thumb">
              <a href="news-detail.html" title="Tiêu đề tin tức được viết bởi nhóm iMarketing trong hôm nay - The title of this news is writen here toda"><img src="{{ URL::asset('public/assets/images/news/large_1.jpg') }}" alt=""></a>
            </div>
            <div class="des">
              <h2 class="title">
                <a href="news-detail.htm" title="Tiêu đề tin tức được viết bởi nhóm iMarketing trong hôm nay - The title of this news is writen here today">Tiêu đề tin tức được viết bởi nhóm iMarketing trong hôm nay - The title of this news is writen here today</a>
              </h2>
              <p class="date-post"><i class="fa fa-calendar"></i> 20/07/2017</p>
            </div>
          </li><!-- /first -->
          <li class="item">
            <div class="thumb">
              <a href="news-detail.html" title="Tiêu đề tin tức được viết bởi nhóm iMarketing trong hôm nay - The title of this news is writen here toda"><img src="{{ URL::asset('public/assets/images/news/thumb1.jpg') }}" alt=""></a>
            </div>
            <div class="des">
              <h2 class="title">
                <a href="news-detail.htm" title="Tiêu đề tin tức được viết bởi nhóm iMarketing trong hôm nay - The title of this news is writen here today">Tiêu đề tin tức được viết bởi nhóm iMarketing trong hôm nay - The title of this news is writen here today</a>
              </h2>
              <p class="date-post"><i class="fa fa-calendar"></i> 20/07/2017</p>
            </div>
          </li><!-- /item -->
          <li class="item">
            <div class="thumb">
              <a href="news-detail.html" title="Tiêu đề tin tức được viết bởi nhóm iMarketing trong hôm nay - The title of this news is writen here toda"><img src="{{ URL::asset('public/assets/images/news/thumb2.jpg') }}" alt=""></a>
            </div>
            <div class="des">
              <h2 class="title">
                <a href="news-detail.htm" title="Tiêu đề tin tức được viết bởi nhóm iMarketing trong hôm nay - The title of this news is writen here today">Tiêu đề tin tức được viết bởi nhóm iMarketing trong hôm nay - The title of this news is writen here today</a>
              </h2>
              <p class="date-post"><i class="fa fa-calendar"></i> 20/07/2017</p>
            </div>
          </li><!-- /item -->
        </ul>
      </div><!-- /block-news-left -->
      <div class="col-sm-6 col-xs-12 block-news-right">
        <div class="block block-title">
          <h2>
            <i class="fa fa-home"></i>
            NHÀ PHỐ ĐẸP
          </h2> 
        </div>
        <ul class="block-content">
          <li class="first">
            <div class="thumb">
              <a href="news-detail.html" title="Tiêu đề tin tức được viết bởi nhóm iMarketing trong hôm nay - The title of this news is writen here toda"><img src="{{ URL::asset('public/assets/images/news/large_1.jpg') }}" alt=""></a>
            </div>
            <div class="des">
              <h2 class="title">
                <a href="news-detail.htm" title="Tiêu đề tin tức được viết bởi nhóm iMarketing trong hôm nay - The title of this news is writen here today">Tiêu đề tin tức được viết bởi nhóm iMarketing trong hôm nay - The title of this news is writen here today</a>
              </h2>
              <p class="date-post"><i class="fa fa-calendar"></i> 20/07/2017</p>
            </div>
          </li><!-- /first -->
          <li class="item">
            <div class="thumb">
              <a href="news-detail.html" title="Tiêu đề tin tức được viết bởi nhóm iMarketing trong hôm nay - The title of this news is writen here toda"><img src="{{ URL::asset('public/assets/images/news/thumb1.jpg') }}" alt=""></a>
            </div>
            <div class="des">
              <h2 class="title">
                <a href="news-detail.htm" title="Tiêu đề tin tức được viết bởi nhóm iMarketing trong hôm nay - The title of this news is writen here today">Tiêu đề tin tức được viết bởi nhóm iMarketing trong hôm nay - The title of this news is writen here today</a>
              </h2>
              <p class="date-post"><i class="fa fa-calendar"></i> 20/07/2017</p>
            </div>
          </li><!-- /item -->
          <li class="item">
            <div class="thumb">
              <a href="news-detail.html" title="Tiêu đề tin tức được viết bởi nhóm iMarketing trong hôm nay - The title of this news is writen here toda"><img src="{{ URL::asset('public/assets/images/news/thumb2.jpg') }}" alt=""></a>
            </div>
            <div class="des">
              <h2 class="title">
                <a href="news-detail.htm" title="Tiêu đề tin tức được viết bởi nhóm iMarketing trong hôm nay - The title of this news is writen here today">Tiêu đề tin tức được viết bởi nhóm iMarketing trong hôm nay - The title of this news is writen here today</a>
              </h2>
              <p class="date-post"><i class="fa fa-calendar"></i> 20/07/2017</p>
            </div>
          </li><!-- /item -->
        </ul>
      </div><!-- /block-news-right -->
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
            <p class="img"><img src="{{ URL::asset('public/assets/images/ascendant-bars-graphic.png') }}" alt=""></p>
            <p class="number"><span id="mycountUp1"></span> năm</p>
            <p class="info">{!! $settingArr['so_nam'] !!} năm hình thành và phát triển</p>
          </li>
          <li class="col-sm-3 col-xs-12">
            <p class="img"><img src="{{ URL::asset('public/assets/images/engineer.png') }}" alt=""></p>
            <p class="number"><span id="mycountUp2"></span></p>
            <p class="info">{!! $settingArr['so_kien_truc_su'] !!} kiến trúc sư và kỹ sư</p>
          </li>
          <li class="col-sm-3 col-xs-12">
            <p class="img"><img src="{{ URL::asset('public/assets/images/worker-of-construction-working-with-a-shovel-beside-material-pile.png') }}" alt=""></p>
            <p class="number"><span id="mycountUp3"></span></p>
            <p class="info">{!! $settingArr['so_cong_nhan'] !!} công nhân lành nghề</p>
          </li>
          <li class="col-sm-3 col-xs-12">
            <p class="img"><img src="{{ URL::asset('public/assets/images/skyline.png') }}" alt=""></p>
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

        var mycountUp1 = new CountUp("mycountUp1", 0, 10, 0, 7, options);
        var mycountUp2 = new CountUp("mycountUp2", 0, 60, 0, 7, options);
        var mycountUp3 = new CountUp("mycountUp3", 0, 900, 0, 7, options);
        var mycountUp4 = new CountUp("mycountUp4", 0, 800, 0, 7, options);
        mycountUp1.start();
        mycountUp2.start();
        mycountUp3.start();
        mycountUp4.start();
    </script>
@stop