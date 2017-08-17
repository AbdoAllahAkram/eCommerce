<?php

    function lang($phrase) {

        static $lang = array(

            //---- DashBoard Navbar ----//

            'CATEGORIES'     => 'Categories',
            'ITEMS'          => 'Items',
            'MEMBERS'        => 'Members',
            'STATISTICS'     => 'Statistics',
            'LOGS'           => 'Logs',
            'EDIT PROFILE'   => 'Edit profile',
            'SETTINGS'       => 'Settings',
            'LOGOUT'         => 'LogOut',

        );

        return $lang[$phrase];
    }