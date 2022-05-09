<?php 
    session_start();
    include('database/dbconfig.php');
    
    if($con)
    {
        // echo "Database Connected";
    }
    else
    {
        header("Location: database/dbconfig.php");
    }
    // get username during session
    if(!$_SESSION['supervisor'])
    {
        header('Location: ../securitylogin.php');
    }
    include('includes/header.php'); 
?>

   <!-- Content Wrapper -->
   <div id="content-wrapper" class="d-flex flex-column">

<!-- Main Content -->
<div id="content">
    
                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                                aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                                    <?php echo $_SESSION['supervisor']; ?>
                                </span>
                                <img class="img-profile rounded-circle"
                                    src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="supprofile.php">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="supprojects.php">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Projects
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    
                    <form action="suplogout.php" method="POST"> 
                        <button type="submit" name="logout_btn" class="btn btn-primary">Logout</button>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>



    <div class="container-fluid">

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Edit User profile </h6>
    </div>
    <div class="card-body">
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
        <?php
 if(isset($_SESSION['supervisor']))
 {
     $email = $_SESSION['supervisor'];
     
     $query = "SELECT * FROM register WHERE email='$email' ";
     $query_run = mysqli_query($con, $query);

     foreach($query_run as $row)
     {
         ?>
        <form action="code.php" method="POST" enctype="multipart/form-data">

            <input type="hidden" name="edit_profile_id" value="<?php echo $row['id'] ?>">

            <div class="form-group">
                <label> Username </label>
                <input type="text" name="edit_profile_username" value="<?php echo $row['username'] ?>" class="form-control"
                    placeholder="Enter Username" readonly>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="edit_profile_email" value="<?php echo $row['email'] ?>"
                    class="form-control checking_email" placeholder="Enter Email" readonly>
                <small class="error_email" style="color: red;"></small>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="edit_profile_password" value="<?php echo $row['password'] ?>"
                    class="form-control" placeholder="Enter Password">
            </div>
            <div class="form-group">
                    <label>Confirm Password</label>
                    <input type="password" name="edit_profile_cpassword" value="<?php echo $row['password'] ?>"
                        class="form-control" placeholder="Enter Password">
                </div>
            <div class="form-group">
                <label>Student number</label>
                <input type="text" name="edit_profile_stdno" value="<?php echo $row['studentno'] ?>"
                    class="form-control" readonly>
            </div>
            <div class="form-group">
                    <label>User Image</label>
                    <input type="file" name="edit_profile_img" 
                    class="form-control" value="<?php echo $row['img'] ?>">
                </div>

            <a href="supprojects.php" class="btn btn-danger"> CANCEL </a>
            <button type="submit" name="update_supervisor_profile_btn" class="btn btn-primary"> Update </button>

        </form>
        <?php
            }
        }

        
    ?>
    </div>



</div>
</div>

<?php 
    include('includes/scripts.php');
    include('includes/footer.php'); 
?>
