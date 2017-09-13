@extends('backend.layout')
@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Yêu cầu báo giá</h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li><a href="{{ route('bao-gia.index') }}">Yêu cầu báo giá</a></li>
      <li class="active">Xem chi tiết</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <a class="btn btn-default btn-sm " href="{{ route('bao-gia.index') }}" style="margin-bottom:5px">Quay lại</a>
    <div class="row">
      <!-- left column -->

      <div class="col-md-12">
        <!-- general form elements -->
        <div class="box box-primary">
          <div class="box-header with-border">
            Chỉnh sửa
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          
            <input type="hidden" name="id" value="{{ $detail->id }}">
            <div class="box-body">
              @if (count($errors) > 0)
                  <div class="alert alert-danger">
                      <ul>
                          @foreach ($errors->all() as $error)
                              <li>{{ $error }}</li>
                          @endforeach
                      </ul>
                  </div>
              @endif
              <div class="form-group">
                <label for="email">Loại </label>
                {{ $detail->type == 1 ? "Thiết kế kiến trúc" : "Thi công xây dựng"}}
              </div>              
               <!-- text input -->
              <div class="form-group">
                <label>Họ tên : </label>
                <strong>{{ $detail->full_name }}</strong>
              </div>
              
            </div>                    
            <div class="box-footer">
              <button type="submit" class="btn btn-primary btn-sm">Lưu</button>
              <a class="btn btn-default btn-sm" class="btn btn-primary btn-sm" href="{{ route('bao-gia.index')}}">Hủy</a>
            </div>
            
        </div>
        <!-- /.box -->     

      </div>
    

    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>

@stop
@section('javascript_page')
<script type="text/javascript">
  $(document).ready(function(){    
    $('#name').change(function(){
         var name = $.trim( $(this).val() );
         if( name != '' && $('#slug').val() == ''){
            $.ajax({
              url: $('#route_get_slug').val(),
              type: "POST",
              async: false,      
              data: {
                str : name
              },              
              success: function (response) {
                if( response.str ){                  
                  $('#slug').val( response.str );
                }                
              },
              error: function(response){                             
                  var errors = response.responseJSON;
                  for (var key in errors) {
                    
                  }
              }
            });
         }
      });
  });
</script>>
@stop
