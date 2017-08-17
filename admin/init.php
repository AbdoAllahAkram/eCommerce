<?php


    include "db_connect.php";

    // Routes

    $langs  = 'includes/languages/';
    $funcs  = 'includes/functions/';
    $tpl    ='includes/template/';
    $css    ='layout/css/';
    $js     ='layout/js/';


    // include important files

    include $langs . 'english.php';
    include $funcs . 'functions.php';
    include $tpl . 'header.php';

    //---- Include Navebar except if exist $noNavbar
    if(!isset($noNavbar)) {
        include $tpl . 'navbar.php';
    }
