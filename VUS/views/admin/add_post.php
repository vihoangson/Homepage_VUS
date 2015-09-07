<?php
$array_option_img=array("default_img_php","default_img_normal");
?>
<form action="<?php echo base_url(); ?>admin/do_save" method="post">
	<p>Title: <input type="text" name="title" class="form-control"/></p>
	<p>Image: <select name="image" class="form-control">
					<?php foreach ($array_option_img as $key => $value) {?>
						<option value="<?php echo $value; ?>.jpg"><?php echo $value; ?></option>
					<?php } ?>
			</select>
	</p>
	<p>Nhóm: <select name="cid" class="form-control">
					<?php
					$rs=$this->db->get("baiviet_nhom")->result();
					foreach ($rs as $key => $value) {
						echo '<option value="'.$value->cid.'"> '.$value->title.'</option>';
					}
					?>
			</select></p>
	<textarea name="hometext" class="input_text_vihan" style="width:100%; height:100px;"></textarea>
	<button class="btn bnt-primary" type="submit">Save post</button>
</form>