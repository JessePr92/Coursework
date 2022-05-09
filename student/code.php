<?php
include('security.php');


if(isset($_POST['registerbtn']))
{
    
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cpassword = $_POST['confirmpassword'];
    $usertype = $_POST['usertype'];
    
    $email_query = "SELECT * FROM register WHERE email='$email' ";
    $email_query_run = mysqli_query($con, $email_query);
    if(mysqli_num_rows($email_query_run) > 0)
    {
        $_SESSION['status'] = "Email Already Taken. Please Try Another one.";
        $_SESSION['status_code'] = "error";
        header('Location: register.php');  
    }
    else
    {
        if($password === $cpassword)
        {
            $query = "INSERT INTO register (username,email,password,usertype) VALUES ('$username','$email','$password','$usertype')";
            $query_run = mysqli_query($connection, $query);
            
            if($query_run)
            {
                // echo "Saved";
                $_SESSION['status'] = "Admin Profile Added";
                $_SESSION['status_code'] = "success";
                header('Location: register.php');
            }
            else 
            {
                $_SESSION['status'] = "Admin Profile Not Added";
                $_SESSION['status_code'] = "error";
                header('Location: register.php');  
            }
        }
        else 
        {
            $_SESSION['status'] = "Password and Confirm Password Does Not Match";
            $_SESSION['status_code'] = "warning";
            header('Location: register.php');  
        }
    }

}
#for the edit and update button
if(isset($_POST['updatebtn']))
{
    $id = $_POST['edit_id'];
    $username = $_POST['edit_username'];
    $email = $_POST['edit_email'];
    $password = $_POST['edit_password'];
    $usertypeupdate = $_POST['update_usertype'];

    $query = "UPDATE register SET username='$username', email='$email', password='$password' , usertype='$usertypeupdate' WHERE id='$id' ";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $_SESSION['status'] = "Your Data is Updated";
        $_SESSION['status_code'] = "success";
        header('Location: register.php'); 
    }
    else
    {
        $_SESSION['status'] = "Your Data is NOT Updated";
        $_SESSION['status_code'] = "error";
        header('Location: register.php'); 
    }
}
#for the delete button
if(isset($_POST['delete_btn']))
{
    $id = $_POST['delete_id'];

    $query = "DELETE FROM register WHERE id='$id' ";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $_SESSION['status'] = "Your Data is Deleted";
        $_SESSION['status_code'] = "success";
        header('Location: register.php'); 
    }
    else
    {
        $_SESSION['status'] = "Your Data is NOT DELETED";       
        $_SESSION['status_code'] = "error";
        header('Location: register.php'); 
    }    
}

#for selected projects on student dashbboard
if(isset($_POST['selected_project']))
{
    $id = $_POST['id'];
    $select = $_POST['selected'];

    $query = "UPDATE details SET selected = '$select' WHERE id = '$id' ";
    $query_run = mysqli_query($con, $query);
}

if(isset($_POST['confim_project_selection']))
{
    //$currentUser = $_SESSION['username'];
    $id = "1";
    //$choices = 0;
    $query = "INSERT INTO studentsSelection (id, supervisor, title)
    SELECT id, supervisor, title FROM details WHERE selected = '$id'";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $_SESSION['status'] = "Supervisor Profile Deleted";
        $_SESSION['status_code'] = "success";
        header('Location: studentlist.php');
    }

    else 
    {
        $_SESSION['status'] = "There was an ERROR adding this data. try again";
        $_SESSION['status_code'] = "error";
        header('Location: index.php');  
    }


}


