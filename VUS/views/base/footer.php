		</div>
		<div class="col-md-3">
			<div class="row video_home">
				<?php
					$this->db->order_by('RAND()');
					$array_video = $this->db->get('videos',12)->result_array();
					foreach ($array_video as $key => $value) {
						$this->load->view('block/block_ele_video_nav',$value);
					}
				?>
			</div>
			<div class="panel panel-info" style="display:none;">
				  <div class="panel-heading">
						<h3 class="panel-title">Catelogy</h3>
				  </div>
				  <div class="panel-body">
			                        <ul >                           
							<?php 
					$cid_value=$this->db->get("baiviet_nhom")->result();
					foreach ($cid_value as $key => $value) {
						echo "<li><a href='".base_url()."block/viewcat/".$value->align_title."'>".$value->title."</a></li>";
					}			

							?>
			                        </ul>
				  </div>
			</div>

	
		</div>				
	</div>		
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

		<script src="<?php echo base_url();?>assets/syntaxhighlighter/scripts/shCore.js"></script>
		<script src="<?php echo base_url();?>assets/syntaxhighlighter/scripts/shBrushAppleScript.js"></script>
		<script src="<?php echo base_url();?>assets/syntaxhighlighter/scripts/shBrushAS3.js"></script>
		<script src="<?php echo base_url();?>assets/syntaxhighlighter/scripts/shBrushBash.js"></script>
		<script src="<?php echo base_url();?>assets/syntaxhighlighter/scripts/shBrushColdFusion.js"></script>
		<script src="<?php echo base_url();?>assets/syntaxhighlighter/scripts/shBrushCpp.js"></script>
		<script src="<?php echo base_url();?>assets/syntaxhighlighter/scripts/shBrushCSharp.js"></script>
		<script src="<?php echo base_url();?>assets/syntaxhighlighter/scripts/shBrushCss.js"></script>
		<script src="<?php echo base_url();?>assets/syntaxhighlighter/scripts/shBrushDelphi.js"></script>
		<script src="<?php echo base_url();?>assets/syntaxhighlighter/scripts/shBrushDiff.js"></script>
		<script src="<?php echo base_url();?>assets/syntaxhighlighter/scripts/shBrushErlang.js"></script>
		<script src="<?php echo base_url();?>assets/syntaxhighlighter/scripts/shBrushGroovy.js"></script>
		<script src="<?php echo base_url();?>assets/syntaxhighlighter/scripts/shBrushJava.js"></script>
		<script src="<?php echo base_url();?>assets/syntaxhighlighter/scripts/shBrushJavaFX.js"></script>
		<script src="<?php echo base_url();?>assets/syntaxhighlighter/scripts/shBrushJScript.js"></script>
		<script src="<?php echo base_url();?>assets/syntaxhighlighter/scripts/shBrushPerl.js"></script>
		<script src="<?php echo base_url();?>assets/syntaxhighlighter/scripts/shBrushPhp.js"></script>
		<script src="<?php echo base_url();?>assets/syntaxhighlighter/scripts/shBrushPlain.js"></script>
		<script src="<?php echo base_url();?>assets/syntaxhighlighter/scripts/shBrushPython.js"></script>
		<script src="<?php echo base_url();?>assets/syntaxhighlighter/scripts/shBrushRuby.js"></script>
		<script src="<?php echo base_url();?>assets/syntaxhighlighter/scripts/shBrushSass.js"></script>
		<script src="<?php echo base_url();?>assets/syntaxhighlighter/scripts/shBrushScala.js"></script>
		<script src="<?php echo base_url();?>assets/syntaxhighlighter/scripts/shBrushSql.js"></script>
		<script src="<?php echo base_url();?>assets/syntaxhighlighter/scripts/shBrushVb.js"></script>
		<script src="<?php echo base_url();?>assets/syntaxhighlighter/scripts/shBrushXml.js"></script>
				
		<?php if(isset($this->config->footer)) echo $this->config->footer; ?>
    <!-- Script to Activate the Carousel -->
    <script>
			SyntaxHighlighter.all();
    $('.carousel').carousel({
        interval: 5000 //changes the speed
    })
<?php
	 if ($this->agent->is_mobile()){
		?>
		$(".video_youtube").height($(window).height()-150);
		$(window).resize(function() {
			$(".video_youtube").height($(window).height()-150);
		});
		<?php
	}
 ?>
</script>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-46102380-1', 'auto');
  ga('send', 'pageview');

</script>
	</body>
</html>