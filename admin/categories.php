<?php
    /*
    =====================================
    =========== Categories Page =========
    =====================================
    */

    session_start();

    $page_title = 'Categories';

    if(isset($_SESSION['username'])) {

        $username = $_SESSION['username'];
        include 'init.php';

        //=== check GET request to to detect what condition to view in page [ Add | Edit | Delete ]
        $do = isset($_GET['do']) ? $_GET['do'] : 'Manage';

        if($do == 'Manage') {

            echo 'Magnage';

        } elseif ($do == 'Add') {

        } elseif ($do == 'Insert') {

        } elseif ($do == 'Edit') {

        } elseif ($do == 'Update') {

        } elseif ($do == 'Delete') {

        }

        include $tpl . 'footer.php';
    } else {
        header('Location:index.php');
    }