<?php
include('admin/security.php');

#for registering a new supervisor
if(isset($_POST['register_btn'])){
    $name = $_POST['fname']." ".$_POST['lname'];
    $email =$_POST['superemail'];
    $password = $_POST['superpass'];
    $cpassword = $_POST['superrepeatpass'];
    $std_no = $_POST['stdno'];
    $supervisor_image = $_FILES["supervisor_image_file"]['name'];

    $email_query1 = "SELECT * FROM register WHERE email='$email' ";
    $email_query_run1 = mysqli_query($con, $email_query1);
    if(mysqli_num_rows($email_query_run1) > 0)
    {
        $_SESSION['status'] = "Email Already Exists.";
        $_SESSION['status_code'] = "error";
        header('Location: register.php');
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
                        if($user_query_run)
                        {
                            move_uploaded_file($_FILES["supervisor_image_file"]["tmp_name"], "admin/upload/".$newfilename);
                            
                            $msg = "Welcome $name, \nYou are now registered as an $usertype
                              for the online Senior project portal \n
                            We will notify you when students upload files via the portal.\n
                            \n EUC SENIOR PROJECT ADMIN.";
                            $msg = wordwrap($msg,70);
                            mail($email, "SENIOR PROJECT ALLOCATION",$msg);

                            $_SESSION['status'] = "Admin Profile Added";
                            $_SESSION['status_code'] = "success";
                            header('Location: securitylogin.php');
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
                        $_SESSION['status'] = "Admin Profile not added";
                        $_SESSION['status_code'] = "error";
                        header('Location: register.php');  
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
                            header('Location: register.php');
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
                            move_uploaded_file($_FILES["supervisor_image_file"]["tmp_name"], "admin/upload/".$newfilename);

                            $msg = "Welcome $name, \nYou are now registered as a $usertype_student
                              for the online Senior project portal \n
                            We will notify you when projects are uploaded via the portal.\n
                            \n EUC SENIOR PROJECT ADMIN.";
                            $msg = wordwrap($msg,70);
                            mail($email, "SENIOR PROJECT ALLOCATION",$msg);

                            $_SESSION['status'] = "Student Profile Added";
                            $_SESSION['status_code'] = "success";
                            header('Location: securitylogin.php');
                        }
                        else 
                        {
                            $_SESSION['status'] = "Student Profile Not Added";
                            $_SESSION['status_code'] = "error";
                            header('Location: register.php');  
                        }
                    }
                }
                 else if(strpos($email,'student')!==false)
                        {
                            $_SESSION['status'] = "Student Profile Not Added. Email should be @students.euc.ac.cy";
                            $_SESSION['status_code'] = "error";
                            header('Location: register.php');  
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
                        move_uploaded_file($_FILES["supervisor_image_file"]["tmp_name"], "admin/upload/".$newfilename);

                        $msg = "Welcome $name, \nYou are now registered as a $usertype_supervisor
                              for the online Senior project portal \n
                            when uploading your projects via the portal be sure to include the following:\n
                            1. Project file(pdf)\n
                            2. Video presentation of the project(mp4)\n
                            3. Contract file(pdf)\n
                            \n
                            in order for students to best understand the aim of the project.\n
                            \n EUC SENIOR PROJECT ADMIN.";
                            $msg = wordwrap($msg,70);
                            mail($email, "SENIOR PROJECT ALLOCATION",$msg);

                        $_SESSION['status'] = "Supervisor Profile Added";
                        $_SESSION['status_code'] = "success";
                        header('Location: securitylogin.php');
                    }
                    else 
                    {
                        $_SESSION['status'] = "Supervisor Profile Not Added";
                        $_SESSION['status_code'] = "error";
                        header('Location: register.php');  
                    }
                }
                    
            }
            else 
            {
                $_SESSION['status'] = "Passwords do not match.";
                $_SESSION['status_code'] = "error";
                header('Location: register.php');  
            }
    }
        else 
            {
                $_SESSION['status'] = "Email is not a valid EUC email! try again or contact support";
                $_SESSION['status_code'] = "error";
                header('Location: register.php');  
            }
    }

}

?>