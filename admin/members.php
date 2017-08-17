<?php

    /*
     =================================================
     == Manage Members Page
     == you can Add | Edit | Delete Members From Here
     ==================================================
     */

    session_start();

    $page_title = "Member";

    if(isset($_SESSION['username'])) {

        $username = $_SESSION['username'];
        include 'init.php';

        //=== check GET request to to detect what condition to view in page [ Add | Edit | Delete ]
        $do = isset($_GET['do']) ? $_GET['do'] : 'Manage';

        /*=================================
        ######## Start Manage Page ########
        =================================*/

        if($do == 'Manage') {

            /*============================
             ######## Manage Page ########
             ===========================*/

            echo $do;

        }elseif($do == 'Edit') {

            // check if GET request userID is numeric & get integer value of it

            $userid = isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET['userid']) : 0;

            $s


            ?>

            <!------------------------------ Start Edit Page ---------------------------------->

            <section class="edit-page">
                <h1 class="text-center">Edit Member</h1>

                <div class="container">
                    <form class="form-horizontal">

                        <!-- Start UserName Failed -->
                        <div class="form-group form-group-lg">
                            <div class="row">
                                <div class="col-sm-offset-3 col-md-offset-4 col-sm-6 col-md-4">
                                    <input type="text" name="username" placeholder="User Name" autocomplete="off" class="form-control">
                                </div>
                            </div>
                        </div>
                        <!-- Start UserName Failed -->

                        <!-- Start Password Failed -->
                        <div class="form-group form-group-lg">
                            <div class="row">
                                <div class="col-sm-offset-3 col-md-offset-4 col-sm-6 col-md-4">
                                    <input type="password" name="password" placeholder="Password" autocomplete="new-password" class="form-control">
                                </div>
                            </div>
                        </div>
                        <!-- Start Password Failed -->

                        <!-- Start Email Failed -->
                        <div class="form-group form-group-lg">
                            <div class="row">
                                <div class="col-sm-offset-3 col-md-offset-4 col-sm-6 col-md-4">
                                    <input type="email" name="email" placeholder="Email" class="form-control">
                                </div>
                            </div>
                        </div>
                        <!-- Start Email Failed -->

                        <!-- Start FullName Failed -->
                        <div class="form-group form-group-lg">
                            <div class="row">
                                <div class="col-sm-offset-3 col-md-offset-4 col-sm-6 col-md-4">
                                    <input type="text" name="fullname" placeholder="Full Name" class="form-control">
                                </div>
                            </div>
                        </div>
                        <!-- Start FullName Failed -->

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



            <!------------------------------ End Edit Page ---------------------------------->


        <?php } elseif($do == 'Add') {

            /*=========================
             ######## Add Page ########
             ========================*/

            echo "Welcome in Add Page";

        }

        include $tpl . 'footer.php';
    } else {

        header("Location: index.php");
    }
