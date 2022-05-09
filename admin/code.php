<?php
include('security.php');

#for adding a new user
if(isset($_POST['user_btn']))
{
    
    $name = $_POST['username'];
    $email =$_POST['email'];
    $password = $_POST['password'];
    $cpassword = $_POST['confirmpassword'];
    $std_no = $_POST['std_no'];
    $user_image = $_FILES["user_img"]['name'];
    $email_query1 = "SELECT * FROM register WHERE email='$email' ";
    $email_query_run1 = mysqli_query($con, $email_query1);
    if(mysqli_num_rows($email_query_run1) > 0)
    {
        $_SESSION['status'] = "Email Already Exists.";
        $_SESSION['status_code'] = "error";
        header('Location: user.php');
    }
    else
    {
        if(strpos($email,'euc.ac.cy') !==false)
        {
            if($password === $cpassword)
            {
                if(strpos($password,'spadmin') !==false)
                {
                    if (strpos($std_no,'admin')!==false ||strpos($std_no,'Admin')!==false  )
                    {
                        $usertype = "admin";
                        $ano = $name.$usertype;
                        $temp = explode(".", $_FILES["supervisor_image_file"]["name"]);
                        $newfilename = $name . " photo" . '.' . end($temp);
                        $user_query = "INSERT INTO register (username,email,password,usertype,studentno,img) 
                        VALUES ('$name','$email','$password','$usertype','$ano','$newfilename')";
                        $user_query_run = mysqli_query($con, $user_query);
                        if($query_run)
                        {
                            move_uploaded_file($_FILES["user_img"]["tmp_name"], "upload/".$newfilename);
                            $_SESSION['status'] = "Admin Profile Added";
                            $_SESSION['status_code'] = "success";
                            header('Location: user.php');
                        }
                        else 
                        {
                            $_SESSION['status'] = "Admin Profile Not Added";
                            $_SESSION['status_code'] = "error";
                            header('Location: user.php');  
                        }
                    }
                    else 
                    {
                        $_SESSION['status'] = "Admin Profile not added";
                        $_SESSION['status_code'] = "error";
                        header('Location: user.php');  
                    }
                }
                if(strpos($email,'students')!==false || strpos($email,'20')!==false)
                {
                    if (strlen($std_no) < 7)
                    {
                        $std_query1 = "SELECT * FROM register WHERE studentno='$std_no' ";
                        $std_query_run1 = mysqli_query($con, $std_query1);
                        if(mysqli_num_rows($std_query_run1) > 0)
                        {
                            $_SESSION['status'] = "User already exist. Check student no";
                            $_SESSION['status_code'] = "error";
                            header('Location: user.php');
                        }
                    }
                    else
                    {
                        $usertype_student = "Student";
                        $temp = explode(".", $_FILES["supervisor_image_file"]["name"]);
                        $newfilename = $name . " photo" . '.' . end($temp);
                        $std_query = "INSERT INTO register (username,email,password,usertype,studentno,img) 
                        VALUES ('$name','$email','$password','$usertype_student','$std_no','$newfilename')";
                        $std_query_run = mysqli_query($con, $std_query);
                        if($std_query_run)
                        {
                            move_uploaded_file($_FILES["user_img"]["tmp_name"], "upload/".$newfilename);
                            $_SESSION['status'] = "Student Profile Added";
                            $_SESSION['status_code'] = "success";
                            header('Location: user.php');
                        }
                        else 
                        {
                            $_SESSION['status'] = "Student Profile Not Added";
                            $_SESSION['status_code'] = "error";
                            header('Location: user.php');  
                        }
                    }
                }
                else if (strpos($std_no,'supervisor')!==false || strpos($std_no,'Supervisor')!==false)
                {
                    $usertype_supervisor = "Supervisor";
                    $no = $name.$std_no;
                    $temp = explode(".", $_FILES["supervisor_image_file"]["name"]);
                    $newfilename = $name . " photo" . '.' . end($temp);
                    $sup_query = "INSERT INTO register (username,email,password,usertype,studentno,img) 
                    VALUES ('$name','$email','$password','$usertype_supervisor', '$no', '$newfilename')";
                    $sup_query_run = mysqli_query($con, $sup_query);
                    if($sup_query_run)
                    {
                        move_uploaded_file($_FILES["user_img"]["tmp_name"], "upload/".$newfilename);
                        $_SESSION['status'] = "Supervisor Profile Added";
                        $_SESSION['status_code'] = "success";
                        header('Location: user.php');
                    }
                    else 
                    {
                        $_SESSION['status'] = "Supervisor Profile Not Added";
                        $_SESSION['status_code'] = "error";
                        header('Location: user.php');  
                    }
                }
                    
            }
            else 
            {
                $_SESSION['status'] = "Passwords do not match.";
                $_SESSION['status_code'] = "error";
                header('Location: user.php');  
            }
    }
        else 
            {
                $_SESSION['status'] = "Email is not a valid EUC email! try again or contact support";
                $_SESSION['status_code'] = "error";
                header('Location: user.php');  
            }
    }
}
#for the edit/update button
if(isset($_POST['updatebtn']))
{
    $id = $_POST['edit_id'];
    $username = $_POST['edit_username'];
    $email = $_POST['edit_email'];
    $password = $_POST['edit_password'];
    $studentno = $_POST['edit_stdno'];
    $image = $_FILES["edit_user_img"]['name'];
    $usertypeupdate = $_POST['update_usertype'];

    $img_query = "SELECT * FROM register WHERE id = '$id'";
    $img_query_run  = mysqli_query($con, $img_query);
        
        if (mysqli_num_rows($img_query_run)>0)
        {
            $img = mysqli_fetch_array($img_query_run);
            $sup_img = $img['img'];
            #change image file name
            $temp = explode(".", $_FILES["edit_user_img"]["name"]);
            $newimg = $username . " photo" . '.' . end($temp);

            $query = "UPDATE register SET username='$username', email='$email', password='$password',
            usertype='$usertypeupdate', studentno = '$studentno' WHERE id='$id' ";
            $query_run = mysqli_query($con, $query);

            if($query_run)
            {
                move_uploaded_file($_FILES["edit_user_img"]["tmp_name"], "upload/".$newimg);
                $_SESSION['status'] = "User Data is Updated";
                $_SESSION['status_code'] = "success";
                header('Location: users.php'); 
            }
            else
            {
                $_SESSION['status'] = "There was an Error. Try again";
                $_SESSION['status_code'] = "error";
                header('Location: users.php'); 
            }
        }
}
#for the delete user button
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
        $_SESSION['status'] = "There was an Error. Try again";       
        $_SESSION['status_code'] = "error";
        header('Location: register.php'); 
    }    
}

