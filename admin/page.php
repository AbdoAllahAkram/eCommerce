<?php

    // Categories => [ Manage - Edit - Update - Add - Insert - Delete ]

    $do = '';

    if(isset($_GET['do'])) {

        $do = $_GET['do'];

    } else {

        $do = 'manage';
    }

    if($do == 'manage') {

        echo "welcome to manage page";
    } elseif($do == 'edit') {

        echo "welcome to edit page";
    } elseif($do == 'update') {

        echo "welcome to update page";
    } elseif($do == 'add') {

        echo "welcome to add page";
    } else {

        echo "welcome to manage page";
    }
