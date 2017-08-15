@extends('frontend.layout') 
  
@include('frontend.partials.meta')
@section('content')
<section class="block-page-article-1" style="padding:10px 5px">
  <article class="page-article-1-content">
    <div class="block-title-common">
      <h3><span class="icon-tile"><i class="fa fa-user"></i></span> {!! $detailPage->title !!}</h3>
    </div>
    <div class="block-content">
        <?php echo $detailPage->content; ?>
    </div>
  </article>
</section>
@endsection
  