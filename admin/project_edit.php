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
         
         $query = "SELECT * FROM details WHERE id='$id' ";
         $query_run = mysqli_query($con, $query);

         foreach($query_run as $row)
         {
             ?>
            <form action="code.php" method="POST" enctype="multipart/form-data">

                <input type="hidden" name="edit_id" value="<?php echo $row['id'] ?>">
                <!--project-->
                <div class="form-group">
                <div class="row">
                    <div class="col-sm-6">
                <small>Current Project File </small>
                <input type="text" name="edit_current_project" value="<?php echo $row['project'] ?>"
                disabled class="form-control">
                </div>
                <div class="col-sm-6">
                    <small> Project File </small>
                    <input type="file" name="edit_project" class="form-control">
                </div>
                </div>
                </div>
                <!--video-->
                <div class="form-group">
                <div class="row">
                    <div class="col-sm-6">
                <small>Current Video File </small>
                <input type="text" name="edit_current_video" value="<?php echo $row['video'] ?>"
                disabled class="form-control">
                </div>
                <div class="col-sm-6">
                <small> Video File </small>
                    <input type="file" name="edit_video" class="form-control" >
                </div>
                </div>
                </div>
                <!--contract-->
                <div class="form-group">
                <div class="row">
                    <div class="col-sm-6">
                <small>Current Contract File </small>
                <input type="text" name="edit_current_contract" value="<?php echo $row['contract'] ?>"
                disabled class="form-control">
                </div>
                <div class="col-sm-6">
                <small> Contract File </small>
                    <input type="file" name="edit_contract" class="form-control" >
                </div>
                </div>
                </div>
                <!--title-->
                <div class="form-group">
                    <label>Title</label>
                    <input type="text" name="edit_title" value="<?php echo $row['title'] ?>"
                        class="form-control">
                </div>
                <!--name-->
                <div class="form-group">
                    <label>Supervisor Name</label>
                    <input type="text" name="edit_super_name" value="<?php echo $row['supervisor'] ?>"
                        class="form-control">
                </div>
                <!--Image-->
                <div class="form-group">
                <div class="row">
                    <div class="col-sm-6">
                <small>Current Contract File </small>
                <input type="text" name="edit_current_super_img" value="<?php echo $row['supervisorImg'] ?>"
                disabled class="form-control">
                </div>
                <div class="col-sm-6">
                <small>Supervisor Image</small>
                <input type="file" name="edit_super_img" class="form-control" >
                </div>
                </div>
                </div>
                <!--Status-->
                <div class="form-group">
                    <label>Status</label>
                    <select name="update_status" class="form-control">
                        <option value="Available">Available</option>
                        <option value="Reserved">Reserved</option>
                        <option value="Locked">Locked</option>
                    </select>
                </div>
                <!--buttons-->
                <a href="editstudentdashboard.php" class="btn btn-danger"> CANCEL </a>
                <button type="submit" name="update_pro_btn" class="btn btn-primary"> Update </button>

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