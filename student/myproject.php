<?php 
    include('security.php');
    include('includes/header.php'); 
    include('includes/navbar.php');
    include('includes/topbar.php');
?>

<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-2">
        <h1 class="h3 mb-0 text-gray-800">Allocated Project</h1>
    </div>
    <p class="mb-4">If you have been allocated a project, it will be shown below.<br>
        1. Proceed to sign the contract provided below by your instructor.<br>
        2. Upload the signed contract into the drop space and hit confirm.<br>
    <strong class="text-danger">Notice:</strong> Mulptiple file uploads are not permited. 
    make sure you have uploaded the right file before pressing the confirm button  </p>

    <!--allocated project-->
    <div class="row">
        <?php
        $check_allocation = $_SESSION['username'];
            $query = "SELECT * FROM allocation WHERE std_email  = '$check_allocation'";
            $query_run = mysqli_query($con, $query);
            $get_allocated = mysqli_fetch_array($query_run);
            $allocated_project = $get_allocated['std_allocated'];
    
            $query2 = "SELECT * FROM details WHERE id  = '$allocated_project'";
            $query_run2 = mysqli_query($con, $query2);
            $check_details = mysqli_num_rows($query_run2) > 0;
            if($check_details)
            {
                while($row = mysqli_fetch_array($query_run2))
                {
                    ?>
        <div class="col-xl-4 col-md-6 mt-4 mb-4">
            <div class="card shadow  h-100">
                <form method="post" action="index.php?action=add&id=<?php echo $row["id"]; ?>">

                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Project ID: <?php echo $row["id"]; ?></h6>
                    </div>
                    <!--supervisor image for project card-->
                    <?php  echo '<img src="../admin/upload/'.$row['supervisorImg'].'" class="col w-100"
                         height ="300px;"    alt="Supervisor image">' ; ?>
                    <div class="card-body py-0">
                        <div class="row align-items-center">
                            <div class="col mr-2">
                                <h2 class="card-title"><?php echo '<h5>'.$row['supervisor'].'</h5>'; ?> </h2>
                                <p class="card-title mt-0"><?php echo $row['title']; ?></p>
                                <p class="footer"><?php echo '<small> Status: '.$row['status'].'</small>'; ?></p>
                                <input type="hidden" name="hidden_title" value="<?php echo $row['title']; ?>">
                                <input type="hidden" name="hidden_supervisor" value="<?php echo $row['supervisor']; ?>">
                                <input type="hidden" name="hidden_id" value="<?php echo $row['id']; ?>">
                            </div>
                        </div>
                    </div>
                </form>
                <div class="card-footer">
                    <div class="row">
                        <!--View project file-->
                        <div class="col-sm-11">
                            <form method="post" enctype="multipart/form-data" action="view.php">
                                <button type="submit" class="btn btn-sm btn-block btn-primary shadow-sm  ml-3"
                                    name="viewproject">
                                    <i class="fas fa-download fa-sm text-white-50"></i>
                                    View Project
                                </button>
                                <input type="hidden" name="hidden_project" value="<?php echo $row['project']; ?>">
                            </form>
                        </div>
                    </div>
                    <!--View video file-->
                    <div class="row">
                        <div class="col-sm-11">
                            <form method="post" enctype="multipart/form-data" action="myproject.php">
                                <button type="submit" class="btn btn-sm btn-block btn-primary shadow-sm  ml-3"
                                    name="view_video">
                                    <i class="fas fa-download fa-sm text-white-50"></i>
                                    View Tutorial
                                </button>
                                <input type="hidden" name="hidden_video" value="<?php echo $row['video']; ?>">
                            </form>
                        </div>
                    </div>
                    <!--Sign contract file-->
                    <div class="row">
                        <div class="col-sm-11">
                            <form method="post" enctype="multipart/form-data" action="view.php">
                                <button type="submit" class="btn btn-sm btn-block btn-success shadow-sm  ml-3"
                                    name="signproject">
                                    <i class="fas fa-download fa-sm text-white-50"></i>
                                    Sign Contract
                                </button>
                                <input type="hidden" name="hidden_sign" value="<?php echo $row['contract']; ?>">
                            </form>
                        </div>
                    </div>
                    <!--end butoon rows-->
                </div>
            </div>
        </div>

        <?php
                                    
                                }
                            }
                            else{
                                echo '<span class= col-sm-8>'.'<div class="alert alert-info" role="alert">'.
                                'Info: Allocated Projects Here! No Project allocated'.'</div>'.'</span>';
                            }

                            ?>




        <!--page content for upload starts here-->
        <div class="col-xl-8 col-md-6 mt-4 mb-4">
            <div class="card shadow mb-4">
                <form action="code.php" method="POST" enctype="multipart/form-data">
                    <div class="card-header py-2">
                        <div class="row">
                            <div class="col-sm-6">
                                <h6 class="m-0 mt-2 font-weight-bold text-primary">
                                    Upload Contract here
                                </h6>
                            </div>

                            <div class="col-sm-6">
                                <h6 class="m-0 font-weight-bold text-primary text-right">
                                    <!-- submit upload button -->
                                    <button type="submit" name="upload_contract" id="upload_contract"
                                        class="btn btn-primary">
                                        Confirm
                                    </button>
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

                        <div class="alert" role="alert">
                        </div>
                        <div class="droparea">Drop file here
                            <input type="file" name="std_contract" id="std_contract" class="droparea_input">
                        </div>

                    </div>
                </form>
            </div>
        </div>

    </div>
    <!-- Content Row -->
    <div class="row">
        <div class="col-xl-12">
            <span class="text-center">
                <?php
if(isset($_POST['view_video'])){
    $myfile = $_POST['hidden_video'];
    $file = '../admin/upload/'."$myfile";
    ?>
                <div class="card shadow mb-4">
                    <a href="#video_presentation2" class="d-block card-header py-3" data-toggle="collapse" role="button"
                        aria-expanded="true" aria-controls="collapseCardExample">
                        <h6 class="m-0 font-weight-bold text-primary text-center">Video Presentations </h6>
                    </a>
                    <div class="collapse-show" id="video_presentation2">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="alert alert-info text-center">
                                        <strong> Info:</strong> To download this file press the three dotted icon, in the video controls
                                    </div>
                                    <div class="col-sm-12">
                                        <?php
   echo '<video src = "'.$file.'" width = 100% height = 400 controls poster ="../admin/upload/poster.png"></video>';
}
?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
        <!-- container fluid -->
        <?php 
    include('includes/scripts.php'); 
    ?>
        <script>
            const droparea = document.querySelector(".droparea");
            const alert = document.querySelector(".alert");
            const droparea_input = document.querySelector(".droparea_input");

            droparea.addEventListener("dragover", (e) => {
                e.preventDefault();
                droparea.classList.add("hover")
            });

            droparea.addEventListener("dragleave", () => {
                droparea.classList.remove("hover")
            });

            droparea.addEventListener("drop", (e) => {
                e.preventDefault();

                const application = e.dataTransfer.files[0];
                const type = application.type;
                console.log(type);

                if (type == "application/pdf") {
                    droparea_input.files = e.dataTransfer.files;
                    return upload(application);
                } else {
                    alert.setAttribute("class", "alert alert-danger");
                    alert.innerText = "warning: Invalid file format! Only pdf files accepted";
                    return false;
                }
            });
            const upload = (application) => {
                alert.setAttribute("class", "alert alert-info");
                alert.innerText = "Info: Successfully added" + application.name + " Choose confirm to continue";
            };
        </script>
        <?php
    include('includes/footer.php'); 
?>