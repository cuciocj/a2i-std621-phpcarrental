<?php
session_start();

if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("location: index.php");
    exit;
}

include_once 'user/userDao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = new User();
    $user->setUsername(trim($_POST["username"]));
    $user->setPassword(trim($_POST["password"]));
    $userDao = new UserDao();

    $user = $userDao->find($user);

    if (null !== $user->getId()) {
        $_SESSION["loggedin"] = true;
        $_SESSION["session_userid"] = $user->getId();
        $_SESSION["session_username"] = $user->getUsername();
        $_SESSION["session_name"] = $user->getName();
        header("location: index.php");
        exit;
    } else {
        echo 'not found';
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<?php include './includes/head.php'; ?>

<body>
    <?php include './includes/header.php'; ?>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>">
        <div class="form-group">
            <label>Username</label>
            <input type="text" class="form-control" id="username" name="username">
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>
        <div class="form-group">
            <div class="g-recaptcha" data-sitekey="6LcMLt4UAAAAAM8mkcVtez61P8hCQ4dxYqwBiOxl"></div>
            <br />
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</body>

</html>