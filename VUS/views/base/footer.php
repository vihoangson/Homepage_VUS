		</div>
		<div class="col-md-3">
			<br>
			<div class="panel panel-info">
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
    </script>
	</body>
</html>