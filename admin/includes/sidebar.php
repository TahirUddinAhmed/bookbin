<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="./index.php">
    <div class="sidebar-brand-icon rotate-n-15">
        
        <i class="fas fa-book"></i>
    </div>
    <div class="sidebar-brand-text mx-3">Account</div>
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<li class="nav-item active">
    <a class="nav-link" href="./index.php">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
    Product
</div>

<?php 
  if($_SESSION['user_role'] === 'admin' || $_SESSION['user_role'] === 'seller'){

?>
<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
        aria-expanded="true" aria-controls="collapseTwo">
        <i class="fa fa-fw fa-edit"></i>
        <span>Product Listing</span>
    </a>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Books/Products:</h6>
            <a class="collapse-item" href="products.php?source=addProduct">Add Product</a>
            <a class="collapse-item" href="products.php">View All Books</a>
            <a class="collapse-item" href="products.php?source=allGadgets">View All Gadgets</a>
        </div>
    </div>
</li>


<?php
  }

?>


<!-- Nav Item - Tables -->
<li class="nav-item">
    <a class="nav-link" href="orders.php">
        <i class="fas fa-fw fa-table"></i>
        <span>Your Orders</span></a>
</li>

<?php 
if($_SESSION['user_role'] === 'admin'){
?>
<!-- Nav Item - Tables -->
<li class="nav-item">
    <a class="nav-link" href="categories.php">
        <i class="fas fa-fw fa-table"></i>
        <span>Categories</span></a>
</li>

<?php
}

?>


<!-- Divider -->
<hr class="sidebar-divider">
<?php 
if($_SESSION['user_role'] === 'admin'){
?>
<!-- Nav Item - Utilities Collapse Menu -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
        aria-expanded="true" aria-controls="collapseUtilities">
        <i class="fa fa-fw fa-users"></i>
        <span>Users</span>
    </a>
    <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
        data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Users(Buyers/Sellers)</h6>
            <a class="collapse-item" href="users.php?source=addUser">Add Users</a>
            <a class="collapse-item" href="users.php?source=allBuyers">View All Buyers</a>
            <a class="collapse-item" href="users.php">View All Sellers</a>
            <a class="collapse-item" href="users.php?source=admin">Admin</a>
        </div>
    </div>
</li>

<?php
}

?>

<?php 
if($_SESSION['user_role'] === 'admin'){
?>

<li class="nav-item">
    <a class="nav-link" href="contact.php">
        <i class="fas fa-comments"></i>
        <span>Contact Us</span></a>
</li>
<?php
}
?>


<!-- Nav Item - Charts -->
<li class="nav-item">
    <a class="nav-link" href="profile.php">
        <i class="fa fa-fw fa-user"></i>
        <span>Profile</span></a>
</li>



<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>

</ul>
<!-- End of Sidebar -->