<!DOCTYPE html>
<html lang="vi">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title><?php if(isset($this->config->title_page))echo $this->config->title_page." - Vus.vn "; else echo "Trang tin tức tổng hợp Vus.vn"; ?></title>
		<?php if(isset($this->config->header)) echo $this->config->header; ?>
		<!-- Bootstrap CSS -->
		<link href="<?php echo base_url("assets/bootstrap-3.3.2-dist/css/bootstrap.min.css"); ?>" rel="stylesheet">
		<link href="<?php echo base_url("assets/startbootstrap-modern-business-1.0.2/css/modern-business.css"); ?>" rel="stylesheet">
		<link href="<?php echo base_url("assets/startbootstrap-modern-business-1.0.2/font-awesome/css/font-awesome.min.css"); ?>" rel="stylesheet">
		<link href="<?php echo base_url("assets/style/style.css"); ?>" rel="stylesheet">
		<link href="<?php echo base_url("assets/syntaxhighlighter/styles/shCore.css"); ?>" rel="stylesheet">
		<link href="<?php echo base_url("assets/syntaxhighlighter/styles/shCoreDefault.css"); ?>" rel="stylesheet">
		
		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
		<style type="text/css">
.pagination_box > a, .pagination_box > strong {
  font-size: 10px;
  padding: 7px;
}
.class_pagination a, .class_pagination strong {
  border: 1px solid #ccc;
  border-radius: 3px;
  margin: 2px;
  padding: 6px;
}
		</style>
	</head>
	<body>
	<?php $this->load->view('phapthi/menu'); ?>
	<div class="container">	
		
			<div class="row">
					<div class="col-md-9">			
							
	<div class="row">
			<div class="col-lg-12">
					<?php 
					if(!isset($this->config->title_head)){
						?>
						<h1 class="page-header">Phật pháp nhiệm màu
								<small>Phapthi.Vus.vn</small>
						</h1>					
						<?php						
					}else{
						
						?>
						<h1 class="page-header"><?php echo $this->config->title_head; ?></h1>					
						<?php							
					}
					?>			

					<?php 
					if(isset($this->config->breadcrumbs))
						echo $this->config->breadcrumbs;
					?>
			</div>
	</div>

			


			
			
<!--ssssssssssssssss			-->

<?php //die();?>