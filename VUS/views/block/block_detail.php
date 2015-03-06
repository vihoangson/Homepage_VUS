<?php 
	echo "<h2>".$block_detail->title."</h2>";
	echo "<div><span class='glyphicon glyphicon-duplicate'></span> Posted on ".date("d/m/Y H:n",$block_detail->time_create)." <small><span class='glyphicon glyphicon-eye-open'></span> View: ".$block_detail->view."</small> </div> <hr>";
	echo "<ul>";
	foreach ($data_list as $key => $value) {
		echo "<li><a href='".base_url()."block/detail/".$value->align_title."'>".$value->title."</a></li>";
	}
	echo "</ul>";
echo $block_detail->content;
echo '';
if($this->session->user=="son"){
?>
<p><a href="<?php echo base_url(); ?>Admin/edit_post/<?php echo $block_detail->id; ?>">Edit</a></p>
<?php
}