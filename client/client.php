<?php
session_start();
include_once '../assets/conn/dbconnect.php';
if(!isset($_SESSION['userSession']))
{
header("Location: ../index.php");
}

$usersession = $_SESSION['userSession'];


$res=mysqli_query($con,"SELECT * FROM client1 WHERE idUser=".$usersession);

if ($res===false) {
	echo mysql_error();
} 

$userRow=mysqli_fetch_array($res,MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
		<title>Client Dashboard</title>
		<!-- Bootstrap -->
		<!-- <link href="assets/css/bootstrap.min.css" rel="stylesheet"> -->
		<link href="assets/css/material.css" rel="stylesheet">
		<link href="assets/css/default/style.css" rel="stylesheet">
		<!-- <link href="assets/css/default/style1.css" rel="stylesheet"> -->
		<link href="assets/css/default/blocks.css" rel="stylesheet">
		<link href="assets/css/date/bootstrap-datepicker.css" rel="stylesheet">
		<link href="assets/css/date/bootstrap-datepicker3.css" rel="stylesheet">
		<!-- Special version of Bootstrap that only affects content wrapped in .bootstrap-iso -->
		<!-- <link rel="stylesheet" href="https://formden.com/static/cdn/bootstrap-iso.css" /> -->
		<!--Font Awesome (added because you use icons in your prepend/append)-->
		<link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css" />
		
	</head>
	<body>
		
		<!-- navigation -->
		<nav class="navbar navbar-default " role="navigation">
			<div class="container-fluid">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="client.php"><img alt="Brand" src="assets/img/logo2.png" height="30px"></a>
				</div>
				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav">
						<ul class="nav navbar-nav">
							<li><a href="client.php">Home</a></li>
							<!-- <li><a href="profile.php?patientId=<?php echo $userRow['idUser']; ?>" >Profile</a></li> -->
							<li><a href="clientapplist.php?patientId=<?php echo $userRow['idUser']; ?>">Appointment</a></li>
						</ul>
					</ul>
					
					<ul class="nav navbar-nav navbar-right">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $userRow['userFirstName']; ?> <?php echo $userRow['userLastName']; ?><b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li>
									<a href="profile.php?patientId=<?php echo $userRow['idUser']; ?>"><i class="fa fa-fw fa-user"></i> Profile</a>
								</li>
								<li>
									<a href="clientapplist.php?patientId=<?php echo $userRow['idUser']; ?>"><i class="glyphicon glyphicon-file"></i> Appointment</a>
								</li>
								<li class="divider"></li>
								<li>
									<a href="clientlogout.php?logout"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
								</li>
							</ul>
						</li>
					</ul>
				</div>
			</div>
		</nav>
		<!-- navigation -->
		
		<!-- 1st section start -->
		<section id="promo-1" class="content-block promo-1 min-height-600px bg-offwhite">
			<div class="container">
				<div class="row">
					<div class="col-xs-12 col-md-8">
							<!-- notification end -->
							<h2 style="color:white"><b>Hello <?php echo $userRow['userFirstName']; ?> <?php echo $userRow['userLastName']; ?>, Schedule Your Cleaning Service!</b></h2>
							<div class="input-group" style="margin-bottom:10px;">
								<div class="input-group-addon">
									<i class="fa fa-calendar">
									</i>
								</div>
								<input class="form-control" id="date" name="date" value="<?php echo date("Y-m-d")?>" onchange="showUser(this.value)"/>
							</div>
						</div>
						<!-- date textbox end -->
						<!-- script start -->
						<script>
						function showUser(str) {
						
						if (str == "") {
						document.getElementById("txtHint").innerHTML = "No data to be shown";
						return;
						} else {
						if (window.XMLHttpRequest) {
						// code for IE7+, Firefox, Chrome, Opera, Safari
						xmlhttp = new XMLHttpRequest();
						} else {
						// code for IE6, IE5
						xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
						}
						xmlhttp.onreadystatechange = function() {
						if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
						document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
						}
						};
						xmlhttp.open("GET","getschedule.php?q="+str,true);
						console.log(str);
						xmlhttp.send();
						}
						}
						</script>
						
						<!-- script start end -->
						
						<!-- table appointment start -->
						<!-- <div class="container"> -->
						<div class="container">
							<div class="row">
								<div class="col-xs-12 col-md-8">
									<div id="txtHint"></div>
								</div>
							</div>
						</div>
						<!-- </div> -->
						<!-- table appointment end -->
					</div>
				</div>
				<!-- /.row -->
			</div>
		</section>
		<!-- first section end -->
		<!-- forth sections start -->
		<section id="content-1-9" class="content-1-9 content-block">
			<div class="container">
				<div class="underlined-title">
					<h1>Services</h1>
					<hr>
                    <h2>Contact Us: 123-456-7890</h2>
				</div>
				<div class="row">
					<div class="col-md-4 col-sm-12 col-xs-12 pad25">
						<div class="col-xs-2">
							<span class="fa fa-check-circle"></span>
						</div>
						<div class="col-xs-10">
							<h4>Furniture Cleaning</h4>
							<p>Bring your funiture back to life and looking brand new again!</p>
						</div>
					</div>
					<div class="col-md-4 col-sm-12 col-xs-12 pad25">
						<div class="col-xs-2">
							<span class="fa fa-check-circle"></span>
						</div>
						<div class="col-xs-10">
							<h4>Window Cleaning</h4>
							<p>Get a nice clear view outdoors & streak-free windows!</p>
						</div>
					</div>
					<div class="col-md-4 col-sm-12 col-xs-12 pad25">
						<div class="col-xs-2">
							<span class="fa fa-check-circle"></span>
						</div>
						<div class="col-xs-10">
							<h4>Carpet Cleaning</h4>
							<p>We can clean your carpets and get rid of the toughest stains!</p>
						</div>
					</div>
					<div class="col-md-4 col-sm-12 col-xs-12 pad25">
						<div class="col-xs-2">
							<span class="fa fa-check-circle"></span>
						</div>
						<div class="col-xs-10">
							<h4>Garage Cleaning</h4>
							<p>Do you have a garage that you just haven't gotten around to cleaning yet?  We'll take care of that for you!</p>
						</div>
					</div>
					<div class="col-md-4 col-sm-12 col-xs-12 pad25">
						<div class="col-xs-2">
							<span class="fa fa-check-circle"></span>
						</div>
						<div class="col-xs-10">
							<h4>Bathroom Cleaning</h4>
							<p>We'll take care of cleaning and disinfecting your bathroom for you, so you can maintain a healhty hygiene!</p>
						</div>
					</div>
					<div class="col-md-4 col-sm-12 col-xs-12 pad25">
						<div class="col-xs-2">
							<span class="fa fa-check-circle"></span>
						</div>
						<div class="col-xs-10">
							<h4>Yard/Driveway Cleaning</h4>
							<p>Whether it's snow, leaves, or trash outdoors, we'll let you sit back and do the work for you!</p>
						</div>
					</div>
				</div>
				<!-- /.row -->
			</div>
		</section>
		<!-- forth section end -->
		
		<!-- footer start -->
		<div class="copyright-bar bg-black">
			<div class="container">
				<p class="pull-left small">© Copyright 2020.</p>
			</div>
		</div>
		<!-- footer end -->
		
		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="assets/js/jquery.js"></script>
		<script src="assets/js/date/bootstrap-datepicker.js"></script>
		<script src="assets/js/moment.js"></script>
		<script src="assets/js/transition.js"></script>
		<script src="assets/js/collapse.js"></script>
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src="assets/js/bootstrap.min.js"></script>
		
		<!-- date start -->
		<script>
		$(document).ready(function(){
		var date_input=$('input[name="date"]'); //our date input has the name "date"
		var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
		date_input.datepicker({
		format: 'yyyy-mm-dd',
		container: container,
		todayHighlight: true,
		autoclose: true,
		})
		})
		</script>
		<!-- date end -->
		
		
	</body>
</html>