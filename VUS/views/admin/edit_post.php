<?php
$array_option_img=array("default_img_php","default_img_normal");
?>
<form action="<?php echo base_url(); ?>admin/do_save" method="post">
		<input type="hidden" name="type_save" value="update" >
		<input type="hidden" name="id" value="<?php echo $detail[0]->id; ?>" >
	<p>Title: <input type="text" name="title" class="form-control" value="<?php echo $detail[0]->title; ?>"/></p>
	<p>Image: <select name="image" class="form-control">
					<?php foreach ($array_option_img as $key => $value) {?>
						<option value="<?php echo $value; ?>.jpg" <?php echo ($detail[0]->local_img==$value.".jpg"?"selected":""); ?>><?php echo $value; ?></option>
					<?php } ?>
			</select>
	</p>
	
<a href="<?php echo base_url(); ?>Admin/active_post/<?php echo $detail[0]->id; ?>">
						<button class="btn btn-<?php echo ($detail[0]->active==1?"success":"danger") ?> btn-xs" data-title="Active"  >
								<span class="glyphicon glyphicon-check"></span></button>
						</a>	
	<p>Nhóm: <select name="cid" class="form-control">
					<?php
					$rs=$this->db->get("baiviet_nhom")->result();
					foreach ($rs as $key => $value) {
						echo '<option value="'.$value->cid.'" '.($value->cid==$detail[0]->cid?"selected":"").' > '.$value->title.'</option>';
					}
					
					?>
					
			</select></p>
	<textarea name="hometext" class="input_text_vihan" style="width:100%; height:100px;"><?php echo str_replace("&gt;","&amp;gt;",str_replace("&lt;", "&amp;lt;", $detail[0]->content)); ?></textarea>
	<button class="btn bnt-primary" type="submit">Save post</button>
</form>