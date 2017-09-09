<?php

    /*
     *** Title Function that echo page title in case page has variable $page_title
     *** And echo Default in other page
    */
    function getTitle() {

        global $page_title;

        if(isset($page_title)) {

            echo $page_title;

        } else {

            echo 'Default';
        }
    }

    /*
     *** Home Redirect Function [ This Function Accept Parameter ]
     *** $errorMsg = Echo The Error Message
     *** $second = Number of second before redirecting to Home
     */

    function redirectHome($errorMsg, $second = 3) {
        echo '<div class="alert alert-danger">' . $errorMsg . '</div>';
        echo '<div class="alert alert-info"> You Will Redirect To Home After ' . $second . '</div>';

        header("refresh:$second;url=index.php");
        exit();

    }