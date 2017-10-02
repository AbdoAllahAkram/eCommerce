<?php

    ob_start();
    session_start();

    $page_title = "Dashboard";

    if(isset($_SESSION['username'])) {
        $username = $_SESSION['username'];
        include "init.php";

        /* Start DashBorad Page */




        ?>

        <div class="container home-stats text-center">
            <h1>Dashboard</h1>
            <div class="row">
                <div class="col-md-3">
                    <div class="stat st-members">
                        Total Members
                        <span><a href="members.php"><?php echo countItems('UserID', 'users'); ?></a></span>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat st-pending">
                        Pending Members
                        <span><a href="members.php?do=Manage&page=pending"><?php echo countItems('RegStatus', 'users', 'WHERE RegStatus = 0') ?></a></span>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat st-items">
                        Total Items
                        <span>1500</span>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat st-comments">
                        Total Comments
                        <span>7000</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="container latest">
            <div class="row">
                <div class="col-sm-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-users"></i> Latest Registered Users
                        </div>
                        <div class="panel-body">
                            <table class="table table-striped table-inverse latest-users">
                                <thead>
                                    <tr>
                                        <td>#</td>
                                        <td>Name</td>
                                        <td>Date</td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    $latestNum = 0;
                                    $userRows = getLatest('*', 'users', 'UserID');
                                    foreach($userRows as $user) {
                                        $latestNum++;
                                        echo '<tr>
                                                <td>' . $latestNum . '</td>
                                                <td>' . $user['Username'] . '</td>
                                                <td>' . $user['Date'] . '</td>
                                                <td> 
                                                    <button class="btn btn-info"><a href="members.php?do=Edit&userid=' . $user['UserID'] . '">Edit</a></button>';
                                                    if($user['RegStatus'] == 0) {
                                                        echo '<button class="btn btn-success"><a href="members.php?do=Pending&userid=' . $user['UserID'] . '">Activate</a></button>';
                                                    }
                                               echo '</td>';

                                            echo '</tr>';
                                    }

                                ?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-tag"></i> Latest Items
                        </div>
                        <div class="panel-body">
                            Test
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php
        /* End DashBorad Page */

        include $tpl . 'footer.php';

    } else {
        header('Location: index.php');
        exit();
    }

    ob_end_flush();