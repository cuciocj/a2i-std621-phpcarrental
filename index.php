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
<head>
    <?php include './includes/head.php'; ?>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://jqueryui.com/resources/demos/style.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="js/datepicker.js"></script>
    <script>
        $(document).ready(function() {
            $('.book').on('click', function() {

                console.log(this.id + " " );

            });
        });

    </script>
</head>
<body>
    <?php include './includes/header.php'; ?>
    <?php foreach ($vehicles as $vehicle) { ?>
        <div class='card' style='width: 18rem;'>
            <img src='<?= $vehicle->getImage() ?>' class='card-img-top' alt='...'>
            <div class='card-body'>
                <h5 class='card-title'><?= $vehicle->getName() ?></h5>
                <p class='card-text'>$ <?= $vehicle->getPrice() ?> per day</p>
            </div>
            <button class='btn btn-primary'
                <?php if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true ) { ?>
                    data-toggle='modal' data-target='#carModal-<?= $vehicle->getId() ?>'
                <?php } else { ?>
                    onclick="location.href='login.php';"
                <?php } ?> 
            >
                Book this Car
            </button>
        </div>

        <!-- Car Modal -->
        <div class="modal fade" id="carModal-<?= $vehicle->getId() ?>" tabindex="-1" role="dialog" aria-labelledby="carModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="carModalLabel-<?= $vehicle->getId() ?>"><?= $vehicle->getName() ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="vehicle_id" value="<?= $vehicle->getName() ?>">
                    <img class='card-img-top' src='<?= $vehicle->getImage() ?>' alt='...'>
                    <label for="from"><strong>From</strong></label>
                    <input type="text" id="from" name="from">
                    <label for="to"><strong>to</strong></label>
                    <input type="text" id="to" name="to">
                    <div>
                        <strong>body</strong> <?= $vehicle->getBody() ?><br>
                        <strong>color:</strong> <?= $vehicle->getColor() ?><br>
                        <strong>transmission:</strong> <?= $vehicle->getTransmission() ?><br>
                        <strong>image info:</strong> <?= $vehicle->getImage() ?><br>
                        <strong>price:</strong> $<?= $vehicle->getPrice() ?> per day<br>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button id="btn_book-<?= $vehicle->getId() ?>" type="button" class="btn btn-primary book">Book Now</button>
                </div>
                </div>
            </div>
        </div>

    <?php }; ?>

<?php include './includes/footer.php'; ?>
</body>

</html>