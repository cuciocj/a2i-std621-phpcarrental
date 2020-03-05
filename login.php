<?php
session_start();
$captcha_error = "";

if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("location: index.php");
    exit;
}

include_once './commons/db.php';
include_once './user/userDao.php';
include_once './role/role.php';
include_once './user/user.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $captcha;
    if(isset($_POST['g-recaptcha-response'])){
        $captcha = $_POST['g-recaptcha-response'];
    }

    if(!$captcha){
        $captcha_error = "Please check the the captcha form.";
    } else {
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
            $_SESSION["session_role"] = $user->getRole();
    
            if($user->getRole() == 1) {
                header("location: user_list.php");
            } else if($user->getRole() == 2) {
                header("location: car_list.php");
            } else {
                header("location: index.php");
            }
            
        } else {
            echo 'not found';
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include './includes/head.php'; ?>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
</head>
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
            <p><?php echo $captcha_error; ?></p>
            <div class="g-recaptcha" data-sitekey="6LcMLt4UAAAAAM8mkcVtez61P8hCQ4dxYqwBiOxl"></div>
            <br/>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</body>

</html>