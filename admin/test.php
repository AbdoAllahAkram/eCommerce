<?php

    session_start();

    if(isset($_SESSION['username'])) {
        $username = $_SESSION['username'];
        include 'init.php';

        $stmt = $db_con -> prepare('SELECT 
                                        Username, Email, UserID
                                    FROM
                                        users
                                    WHERE 
                                        Username = ? 
                                    AND 
                                        Password = ?
                                        ');
        $stmt -> execute(array("AbdoAllah", sha1(".000.000")));

        $row = $stmt -> fetch();

        print_r($row);

        include $tpl . 'footer.php';
    } else {
        header('Location: index.php');
    }