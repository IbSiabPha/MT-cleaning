<?php
require '../assets/conn/dbconnect.php';
if (isset($_POST['delete'])) { //delete user table
    $id = $_POST['check'];
    foreach ($id as $key => $value) {
        $sql = "DELETE FROM employee WHERE idEmployee = {$value}";
        if ($results = mysqli_query($con, $sql)) {
            header("Location: employeelist.php?deleteSuccess");
            // exit();
        } else {
            header("Location: edit-user-page.php?error=fail");
            // exit();
        }
    }
}