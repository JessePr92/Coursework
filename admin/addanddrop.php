<?php 
    include('security.php');
    include('includes/header.php'); 
    include('includes/navbar.php');
    include('includes/topbar.php');
?>

<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">ADD and DROP</h1>
    <p class="mb-4">All projects will be listed with their status value accordingly,
        The below collapsable cards can be used to set the openig and closing time for all projects.<br>
        We will use this time to calculate the allocation of projects automatically. </p>
    <!--page content starts here-->
    <div class="card shadow mb-4">
        <div class="card-header py-2">
            <div class="row">
                <div class="col-sm-6">
                    <h6 class="m-0 mt-2 font-weight-bold text-primary">
                        Add and Drop Request
                    </h6>
                </div>
                <div class="col-sm-6">
                    <h6 class="m-0 font-weight-bold text-primary text-right">
                        <!-- Button confim selection -->
                        <form action="code.php" method="POST">
                            <button type="submit" name="drop_project_std" name="drop_project_std"
                                class="btn btn-primary">
                                <span class="icon text-white-50">
                                    <i class="fas fa-check"></i>
                                </span>
                                <span class="text">Confirm</span>
                            </button>
                        </form>
                    </h6>
                </div>
            </div>
        </div>
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
                $query = "SELECT * FROM add_drop";
                $query_run = mysqli_query($con, $query);
            ?>
                    <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0"
                        role="grid" style="width: 100%;">
                        <thead>
                            <tr>
                                <th> Select </th>
                                <th>Student Reg. </th>
                                <th>Student Name </th>
                                <th>Student Email. </th>
                                <th>Add/Drop Form </th>
                                <th>Status </th>
                                <th>View Form </th>
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
                                <td>
                                    <input type="checkbox" onclick="toggleCheckbox(this)"
                                        value="<?php  echo $row['std_id']; ?>"
                                        <?php echo $row['selected'] == "selected" ? "checked" : "" ?>>
                                </td>
                                <td><?php  echo $row['std_id']; ?></td>
                                <td><?php  echo $row['std_name']; ?></td>
                                <td><?php  echo $row['std_email']; ?></td>
                                <td><?php  echo $row['drop_file']; ?></td>
                                <td><?php  echo $row['status']; ?></td>
                                <td class="align-middle">
                                    <form method="post" enctype="multipart/form-data" action="code.php">
                                        <input type="hidden" name="view_form_file"
                                            value="<?php echo $row['drop_file']; ?>">
                                        <button type="submit" name="view_form_btn" class="btn btn-primary"> View
                                            file</button>
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
    <?php 
    include('includes/scripts.php'); 
?>

    <!--script for checkboxx-->
    <script>
        function toggleCheckbox(box) {
            var id = $(box).attr("value");
            if ($(box).prop("checked") == true) {
                var selected = "selected";
            } else {
                var selected = "";
            }

            var data = {
                "status_data": "selected",
                "id": id,
                "selected": selected
            };
            $.ajax({
                type: "post",
                url: "code.php",
                data: data,
                success: function (response) {
                    //alert("Data checked/Unchecked");
                }
            });
        }
        //search function
        $(document).ready(function () {
            $("#myInput").on("keyup", function () {
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