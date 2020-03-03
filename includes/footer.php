<?php
    if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
        echo '<footer>'
            . '<li><a href="our_location.php">Our Location</a></li>'
            . '<li><a href="about_us.php">About Us</a></li>'
            . '<li><a href="feedback.php">Give Feedback</a></li>'
            . '</footer>';
    } else {
        echo '<footer>'
            . '<li><a href="our_location.php">Our Location</a></li>'
            . '<li><a href="about_us.php">About Us</a></li>'
            . '</footer>';
    }
?>