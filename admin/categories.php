<?php
    /*
    =====================================
    =========== Categories Page =========
    =====================================
    */

    ob_start();
    session_start();

    $page_title = 'Categories';

    if(isset($_SESSION['username'])) {

        $username = $_SESSION['username'];
        include 'init.php';

        //=== check GET request to to detect what condition to view in page [ Add | Edit | Delete ]
        $do = isset($_GET['do']) ? $_GET['do'] : 'Manage';

        if($do == 'Manage') {

            // Sort By Order
            $sort = 'ASC';
            $sort_array = array('ASC', 'DESC');
            if(isset($_GET['sort']) && in_array($_GET['sort'], $sort_array)){
                $sort = $_GET['sort'];
            }

            $getStmt = $db_con -> prepare("SELECT * FROM categories ORDER BY `Ordering` $sort");
            $getStmt -> execute();
            $cats = $getStmt -> fetchAll();
            ?>
            <h1 class="text-center">Manage Categories</h1>
            <div class="container categories">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <span>Mange Categories</span>
                        <div class="option pull-right">
                            <i class="fa fa-sort">  </i> Order :[
                                <a href="?sort=ASC" class=" <?php if($sort == 'ASC') echo 'active' ?>">▲</a> |
                               <a href="?sort=DESC" class=" <?php if($sort == 'DESC') echo 'active' ?>" >▼</a>]

                            <i class="fa fa-eye"></i> View :[
                            <span class="active" data-view="full"> Full</span> |
                            <span class="" data-view="classic"> Classic</span>]
                        </div>

                    </div>
                    <div class="panel-body">
                        <?php
                        foreach($cats as $cat) {
                            echo '<div class="cat">';
                                echo '<div class="hidden-button">';
                                    echo '<a href="?do=Edit&Catid=' . $cat['ID']. '"><button class="btn btn-primary"><i class="fa fa-edit"></i>Edit</button></a>';
                                    echo '<a href="categories.php?do=Delete&catid='. $cat['ID'] .'"><button class="btn btn-danger"><i class="fa fa-close"></i>Delete</button></a>';
                                echo '</div>';
                                echo '<h3>' . $cat['CateName'] . '</h3>';
                                echo '<div class="full-view">';
                                    echo '<p>' . ($description = empty($cat['Description']) ? 'No Description' : $cat['Description']) .'</p>';
                                    if($cat['Visibility'] == 0) echo '<span class="visibility"><i class="fa fa-eye" ></i> Hidden</span>';
                                    if($cat['Allow_Comment'] == 0) echo '<span class="commenting"><i class="fa fa-close" ></i> Comment Disabled</span>';
                                    if($cat['Allow_Ads'] == 0) echo '<span class="ads"><i class="fa fa-close" ></i> Ads Disabled</span>';
                                echo '</div>';
                                echo '<hr>';
                            echo '</div>';
                        }
                        ?>
                    </div>
                </div>
                <a href="categories.php?do=Add"><button class="add-btn btn btn-primary"><i class="fa fa-plus"></i> Add New Category</button></a>
                <div class="clearfix"></div>
            </div>



            <?php

        } elseif ($do == 'Add') {

                                                /*=============================
                                                ###### Add Categories Page ####
                                                =============================*/
            ?>

            <!------------------------------ Start Add Categories Page ---------------------------------->

            <section class="edit-page">
                <h1 class="text-center">Add Categories</h1>

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
                        <!-- Start Name Failed -->

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

                        <!-- Start Ordering Failed -->
                        <div class="form-group form-group-lg">
                            <div class="row">
                                <label class="col-sm-offset-2 col-sm-2 control-label">Order</label>
                                <div class="col-md-4">
                                    <input type="number" name="ordering" class="form-control">
                                </div>
                            </div>
                        </div>
                        <!-- Start Ordering Failed -->

                        <!-- Start Visibility Failed -->
                        <div class="form-group form-group-lg">
                            <div class="row">
                                <label class="col-sm-offset-2 col-sm-2 control-label">Visible</label>
                                <div class="">
                                    <input id="vis-yes" type="radio" name="visibility" checked value="1">
                                    <label for="vis-yes">Yes</label>

                                </div>
                                <div class="">
                                    <input id="vis-no" type="radio" name="visibility"  value="0">
                                    <label for="vis-no">No</label>

                                </div>

                            </div>
                        </div>
                        <!-- Start Visibility Failed -->

                        <!-- Start Allow Comment Failed -->
                        <div class="form-group form-group-lg">
                            <div class="row">
                                <label class="col-sm-offset-2 col-sm-2 control-label">Allow Comment</label>
                                <div class="">
                                    <input id="comment-yes" type="radio" name="commenting" checked value="1">
                                    <label for="comment-yes">Yes</label>

                                </div>
                                <div class="">
                                    <input id="comment-no" type="radio" name="commenting"  value="0">
                                    <label for="comment-no">No</label>

                                </div>

                            </div>
                        </div>
                        <!-- Start Allow Comment Failed -->

                        <!-- Start Allow Ads Failed -->
                        <div class="form-group form-group-lg">
                            <div class="row">
                                <label class="col-sm-offset-2 col-sm-2 control-label">Allow Ads</label>
                                <div class="">
                                    <input id="ads-yes" type="radio" name="ads" checked value="1">
                                    <label for="ads-yes">Yes</label>

                                </div>
                                <div class="">
                                    <input id="ads-no" type="radio" name="ads"  value="0">
                                    <label for="ads-no">No</label>

                                </div>

                            </div>
                        </div>
                        <!-- Start Allow Ads Failed -->

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

                                                /*================================
                                                ###### Insert Categories Page ####
                                                ================================*/

            if($_SERVER['REQUEST_METHOD'] == 'POST') {

                $cate_name = $_POST['name'];
                $cate_description = $_POST['description'];
                $cate_order = $_POST['ordering'];
                $cate_visible = $_POST['visibility'];
                $cate_comment = $_POST['commenting'];
                $cate_ads = $_POST['ads'];

                ?>
                <!--Start HTML Insert Page Container-->
                <div class="update-page">
                    <div class="container">
                        <h1 class="text-center">Insert Member</h1>


                <?php

                    $form_error = Null;

                if(empty($cate_name)) {
                    $form_error = 'Name Can\'t Be Empty';
                    echo '<div class="alert alert-danger">' . $form_error . '</div>';
                }
                if(empty($form_error)) {

                    $count = checkItem('CateName', 'categories', $cate_name);

                    if($count == 1 ) {

                        $theMsg = "<div class=\"alert alert-danger\">Sorry, This Category Is Exist In Database</div>";

                        redirectHome($theMsg, 'back');

                    } else {

                        // Insert Category In Database \\

                        $stmt = $db_con -> prepare("INSERT INTO 
                                                                    categories(CateName, Description, Ordering, Visibility, Allow_Comment, Allow_Ads)
                                                                    VALUES    (:zname, :zdescrip, :zorder, :zvisibility, :zcomment, :zads)");


                        $stmt -> execute(array(
                                                'zname' => $cate_name,
                                                'zdescrip' => $cate_description,
                                                'zorder' => $cate_order,
                                                'zvisibility' => $cate_visible,
                                                'zcomment' => $cate_comment,
                                                'zads' => $cate_ads
                        ));
                        $ount = $stmt -> rowCount();

                        $theMsg = '<div class="alert alert-success">Category Has Been Added</div>';

                        redirectHome($theMsg, 'back');


                    }

                }

                ?>

                        <!--End HTML Insert Page Container-->
                    </div>
                </div>

                <?php


            } else {

                echo '<div class="container">';

                $theMsg = '<div class="alert alert-danger">' . 'You can\'t Browse this page directly' . '</div>';

                redirectHome($theMsg);

                echo '</div>';
            }


        } elseif ($do == 'Edit') {

                                                 /*=========================
                                                 ######## Edit Page ########
                                                 =========================*/

            //check get request and get category ID
            $catid = isset($_GET['Catid']) && is_numeric($_GET['Catid']) ? $_GET['Catid'] : 0;

            //check if category ID is exist
            $count = checkItem('ID', 'categories', $catid);

            if($count > 0) {

                $row = getInfo('*', 'categories', 'ID', $catid);

                ?>

                <!------------------------------ Start Add Categories Page ---------------------------------->

                <section class="edit-page">
                    <h1 class="text-center">Add Categories</h1>

                    <div class="container">
                        <form class="form-horizontal" action="?do=Update" method="POST">

                            <!-- Start Name Failed -->
                            <div class="form-group form-group-lg">
                                <div class="row">
                                    <label class="col-sm-offset-2 col-sm-2 control-label">Name</label>
                                    <div class="col-sm-4">
                                        <input type="text" name="name"  value="<?php echo $row['CateName']; ?>" class="form-control" required="required">
                                    </div>
                                </div>
                            </div>
                            <!-- Start Name Failed -->

                            <!-- Hidden input for cateID -->
                            <input type="hidden" name="catid" value="<?php echo $catid; ?>"
                            <!-- Hidden input for cateID -->

                            <!-- Start Description Failed -->
                            <div class="form-group form-group-lg">
                                <div class="row">
                                    <label class="col-sm-offset-2 col-sm-2 control-label">Description</label>
                                    <div class="col-md-4">
                                        <input type="text" name="description" value="<?php echo $row['Description']; ?>" class="form-control" >
                                    </div>
                                </div>
                            </div>
                            <!-- Start Description Failed -->

                            <!-- Start Ordering Failed -->
                            <div class="form-group form-group-lg">
                                <div class="row">
                                    <label class="col-sm-offset-2 col-sm-2 control-label">Order</label>
                                    <div class="col-md-4">
                                        <input type="number" name="ordering" value="<?php echo $row['Ordering']; ?>" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <!-- Start Ordering Failed -->

                            <!-- Start Visibility Failed -->
                            <div class="form-group form-group-lg">
                                <div class="row">
                                    <label class="col-sm-offset-2 col-sm-2 control-label">Visible</label>
                                    <div class="">
                                        <input id="vis-yes" type="radio"  name="visibility" <?php if($row['Visibility']==1) echo'checked'; ?> value="1">
                                        <label for="vis-yes">Yes</label>

                                    </div>
                                    <div class="">
                                        <input id="vis-no" type="radio" name="visibility" <?php if($row['Visibility']==0) echo'checked'; ?> value="0">
                                        <label for="vis-no">No</label>

                                    </div>

                                </div>
                            </div>
                            <!-- Start Visibility Failed -->

                            <!-- Start Allow Comment Failed -->
                            <div class="form-group form-group-lg">
                                <div class="row">
                                    <label class="col-sm-offset-2 col-sm-2 control-label">Allow Comment</label>
                                    <div class="">
                                        <input id="comment-yes" type="radio" name="commenting" <?php if($row['Allow_Comment']==1) echo'checked'; ?> value="1">
                                        <label for="comment-yes">Yes</label>

                                    </div>
                                    <div class="">
                                        <input id="comment-no" type="radio" name="commenting" <?php if($row['Allow_Comment']==0) echo'checked'; ?> value="0">
                                        <label for="comment-no">No</label>

                                    </div>

                                </div>
                            </div>
                            <!-- Start Allow Comment Failed -->

                            <!-- Start Allow Ads Failed -->
                            <div class="form-group form-group-lg">
                                <div class="row">
                                    <label class="col-sm-offset-2 col-sm-2 control-label">Allow Ads</label>
                                    <div class="">
                                        <input id="ads-yes" type="radio" name="ads" <?php if($row['Allow_Ads']==1) echo'checked'; ?> value="1">
                                        <label for="ads-yes">Yes</label>

                                    </div>
                                    <div class="">
                                        <input id="ads-no" type="radio" name="ads" <?php if($row['Allow_Ads']==0) echo'checked'; ?> value="0">
                                        <label for="ads-no">No</label>

                                    </div>

                                </div>
                            </div>
                            <!-- Start Allow Ads Failed -->

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
            }

        } elseif ($do == 'Update') {

                                                             /*=========================
                                                             ######## Update Page ######
                                                             =========================*/

            ?>
            <!--Start HTML Update Page Container-->
            <div class="update-page">
                <div class="container">
                    <h1 class="text-center">Update Member</h1>
            <?php


            if($_SERVER['REQUEST_METHOD'] == 'POST') {

                $cate_name = $_POST['name'];
                $cate_id = $_POST['catid'];
                $cate_description = $_POST['description'];
                $cate_order = $_POST['ordering'];
                $cate_visible = $_POST['visibility'];
                $cate_comment = $_POST['commenting'];
                $cate_ads = $_POST['ads'];

                $form_error = '';

                if(empty($cate_name))
                    $form_error = 'Name Can\'t Be Empty';



                if(empty($form_error)) {

                    $stmt = $db_con -> prepare("UPDATE
                                                          categories 
                                                        SET
                                                         CateName = ?, Description = ?, Ordering = ?, Visibility = ?, Allow_Comment = ?, Allow_Ads = ? WHERE ID = ?");
                    $stmt -> execute(array($cate_name, $cate_description, $cate_order, $cate_visible, $cate_comment, $cate_ads, $cate_id));
                    $count = $stmt -> rowCount();

                    $theMsg = '<div class="alert alert-success">' . $count . ' Record Has Be Update</div>';
                    redirectHome($theMsg, 'back');

                } else {
                    redirectHome($form_error, 'back');
                }


            } else {

                $theMsg =  '<div class="alert alert-danger">you can\'t browse this page directly</div>';

                redirectHome($theMsg);
            }

            ?>
            <!--End HTML Update Page Container-->
                </div>
            </div>
            <?php

        } elseif ($do == 'Delete') {

            ?>
            <!--Start HTML Delete Page Container-->
            <div class="Delete-page">
                <div class="container">
                    <h1 class="text-center">Update Member</h1>
            <?php

            $cate_id = isset($_GET['catid']) && is_numeric($_GET['catid']) ? $_GET['catid'] : 0;

            $count = checkItem('ID', 'Categories', $cate_id);

            if($count > 0) {

                $stmt = $db_con -> prepare("DELETE FROM Categories WHERE ID = ?");
                $stmt -> execute(array($cate_id));

                $theMsg = '<div class="alert alert-success">' . $count . ' Record Deleted</div>';

                redirectHome($theMsg, 'back');

            } else {

                $theMsg =  '<div class="alert alert-danger">there\'s No such ID</div>';
                redirectHome($theMsg, 'back');

            }


            ?>
            <!--End HTML Update Page Container-->
                </div>
            </div>
            <?php
        }

        include $tpl . 'footer.php';
    } else {
        header('Location:index.php');
    }
    ob_end_flush();