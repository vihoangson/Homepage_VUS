<div class="">
		<form action="<?php echo base_url(); ?>block/do_comment" method="post">
				<input type="hidden" name="align_t" value="<?php echo $this->uri->segment(3); ?>">

				<?php $this->config->footer= '<script src="'.base_url().'assets/count_mess.js"></script>' ?>
				<div class="" id="comment">
						<div class="row">
						<div class="col-sm-12 col-md-12">
										<div class="panel panel-default">
												<div class="panel-body">                
														
																<textarea class="form-control counted" name="comment" placeholder="Type in your message" rows="5" style="margin-bottom:10px;"></textarea>
																<h6 class="pull-right" id="counter">320 characters remaining</h6>
																<button class="btn btn-info" type="submit">Post New Message</button>
												</div>
										</div>
								</div>
					</div>
				</div>
		</form>

	<div class="row">
		<h2>Time Line</h2>
	</div>
		<?php 
		$this->load->view("block/comment_ele");
		?>
</div>