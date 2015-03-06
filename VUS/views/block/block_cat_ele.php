<?php $row=$data_ele; ?>
<h2>
	<a href="<?php echo base_url("block/detail/".$row->align_title."") ?>"><?php echo $row->title; ?></a>
</h2>
<?php
if($this->session->user=="son"){
	?>
	<p><a href="<?php echo base_url(); ?>Admin/edit_post/<?php echo $row->id; ?>">Edit</a></p>
	<?php	
}
?>
<p class="lead">
	by <a href="<?php echo base_url(); ?>Aboutme">ViHoangSon</a>
</p>
<p><i class="fa fa-clock-o"></i> Posted on <?php echo date('d/m/Y',$row->time_create); ?> at <?php echo date('H:N',$row->time_create); ?></p>
<a href="blog-post.html">
		<?php
		if($row->local_img && $this->config->item("show_img_cat")){
			if(file_exists("./uploads/baiviet/thumb/small_120x120_".$row->local_img)){
				?>
				<div style="background:url('<?php echo base_url(); ?>uploads/baiviet/thumb/small_120x120_<?php echo ($row->local_img); ?>') no-repeat center center" class="thumb_content"></div>
				<?php				
			}else{
				if($row->local_img=="default_img_php.jpg") $row->image=base_url()."uploads/baiviet/default_img/".$row->local_img."";
				if($row->local_img=="default_img_normal.jpg") $row->image=base_url()."uploads/baiviet/default_img/".$row->local_img."";
				?>
				<div style="background:url('<?php echo ($row->image); ?>') no-repeat center center" class="thumb_content"></div>
				<?php								
				
			}

		}
		?>
</a>
<p><?php echo word_limiter($row->readmore,50); ?></p>
<a class="btn btn-primary" href="<?php echo base_url("block/detail/".$row->align_title."") ?>">Read More <i class="fa fa-angle-right"></i></a>
<hr>
