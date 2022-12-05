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

                        // redirect to different pages according to condition
                        switch($source){
                            case 'addProduct': 
                                include "includes/addProduct.php";
                                break;
                            case 'books':
                                include "includes/addBooks.php";
                                break;
                            case 'gadgets':
                                include "includes/addGadgets.php";
                                break;
                            case 'allGadgets':
                                include "includes/view_all_gadgets.php";
                                break;
                            case 'edit':
                                include "includes/editBooks.php";
                                break;
                            case 'editGadget':
                                    include "includes/editGadgets.php";
                                    break;
                            default:
                             include "includes/view_all_products.php";
                             break;
                        }

                    ?>

                   

                   
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->
<?php include "includes/admin-footer.php" ?>
           