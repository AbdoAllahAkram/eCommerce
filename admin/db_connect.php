<?php

    $dsn        = 'mysql:host=us-cdbr-iron-east-05.cleardb.net;dbname=	heroku_946f161e637be6a';
    $db_user    = 'b7d200d372c534';
    $db_pass    = 'b4ee2afef849f30';
    $db_option  = array(
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
    );

    try {

        $db_con = new PDO($dsn, $db_user, $db_pass, $db_option);
        $db_con -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //echo "database connected successfully";
    } catch (PDOException $e) {

        echo "Datbase Error Connect " .$e -> getMessage();
    }
