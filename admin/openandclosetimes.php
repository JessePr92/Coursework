<?php 
include('security.php');
if(isset($_POST['close_date_btn']))
{
    $id = 1;
    $sem = $_POST['semester'];
    $open = $_POST['openingdate'];
    $opentime = $_POST['openingtime'];
    $close = $_POST['closingdate'];
    $closetime = $_POST['closingtime'];

    $query1 = "UPDATE opentimes 
    SET semester='$sem', openingdate='$open', openingtimes='$opentime', closingdate='$close', closingtimes='$closetime' 
    WHERE id = '$id'";
    $query_run1 = mysqli_query($con, $query1);
        if($query_run1)
        {
            $_SESSION['status'] = "Opening and closing time set for" . $sem . "semester";
            $_SESSION['status_code'] = "success";
            header('Location: editstudentdashboard.php');
        }

        else 
        {
            $_SESSION['status'] = "There was an ERROR please select an accurate date! try again";
            $_SESSION['status_code'] = "error";
            header('Location: editstudentdashboard.php');  
        }
    
}
?>

