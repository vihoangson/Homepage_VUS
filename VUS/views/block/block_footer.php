<?php
$data_new_a["data_new"]=$data_new;
$data_hot_a["data_hot"]=$data_hot;
?>
<div class="row">
		<div class="col-md-6" style="padding-right:57px;">
				<?php $this->load->view("block/new_news",$data_new_a); ?>
		</div>
		<div class="col-md-6">
				<?php $this->load->view("block/hot_news",$data_hot_a); ?>			
		</div>	
</div>