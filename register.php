<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Senior Project - Register</title>

    <!-- Custom fonts for this template-->
    <link href="admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="admin/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Register for EUC Oline Senior Project!</h1>
                            <p>
                                    <?php
                                        if(isset($_SESSION['success']) && $_SESSION['success'] != '')
                                        {
                                           echo  '<span class= col-sm-8>'.'<div class="alert alert-info" role="alert">'.
                                           $_SESSION['success'].' </div>'.'</span>';
                                           unset($_SESSION['success']);
                                        }
                                        else if(isset($_SESSION['status']) && $_SESSION['status'] != '')
                                        {
                                            echo  '<span class= col-sm-8>'.'<div class="alert alert-info" role="alert">'.
                                            $_SESSION['status'].' </div>'.'</span>';
                                           unset($_SESSION['status']);
                                        }
                                    ?> 
                            </p>
                                
                            </div>
                            <form class="user" action="registercode.php" method="POST" enctype="multipart/form-data">
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" id="exampleFirstName"
                                            placeholder="First Name" name="fname" required>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control form-control-user" id="exampleLastName"
                                            placeholder="Last Name" name="lname" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-user" id="exampleInputEmail"
                                        placeholder="Email Address" name="superemail" required>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" class="form-control form-control-user"
                                            id="exampleInputPassword" placeholder="Password" name="superpass" required>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" class="form-control form-control-user"
                                            id="exampleRepeatPassword" placeholder="Repeat Password" name="superrepeatpass" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" id="exampleInputstdno"
                                        placeholder="Student number" name="stdno" required>
                                </div>
                                <div class="form-group">
                                <small>User Image</small>
                                <input type="file" name="supervisor_image_file" 
                                id="supervisor_image_file" class="form-control-file form-control-sm">
                                </div>

                                <input type="submit" value="Register" class="btn btn-primary btn-user btn-block" name="register_btn">
                                
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="securitylogin.php">Already have an account? Login!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>
   

</body>

</html>
 <?php 
    include('admin/includes/scripts.php'); 
?>