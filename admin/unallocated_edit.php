<?php 
    include('security.php');
    include('includes/header.php'); 
    include('includes/navbar.php');
    include('includes/topbar.php');
?>

<div class="container-fluid">

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit Student Allocation </h6>
        </div>
        <div class="card-body">
            <?php
     if(isset($_POST['edit_unallocated_btn']))
     {
         $id = $_POST['edit_una_id'];
         
         $query = "SELECT * FROM stdChoices WHERE std_id='$id' ";
         $query_run = mysqli_query($con, $query);

         foreach($query_run as $row)
         {
             ?>
            <form action="code.php" method="POST" enctype="multipart/form-data">

                <input type="hidden" name="edit_id" value="<?php echo $row['std_id'] ?>">

                <div class="form-group">
                    <label> Student Name </label>
                    <input type="text" name="edit_std_name" value="<?php echo $row['std_name'] ?>" class="form-control"
                        placeholder="Enter Full name" readonly>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="edit_std_email" value="<?php echo $row['std_email'] ?>"
                        class="form-control checking_email" placeholder="Enter Email" readonly>
                    <small class="error_email" style="color: red;"></small>
                </div>
                <div class="form-group">
                    <label>Student number</label>
                    <input type="text" name="edit_std_id" value="<?php echo $row['std_id'] ?>"
                        class="form-control" placeholder="student number" readonly>
                </div>

                <div class="form-group">
                        <label class="mr-sm-2" for="prolisting"> List of Available projects </label>
                        <select name="pro_list" 
                        class="custom-select mr-sm-2 form-control " id="prolisting" required>
                        
                        <?php
                            $old_status = "Available";
                            $query = "SELECT * FROM details WHERE status = '$old_status'";
                            $query_run = mysqli_query($con, $query);
                            if(mysqli_num_rows($query_run) > 0) 
                                {
                                    while($row = mysqli_fetch_assoc($query_run))
                                        {
                                            $pro_id = $row['id'];
                                            $pro_title = $row['title'];
                                            $supervisor_name = $row['supervisor'];
                                           
                                            echo '<option value = "'.$pro_id.'">'.
                                            $row['status']."-".
                                            $row['id']."-".
                                            $row['title']."-".
                                            $row['supervisor'].
                                            '</option>'; 
                                        }
                                }
                         ?>
                        
                    </select>
                    </div>

                <a href="allocatedprojects.php" class="btn btn-danger"> CANCEL </a>
                <button type="submit" name="unallocated_updatebtn" class="btn btn-primary"> Update </button>

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