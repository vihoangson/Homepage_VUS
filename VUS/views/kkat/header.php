<!DOCTYPE html>
<html lang="en">

<head>		
		<base href="<?php echo base_url(); ?>assets/startbootstrap-blog-home-1.0.2/">
<!--		<base href="<?php echo base_url(); ?>/">-->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Chương trình tình nguyện "Tết yêu thương" năm 2015</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/blog-home.css" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/fancybox/jquery.fancybox-1.3.4.css" media="screen" />
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
				
</head>

<body>		

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo base_url(); ?>">VUS</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="<?php echo base_url(); ?>Khoanhkhacantuong/readmore">Tường thuật chương trình</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>Khoanhkhacantuong">Khoảnh khắc ấn tượng</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>Khoanhkhacantuong/Video">Video chương trình</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>Khoanhkhacantuong/upload">Upload ảnh</a>
                    </li>
                  
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">	
								<img src="<?php echo base_url(); ?>assets/images/banner_tetyeuthuong2015.jpg" style="width:100%">
								
<?php
if(isset($alert_page)){
	echo $alert_page;
}
if(isset($page_title)){
	echo '
<div class="page-header">
  <h1>'.$page_title.'</h1>
</div>';
}else{
	echo '
<div class="page-header">
  <h1>Khoảnh khắc ấn tượng</h1>
</div>';
}
?>

                