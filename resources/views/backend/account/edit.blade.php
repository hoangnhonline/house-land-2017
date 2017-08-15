@extends('layout.backend')
@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
    Tài khoản
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li><a href="{{ route('account.index') }}">Tài khoản</a></li>
      <li class="active">Chỉnh sửa</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <a class="btn btn-default btn-sm" href="{{ route('account.index') }}" style="margin-bottom:5px">Quay lại</a>
    <form role="form" method="POST" action="{{ route('account.update') }}" id="formData">
    <div class="row">
      <!-- left column -->
      <input type="hidden" name="id" value="{{ $detail->id }}"> 
      <div class="col-md-7">
        <!-- general form elements -->
        <div class="box box-primary">
          <div class="box-header with-border">
            Chỉnh sửa
          </div>
          <!-- /.box-header -->               
            {!! csrf_field() !!}

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
                 
                 <!-- text input -->
                <div class="form-group">
                  <label>Họ tên <span class="red-star">*</span></label>
                  <input type="text" class="form-control" name="full_name" id="full_name" value="{{ $detail->full_name }}">
                </div>
                 <div class="form-group">
                  <label>Email <span class="red-star">*</span></label>
                  <input type="text" class="form-control" readonly="true" name="email" id="email" value="{{ $detail->email }}">
                </div>
                                         
                <div class="form-group">
                  <label>Role</label>
                  <select class="form-control" name="role" id="role">                             
                    <option value="1" {{ old('role', $detail->role) == 1 ? "selected" : "" }}>Editor</option>
                    @if(Auth::user()->role == 3)                  
                    <option value="2" {{ old('role', $detail->role) == 2 ? "selected" : "" }}>Mod</option>
                    <option value="3" {{ old('role', $detail->role) == 3 ? "selected" : "" }}>Admin</option>
                    @endif                    
                  </select>
                </div>
                @if(Auth::user()->role == 3)
                <div class="form-group col-md-12" style="display:none" id="chon_mod">
                  <p class="clearfix"><strong>Mod</strong></p>
                  <div style="clear:both"></div>     
                    @if($modList)
                      @foreach($modList as $mod)
                      <div class="checkbox col-md-4" style="margin-top:0px !important;">
                        <input type="checkbox" id="mod{{$mod->id}}" name="mod_id[]" value="{{ $mod->id }}" {{ in_array($mod->id, $modSelected) ? "checked=checked" : "" }}>
                        <label for="mod{{$mod->id}}">{{ $mod->full_name }}</label>
                      </div>
                      @endforeach
                    @endif
                </div> 
                @endif                   
                <div class="form-group">
                  <label>Trạng thái</label>
                  <select class="form-control" name="status" id="status">                                      
                    <option value="1" {{ $detail->status == 1 ? "selected" : "" }}>Mở</option>                  
                    <option value="2" {{ $detail->status == 2 ? "selected" : "" }}>Khóa</option>                    
                  </select>
                </div>
            </div>
            <div class="box-footer">
              <button type="button" class="btn btn-default btn-sm" id="btnLoading" style="display:none"><i class="fa fa-spin fa-spinner"></i></button>
              <button type="submit" class="btn btn-primary btn-sm" id="btnSave">Lưu</button>
              <a class="btn btn-default btn-sm" class="btn btn-primary btn-sm" href="{{ route('account.index')}}">Hủy</a>
            </div>
            
        </div>
        <!-- /.box -->     

      </div>
      
      <!--/.col (left) -->      
    </div>
    </form>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
@stop
@section('javascript_page')
<script type="text/javascript">
     $(document).ready(function(){
      $('#formData').submit(function(){
        $('#btnSave').hide();
        $('#btnLoading').show();
      });
      @if(Auth::user()->role == 3)
      $('#role').change(function(){
        if($(this).val() == 1){
          $('#chon_mod').show();
        }else{
          $('#chon_mod').hide();
        }
      });
      @endif
      if($('#role').val() == 1){
        $('#chon_mod').show();
      }else{
        $('#chon_mod').hide();
      }
    });
</script>
@stop
