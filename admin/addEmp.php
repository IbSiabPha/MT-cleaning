<?php 

if(isset($_POST['uSubmit'])){
    require '../assets/conn/dbconnect.php';

 $first = mysqli_real_escape_string($con, $_POST['employeeFirstName']);
 $last = mysqli_real_escape_string($con, $_POST['employeeLastName']);
 $userName = mysqli_real_escape_string($con, $_POST['employeeId']);
 $email = mysqli_real_escape_string($con, $_POST['email']);
 $pwd = mysqli_real_escape_string($con, $_POST['pwd']);
 $re_pwd = mysqli_real_escape_string($con, $_POST['re-pwd']);

    //check if filed are empty
 if(empty($first) || empty($last) || empty($userName) || empty($pwd )){
     header("location: employeelist.php?error=emptyfields&first=".$first."&mail=".$userName);
     exit(); // stop code below execution if this fails 
 }// check for valid email and username
elseif (!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $userName)){
    header("location: employeelist.php?error=invalideu&sername");
    exit(); 
}
 elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){ //check for valid email
     header("location: employeelist.php?error=invalidemail&first=".$first);
     exit(); 
 }
elseif(!preg_match("/^[a-zA-Z0-9]*$/", $userName)){ //check for valid username
    header("location: employeelist.php?error=invalidusername&mail=".$email); //send back email so user don't have to type
    exit(); 
}
elseif($pwd !== $re_pwd){ //check if retype password match
    header("location: employeelist.php?error=passwordcheck&username=".$userName."&mail=".$email);
    exit(); 
}
else{ //check if username exist already
    $sql = "SELECT employeeId FROM employee WHERE employeeId=?"; //? is place holder
    $stmt = mysqli_stmt_init($con);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: employeelist.php?error=sqlerror");
        exit(); 
    }
    else{//take info from user check and send to database
        mysqli_stmt_bind_param($stmt, "s", $userName); //string = s, integer = i, blob = b, double = d (data type), "s" correspond to ? plach holder, if ther are two ? then two ss is needed
        mysqli_stmt_execute($stmt);  // takes user data and run it with sql statment             
        mysqli_stmt_store_result($stmt); //take result and store back into stmt     
        $check_result = mysqli_stmt_num_rows($stmt); //how many match return
        if($check_result > 0){

            header("location: employeelist.php?error=usertaken&email=" .$email);
            exit();
        }
        else{
            $sql = "INSERT INTO employee(password, employeeId, email, employeeFirstName, employeeLastName) values(?,?,?,?,?)";
            $stmt = mysqli_stmt_init($con);
            if (!mysqli_stmt_prepare($stmt, $sql)){ //if there is an error 
                header("location: employeelist.php?error=sqlerror");
                exit(); 
            }
            else{
                $pwdhash = password_hash($pwd, PASSWORD_DEFAULT); //hash password with password_hash function
                mysqli_stmt_bind_param($stmt, "sssss", $pwdhash, $userName, $email, $first, $last); //string = s, integer = i, blob = b, double = d (data type)
                mysqli_stmt_execute($stmt);               //"s" correspond to ? plach holder, if ther are two ? then two ss is needed
                header("location: employeelist.php?signup=success");
                exit(); 
            }
        }                                          
    }                                      
}
mysqli_stmt_close($stmt);
mysqli_close($con);      
}
else{
    header("location: ../index.php");
    exit(); 
}