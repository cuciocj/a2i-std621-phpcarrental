<?php
    include_once './vehicle/vehicleDao.php';

    $vehicleDao = new VehicleDao();
    $vehicles = $vehicleDao->list();
?>

<!DOCTYPE html>
<html lang="en">
<html>
<?php include 'includes/head.php'; ?>

<body>
    <?php include 'includes/header.php'; ?>

    <a href="index.php">
        <h1>RACAR</h1>
    </a>

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
                    ."<a href='#' class='btn btn-primary'>Rent</a>"
                ."</div>"
            ."</div>";
    }
    ?>
</body>

</html>