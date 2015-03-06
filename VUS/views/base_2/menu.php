<?php 

$this->config->menu[]=array(base_url()."Processdatabase/get_first_img","get_first_img");
$this->config->menu[]=array(base_url()."Processdatabase/download_resize_img","download_resize_img");
$this->config->menu[]=array(base_url()."Processdatabase/check_saved_local_img","check_saved_local_img");
$this->config->menu[]=array(base_url()."Processdatabase/resize_img_custom","resize_img_custom");
$this->config->menu[]=array(base_url()."Processdatabase/rebuild_time_create","rebuild_time_create");
$this->config->menu[]=array(base_url()."Admin","Admin");


?>
<!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Trang chủ</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo base_url(); ?>">Trang chủ</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
												<?php 
												$m=$this->db->get("baiviet_nhom")->result();
												foreach ($m as $value){
													$cid_value[$value->cid]=array($value->title,$value->align_title);
												}
												?>	

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Nhiếp ảnh <b class="caret"></b></a>
                        <ul class="dropdown-menu">                           
														<?php 
												$array=array(1,2,3,4,5);
													foreach ($array as $value){
														if(isset($cid_value[$value]))
														echo "<li><a href='".base_url()."block/viewcat/".$cid_value[$value][1]."'>".$cid_value[$value][0]."</a></li>";
													}
														?>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Khoa Học <b class="caret"></b></a>
                        <ul class="dropdown-menu">                           
														<?php 
												$array=array(6,7,8,9,10);
													foreach ($array as $value){
														
														if(isset($cid_value[$value]))
														echo "<li><a href='".base_url()."block/viewcat/".$cid_value[$value][1]."'>".$cid_value[$value][0]."</a></li>";
													}
														?>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Công nghệ <b class="caret"></b></a>
                        <ul class="dropdown-menu">                           
														<?php 
												$array=array(11,12,13,14,15,16,17,18,19,20);
													foreach ($array as $value){							
														if(isset($cid_value[$value]))
														echo "<li><a href='".base_url()."block/viewcat/".$cid_value[$value][1]."'>".$cid_value[$value][0]."</a></li>";
													}
														?>
                        </ul>
                    </li>										
                    <li>
                        <a href="<?php echo base_url(); ?>Khoanhkhacantuong">Tết yêu thương 2015</a>
                    </li>										

										<li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">User <b class="caret"></b></a>
												<ul class="dropdown-menu">
										<?php
										if(!$this->session->user=="son"){
											?>
                            <li>
                                <a href="<?php echo base_url()."User/Login"; ?>">Login</a>
                            </li>   
										<?php
										}else{
											?>
                            <li>
                                <a href="<?php echo base_url()."User/Logout"; ?>">Logout</a>
                            </li>   
										<?php
										}
										?>														

												</ul>
										</li>

										<?php
										if($this->session->user=="son"){
											?>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Process database <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="<?php echo base_url()."processdatabase"; ?>">Process Database</a>
                            </li>                        
                            <li>
                                <a href="<?php echo base_url("processdatabase/get_link"); ?>">get_link</a>
                            </li>
                            <li>
                                <a href="<?php echo base_url("processdatabase/rebuild_readmore"); ?>">rebuild_readmore</a>
                            </li>
                            <li>
                                <a href="<?php echo base_url("processdatabase/show_controller"); ?>">show_controller</a>
                            </li>      
                            <li>
                                <a href="<?php echo base_url("option"); ?>">Option</a>
                            </li> 
														<?php foreach ($this->config->menu as $key => $value) {
															echo '<li><a href="'.$value[0].'">'.$value[1].'</a></li>';
															
														} ?>
                        </ul>
                    </li>		
										<?php
										}
										?>                    
								
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>