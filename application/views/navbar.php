<!DOCTYPE html>
<html lang="en">

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Bookmates</title>
		
		<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,800italic,800,700italic,700,600italic,400italic,600,300italic,300|Oswald:400,300,700' rel='stylesheet' type='text/css'>
		<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700,600,400italic,600italic,700italic,800,800italic' rel='stylesheet' type='text/css'>
		<!-- Bootstrap -->
		<link href="<?php echo base_url(); ?>css/bootstrap.min.css" rel="stylesheet">
		<link href="<?php echo base_url(); ?>css/font-awesome.min.css" rel="stylesheet">
		<link href="<?php echo base_url(); ?>css/custom.css" rel="stylesheet">
		<link href="<?php echo base_url(); ?>css/owl.carousel.css" rel="stylesheet">
		<link href="<?php echo base_url(); ?>css/owl.theme.css" rel="stylesheet">
		<link href="<?php echo base_url(); ?>css/owl.transitions.css" rel="stylesheet">
		<link href="<?php echo base_url(); ?>css/style.css" rel="stylesheet">
		<link rel="stylesheet" href="<?php echo base_url(); ?>css/agency1.css">
		<style>
			#loginbutton{

				margin-top:-10px;
				background-color: transparent;
				color: white;
				/*margin-right: 12px;*/
				font-family: 'Open Sans',sans-serif;
				font-size: 20px;
				font-weight: 600;
				/*letter-spacing: 1px;*/
			}

		</style>
        <!-- js -->

		<script src="<?php echo base_url(); ?>js/jquery.js"></script>
		<script src="<?php echo base_url(); ?>js/bootstrap.min.js"></script>
		<script src="<?php echo base_url(); ?>js/moment.js"></script>


        <script src="<?php echo base_url(); ?>js/html5shiv.min.js"></script>
		<script src="<?php echo base_url(); ?>js/respond.min.js"></script>
		<script src="<?php echo base_url(); ?>js/jquery.easing.min.js"></script>
		<script src="<?php echo base_url(); ?>js/jquery.stellar.js"></script>
		<script src="<?php echo base_url(); ?>js/jquery.appear.js"></script>
		<script src="<?php echo base_url(); ?>js/jquery.nicescroll.min.js"></script>
		<script src="<?php echo base_url(); ?>js/jquery.countTo.js"></script>
		<script src="<?php echo base_url(); ?>js/jquery.shuffle.modernizr.js"></script>
		<script src="<?php echo base_url(); ?>js/jquery.shuffle.js"></script>
		<script src="<?php echo base_url(); ?>js/owl.carousel.js"></script>
		<script src="<?php echo base_url(); ?>js/jquery.ajaxchimp.min.js"></script>
		<script src="<?php echo base_url(); ?>js/script.js"></script>

		
		
	</head>
	<body data-spy="scroll" data-target=".main-nav">
	
		
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		

		<header>
			<nav class="navbar navbar-default navbar-fixed-top navbar-bg">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header brand-logo-pad">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
<!--        <span class="icon-bar"></span>-->
<!--        <span class="icon-bar"></span>-->
<!--        <span class="icon-bar"></span>-->
      </button>

		<a class="brand-logo" href="<?php echo base_url();?>">BookMates</a>

    </div>


    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-right">
<!--							<li class="tag-nav-buttons"><a href="--><?php //echo base_url(); ?><!--index.php/AddEvent/#addEvent"><button class="btn btn-default"> &nbspRead&nbsp</button><br/></a></li>-->
<!--							<li class="tag-nav-buttons"><a href="--><?php //echo base_url(); ?><!--index.php/ListEvent/#filter"><button class="btn btn-default">Listen</button><br/></a></li>-->
		  <li><a href="<?php echo base_url(); ?>index.php/AddEvent/">Publish</a></li>
		  <li><a href="<?php echo base_url(); ?>index.php/ListEvent">Join</a></li>
		  <li><a href="<?php echo base_url(); ?>index.php/AudioBook">Books</a></li>


		  <li><a href="<?php echo base_url(); ?>index.php/About">About Us</a></li>

		  <li>
			  <a><button type="button" id ="loginbutton"  class="btn btn-default">
<!--				  <img src="--><?php //echo base_url(); ?><!--img/logos/login.png" class="img-responsive"  height="25px"  width="25px">-->
			  			Login
			  </button></a>
		  </li>
	  </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
			</nav>

			<!-- Home section ================================================== -->
	</header>


