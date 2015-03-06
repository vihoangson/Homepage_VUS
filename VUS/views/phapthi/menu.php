<?php 

$this->config->menu[0][]=array(base_url()."Processdatabase/get_first_img","get_first_img");

$this->config->menu[1][]=array(base_url()."Admin/show_post","Danh sách post");
$rs=$this->db->get("phapthi_video_group")->result();
foreach ($rs as $key => $value) {
	$this->config->menu[0][]=array(base_url()."Phapthi/catview/".$value->id."-".mod_rewrite($value->theloai),$value->theloai);	
}


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
                <a class="navbar-brand" href="<?php echo base_url(); ?>Phapthi">Trang chủ</a>
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
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Giảng sư <b class="caret"></b></a>
                        <ul class="dropdown-menu">                            
														<?php foreach ($this->config->menu[0] as $key => $value) {
															echo '<li><a href="'.$value[0].'">'.$value[1].'</a></li>';
															
														} ?>
                        </ul>
                    </li>	
										<?php
										if($this->session->user=="son"){
											?>
	
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Bài viết <b class="caret"></b></a>
                        <ul class="dropdown-menu">
														<?php foreach ($this->config->menu[1] as $key => $value) {
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