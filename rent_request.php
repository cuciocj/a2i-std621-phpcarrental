<?php
session_start();

if (isset($_SESSION["loggedin"]) && !empty($_SESSION["loggedin"])) {
    echo 'Hello ' . $_SESSION["session_name"];
} else {
    header("location: login.php");
    exit;
}

include_once './commons/db.php';
include_once './user/user.php';
include_once './vehicle/vehicle.php';
include_once './rent/rent.php';
include_once './rent/rentDao.php';

$rentDao = new RentDao();
$rentRequests = $rentDao->list();

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

           $('#approvalModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var data = button.data('info');
                var status = button.data('status');
                var message = $('#message').val();
                console.log(data);
                var modal = $(this);
                modal.find('.modal-title').text(status == 'approve' ? 'Approved' : 'Rejected');
                modal.find('.message-body').text('The message will be sent to user\'s email [' + data.user.email + ']');

                $.post('./rent/rentController.php', {
                        mode: 'trx',
                        status: status,
                        data: data,
                        msg: message
                });
            });

            $('#btn-close').on('click', function() {
                $('#approvalModal').modal('hide');
                location.reload();
            });

        });
    </script>
</head>

<body>
    <?php include './includes/header.php'; ?>
    <div class="container" style="margin-top: 7em">
        <div class="row">
            <div class="col-12">
                <table class="table table-image">
                    <thead>
                        <tr>
                            <th scope="col">Vehicle</th>
                            <th scope="col">User ID</th>
                            <th scope="col">Requester</th>
                            <th scope="col">Username</th>
                            <th scope="col">Email</th>
                            <th scope="col">From</th>
                            <th scope="col">To</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($rentRequests as $request) { ?>
                            <tr>
                                <th scope="row"><?= $request->getVehicle()->getName(); ?></td>
                                <td><?= $request->getUser()->getId(); ?></td>
                                <td><?= $request->getUser()->getName(); ?></td>
                                <td><?= $request->getUser()->getUsername(); ?></td>
                                <td><?= $request->getUser()->getEmail(); ?></td>
                                <td><?= $request->getStartDate(); ?></td>
                                <td><?= $request->getEndDate(); ?></td>
                                <td>
                                    <textarea id="message" name="message"></textarea>
                                    <button type="button" class="btn btn-primary btn-sm btn-block" 
                                        data-toggle="modal" data-target="#approvalModal" data-info='<?= json_encode($request); ?>' data-status="approve">Approve</button>
                                    <button type="button" class="btn btn-secondary btn-sm btn-block" 
                                        data-toggle="modal" data-target="#approvalModal" data-info='<?= json_encode($request); ?>' data-status="reject">Reject</button>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div id="approvalModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="message-body"></p>
                </div>
                <div class="modal-footer">
                    <button id="btn-close" type="button" class="btn btn-secondary">Close</button>
                </div>
            </div>
        </div>
    </div>
</body>

</html>