<?php
if(isset($upload_data)){
	?>
<div class="panel panel-default">
  <div class="panel-heading">Upload thành công</div>
  <div class="panel-body">
    <?php
	echo "<img src='".base_url()."uploads/".$upload_data["file_name"]."' style='width:50%;padding:10px;'>";
		?>
  </div>
</div>
<p> <h3>Danh sách hình</h3> </p>
<?php	
	
}
if(isset($error_data)){
	echo '
<div class="alert alert-warning alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>Warning!</strong> Gặp lỗi
</div>';	
}
$arr_img=$this->db->get("kkat")->result();
?>
<div class="row">
		<?php 
		$i=1;
		foreach ($arr_img as $key=>$value){
			?>
			<div class="col-md-3 col-sm-3 col-xs-3">
					<div class='outsideimg'>
							<a rel="example_group" class="fancybox-1" href="<?php echo base_url() ?>uploads/<?php	echo $value->image;?>">
									<img src="<?php echo base_url() ?>uploads/<?php	echo $value->image_thumb;?>" style="width:100%">
							</a>
					</div>
			</div>		
			<?php
			if($i%4==0){
				echo "</div><div class='row'>";
			}
			$i++;
		} ?>

</div>