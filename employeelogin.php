<?php
include_once 'assets/conn/dbconnect.php';

session_start();
if (isset($_SESSION['employeeSession']) != "") {
header("Location: employee/employeedashboard.php");
}
if (isset($_POST['login']))
{
$employeeId = mysqli_real_escape_string($con,$_POST['employeeId']);
$password  = mysqli_real_escape_string($con,$_POST['password']);

$res = mysqli_query($con,"SELECT * FROM employee WHERE employeeId = '$employeeId'");

$row=mysqli_fetch_array($res,MYSQLI_ASSOC);
// echo $row['password'];
if ($row['password'] == $password)
{
$_SESSION['employeeSession'] = $row['employeeId'];
?>
<script type="text/javascript">
alert('Login Success');
</script>
<?php
header("Location: employee/employeedashboard.php");
} else {
?>
<script type="text/javascript">
    alert("Wrong input");
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
        <title>MT Cleaning</title>
        <link href="assets/css/bootstrap.min.css" rel="stylesheet">
        <link href="assets/css/style2.css" rel="stylesheet">
    </head>
    <body>
        <div class="container">
            <div class="login-container">
                    <div id="output"></div>
                    <div class="avatar"></div>
                    <div class="form-box">
                        <form class="form" role="form" method="POST" accept-charset="UTF-8">
                            <input name="employeeId" type="text" placeholder="Employee ID" required>
                            <input name="password" type="password" placeholder="Password" required>
                            <button class="btn btn-info btn-block login" type="submit" name="login">Login</button>
                        </form>
                    </div>
                </div>
        </div>
        <script src="assets/js/jquery.js"></script>
    </body>
</html>