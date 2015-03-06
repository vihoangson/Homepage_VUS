            </div>

            <!-- Blog Sidebar Widgets Column -->
            <div class="col-md-4">

                <!-- Blog Search Well -->
                <div class="well">
                    <h4>Upload images</h4>
                    <div class="input-group" style="display:none;">
                        <input type="text" class="form-control">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button">
                                <span class="glyphicon glyphicon-search"></span>
                        </button>
                        </span>
                    </div>
                    <!-- /.input-group -->
										
										<?php
										$this->load->view("kkat/upload");
										?>
										
                </div>

                <!-- Blog Categories Well -->
                <div class="well" style="display:none;">
                    <h4>Blog Categories</h4>
                    <div class="row">
                        <div class="col-lg-6">
                            <ul class="list-unstyled">
                                <li><a href="#">Category Name</a>
                                </li>
                                <li><a href="#">Category Name</a>
                                </li>
                                <li><a href="#">Category Name</a>
                                </li>
                                <li><a href="#">Category Name</a>
                                </li>
                            </ul>
                        </div>
                        <!-- /.col-lg-6 -->
                  
                    </div>
                    <!-- /.row -->
                </div>

                <!-- Side Widget Well -->
                <div class="well">
                    <h4>Chương trình tình nguyện "Tết yêu thương" năm 2015</h4>
                    <p></p>
                </div>
								
            </div>

        </div>
        <!-- /.row -->

        <hr>

        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; Your Website 2014</p>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </footer>

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/fancybox/jquery.fancybox-1.3.4.pack.js"></script>

	<script>
		$(document).ready(function(){
			$("a.fancybox-1").fancybox();
			$(".form_upload input[type='file']").change(function(){
				$(".form_upload").submit();
			});
		});
	</script>
    <!-- Bootstrap Core JavaScript -->
<!--    <script src="js/bootstrap.min.js"></script>-->
		
	
		
		<a href="<?php echo base_url(); ?>KhoanhKhacAnTuong/del" style='color:white;'>x</a>
</body>

</html>
