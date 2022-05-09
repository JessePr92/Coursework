<?php

#for mailing students on allocate page
if(isset($_POST['mail_std_btn']))
{
    $sub = $_POST['mail_sub'];
    $mes = $_POST['mail_mes'];
    $attach = $_POST['mail_attach'];
    $sender = $_SESSION['admin'];
    $sender2 = $_POST['mail_cc2'];
    $headers = "From: ".$sender . "\r\n". "CC: ".$sender2;

    $query = "SELECT * FROM allocation ";
    $query_run = mysqli_query($con, $query);
    while ($row = mysqli_fetch_assoc($query_run))
    {
        $std_id = $row['std_id'];
        $std_name = $row['std_name'];
        $std_email = $row['std_email'];
        $std_allocated = $row['std_allocated'];

        $mes = wordwrap($mes,70);
        mail($std_email, $sub ,$mes,$headers);
        
        if($query_run)
        {
            //move_uploaded_file($_FILES["project_file"]["tmp_name"], "upload/".$newproject);
            
            $_SESSION['status'] = "Messsage Sent!";
            $_SESSION['status_code'] = "success";
            header('Location: index.php'); 
        }
        else
        {
            $_SESSION['status'] = "There was an Error Sending messages. Try again! or Contact support";       
            $_SESSION['status_code'] = "error";
            header('Location: index.php'); 
        }
    }

}

#for mailing students on dashboard page
if(isset($_POST['mail_std_btn2']))
{
    $sub = $_POST['mail_sub2'];
    $mes = $_POST['mail_mes2'];
    $attach = $_POST['mail_attach2'];
    $sender = $_SESSION['admin'];
    $sender2 = $_POST['mail_cc2'];
    $getstd = "Student";
    $headers = "From: ".$sender . "\r\n". "CC: ".$sender2;

    $query = "SELECT * FROM register WHERE usertype = '$getstd' ";
    $query_run = mysqli_query($con, $query);
    while ($row = mysqli_fetch_assoc($query_run))
    {
        $std_email = $row['email'];

        $mes = wordwrap($mes,70);
        mail($std_email, $sub ,$mes,$headers);
        
        if($query_run)
        {
            //move_uploaded_file($_FILES["project_file"]["tmp_name"], "upload/".$newproject);
            
            $_SESSION['status'] = "Messsage Sent!";
            $_SESSION['status_code'] = "success";
            header('Location: index.php'); 
        }
        else
        {
            $_SESSION['status'] = "There was an Error Sending messages. Try again! or Contact support";       
            $_SESSION['status_code'] = "error";
            header('Location: index.php'); 
        }
    }

}
?>