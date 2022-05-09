<?php
include('security.php');

if(isset($_POST['viewproject'])){
    $myfile = $_POST['hidden_project'];
    $file = '../admin/upload/'."$myfile";
    header('Content-type: application/php');
    header('Content-Disposition: inline; filename = "'.$myfile .'"');
    header('Content-Transfer-Encoding: binary');
    header('Accept-Ranges: bytes');
    @readfile($file);
}

if(isset($_POST['signproject'])){
    $myfile = $_POST['hidden_sign'];
    $file = '../admin/upload/'."$myfile";
    header('Content-type: application/php');
    header('Content-Disposition: inline; filename = "'.$myfile .'"');
    header('Content-Transfer-Encoding: binary');
    header('Accept-Ranges: bytes');
    @readfile($file);
}


?>