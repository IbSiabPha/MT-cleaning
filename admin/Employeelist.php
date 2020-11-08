<?php
session_start();
include_once '../assets/conn/dbconnect.php';
// include_once 'connection/server.php';
if(!isset($_SESSION['doctorSession']))
{
header("Location: ../index.php");
}
$usersession = $_SESSION['doctorSession'];
$res=mysqli_query($con,"SELECT * FROM admin1 WHERE adminId=".$usersession);
$userRow=mysqli_fetch_array($res,MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Welcome <?php echo $userRow['adminFirstName'];?></title>
        <!-- Bootstrap Core CSS -->
        <!-- <link href="assets/css/bootstrap.css" rel="stylesheet"> -->
        <link href="assets/css/add.css" rel="stylesheet">
        <link href="assets/css/material.css" rel="stylesheet">
        <!-- Custom CSS -->
        <link href="assets/css/sb-admin.css" rel="stylesheet">
        <link href="assets/css/time/bootstrap-clockpicker.css" rel="stylesheet">
        <link href="assets/css/style.css" rel="stylesheet">
        <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet">
        <!-- Special version of Bootstrap that only affects content wrapped in .bootstrap-iso -->
        <!-- Custom Fonts -->
    </head>
    <body>
        <div id="wrapper">

            <!-- Navigation -->
            <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="admindashboard.php">Welcome <?php echo $userRow['adminFirstName'];?></a>
                </div>
                <!-- Top Menu Items -->
                <ul class="nav navbar-right top-nav">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $userRow['adminFirstName']; ?><b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="adminprofile.php"><i class="fa fa-fw fa-user"></i> Profile</a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="logout.php?logout"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
                <div class="collapse navbar-collapse navbar-ex1-collapse">
                    <ul class="nav navbar-nav side-nav">
                         <li>
                            <a href="admindashboard.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                        </li>
                        <li>
                            <a href="addschedule.php"><i class="fa fa-fw fa-table"></i> Appointment Schedule</a>
                        </li>
                        <li>
                            <a href="clientlist.php"><i class="fa fa-fw fa-edit"></i> Client List</a>
                        </li>
                        <li class="active">
                            <a href="Employeelist.php"><i class="fa fa-fw fa-edit"></i> Employee's </a>
                        </li>
                    </ul>
                </div>
                <!-- /.navbar-collapse -->
            </nav>
            <!-- navigation end -->
            <div class="interact">
            <button onclick="openForm()" name="upload" class="open-button ">Add</button>
                <div class="popup" id="myForm">
                    <p>Add Employees</p>
                    <form action="../admin/addEmp.php" method="POST" class="form-container">
                        <input class="input" type="text" name="employeeFirstName" placeholder="First Name">
                        <input class="input" type="text" name="employeeLastName" placeholder="Last Name">
                        <input class="input" type="text" name="employeeId" placeholder="loginID" required>
                        <input class="input" type="email" name="email" placeholder="Email" required>
                        <input class="input" type="password" name="pwd" placeholder="Password" required>
                        <input class="input" type="password" name="re-pwd" placeholder="confirm password" required>
                        <button type="submit" name="uSubmit" class="btn btn-primary">Submit</button>
                        <button type="submit" class="btn btn-primary" onclick="closeForm()">Close</button>
                    </form>
                </div>
            </div>
       

            <div id="page-wrapper">
                <div class="container-fluid">
                    
                    <!-- Page Heading -->
                    <div class="row">
                        <div class="col-lg-12">
                            <h2 class="page-header">
                            Employee's
                            </h2>
                            <?php if(isset($_GET['error'])){
                                    if($_GET['error'] == 'emptyfields'){
                                        echo "<p class='errorMsg'>Fill all box</p>";
                                    }
                                    elseif($_GET['error'] == 'invalideu'){
                                        echo "<p class='errorMsg'>Invalid user name & e-mail</p>";
                                    }
                                    elseif($_GET['error'] == 'invalidemail'){
                                        echo "<p class='errorMsg'>Invalid e-mail</p>";
                                    }
                                    elseif($_GET['error'] == 'invalidusername'){
                                        echo "<p class='errorMsg'>Invalid user name</p>";
                                    }
                                    elseif($_GET['error'] == 'passwordcheck'){
                                        echo "<p class='errorMsg'>password mismatch</p>";
                                    }
                                    elseif($_GET['error'] == 'usertaken'){
                                        echo "<p class='errorMsg'>User name taken</p>";
                                    }
                                 }    
                                if(isset($_GET['signup'])){
						            if($_GET['signup'] == 'success'){
                                    echo "<p class='goodMsg'>account created</p>";}
                                } ?>
                            <!-- <ol class="breadcrumb">
                                <li class="active">
                                    <i class="fa fa-calendar"></i> Employee accounts
                                </li>
                            </ol> -->
                        </div>
                    </div>
                    <!-- Page Heading end-->

                    <!-- panel start -->
                    <div class="panel panel-primary filterable">

                        <!-- panel heading starat -->
                        <div class="panel-heading">
                            <h3 class="panel-title">Employee accounts</h3>
                            <div class="pull-right">
                            <button class="btn btn-default btn-xs btn-filter"><span class="fa fa-filter"></span> Filter</button>
                        </div>
                        </div>
                        <!-- panel heading end -->

                        <div class="panel-body">
                        <!-- panel content start -->
                           <!-- Table -->
                    <form action="deleteEmp.php" method="POST">
                        <table class="table table-hover table-bordered">
                            <thead>
                                <tr class="filters">
                                    <!-- <th><input type="text" class="form-control" placeholder="PK" disabled></th> -->
                                    <th><input type="text" class="form-control" placeholder="LastName" disabled></th>
                                    <th><input type="text" class="form-control" placeholder="FirstName" disabled></th>
                                    <th><input type="text" class="form-control" placeholder="LoginID" disabled></th>
                                    <th><input type="text" class="form-control" placeholder="Password" disabled></th>
                                    <th><input type="text" class="form-control" placeholder="Email" disabled></th>
                                    <!-- <th><input type="text" class="form-control" placeholder="Password" disabled></th>
                                    <th><input type="text" class="form-control" placeholder="Phone" disabled></th>
                                    <th><input type="text" class="form-control" placeholder="Gender" disabled></th>
                                    <th><input type="text" class="form-control" placeholder="Birthdate" disabled></th>
                                    <th><input type="text" class="form-control" placeholder="Address" disabled></th> -->
                                    <th><input type="text" class="form-control" placeholder="Delete" disabled></th>
                                </tr>
                            </thead>
                            
                            <?php 
                            $result=mysqli_query($con,"SELECT * FROM employee");
                            

                                  
                            while ($userRow=mysqli_fetch_array($result)) {
                                
                              
                                echo "<tbody>";
                                echo "<tr>";
                                    // echo "<td>" . $userRow['idEmployee'] . "</td>";
                                    echo "<td>" . $userRow['employeeLastName'] . "</td>";
                                    echo "<td>" . $userRow['employeeFirstName'] . "</td>";
                                    echo "<td>" . $userRow['employeeId'] . "</td>";
                                    echo "<td>" . $userRow['password'] . "</td>";
                                    echo "<td>" . $userRow['email'] . "</td>";
                                    // echo "<td>" . $userRow['userGender'] . "</td>";
                                    // echo "<td>" . $userRow['userDOB'] . "</td>";
                                    // echo "<td>" . $userRow['userAddress'] . "</td>";
                                    echo "<form method='POST'>";
                                    echo "<td class='text-center'><input type='checkbox' name='check[]' 
                                    value='".$userRow['idEmployee']."' class='delete'></td>";
                               
                            } 
                                echo "</tr>";
                           echo "</tbody>";
                       echo "</table>";
                       echo "<div class='panel panel-default'>";
                       echo "<div class='col-md-offset-3 pull-right'>";
                       echo "<button class='btn btn-primary'
                       name='delete'>delete</button>";
                        echo "</div>";
                        echo "</div>";
                        ?>
                        <!-- panel content end -->
                        <!-- panel end -->
                        </div>
                        </div>
                        </form>
                    <!-- panel start -->
                </div>
            </div>
        <!-- /#wrapper -->

       
        <!-- jQuery -->
        <script src="../client/assets/js/jquery.js"></script>
        <!-- <script type="text/javascript">
$(function() {
$(".delete").click(function(){
var element = $(this);
var ic = element.attr("id");
var info = 'ic=' + ic;
if(confirm("Are you sure you want to delete this?"))
{
 $.ajax({
   type: "POST",
   url: "deleteclient.php",
   data: info,
   success: function(){
 }
});
  $(this).parent().parent().fadeOut(300, function(){ $(this).remove();});
 }
return false;
});
});
</script> -->
 <script type="text/javascript">
            /*
            Please consider that the JS part isn't production ready at all, I just code it to show the concept of merging filters and titles together !
            */
            $(document).ready(function(){
                $('.filterable .btn-filter').click(function(){
                    var $panel = $(this).parents('.filterable'),
                    $filters = $panel.find('.filters input'),
                    $tbody = $panel.find('.table tbody');
                    if ($filters.prop('disabled') == true) {
                        $filters.prop('disabled', false);
                        $filters.first().focus();
                    } else {
                        $filters.val('').prop('disabled', true);
                        $tbody.find('.no-result').remove();
                        $tbody.find('tr').show();
                    }
                });

                $('.filterable .filters input').keyup(function(e){
                    /* Ignore tab key */
                    var code = e.keyCode || e.which;
                    if (code == '9') return;
                    /* Useful DOM data and selectors */
                    var $input = $(this),
                    inputContent = $input.val().toLowerCase(),
                    $panel = $input.parents('.filterable'),
                    column = $panel.find('.filters th').index($input.parents('th')),
                    $table = $panel.find('.table'),
                    $rows = $table.find('tbody tr');
                    /* Dirtiest filter function ever ;) */
                    var $filteredRows = $rows.filter(function(){
                        var value = $(this).find('td').eq(column).text().toLowerCase();
                        return value.indexOf(inputContent) === -1;
                    });
                    /* Clean previous no-result if exist */
                    $table.find('tbody .no-result').remove();
                    /* Show all rows, hide filtered ones (never do that outside of a demo ! xD) */
                    $rows.show();
                    $filteredRows.hide();
                    /* Prepend no-result row if all rows are filtered */
                    if ($filteredRows.length === $rows.length) {
                        $table.find('tbody').prepend($('<tr class="no-result text-center"><td colspan="'+ $table.find('.filters th').length +'">No result found</td></tr>'));
                    }
                });
            });
        </script>
        
        <!-- Bootstrap Core JavaScript -->
        <script src="../client/assets/js/bootstrap.min.js"></script>
        <script src="assets/js/bootstrap-clockpicker.js"></script>
        <script src="assets/js/pop.js"></script>
        <!-- Latest compiled and minified JavaScript -->
         <!-- script for jquery datatable start-->
        <!-- Include Date Range Picker -->
    </body>
</html>