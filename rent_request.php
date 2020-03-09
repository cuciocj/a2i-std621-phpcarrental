<?php
session_start();

if (isset($_SESSION["loggedin"]) && !empty($_SESSION["loggedin"])) {
    echo 'Hello ' . $_SESSION["session_name"];
} else {
    header("location: login.php");
    exit;
}

include_once './commons/db.php';
include_once './rent/rent.php';
include_once './rent/rentDao.php';

$rentDao = new RentDao();
$rentRequests = $rentDao->list();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include './includes/head.php'; ?>
</head>
<body>
    <?php include './includes/header.php'; ?>
    <div class="container">
        <button type="button" class="btn btn-primary btn-lg btn-block" data-toggle="modal" data-target="#addCarModal">Add Car</button>
        <div class="row">
            <div class="col-12">
                <table class="table table-image">
                    <thead>
                        <tr>
                            <th scope="col">Vehicle</th>
                            <th scope="col">Image</th>
                            <th scope="col">ID</th>
                            <th scope="col">Requester</th>
                            <th scope="col">Username</th>
                            <th scope="col">Email</th>
                            <th scope="col">From</th>
                            <th scope="col">To</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td scope="row"></td>
                            <td class="w-25">
                                
                            </td>
                        </tr>
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
                                    <button type="button" class="btn btn-primary btn-sm btn-block" data-toggle="modal" data-target="#editCarModal" data-info='<?= json_encode($vehicle); ?>'>Edit</button>
                                    <button type="button" class="btn btn-secondary btn-sm btn-block" data-toggle="modal" data-target="#removeCarModal" data-info='<?= json_encode($vehicle); ?>'>Remove</button>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>