#for the delete project button
if(isset($_POST['delete_pro_btn']))
{
    $id = $_POST['delete_pro_id'];

    $query = "DELETE FROM details WHERE id='$id' ";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $_SESSION['status'] = "Project Data is Deleted";
        $_SESSION['status_code'] = "success";
        header('Location: editstudentdashboard.php'); 
    }
    else
    {
        $_SESSION['status'] = "There was an Error. Try again! try again or contact support";       
        $_SESSION['status_code'] = "error";
        header('Location: editstudentdashboard.php'); 
    }    
}

#for adding a new project
if(isset($_POST['addproject_btn']))
{
    $supervisor_name = $_POST['supervisor_name'];
    $project_title = $_POST['project_title'];
    $project_file = $_FILES["project_file"]['name'];
    $video_file = $_FILES["video_file"]['name'];
    $contract_file = $_FILES["contract_file"]['name'];
    
    $project_status = $_POST['project_status'];

    if(file_exists("projectuploads/" . $_FILES["project_file"]["name"]))
    {
        $store = $_FILES["project_file"]["name"];
        $_SESSION["status"] = "File already exists. '.$store.'";
        $_SESSION['status_code'] = "error";
        header('Location: editstudentdashboard.php'); 
    }
    else if(file_exists("projectuploads/" . $_FILES["video_file"]["name"]))
    {
        $store = $_FILES["video_file"]["name"];
        $_SESSION["status"] = "File already exists. '.$store.'";
        $_SESSION['status_code'] = "error";
        header('Location: editstudentdashboard.php'); 
    }
    else if(file_exists("projectuploads/" . $_FILES["contract_file"]["name"]))
    {
        $store = $_FILES["contract_file"]["name"];
        $_SESSION["status"] = "File already exists. '.$store.'";
        $_SESSION['status_code'] = "error";
        header('Location: editstudentdashboard.php'); 
    }

    else
    {
        
        $supervisor_img_query = "SELECT * FROM register WHERE username = '$supervisor_name'";
        $supervisor_img_query_run  = mysqli_query($con, $supervisor_img_query);
        
        if (mysqli_num_rows($supervisor_img_query_run)>0)
        {
            $img = mysqli_fetch_array($supervisor_img_query_run);
            $sup_img = $img['img'];
            $pro_id = $img['id'];
            #change project file name
            $temp = explode(".", $_FILES["project_file"]["name"]);
            $newproject = $pro_id . " project" . '.' . end($temp);
            #change video file name
            $temp = explode(".", $_FILES["video_file"]["name"]);
            $newvideo = $pro_id . " video" . '.' . end($temp);
            #change contract file name
            $temp = explode(".", $_FILES["contract_file"]["name"]);
            $newcontract = $pro_id . " contract" . '.' . end($temp);

            $query = "INSERT INTO details (`project`,`video`,`contract`,`title`,`supervisor`,`status`,`supervisorImg`) 
            VALUES ('$newproject','$newvideo','$newcontract','$project_title', '$supervisor_name', '$project_status', '$sup_img')";
            $query_run = mysqli_query($con, $query);

            if($query_run)
            {
                move_uploaded_file($_FILES["project_file"]["tmp_name"], "upload/".$newproject);
                move_uploaded_file($_FILES["video_file"]["tmp_name"], "upload/".$newvideo);
                move_uploaded_file($_FILES["contract_file"]["tmp_name"], "upload/".$newcontract);
                
                $_SESSION['status'] = "Project Added";
                $_SESSION['status_code'] = "success";
                header('Location: editstudentdashboard.php'); 
            }
            else
            {
                $_SESSION['status'] = "There was an Error. Try again! or Contact support";       
                $_SESSION['status_code'] = "error";
                header('Location: editstudentdashboard.php'); 
            }
        }
    }

}

