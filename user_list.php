<?php
session_start();

if (isset($_SESSION["loggedin"]) && !empty($_SESSION["loggedin"])) {
    echo 'Hello ' . $_SESSION["session_name"];
    if (isset($_SESSION['session_role'])) {
        if ($_SESSION['session_role'] == 2) {
            header("location: car_list.php");
            exit;
        } else if ($_SESSION['session_role'] == 3) {
            header("location: index.php");
            exit;
        }
    }
} else {
    header("location: login.php");
    exit;
}

include_once './commons/db.php';
include_once './user/user.php';
include_once './user/userDao.php';

$userDao = new UserDao();
$users = $userDao->list();
// echo '<pre>';
// echo json_encode($users);
// echo '</pre>';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include './includes/head.php'; ?>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <script type="text/javascript"src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>

    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script>
        var editor;
        
        $(document).ready(function() {
            var data = <?= json_encode($users); ?>;

            var table = $('#userTable').DataTable({
                "data": data,
                "columns": [
                    {data: 'id', title: 'ID'},
                    {data: 'username', title: 'Username'},
                    {data: 'name', title: 'Name'},
                    {data: 'email', title: 'Email'},
                    {data: 'dateJoined', title: 'Date Joined'},
                    {data: 'role', title: 'Role'},
                    {data: 'isEnabled', title: 'Enabled'},
                    {defaultContent: 
                        '<button id=\'btn_edit\' type=\'button\'>Edit</button> '
                        + '<button id=\'btn_delete\' type=\'button\'>Delete</button>', 
                        orderable: false}
                ]
            });

            var editUserInfo;
            $('#userTable tbody').on('click', '#btn_edit', function () {
                editUserInfo = table.row($(this).parents('tr')).data();
                $('#editUserModal').modal('show');
                console.log(editUserInfo.id);
                var modal = $('#editUserModal');
                modal.find('#username').attr('value', editUserInfo.username);
                modal.find('#name').attr('value', editUserInfo.name);
                modal.find('#email').attr('value', editUserInfo.email);
                modal.find(editUserInfo.isEnabled == 1 ? '#status_enabled' :
                    '#status_disabled').prop('checked', true);
            });

            $('#btn_save').on('click', function() {
                $.post('./user/userController.php', {
                    mode: 'update',
                    id: editUserInfo.id,
                    username: $('#username').val(),
                    name: $('#name').val(),
                    email: $('#email').val(),
                    is_enabled: $('input[name="user_status"]:checked').val()
                },
                function(data, status, jqXHR) {
                    if(data == 'success') {
                        alert('User details edited successfully!');
                        $('#editUserModal').modal('hide');
                        location.reload();
                    } else {
                        alert('Edit user failed. Please try again.');
                    }
                });
            });

            $('#userTable tbody').on('click', '#btn_delete', function () {
                editUserInfo = table.row($(this).parents('tr')).data();
                $('#deleteUserModal').modal('show');
                console.log('delete:' + editUserInfo.id);
            });

            $('#btn_confirm_delete').on('click', function() {
                $.post('./user/userController.php', {
                    mode: 'delete',
                    id: editUserInfo.id
                },
                function(data, status, jqXHR) {
                    if(data == 'success') {
                        alert('User deleted successfully!');
                        $('#deleteUserModal').modal('hide');
                        location.reload();
                    } else {
                        alert('Delete user failed. Please try again.');
                    }
                });
            });

        });
    </script>
</head>

<body>
    <?php include './includes/header.php'; ?>
    <div class="container">
        <div class="row">
            <table id="userTable" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Date Joined</th>
                        <th>Role</th>
                        <th>Enabled</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

    <!-- edit user modal -->
    <div class="modal fade" id="editUserModal" tabindex="-1" role="dialog" aria-labelledby="editUserModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editUserModalLabel">Edit User Info</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div>
                            <label for="username"><strong>Username</strong></label>
                            <input type="text" id="username" name="username" value="">
                        </div>
                        <div>
                            <label for="name"><strong>Name</strong></label>
                            <input type="text" id="name" name="name" value="">
                        </div>
                        <div>
                            <label for="email"><strong>Email</strong></label>
                            <input type="text" id="email" name="email" value="">
                        </div>
                        <div>
                            <label for="user_status"><strong>Status</strong></label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="user_status" id="status_enabled" value="1">
                                <label class="form-check-label" for="status_enabled">enabled</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="user_status" id="status_disabled" value="0">
                                <label class="form-check-label" for="status_disabled">disabled</label>
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

    <!-- Delete User Modal -->
    <div class="modal fade" id="deleteUserModal" tabindex="-1" role="dialog" aria-labelledby="deleteUserModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteUserModalLabel">Confirm</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this user?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button id="btn_confirm_delete" type="button" class="btn btn-danger">Delete</button>
                </div>
            </div>
        </div>
    </div>

<?php include './includes/footer.php'; ?>
</body>
</html>