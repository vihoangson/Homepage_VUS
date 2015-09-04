
<?php
	echo '
	<section>
		<iframe class="video_youtube" width="100%" height="415" src="https://www.youtube.com/embed/'.$rs->video_youtube.'" frameborder="0" allowfullscreen></iframe>
		<h2>'.$rs->video_title.'</h2>
	</section>
	';
?>
<hr>
	<div class="row video_home">
		<?php
			$array_video = $this->db->get('videos',20)->result_array();
			foreach ($array_video as $key => $value) {
				$this->load->view('block/block_ele_video',$value);
			}
		?>
	</div>
<?php
