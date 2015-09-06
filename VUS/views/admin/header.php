<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>SB Admin - Bootstrap Admin Template</title>

	<!-- Bootstrap Core CSS -->
	<link href="<?php echo base_url(); ?>assets/bootstrap-3.3.2-dist/css/bootstrap.min.css" rel="stylesheet">

	<!-- Custom CSS -->
	<link href="<?php echo base_url(); ?>assets/bootstrap-3.3.2-dist/css/sb-admin.css" rel="stylesheet">

	<!-- Morris Charts CSS -->
	<link href="<?php echo base_url(); ?>assets/bootstrap-3.3.2-dist/css/plugins/morris.css" rel="stylesheet">

	<!-- Custom Fonts -->
	<link href="<?php echo base_url(); ?>assets/bootstrap-3.3.2-dist/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- jQuery -->
    <script src="<?php echo base_url(); ?>assets/jquery.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/lazyload.js"></script>
    <script>
		$(function() {
		    $("img").lazyload();
		});
    </script>
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->

</head>

<body>
	<div id="wrapper" class="container">
	<h1>Admin control</h1>
	<div class="row">
		<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
			<div class="panel panel-info">
				<div class="panel-heading">
						<h3 class="panel-title">Panel title</h3>
				 </div>
				<div class="panel-body">
					<ul>
						<li><a href="http://vus.vnn/Admin/show_post">Tất cả bài viết</a></li>
						<li><a href="http://vus.vnn/Admin/add_post">Thêm bài viết</a></li>
						<li><a href="/processdatabase/check_youtube">Kiểm tra video có tồn tại</a></li>
						<li><a href="http://vus.vnn/Admin/show_comment">Tất cả comment</a></li>
						<li><a href="http://vus.vnn/Admin/test_getimg">Lưu hình trong bài viết</a></li>
						<li><a href="http://vus.vnn/processdatabase/getvui1">Lấy tin trang vui1</a></li>
						<li><a href="http://vus.vnn/processdatabase/get_xem_vn">Lấy tin trang xem.vn</a></li>
						<li><a href="http://vus.vnn/processdatabase/filter_video">Xóa video trùng</a></li>
						<li><a href="http://vus.vnn/processdatabase/get_xem_vn">get_xem_vn</a></li>
						<li><a href="http://vus.vnn/admin/videos">Quản lý video</a></li>
						
						<?php 
						if(isset($this->action->menu_main)){
							foreach ($this->action->menu_main as $key => $value) {
								echo '<li><a href="'.$key.'">'.$value.'</a></li>';
							}
						}

						?>
					</ul>
				</div>
			</div>
		</div>
		<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
