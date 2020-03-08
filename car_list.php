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

$vehicleDao = new VehicleDao();
$vehicles = $vehicleDao->list();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include './includes/head.php'; ?>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function() {

            var carInfo;

            $('#editCarModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                carInfo = button.data('info');
                console.log(carInfo);
                var modal = $(this);
                modal.find('#name').attr('value', carInfo.name);
                modal.find('#body').attr('value', carInfo.body);
                modal.find('#color').attr('value', carInfo.color);
                modal.find('#transmission').attr('value', carInfo.transmission);
                modal.find('#image_url').attr('value', carInfo.image);
                modal.find('#price').attr('value', carInfo.price);
                modal.find(carInfo.isReserved == 1 ? '#status_reserved' :
                    '#status_available').prop('checked', true);
            });

            $('#removeCarModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                carInfo = button.data('info');
                console.log(carInfo);
            });

            $('#btn_save').on('click', function() {
                var car_name = $('#name').val();
                var car_body = $('#body').val();
                var car_color = $('#color').val();
                var car_transmission = $('#transmission').val();
                var car_image = $('#image_url').val();
                var car_price = $('#price').val();
                var car_isreserved = $('input[name="car_availability_option"]:checked').val();

                $.post('./vehicle/vehicleController.php', {
                        mode: 'edit',
                        carId: carInfo.id,
                        carName: car_name,
                        carBody: car_body,
                        carColor: car_color,
                        carTransmission: car_transmission,
                        carImage: car_image,
                        carPrice: car_price,
                        carIsReserved: car_isreserved
                    },
                    function(data, status, jqXHR) {
                        if (data == 'success') {
                            alert('Car details modified successfully!');
                            $('#editCarModal').modal('hide');
                            location.reload();
                        } else {
                            alert('Edit failed. Please try again.');
                        }
                    });
            });

            $('#btn_add').on('click', function() {
                var car_name = $('#add_car_name').val();
                var car_body = $('#add_car_body').val();
                var car_color = $('#add_car_color').val();
                var car_transmission = $('#add_car_transmission').val();
                var car_image = $('#add_car_image_url').val();
                var car_price = $('#add_car_price').val();

                $.post('./vehicle/vehicleController.php', {
                        mode: 'add',
                        carName: car_name,
                        carBody: car_body,
                        carColor: car_color,
                        carTransmission: car_transmission,
                        carImage: car_image,
                        carPrice: car_price
                    },
                    function(data, status, jqXHR) {
                        if (data == 'success') {
                            alert('Car added successfully!');
                            $('#addCarModal').modal('hide');
                            location.reload();
                        } else {
                            alert('Add failed. Please try again.');
                        }
                    });
            });

            $('#btn_delete').on('click', function() {
                
                $.post('./vehicle/vehicleController.php?mode=delete', {
                        carId: carInfo.id
                    },
                    function(data, status, jqXHR) {
                        if (data == 'success') {
                            alert('Car deleted successfully!');
                            $('#removeCarModal').modal('hide');
                            location.reload();
                        } else {
                            alert('Delete failed. Please try again.');
                        }
                    });
            });

        });
    </script>
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

    <!-- Edit Car Modal -->
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
                            <label for="car_availability_option"><strong>Status</strong></label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="car_availability_option" id="status_available" value="0">
                                <label class="form-check-label" for="status_available">available</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="car_availability_option" id="status_reserved" value="1">
                                <label class="form-check-label" for="status_reserved">reserved</label>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button id="btn_save" type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Car Modal -->
    <div class="modal fade" id="addCarModal" tabindex="-1" role="dialog" aria-labelledby="addCarModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCarModalLabel">Add New Car</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div>
                            <label for="name"><strong>Name</strong></label>
                            <input type="text" id="add_car_name" name="name" value="">
                        </div>
                        <div>
                            <label for="body"><strong>Body</strong></label>
                            <input type="text" id="add_car_body" name="body" value="">
                        </div>
                        <div>
                            <label for="color"><strong>Color</strong></label>
                            <input type="text" id="add_car_color" name="color" value="">
                        </div>
                        <div>
                            <label for="transmission"><strong>Transmission</strong></label>
                            <input type="text" id="add_car_transmission" name="transmission" value="">
                        </div>
                        <div>
                            <label for="image_url"><strong>Image URL</strong></label>
                            <input type="text" id="add_car_image_url" name="image_url" value="">
                        </div>
                        <div>
                            <label for="price"><strong>Price</strong></label>
                            <input type="text" id="add_car_price" name="price" value="">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button id="btn_add" type="button" class="btn btn-primary">Add Car</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Remove Car Modal -->
    <div class="modal fade" id="removeCarModal" tabindex="-1" role="dialog" aria-labelledby="removeCarModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="removeCarModalLabel">Confirm</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this car?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button id="btn_delete" type="button" class="btn btn-danger">Delete</button>
                </div>
            </div>
        </div>
    </div>

<?php include './includes/footer.php'; ?>
</body>
</html>