#supervisor add project on supprojects
if(isset($_POST['super_project_btn']))
{
    $supervisor_name = $_POST['supervisor_name'];
    $project_title = $_POST['project_title'];
    $project_file = $_FILES["project_file"]['name'];
    $video_file = $_FILES["video_file"]['name'];
    $contract_file = $_FILES["contract_file"]['name'];
    
    $project_status = $_POST['project_status'];

    if(file_exists("projectuploads/" . $_FILES["project_file"]["name"]))
    {
        $store = $_FILES["project_file"]["name"];
        $_SESSION["status"] = "File already exists. '.$store.'";
        $_SESSION['status_code'] = "error";
        header('Location: supprojects.php'); 
    }
    else if(file_exists("projectuploads/" . $_FILES["video_file"]["name"]))
    {
        $store = $_FILES["video_file"]["name"];
        $_SESSION["status"] = "File already exists. '.$store.'";
        $_SESSION['status_code'] = "error";
        header('Location: supprojects.php'); 
    }
    else if(file_exists("projectuploads/" . $_FILES["contract_file"]["name"]))
    {
        $store = $_FILES["contract_file"]["name"];
        $_SESSION["status"] = "File already exists. '.$store.'";
        $_SESSION['status_code'] = "error";
        header('Location: supprojects.php'); 
    }

    else
    {
        
        $supervisor_img_query = "SELECT * FROM register WHERE username = '$supervisor_name'";
        $supervisor_img_query_run  = mysqli_query($con, $supervisor_img_query);
        
        if (mysqli_num_rows($supervisor_img_query_run)>0)
        {
            $img = mysqli_fetch_array($supervisor_img_query_run);
            $sup_img = $img['img'];
            $pro_id = $img['id'];
            #change project file name
            $temp = explode(".", $_FILES["project_file"]["name"]);
            $newproject = $pro_id . " project" . '.' . end($temp);
            #change video file name
            $temp = explode(".", $_FILES["video_file"]["name"]);
            $newvideo = $pro_id . " video" . '.' . end($temp);
            #change contract file name
            $temp = explode(".", $_FILES["contract_file"]["name"]);
            $newcontract = $pro_id . " contract" . '.' . end($temp);

            $query = "INSERT INTO details (`project`,`video`,`contract`,`title`,`supervisor`,`status`,`supervisorImg`) 
            VALUES ('$newproject','$newvideo','$newcontract','$project_title', '$supervisor_name', '$project_status', '$sup_img')";
            $query_run = mysqli_query($con, $query);

            if($query_run)
            {
                move_uploaded_file($_FILES["project_file"]["tmp_name"], "upload/".$newproject);
                move_uploaded_file($_FILES["video_file"]["tmp_name"], "upload/".$newvideo);
                move_uploaded_file($_FILES["contract_file"]["tmp_name"], "upload/".$newcontract);
                
                $_SESSION['status'] = "Project Added";
                $_SESSION['status_code'] = "success";
                header('Location: supprojects.php'); 
            }
            else
            {
                $_SESSION['status'] = "There was an Error. Try again! or Contact support";       
                $_SESSION['status_code'] = "error";
                header('Location: supprojects.php'); 
            }
        }
    }

}

