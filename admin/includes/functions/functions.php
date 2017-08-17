<?php

    /*
     * Title Function that echo page title in case page has variable $page_title
     * And echo Default in other page
     * */
    function getTitle() {

        global $page_title;

        if(isset($page_title)) {

            echo $page_title;

        } else {

            echo 'Default';
        }
    }