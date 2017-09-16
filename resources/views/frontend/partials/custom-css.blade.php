<style>
.menu-top {
    background: {{ $settingArr['mau_nen_menu'] }};
}
.btn-search{
	background: {{ $settingArr['mau_nen_search'] }};
}
.block-search .block-search-inner{
	border: 1px solid {{ $settingArr['mau_nen_search'] }};
}
footer .footer-top {   
    background: {{ $settingArr['mau_nen_footer'] }};
}
.resgis-form .btn-regis:hover, .resgis-form .btn-regis{
	background: {{ $settingArr['mau_nut_dang_ky'] }};	
}
footer .footer-bot{
	background: {{ $settingArr['mau_nen_copyright'] }};
}
.td-scroll-up:hover{
	background: {{ $settingArr['mau_nut_top'] }};
}
.nav-menu li > .submenu > li:hover, .nav-menu li > .submenu .submenu > li:hover{
	background: {{ $settingArr['mau_menu_hover'] }};
}
.block-title-commom .block-title h2:before{
	content: url({{ Helper::showImage($settingArr['icon_tieu_de']) }});
}
.block-header-bottom{
	background-color: {{ $settingArr['mau_nen_header'] }};
}
.block-info .hotline p span.title, .block-info .email p span.title{
	color: {{ $settingArr['mau_header_title'] }};
}
.block-info .hotline p span.info, .block-info .email p span.info{
	color: {{ $settingArr['mau_header_value'] }};	
}
.block-info i{
	color: {{ $settingArr['mau_header_icon'] }};
}
.block-header-top{
	background-color: {{ $settingArr['mau_nen_header_top'] }};
}
.block-intro{
	color: {{ $settingArr['mau_chu_header_top'] }};
}
</style>