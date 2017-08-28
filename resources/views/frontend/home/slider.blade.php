@section('slider')
<div class="block block-side">
	<div class="owl-carousel owl-style2" data-nav="false" data-margin="0" data-items='1' data-autoplayTimeout="1000" data-autoplay="true" data-loop="true" data-navcontainer="true">
		<div class="item-slide">
			<img src="{{ URL::asset('public/assets/images/slide/1.jpg') }}" alt="slide1">
		</div><!-- item-slide -->
		<div class="item-slide">
			<img src="{{ URL::asset('public/assets/images/slide/2.jpg') }}" alt="slide2">
		</div><!-- item-slide -->
	</div>
</div><!-- /block-side -->
@stop