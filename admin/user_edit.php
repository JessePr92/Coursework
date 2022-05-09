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
     if(isset($_POST['edit_btn']))
     {
         $id = $_POST['edit_id'];
         
         $query = "SELECT * FROM register WHERE id='$id' ";
         $query_run = mysqli_query($con, $query);

         foreach($query_run as $row)
         {
             ?>
            <form action="code.php" method="POST" enctype="multipart/form-data">

                <input type="hidden" name="edit_id" value="<?php echo $row['id'] ?>">

                <div class="form-group">
                    <label> Username </label>
                    <input type="text" name="edit_username" value="<?php echo $row['username'] ?>" class="form-control"
                        placeholder="Enter Username">
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="edit_email" value="<?php echo $row['email'] ?>"
                        class="form-control checking_email" placeholder="Enter Email">
                    <small class="error_email" style="color: red;"></small>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="edit_password" value="<?php echo $row['password'] ?>"
                        class="form-control" placeholder="Enter Password">
                </div>
                <div class="form-group">
                    <label>Student number</label>
                    <input type="text" name="edit_stdno" value="<?php echo $row['studentno'] ?>"
                        class="form-control" placeholder="Use Supervisor for supervisor or admin for Admin">
                </div>
                <div class="form-group">
                        <label>User Image</label>
                        <input type="file" name="edit_user_img" 
                        class="form-control" value="<?php echo $row['img'] ?>">
                    </div>

                <div class="form-group">
                    <label>Usertype</label>
                    <select name="update_usertype" class="form-control">
                        <option value="admin">Admin</option>
                        <option value="Student">Student</option>
                        <option value="Supervisor">Supervisor</option>
                    </select>
                </div>

                <a href="users.php" class="btn btn-danger"> CANCEL </a>
                <button type="submit" name="updatebtn" class="btn btn-primary"> Update </button>

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