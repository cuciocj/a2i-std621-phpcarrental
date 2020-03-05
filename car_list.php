<?php
    session_start();

    if(isset($_SESSION["loggedin"]) && !empty($_SESSION["loggedin"])) {
        echo 'Hello ' . $_SESSION["session_name"];
    } else {
        header("location: login.php");
        exit;
    }

    // TODO:
    // add car menu
    // modify car
    // remove
    // rental_request page

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include './includes/head.php'; ?>
</head>
<body>
    <?php include './includes/header.php'; ?>
    

</body>