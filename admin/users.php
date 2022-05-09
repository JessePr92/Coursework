<?php 
    include('security.php');
    include('includes/header.php'); 
    include('includes/navbar.php');
    include('includes/topbar.php');
?>


<!-- Modal -->
<div class="modal fade" id="adduserprofile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add admin data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <!--<span aria-hidden="true">&times;</span>-->
                </button>
            </div>
            <form action="code.php" method="POST">
                <div class="modal-body">

                    <div class="form-group">
                        <label> Username </label>
                        <input type="text" name="username" class="form-control" placeholder="Enter Title + Full name">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control checking_email" placeholder="Enter Email">
                        <small class="error_email" style="color: red;"></small>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Enter Password">
                    </div>
                    <div class="form-group">
                        <label>Confirm Password</label>
                        <input type="password" name="confirmpassword" class="form-control"
                            placeholder="Confirm Password">
                    </div>
                    <div class="form-group">
                        <label>Student number</label>
                        <input type="text" name="std_no" class="form-control"
                            placeholder="Use Supervisor for supervisor or admin for Admin">
                    </div>
                    <div class="form-group">
                        <label>User Image</label>
                        <input type="file" name="user_img" class="form-control">
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="user_btn">Save</button>
                </div>
            </form>

        </div>
    </div>
</div>

<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">User Profiles</h1>
    <p class="mb-4">Each admin is required to upload a photo of themselves, as this will be used to list your projects.
    </p>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-sm-6">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#adduserprofile">
                            Add a new user
                        </button>
                    </h6>
                </div>
                <!-- Button trigger modal -->
                <div class="col-sm-6">
                    <h6 class="m-0 mt-2 ml-5 font-weight-bold text-primary text-right">
                        <form action="code.php" method="post">
                            <button type="submit" name="confirm_selection" class="btn btn-danger"
                                data-bs-toggle="modal" data-bs-target="#stdmodal">
                                <span class="icon text-white-50">
                                    <i class="fas fa-trash"></i>
                                </span>
                                <span class="text">Delete Selection</span>
                            </button>
                        </form>
                    </h6>
                </div>
            </div>
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
                <?php
                $query = "SELECT * FROM register";
                $query_run = mysqli_query($con, $query);
            ?>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th> Select </th>
                            <th> ID </th>
                            <th> Username </th>
                            <th>Email </th>
                            <th>UserType</th>
                            <th>Password</th>
                            <th>Img</th>
                            <th>EDIT</th>
                        </tr>
                    </thead>
                    <tbody id="myTable4">
                        <?php
                        if(mysqli_num_rows($query_run) > 0) 
                            {
                            while($row = mysqli_fetch_assoc($query_run))
                            {
                        ?>
                        <tr>
                            <td class="align-middle">
                                <input type="checkbox" onclick="toggleCheckbox(this)" value="<?php  echo $row['id']; ?>"
                                    <?php echo $row['visible'] == 1 ? "checked" : "" ?>>
                            </td>
                            <td><?php  echo $row['studentno']; ?></td>
                            <td><?php  echo $row['username']; ?></td>
                            <td><?php  echo $row['email']; ?></td>
                            <td><?php  echo $row['usertype']; ?></td>
                            <td><?php  echo $row['password']; ?></td>
                            <td class="align-middle"> <?php  echo '<img src="upload/'.$row['img'].'" width="100px;"
                            height="100px;" alt="Supervisor image">' ; ?> </td>
                            <td>
                                <form action="user_edit.php" method="post">
                                    <input type="hidden" name="edit_id" value="<?php echo $row['id']; ?>">
                                    <button type="submit" name="edit_btn" class="btn btn-warning"> EDIT</button>
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
    //script for checkbox
    function toggleCheckbox(box) {
        var id = $(box).attr("value");
        if ($(box).prop("checked") == true) {
            var visible = 1;
        } else {
            var visible = 0;
        }

        var data = {
            "search_data": 1,
            "id": id,
            "visible": visible
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
            $("#myTable4 tr").filter(function () {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
</script>
<?php
    include('includes/footer.php'); 
?>