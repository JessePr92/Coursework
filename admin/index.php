<?php 
    include('security.php');
    include('includes/header.php'); 
    include('includes/navbar.php'); 
    include('includes/topbar.php'); 
?>

<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Modal -->
<div class="modal fade" id="mail_std2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Mail All Registered Students</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
           
            <form action="mailstd.php" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                <div class="form-group">
                        <label>Subject</label>
                        <input type="text" name="mail_sub2" class="form-control" placeholder="Enter Subject" required>
                    </div>
                    <div class="form-group">
                        <label>CC</label>
                        <input type="text" name="mail_cc2" class="form-control" 
                        placeholder="Enter CC someone in this email" required>
                    </div>
                    <div class="form-group">
                        <label>Message</label>
                        <textarea type="text" name="mail_mes2" class="form-control" placeholder="Enter Message" required></textarea>
                    </div>
                    <div class="form-group">
                        <label>Message Attachment</label>
                        <input type="file" name="mail_attach2" id="mail_attach" class="form-control" required>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="mail_std_btn2">Save</button>
                </div>
            </form>

        </div>
    </div>
</div>

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        <button type="submit" name="mail_std2"
        class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#mail_std2">
        <i class="fas fa-sms fa-sm text-white-50"></i> 
        Mail students</button>
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- total supervisors listed -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total registered Supervisors
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?php
                                    $query = "SELECT id FROM register WHERE usertype='Supervisor' ORDER BY id";  
                                    $query_run = mysqli_query($con, $query);
                                    $row = mysqli_num_rows($query_run);
                                    echo '<h4> Total Supervisors: '.$row.'</h4>';
                                ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Total student card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total registered Students 
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                    <?php
                                        $query = "SELECT id FROM register WHERE usertype='Student' ORDER BY id";  
                                        $query_run = mysqli_query($con, $query);
                                        $row = mysqli_num_rows($query_run);
                                        echo '<h4> Total Students: '.$row.'</h4>';
                                    ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total projects listed -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Total listed projects
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                            <?php
                                    $query = "SELECT id FROM details ORDER BY id";  
                                    $query_run = mysqli_query($con, $query);
                                    $row = mysqli_num_rows($query_run);
                                    echo '<h4> Total projects: '.$row.'</h4>';
                                ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-file-alt fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Pending Requests Card for add and drop -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                ADD AND DROP Requests</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                            <?php
                                    $query = "SELECT std_id FROM add_drop WHERE status = 'pending' ORDER BY std_id";  
                                    $query_run = mysqli_query($con, $query);
                                    $row = mysqli_num_rows($query_run);
                                    echo '<h4> Pending Requests: '.$row.'</h4>';
                                ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-bell fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Row -->



</div>
<!-- /.container-fluid -->




<?php 
    include('includes/scripts.php'); 
    include('includes/footer.php'); 
?>