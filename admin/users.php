<?php include "includes/admin-header.php" ?>


        

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <?php include "includes/admin-navigation.php" ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Content Row -->
            <?php
                if(isset($_GET['source'])){
                    $source = $_GET['source'];
                }else {
                    $source = '';
                }

                switch($source){
                    case 'addUser':
                        include "includes/addUser.php";
                        break;
                    case 'allBuyers':
                        include "includes/view_all_buyers.php";
                        break;
                    case 'admin':
                        include "includes/view_all_admin.php";
                        break;
                    case 'Editadmin':
                        include "includes/editAdmin.php";
                        break;
                    case 'editBuyers':
                        include "includes/edit_users.php";
                        break;
                    case 'edit':
                        include "includes/editSeller.php";
                        break;
                    default:
                        include "includes/view_all_seller.php";
                        break;
                }


            ?>
                    
                   

                   
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->
<?php include "includes/admin-footer.php" ?>
           