<header class="header">
	<div class="block-header-top">
		<div class="container">
			<div class="row">
				<div class="col-sm-6 col-xs-12 block-intro">
					<p>Chào mừng bạn đến với bất động sản Houseland!</p>
				</div><!-- /block-intro -->
				<div class="col-sm-6 col-xs-12 block-search">
					<div class="block-search-inner clearfix">
						<form class=""  action="{{ route('search') }}" method="GET">
				            <div class="input-serach">
								<input type="text" class="txtSearch" value="{!! isset($tu_khoa) ? $tu_khoa : "" !!}" name="keyword" placeholder="Từ khóa bạn cần tìm...">
				            </div><!-- /input-serach -->
				            <div class="select-choice">
				            	<div class="form-category">
					                <select id="cid" class="cid" name="cid">
									    <option value="" >Tìm theo danh mục</option>
									   	@foreach($cateTypeList as $value)
									   	<option value="{{ $value->id }}">{!! $value->name !!}</option>>
									   	@endforeach
									</select>
					            </div><!-- /form-category -->
				            	<button type="submit" class="btn-search"><i class="fa fa-search"></i></button>
				            </div><!-- /select-choice -->
			            </form>
					</div>
				</div><!-- /block-search -->
			</div>
		</div>
	</div><!-- /block-header-top -->
	<div class="block-header-bottom">
		<div class="container">
			<div class="row">
				<div class="col-sm-6 col-xs-12 block-logo">
					<a href="{{ route('home') }}" title="Logo">
						<img src="{{ URL::asset('public/assets/images/logo.png') }}" alt="Logo Housland">
					</a>
				</div><!-- /block-logo -->
				<div class="col-sm-6 col-xs-12 block-info">
					<div class="hotline">
						<i class="fa fa-phone"></i>
						<p>
							<span class="title">Hotline</span>
							<span class="info">{!! $settingArr['hotline'] !!}</span>
						</p>
					</div>
					<div class="email">
						<i class="fa fa-envelope-o"></i>
						<p>
							<span class="title">Email</span>
							<span class="info">{!! $settingArr['email_header'] !!}</span>
						</p>
					</div>
				</div><!-- /bblock-info -->
			</div>
		</div>
	</div><!-- /block-header-bottom -->
	<div class="menu">
		<div class="nav-toogle">
			<i class="fa"></i>
		</div>
		<div class="btn-search-mb">
			<i class="fa"></i>
		</div>
		<nav class="menu-top">
			<div class="container">
				<ul class="nav-menu">
					<li class="level0 active"><a href="{{ route('home') }}" title="Trang Chủ">Trang Chủ</a></li>
					<li class="level0"><a href="gioi-thieu.html" title="Giới Thiệu">Giới Thiệu</a></li>
					<li class="level0 parent">
						<a href="pro-cate.html" title="Thiết Kế">Thiết Kế</a>
						<ul class="level0 submenu">
							<li class="level1"><a href="pro-child-cate.html" title="">Thiết kế biệt thự cổ điển</a></li>
							<li class="level1"><a href="pro-child-cate.html" title="">Thiết kế biệt thự hiện đại</a></li>
							<li class="level1 parent">
								<a href="pro-child-cate.html" title="">Thiết kế biệt thự phố</a>
								<ul class="level1 submenu">
									<li class="level2"><a href="pro-child-cate.html" title="">Mẫu thiết kế biệt thự phố hiện đại</a></li>
									<li class="level2"><a href="pro-child-cate.html" title="">Mẫu thiết kế biệt thự phố cổ điển</a></li>
									<li class="level2"><a href="pro-child-cate.html" title="">Mẫu thiết kế biệt thự phố 1 mặt tiền</a></li>
									<li class="level2"><a href="pro-child-cate.html" title="">Mẫu thiết kế biệt thự phố 2 mặt tiền</a></li>
								</ul>
							</li>
							<li class="level1"><a href="pro-child-cate.html" title="">Thiết kế biệt thự vườn</a></li>
							<li class="level1"><a href="pro-child-cate.html" title="">Thiết kế nhà phố</a></li>
							<li class="level1"><a href="pro-child-cate.html" title="">Thiết kế nhà hàng - khách sạn</a></li>
							<li class="level1"><a href="pro-child-cate.html" title="">Thiết kế resort - khu nghỉ dưỡng</a></li>
							<li class="level1"><a href="pro-child-cate.html" title="">Thiết kế chung cư mini</a></li>
							<li class="level1"><a href="pro-child-cate.html" title="">Thiết kế cao ốc - văn phòng</a></li>
							<li class="level1"><a href="pro-child-cate.html" title="">Thiết kế showroom</a></li>
							<li class="level1"><a href="pro-child-cate.html" title="">Thiết kế cafe - du lịch - homestay</a></li>
						</ul>
					</li>
					<li class="level0"><a href="pro-cate.html" title="Thi Công">Thi Công</a></li>
					<li class="level0"><a href="pro-cate.html" title="Nội Thất">Nội Thất</a></li>
					<li class="level0"><a href="pro-cate.html" title="Nhà Mẫu">Nhà Mẫu</a></li>
					<li class="level0"><a href="service.html" title="Dịch Vụ">Dịch Vụ</a></li>
					<li class="level0"><a href="news.html" title="Tin Tức">Tin Tức</a></li>
					<li class="level0"><a href="lien-he.html" title="Liên Hệ">Liên Hệ</a></li>
					<li class="search-mb">
						<div class="block-search">
							<div class="block-search-inner clearfix">
								<form class="form-inline" action="{{ route('search') }}" method="GET">
						            <div class="form-group input-serach">
										<input type="text" class="txtSearch" value="{!! isset($tu_khoa) ? $tu_khoa : "" !!}" name="keyword"  placeholder="Từ khóa bạn cần tìm...">
						            </div><!-- /input-serach -->
						            <div class="form-group select-choice">
						            	<div class="form-group form-category">
							              <select id="cid" class="cid" name="cid">
										    <option value="" >Tìm theo danh mục</option>
										   	@foreach($cateTypeList as $value)
										   	<option value="{{ $value->id }}">{!! $value->name !!}</option>>
										   	@endforeach
										</select>
							            </div><!-- /form-category -->
						            	<button type="submit" class="btn-search"><i class="fa fa-search"></i></button>
						            </div><!-- /select-choice -->
					            </form>
							</div>
						</div><!-- /block-search -->
					</li>
				</ul>
			</div>
		</nav><!-- /menu-top -->
	</div><!-- /menu -->
	</header><!-- /header -->