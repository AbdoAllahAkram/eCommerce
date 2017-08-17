<?php

    session_start();

    $page_title = "LogIn";

    //---- If session is already exist, Redirect To DashBoard
    if(isset($_SESSION['username'])) {

        header('Location: dashboard.php'); // Redirect To DashBoard
        exit();
    }

    //---- include initialize file

    $noNavbar = '';
    include 'init.php';

    //---- check if user coming from POST request ----//

    if($_SERVER['REQUEST_METHOD'] == 'POST') {

        $username = $_POST['username'];
        $password = $_POST['password'];
        $hashedpass = sha1($password);

        //---- Write Statement for database ----//
        $stmt = $db_con -> prepare('SELECT 
                                        UserID ,Username, Password 
                                    FROM 
                                        users 
                                    WHERE 
                                        Username = ? 
                                    AND 
                                        Password = ? 
                                    AND 
                                        GroupID = 1
                                    LIMIT 1');

        //---- Execute The Statement In Database ----//
        $stmt -> execute(array($username, $hashedpass));

        //Fetch Data From Database
        $row = $stmt -> fetch();

        // Check RowCount for statement ( if rowCount > 0 this mean there is a record in database ----//
        $rowCount = $stmt -> rowCount();

        //---- Check If record is exist in database
        if($rowCount > 0 ) {
            $_SESSION['username'] = $username; // Register Session Name
            $_SESSION['ID'] = $row['UserID'];  // Register Session ID
            header('Location: dashboard.php'); // Redirect To DashBoard
            exit();
        }

    }
?>


    <div class="login-form">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <h4 class="text-center">Admin Login</h4>
            <input class="form-control" type="text" name="username" placeholder="User Name" autocomplete="off" />
            <input class="form-control" type="password" name="password" placeholder="Password" autocomplete="new-password" />
            <input class="btn btn-primary btn-block" type="submit" value="Login" />
        </form>
    </div>


<?php
include $tpl . 'footer.php';
?>