#for selected checkbox in supervisor page
if(isset($_POST['search_data']))
{
    $id = $_POST['id'];
    $visible = $_POST['visible'];

    $query = "UPDATE register SET visible = '$visible' WHERE id = '$id' ";
    $query_run = mysqli_query($con, $query);
}
#for deleting selected checked items from users
if(isset($_POST['confirm_selection']))
{
    $id = "1";
    $query = "DELETE FROM register WHERE visible= '$id' ";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $_SESSION['status'] = "User Profile Deleted";
        $_SESSION['status_code'] = "success";
        header('Location: users.php');
    }

    else 
    {
        $_SESSION['status'] = "There was an ERROR deleting this data. try again";
        $_SESSION['status_code'] = "error";
        header('Location: users.php');  
    }


}

if(isset($_POST['drop_std_btn']))
{
    $id = "1";
    $query = "UPDATE allocation SET `studentname` `studentregno` `studentemail` WHERE addanddrop = '$id' ";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $_SESSION['status'] = "Student successfully droped";
        $_SESSION['status_code'] = "success";
        header('Location: addanddrop.php');
    }

    else 
    {
        $_SESSION['status'] = "There was an ERROR dropping this student! try again";
        $_SESSION['status_code'] = "error";
        header('Location: addanddrop.php');  
    }
}
#for allocatin projects (allocation algorithm)
if(isset($_POST['allocate_btn']))
{
    $new_project_status = "Locked";
    $query = "SELECT * FROM stdChoices ORDER BY timeStamp";
    $query_run = mysqli_query($con, $query);
    $rows = mysqli_num_rows($query_run) > 0;

    if ($rows){
        while ($data = mysqli_fetch_assoc($query_run))
        {
            $fc = json_decode($data['choices']);
            
            foreach ($fc as $key => $values)
            {
                $stdid = $data['std_id'];
                $stdname = $data['std_name'];
                $stdemail = $data['std_email'];
                $all = $values[0] .$values[1];
                $tmstamp = $data['timeStamp'];

                $newdata = array(
                    'std_id' => $stdid,
                    'std_name' => $stdname,
                    'std_email' => $stdemail,
                    'std_allocated' => $all
                );
                $v[] = $values;
                echo $data['std_id']. '-' .$data['std_name']. '-' .$data['std_email']. '-' .$values[0] .$values[1].'<br>';
                echo '<br>';
                $query1 = "SELECT * FROM allocation WHERE std_id = '$stdid' ";
                $query_run1 = mysqli_query($con, $query1);
                if(mysqli_num_rows($query_run1) > 0)
                {
                    $_SESSION['status'] = "Projects successfully allocated";
                    $_SESSION['status_code'] = "success";
                    header('Location: allocatedprojects.php');
                }
                else
                {
                    $query2 = "INSERT INTO allocation (std_id, std_name, std_email, std_allocated, timeStamp)
                    VALUES ('$stdid', '$stdname', '$stdemail', '$all', '$tmstamp') ";
                    $query_run2 = mysqli_query($con, $query2);

                    if($query_run2)
                    {
                        $new_query = "SELECT * FROM allocation ";
                        $new_query_run = mysqli_query($con, $new_query);
                        if(mysqli_num_rows($new_query_run) > 0)
                        {
                            while ($data2 = mysqli_fetch_assoc($new_query_run))
                            {
                                $entry = $data2['std_allocated'];
                                $mes_std = $data2['std_name'];
                                $mes_email = $data2['std_email'];
                                echo $entry;
                                $query3 = "UPDATE details SET `status` = '$new_project_status' WHERE `id` = '$entry'";
                                $query_run3 = mysqli_query($con, $query3); 
                                if($query_run3)
                                {
                                    $pro_query = "SELECT * FROM details WHERE `id` = '$entry'";
                                    $pro_query_run = mysqli_query($con, $pro_query);

                                    #get project details
                                    while ($new_pro = mysqli_fetch_assoc($pro_query_run))
                                    {
                                        $new_pro_id = $new_pro['id'];
                                        $new_pro_title = $new_pro['title'];
                                        $new_pro_name = $new_pro['supervisor'];
                                        $query3 = "UPDATE allocation 
                                        SET `title` = '$new_pro_title', `supervisor` = '$new_pro_name' WHERE `std_allocated` = '$new_pro_id'";
                                        $query_run3 = mysqli_query($con, $query3);

                                    }
                                
                                        $msg = "Dear $mes_std \nyou have been allocated the project with id $entry \n
                                        Log into the senior  project portal to view this project. \n 
                                        You will need to sign the contract and upload it\n
                                        If you wish to drop it, request for a drop form from the add and drop section in the portal\n
                                        sign it and upload it also.\n
                                        The course coordinator would be in touch with you for more guidiance and information.\n
                                        \n EUC SENIOR PROJECT ADMIN.";
                                        $msg = wordwrap($msg,70);
                                        mail($mes_email, "SENIOR PROJECT ALLOCATION",$msg);
                                }
                            }
                        }
                        $_SESSION['status'] = "Project successfully allocated";
                        $_SESSION['status_code'] = "success";
                        header('Location: allocatedprojects.php');
                    }

                }
                
            }
        }
  
    }
    $_SESSION['status'] = "Project successfully allocated";
    $_SESSION['status_code'] = "success";
    header('Location: allocatedprojects.php');
}

