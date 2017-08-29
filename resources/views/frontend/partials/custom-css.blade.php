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
</style>