<?php 
$rs = DB::table('rating')->where(['object_id' => $object_id, 'object_type' => $object_type])->get();
$totalRating = 0;
$total = 0;
foreach($rs as $rating){
	$totalRating += $rating->amount;
	$total += $rating->amount * $rating->score;
}
$star = ceil($total/$totalRating);
?>
<div class="rating-title">Đánh giá bài viết:</div>
<div class="rating-summary">
    <input id="kartik" class="rating" data-stars="5" data-step="1" data-size="xs" title="" value="{{ $star }}" />
</div>
<div class="rating-action dot">
		<span>Xếp hạng {{ $star }} - {{ $totalRating }} phiếu bầu</span>
</div>