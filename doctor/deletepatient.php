<?php
include_once '../assets/conn/dbconnect.php';
// Get the variables.
$idUser = $_POST['ic'];
// echo $appid;

$delete = mysqli_query($con,"DELETE FROM patient WHERE idUser=$idUser");
// if(isset($delete)) {
//    echo "YES";
// } else {
//    echo "NO";
// }



?>

