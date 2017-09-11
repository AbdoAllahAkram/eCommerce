<?php

    /*
     *** Get Title Function v1.0
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
     *** Home Redirect Function v1.0
     *** Redirect To Home Page [ This Function Accept Parameter ]
     *** $errorMsg = Echo The Error Message
     *** $second = Number of second before redirecting to Home
     */

    function redirectHome($errorMsg, $second = 3) {
        echo '<div class="alert alert-danger">' . $errorMsg . '</div>';
        echo '<div class="alert alert-info"> You Will Redirect To Home After ' . $second . '</div>';

        header("refresh:$second;url=index.php");
        exit();

    }

    /*
     *** Check Item Function v1.0
     *** Function To Check Items In Database [Function Accept Parameters]
     *** $select = the item To select [Example: username, item, category]
     *** $from = the table to select from [Example: Users]
     *** $value = the value of select [Example: AboAllah]
     */

    function checkItem($select, $from, $value) {

        global $db_con;
        $stmt2 = $db_con -> prepare("SELECT $select FROM $from WHERE $select = ?");
        $stmt2 -> execute(array($value));
        $count = $stmt2 -> rowCount();
        return $count;
    }