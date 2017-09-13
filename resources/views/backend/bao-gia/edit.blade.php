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
            Xem chi tiết
          </div>
          <!-- /.box-header -->
          <!-- form start -->
            <table class="table table-bordered">
                <tr>
                  <td width="200px" class="tieu-de">Loại</td>
                  <td class="gia-tri">{{ $detail->type == 1 ? "Thiết kế kiến trúc" : "Thi công xây dựng"}}</td>
                </tr>
                <tr>
                  <td width="200px" class="tieu-de">Tên khách hàng</td>
                  <td class="gia-tri">{{ $detail->full_name }}</td>
                </tr>
                <tr>
                  <td width="200px" class="tieu-de">Số điện thoại</td>
                  <td class="gia-tri">{{ $detail->phone }}</td>
                </tr>
                <tr>
                  <td width="200px" class="tieu-de">Email</td>
                  <td class="gia-tri">{{ $detail->email }}</td>
                </tr>
                @if($detail->type == 2)
                <tr>
                  <td width="200px" class="tieu-de">Địa chỉ</td>
                  <td class="gia-tri">{{ $detail->address }}</td>
                </tr>
                
                <tr>
                  <td width="200px" class="tieu-de">Kiến trúc</td>
                  <td class="gia-tri">{{ Helper::getName($detail->kien_truc_thi_cong, 'setting_baogia') }}</td>
                </tr>
                <tr>
                  <td width="200px" class="tieu-de">Loại kiến trúc thi công</td>
                  <td class="gia-tri">{{ Helper::getName($detail->loai_kien_truc_thi_cong, 'setting_baogia') }}</td>
                </tr>
                <tr>
                  <td width="200px" class="tieu-de">Hình thức thi công xây dựng</td>
                  <td class="gia-tri">{{ Helper::getName($detail->hinh_thuc_thi_cong, 'setting_baogia') }}</td>
                </tr>
                <tr>
                  <td width="200px" class="tieu-de">Tổng diện tích xây dựng</td>
                  <td class="gia-tri">{{ $detail->tong_dien_tich }}</td>
                </tr>
                <tr>
                  <td width="200px" class="tieu-de">Số tầng</td>
                  <td class="gia-tri">{{ $detail->so_tang }}</td>
                </tr>
                @else
                <tr>
                  <td width="200px" class="tieu-de">Kiến trúc</td>
                  <td class="gia-tri">{{ Helper::getName($detail->kien_truc_thiet_ke, 'setting_baogia') }}</td>
                </tr>
                <tr>
                  <td width="200px" class="tieu-de">Hình thức kiến trúc</td>
                  <td class="gia-tri">{{ Helper::getName($detail->hinh_thuc_kien_truc, 'setting_baogia') }}</td>
                </tr>
                <tr>
                  <td width="200px" class="tieu-de">Số tầng thiết kế </td>
                  <td class="gia-tri">{{ Helper::getName($detail->so_tang_thiet_ke, 'setting_baogia') }}</td>
                </tr>
                <tr>
                  <td width="200px" class="tieu-de">Mặt tiền</td>
                  <td class="gia-tri">{{ Helper::getName($detail->mat_tien, 'setting_baogia') }}</td>
                </tr>               
                @endif
                <tr>
                  <td width="200px" class="tieu-de">Chiều dài</td>
                  <td class="gia-tri">{{ $detail->chieu_dai }}</td>
                </tr>
                <tr>
                  <td width="200px" class="tieu-de">Chiều rộng</td>
                  <td class="gia-tri">{{ $detail->chieu_rong }}</td>
                </tr>
                <tr>
                  <td width="200px" class="tieu-de">Ghi chú</td>
                  <td class="gia-tri">{{ $detail->notes }}</td>
                </tr>
               
            </table>
                         
            <div class="box-footer">              
              <a class="btn btn-default btn-sm" class="btn btn-primary btn-sm" href="{{ route('bao-gia.index')}}">Quay lại</a>
            </div>
            
        </div>
        <!-- /.box -->     

      </div>
    

    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<style type="text/css">
  td.tieu-de{
    background-color: #CCC
  }
  td.gia-tri{
    font-size:17px;
    font-weight: bold;
  }
</style>
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
