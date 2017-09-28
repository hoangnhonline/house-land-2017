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
	<link rel="icon" href="{{ URL::asset('public/assets/favicon.ico') }}" type="image/x-icon">
	<!-- ===== Style CSS ===== -->
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('public/assets/css/style.css') }}">
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
	<div id="fb-root"></div>
	<script>(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) return;
	  js = d.createElement(s); js.id = id;
	  js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.10&appId=567408173358902";
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>
	<script>window.twttr = (function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0],
    t = window.twttr || {};
  if (d.getElementById(id)) return t;
  js = d.createElement(s);
  js.id = id;
  js.src = "https://platform.twitter.com/widgets.js";
  fjs.parentNode.insertBefore(js, fjs);

  t._e = [];
  t.ready = function(f) {
    t._e.push(f);
  };

  return t;
}(document, "script", "twitter-wjs"));</script>


	@include('frontend.partials.header')

	<div class="wrapper">	
		@yield('slider')

		@yield('content')
	</div><!-- /wrapper-->

	@include('frontend.partials.footer')
	<div id="editContentModal" class="modal fade" role="dialog">
	  <div class="modal-dialog">

	    <!-- Modal content-->
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title">Cập nhật nội dung</h4>
	      </div>
	      <form method="POST" action="{{ route('save-content') }}">
	      {{ csrf_field() }}
	      <input type="hidden" name="id" id="txtId" value="">
	      <div class="modal-body">
	        <textarea rows="5" class="form-control" name="content" id="txtContent"></textarea>
	      </div>
	      <div class="modal-footer">
	      	<button type="button" class="btn btn-primary" id="btnSaveContent">Save</button>
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	      </div>
	      </form>
	    </div>

	  </div>
	</div>
	<!-- ===== JS ===== -->
	<script src="{{ URL::asset('public/assets/js/jquery.min.js') }}""></script>
	<!-- ===== JS Bootstrap ===== -->
	<script src="{{ URL::asset('public/assets/lib/bootstrap/bootstrap.min.js') }}""></script>
	<!-- carousel -->
	<script src="{{ URL::asset('public/assets/lib/carousel/owl.carousel.min.js') }}""></script>
	<!-- sticky -->
    <script src="{{ URL::asset('public/assets/lib/sticky/jquery.sticky.js') }}""></script>
    <!-- countUp -->    	
    <script src="//cdnjs.cloudflare.com/ajax/libs/waypoints/2.0.3/waypoints.min.js"></script>
	<script src="{{ URL::asset('public/assets/lib/counterUp/jquery.counterup.min.js') }}"></script>
    <!-- Js Common -->
	<script src="{{ URL::asset('public/assets/js/common.js') }}""></script>
	<script src="{{ URL::asset('public/assets/js/sweetalert2.min.js') }}"></script>
	<script src="{{ URL::asset('public/assets/js/lazy.js') }}"></script>
    <input type="hidden" id="route-newsletter" value="{{ route('register.newsletter') }}">
	
	{!! $settingArr['google_analystic'] !!}
	<script type="text/javascript">
	@if(\Request::route()->getName() == "home")
	var eventFired = false,
	    objectPositionTop = $('.block-number').offset().top;

	$(window).on('scroll', function() {

	 var currentPosition = $(document).scrollTop();
	 if (currentPosition > objectPositionTop && eventFired === false) {
	   eventFired = true;
	   $('.counter').counterUp({
	            delay: 10,
	            time: 1000
	        });
	 }

	});
	@endif
	$(document).ready(function() {
		jQuery('.fb-page1').toggleClass('hide');
			jQuery('#closefbchat').html('<i class="fa fa-comments fa-2x"></i> Chat Tư Vấn').css({'bottom':0});
		jQuery('#closefbchat').click(function(){
			jQuery('.fb-page1').toggleClass('hide');
			if(jQuery('.fb-page1').hasClass('hide')){
				jQuery('#closefbchat').html('<i class="fa fa-comments fa-2x"></i> Chat Tư Vấn').css({'bottom':0});
			}
			else{
				jQuery('#closefbchat').text('Tắt Chat').css({'bottom':299});
			}
		});
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
	@include('frontend.partials.custom-css')
	@yield('js')
	<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-59b215c2a2658a8a"></script> 	
	<script src="https://apis.google.com/js/platform.js" async defer></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$.ajaxSetup({
			      headers: {
			          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			      }
			  });

			$('.edit').click(function(){
				$('#txtId').val($(this).data('text'));
				$('#txtContent').val($(this).html());
				$('#editContentModal').modal('show');
			});
			$('#btnSaveContent').click(function(){
				$.ajax({
					url : '{{ route('save-content') }}',
					type : "POST",
					data : {
						id : $('#txtId').val(),
						content : $('#txtContent').val()
					},
					success:  function(){
						window.location.reload();
					}

				});
			});
		});
	</script>
<style type="text/css">
	.edit {  
	position: relative;
	border: 1px dashed transparent;
	min-height: 20px;
	}
	.edit:hover {
	border: 1px dashed #c70f19;\
	}
	.edit:hover:before {
	content: "\f040";
	font-family: "FontAwesome";
	font-size: 13px;
	color: #ffffff;
	width: 20px;
	height: 20px;
	display: block;
	background: #c70f19;
	position: absolute;
	top: 0;
	right: 0;
	cursor: pointer;
	}
</style>
@if(!in_array($routeName, ['news-detail', 'product']))
<div class="reviews-summary" id="rating-summary" itemscope="" itemtype="http://schema.org/Review" style="display:none">
   <div class="rating-title" itemprop="name">Đánh giá :</div>  
   <div class="rating-action dot" itemprop="reviewRating" itemscope="" itemtype="http://schema.org/Rating">
      <span>Xếp hạng <span itemprop="ratingValue">5</span> - 180 phiếu bầu</span>
   </div>
</div>
@endif
</body>
</html>