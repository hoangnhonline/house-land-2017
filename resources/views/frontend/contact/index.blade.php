@extends('frontend.layout')

@include('frontend.partials.meta')
@section('content')
<div class="wrapper">
    <div class="block2 block-breadcrumb">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="{{ route('home') }}">Trang chủ</a></li>
                <li class="active">Liên hệ</li>
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
                            LIÊN HỆ
                        </h2>
                    </div>
                    <div class="block-content">
                        <h2 class="tit-page2">CÔNG TY CỔ PHẦN THIẾT KẾ XÂY DỰNG HOUSELAND</h2>
                        <div class="block-address">
                            {!! $settingArr['chi_nhanh_phia_nam'] !!}
                        </div>
                        <div class="block block-map">
                            <object data="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d126263.60819855973!2d-84.44808690325613!3d33.735934882617194!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMzPCsDQ0JzQ1LjQiTiA4NMKwMjMnMzUuMyJX!5e0!3m2!1svi!2s!4v1475105845390"></object>
                        </div>
                        <div id="showmess" class="clearfix"></div>
                        @if(Session::has('message'))
                        
                        <p class="alert alert-info" >{{ Session::get('message') }}</p>
                        
                        @endif
                        @if (count($errors) > 0)                        
                          <div class="alert alert-danger ">
                            <ul>                           
                                <li>Vui lòng nhập đầy đủ thông tin.</li>                            
                            </ul>
                          </div>                        
                        @endif  
                        <form class="block-form" action="{{ route('send-contact') }}" method="POST">
                        {{ csrf_field() }}
                            <div class="row">
                                <div class="form-group col-sm-12 col-xs-12">
                                    <input type="text" class="form-control" id="full_name" name="full_name" placeholder="Họ tên khách hàng" value="{{ old('full_name') }}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-12 col-xs-12">
                                    <input type="text" class="form-control" id="phone" name="phone" placeholder="Số điện thoại" value="{{ old('phone') }}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-12 col-xs-12">
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="{{ old('email') }}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-12 col-xs-12">
                                    <textarea name="content" id="content" rowspan="300" class="form-control" placeholder="Ghi chú">{{ old('content') }}</textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-12 col-xs-12">
                                    <button type="submit" id="btnSave" class="btn btn-prmary btn-view">Gửi liên hệ</button>
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
</div><!-- /wrapper-->

@endsection


@section('js')
<script type="text/javascript">
    @if (count($errors) > 0 || Session::has('message'))      
    $(document).ready(function(){
        $('html, body').animate({
            scrollTop: $("#showmess").offset().top
        });
    });
    @endif
    $(document).ready(function(){
        $('#btnSave').click(function(){
            $(this).parents('form').submit();
            $('#btnSave').attr('disabled', 'disabled').html('<i class="fa fa-spin fa-spinner"></i>');
        });
    });
</script>
@stop
