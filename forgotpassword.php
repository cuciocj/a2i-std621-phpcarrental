<?php
session_start();
$captcha_error = "";

if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("location: index.php");
    exit;
}

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

require_once 'commons/emailsender.php';
require_once 'commons/db.php';
require_once 'mailer/Mailer.php';
require_once 'mailer/mailerDao.php';
require_once 'user/user.php';
require_once 'user/userDao.php';

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $userDao = new UserDao();
    $email = $_POST['email'];
    $user = $userDao->findByEmail($email);
    
    if(isset($user)) {
        $emailsender = new EmailSender();
        $is_success = $emailsender->send(
            $user->getEmail(), 
            $user->getUsername(),
            'Password Recovery',
            'Your password for account <b>' . $user->getUsername() . '</b> is: ' . $user->getPassword());
    }

    $response = "We've sent an email to your account for instructions to recover your password.";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include './includes/head.php'; ?>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="js/popper.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
</head>

<body>
<?php include './includes/header.php'; ?>
    <div class="container">
        <?php if(isset($response)) { ?>
            <div style="padding : 20% 35% 35%;">
                <h5><?= $response ?></h5>
                <a href="login.php" style="text-decoration: none;">
                    <button type="button" class="btn btn-primary btn-block">Go to Login</button>
                </a>
            </div>
        <?php } else { ?>
            <form method="POST" action="" style="padding : 20% 35% 35%;">
                <h5><?php echo isset($error) ? $error : ""; ?></h5>
                <div class="form-group" style="text-align: center;">
                    <h6>Forgot your password?</h6>
                </div>
                <div class="form-group">
                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email here" required>
                </div>
                <input type="submit" class="btn btn-primary btn-block" value="Continue">
                <div class="form-group"></div>
            </form>
        <?php } ?>
    </div>
    <?php include './includes/footer.php'; ?>
</body>
</html>