#for selected checkbox in add and drop page
if(isset($_POST['status_data']))
{
    $id = $_POST['id'];
    $selected = $_POST['selected'];

    $query = "UPDATE add_drop SET `selected` = '$selected' WHERE std_id = '$id' ";
    $query_run = mysqli_query($con, $query);
}
#view student drop form on  add and drop page
if(isset($_POST['view_form_btn'])){
    $myfile = $_POST['view_form_file'];
    $file = 'upload/'."$myfile";
    header('Content-type: application/php');
    header('Content-Disposition: inline; filename = "'.$myfile .'"');
    header('Content-Transfer-Encoding: binary');
    header('Accept-Ranges: bytes');
    @readfile($file);


    
}
#confirm project drop on add and drop page
if(isset($_POST['drop_project_std'])){

    $status = "selected";
    $newstatus = "dropped";
    $new_project_status = "Available";
    $query = "SELECT * FROM add_drop WHERE selected = '$status'";
    $query_run = mysqli_query($con, $query);
    $rows = mysqli_num_rows($query_run) > 0;
    if($rows)
    {
        $std_dropping = mysqli_fetch_assoc($query_run);
        $std_dropped = $std_dropping['std_id'];
        $projectstatus = "dropped by requst of " . $std_dropped;
        $new_project = "Available";
        $query2 = "UPDATE add_drop SET `status` = '$newstatus' WHERE `status` = '$status'";
        $query_run2 = mysqli_query($con, $query2); 
        
        
        $query4 = "SELECT * FROM allocation WHERE `std_id` = '$std_dropped'";
        $query_run4 = mysqli_query($con, $query4); 
        $rows2 = mysqli_num_rows($query_run4) > 0;
        if($rows2)
        {
            $project_status = mysqli_fetch_assoc($query_run4);
            $project_dropped = $project_status['std_allocated'];

            $query5 = "UPDATE details SET `status` = '$new_project' WHERE `id` = '$project_dropped'";
            $query_run5 = mysqli_query($con, $query5); 

            $query3 = "UPDATE allocation SET `std_allocated` = '$projectstatus' WHERE `std_id` = '$std_dropped'";
            $query_run3 = mysqli_query($con, $query3); 

            $_SESSION['status'] = "Project successfully Dropped";
            $_SESSION['status_code'] = "success";
            header('Location: addanddrop.php');
        }
        
    }
    else {
        $_SESSION['status'] = "Select a project to.";
        $_SESSION['status_code'] = "error";
        //header('Location: addanddrop.php');  
    }
}

