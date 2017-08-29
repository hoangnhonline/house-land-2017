@extends('backend.layout')
@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Cài đặt site
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li><a href="{{ route('settings.index') }}">Cài đặt</a></li>
      <li class="active">Cập nhật</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">   
    <form role="form" method="POST" action="{{ route('settings.update') }}">
    <div class="row">
      <!-- left column -->

      <div class="col-md-7">
        <!-- general form elements -->
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Cập nhật</h3>
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
              @if(Session::has('message'))
              <p class="alert alert-info" >{{ Session::get('message') }}</p>
              @endif
                 <!-- text input -->
                <div class="form-group col-md-12">
                  <label>Tên site <span class="red-star">*</span></label>
                  <input type="text" class="form-control" name="site_name" id="site_name" value="{{ $settingArr['site_name'] }}">
                </div>
                
                <div class="form-group col-md-6">
                  <label>Hotline </label>
                  <input type="text" class="form-control" name="hotline" id="hotline" value="{{ $settingArr['hotline'] }}">
                </div>
                <div class="form-group col-md-6">
                  <label>Email </label>
                  <input type="text" class="form-control" name="email_header" id="email_header" value="{{ $settingArr['email_header'] }}">
                </div>
                <div class="form-group col-md-6">
                  <label>Số năm kinh nghiệm </label>
                  <input type="text" class="form-control" name="so_nam" id="so_nam" value="{{ $settingArr['so_nam'] }}">
                </div>
                <div class="form-group col-md-6">
                  <label>Số kiến trúc sư và kỹ sư <span class="red-star">*</span></label>
                  <input type="text" class="form-control" name="so_kien_truc_su" id="so_kien_truc_su" value="{{ $settingArr['so_kien_truc_su'] }}">
                </div>
                <div class="form-group col-md-6">
                  <label>Số công nhân</label>
                  <input type="text" class="form-control" name="so_cong_nhan" id="so_cong_nhan" value="{{ $settingArr['so_cong_nhan'] }}">
                </div>
                <div class="form-group col-md-6">
                  <label>Số công trình <span class="red-star">*</span></label>
                  <input type="text" class="form-control" name="so_cong_trinh" id="so_cong_trinh" value="{{ $settingArr['so_cong_trinh'] }}">
                </div>
                <div class="form-group col-md-6">
                  <label>Số bài viết liên quan</label>
                  <input type="text" class="form-control" name="articles_per_page" id="articles_per_page" value="{{ $settingArr['articles_per_page'] }}">
                </div>
                <div class="form-group col-md-6">
                  <label>Số sản phẩm 1 trang </label>
                  <input type="text" class="form-control" name="product_per_page" id="product_per_page" value="{{ $settingArr['product_per_page'] }}">
                </div>
                <div class="form-group col-md-6">
                  <label>Số bài viết liên quan</label>
                  <input type="text" class="form-control" name="so_tin_lien_quan" id="so_tin_lien_quan" value="{{ $settingArr['so_tin_lien_quan'] }}">
                </div>        
                <div class="clearfix"></div>      
                <div class="form-group col-md-6">
                  <label>Facebook</label>
                  <input type="text" class="form-control" name="facebook_fanpage" id="facebook_fanpage" value="{{ $settingArr['facebook_fanpage'] }}">
                </div>
                <div class="form-group col-md-6">
                  <label>Facebook APP ID</label>
                  <input type="text" class="form-control" name="facebook_appid" id="facebook_appid" value="{{ $settingArr['facebook_appid'] }}">
                </div>
                <div class="form-group col-md-6">
                  <label>Google +</label>
                  <input type="text" class="form-control" name="google_fanpage" id="google_fanpage" value="{{ $settingArr['google_fanpage'] }}">
                </div>
                <div class="form-group col-md-6">
                  <label>Twitter</label>
                  <input type="text" class="form-control" name="twitter_fanpage" id="twitter_fanpage" value="{{ $settingArr['twitter_fanpage'] }}">
                </div>                
                <div class="form-group col-md-6">
                  <label>Chi nhánh phía Nam</label>
                  <textarea class="form-control" rows="3" name="chi_nhanh_phia_nam" id="chi_nhanh_phia_nam">{{ $settingArr['chi_nhanh_phia_nam'] }}</textarea>
                </div>  
                <div class="form-group col-md-6">
                  <label>Chi nhánh phía Bắc</label>
                  <textarea class="form-control" rows="3" name="chi_nhanh_phia_bac" id="chi_nhanh_phia_bac">{{ $settingArr['chi_nhanh_phia_bac'] }}</textarea>
                </div>                
                <div class="form-group col-md-6">
                  <label>Code google analystic </label>
                  <textarea name="google_analystic" id="google_analystic" rows="3" class="form-control">{{ $settingArr['google_analystic'] }}</textarea>
                </div>   
                <div class="clearfix"></div>
                <div class="form-group col-md-6">
                  <label>Nội dung giới thiệu trang chủ </label>
                  <textarea name="gioi_thieu_chung" id="gioi_thieu_chung" rows="7" class="form-control">{{ $settingArr['gioi_thieu_chung'] }}</textarea>
                </div>
                <div class="form-group col-md-6">
                  <label>Nội dung giới thiệu tin tức </label>
                  <textarea name="gioi_thieu_tin_tuc" id="gioi_thieu_tin_tuc" rows="7" class="form-control">{{ $settingArr['gioi_thieu_tin_tuc'] }}</textarea>
                </div>  
                <div class="form-group col-md-12">
                  <label>Chúng tôi là sự lựa chọn đúng đắn </label>
                  <textarea name="su_lua_chon_dung_dan" id="su_lua_chon_dung_dan" rows="7" class="form-control">{{ $settingArr['su_lua_chon_dung_dan'] }}</textarea>
                </div>   
                <div class="clearfix"></div>
                <div class="form-group col-md-12" style="margin-top:10px;margin-bottom:10px">  
                  <label class="col-md-3 row">Logo </label>    
                  <div class="col-md-9">
                    <img id="thumbnail_logo" src="{{ $settingArr['logo'] ? Helper::showImage($settingArr['logo']) : URL::asset('public/admin/dist/img/img.png') }}" class="img-logo" width="150" >
                    
                    <input type="file" id="file-logo" style="display:none" />
                 
                    <button class="btn btn-default btn-sm" id="btnUploadLogo" type="button"><span class="glyphicon glyphicon-upload" aria-hidden="true"></span> Upload</button>
                  </div>
                  <div style="clear:both"></div>
                </div>
                <div style="clear:both"></div> 
                <div class="form-group col-md-12" style="margin-top:10px;margin-bottom:10px">  
                  <label class="col-md-3 row">Favicon </label>    
                  <div class="col-md-9">
                    <img id="thumbnail_favicon" src="{{ $settingArr['favicon'] ? Helper::showImage($settingArr['favicon']) : URL::asset('public/admin/dist/img/img.png') }}" class="img-favicon" width="50">
                    
                    <input type="file" id="file-favicon" style="display:none" />
                 
                    <button class="btn btn-default btn-sm" id="btnUploadFavicon" type="button"><span class="glyphicon glyphicon-upload" aria-hidden="true"></span> Upload</button>
                  </div>
                  <div style="clear:both"></div>
                </div>
                <div style="clear:both"></div> 
                <div class="form-group col-md-12" style="margin-top:10px;margin-bottom:10px">  
                  <label class="col-md-3 row">Banner ( og:image ) </label>    
                  <div class="col-md-9">
                    <img id="thumbnail_banner" src="{{ $settingArr['banner'] ? Helper::showImage($settingArr['banner']) : URL::asset('public/admin/dist/img/img.png') }}" class="img-banner" width="200">
                    
                    <input type="file" id="file-banner" style="display:none" />
                 
                    <button class="btn btn-default btn-sm" id="btnUploadBanner" type="button"><span class="glyphicon glyphicon-upload" aria-hidden="true"></span> Upload</button>
                  </div>
                  <div style="clear:both"></div>
                </div>
                <div style="clear:both"></div>            
                 
            </div>                        
            <div class="box-footer">
              <button type="submit" class="btn btn-primary btn-sm">Lưu</button>         
            </div>
            
        </div>
        <!-- /.box -->     

      </div>
      <div class="col-md-5">
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Màu sắc</h3>
          </div>
          <!-- /.box-header -->
            <div class="box-body">
              <div class="form-group col-md-6">
                <label>Màu nền menu </label>
                <div  class="input-group colorpicker-component mau">
                    <input type="text" value="{{ $settingArr['mau_nen_menu'] }}" class="form-control" name="mau_nen_menu" />
                    <span class="input-group-addon"><i></i></span>
                </div>
              </div> 
              <div class="form-group col-md-6">
                <label>Màu menu hover</label>
                <div  class="input-group colorpicker-component mau">
                    <input type="text" value="{{ $settingArr['mau_menu_hover'] }}" class="form-control" name="mau_menu_hover" />
                    <span class="input-group-addon"><i></i></span>
                </div>
              </div>             
              <div class="form-group col-md-6">
                <label>Màu nền footer </label>
                <div class="input-group colorpicker-component mau">
                    <input type="text" value="{{ $settingArr['mau_nen_footer'] }}" class="form-control" name="mau_nen_footer" />
                    <span class="input-group-addon"><i></i></span>
                </div>
              </div> 
              <div class="form-group col-md-6">
                <label>Màu nền khung tìm kiếm </label>
                <div class="input-group colorpicker-component mau">
                    <input type="text" value="{{ $settingArr['mau_nen_search'] }}" class="form-control" name="mau_nen_search" />
                    <span class="input-group-addon"><i></i></span>
                </div>
              </div>  
              <div class="form-group col-md-6">
                <label>Màu nền copyright </label>
                <div class="input-group colorpicker-component mau">
                    <input type="text" value="{{ $settingArr['mau_nen_copyright'] }}" class="form-control" name="mau_nen_copyright" />
                    <span class="input-group-addon"><i></i></span>
                </div>
              </div>  
              <div class="form-group col-md-6">
                <label>Màu nền tiêu đề danh mục </label>
                <div class="input-group colorpicker-component mau">
                    <input type="text" value="{{ $settingArr['mau_nen_block'] }}" class="form-control" name="mau_nen_block" />
                    <span class="input-group-addon"><i></i></span>
                </div>
              </div>  
              <div class="form-group col-md-6">
                <label>Màu nút đăng ký </label>
                <div class="input-group colorpicker-component mau">
                    <input type="text" value="{{ $settingArr['mau_nut_dang_ky'] }}" class="form-control" name="mau_nut_dang_ky" />
                    <span class="input-group-addon"><i></i></span>
                </div>
              </div>  
              <div class="form-group col-md-6">
                <label>Màu nút Back to top</label>
                <div class="input-group colorpicker-component mau">
                    <input type="text" value="{{ $settingArr['mau_nut_top'] }}" class="form-control" name="mau_nut_top" />
                    <span class="input-group-addon"><i></i></span>
                </div>
              </div>  
        </div>
        <!-- /.box -->     

      </div>
        <!-- general form elements -->
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Thông tin SEO</h3>
          </div>
          <!-- /.box-header -->
            <div class="box-body">
              <div class="form-group">
                <label>Meta title <span class="red-star">*</span></label>
                <input type="text" class="form-control" name="site_title" id="site_title" value="{{ $settingArr['site_title'] }}">
              </div>
              <!-- textarea -->
              <div class="form-group">
                <label>Meta desciption <span class="red-star">*</span></label>
                <textarea class="form-control" rows="4" name="site_description" id="site_description">{{ $settingArr['site_description'] }}</textarea>
              </div>  

              <div class="form-group">
                <label>Meta keywords <span class="red-star">*</span></label>
                <textarea class="form-control" rows="4" name="site_keywords" id="site_keywords">{{ $settingArr['site_keywords'] }}</textarea>
              </div>  
              <div class="form-group">
                <label>Custom text</label>
                <textarea class="form-control" rows="4" name="custom_text" id="custom_text">{{ $settingArr['custom_text'] }}</textarea>
              </div>
            
        </div>
        <!-- /.box -->     

      </div>
      
      <!--/.col (left) -->      
    </div>
