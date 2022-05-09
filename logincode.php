<?php
include('admin/security.php');
include('student/security.php');
#for the login button
if(isset($_POST['login_btn']))
{
    $email_login = $_POST['emaill']; 
    $password_login = $_POST['passwordd']; 

    $query = "SELECT * FROM register WHERE email='$email_login' AND password='$password_login' LIMIT 1";
    $query_run = mysqli_query($con, $query);
    $usertypes = mysqli_fetch_array($query_run);

    if($usertypes['usertype'] == "admin")
    {
        $_SESSION['admin'] = $email_login;
        header('Location: admin/index.php');
    }
    else if($usertypes['usertype'] == "Student")
    {
        $_SESSION['username'] = $email_login;

        header('Location: student/index.php');
    }
    else if($usertypes['usertype'] == "Supervisor")
    {
        $_SESSION['supervisor'] = $email_login;
        header('Location: admin/supprojects.php');
    }
    else
    {
        $_SESSION['status'] = "Email / Password is Invalid";
        header('Location: securitylogin.php');
    }
}

?>