<?php
    session_start();

    include_once './vehicle/vehicleDao.php';

    if (isset($_SESSION["loggedin"]) && !empty($_SESSION["loggedin"])) {
        echo 'Hello ' . $_SESSION["session_name"];
    }

    $vehicleDao = new VehicleDao();
    $vehicles = $vehicleDao->list();
?>

<!DOCTYPE html>
<html lang="en">
<?php include './includes/head.php'; ?>
<body>
    <?php include './includes/header.php'; ?>
    <?php
    foreach ($vehicles as $vehicle) {
        echo "<div class='card' style='width: 18rem;'>"
                ."<img src='". $vehicle->getImage() ."' class='card-img-top' alt='...'>"
                ."<div class='card-body'>"
                    ."<h5 class='card-title'>" . $vehicle->getName() . "</h5>"
                    ."<p class='card-text'>"
                        ."body: " . $vehicle->getBody() . "<br>"
                        ."color: " . $vehicle->getColor() . "<br>"
                        ."transmission: " . $vehicle->getTransmission() . "<br>"
                        ."price: " . $vehicle->getPrice() . " p/w"
                    ."</p>"
                    ."<a href='" . // rent.php if logged-in, login.php if not logged-in. refactor this please.
                        ((isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) ? "rent.php" : "login.php") 
                    . "' class='btn btn-primary'>Book this Car</a>"
                ."</div>"
            ."</div>";
    }
    ?>
<?php include './includes/footer.php'; ?>
</body>

</html>