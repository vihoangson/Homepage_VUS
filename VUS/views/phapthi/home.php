  	<!-- Page Content -->
    <div class="">
        <!-- /.row -->

        <!-- Projects Row -->
        <div class="row">
						<?php						
						$i=0;
						foreach ($data_page as $key => $value) {
//							$data_img=@getimagesize("http://img.youtube.com/vi/".$value->url."/0.jpg");
//							if($data_img[0]<100) continue;
							?>
							<div class="col-md-4 portfolio-item">
									<a href="<?php echo base_url(); ?>phapthi/detail/<?php echo $value->id; ?>-<?php echo mod_rewrite($value->name); ?>">
											<img class="img-responsive" src="http://img.youtube.com/vi/<?php echo $value->url; ?>/0.jpg" alt="" style="width:100%;">
									</a>
									<h3>
											<a href="<?php echo base_url(); ?>phapthi/detail/<?php echo $value->id; ?>-<?php echo mod_rewrite($value->name); ?>"><?php echo $value->name; ?></a>
									</h3>
							</div>
							<?php
							if(($i+1)%3==0){
								echo "</div><div class='row'>";
							}
							$i++;
						} ?>            
        </div>
        <!-- /.row -->
        <hr>
				<div class="class_pagination">
				<?php echo $pagination; ?>
				</div>
  

        <hr>

        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; Your Website 2014</p>
                </div>
            </div>
            <!-- /.row -->
        </footer>

    </div>
    <!-- /.container -->