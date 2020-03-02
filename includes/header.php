<?php

    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
        // if session has logged in, redirect to welcome.php
        //header("location: welcome.php");
        //exit;
        echo '<header>'
                .'<li><a href="index.php>Home</a></li>'
                .'<li><a href="logout.php>Logout</a></li>'
            .'</header>';
        
    } else {
        echo '<header>'
                .'<li><a href="index.php">Home</a></li>'
                .'<li><a href="login.php">Login</a></li>'
                .'<li><a href="register.php">Register</a></li>'
            .'</header>';
    }
    
?>