if(isset($_POST['confirm_selection']))
{
    $stdemail = $_SESSION['username'];
    $project_Array_id = array_column($_SESSION["ppp"], "project_id");
    foreach($project_Array_id as $keys => $values)  
          { 
              $un = json_encode($project_Array_id);
             
          }
     echo $un;
    $query2 = "SELECT * FROM stdChoices WHERE std_email = '$stdemail'";
    $query_run2 = mysqli_query($con, $query2);


    if (mysqli_num_rows($query_run2) > 0){

        $query3 = "UPDATE stdChoices SET choices = '$un' WHERE std_email = '$stdemail'";
        $query_run3 = mysqli_query($con, $query3); 
        $_SESSION['status'] = "Successfull submission";
                $_SESSION['status_code'] = "success";
                header('Location: studentlist.php');

    }
    else
    {
        $query = "INSERT INTO stdChoices (std_id, std_name, std_email,choices)
        SELECT studentno, username, email, password FROM register WHERE email = '$stdemail'";
        $query_run = mysqli_query($con, $query);
        if($query_run){
           
            $query4 = "UPDATE stdChoices SET choices = '$un' WHERE std_email = '$stdemail'";
            $query_run4 = mysqli_query($con, $query4); 
            $_SESSION['status'] = "Successfull submission";
                $_SESSION['status_code'] = "success";
                header('Location: studentlist.php');
        }
    }
  
    
}
#download drop form
if(isset($_POST['download_drop_form']))
{
    $myfile = 'dropform.pdf';
    $file = '../admin/upload/'."$myfile";
    header('Content-type: application/php');
    header('Content-Disposition: inline; filename = "'.$myfile .'"');
    header('Content-Transfer-Encoding: binary');
    header('Accept-Ranges: bytes');
    @readfile($file);
}
#upload drop form
if(isset($_POST['upload_drop_form']))
{
    $drop_file = $_FILES["std_drop_form"]['name'];
    $std_email = $_SESSION['username'];
    $query = "SELECT * FROM register WHERE email = '$std_email'";
    $query_run = mysqli_query($con, $query);
    $getStd_details = mysqli_num_rows($query_run);
        
    if($getStd_details > 0)
    {
        while($std = mysqli_fetch_assoc($query_run))
        {
            $std_name = $std['username'];
            $std_no = $std['studentno'];
            $status = "pending"; 
                
            $temp = explode(".", $_FILES["std_drop_form"]["name"]);
            $newfilename = $std_no . " dropform" . '.' . end($temp);
            move_uploaded_file($_FILES["std_drop_form"]["tmp_name"], "../admin/upload/".$newfilename);

            $query2 = "INSERT INTO add_drop (`std_id`, `std_name`, `std_email`, `drop_file`, `status`) 
            VALUES ('$std_no', '$std_name', '$std_email', '$newfilename', '$status')";
            $query_run2 = mysqli_query($con, $query2);

            if ($query_run2)
            {
                $msg = "Dear $std_name \nYou have successfully uploaded the file  $drop_file \n
                The course coordinator would be in touch with you for more guidiance and information.\n
                \n EUC SENIOR PROJECT ADMIN.";
                $msg = wordwrap($msg,70);
                mail($std_email, "SENIOR PROJECT ALLOCATION",$msg);

                $_SESSION['status'] = "Successful upload";
                $_SESSION['status_code'] = "success";
                header('Location: studentdropform.php');
            }
        }
            
    }
    
    else
    {
        $_SESSION['status'] = "There was an Error. Try again or contact support!";       
        $_SESSION['status_code'] = "error";
        header('Location: studentdropform.php'); 
    }
}
#upload contract
if(isset($_POST['upload_contract']))
{
    $contract_file = $_FILES["std_contract"]['name'];
    $std_email = $_SESSION['username'];
    $query = "SELECT * FROM register WHERE email = '$std_email'";
    $query_run = mysqli_query($con, $query);
    $getStd_details = mysqli_num_rows($query_run);
        
    if($getStd_details > 0)
    {
        while($std = mysqli_fetch_assoc($query_run))
        {
            $std_name = $std['username'];
            $std_no = $std['studentno'];
                
            $temp = explode(".", $_FILES["std_contract"]["name"]);
            $newfilename = $std_no . " contract" . '.' . end($temp);
            move_uploaded_file($_FILES["std_contract"]["tmp_name"], "../admin/upload/".$newfilename);

            $query2 = "UPDATE allocation SET contract = '$newfilename' WHERE `std_id`= '$std_no'";
            $query_run2 = mysqli_query($con, $query2);

            if ($query_run2)
            {
                
                $msg = "Dear $std_name \nYou have successfully uploaded the file  $contract_file \n
                The course coordinator would be in touch with you for more guidiance and information.\n
                \n EUC SENIOR PROJECT ADMIN.";
                $msg = wordwrap($msg,70);
                mail($std_email, "SENIOR PROJECT ALLOCATION",$msg);

                $_SESSION['status'] = "Successful upload";
                $_SESSION['status_code'] = "success";
                header('Location: myproject.php');
            }
        }
            
    }
    
    else
    {
        $_SESSION['status'] = "There was an Error. Try again or contact support!";       
        $_SESSION['status_code'] = "error";
        header('Location: myproject.php'); 
    }
}
# update user profile
if(isset($_POST['update_profile_btn']))
{
    $new_password = $_POST['edit_profile_password'];
    $new_cpassword = $_POST['edit_profile_cpassword'];
    $new_id = $_POST['edit_profile_id'];
    $new_email = $_SESSION['username'];
    $new_std_id = $_POST['edit_profile_stdno'];
    #change project file name
    $temp = explode(".", $_FILES["edit_profile_img"]["name"]);
    $new_img = $new_std_id . " img" . '.' . end($temp);

    if($new_password === $new_cpassword)
    {
        $query = "UPDATE register SET password = '$new_password', img = '$new_img'
        WHERE id = '$new_id'";
        $query_run = mysqli_query($con, $query);
        if($query_run)
        {
            move_uploaded_file($_FILES["edit_profile_img"]["tmp_name"], "../admin/upload/".$new_img);
            #display alerts
            $_SESSION['status'] = "Profile updated";
            $_SESSION['status_code'] = "success";
            header('Location: index.php');

        }
        else 
        {
            $_SESSION['status'] = "Error updating user profile! try again or contact support";
            $_SESSION['status_code'] = "error";
            header('Location: profile.php');
        }
    }
    else 
    {
        $_SESSION['status'] = "Error: Passwords do not match.";
        $_SESSION['status_code'] = "error";
        header('Location: profile.php');
    }   

    


}

?>