<?php

    session_start();

    $page_title = "Dashboard";

    if(isset($_SESSION['username'])) {
        $username = $_SESSION['username'];
        include "init.php";

        echo "Welcome To DashBoard";

        include $tpl . 'footer.php';

    } else {
        header('Location: index.php');
        exit();
    }
