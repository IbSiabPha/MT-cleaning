<?php
include_once 'assets/conn/dbconnect.php';

session_start();
if (isset($_SESSION['employeeSession']) != "") {
    header("Location: employee/employeedashboard.php");
}
if (isset($_POST['login'])) {
    $employeeId = $_POST['employeeId'];
    $password  = $_POST['password'];

    if (empty($employeeId) || empty($password)) {
        header("location: employeedashboard.php?error=emptyuser");
        exit();
    } else {
        $res = "SELECT * FROM employee WHERE employeeId = ? OR email=?;";
        $stmt = mysqli_stmt_init($con);
        if (!mysqli_stmt_prepare($stmt, $res)) {
            header("location: employeedashboard.php?error=sqlerror");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "ss", $employeeId, $employeeId);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if ($row = mysqli_fetch_assoc($result)) {  //NOTE: need to check if username is false and pass is true
                $check_pwd = password_verify($password, $row['password']);
                $check_user = $row['employeeID']; //check user pass with database pass
                if ($check_pwd == false) { //if failed, redirect to home
                    header("location: employeelogin.php?error=wrong");
                    exit();
                } elseif ($check_pwd == true) { //if true, login user in
                    // session_start();
                    $_SESSION['employeeSession'] = $row['employeeId'];
                    // $_SESSION['userName'] = $row['user_name'];
                    // $_SESSION['img'] = $row['image'];
?>
<script type="text/javascript">
alert('Login Success');
</script>
<?php
                    header("Location: employee/employeedashboard.php");
                } else {
                ?>
<!-- <script type="text/javascript">
                        alert("Wrong input");
                    </script> -->
<?php
                }
                // }else{
                //     header("location: employeelogin.php?error=nouser");
                //     exit(); 
                //    }
                // }
            }
        }
        ?>
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
            <?php if (isset($_GET['error'])) {
                if ($_GET['error'] == 'emptyuser') {
                    echo "<p class='errorMsg'>Fill all box</p>";
                } elseif ($_GET['error'] == 'sqlerror') {
                    echo "<p class='errorMsg'>database error</p>";
                } elseif ($_GET['error'] == 'wrong') {
                    echo "<p class='errorMsg'>wrong input</p>";
                }
            }
            // if(isset($_GET['signup'])){
            //     if($_GET['signup'] == 'success'){
            //     echo "<p class='goodMsg'>account created</p>";}
            // } 
            ?>
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