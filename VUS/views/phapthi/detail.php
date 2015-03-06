<?php $value=$video[0]; ?>
<h2><?php echo $value->name; ?></h2>
<hr>
<div class="row">
	<div class="col-md-9 col-lg-9" style="margin:0 auto; float: none;">
		<center>
			<iframe style="width:100%;height:400px" src="https://www.youtube.com/embed/<?php echo $value->url; ?>" frameborder="0" allowfullscreen></iframe>
		</center>
	</div>		
</div>

<!--<img class="img-responsive" src="http://img.youtube.com/vi/<?php echo $value->url; ?>/0.jpg" alt="">-->
<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

