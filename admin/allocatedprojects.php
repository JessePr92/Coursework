<?php 
    include('security.php');
    include('includes/header.php'); 
    include('includes/navbar.php');
    include('includes/topbar.php');
?>

<!-- Modal -->
<div class="modal fade" id="mail_std" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Mail Students with Allocated Projects</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>

            <form action="mailstd.php" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Subject</label>
                        <input type="text" name="mail_sub" class="form-control" placeholder="Enter Subject" required>
                    </div>
                    <div class="form-group">
                        <label>CC</label>
                        <input type="text" name="mail_cc" class="form-control"
                            placeholder="Enter CC someone in this email" required>
                    </div>
                    <div class="form-group">
                        <label>Message</label>
                        <textarea type="text" name="mail_mes" class="form-control" placeholder="Enter Message"
                            required></textarea>
                    </div>
                    <div class="form-group">
                        <label>Message Attachment</label>
                        <input type="file" name="mail_attach" id="mail_attach" class="form-control" required>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="mail_std_btn">Save</button>
                </div>
            </form>

        </div>
    </div>
</div>

<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Allocated Projects</h1>
        <button type="submit" name="mail_std" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"
            data-bs-toggle="modal" data-bs-target="#mail_std">
            <i class="fas fa-sms fa-sm text-white-50"></i>
            Mail students</button>
    </div>
    <p class="mb-4">All projects will be listed with their status value accordingly,
        The below collapsable cards can be used to set the openig and closing time for all projects.<br>
        We will use this time to calculate the allocation of projects automatically. </p>



    <!--first table (allocated projects)-->
    <div class="col-lg-12">

        <div class="card shadow mb-4">
            <a href="#allocated_selected_projects" class="d-block card-header py-3" data-toggle="collapse" role="button"
                aria-expanded="true" aria-controls="collapseCardExample">
                <h6 class="m-0 font-weight-bold text-primary">Allocated Projects</h6>
            </a>
            <div class="collapse" id="allocated_selected_projects">
                <div class="card-body">
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
                $query = "SELECT * FROM allocation";
                $query_run = mysqli_query($con, $query);
            ?>
                            <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0"
                                role="grid" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Student Reg. </th>
                                        <th>Student Name </th>
                                        <th>Student Email. </th>
                                        <th>Project Id </th>
                                        <th>Title </th>
                                        <th>Supervisor </th>
                                        <th>Time Stamp </th>
                                    </tr>
                                </thead>
                                <tbody id="myTable">
                                    <?php
                        if(mysqli_num_rows($query_run) > 0) 
                            {
                            while($row = mysqli_fetch_assoc($query_run))
                            {
                        ?>
                                    <tr>
                                        <td><?php  echo $row['std_id']; ?></td>
                                        <td><?php  echo $row['std_name']; ?></td>
                                        <td><?php  echo $row['std_email']; ?></td>
                                        <td><?php  echo $row['std_allocated']; ?></td>
                                        <td><?php  echo $row['title']; ?></td>
                                        <td><?php  echo $row['supervisor']; ?></td>
                                        <td><?php  echo $row['timeStamp']; ?></td>

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
        </div>
    </div>


    <!--second table (unallocated projects) starts here-->
    <div class="col-lg-12">

        <div class="card shadow mb-4">
            <a href="#unallocated_selected_projects" class="d-block card-header py-3" data-toggle="collapse"
                role="button" aria-expanded="true" aria-controls="collapseCardExample">
                <h6 class="m-0 font-weight-bold text-primary">Students Unallocated </h6>
            </a>
            <div class="collapse" id="unallocated_selected_projects">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <input class="form-control" id="myInput2" type="text" placeholder="Search..">
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
                $query = "SELECT std_id, std_name, std_email FROM stdChoices 
                EXCEPT
                 SELECT std_id, std_name, std_email FROM  allocation ";
                $query_run = mysqli_query($con, $query);
            ?>
                            <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0"
                                role="grid" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Student Reg. </th>
                                        <th>Student Name </th>
                                        <th>Student Email. </th>
                                        <th>Project ID</th>
                                        <th>Edit</th>
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
                                        <td><?php  echo $row['std_id']; ?></td>
                                        <td><?php  echo $row['std_name']; ?></td>
                                        <td><?php  echo $row['std_email']; ?></td>
                                        <td>-</td>
                                        <td>
                                            <form action="unallocated_edit.php" method="post">
                                                <input type="hidden" name="edit_una_id" id="edit_una_id"
                                                    value="<?php echo $row['std_id']; ?>">
                                                <button type="submit" name="edit_unallocated_btn"
                                                    class="btn btn-warning" data-bs-toggle="modal"
                                                    data-bs-target="#edit_allocation_modal">
                                                    EDIT</button>
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
        </div>
    </div>

    <!--third table (signed contracts) starts here-->
    <div class="col-lg-12">

        <div class="card shadow mb-4">
            <a href="#signed_contracts" class="d-block card-header py-3" data-toggle="collapse" role="button"
                aria-expanded="true" aria-controls="collapseCardExample">
                <h6 class="m-0 font-weight-bold text-primary">Signed Contracts </h6>
            </a>
            <div class="collapse" id="signed_contracts">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <input class="form-control" id="myInput3" type="text" placeholder="Search..">
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
                $query = "SELECT * FROM allocation 
                WHERE contract != 0 ";
                $query_run = mysqli_query($con, $query);
            ?>
                            <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0"
                                role="grid" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Student Reg. </th>
                                        <th>Student Name </th>
                                        <th>Student Email. </th>
                                        <th>Project ID</th>
                                        <th>Supervisor </th>
                                        <th>Contract </th>
                                        <th>View</th>
                                    </tr>
                                </thead>
                                <tbody id="myTable3">
                                    <?php
                        if(mysqli_num_rows($query_run) > 0) 
                            {
                            while($row = mysqli_fetch_assoc($query_run))
                            {
                        ?>
                                    <tr>
                                        <td><?php  echo $row['std_id']; ?></td>
                                        <td><?php  echo $row['std_name']; ?></td>
                                        <td><?php  echo $row['std_email']; ?></td>
                                        <td><?php  echo $row['std_allocated']; ?></td>
                                        <td><?php  echo $row['supervisor']; ?></td>
                                        <td><?php  echo $row['contract']; ?></td>
                                        <td>
                                            <form action="view.php" method="post">
                                                <input type="hidden" name="view_contract_id" id="view_contract_id"
                                                    value="<?php echo $row['contract']; ?>">
                                                <button type="submit" name="view_contract_btn" class="btn btn-primary">
                                                    View Contract</button>
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
        </div>
    </div>

    <?php 
    include('includes/scripts.php'); 
    ?>
    <script>
        //search function
        $(document).ready(function () {
            $("#myInput").on("keyup", function () {
                var value = $(this).val().toLowerCase();
                $("#myTable tr").filter(function () {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
        //search function
        $(document).ready(function () {
            $("#myInput2").on("keyup", function () {
                var value = $(this).val().toLowerCase();
                $("#myTable2 tr").filter(function () {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
        //search function
        $(document).ready(function () {
            $("#myInput3").on("keyup", function () {
                var value = $(this).val().toLowerCase();
                $("#myTable3 tr").filter(function () {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>
    <?php
    include('includes/footer.php'); 
?>