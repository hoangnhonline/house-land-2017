<!DOCTYPE html>
<!--[if lt IE 7 ]><html dir="ltr" lang="vi-VN" class="no-js ie ie6 lte7 lte8 lte9"><![endif]-->
<!--[if IE 7 ]><html dir="ltr" lang="vi-VN" class="no-js ie ie7 lte7 lte8 lte9"><![endif]-->
<!--[if IE 8 ]><html dir="ltr" lang="vi-VN" class="no-js ie ie8 lte8 lte9"><![endif]-->
<!--[if IE 9 ]><html dir="ltr" lang="vi-VN" class="no-js ie ie9 lte9"><![endif]-->
<!--[if IE 10 ]><html dir="ltr" lang="vi-VN" class="no-js ie ie10 lte10"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html lang="vn">
<head>
	<title>@yield('title')</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta http-equiv="content-language" content="vi"/>
    <meta name="description" content="@yield('site_description')"/>
    <meta name="keywords" content="@yield('site_keywords')"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1"/>
    <meta name="google-site-verification" content="IFz-d9V8jZLB1iDG8BfKsKwhPB-FkpsacHLqk5Mpyzk" />
    <meta name="wot-verification" content="b5ae556432dab929c4bb"/>
    <meta property="article:author" content="https://www.facebook.com/HOUSELAND"/>
    <link rel="shortcut icon" href="@yield('favicon')" type="image/x-icon"/>
    <link rel="canonical" href="{{ url()->current() }}"/>        
    <meta property="og:locale" content="vi_VN" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="@yield('title')" />
    <meta property="og:description" content="@yield('site_description')" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:site_name" content="HOUSELAND.vn" />
    <?php $socialImage = isset($socialImage) ? $socialImage : $settingArr['banner']; ?>
    <meta property="og:image" content="{{ Helper::showImage($socialImage) }}" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:description" content="@yield('site_description')" />
    <meta name="twitter:title" content="@yield('title')" />     
    <meta name="twitter:image" content="{{ Helper::showImage($socialImage) }}" />
	<link rel="icon" href="{{ URL::asset('assets/images/favicon.ico') }}" type="image/x-icon">
	<!-- ===== Style CSS ===== -->
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('public/assets/css/style.css') }}">
	<!-- ===== Style Color CSS ===== -->
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('public/assets/css/style_color.css') }}">
	<!-- ===== Responsive CSS ===== -->
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('public/assets/css/responsive.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('public/assets/css/sweetalert2.min.css') }}"/>
  	<!-- HTML5 Shim and Respond.js" IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js" doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<link href='css/animations-ie-fix.css' rel='stylesheet'>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js""></script>
		<script src="https://oss.maxcdn.com/libs/respond.js') }}"/1.4.2/respond.min.js""></script>
	<![endif]-->
</head>
<body style="background-color: #fff;">

	@include('frontend.partials.header')

	<div class="wrapper">	
		@yield('slider')

		@yield('content')
	</div><!-- /wrapper-->

	@include('frontend.partials.footer')

	<!-- ===== JS ===== -->
	<script src="{{ URL::asset('public/assets/js/jquery.min.js') }}""></script>
	<!-- ===== JS Bootstrap ===== -->
	<script src="{{ URL::asset('public/assets/lib/bootstrap/bootstrap.min.js') }}""></script>
	<!-- carousel -->
	<script src="{{ URL::asset('public/assets/lib/carousel/owl.carousel.min.js') }}""></script>
	<!-- sticky -->
    <script src="{{ URL::asset('public/assets/lib/sticky/jquery.sticky.js') }}""></script>
    <!-- countUp -->    
	<script src="{{ URL::asset('public/assets/lib/countUp/countUp.js') }}""></script>
    <!-- Js Common -->
	<script src="{{ URL::asset('public/assets/js/common.js') }}""></script>
	<script src="{{ URL::asset('public/assets/js/sweetalert2.min.js') }}"></script>
	<script src="{{ URL::asset('public/assets/js/lazy.js') }}"></script>
    <input type="hidden" id="route-newsletter" value="{{ route('register.newsletter') }}">
	@yield('js')
	
	<script type="text/javascript">
	$(document).ready(function() {
	    $.ajaxSetup({
	        headers: {
	            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        }
	    });
	    
	    $('img.lazy').lazyload();
	});

	$(document).on('keypress', '.txtSearch', function(e) {
		    var obj = $(this);
		    if (e.which == 13) {
		        if ($.trim(obj.val()) == '') {
		            return false;
		        }
		    }
		});
		$(document).on('keypress', '#txtNewsletter', function(e){
		if(e.keyCode==13){
		    $('#btnNewsletter').click();
		}
	});
	$('#btnNewsletter').click(function() {
	    var email = $.trim($('#txtNewsletter').val());        
	    if(validateEmail(email)) {
	        $.ajax({
	          url: $('#route-newsletter').val(),
	          method: "POST",
	          data : {
	            email: email,
	          },
	          success : function(data){
	            if(+data){
	              swal('', 'Đăng ký nhận bản tin thành công.', 'success');
	            }
	            else {
	              swal('', 'Địa chỉ email đã được đăng ký trước đó.', 'error');
	            }
	            $('#txtNewsletter').val("");
	          }
	        });
	    } else {
	        swal({ title: '', text: 'Vui lòng nhập địa chỉ email hợp lệ.', type: 'error' });
	    }
	});
	function validateEmail(email) {
		var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
		return re.test(email);
	}
	</script>
</body>
</html>