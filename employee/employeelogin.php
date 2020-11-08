<?php
if (isset($_POST['login'])){
require 'assets/conn/dbconnect.php';
    $employeeId =$_POST['employeeId'];
    $password  = $_POST['password'];
    
    if(empty( $employeeId) || empty($password)){
        header("location: employeedashboard.php?error=emptyuser");
        exit(); 
    }else{
        $res ="SELECT * FROM employee WHERE employeeId = '?' OR email = ?;";
        $stmt = mysqli_stmt_init($con);
        if (!mysqli_stmt_prepare($stmt, $res)){
            header("location: employeedashboard.php?error=sqlerror");
            exit();
        }else{
            mysqli_stmt_bind_param($stmt, "ss", $employeeId, $employeeId);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
    
            if($row = mysqli_fetch_assoc($result)){  //NOTE: need to check if username is false and pass is true
                $check_pwd = password_verify($uPwd, $row['password']);
                $check_user = $row['employeeId']; //check user pass with database pass
                if($check_pwd == false){ //if failed, redirect to home
                    header("location: ../index.php?error=wrongpassword");
                    exit(); 
                }
                elseif($check_pwd == true){ //if true, login user in
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
                    }else {
                    ?>
                    <script type="text/javascript">
                        alert("Wrong input");
                    </script>
                 <?php   
                }
                }else{
                    header("location: ../index.php?error=nouser");
                    exit(); 
                   }
                }
            }
        }
    ?>

include_once 'assets/conn/dbconnect.php';

session_start();
if (isset($_SESSION['employeeSession']) != "") {
header("Location: employee/employeedashboard.php");
}

if (isset($_POST['login']))
{
    $employeeId =$_POST['employeeId'];
    $password  = $_POST['password'];
    
    if(empty($employeeId) || empty($password )){
        header("location: employeedashboard.php?error=emptyuser");
        exit(); 
    }else{
        $res ="SELECT * FROM employee WHERE employeeId = '?' OR email=?;";
        $stmt = mysqli_stmt_init($con);
        if (!mysqli_stmt_prepare($stmt, $res)){
            header("location: employeedashboard.php?error=sqlerror");
            exit();
        }else{
            mysqli_stmt_bind_param($stmt, "ss", $employeeId, $employeeId);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
    
            if($row = mysqli_fetch_assoc($result)){  //NOTE: need to check if username is false and pass is true
                $check_pwd = password_verify($uPwd, $row['user_pass']);
                $check_user = $row['user_name']; //check user pass with database pass
                if($check_pwd == false){ //if failed, redirect to home
                    header("location: ../index.php?error=wrongpassword");
                    exit(); 
                }
                elseif($check_pwd == true){ //if true, login user in
                    session_start();
                    $_SESSION['employeeSession'] = $row['employeeId'];
                    // $_SESSION['userName'] = $row['user_name'];
                    // $_SESSION['img'] = $row['image'];
                    ?>
                    <script type="text/javascript">
                        alert('Login Success');
                    </script>
                    <?php
                    header("Location: employee/employeedashboard.php");
                    }else {
                    ?>
                    <script type="text/javascript">
                        alert("Wrong input");
                    </script>
                 <?php   
                }
                }else{
                    header("location: ../index.php?error=nouser");
                    exit(); 
                   }
                }
            }
        }