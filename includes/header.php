<?php

    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){

        if($_SESSION["session_role"] == 1) {    // admin
            echo '<header>'
                .'<li><a href="user_list.php">Users</a></li>'
                .'<li><a href="car_list.php">Cars</a></li>'
                .'<li><a href="rent_request.php">Rent Requests</a></li>'
                .'<li><a href="profile.php">Profile</a></li>'
                .'<li><a href="logout.php">Logout</a></li>'
                .'</header>';
        } else if($_SESSION["session_role"] == 2) { // staff
            echo '<header>'
                .'<li><a href="car_list.php">Cars</a></li>'
                .'<li><a href="rent_request.php">Rent Requests</a></li>'
                .'<li><a href="profile.php">Profile</a></li>'
                .'<li><a href="logout.php">Logout</a></li>'
                .'</header>';
        } else {    // users/customers
            echo '<header>'
                .'<li><a href="index.php">Home</a></li>'
                .'<li><a href="profile.php">Profile</a></li>'
                .'<li><a href="logout.php">Logout</a></li>'
                .'</header>';
        }

        

        
        
    } else {
        echo '<header>'
                .'<li><a href="index.php">Home</a></li>'
                .'<li><a href="login.php">Login</a></li>'
                .'<li><a href="register.php">Register</a></li>'
            .'</header>';
    }
