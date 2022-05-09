<?php
session_start();
include('database/dbconfig.php');

if($con)
{
    // echo "Database Connected";
}
else
{
    header("Location: database/dbconfig.php");
}
// get username during session
if(!$_SESSION['username'])
{
    header('Location: ../securitylogin.php');
}
?>