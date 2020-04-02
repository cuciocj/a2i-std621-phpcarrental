<?php 
include_once './commons/db.php';
include_once './user/userDao.php';
include_once './role/role.php';
include_once './user/user.php';
session_start();

$user = new User();
$userDao = new UserDao();
$user = $userDao->findById($_SESSION["session_userid"]);

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>User's Profile</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<meta charset="utf-8">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="style/style.css">

	
</head>
<body>
    <div class="jumbotron">
      		
    </div>

    <div class="container">
    	<div class="row">
    		<div class="col-4">
    			
    		</div>
    			<div class="col-6">
  							<div class="panel panel-default">
    							<div class="panel-body">
	    							<div class="panel panel-default">
    							<div class="panel-body">
	    							<h3><b>My Profile</b></h3>
	    						</div>
    						</div>
                            <form method="POST" action="user/userController.php">
                                <div class="panel panel-default">
                                <div class="panel-body">
                                    <label><h4><b>Name:</b></h4></label> <br>
                                    <input type="text" name="name" placeholder="update name" value="<?php echo $user->name; ?>"  class = "inputBox" >
                                    <h4><b>Username:</h4> </b> <br>
                                    <input type="text" name="username" placeholder="update Username" value="<?php echo $user->username; ?>"  class = "inputBox">
                                    <h4><b>Email:</b></h4> <br>
                                    <input type="text" name="email" placeholder="update Email" value="<?php echo $user->email; ?>"  class = "inputBox" required="required">
									<input type="hidden" name="id" value="<?php echo $user->id; ?>" />
									<input type="hidden" name="mode" value="update" />
                                    <input type="submit" value="Update">
                                    
                                </div>
                            </div>
                            </form>
                            <a href="profile.php">Return to Profile</a>
    						
	    						</div>
    						</div>
  							
	   								
    							
  					
				</div>
    			
    		<div class="col-2"></div>
    	</div>
    </div>

    