#for the edit and update project button
if(isset($_POST['update_pro_btn']))
{
    $id = $_POST['edit_id'];
    $current_project = $_POST['edit_current_project'];
    $project = $_FILES["edit_project"]['name'];
    $current_video = $_POST['edit_current_video'];
    $video = $_FILES["edit_video"]['name'];
    $current_contract = $_POST['edit_current_contract'];
    $contract = $_FILES["edit_contract"]['name'];
    $title = $_POST['edit_title'];
    $name = $_POST['edit_super_name'];
    $current_image = $_POST['edit_current_super_img'];
    $image = $_FILES["edit_super_img"]['name'];
    $status = $_POST['update_status'];

    $pro_query = "SELECT * FROM details WHERE id = '$id'";
    $pro_query_run  = mysqli_query($con, $pro_query);
        
    if (mysqli_num_rows($pro_query_run)>0)
    {
            $pro = mysqli_fetch_array($pro_query_run);

            #check if fields are empty
            if(empty($project)&&empty($video)&&empty($contract)&&empty($image))
            {
                $query = "UPDATE detail SET title='$title', supervisor='$name', status='$status' WHERE id='$id' ";
                $query_run = mysqli_query($con, $query);

                if($query_run)
                {
                    $_SESSION['status'] = "Project Data is Updated";
                    $_SESSION['status_code'] = "success";
                    header('Location: editstudentdashboard.php'); 
                }
                else
                {
                    $_SESSION['status'] = "There was an Error updating the project. Try again or contact support";
                    $_SESSION['status_code'] = "error";
                    header('Location: editstudentdashboard.php'); 
                }
            }
            #if only project is empty
            else if(empty($project))
            {
                #change video file name
                $temp = explode(".", $_FILES["edit_video"]["name"]);
                $newvid = $name . " video" . '.' . end($temp);
                #change contract file name
                $temp = explode(".", $_FILES["edit_contract"]["name"]);
                $newcon = $name . " contract" . '.' . end($temp);
                #change image file name
                $temp = explode(".", $_FILES["edit_super_img"]["name"]);
                $newimg = $name . " photo" . '.' . end($temp);

                $query = "UPDATE detail SET video = '$newvid', contract = '$newcon', supervisorImg = '$newimg',
                title='$title', supervisor='$name', status='$status' WHERE id='$id' ";
                $query_run = mysqli_query($con, $query);

                if($query_run)
                {
                    move_uploaded_file($_FILES["edit_video"]["tmp_name"], "upload/".$newvid);
                    move_uploaded_file($_FILES["edit_contract"]["tmp_name"], "upload/".$newcon);
                    move_uploaded_file($_FILES["edit_super_img"]["tmp_name"], "upload/".$newimg);
                    $_SESSION['status'] = "Project Data is Updated";
                    $_SESSION['status_code'] = "success";
                    header('Location: editstudentdashboard.php'); 
                }
                else
                {
                    $_SESSION['status'] = "There was an Error updating the project. Try again or contact support";
                    $_SESSION['status_code'] = "error";
                    header('Location: editstudentdashboard.php'); 
                }
            }
            #if only video is empty
            else if(empty($video))
            {
                #change project file name
                $temp = explode(".", $_FILES["edit_project"]["name"]);
                $newpro = $name . " project" . '.' . end($temp);
                #change contract file name
                $temp = explode(".", $_FILES["edit_contract"]["name"]);
                $newcon = $name . " contract" . '.' . end($temp);
                #change image file name
                $temp = explode(".", $_FILES["edit_super_img"]["name"]);
                $newimg = $name . " photo" . '.' . end($temp);

                $query = "UPDATE detail SET project = '$newpro', contract = '$newcon', supervisorImg = '$newimg',
                title='$title', supervisor='$name', status='$status' WHERE id='$id' ";
                $query_run = mysqli_query($con, $query);

                if($query_run)
                {
                    move_uploaded_file($_FILES["edit_project"]["tmp_name"], "upload/".$newpro);
                    move_uploaded_file($_FILES["edit_contract"]["tmp_name"], "upload/".$newcon);
                    move_uploaded_file($_FILES["edit_super_img"]["tmp_name"], "upload/".$newimg);
                    $_SESSION['status'] = "Project Data is Updated";
                    $_SESSION['status_code'] = "success";
                    header('Location: editstudentdashboard.php'); 
                }
                else
                {
                    $_SESSION['status'] = "There was an Error updating the project. Try again or contact support";
                    $_SESSION['status_code'] = "error";
                    header('Location: editstudentdashboard.php'); 
                }
            }
            #if only contract is empty
            else if(empty($contract))
            {
                #change video file name
                $temp = explode(".", $_FILES["edit_video"]["name"]);
                $newvid = $name . " video" . '.' . end($temp);
                #change project file name
                $temp = explode(".", $_FILES["edit_project"]["name"]);
                $newpro = $name . " project" . '.' . end($temp);
                #change image file name
                $temp = explode(".", $_FILES["edit_super_img"]["name"]);
                $newimg = $name . " photo" . '.' . end($temp);

                $query = "UPDATE detail SET project = '$newpro', video = '$newvid', supervisorImg = '$newimg',
                title='$title', supervisor='$name', status='$status' WHERE id='$id' ";
                $query_run = mysqli_query($con, $query);

                if($query_run)
                {
                    move_uploaded_file($_FILES["edit_video"]["tmp_name"], "upload/".$newvid);
                    move_uploaded_file($_FILES["edit_project"]["tmp_name"], "upload/".$newpro);
                    move_uploaded_file($_FILES["edit_super_img"]["tmp_name"], "upload/".$newimg);
                    $_SESSION['status'] = "Project Data is Updated";
                    $_SESSION['status_code'] = "success";
                    header('Location: editstudentdashboard.php'); 
                }
                else
                {
                    $_SESSION['status'] = "There was an Error updating the project. Try again or contact support";
                    $_SESSION['status_code'] = "error";
                    header('Location: editstudentdashboard.php'); 
                }
            }
            #if only super image is empty
            else if(empty($image))
            {
                #change video file name
                $temp = explode(".", $_FILES["edit_video"]["name"]);
                $newvid = $name . " video" . '.' . end($temp);
                #change contract file name
                $temp = explode(".", $_FILES["edit_contract"]["name"]);
                $newcon = $name . " contract" . '.' . end($temp);
                #change project file name
                $temp = explode(".", $_FILES["edit_project"]["name"]);
                $newpro = $name . " project" . '.' . end($temp);

                $query = "UPDATE detail SET project = '$newpro', video = '$newvid', contract = '$newcon',
                title='$title', supervisor='$name', status='$status' WHERE id='$id' ";
                $query_run = mysqli_query($con, $query);

                if($query_run)
                {
                    move_uploaded_file($_FILES["edit_video"]["tmp_name"], "upload/".$newvid);
                    move_uploaded_file($_FILES["edit_contract"]["tmp_name"], "upload/".$newcon);
                    move_uploaded_file($_FILES["edit_project"]["tmp_name"], "upload/".$newpro);
                    $_SESSION['status'] = "Project Data is Updated";
                    $_SESSION['status_code'] = "success";
                    header('Location: editstudentdashboard.php'); 
                }
                else
                {
                    $_SESSION['status'] = "There was an Error updating the project. Try again or contact support";
                    $_SESSION['status_code'] = "error";
                    header('Location: editstudentdashboard.php'); 
                }
            }
            #if they are all filled 
            else 
            {
                #change project file name
                $temp = explode(".", $_FILES["edit_project"]["name"]);
                $newpro = $name . " project" . '.' . end($temp);
                #change video file name
                $temp = explode(".", $_FILES["edit_video"]["name"]);
                $newvid = $name . " video" . '.' . end($temp);
                #change contract file name
                $temp = explode(".", $_FILES["edit_contract"]["name"]);
                $newcon = $name . " contract" . '.' . end($temp);
                #change image file name
                $temp = explode(".", $_FILES["edit_super_img"]["name"]);
                $newimg = $name . " photo" . '.' . end($temp);

                $query = "UPDATE detail SET project = '$newpro', video = '$newvid', contract = '$newcon', supervisorImg = '$newimg',
                title='$title', supervisor='$name', status='$status' WHERE id='$id' ";
                $query_run = mysqli_query($con, $query);

                if($query_run)
                {
                    move_uploaded_file($_FILES["edit_project"]["tmp_name"], "upload/".$newpro);
                    move_uploaded_file($_FILES["edit_video"]["tmp_name"], "upload/".$newvid);
                    move_uploaded_file($_FILES["edit_contract"]["tmp_name"], "upload/".$newcon);
                    move_uploaded_file($_FILES["edit_super_img"]["tmp_name"], "upload/".$newimg);
                    $_SESSION['status'] = "Project Data is Updated";
                    $_SESSION['status_code'] = "success";
                    header('Location: editstudentdashboard.php'); 
                }
                else
                {
                    $_SESSION['status'] = "There was an Error updating the project. Try again or contact support";
                    $_SESSION['status_code'] = "error";
                    header('Location: editstudentdashboard.php'); 
                }
            }
            
    }
}

