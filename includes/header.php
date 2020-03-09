<?php

    if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {

        if ($_SESSION["session_role"] == 1) {    // admin
            echo '<header>'
                . '<li><a href="user_list.php">Users</a></li>'
                . '<li><a href="car_list.php">Cars</a></li>'
                . '<li><a href="rent_request.php">Rent Requests</a></li>'
                . '<li><a href="profile.php">Profile</a></li>'
                . '<li><a href="logout.php">Logout</a></li>'
                . '</header>';
        } else if ($_SESSION["session_role"] == 2) { // staff
            echo '<header>'
                . '<li><a href="car_list.php">Cars</a></li>'
                . '<li><a href="rent_request.php">Rent Requests</a></li>'
                . '<li><a href="profile.php">Profile</a></li>'
                . '<li><a href="logout.php">Logout</a></li>'
                . '</header>';
        } else {    // users/customers
            echo '<header>'
                . '<li ><a href="index.php">Home</a></li>'
                . '<li><a href="profile.php">Profile</a></li>'
                . '<li><a href="logout.php">Logout</a></li>'
                . '</header>';
        }
    } else {
        echo '<header>'
            . '<nav class="menu_open navbar_nav">'

            . '<ul class="menu_open navbar_ul">'
            . '<li class="menu_li">
                <a class="navbar-brand" href="index.php">
                <img id="brand-image" alt="Website Logo" src="images/logo.png" width="100px" height="80px" >
                </a>
                </li>'
            . '<li class="menu_li">
                 <a class="menu_a" href="index.php">Home</a>
                 </li>'
            . '<li class="menu_li">
                <a class="menu_a" href="login.php">Login</a>
                </li>'
            . '<li class="menu_li">
                <a class="menu_a" href="register.php">Register</a>
                </li>'
            . '</ul>'
            . '</nav>'
            . '</header>';
    }
?>