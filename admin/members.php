<?php

    /*
     =================================================
     == Manage Members Page
     == you can Add | Edit | Delete Members From Here
     ==================================================
     */
    ob_start();

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
            $query = '';
            if(isset($_GET['page']) && $_GET['page'] == 'pending') {
                $query = 'AND RegStatus = 0';
            }


            $stmt = $db_con -> prepare("SELECT * FROM users WHERE GroupID != 1 $query");
            $stmt -> execute();
            $rows = $stmt -> fetchAll();

        ?>
            <div class="manage-page">
            <h1 class="text-center">Manage Members</h1>
                <div class="container">
                    <div class="table-responsive">
                        <table class="main-table table table-bordered text-center">
                            <tr>
                                <td>#ID</td>
                                <td>Username</td>
                                <td>Full Name</td>
                                <td>Email</td>
                                <td>Registerd Date</td>
                                <td>Control</td>
                            </tr>
                            <?php

                                foreach ($rows as $row) {

                                    echo '<tr>';
                                        echo '<td>' . $row['UserID'] . '</td>';
                                        echo '<td>' . $row['Username'] . '</td>';
                                        echo '<td>' . $row['FullName'] . '</td>';
                                        echo '<td>' . $row['Email'] . '</td>';
                                        echo '<td>' . $row['Date'] . '</td>';
                                        echo '<td>
                                                <a href="members.php?do=Edit&userid=' . $row['UserID'] . '"><button class="btn btn-info"><i class="fa fa-edit"></i>Edit</button></a>
                                                <a href="members.php?do=Delete&userid=' . $row['UserID'] . '"><button class="btn btn-danger"><i class="fa fa-close"></i> Delete</button></a>';

                                                if($row['RegStatus'] == 0) {
                                                    echo '<a href="members.php?do=Pending&userid=' . $row['UserID'] . '"><button class="btn btn-success"><i class="fa fa-active"></i> Activate</button></a>';
                                                }
                                           echo '</td>';

                                    echo '<tr>';
                                }

                            ?>

                        </table>

                        <a href="?do=Add"><button class="btn btn-primary"><i class="fa fa-plus"></i> New Member</button></a>

                    </div>
                </div>
            </div>


        <?php } elseif($do == 'Add') {

                                                 /*=========================
                                                 ###### Add Member Page ####
                                                 =========================*/
            ?>

            <!------------------------------ Start Add Member Page ---------------------------------->

            <section class="edit-page">
                <h1 class="text-center">Add Member</h1>

                <div class="container">
                    <form class="form-horizontal" action="?do=Insert" method="POST">

                        <!-- Start UserName Failed -->
                        <div class="form-group form-group-lg">
                            <div class="row">
                                <label class="col-sm-offset-2 col-sm-2 control-label">UserName</label>
                                <div class="col-sm-4">
                                    <input type="text" name="username"  autocomplete="off" class="form-control" required="required">
                                </div>
                            </div>
                        </div>
                        <!-- Start UserName Failed -->

                        <!-- Start Password Failed -->
                        <div class="form-group form-group-lg">
                            <div class="row">
                                <label class="col-sm-offset-2 col-sm-2 control-label">Password</label>
                                <div class="col-md-4">
                                    <input type="password" name="password" autocomplete="new-password" class="password form-control">
                                    <i class="show-pass fa fa-eye fa-2x"></i>
                                </div>
                            </div>
                        </div>
                        <!-- Start Password Failed -->

                        <!-- Start Email Failed -->
                        <div class="form-group form-group-lg">
                            <div class="row">
                                <label class="col-sm-offset-2 col-sm-2 control-label">Email</label>
                                <div class="col-md-4">
                                    <input type="email" name="email" class="form-control" required="required">
                                </div>
                            </div>
                        </div>
                        <!-- Start Email Failed -->

                        <!-- Start FullName Failed -->
                        <div class="form-group form-group-lg">
                            <div class="row">
                                <label class="col-sm-offset-2 col-sm-2 control-label">Full Name</label>
                                <div class="col-md-4">
                                    <input type="text" name="fullname" class="form-control" required="required">
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

            <!------------------------------ End Add Member Page ---------------------------------->


        <?php } elseif($do == 'Insert') {

                                                /*============================
                                                 ######## Insert Page ########
                                                 ===========================*/

            if($_SERVER['REQUEST_METHOD'] == 'POST') {

                $username = $_POST['username'];
                $password = $_POST['password'];
                $hash_password = sha1($_POST['password']);
                $email = $_POST['email'];
                $full_name = $_POST['fullname'];

                ?>
                <!--Start HTML Update Page Container-->
                <div class="update-page">
                    <div class="container">
                        <h1 class="text-center">Insert Member</h1>


                <?php


                // Validate Form Data
                $form_error = array();

                if(empty($username))
                    $form_error[] = "username can't bee empty";

                if(empty($password))
                    $form_error[] = "password can't bee empty";

                if(empty($email))
                    $form_error[] = "email can't bee empty";

                if(empty($full_name))
                    $form_error[] = "Full Name can't bee empty";

                foreach($form_error as $error) {
                    echo '<div class="alert alert-danger">' . $error . '</div>' ;
                }

                if(empty($form_error)) {

                    $count = checkItem('Username', 'users', $username);

                    if($count == 1) {
                        $theMsg = "<div class=\"alert alert-danger\">Sorry, This User Is Exist In Database";

                        redirectHome($theMsg, 'back');
                    } else {


                        // Insert Member In DataBase
                        $stmt = $db_con -> prepare("INSERT INTO
                                                      users(Username, password, Email, FullName, RegStatus, Date )
                                                VALUES(:zuser, :zpass, :zmail, :zname, 1, now())");
                        $stmt -> execute(array(

                            'zuser' => $username,
                            'zpass' => $hash_password,
                            'zmail' => $email,
                            'zname' => $full_name,
                        ));

                        $count = $stmt -> rowCount();

                        $theMsg =  '<div class="alert alert-success">' . $count . " Record Has Been Updated" . '</div>';

                        redirectHome($theMsg, 'back');

                    }

                }
                // Check if there's no error proseed the update operation

            } else {
                echo '<div class="container">';

                $theMsg = '<div class="alert alert-danger">' . 'You can\'t Browse this page directly' . '</div>';

                redirectHome($theMsg);

                echo '</div>';
            }

            ?>

            <!--End HTML Update Page Container-->
                </div>
            </div>

            <?php

        } elseif($do == 'Edit') {

                                                /*==========================
                                                 ######## Edit Page ########
                                                 =========================*/

            // check if GET request userID is numeric & get integer value of it
            $userid = isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET['userid']) : 0;

            // Select Data from database Depend on userid
            $stmt = $db_con -> prepare('SELECT * FROM users WHERE UserID = ? LIMIT 1');
            $stmt -> execute(array($userid));
            $row = $stmt -> fetch();
            $count = $stmt -> rowCount();

            // Display User Form if userid is exist in database
            if($count > 0) { ?>

                <!------------------------------ Start Edit Page ---------------------------------->

                <section class="edit-page">
                    <h1 class="text-center">Edit Member</h1>

                    <div class="container">
                        <form class="form-horizontal" action="?do=update" method="POST">

                            <input type="hidden" name="userid" value="<?php echo $userid; ?>">

                            <!-- Start UserName Failed -->
                            <div class="form-group form-group-lg">
                                <div class="row">
                                    <label class="col-sm-offset-2 col-sm-2 control-label">UserName</label>
                                    <div class="col-sm-4">
                                        <input type="text" name="username" value="<?php echo $row['Username'] ?>" autocomplete="off" class="form-control" required="required">
                                    </div>
                                </div>
                            </div>
                            <!-- Start UserName Failed -->

                            <!-- Start Password Failed -->
                            <div class="form-group form-group-lg">
                                <div class="row">
                                    <label class="col-sm-offset-2 col-sm-2 control-label">Password</label>
                                    <div class="col-md-4">
                                        <!-- Hidden Input For Old Password [ Password Trick ]-->
                                        <input type="hidden" name="old-password" value="<?php echo $row['password']; ?>" >
                                        <input type="password" name="new-password" value="" autocomplete="new-password" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <!-- Start Password Failed -->

                            <!-- Start Email Failed -->
                            <div class="form-group form-group-lg">
                                <div class="row">
                                    <label class="col-sm-offset-2 col-sm-2 control-label">Email</label>
                                    <div class="col-md-4">
                                        <input type="email" name="email" value="<?php echo $row['Email'] ?>" class="form-control" required="required">
                                    </div>
                                </div>
                            </div>
                            <!-- Start Email Failed -->

                            <!-- Start FullName Failed -->
                            <div class="form-group form-group-lg">
                                <div class="row">
                                    <label class="col-sm-offset-2 col-sm-2 control-label">Full Name</label>
                                    <div class="col-md-4">
                                        <input type="text" name="fullname" value="<?php echo $row['FullName'] ?>" class="form-control" required="required">
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

                <?php
                // If there's Such ID Show Error Message
            } else {

                echo "There's No Such ID";
            }

            } elseif($do == 'update') {

                                            /*=========================
                                             ######## Update Page #####
                                             ========================*/

            // Check if Request is Come from POST Method
            if($_SERVER['REQUEST_METHOD'] == 'POST') {

                $id          = $_POST['userid'];
                $name        = $_POST['username'];
                $email       = $_POST['email'];
                $full_name   = $_POST['fullname'];

                // Change Password Trick
                $pass = empty($_POST['new-password']) ? $_POST['old-password'] : sha1($_POST['new-password']);

                // Validate The Form

                $form_error = array();

                ?>
                <!--Start HTML Update Page Container-->
                <div class="update-page">
                    <div class="container">
                        <h1 class="text-center">Update Member</h1>


                <?php

                if(empty($name))
                    $form_error[] = "Username Can't Be Empty";

                if(empty($email))
                    $form_error[] = "Email Can't Be Empty";

                if(empty($full_name))
                    $form_error[] = "Full Name Can't Be Empty";

                foreach($form_error as $error) {
                    echo '<div class="alert alert-danger">' . $error . '</div>' ;
                }

                // Check if there's no error proseed the update operation
                if(empty($form_error)) {

                    // Update Database with new Data
                    $stmt = $db_con -> prepare('UPDATE users SET Username = ?, password = ?, Email = ?, FullName = ? WHERE  UserID = ?');
                    $stmt -> execute(array($name, $pass, $email, $full_name, $id));
                    $count = $stmt -> rowCount();

                    $theMsg =  '<div class="alert alert-success">' . $count . " Record Has Been Updated" . '</div>';
                    redirectHome($theMsg, 'back');
                }

            } else {

                echo '<div class="container">';

                $errorMsg = "<div class='alert alert-danger'> sorry you can't browse this page directly</div>";

                redirectHome($errorMsg);

                echo '</div>';

            }

            ?>
    
            <!--End HTML Update Page Container-->
                </div>
            </div>

            <?php
        } elseif($do == 'Delete') {

            /*===================================
             ######## Delete Member Page ########
             ====================================*/

            ?>
            <!--Start HTML Delete Page Container-->
            <div class="update-page">
                <div class="container">
                    <h1 class="text-center">Delete Member</h1>

            <?php

            $userid = isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET['userid']) : 0;

            // check if user ID is exist in database
            $count = checkItem('userID', 'Users', $userid);

            if($count > 0) {

                $stmt = $db_con -> prepare ('DELETE FROM users WHERE UserID = :zuser');

                $stmt -> bindParam(":zuser", $userid);

                $stmt -> execute();

                $theMsg = '<div class="alert alert-success">' . $count . " Record Has Been Deleted" . '</div>';

                redirectHome($theMsg, 'back');

            } else {
                $theMsg = '<div class="alert alert-danger">' . " This ID Not Exist" . '</div>' ;

                redirectHome($theMsg);
            }

            ?>
                    <!--End HTML Delete Page Container-->
                </div>
            </div>

            <?php

        } elseif($do == 'Pending') {

                                                    /*===================================
                                                     ######## Pending Member Page ########
                                                     ====================================*/
            ?>

            <div class="pending-page text-center">
                <div class="container">
                    <h1>Pending Member</h1>

            <?php

            $userid = isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET['userid']) : 0;

            $count = checkItem('userID', 'users', $userid);

            $stmt2 = $db_con -> prepare('SELECT RegStatus, Username FROM users WHERE UserID = ?');
            $stmt2 -> execute(array($userid));
            $row = $stmt2 -> fetch();

           //    echo $row['Username'] . $row['RegStatus'];

            if($count > 0 && $row['RegStatus'] == 0) {

                $stmt = $db_con -> prepare('UPDATE users SET regStatus = 1 WHERE userID = ?');
                $stmt -> execute(array($userid));

                $successMsg = '<div class="alert alert-success">' . $row['Username'] . ' Activated</div>';
                redirectHome($successMsg, 'back');


            }elseif($count > 0 && $row['RegStatus'] == 1) {

                $errorMsg = '<div class="alert alert-danger">This User Is Already Activated</div>';
                redirectHome($errorMsg, 'back');
            } else {
               $errorMsg = '<div class="alert alert-danger">This ID Not Exist</div>';
               redirectHome($errorMsg);
            }

            ?>
                </div>
            </div>
            <?php
        }

        include $tpl . 'footer.php';
    } else {

        header("Location: index.php");
    }
    ob_end_flush();