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

<!-- Modal -->
<div class="modal fade" id="stdmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add A New Project</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <!--<span aria-hidden="true">&times;</span>-->
                </button>
            </div>
           
            <form action="code.php" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label> Supervisor </label>
                        
                        
                        <?php
                            $email1 = $_SESSION['supervisor'];
                            $query = "SELECT username FROM register WHERE email = '$email1'";
                            $query_run = mysqli_query($con, $query);
                            if(mysqli_num_rows($query_run) > 0) 
                                {
                                    while($row = mysqli_fetch_assoc($query_run))
                                        {
                                            $supervisor_name = $row['username'];
                                            echo '<input type="text" name="supervisor_name" class="form-control"
                                            value= "'.$row['username'].'" readonly>';
                                        }
                                }
                         ?>
                        
                    </div>
                    <div class="form-group">
                        <label>Title</label>
                        <textarea type="text" name="project_title" class="form-control" placeholder="Enter Title" required></textarea>
                    </div>
                    <div class="form-group">
                        <label>Project file</label>
                        <input type="file" name="project_file" id="project_file" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Video file</label>
                        <input type="file" name="video_file" id="video_file" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Contract file</label>
                        <input type="file" name="contract_file" id="contract_file" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Project Status</label>
                        <select name="project_status" class="form-control">
                        <option value="Available">Available</option>
                        <option value="Locked">Locked</option>
                        </select>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="super_project_btn">Save</button>
                </div>
            </form>

        </div>
    </div>
</div>

<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Project Listing</h1>
<p class="mb-4">All projects will be listed with their status value accordingly, 
    The below collapsable cards can be used to set the openig and closing time for all projects.<br> 
    We will use this time to calculate the allocation of projects automatically. </p>

<!--page content starts here-->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary btn-icon-split" data-bs-toggle="modal" data-bs-target="#stdmodal">
                <span class="icon text-white-50">
                    <i class="fas fa-plus"></i>
                </span>
                <span class="text">Add a new Project</span> 
                </button>
            </h6>
        </div>
        <div class="card-body">
        <!--search-->
        <div class="row">
        <div class="col-sm-12">
        <input class="form-control" id="myInput" type="text" placeholder="Search..">
        <br>
        </div>
        </div>

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
                <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootsprap4"> 
                <?php
                $query = "SELECT * FROM details";
                $query_run = mysqli_query($con, $query);
            ?>
                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0" role="grid" style="width: 100%;">
                    <thead>
                        <tr>
                            <th> ID </th>
                            <th>Supervisor </th>
                            <th>Title </th>
                            <th>Project file</th>
                            <th>Video file</th>
                            <th>Contract file</th>
                            <th>Status</th>
                            <th>Supervisor image </th>
                        </tr>
                    </thead>
                    <tbody id="myTable2">
                        <?php
                        if(mysqli_num_rows($query_run) > 0) 
                            {
                            while($row = mysqli_fetch_assoc($query_run))
                            {
                        ?>
                        <tr>
                            <td><?php  echo $row['id']; ?></td>
                            <td><?php  echo $row['supervisor']; ?></td>
                            <td><?php  echo $row['title']; ?></td>
                            <td><?php  echo $row['project']; ?></td>
                            <td><?php  echo $row['video']; ?></td>
                            <td><?php  echo $row['contract']; ?></td>
                            <td><?php  echo $row['status']; ?></td>
                            <td><?php  echo '<img src="upload/'.$row['supervisorImg'].'" width="100px;"
                            height="100px;" alt="Supervisor image">' ; ?> 
                            </td>
                        </tr>
                        <?php
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
<!--end of container fluid-->

<?php 
    include('includes/scripts.php'); 
    ?>
    <script>
    //search function
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable2 tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>
<?php
    include('includes/footer.php'); 
?>