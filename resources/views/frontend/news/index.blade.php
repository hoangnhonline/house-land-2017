@extends('frontend.layout') 
  

@include('frontend.partials.meta')
  

@section('content')
<section class="col-sm-8 col-xs-12 block-sitemain">
<article class="block-breadcrumb-page">
    <ul class="breadcrumb"> 
        <li><a href="{{ route('home') }}" title="Trở về trang chủ">Trang chủ</a></li>            
        <li class="active">{!! $cateDetail->name !!}</li>
    </ul>
</article>
    <article class="block block-breadcrumb">
      <div class="block-contents">
        <ul>
          <li class="active"><h2><a href="{{ route('news-list', $cateDetail->slug) }}">{!! $cateDetail->name !!}</a></h2></li>
        </ul>
      </div>
    </article><!-- /block-breadcrumb -->    

    <article class="block block-article-list clearfix">
      <div class="col-sm-12 col-xs-12">
        <div class="row">
          <div class="block-contents">
            <ul class="article-list-news">
              @foreach( $articlesArr as $articles )
              <li class="article-news-item">
                <div class="article-news-item-head">
                  <a id="" href="{{ route('news-detail', ['slug' => $articles->slug, 'id' => $articles->id]) }}"><img title="{!! $articles->title !!}" src="{{ Helper::showImageThumb($articles->image_url, 2) }}" alt="{!! $articles->title !!}"></a>
                </div>
                <div class="article-news-item-description">
                  <a href="{{ route('news-detail', ['slug' => $articles->slug, 'id' => $articles->id]) }}" title="{!! $articles->title !!}">{!! $articles->title !!}</a>
                  <div class="nd-time">{{ date('d-m-Y', strtotime($articles->created_at)) }}  <small>{{ date('H:i', strtotime($articles->created_at)) }} </small></div>
                  <p>{!! $articles->description !!}</p>
                </div>
              </li>
              @endforeach
             
            </ul>
            <div style="text-align:center">
            {{ $articlesArr->links() }}
            </div> 
            </nav>
          </div>
        </div>
      </div>
    </article><!-- /block-news-new -->

  </section><!-- /block-site-left -->
@endsection
  @section('javascript_page')
  
@endsection