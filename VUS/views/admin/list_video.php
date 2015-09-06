<form method="get" id="form_order" action="/Admin/videos">
	<p>Order by</p>
	<!-- $('form').submit(); -->
	<select name="order"  onchange="if($(this).val()!=''){$('#form_order').submit();} ">
		<option value="">==</option>
		<option value="id" <?php echo (isset($_GET["order"]) && $_GET["order"]=="id"?"selected":""); ?> >ID</option>
		<option value="views" <?php echo (isset($_GET["order"]) && $_GET["order"]=="views"?"selected":""); ?> >Views</option>
	</select>
	<select name="order_type"  onchange="$('#form_order').submit(); ">
		<option value="">==</option>
		<option value="asc" <?php echo (isset($_GET["order_type"]) && $_GET["order_type"]=="asc"?"selected":""); ?>>Tăng dần</option>
		<option value="desc" <?php echo (isset($_GET["order_type"]) && $_GET["order_type"]=="desc"?"selected":""); ?>>Giảm dần</option>
	</select>
</form>
<table class="table table-hover">
	<thead>
		<tr>
			<th></th>
		</tr>
	</thead>
	<tbody>
<?php
foreach ($videos as $key => $value) {
?>
		<tr>
			<td><?php echo $value["video_id"]; ?></td>
			<td><img data-original="http://img.youtube.com/vi/<?php echo $value["video_youtube"]; ?>/1.jpg"></td>
			<td><a href="/video/detail/<?php echo $value["video_id"]."-".mod_rewrite($value["video_title"]); ?>" target="_blank"><?php echo $value["video_title"]; ?></a></td>
			<td><?php echo $value["video_views"]; ?></td>
		</tr>
<?php 	
}
 ?>
	</tbody>
</table>
