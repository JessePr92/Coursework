<?php
include('security.php');

if(isset($_POST['view_contract_btn'])){
    $myfile = $_POST['view_contract_id'];
    $file = 'upload/'."$myfile";
    header('Content-type: application/php');
    header('Content-Disposition: inline; filename = "'.$myfile .'"');
    header('Content-Transfer-Encoding: binary');
    header('Accept-Ranges: bytes');
    @readfile($file);
}
?>