<?php
session_start();

if (!(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true)) {
    header("location: login.php");
    exit;
}

include_once '../commons/db.php';
include_once 'rentDao.php';
include_once 'rent.php';

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $rent = new Rent();
    $rent->setVehicle(trim($_POST["vehicle_id"]));
    $rent->setUser(trim($_POST["customer_id"]));
    $rent->setStartDate(trim($_POST["start_date"]));
    $rent->setEndDate(trim($_POST["end_date"]));

    $rentDao = new RentDao();
    $response = $rentDao->insert($rent);

    if($response === true) {
        // TODO: update vehicle status
        echo 'pasok sa banga';
    } else {
        echo 'fail';
    }
}

?>