#for the edit and update unallocated projects button
if(isset($_POST['unallocated_updatebtn']))
{
    $new_pro = $_POST['pro_list'];
    $new_id = $_POST['edit_std_id'];
    $new_name = $_POST['edit_std_name'];
    $new_email = $_POST['edit_std_email'];
    $new_timestamp = date('Y-m-d H:i:s');
    #check if a student is already assigned this project
    $query = "SELECT * FROM allocation WHERE std_allocated = '$new_pro'";
    $query_run = mysqli_query($con, $query);
    if(mysqli_num_rows($query_run) > 0)
    {
        $_SESSION['status'] = "Project already assigned to student. Check allocated Table";
        $_SESSION['status_code'] = "error";
        header('Location: allocatedprojects.php');
    }
    else 
    {
        #if project doesnt exxist then insert this student
        $query2 = "INSERT INTO allocation (std_id, std_name, std_email, std_allocated, timeStamp)
        VALUES ('$new_id', '$new_name', '$new_email', '$new_pro', '$new_timestamp') ";
        $query_run2 = mysqli_query($con,$query2);

        if($query_run2)
        {
            #update project status
            $new_project_status = "Locked";
            $query3 = "UPDATE details SET `status` = '$new_project_status' WHERE `id` = '$new_pro'";
            $query_run3 = mysqli_query($con, $query3); 
            if($query_run3)
            {
                $pro_query = "SELECT * FROM details WHERE `id` = '$new_pro'";
                $pro_query_run = mysqli_query($con, $pro_query);

                #get project details
                while ($new_data = mysqli_fetch_assoc($pro_query_run))
                {
                    $new_pro_id = $new_data['id'];
                    $new_pro_title = $new_data['title'];
                    $new_pro_name = $new_data['supervisor'];
                    $query3 = "UPDATE allocation 
                    SET `title` = '$new_pro_title', `supervisor` = '$new_pro_name' WHERE `std_allocated` = '$new_pro_id'";
                    $query_run3 = mysqli_query($con, $query3);

                }
            
                    $msg = "Dear $new_name ,\nYou have been allocated the project with id $new_pro \n
                    Log into the senior  project portal to view this project. \n 
                    You will need to sign the contract and upload it\n
                    If you wish to drop it, request for a drop form from the add and drop section in the portal\n
                    sign it and upload it also.\n
                    The course coordinator would be in touch with you for more guidiance and information.\n
                    \n EUC SENIOR PROJECT ADMIN.";
                    $msg = wordwrap($msg,70);
                    mail($new_email, "SENIOR PROJECT ALLOCATION",$msg);
            }

            $_SESSION['status'] = "Project Successfully allocated";
            $_SESSION['status_code'] = "success";
            header('Location: allocatedprojects.php');
        }
        else 
        {
            $_SESSION['status'] = "Error: Project not allocated";
            $_SESSION['status_code'] = "error";
            header('Location: allocatedprojects.php');  
        }
    }
}
#update user profile
if(isset($_POST['update_profile_btn']))
{
    $new_password = $_POST['edit_profile_password'];
    $new_cpassword = $_POST['edit_profile_cpassword'];
    $new_id = $_POST['edit_profile_id'];
    $new_email = $_SESSION['admin'];
    $new_name = $_POST['edit_profile_username'];
    #change project file name
    $temp = explode(".", $_FILES["edit_profile_img"]["name"]);
    $new_img = $new_name . " img" . '.' . end($temp);

    if($new_password === $new_cpassword)
    {
        $query = "UPDATE register SET password = '$new_password', img = '$new_img'
        WHERE id = '$new_id'";
        $query_run = mysqli_query($con, $query);
        if($query_run)
        {
            move_uploaded_file($_FILES["edit_profile_img"]["tmp_name"], "upload/".$new_img);
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

#update supervisor user profile
if(isset($_POST['update_supervisor_profile_btn']))
{
    $new_password = $_POST['edit_profile_password'];
    $new_cpassword = $_POST['edit_profile_cpassword'];
    $new_id = $_POST['edit_profile_id'];
    $new_email = $_SESSION['supervisor'];
    $new_name = $_POST['edit_profile_username'];
    #change project file name
    $temp = explode(".", $_FILES["edit_profile_img"]["name"]);
    $new_img = $new_name . " img" . '.' . end($temp);

    if($new_password === $new_cpassword)
    {
        $query = "UPDATE register SET password = '$new_password', img = '$new_img'
        WHERE id = '$new_id'";
        $query_run = mysqli_query($con, $query);
        if($query_run)
        {
            move_uploaded_file($_FILES["edit_profile_img"]["tmp_name"], "upload/".$new_img);
            #display alerts
            $_SESSION['status'] = "Profile updated";
            $_SESSION['status_code'] = "success";
            header('Location: supprofile.php');

        }
        else 
        {
            $_SESSION['status'] = "Error updating user profile! try again or contact support";
            $_SESSION['status_code'] = "error";
            header('Location: supprofile.php');
        }
    }
    else 
    {
        $_SESSION['status'] = "Error: Passwords do not match.";
        $_SESSION['status_code'] = "error";
        header('Location: supprofile.php');
    }   

    


}

?>

