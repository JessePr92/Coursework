<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Login</title>

    <!-- Custom fonts for this template-->
    <link href="admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="admin/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">
    <!-- Page Wrapper -->
    <div id="wrapper">

        <div class="container">

            <!-- Outer Row -->
            <div class="row justify-content-center">

                <div class="col-xl-10 col-lg-12 col-md-9">

                    <div class="card o-hidden border-0 shadow-lg my-5">
                        <div class="card-body p-0">
                            <!-- Nested Row within Card Body -->
                            <div class="row">
                                <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                                <div class="col-lg-6">
                                    <div class="p-5">
                                        <div class="text-center">
                                            <h1 class="h4 text-gray-900 mb-4">Login here!</h1>
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
                                        </div>
                                        <form class="user" action="logincode.php" method="POST">

                                            <div class="form-group">
                                                <input type="email" name="emaill" class="form-control form-control-user"
                                                    placeholder="Enter Email Address...">
                                            </div>
                                            <div class="form-group">
                                                <input type="password" name="passwordd"
                                                    class="form-control form-control-user" placeholder="Password">
                                            </div>

                                            <button type="submit" name="login_btn"
                                                class="btn btn-primary btn-user btn-block">
                                                Login
                                            </button>
                                            <hr>
                                        </form>
                                        <div class="text-center">
                                        <a class="small" href="register.php">Create an Account!</a>
                                    </div>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </div>
        <!-- End of Main Content -->
    </div>
    <!-- Footer -->
    <footer class="sticky-footer text-center fixed-bottom bg-white">
        <div class="container my-auto">
            <div class="copyright text-center my-auto">
                <span>Copyright &copy; Your Website 2020</span>
            </div>
        </div>
    </footer>
    <!-- End of Footer -->

    </div>

    <!-- End of Content Wrapper -->
</body>

</html>


<?php 
    include('admin/includes/scripts.php'); 
?>