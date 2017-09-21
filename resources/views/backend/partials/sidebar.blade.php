<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="{{ URL::asset('public/admin/dist/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p>{{ Auth::user()->display_name }}</p>
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>
    <!-- /.search form -->
    <!-- sidebar menu: : style can be found in sidebar.less -->
    {{ var_dump(Auth::user()->role ) }}
    <ul class="sidebar-menu">
      <li class="header">MAIN NAVIGATION</li>
     
      <li class="treeview {{ in_array(\Request::route()->getName(), ['product.index', 'product.create', 'product.edit', 'cate-type.index', 'cate-type.edit', 'cate-type.create', 'cate.index', 'cate.edit', 'cate.create', 'cate-parent.index', 'cate-parent.edit', 'cate-parent.create']) ? 'active' : '' }}">
        <a href="#">
          <i class="fa fa-opencart"></i> 
          <span>Sản phẩm</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li {{ in_array(\Request::route()->getName(), ['product.index', 'product.edit']) ? "class=active" : "" }}><a href="{{ route('product.index') }}"><i class="fa fa-circle-o"></i> Danh sách</a></li>
          <li {{ \Request::route()->getName() == "product.create" ? "class=active" : "" }}><a href="{{ route('product.create') }}"><i class="fa fa-circle-o"></i> Thêm sản phẩm</a></li>        
               
          <li {{ in_array(\Request::route()->getName(), ['cate-parent.index', 'cate-parent.edit', 'cate-parent.create']) ? "class=active" : "" }}><a href="{{ route('cate-parent.index') }}"><i class="fa fa-circle-o"></i> Danh mục cha</a></li>
          <li {{ in_array(\Request::route()->getName(), ['cate.index', 'cate.edit', 'cate.create']) ? "class=active" : "" }}><a href="{{ route('cate.index') }}"><i class="fa fa-circle-o"></i> Danh mục con</a></li>
          
        </ul>
      </li>            
      <li {{ in_array(\Request::route()->getName(), ['services.edit', 'services.index', 'services.create']) ? "class=active" : "" }}>
          <a href="{{ route('services.index') }}">
            <i class="fa fa-pencil-square-o"></i> 
            <span>Dịch vụ</span>          
          </a>       
        </li>
      <li class="treeview {{ in_array(\Request::route()->getName(), ['pages.index', 'pages.create']) ? 'active' : '' }}">
        <a href="#">
          <i class="fa fa-twitch"></i> 
          <span>Trang</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li {{ in_array(\Request::route()->getName(), ['pages.index', 'pages.edit']) ? "class=active" : "" }}><a href="{{ route('pages.index') }}"><i class="fa fa-circle-o"></i> Trang</a></li>
          <li {{ in_array(\Request::route()->getName(), ['pages.create']) ? "class=active" : "" }}><a href="{{ route('pages.create') }}"><i class="fa fa-circle-o"></i> Thêm trang</a></li>          
        </ul>
      </li>
      
      <li class="treeview {{ in_array(\Request::route()->getName(), ['articles.index', 'articles.create', 'articles.edit','articles-cate.create', 'articles-cate.index', 'articles-cate.edit']) ? 'active' : '' }}">
        <a href="#">
          <i class="fa fa-pencil-square-o"></i> 
          <span>Tin tức</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li {{ in_array(\Request::route()->getName(), ['articles.edit', 'articles.index']) ? "class=active" : "" }}><a href="{{ route('articles.index') }}"><i class="fa fa-circle-o"></i> Tin tức</a></li>
          <li {{ in_array(\Request::route()->getName(), ['articles.create']) ? "class=active" : "" }} ><a href="{{ route('articles.create', ['cate_id' => 1]) }}"><i class="fa fa-circle-o"></i> Thêm tin tức</a></li>
          @if(Auth::user()->role == 3)
        <li {{ in_array(\Request::route()->getName(), ['articles-cate.create', 'articles-cate.index', 'articles-cate.edit']) ? "class=active" : "" }} ><a href="{{ route('articles-cate.index') }}"><i class="fa fa-circle-o"></i> Danh mục tin tức</a></li>      
        @endif    
        </ul>
       
      </li> 
        <li {{ in_array(\Request::route()->getName(), ['tag.edit', 'tag.index']) ? "class=active" : "" }}>
          <a href="{{ route('tag.index') }}">
            <i class="fa fa-pencil-square-o"></i> 
            <span>Tags</span>          
          </a>       
        </li>
      @if(Auth::user()->role > 1)
        <li {{ in_array(\Request::route()->getName(), ['hot-cate.edit', 'hot-cate.index']) ? "class=active" : "" }}>
          <a href="{{ route('hot-cate.index') }}">
            <i class="fa fa-pencil-square-o"></i> 
            <span>Danh mục trang chủ</span>          
          </a>       
        </li>
        <li {{ in_array(\Request::route()->getName(), ['bao-gia.edit', 'bao-gia.index']) ? "class=active" : "" }}>
          <a href="{{ route('bao-gia.index') }}">
            <i class="fa fa-pencil-square-o"></i> 
            <span>Yêu cầu báo giá</span>          
          </a>       
        </li>
      
      <li {{ in_array(\Request::route()->getName(), ['newsletter.edit', 'newsletter.index']) ? "class=active" : "" }}>
        <a href="{{ route('newsletter.index') }}">
          <i class="fa fa-pencil-square-o"></i> 
          <span>Newsletter</span>         
        </a>       
      </li>

      <li {{ in_array(\Request::route()->getName(), ['contact.edit', 'contact.index']) ? "class=active" : "" }}>
        <a href="{{ route('contact.index') }}">
          <i class="fa fa-pencil-square-o"></i> 
          <span>Liên hệ</span>          
        </a>       
      </li>
      @endif    
      <li {{ in_array(\Request::route()->getName(), ['banner.list', 'banner.edit', 'banner.create']) ? "class=active" : "" }}>
        <a href="{{ route('banner.list') }}">
          <i class="fa fa-file-image-o"></i> 
          <span>Banner</span>          
        </a>       
      </li> 
      @if(Auth::user()->role > 1)
      <li class="treeview {{ in_array(\Request::route()->getName(), ['thong-so.index', 'thong-so.create', 'thong-so.edit']) ? 'active' : '' }}">
        <a href="#">
          <i class="fa fa-twitch"></i> 
          <span>Thông số sản phẩm</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li {{ in_array(\Request::route()->getName(), ['thong-so.index', 'thong-so.edit']) ? "class=active" : "" }}><a href="{{ route('thong-so.index') }}"><i class="fa fa-circle-o"></i> Thông số sản phẩm</a></li>
          <li {{ in_array(\Request::route()->getName(), ['thong-so.create']) ? "class=active" : "" }}><a href="{{ route('thong-so.create') }}"><i class="fa fa-circle-o"></i> Thêm thông số</a></li>          
        </ul>
      </li>
      @endif
      @if(Auth::user()->role == 3)
      <li class="treeview {{ in_array(\Request::route()->getName(), ['menu.index', 'account.index', 'info-seo.index', 'settings.index', 'settings.noti', 'menu.index', 'video.index', 'video.edit', 'video.create']) || (in_array(\Request::route()->getName(), ['custom-link.edit', 'custom-link.index', 'custom-link.create']) && isset($block_id) && $block_id == 2 ) || (in_array(\Request::route()->getName(), ['custom-link.edit', 'custom-link.index', 'custom-link.create']) && isset($block_id) && $block_id == 1 ) ? 'active' : '' }}">
        <a href="#">
          <i class="fa  fa-gears"></i>
          <span>Cài đặt</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          @if(Auth::user()->role == 3)
        
          <li {{ \Request::route()->getName() == "settings.index" ? "class=active" : "" }}><a href="{{ route('settings.index') }}"><i class="fa fa-circle-o"></i> Thông tin houseland</a></li>
          <li><a target="_blank" href="{{ route('rss') }}"><i class="fa fa-circle-o"></i> RSS</a></li>
          <li {{ (in_array(\Request::route()->getName(), ['custom-link.edit', 'custom-link.index', 'custom-link.create']) && isset($block_id) && $block_id == 1 )? "class=active" : "" }}>
            <a href="{{ route('custom-link.index', ['block_id' => 1 ]) }}">
              <i class="fa fa-circle-o"></i>
              <span>Link Footer trái</span>         
            </a>       
          </li>
          <li {{ (in_array(\Request::route()->getName(), ['custom-link.edit', 'custom-link.index', 'custom-link.create']) && isset($block_id) && $block_id == 2 )? "class=active" : "" }}>
            <a href="{{ route('custom-link.index', ['block_id' => 2 ]) }}">
              <i class="fa fa-circle-o"></i>
              <span>Link Footer giữa</span>         
            </a>       
          </li>
          <li {{ \Request::route()->getName() == "menu.index" ? "class=active" : "" }}><a href="{{ route('menu.index') }}"><i class="fa fa-circle-o"></i> Menu</a></li>
          <li {{ in_array(\Request::route()->getName(), ['member.list', 'member.edit', 'member.create']) ? "class=active" : "" }}><a href="{{ route('member.index') }}"><i class="fa fa-circle-o"></i> Ban lãnh đạo</a></li>
          @endif
          <li {{ \Request::route()->getName() == "account.index" ? "class=active" : "" }}><a href="{{ route('account.index') }}"><i class="fa fa-circle-o"></i> Users</a></li>              
        </ul>
      </li>
      @endif
      <!--<li class="header">LABELS</li>
      <li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Important</span></a></li>
      <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>Warning</span></a></li>
      <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Information</span></a></li>-->
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>
<style type="text/css">
  .skin-blue .sidebar-menu>li>.treeview-menu{
    padding-left: 15px !important;
  }
</style>