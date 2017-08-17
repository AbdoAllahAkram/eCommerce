<?php

    $dsn        = 'mysql:host=localhost;dbname=shop';
    $db_user    = 'root';
    $db_pass    = '';
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