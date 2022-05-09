<?php 
    include('security.php');
    include('includes/header.php'); 
    include('includes/navbar.php'); 
    include('includes/topbar.php'); 

    if(isset($_POST["add"])) {
        if(isset($_SESSION["ppp"]))
        {
            
            $project_Array_id = array_column($_SESSION["ppp"], "project_id");
            if(!in_array($_GET["id"], $project_Array_id))
            {
                $count = count($_SESSION["ppp"]);
                $project_Array = array(
                    'project_id' => $_GET["id"],
                    'project_title' => $_POST["hidden_title"],
                    'project_supervisor' => $_POST["hidden_supervisor"]
                );
                $_SESSION["ppp"][$count] = $project_Array;
            }
            else{
                echo '<script> alert("item already added")</script>';
                echo '<script> window.Location="index.php"</script>';
            }
        }
        else
        {
            $project_Array = array(
                'project_id' => $_GET["id"],
                'project_title' => $_POST["hidden_title"],
                'project_supervisor' => $_POST["hidden_supervisor"]
            );
            $_SESSION["ppp"][0]= $project_Array;
        }
        }
?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
            <a href="studentlist.php"
                class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-download fa-sm text-white-50"></i>
                Generate List</a>
    </div>
    <p class="mb-4">All projects will be listed here, indicating their status accordingly.<br> 
    To add a project to your list of choices, use the three dotted symbol at the top of each project. 
    Followed by the add button.<br> <strong class="text-danger">Notice:</strong> Project submission will begin at the time listed below.</p>

    <!-- Content Row -->
    <div class="row">
        <!-- Open times -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Project submissions</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?php
                                    $today = date('Y-m-d');
                                    $query = "SELECT * FROM opentimes 
                                    WHERE closingdate >= '$today'";  
                                    $query_run = mysqli_query($con, $query);
                                    if(mysqli_num_rows($query_run) > 0){
                                    $row = mysqli_fetch_assoc($query_run);
                                    echo '<h5> '.$row['semester'].' Opens: '.$row['openingdate'].'</h5>';
                                    echo '<h5>Closes: '.$row['closingdate'].'</h5>';
                                    }
                                    else echo '<h4 class="text-danger">Currently closed.</h4>';
                                ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clock fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Projects -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total projects
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?php
                                    $query = "SELECT id FROM details ORDER BY id";  
                                    $query_run = mysqli_query($con, $query);
                                    $row = mysqli_num_rows($query_run);
                                    echo '<h4> Total Projects: '.$row.'</h4>';
                                ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-folder fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Available projects -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Available</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?php
                                    $query = "SELECT id FROM details WHERE status= 'Available' ORDER BY id";  
                                    $query_run = mysqli_query($con, $query);
                                    $row = mysqli_num_rows($query_run);
                                    echo '<h4> Available Projects: '.$row.'</h4>';
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

        <!-- Locked projects -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Locked
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                        <?php
                                    $query = "SELECT id FROM details WHERE status= 'Locked' ORDER BY id";  
                                    $query_run = mysqli_query($con, $query);
                                    $row = mysqli_num_rows($query_run);
                                    echo '<h4> Locked Projects: '.$row.'</h4>';
                                ?>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-lock fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!--Display project rows-->

    <div class="row">
        <?php
            $query = "SELECT * FROM details";
            $query_run = mysqli_query($con, $query);
            $check_details = mysqli_num_rows($query_run) > 0;
            if($check_details)
            {
                while($row = mysqli_fetch_array($query_run))
                {
                    ?>

        <div class="col-xl-3 col-md-6 mt-4 mb-4">
        <div class="card shadow  h-100">
            <form method="post" action="index.php?action=add&id=<?php echo $row["id"]; ?>">
                
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Project ID: <?php echo $row["id"]; ?></h6>
                        <div class="dropdown no-arrow">
                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                aria-labelledby="dropdownMenuLink">
                                <div class="dropdown-header">Add project to your list:</div>

                                <input type="submit" name="add" class="dropdown-item" value="Add">
                            </div>
                        </div>
                    </div>
                    <!--supervisor image for project card-->
                    <div class="row" id="changemetovideo">
                    <?php  echo '<img src="../admin/upload/'.$row['supervisorImg'].'" class="w-100"
                            height="200px;" alt="Supervisor image">' ; ?>
                            </div>
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
                                <div class="col-sm-11">
                                    <form method="post" enctype="multipart/form-data" action="view.php">
                                        <button type="submit" 
                                        class="btn btn-sm btn-block btn-primary shadow-sm  ml-3" 
                                        name="viewproject">
                                        <i class="fas fa-download fa-sm text-white-50"></i>   
                                        View Project
                                    </button>
                                        <input type="hidden" name="hidden_project" value="<?php echo $row['project']; ?>">
                                    </form>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-11" >
                                    <form method="post" action="index.php"
                                    enctype="multipart/form-data">
                                        <button type="submit" 
                                        class="btn btn-sm btn-block btn-primary shadow-sm  ml-3" 
                                        name="viewvideo">
                                        <i class="fas fa-download fa-sm text-white-50"></i>    
                                        View Tutorial
                                    </button>
                                        <input type="hidden" name="hidden_video" value="<?php echo $row['video']; ?>">
                                    </form>
                                </div>
                            </div>
                            </div>
                        
                        
                            </div>

        </div>

       
    

                            <?php
                                    
                                }
                            }
                            else{
                                echo '<span class= col-sm-8>'.'<div class="alert alert-info" role="alert">'.
                                'Info: No record found'.'</div>'.'</span>';
                            }

                            ?>


</div>
<!-- Content Row -->


<?php
if(isset($_POST['viewvideo'])){
    $myfile = $_POST['hidden_video'];
    $file = '../admin/upload/'."$myfile";
    ?>
    <div class="card shadow mb-4">
            <a href="#video_presentation" class="d-block card-header py-3" data-toggle="collapse" role="button"
                aria-expanded="true" aria-controls="collapseCardExample">
                <h6 class="m-0 font-weight-bold text-primary text-center">Video Presentations </h6>
            </a>
            <div class="collapse-show" id="video_presentation">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
<div class="alert alert-info text-center"> 
Info: To download this file press the three dotted icon, in the video controls
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

<!-- /.container-fluid -->





<?php 
    include('includes/scripts.php'); 
?>

<!--script for checkboxx-->
<script>
    function toggleCheckbox(box) {
        var id = $(box).attr("value");
        if ($(box).prop("checked") == true) {
            var selected = 1;
        } else {
            var selected = 0;
        }

        var data = {
            "selected_project": 1,
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
</script>

<?php
    include('includes/footer.php'); 
?>