<?php 
    include('security.php');
    include('includes/header.php'); 
    include('includes/navbar.php');
    include('includes/topbar.php');

    if(isset($_GET["action"]))  
{  
     if($_GET["action"] == "delete")  
     {  
          foreach($_SESSION["ppp"] as $keys => $values)  
          {  
               if($values["project_id"] == $_GET["id"])  
               {  
                    unset($_SESSION["ppp"][$keys]);   
                    echo '<script>window.location="studentlist.php"</script>';  
               }  
          }  
     }  
} 



?>

<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Project List</h1>
    <p class="mb-4">All projects added to your list will be shown here, in the table below.<br>
    To submit this list hit the connfirm button, which will be enabled by the course coordinator
    at a specific time.<br>
    <strong class="text-danger">Notice:</strong> This list is temporary and will refresh if you log out. </p>

    <!--page content starts here-->
    <div class="card shadow mb-4">
        <div class="card-header py-0">
            <div class="row">
                <div class="col-sm-6">
                    <h6 class="m-0 mt-3 font-weight-bold text-primary">
                        Your Selected List of Projects
                    </h6>
                </div>
                <div class="col-sm-6">
                    <h6 class="m-0 mt-2 font-weight-bold text-primary text-right">
                        <!-- Button to confim choises -->
                        <form action="code.php" method="POST">
                            <input type="text" id="whentoopen" hidden>
                            <button type="submit" id="confirm_selection" name="confirm_selection" disabled
                                class="btn btn-primary">
                                Confirm
                            </button>
                        </form>
                    </h6>
                </div>
            </div>
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

            <div class="table-responsive">
              <?php
                $query = "SELECT * FROM details";
                $query_run = mysqli_query($con, $query);
            ?>
                <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootsprap4">
                  
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" role="grid" style="width: 100%;">
                        <thead>
                            <tr>
                                <th> ID </th>
                                <th>Supervisor </th>
                                <th>Title </th>
                                <th>Action </th>
                                <th>Student name </th>
                                <th>Student email </th>
                                <th>Student Reg. </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                        if(!empty($_SESSION["ppp"])) 
                            {
                                
                                foreach($_SESSION["ppp"] as $keys => $values)
                            {
                        ?>
                            <tr>
                                <td><?php  echo $values["project_id"]; ?></td>
                                <td><?php  echo $values["project_supervisor"]; ?></td>
                                <td><?php  echo $values["project_title"]; ?></td>
                                <td>
                                    <a href="studentlist.php?action=delete&id=<?php echo $values["project_id"]; ?>">
                                        <span class="text-danger">Remove</span>
                                        </a>
                                </td>
                                <?php 
                        $stdem = $_SESSION['username'];
                        $query = "SELECT * FROM register WHERE email='$stdem' LIMIT 1";
                        $query_run = mysqli_query($con, $query);
                        $checkstd = mysqli_num_rows($query_run) > 0;
                        if($checkstd){
                            if($row = mysqli_fetch_array($query_run))
                            {
                                
                                ?>
                                <td><?php  echo $row["username"]; ?></td>
                                <td><?php  echo $stdem; ?></td>
                                <td><?php  echo $row["studentno"]; ?></td>
                            </tr>
                            <?php
                            } 
                        }
                        
         }
        }
       
        
                        else {
                            echo '<span class= col-sm-8>'.'<div class="alert alert-info" role="alert">'.
                                'Info: No record found'.'</div>'.'</span>';
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>

        
        

    </div>
</div>
</div>

<?php 
    include('includes/scripts.php'); 
?>

<?php
$enablebtn = date('Y-m-d');
date_default_timezone_set("eet");
$enablebtn_time =  date("H:i:s");
   
$query = "SELECT * FROM opentimes WHERE openingdate <= '$enablebtn' AND closingdate >= '$enablebtn'";
$query_run = mysqli_query($con, $query);
$checkdate = mysqli_num_rows($query_run) > 0;
     if($checkdate)
     {
         if($checkdate["openingdate"] <= $enablebtn && $enablebtn_time >= $checkdate["openingtimes"]
         ||$enablebtn <= $checkdate["closingdate"]  && $enablebtn_time <= $checkdate["closingtimes"])
         {
         ?>
<script>
    document.getElementById("confirm_selection").disabled = false;
</script>
<?php
     }
     else {
     ?>
<script>
    document.getElementById("confirm_selection").disabled = true;
</script>
<?php
     }
    }
?>

<?php
    include('includes/footer.php'); 
?>