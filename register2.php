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
    <?php include './includes/head.php'; ?>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://jqueryui.com/resources/demos/style.css">
    <!-- <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script> -->
    <link rel="stylesheet" type="text/css" href="css/nav.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    
</head>
<body>
    <?php include './includes/header.php'; ?>

    <!-- <div class="container">
       

        <div class="row">
            <div class="col-md-6">
                <br><br>
                <h3>CAR RENTAL SYSTEM</h3>
                
            </div>
            <div class= "col-md-6">
               <!-- <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>">
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
    </form> -->

    <form>

 <div class="container">
  <h3>About Us</h3><br>
  
    <div class="row">
      <div class="col-25">
        <label for="fname">First Name</label>
      </div>
      <div class="col-75">
        <input type="text" id="fname" name="firstname" placeholder="Your name..">
      </div>
    </div>

    <div class="row">
      <div class="col-25">
        <label for="lname">Last Name</label>
      </div>
      <div class="col-75">
        <input type="text" id="lname" name="lastname" placeholder="Your last name..">
      </div>
    </div>

    <div class="row">
      <div class="col-25">
        <label for="email">Email</label>
      </div>
      <div class="col-75">
        <input type="email" id="email" name="email" placeholder="Your email id..">
      </div>
    </div>

    <div class="row">
      <div class="col-25">
        <label for="contact">Contact Number</label>
      </div>
      <div class="col-75">
        <input type="number" id="contact" name="contact" placeholder="Your contact number..">
      </div>
    </div>

    

    <div class="col-md-2">
        <!-- <div class="row">
      <input type="submit" onclick="popup()"> -->
      <button>Submit</button>

    </div>

        </div>
      </div>
    </div>
    

    
  
</div>
</form> --
                
            </div>
            
        </div>

        
    </div>



    

    <?php include './includes/footer.php'; ?>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
     <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script> -->
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/datepicker.js"></script>
    <script src="js/nav.js"> </script>
    <script src="js/popper.min.js"></script>
   

</body>

</html>