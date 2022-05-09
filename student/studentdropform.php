<?php 
    include('security.php');
    include('includes/header.php'); 
    include('includes/navbar.php');
    include('includes/topbar.php');
?>

<div class="container-fluid">
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
<h1 class="h3 mb-0 text-gray-800">Add And Drop form</h1>
<form method="post" enctype="multipart/form-data" action="code.php">
            <button type="submit" name="download_drop_form" id="download_drop_form"
                class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-download fa-sm text-white-50"></i>
                Request Drop Form</button>
        </form>
    </div>
<p class="mb-4">If you have been allocated a project, and wish to drop this project.<br>
        1. Request a drop form using the button at the top right corner (Request drop form).<br>
        2. Upload the signed drop form into the drop space and hit confirm.<br>
    <strong class="text-danger">Notice:</strong> Mulptiple file uploads are not permited. 
    make sure you have uploaded the right file before pressing the confirm button  </p>

<!--page content starts here-->
<div class="card shadow mb-4">
<form action="code.php" method="POST" enctype="multipart/form-data">
        <div class="card-header py-2">
        <div class="row">
        <div class="col-sm-6">
            <h6 class="m-0 mt-2 font-weight-bold text-primary">
            Upload Add/ Drop form here
            </h6>
        </div>
        
        <div class="col-sm-6">
        <h6 class="m-0 font-weight-bold text-primary text-right">
                <!-- submit upload button -->
                <button type="submit" name="upload_drop_form" id="upload_drop_form" class="btn btn-primary">
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
                <input type="file" name="std_drop_form" id="std_drop_form" class="droparea_input">
            </div>
             
    </div>
    </form>
</div>
<?php 
    include('includes/scripts.php'); 
    ?>
    <script>
        const droparea = document.querySelector(".droparea"); 
        const alert = document.querySelector(".alert"); 
        const droparea_input = document.querySelector(".droparea_input"); 

        droparea.addEventListener("dragover", (e)=>{
            e.preventDefault();
            droparea.classList.add("hover")
        });

        droparea.addEventListener("dragleave", ()=>{
            droparea.classList.remove("hover")
        });

        droparea.addEventListener("drop", (e)=>{
            e.preventDefault();

            const application = e.dataTransfer.files[0];
            const type = application.type;
            console.log(type);

            if(type == "application/pdf")
                {
                    droparea_input.files = e.dataTransfer.files;
                return upload(application);
            }
            else {
                alert.setAttribute("class", "alert alert-danger");
                alert.innerText = "warning: Invalid file format! Only pdf files accepted";
                return false;}
        });
        const upload = (application) => {
            alert.setAttribute("class", "alert alert-info");
            alert.innerText = "Info: Successfully added" + application.name + " Choose confirm to continue";
        };
    </script>
    <?php
    include('includes/footer.php'); 
?>