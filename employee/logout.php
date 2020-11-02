<?php
session_start();

if(!isset($_SESSION['employeeSession']))
{
 header("Location: employeedashboard.php");
}
else if(isset($_SESSION['employeeSession'])!="")
{
 header("Location: ../index.php");
}

if(isset($_GET['logout']))
{
 session_destroy();
 unset($_SESSION['employeeSession']);
 header("Location: ../index.php");
}
?>