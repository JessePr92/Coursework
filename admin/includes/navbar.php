<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Euc logo -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
    <div class="sidebar-brand">
        
            <img src="../admin/euc-logo.png" width="180px" class="logo" alt="logo">
        
    </div>
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<li class="nav-item active">
    <a class="nav-link" href="index.php">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
    Students
</div>

<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
        aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-folder"></i>
        <span>Pages</span>
    </a>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Student Pages:</h6>
            <a class="collapse-item" href="editstudentdashboard.php">Project Listing</a>
            <a class="collapse-item" href="addanddrop.php">Add and drop</a>
        </div>
    </div>
</li>

<!-- Nav Item - projject allocation -->
<li class="nav-item">
    <a class="nav-link" href="projectallocation.php">
        <i class="fas fa-fw fa-wrench"></i>
        <span>Project Allocation</span></a>
</li>
<!-- Nav Item - allocated projects -->
<li class="nav-item">
    <a class="nav-link" href="allocatedprojects.php">
        <i class="fas fa-fw fa-folder"></i>
        <span> Allocated Projects</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
    Admin
</div>

<!-- Nav Item - Users -->
<li class="nav-item">
    <a class="nav-link " href="users.php" >
        <i class="fas fa-fw fa-cog"></i>
        <span>Users</span>
    </a>
</li>

<!-- Nav Item - contact us -->
<li class="nav-item">
    <a class="nav-link" href="contactus.php">
        <i class="fas fa-fw fa-phone"></i>
        <span>Contact us</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>


</ul>
<!-- End of Sidebar -->

 <!-- Scroll to Top Button-->
 <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

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
                    
                    <form action="logout.php" method="POST"> 
                        <button type="submit" name="logout_btn" class="btn btn-primary">Logout</button>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
