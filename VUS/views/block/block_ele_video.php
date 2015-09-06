<div class="ele_video col-xs-6 col-sm-3 col-md-2 col-lg-2 text-center"> 
	<a href="/video/detail/<?php echo $video_id."-".mod_rewrite($video_title); ?>"><img src="http://img.youtube.com/vi/<?php echo $video_youtube; ?>/0.jpg"></a>
	<h3><a href="/video/detail/<?php echo $video_id."-".mod_rewrite($video_title); ?>"><?php echo $video_title; ?></a></h3>
	<span><?php echo $video_views; ?></span>
</div>
