<?php
/*
=====================================
=========== Items Page =========
=====================================
*/

session_start();

$page_title = 'Items';

if(isset($_SESSION['username'])) {

    $username = $_SESSION['username'];
    include 'init.php';

    //=== check GET request to to detect what condition to view in page [ Add | Edit | Delete ]
    $do = isset($_GET['do']) ? $_GET['do'] : 'Manage';

    if($do == 'Manage') {

        echo '<a href="?do=Add"><button class="btn btn-primary">Add</button>';

    } elseif ($do == 'Add') {

                                     /*=========================
                                      ###### Add Items Page ####
                                      ==========================*/
        ?>

        <!------------------------------ Start Add Categories Page ---------------------------------->

        <section class="edit-page">
            <h1 class="text-center">Add Items</h1>

            <div class="container">
                <form class="form-horizontal" action="?do=Insert" method="POST">

                    <!-- Start Name Failed -->
                    <div class="form-group form-group-lg">
                        <div class="row">
                            <label class="col-sm-offset-2 col-sm-2 control-label">Name</label>
                            <div class="col-sm-4">
                                <input type="text" name="name"  autocomplete="off" class="form-control" required="required">
                            </div>
                        </div>
                    </div>
                    <!-- End Name Failed -->

                    <!-- Start Description Failed -->
                    <div class="form-group form-group-lg">
                        <div class="row">
                            <label class="col-sm-offset-2 col-sm-2 control-label">Description</label>
                            <div class="col-md-4">
                                <input type="text" name="description" class="form-control" >
                            </div>
                        </div>
                    </div>
                    <!-- Start Description Failed -->

                    <!-- Start Price Failed -->
                    <div class="form-group form-group-lg">
                        <div class="row">
                            <label class="col-sm-offset-2 col-sm-2 control-label">Price</label>
                            <div class="col-md-4">
                                <input type="text" name="price" class="form-control"  required="required"   >
                            </div>
                        </div>
                    </div>
                    <!-- Start Price Failed -->

                    <!-- Start Country Failed -->
                    <div class="form-group form-group-lg">
                        <div class="row">
                            <label class="col-sm-offset-2 col-sm-2 control-label">Country</label>
                            <div class="col-md-4">
                                <input type="text" name="country" class="form-control" >
                            </div>
                        </div>
                    </div>
                    <!-- Start Country Failed -->

                    <!-- Start Status Failed -->
                    <div class="form-group form-group-lg">
                        <div class="row">
                            <label class="col-sm-offset-2 col-sm-2 control-label">Status</label>
                            <div class="col-md-4">
                                <select>
                                    <option value="1">New</option>
                                    <option value="2">Like New</option>
                                    <option value="3">Used</option>
                                    <option value="4">Old</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <!-- Start Status Failed -->

                    <!-- Start Submit Failed -->
                    <div class="form-group form-group-lg">
                        <div class="row">
                            <div class="col-sm-offset-3 col-md-offset-4 col-sm-6 col-md-4">
                                <input type="submit" value="Save" class="btn btn-lg btn-primary btn-block">
                            </div>
                        </div>
                    </div>
                    <!-- Start Submit Failed -->


                </form>
            </div>
        </section>

        <!------------------------------ End Add Categories Page ---------------------------------->

        <?php

    } elseif ($do == 'Insert') {

    } elseif ($do == 'Edit') {

    } elseif ($do == 'Update') {

    } elseif ($do == 'Delete') {

    }

    include $tpl . 'footer.php';
} else {
    header('Location:index.php');
}