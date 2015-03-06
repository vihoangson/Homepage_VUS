			<div class="box_news new_news"><h2>Bài viết mới nhất</h2>
						<?php
						foreach ($data_new as $value){
							?>
				<div class="row">
					<div class="span8">
						<div class="row">
							<div class="span8">
								<h4><strong><a href="<?php echo base_url("block/detail/".$value->align_title."") ?>"><?php echo word_limiter($value->title,13);  ?></a></strong></h4>
							</div>
						</div>
						<div class="row">
							<div class="span2">
								<a href="<?php echo base_url("block/detail/".$value->align_title."") ?>" class="thumbnail">
												<?php
					if($value->local_img && $this->config->item("show_img_cat")){
						?><!-- <img class="img-responsive img-hover" src="<?php echo $row->image; ?>" alt="">--> 	
						<div style="background:url('<?php echo base_url(); ?>uploads/baiviet/thumb/small_120x120_<?php echo ($value->local_img); ?>') no-repeat center center" class="thumb_content"></div>
							<?php
					}
					?>
								</a>
							</div>
							<div class="span6">      
								<p>
									<?php echo word_limiter($value->readmore,40); ?>
								</p>
								<p><a href="<?php echo base_url("block/detail/".$value->align_title."") ?>">Read more</a></p>
							</div>
						</div>			


						<div class="row">
							<div class="span8">
								<p></p>
								<p>
									<i class="icon-user"></i> by <a href="#">Mark</a> 
									| <i class="icon-calendar"></i> Sept 16th, 2012
									| <i class="icon-comment"></i> <a href="#">3 Comments</a>
									| <i class="icon-share"></i> <a href="#">39 Shares</a>
									| <i class="icon-tags"></i> Tags : <a href="#"><span class="label label-info">Snipp</span></a> 
									<a href="#"><span class="label label-info">Bootstrap</span></a> 
									<a href="#"><span class="label label-info">UI</span></a> 
									<a href="#"><span class="label label-info">growth</span></a>
								</p>
							</div>
						</div>
					</div>
				</div>
				<hr>
						<?php
						}
						?>
			</div>	

