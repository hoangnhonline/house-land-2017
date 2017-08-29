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
					                <select id="cid" class="cid choice" name="cid">
									    <option value="" >Tìm theo danh mục</option>
									   	@foreach($cateTypeList as $value)
									   	<option value="{{ $value->id }}" {{ isset($type_id) && $type_id == $value->id ? "selected" : "" }}>{!! $value->name !!}</option>>
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
						<img src="{{ Helper::showImage($settingArr['logo']) }}" alt="Logo Houseland">
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
		<nav class="menu-top">
			<div class="container">
				<ul class="nav-menu">
					<li class="level0 active"><a href="{{ route('home') }}" title="Trang Chủ">Trang Chủ</a></li>
					<li class="level0"><a href="{{ route('pages', 'gioi-thieu') }}" title="Giới Thiệu">Giới Thiệu</a></li>
					@foreach($cateTypeList as $type)
					<?php 
					$parentList = DB::table('cate_parent')->where('type_id', $type->id)->orderBy('display_order')->get();

					?>
					<li class="level0 @if($parentList) parent @endif">
						<a href="{{ route('cate-type', $type->slug) }}" title="{!! $type->name !!}">{!! $type->name !!}</a>
						
						@if($parentList)
						
						<ul class="level0 submenu">			
							@foreach($parentList as $parent)
							<?php 
							$cateList = DB::table('cate')->where('parent_id', $parent->id)->orderBy('display_order')->get();

							?>
							<li class="level1 @if($cateList) parent @endif">
								<a href="{{ route('cate-parent', [$type->slug, $parent->slug]) }}" title="{!! $parent->name !!}">{!! $parent->name !!}</a>
								
								@if($cateList)
								<ul class="level1 submenu">
									@foreach($cateList as $cate)
									<li class="level2"><a href="{{ route('cate', [$type->slug, $parent->slug, $cate->slug]) }}" title="{!! $cate->name !!}">{!! $cate->name !!}</a></li>
									@endforeach
								</ul>
								@endif
							</li>
							@endforeach
						</ul>
						
						@endif
					</li>
					@endforeach					
					<li class="level0"><a href="{{ route('services') }}" title="Dịch Vụ">Dịch Vụ</a></li>
					<li class="level0 parent"><a href="javascript:void(0)" title="Tin Tức">Tin Tức</a>
						<ul class="level0 submenu">			
						<?php 
						$articleCateList = DB::table('articles_cate')->where('type', 1)->orderBy('display_order')->get();
						?>
						@foreach($articleCateList as $type)
						
						<li class="level0">
							<a href="{{ route('news-list', $type->slug) }}" title="{!! $type->name !!}">{!! $type->name !!}</a>
						</li>
						@endforeach	
						</ul>
					</li>
					<li class="level0"><a href="{{ route('contact') }}" title="Liên Hệ">Liên Hệ</a></li>
					<li class="search-mb">
						<div class="block-search">
							<div class="block-search-inner clearfix">
								<form class="form-inline" action="{{ route('search') }}" method="GET">
						            <div class="form-group input-serach">
										<input type="text" class="txtSearch" value="{!! isset($tu_khoa) ? $tu_khoa : "" !!}" name="keyword"  placeholder="Từ khóa bạn cần tìm...">
						            </div><!-- /input-serach -->
						            <div class="form-group select-choice">
						            	<div class="form-group form-category">
							              <select id="cid" class="cid choice" name="cid">
										    <option value="" >Tìm theo danh mục</option>
										   	@foreach($cateTypeList as $value)
										   	<option value="{{ $value->id }}" {{ isset($type_id) && $type_id == $value->id ? "selected" : "" }}>{!! $value->name !!}</option>>
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