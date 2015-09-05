<?php 
$this->db->order_by('RAND()');
$rs = $this->db->get('videos', 1)->row();
	echo
	'<section>
			<iframe class="video_youtube" width="100%" height="415" src="https://www.youtube.com/embed/'.$rs->video_youtube.'" frameborder="0" allowfullscreen></iframe>
			<h2>'.$rs->video_title.'</h2>
	</section>';

 ?>