<?php
session_start();
include_once '../assets/conn/dbconnect.php';
$session= $_SESSION['patientSession'];
// $appid=null;
// $appdate=null;
if (isset($_GET['scheduleDate']) && isset($_GET['appid'])) {
	$appdate =$_GET['scheduleDate'];
	$appid = $_GET['appid'];
}
// on b.idUser = a.idUser
$res = mysqli_query($con,"SELECT a.*, b.* FROM adminschedule a INNER JOIN client1 b
WHERE a.scheduleDate='$appdate' AND scheduleId=$appid AND b.idUser=$session");
$userRow=mysqli_fetch_array($res,MYSQLI_ASSOC);


	
//INSERT
if (isset($_POST['appointment'])) {
$userId = mysqli_real_escape_string($con,$userRow['idUser']);
$scheduleid = mysqli_real_escape_string($con,$appid);
$symptom = mysqli_real_escape_string($con,$_POST['services']);
$comment = mysqli_real_escape_string($con,$_POST['comment']);
$avail = "notavail";


$query = "INSERT INTO appointment (  userId , scheduleId , needService , serviceComment  )
VALUES ( '$userId', '$scheduleid', '$symptom', '$comment') ";

//update table appointment schedule
$sql = "UPDATE adminschedule SET bookAvail = '$avail' WHERE scheduleId = $scheduleid" ;
$scheduleres=mysqli_query($con,$sql);
if ($scheduleres) {
	$btn= "disable";
} 


$result = mysqli_query($con,$query);
// echo $result;
if( $result )
{
?>
<script type="text/javascript">
alert('Appointment made successfully.');
</script>
<?php
header("Location: clientapplist.php");
}
else
{
	echo mysqli_error($con);
?>
<script type="text/javascript">
alert('Appointment booking fail. Please try again.');
</script>
<?php
header("Location: client/client.php");
}

}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		
		<title>Make Appoinment</title>
		<link href="assets/css/bootstrap.min.css" rel="stylesheet">
		<link href="assets/css/default/style.css" rel="stylesheet">
		<link href="assets/css/default/blocks.css" rcel="stylesheet">


		<link rel="stylesheet" href="https://formden.com/static/cdn/font-awesome/4.4.0/css/font-awesome.min.css" />

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
									<a href="clientapplist.php?patientId=<?php echo $userRow['idUser']; ?>"><i class="glyphicon glyphicon-file"></i> Appointments</a>
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
		<div class="container">
			<section style="padding-bottom: 50px; padding-top: 50px;">
				<div class="row">
					<!-- start -->
					<!-- USER PROFILE ROW STARTS-->
					<div class="row">
						<div class="col-md-3 col-sm-3">
							
							<div class="user-wrapper">
								<img src="assets/img/1.jpg" class="img-responsive" />
								<div class="description">
									<h4><?php echo $userRow['userFirstName']; ?> <?php echo $userRow['userLastName']; ?></h4>
									<h5> <strong> Customer </strong></h5>
									<p>
										Pellentesque elementum dapibus convallis.
									</p>
									<hr />
									<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Update Profile</button>
								</div>
							</div>
						</div>
						
						<div class="col-md-9 col-sm-9  user-wrapper">
							<div class="description">
								
								
								<div class="panel panel-default">
									<div class="panel-body">
										
										
										<form class="form" role="form" method="POST" accept-charset="UTF-8">
											<div class="panel panel-default">
												<div class="panel-heading">Client Information</div>
												<div class="panel-body">
													
													Client Name: <?php echo $userRow['userFirstName'] ?> <?php echo $userRow['userLastName'] ?><br>
													User ID: <?php echo $userRow['idUser'] ?><br>
													Contact Number: <?php echo $userRow['userPhone'] ?><br>
													Address: <?php echo $userRow['userAddress'] ?>
												</div>
											</div>
											<div class="panel panel-default">
												<div class="panel-heading">Appointment Information</div>
												<div class="panel-body">
													Day: <?php echo $userRow['scheduleDay'] ?><br>
													Date: <?php echo $userRow['scheduleDate'] ?><br>
													Time: <?php echo $userRow['startTime'] ?> - <?php echo $userRow['endTime'] ?><br>
												</div>
											</div>
											
											<div class="form-group">
												<label for="recipient-name" class="control-label">What Service:</label>
												<select id="Services" name="services">
												
												<option value="Furniture Cleaning">Furniture Cleaning</option>
												<option value="Window Cleaning">Window Cleaning</option>
												<option value="Carpet Cleaning">Carpet Cleaning</option>
												<option value="Garage Cleaning">Garage Cleaning</option>
												<option value="Bathroom Cleaning">Bathroom Cleaning</option>
												<option value="Yard/Driveway Cleaning">Yard/Driveway Cleaning</option>
												
												</select>
											</div>
											<div class="form-group">
												<label for="message-text" class="control-label">Comment:</label>
												<textarea class="form-control" name="comment" required></textarea>
											</div>
											<div class="form-group">
												<input type="submit" name="appointment" id="submit" class="btn btn-primary" value="Make Appointment">
											</div>
										</form>
									</div>
								</div>
								
							</div>
							
						</div>
					</div>
					<!-- USER PROFILE ROW END-->
					<!-- end -->
					<script src="assets/js/jquery.js"></script>
			<script src="assets/js/bootstrap.min.js"></script>
				</body>
			</html>