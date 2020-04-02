<?php

session_start();

// var_dump($_SESSION["loggedin"]);
// die();

// if (!(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true)) {
//     header("location: /login.php");
//     exit;
// }

include_once '../commons/db.php';
include_once 'user.php';

include_once 'userDao.php';

if($_SERVER["REQUEST_METHOD"] == "POST") {

    $flag;
    $user;
    $userDao;

    if ($_POST['mode'] == 'update') {
        $user = new User();
        $user->setId(trim($_POST["id"]));
        $user->setUsername(trim($_POST["username"]));
        $user->setName(trim($_POST["name"]));
        $user->setEmail(trim($_POST["email"]));

        $userDao = new UserDao();
        $flag = $userDao->update($user);
        header("location: ../profile.php");
    } else if ($_POST['mode'] == 'add') {

        if($_POST['password'] != $_POST['confirm_password']){
            $_SESSION['response'] = "Password doesn't match";
            header("Location: ../register.php");
            die();
        }
        
        $user = new User();
        $user->setName(trim($_POST["name"]));
        $user->setUsername(trim($_POST["username"]));
        $user->setPassword(trim($_POST["password"]));
        $user->setEmail(trim($_POST["email"]));
        $user->setRole(3);

        $userDao = new UserDao();
        $flag = $userDao->create($user);

        if($flag == "success"){
            header("Location: ../login.php");
        }elseif($flag == "already"){
            $_SESSION['response'] = 'Account already exists';
            header("Location: ../register.php");
        }
    } else if ($_POST['mode'] == 'delete') {
        $user = new User();
        $user->setId(trim($_POST["id"]));
        $userDao = new UserDao();
        $flag = $userDao->delete($user);
    }
    
    echo $flag === true ? 'success' : 'fail';
}

?>