@extends('backend.layout')
@section('content')
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Sản phẩm
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li><a href="{{ route( 'product.index' ) }}">Sản phẩm</a></li>
    <li class="active">Danh sách</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-12">
      @if(Session::has('message'))
      <p class="alert alert-info" >{{ Session::get('message') }}</p>
      @endif
      <a href="{{ route('product.create', ['parent_id' => $arrSearch['parent_id'], 'cate_id' => $arrSearch['cate_id']]) }}" class="btn btn-info btn-sm" style="margin-bottom:5px">Tạo mới</a>
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Bộ lọc</h3>
        </div>
        <div class="panel-body">
          <form class="form-inline" id="searchForm" role="form" method="GET" action="{{ route('product.index') }}">           
              
            <div class="form-group">              
              <select class="form-control" name="parent_id" id="parent_id">
                <option value="">--Danh mục cha--</option>                  
                  @foreach( $cateParentList as $value )
                    <option value="{{ $value->id }}"
                    {{ $arrSearch['parent_id'] == $value->id ? "selected" : "" }}                        

                    >{{ $value->name }}</option>
                    @endforeach
              </select>
            </div>
            <div class="form-group">              
              <select class="form-control" name="cate_id" id="cate_id">
                <option value="">--Danh mục con--</option>
                  <?php 
                  if($arrSearch['parent_id']){
                    $cateList = App\Models\Cate::where('parent_id', $arrSearch['parent_id'])->get();
                  }
                  ?>
                  @foreach( $cateList as $value )
                    <option value="{{ $value->id }}"
                    {{ $arrSearch['cate_id'] == $value->id ? "selected" : "" }}                        

                    >{{ $value->name }}</option>
                    @endforeach
              </select>
            </div>          
            <div class="form-group">              
              <input type="text" placeholder="Tên sản phẩm" class="form-control" name="title" value="{{ $arrSearch['title'] }}" >
            </div>
            <div class="form-group">              
              <input type="text" placeholder="Mã sản phẩm" class="form-control" name="code" value="{{ $arrSearch['code'] }}" >
            </div>           
            <div class="form-group">
                <div class="checkbox">
                  <label style="color:red; font-weight:bold">
                    <input type="checkbox" name="is_hot" id="is_hot" value="1" {{ $arrSearch['is_hot'] == 1 ? "checked" : "" }}>
                     HOT
                  </label>
                </div>               
              </div>
            <button type="submit" class="btn btn-primary btn-sm">Lọc</button>
          </form>         
        </div>
      </div>
      
      <div class="box">

        <div class="box-header with-border">
          <h3 class="box-title">Danh sách ( {{ $items->total() }} sản phẩm )</h3>
        </div>
        
        <!-- /.box-header -->
        <div class="box-body">
          <div style="text-align:center">
           {{ $items->appends( $arrSearch )->links() }}
          </div>  
          @if($arrSearch['is_hot'] == 1)
          <form method="post" action={{ route('product.save-order-hot')}} >
            {{ csrf_field() }}
            @if($items->count() > 0)
            <button type="submit" class="btn btn-warning btn-sm">Save thứ tự</button>
            @endif
            <input type="hidden" name="parent_id" value="{{ $arrSearch['parent_id']}}">
            <input type="hidden" name="is_hot" value="1">
          @endif

            <table class="table table-bordered" id="table-list-data">
              <tr>
                <th style="width: 1%">#</th>
                <th style="width: 1%;white-space:nowrap">Mã tin</th>
                @if($arrSearch['is_hot'] == 1)
                <td width="120px">
                  Thứ tự
                </td>
                @endif
                <th width="100px">Hình ảnh</th>
                <th>Thông tin sản phẩm</th>                                          
                <th width="1%;white-space:nowrap">Thao tác</th>
              </tr>
              <tbody>
              @if( $items->count() > 0 )
                <?php $i = 0; ?>
                @foreach( $items as $item )
                  <?php $i ++; 

                  ?>
                <tr id="row-{{ $item->id }}">
                  <td><span class="order">{{ $i }}</span></td>
                  <td style="text-align:center">{{ $item->code }}</td>
                  @if($arrSearch['is_hot'] == 1)
                  <td>
                    <input type="text" value="{{ $item->display_order }}" name="display_order[{{$item->id}}]" style="width:80px" class="form-control" />
                  </td>
                  @endif
                  <td>
                    <img class="img-thumbnail lazy" width="80" data-original="{{ $item->image_urls ? Helper::showImage($item->image_urls) : URL::asset('public/admin/dist/img/no-image.jpg') }}" alt="Nổi bật" title="Nổi bật" />
                  </td>
                  <td>                  
                    <a style="color:#444;font-weight:bold;font-size:16px" href="{{ route( 'product.edit', [ 'id' => $item->id ]) }}">{{ $item->title }}</a> 
                    @if( $item->is_hot == 1 )
                    <label class="label label-danger">HOT</label>
                    @endif
                    
                  <br>
                  <p style="color:#00acd6;font-weight:bold;margin-top:10px">{{ $item->cateParent->name }} / {{ $item->cate->name }}</p>
                    <div class="block-author">
                      <ul>
                        <li>
                          <span>Tác giả:</span>
                          <span class="name">{!! $item->createdUser->display_name !!}</span>
                        </li>
                        <li>
                            <span>Ngày tạo:</span>
                          <span class="name">{!! date('d/m/Y H:i', strtotime($item->created_at)) !!}</span>
                          
                        </li>
                         <li>
                            <span>Cập nhật:</span>
                          <span class="name">{!! $item->updatedUser->display_name !!} ( {!! date('d/m/Y H:i', strtotime($item->updated_at)) !!} )</span>          
                        </li>  
                        <li>
                          {!! Helper::view($item->id, 1) !!} lượt xem
                        </li>
                      </ul>
                    </div>
                  </td>
                 
                  <td style="white-space:nowrap; text-align:right">
                    <a class="btn btn-default btn-sm" href="{{ route('product', [$item->slug, $item->id] ) }}" target="_blank" title="Xem"><i class="fa fa-eye" aria-hidden="true"></i> Xem</a>
                    <a href="{{ route( 'product.edit', [ 'id' => $item->id ]) }}" class="btn btn-warning btn-sm" title="Chỉnh sửa"><span class="glyphicon glyphicon-pencil"></span></a>                 

                    <a onclick="return callDelete('{{ $item->title }}','{{ route( 'product.destroy', [ 'id' => $item->id ]) }}');" class="btn btn-danger btn-sm" title="Xóa">
                      <span class="glyphicon glyphicon-trash"></span>
                      </a>

                  </td>
                </tr> 
                @endforeach
              @else
              <tr>
                <td colspan="9">Không có dữ liệu.</td>
              </tr>
              @endif

            </tbody>
            </table>
          @if($arrSearch['is_hot'] == 1)
          </form>
          @endif
          <div style="text-align:center">
           {{ $items->appends( $arrSearch )->links() }}
          </div>  
        </div>        
      </div>
      <!-- /.box -->     
    </div>
    <!-- /.col -->  
  </div> 
