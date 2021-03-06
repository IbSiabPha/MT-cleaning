<?php
session_start();
include_once '../assets/conn/dbconnect.php';
// include_once 'connection/server.php';
if (!isset($_SESSION['employeeSession'])) {
    header("Location: ../index.php");
}
$usersession = $_SESSION['employeeSession'];
$res = mysqli_query($con, "SELECT * FROM employee WHERE employeeId=" . $usersession);
$userRow = mysqli_fetch_array($res, MYSQLI_ASSOC);
// insert


if (isset($_POST['submit'])) {
    $date = mysqli_real_escape_string($con, $_POST['date']);
    // $scheduleday=mysqli_real_escape_string($con,$_POST['scheduleday']);
    $starttime = mysqli_real_escape_string($con, $_POST['starttime']);
    $endtime = mysqli_real_escape_string($con, $_POST['endtime']);
    $bookavail = mysqli_real_escape_string($con, $_POST['bookavail']);

    //INSERT
    $query = " INSERT INTO adminschedule (scheduleDate, startTime, endTime,  bookAvail)
VALUES ( '$date', '$starttime', '$endtime', '$bookavail' ) ";

    $result = mysqli_query($con, $query);
    // echo $result;
    if ($result) {
?>
<script type="text/javascript">
alert('Schedule added successfully.');
</script>
<?php
    } else {
    ?>
<script type="text/javascript">
alert('Add fail. Please try again.');
</script>
<?php
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Welcome <?php echo $userRow['employeeFirstName']; ?></title>
    <!-- Bootstrap Core CSS -->
    <!-- <link href="assets/css/bootstrap.css" rel="stylesheet"> -->
    <link href="assets/css/material.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="assets/css/sb-admin.css" rel="stylesheet">
    <link href="assets/css/time/bootstrap-clockpicker.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet">
    <!-- Special version of Bootstrap that only affects content wrapped in .bootstrap-iso -->
    <link rel="stylesheet" href="https://formden.com/static/cdn/bootstrap-iso.css" />
    <!--Font Awesome (added because you use icons in your prepend/append)-->
    <link rel="stylesheet" href="https://formden.com/static/cdn/font-awesome/4.4.0/css/font-awesome.min.css" />
    <!-- Inline CSS based on choices in "Settings" tab -->
    <style>
    .bootstrap-iso .formden_header h2,
    .bootstrap-iso .formden_header p,
    .bootstrap-iso form {
        font-family: Arial, Helvetica, sans-serif;
        color: black
    }

    .bootstrap-iso form button,
    .bootstrap-iso form button:hover {
        color: white !important;
    }

    .asteriskField {
        color: red;
    }
    </style>
    <!-- Custom Fonts -->
</head>

<body>
    <div id="wrapper">
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="employeeDashboard.php">Welcome
                    <?php echo $userRow['employeeFirstName']; ?></a>
            </div>
            <ul class="nav navbar-right top-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i>
                        <?php echo $userRow['employeeFirstName']; ?><b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="employeeprofile.php"><i class="fa fa-fw fa-user"></i> Profile</a>
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
                        <a href="employeeDashboard.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                    </li>
                    <li class="active">
                        <a href="custschedule.php"><i class="fa fa-fw fa-table"></i> Appointment Schedule</a>
                    </li>
					<!--
                    <li>
                        <a href="clientlist.php"><i class="fa fa-fw fa-edit"></i> Client List</a>
                    </li>
					-->
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>
        <!-- navigation end -->
        <div id="page-wrapper">
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h2 class="page-header">
                            Appointment Schedule
                        </h2>
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-calendar"></i> Schedule
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- Page Heading end-->
                <!-- panel start -->
                <div class="panel panel-primary">
                    <!-- panel start -->
                    <div class="panel panel-primary filterable">
                        <!-- panel heading starat -->
                        <div class="panel-heading">
                            <h3 class="panel-title">List of Available Appointment Dates</h3>
                            <div class="pull-right">
                                <button class="btn btn-default btn-xs btn-filter"><span class="fa fa-filter"></span>
                                    Filter</button>
                            </div>
                        </div>
                        <!-- panel heading end -->
                        <div class="panel-body">
                            <!-- panel content start -->
                            <!-- Table -->
                            <table class="table table-hover table-bordered">
                                <thead>
                                    <tr class="filters">
                                        <th><input type="text" class="form-control" placeholder="Schedule ID" disabled>
                                        </th>
                                        <th><input type="text" class="form-control" placeholder="Schedule Date"
                                                disabled></th>
                                        <th><input type="text" class="form-control" placeholder="Start Time." disabled>
                                        </th>
                                        <th><input type="text" class="form-control" placeholder="End Time" disabled>
                                        </th>
                                        <th><input type="text" class="form-control" placeholder="Available" disabled>
                                        </th>
                                    </tr>
                                </thead>
                                <?php
                                $result = mysqli_query($con, "SELECT * FROM adminschedule where employeeId ='$usersession' ");
                                while ($adminschedule = mysqli_fetch_array($result)) {
                                    echo "<tbody>";
                                    echo "<tr>";
                                    echo "<td>" . $adminschedule['scheduleId'] . "</td>";
                                    echo "<td>" . $adminschedule['scheduleDate'] . "</td>";
                                    echo "<td>" . $adminschedule['startTime'] . "</td>";
                                    echo "<td>" . $adminschedule['endTime'] . "</td>";
                                    echo "<td>" . $adminschedule['bookAvail'] . "</td>";
                                    echo "<form method='POST'>";
                                }
                                echo "</tr>";
                                echo "</tbody>";
                                echo "</table>";
                                ?>
                                <!-- panel content end -->
                                <!-- panel end -->
                        </div>
                    </div>
                    <!-- panel start -->
                </div>
            </div>
            <!-- /#wrapper -->
            <!-- jQuery -->
            <script src="../assets/js/jquery.js"></script>
            <!-- Bootstrap Core JavaScript -->
            <script src="../assets/js/bootstrap.min.js"></script>
            <script src="../assets/js/bootstrap-clockpicker.js"></script>
            <!-- Latest compiled and minified JavaScript -->
            <!-- script for jquery datatable start-->
            <!-- Include Date Range Picker -->
            <script type="text/javascript"
                src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js">
            </script>
            <link rel="stylesheet"
                href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css" />
            <script>
            $(document).ready(function() {
                var date_input = $('input[name="date"]'); //our date input has the name "date"
                var container = $('.bootstrap-iso form').length > 0 ? $('.bootstrap-iso form').parent() :
                    "body";
                date_input.datepicker({
                    format: 'yyyy/mm/dd',
                    container: container,
                    todayHighlight: true,
                    autoclose: true,
                })
            })
            </script>
            <script type="text/javascript">
            $('.clockpicker').clockpicker();
            </script>
            <script type="text/javascript">
            $(function() {
                $(".delete").click(function() {
                    var element = $(this);
                    var id = element.attr("id");
                    var info = 'id=' + id;
                    if (confirm("Are you sure you want to delete this?")) {
                        $.ajax({
                            type: "POST",
                            url: "deleteschedule.php",
                            data: info,
                            success: function() {}
                        });
                        $(this).parent().parent().fadeOut(300, function() {
                            $(this).remove();
                        });
                    }
                    return false;
                });
            });
            </script>
            <script type="text/javascript">
            /*
            Please consider that the JS part isn't production ready at all, I just code it to show the concept of merging filters and titles together !
            */
            $(document).ready(function() {
                $('.filterable .btn-filter').click(function() {
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
                $('.filterable .filters input').keyup(function(e) {
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
                    var $filteredRows = $rows.filter(function() {
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
                        $table.find('tbody').prepend($(
                            '<tr class="no-result text-center"><td colspan="' + $table.find(
                                '.filters th').length + '">No result found</td></tr>'));
                    }
                });
            });
            </script>
</body>

</html>