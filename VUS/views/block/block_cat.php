<?php 
foreach ($content_block as $row) {
	$data["data_ele"]=$row;
	$this->load->view('block/block_cat_ele', $data);
}
echo "<div class='pagination_box'>".$pagination."</div>";


 ?>
