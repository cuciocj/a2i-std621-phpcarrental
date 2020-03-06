<?php
session_start();

include_once './commons/db.php';
include_once './vehicle/vehicle.php';
include_once './vehicle/vehicleDao.php';

if (isset($_SESSION["loggedin"]) && !empty($_SESSION["loggedin"])) {
    echo 'Hello ' . $_SESSION["session_name"];
} else {
    header("location: login.php");
    exit;
}

// TODO:
// list cars
// add car menu
// modify car
// remove
// rental_request page

$vehicleDao = new VehicleDao();
$vehicles = $vehicleDao->list();

// echo '<pre>';
// var_dump($vehicles);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include './includes/head.php'; ?>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
</head>

<body>
    <?php include './includes/header.php'; ?>

    <div class="container">
        <div class="row">
            <div class="col-12">
                <table class="table table-image">
                    <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Image</th>
                            <th scope="col">Name</th>
                            <th scope="col">Body</th>
                            <th scope="col">Color</th>
                            <th scope="col">Transmission</th>
                            <th scope="col">Price</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($vehicles as $vehicle) { ?>
                            <tr>
                                <th scope="row"><?= $vehicle->id; ?></th>
                                <td class="w-25">
                                    <img src="<?= $vehicle->image; ?>" class="img-fluid img-thumbnail" alt="car">
                                </td>
                                <td><?= $vehicle->name; ?></td>
                                <td><?= $vehicle->body; ?></td>
                                <td><?= $vehicle->color; ?></td>
                                <td><?= $vehicle->transmission; ?></td>
                                <td><?= $vehicle->price; ?></td>
                                <td><?= ($vehicle->isReserved == 1 ? 'reserved' : 'available'); ?></td>
                                <td>
                                    <button type="button" class="btn btn-primary btn-sm btn-block" data-toggle="modal" data-target="#editCarModal">Edit</button>
                                    <button type="button" class="btn btn-secondary btn-sm btn-block">Remove</button>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Edit Car Modal -->
    <!-- Modal -->
    <div class="modal fade" id="editCarModal" tabindex="-1" role="dialog" aria-labelledby="editCarModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editCarModalLabel">Modify Car Info</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div>
                            <label for="name"><strong>Name</strong></label>
                            <input type="text" id="name" name="name" value="">
                        </div>
                        <div>
                            <label for="body"><strong>Body</strong></label>
                            <input type="text" id="body" name="body" value="">
                        </div>
                        <div>
                            <label for="color"><strong>Color</strong></label>
                            <input type="text" id="color" name="color" value="">
                        </div>
                        <div>
                            <label for="transmission"><strong>Transmission</strong></label>
                            <input type="text" id="transmission" name="transmission" value="">
                        </div>
                        <div>
                            <label for="image_url"><strong>Image URL</strong></label>
                            <input type="text" id="image_url" name="image_url" value="">
                        </div>
                        <div>
                            <label for="price"><strong>Price</strong></label>
                            <input type="text" id="price" name="price" value="">
                        </div>
                        <div>
                            <label for="price"><strong>Status</strong></label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="available">
                                <label class="form-check-label" for="inlineRadio1">available</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="reserved">
                                <label class="form-check-label" for="inlineRadio2">reserved</label>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

</body>