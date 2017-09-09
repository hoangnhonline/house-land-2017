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
									   	@foreach($cateParentList as $value)
									   	<option value="{{ $value->id }}" {{ isset($parent_id) && $parent_id == $value->id ? "selected" : "" }}>{!! $value->name !!}</option>>
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
					<?php 
					$menuLists = DB::table('menu')->where('parent_id', 0)->orderBy('display_order')->get();
					?>
					@foreach($menuLists as $menu)

					<?php
                  	$menuCap1List = DB::table('menu')->where('parent_id', $menu->id)->orderBy('display_order')->get();
                  	?>
                                      
					<li class="level0 @if($menuCap1List)  parent @endif "><a href="{{ $menu->url }}" title="{{ $menu->title }}">{{ $menu->title }}</a>

						@if($menuCap1List)
						
						<ul class="level0 submenu">			
							@foreach($menuCap1List as $cap1)
							<?php 
							$menuCap2List = DB::table('menu')->where('parent_id', $cap1->id)->orderBy('display_order')->get(); 

							?>
							<li class="level1 @if($menuCap2List) parent @endif">
								<a href="{{ $cap1->url }}" title="{!! $cap1->title !!}">{!! $cap1->title !!}</a>
								
								@if($menuCap2List)
								<ul class="level1 submenu">
									@foreach($menuCap2List as $cap2)
									<li class="level2"><a href="{{ $cap2->url }}" title="{!! $cap2->title !!}">{!! $cap2->title !!}</a></li>
									@endforeach
								</ul>
								@endif
							</li>
							@endforeach
						</ul>
						
						@endif
					</li>					

					@endforeach
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
										   	@foreach($cateParentList as $value)
										   	<option value="{{ $value->id }}" {{ isset($parent_id) && $parent_id == $value->id ? "selected" : "" }}>{!! $value->name !!}</option>>
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