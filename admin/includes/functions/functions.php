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
     *** Home Redirect Function v2.0
     *** Redirect To  Page [ This Function Accept Parameter ]
     *** $theMsg = Echo The Error Message
     *** $url = the link who redirect to
     *** $second = Number of second before redirecting to Home
     */

    function redirectHome($theMsg, $url = null, $second = 3) {

        if($url === null) {
            $url = 'index.php';
            $link = 'Home';
        } else {

            if(isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] !=='') {
                $url = $_SERVER['HTTP_REFERER'];
                $link = 'previous';
            } else {
                $url = 'index.php';
                $link = 'Home';
            }

            $url = isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] !=='' ? $_SERVER['HTTP_REFERER'] : 'index.php';

        }

        echo  $theMsg ;
        echo '<div class="alert alert-info"> You Will Redirect To ' . $link . ' After ' . $second . '</div>';

        header("refresh:$second;url=$url");
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

    /*
     *** Count Number of Items function v1.0
     *** Function to count number of items row
     *** $item = The item to count
     *** $table = Table TO chose from
     */

    function countItems($item, $table, $stmt = null) {
        global $db_con;
        $stmt2 = $db_con -> prepare("SELECT COUNT($item) FROM $table $stmt");
        $stmt2 -> execute();
        return $stmt2 ->fetchColumn();
    }

    /*
     *** Get Latest of Items function v1.0
     *** $select = the item To select
     *** $table = table To chose from
     *** $order = column Order by [example: UserID]
     *** $limit = Number Of Items
     */

    function getLatest($select, $table, $order, $limit = 5) {
        global $db_con;
        $getStmt = $db_con -> prepare("SELECT $select FROM $table ORDER BY $order DESC LIMIT $limit");
        $getStmt -> execute();
        $rows = $getStmt -> fetchAll();
        return $rows;
    }