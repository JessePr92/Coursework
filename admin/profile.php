<?php 
    include('security.php');
    include('includes/header.php'); 
    include('includes/navbar.php');
    include('includes/topbar.php');
?>

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
     if(isset($_SESSION['admin']))
     {
         $email = $_SESSION['admin'];
         
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

                <a href="index.php" class="btn btn-danger"> CANCEL </a>
                <button type="submit" name="update_profile_btn" class="btn btn-primary"> Update </button>

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