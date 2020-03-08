<?php
session_start();

if (!(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true)) {
    header("location: login.php");
    exit;
}

include_once '../commons/db.php';
include_once 'vehicle.php';
include_once 'vehicleDao.php';

if($_SERVER["REQUEST_METHOD"] == "POST") {

    $vehicle = new Vehicle();
    $vehicleDao = new VehicleDao();

    if($_POST['mode'] == 'add') {
        $vehicle->setName(trim($_POST["carName"]));
        $vehicle->setBody(trim($_POST["carBody"]));
        $vehicle->setColor(trim($_POST["carColor"]));
        $vehicle->setTransmission(trim($_POST["carTransmission"]));
        $vehicle->setImage(trim($_POST["carImage"]));
        $vehicle->setPrice(trim($_POST["carPrice"]));
        $flag = $vehicleDao->add($vehicle); 
    } else if ($_POST['mode'] == 'edit') {
        $vehicle->setId(trim($_POST["carId"]));
        $vehicle->setName(trim($_POST["carName"]));
        $vehicle->setBody(trim($_POST["carBody"]));
        $vehicle->setColor(trim($_POST["carColor"]));
        $vehicle->setTransmission(trim($_POST["carTransmission"]));
        $vehicle->setImage(trim($_POST["carImage"]));
        $vehicle->setPrice(trim($_POST["carPrice"]));
        $vehicle->setReserved(trim($_POST["carIsReserved"]));
        $flag = $vehicleDao->update($vehicle);
    } else if ($mode == "delete") {
        $vehicle->setId(trim($_POST["carId"]));
        $flag = $vehicleDao->delete($vehicle);
    }

    echo $flag === true ? 'success' : 'fail';
}
?>