<input type="hidden" name="logo" id="logo" value="{{ $settingArr['logo'] }}"/>          
<input type="hidden" name="logo_name" id="logo_name" value="{{ old('logo_name') }}"/>
<input type="hidden" name="favicon" id="favicon" value="{{ $settingArr['favicon'] }}"/>          
<input type="hidden" name="favicon_name" id="favicon_name" value="{{ old('favicon_name') }}"/>
<input type="hidden" name="banner" id="banner" value="{{ $settingArr['banner'] }}"/>          
<input type="hidden" name="banner_name" id="banner_name" value="{{ old('banner_name') }}"/>

    </form>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<input type="hidden" id="route_upload_tmp_image" value="{{ route('image.tmp-upload') }}">
@stop
@section('javascript_page')
<script type="text/javascript">
    $(document).ready(function(){
      var editor = CKEDITOR.replace( 'chi_nhanh_phia_bac',{
          language : 'vi',       
          height : 200,
          toolbarGroups : [            
            { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },          
            { name: 'links', groups: [ 'links' ] },           
            '/',            
          ]
      });
      $('.mau').colorpicker();
      var editor2 = CKEDITOR.replace( 'chi_nhanh_phia_nam',{
          language : 'vi',     
          height : 200,
          toolbarGroups : [            
            { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },          
            { name: 'links', groups: [ 'links' ] },           
            '/',            
          ]
      });
      $('#btnUploadLogo').click(function(){        
        $('#file-logo').click();
      });
      $('#btnUploadFavicon').click(function(){        
        $('#file-favicon').click();
      });
      $('#btnUploadBanner').click(function(){        
        $('#file-banner').click();
      });
      var files = "";
      $('#file-logo').change(function(e){
         files = e.target.files;
         
         if(files != ''){
           var dataForm = new FormData();        
          $.each(files, function(key, value) {
             dataForm.append('file', value);
          });   
          
          dataForm.append('date_dir', 0);
          dataForm.append('folder', 'tmp');

          $.ajax({
            url: $('#route_upload_tmp_image').val(),
            type: "POST",
            async: false,      
            data: dataForm,
            processData: false,
            contentType: false,
            success: function (response) {
              if(response.image_path){
                $('#thumbnail_logo').attr('src',$('#upload_url').val() + response.image_path);
                $( '#logo' ).val( response.image_path );
                $( '#logo_name' ).val( response.image_name );
              }
              console.log(response.image_path);
                //window.location.reload();
            },
            error: function(response){                             
                var errors = response.responseJSON;
                for (var key in errors) {
                  
                }
                //$('#btnLoading').hide();
                //$('#btnSave').show();
            }
          });
        }
      });
      var filesFavicon = '';
      $('#file-favicon').change(function(e){
         filesFavicon = e.target.files;
         
         if(filesFavicon != ''){
           var dataForm = new FormData();        
          $.each(filesFavicon, function(key, value) {
             dataForm.append('file', value);
          });
          
          dataForm.append('date_dir', 0);
          dataForm.append('folder', 'tmp');

          $.ajax({
            url: $('#route_upload_tmp_image').val(),
            type: "POST",
            async: false,      
            data: dataForm,
            processData: false,
            contentType: false,
            success: function (response) {
              if(response.image_path){
                $('#thumbnail_favicon').attr('src',$('#upload_url').val() + response.image_path);
                $('#favicon').val( response.image_path );
                $( '#favicon_name' ).val( response.image_name );
              }
              console.log(response.image_path);
                //window.location.reload();
            },
            error: function(response){                             
                var errors = response.responseJSON;
                for (var key in errors) {
                  
                }
                //$('#btnLoading').hide();
                //$('#btnSave').show();
            }
          });
        }
      });
      
      var filesBanner = '';
      $('#file-banner').change(function(e){
         filesBanner = e.target.files;
         
         if(filesBanner != ''){
           var dataForm = new FormData();        
          $.each(filesBanner, function(key, value) {
             dataForm.append('file', value);
          });
          
          dataForm.append('date_dir', 0);
          dataForm.append('folder', 'tmp');

          $.ajax({
            url: $('#route_upload_tmp_image').val(),
            type: "POST",
            async: false,      
            data: dataForm,
            processData: false,
            contentType: false,
            success: function (response) {
              if(response.image_path){
                $('#thumbnail_banner').attr('src',$('#upload_url').val() + response.image_path);
                $('#banner').val( response.image_path );
                $( '#banner_name' ).val( response.image_name );
              }
              console.log(response.image_path);
                //window.location.reload();
            },
            error: function(response){                             
                var errors = response.responseJSON;
                for (var key in errors) {
                  
                }
                //$('#btnLoading').hide();
                //$('#btnSave').show();
            }
          });
        }
      });

    });
    
</script>
@stop
