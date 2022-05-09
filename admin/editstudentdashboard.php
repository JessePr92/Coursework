<?php 
    include('security.php');
    include('includes/header.php'); 
    include('includes/navbar.php');
    include('includes/topbar.php');
?>

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
                        <label class="mr-sm-2" for="inlineFormCustomSelect"> Supervisor </label>
                        <select name="supervisor_name" class="custom-select mr-sm-2 form-control "
                            id="inlineFormCustomSelect" required>

                            <?php
                            $usertype = "Supervisor";
                            $query = "SELECT username FROM register WHERE usertype = '$usertype'";
                            $query_run = mysqli_query($con, $query);
                            if(mysqli_num_rows($query_run) > 0) 
                                {
                                    while($row = mysqli_fetch_assoc($query_run))
                                        {
                                            $supervisor_name = $rows['username'];
                                            echo '<option >'.$row['username'].'</option>'; 
                                        }
                                }
                         ?>

                        </select>
                    </div>
                    <div class="form-group">
                        <label>Title</label>
                        <textarea type="text" name="project_title" class="form-control" placeholder="Enter Title"
                            required></textarea>
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
                        <label class="mr-sm-2" for="pro_status"> Project status </label>
                        <select name="project_status" class="custom-select mr-sm-2 form-control" id="pro_status"
                            required>
                            <option value="Available">Available</option>
                            <option value="Locked">Locked</option>
                        </select>
                    </div>
                    <!--<input type="hidden" name="usertype" value="admin">-->

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="addproject_btn">Save</button>
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

    <form action="openandclosetimes.php" method="POST">
        <!--opening and closing time starts here-->
        <div class="row">

            <!-- Opening time for project submission -->
            <div class="col-lg-6">
                <div class="card shadow mb-4">
                    <a href="#openproject" class="d-block card-header py-3" data-toggle="collapse" role="button"
                        aria-expanded="true" aria-controls="collapseCardExample">
                        <h6 class="m-0 font-weight-bold text-primary">Opening time for project submission</h6>
                    </a>
                    <div class="collapse" id="openproject">
                        <div class="card-body">
                            The styling for this basic card example is created by using default Bootstrap
                            utility classes. By using utility classes, the style of the card component can be
                            easily modified with no need for any custom CSS!
                            <div class="card-text">


                                <div class="row">
                                    <div class="col">
                                        <input type="text" name="semester" class="form-control"
                                            placeholder="Enter Semester">
                                    </div>
                                    <div class="col">
                                        <input type="date" id="openingdate" name="openingdate" class="form-control">
                                    </div>
                                    <div class="col">
                                        <input type="time" id="openingtime" name="openingtime" class="form-control">
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="col-lg-6">

                <!-- closing time for project submission -->
                <div class="card shadow mb-4">
                    <a href="#closeproject" class="d-block card-header py-3" data-toggle="collapse" role="button"
                        aria-expanded="true" aria-controls="collapseCardExample">
                        <h6 class="m-0 font-weight-bold text-primary">Closing time for project submission</h6>
                    </a>
                    <div class="collapse" id="closeproject">
                        <div class="card-body">
                            The styling for this basic card example is created by using default Bootstrap
                            utility classes. By using utility classes, the style of the card component can be
                            easily modified with no need for any custom CSS!
                            <div class="card-text">

                                <div class="row">
                                    <div class="col">
                                        <input type="date" id="closingdate" name="closingdate" class="form-control">
                                    </div>
                                    <div class="col">
                                        <input type="time" id="closingtime" name="closingtime" class="form-control">
                                    </div>
                                    <div class="col">
                                        <button type="submit" class="btn btn-primary" id="close_date_btn"
                                            name="close_date_btn">
                                            Submit
                                        </button>
                                    </div>
                                </div>
    </form>
</div>
</div>
</div>

</div>
</div>

</div>

<!--opening and closing time ends here-->

<!--page content starts here-->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#stdmodal">
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
                <!--<div class="row">
                    <div class="col-sm-12 col-md-6">
                        <div class="dataTables_length" id="dataTable_length">
                            <label>
                                Show entries
                                <select name="dataTable_length" aria-controls="dataTable" class="custom-select custom-select-sm form-control form-control-sm">
                                    <option value="10">10</option>
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                </select> 
                                
                            </label>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div id="dataTable_filter" class="dataTables_filter">
                            <label>Search:<input type="search" class="form-control form-control-sm" placeholder aria-controls="dataTable">
                        </label>
                    </div>
                </div>
            </div> -->
                <?php
                $query = "SELECT * FROM details";
                $query_run = mysqli_query($con, $query);
            ?>
                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0" role="grid"
                    style="width: 100%;">
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
                            <th>Edit</th>
                            <th>Delete</th>
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
                            <td class="align-middle">
                                <form action="project_edit.php" method="post">
                                    <input type="hidden" name="edit_id" value="<?php echo $row['id']; ?>">
                                    <button type="submit" name="edit_btn" class="btn btn-warning">
                                        EDIT
                                    </button>
                                </form>
                            </td>
                            <td class="align-middle">
                                <form action="code.php" method="post">
                                    <input type="hidden" name="delete_pro_id" value="<?php echo $row['id']; ?>">
                                    <button type="submit" name="delete_pro_btn" class="btn btn-danger">
                                        DELETE
                                    </button>
                                </form>
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
    $(document).ready(function () {
        $("#myInput").on("keyup", function () {
            var value = $(this).val().toLowerCase();
            $("#myTable2 tr").filter(function () {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
</script>
<?php
    include('includes/footer.php'); 
?>