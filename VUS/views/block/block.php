		<!-- Page Heading/Breadcrumbs -->

		<!-- /.row -->
		<div class="row">

			<!-- Blog Entries Column -->
			<div class="col-md-12">
<?php
foreach ($data_page as $row) {
	$data["data_ele"]=$row;
	$this->load->view('block/block_cat_ele', $data);
}
echo "<div class='pagination_box'>".$pagination."</div>";
 ?>
			</div>
			<!-- Blog Sidebar Widgets Column -->
			<div class="col-md-4" style="display:none;">
				<!-- Blog Search Well -->
				<div class="well">
					<h4>Blog Search</h4>
					<div class="input-group">
						<input type="text" class="form-control">
						<span class="input-group-btn">
							<button class="btn btn-default" type="button"><i class="fa fa-search"></i></button>
						</span>
					</div>
					<!-- /.input-group -->
				</div>
				<!-- Blog Categories Well -->
				<div class="well">
					<h4>Blog Categories</h4>
					<div class="row">
						<div class="col-lg-6">
							<ul class="list-unstyled">
								<?php
								$rs=$this->db->get("baiviet_nhom");
								foreach ($rs->result() as $row) {
									echo "<li><a href='".base_url("block/viewcat/")."/".$row->align_title."'>".$row->title."</a></li>";
									# code...
								}
								?>
							</ul>
						</div>
						<!-- /.col-lg-6 -->
					</div>
					<!-- /.row -->
				</div>

				<!-- Side Widget Well -->
				<div class="well">
					<h4>Side Widget Well</h4>
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore, perspiciatis adipisci accusamus laudantium odit aliquam repellat tempore quos aspernatur vero.</p>
				</div>

			</div>

		</div>
		<!-- /.row -->

		<hr>

		<div class="row video_home">
			<?php
				$this->db->order_by('RAND()');
				$array_video = $this->db->get('videos',20)->result_array();
				foreach ($array_video as $key => $value) {
					$this->load->view('block/block_ele_video',$value);
				}
			?>
		</div>
