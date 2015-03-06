		
				<?php
				if(false)
				$this->load->view('base/popup');
				?>						


		<!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; Your Website 2014</p>
                </div>
            </div>
        </footer>

    </div>
    <!-- /.container -->
		<!-- jQuery -->
		<script src="<?php echo base_url("assets/jquery.js"); ?>"></script>
		<!-- Bootstrap JavaScript -->
		<script src="<?php echo base_url("assets/bootstrap-3.3.2-dist/js/bootstrap.min.js"); ?>"></script>
		<script src="<?php echo base_url("assets/syntaxhighlighter/scripts/shCore.js"); ?>"></script>
		<script src="<?php echo base_url("assets/syntaxhighlighter/scripts/shBrushPhp.js"); ?>"></script>		
		<?php if(isset($this->config->footer)) echo $this->config->footer; ?>
    <!-- Script to Activate the Carousel -->
    <script>
    $('.carousel').carousel({
        interval: 5000 //changes the speed
    })
    </script>
	</body>
</html>