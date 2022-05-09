<?php 
    include('security.php');
    include('includes/header.php'); 
    include('includes/navbar.php');
    include('includes/topbar.php');
?>

<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Project Allocation</h1>
    <p class="mb-4">Displayed below are the list of student selections.
    Project id's inndicate what projects have been chosen by each student, as well as the timestamp of submission
    use the allocate button to allocate projects.<br> 
    <strong class="text-danger">Notice:</strong> The allocate button is only available when project submission time 
    has expired. <br>
    2. You need to enter the semeter you want to allocate in order to proceed with allocation of projects</p>

    <!--page content starts here-->
    <div class="card shadow mb-4">
        <div class="card-header py-2 mb-0">
            <div class="row">
                <div class="col-sm-2">
                    <h6 class="m-0 mt-2 font-weight-bold text-primary">
                        Project Selection
                    </h6>
                </div>
                <div class="col-sm-7 m-0 font-weight-bold text-primary text-center">
                <form action="projectallocation.php?action=setsemester" method="POST" class="form-inline">
                <div class="form-group mx-sm-3">
                   <input type="text" class="form-control" name="semester" placeholder="Enter semester">
                </div>
                   <input type="submit" class="btn btn-warning" id="semester_btn" 
                   name="semester_btn" value="submit">
                </form>
                </div>
                <div class="col-sm-3">
                    <h6 class="m-0 font-weight-bold text-primary text-right">
                        <!-- Allocate projects -->
                        <form action="code.php" method="POST">
                            <button type="submit" class="btn btn-primary" id="allocate_btn"
                                name="allocate_btn" disabled>
                                <span class="icon text-white-50">
                                    <i class="fas fa-flag"></i>
                                </span>
                                <span class="text">ALLOCATE</span>
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
                $query = "SELECT * FROM stdChoices ORDER BY timeStamp";
                $query_run = mysqli_query($con, $query);
            ?>
                    <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0"
                        role="grid" style="width: 100%;">
                        <thead>
                            <tr>
                                <th> ID </th>
                                <th>Student Reg. </th>
                                <th>Student Name </th>
                                <th>Student Email. </th>
                                <th>Choices </th>
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
                                <td><?php  echo $row['cid']; ?></td>
                                <td><?php  echo $row['std_id']; ?></td>
                                <td><?php  echo $row['std_name']; ?></td>
                                <td><?php  echo $row['std_email']; ?></td>
                                <td><?php  echo $row['choices']; ?></td>
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
    </script>
    <?php
        if(isset($_POST["semester_btn"]))
        {
        $enablebtn = date('Y-m-d');
        date_default_timezone_set("eet");
        $enablebtn_time =  date("H:i:s");
        $semester = $_POST["semester"];
        
        $query = "SELECT * FROM opentimes WHERE semester = '$semester'";
        $query_run = mysqli_query($con, $query);
        $checkdate = mysqli_num_rows($query_run) > 0;
            if($checkdate)
            {
                if($checkdate["openingdate"] < $enablebtn && $enablebtn >= $checkdate["closingdate"]
                ||$enablebtn >= $checkdate["closingdate"]  && $enablebtn_time > $checkdate["closingtimes"]
                ||$enablebtn >= $checkdate["closingdate"]  && $enablebtn_time <= $checkdate["closingtimes"])
                {
                ?>
        <script>
            document.getElementById("allocate_btn").disabled = false;
             window.Location="projectallocation.php";
        </script>
        <?php
            }
            else {
            ?>
        <script>
            document.getElementById("allocate_btn").disabled = true;
        </script>
<?php
     }
    }
}
?>
    <?php
    include('includes/footer.php'); 
?>