</section>
<!-- /.content -->
</div>
<style type="text/css">
#searchForm div{
  margin-right: 7px;
}
</style>
@stop
@section('javascript_page')
<script type="text/javascript">
function callDelete(title, url){  
  swal({
    title: 'Bạn muốn xóa "' + title +'"?',
    text: "Dữ liệu sẽ không thể phục hồi.",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes'
  }).then(function() {
    location.href= url;
  })
  return flag;
}
$(document).ready(function(){
  $('input.submitForm').click(function(){
    var obj = $(this);
    if(obj.prop('checked') == true){
      obj.val(1);      
    }else{
      obj.val(0);
    } 
    obj.parent().parent().parent().submit(); 
  });
  
  $('#parent_id, #type, #cate_id').change(function(){    
    $('#searchForm').submit();
  });  
  $('#is_hot').change(function(){
    $('#searchForm').submit();
  });
  $('#table-list-data tbody').sortable({
        placeholder: 'placeholder',
        handle: ".move",
        start: function (event, ui) {
                ui.item.toggleClass("highlight");
        },
        stop: function (event, ui) {
                ui.item.toggleClass("highlight");
        },          
        axis: "y",
        update: function() {
            var rows = $('#table-list-data tbody tr');
            var strOrder = '';
            var strTemp = '';
            for (var i=0; i<rows.length; i++) {
                strTemp = rows[i].id;
                strOrder += strTemp.replace('row-','') + ";";
            }     
            updateOrder("san_pham", strOrder);
        }
    });
});
function updateOrder(table, strOrder){
  $.ajax({
      url: $('#route_update_order').val(),
      type: "POST",
      async: false,
      data: {          
          str_order : strOrder,
          table : table
      },
      success: function(data){
          var countRow = $('#table-list-data tbody tr span.order').length;
          for(var i = 0 ; i < countRow ; i ++ ){
              $('span.order').eq(i).html(i+1);
          }                        
      }
  });
}
</script>
@stop