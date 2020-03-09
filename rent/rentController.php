<?php
session_start();

if (!(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true)) {
    header("location: login.php");
    exit;
}

include_once '../commons/db.php';
include_once 'rent.php';
include_once 'rentDao.php';

if($_SERVER["REQUEST_METHOD"] == "POST") {

    if($_POST['mode'] == 'add') {
        $rent = new Rent();
        $rent->setVehicle(trim($_POST["vehicle_id"]));
        $rent->setUser(trim($_POST["customer_id"]));
        $rent->setStartDate(trim($_POST["start_date"]));
        $rent->setEndDate(trim($_POST["end_date"]));
    
        $rentDao = new RentDao();
        $flag = $rentDao->insert($rent);
    
        if($flag === true) {
            // TODO: send acknowledgement receipt email
            echo 'success';
        } else {
            echo 'fail';
        }
    } else if ($_POST['mode'] == 'list') {
        
    }

    
}

?>