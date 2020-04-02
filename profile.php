<?php 
include_once './commons/db.php';
include_once './user/userDao.php';
include_once './role/role.php';
include_once './user/user.php';
session_start();

$user = new User();
$user->setEmail($_SESSION["session_username"]);
$userDao = new UserDao();
$user = $userDao->findByEmail($user);

var_dump($user);
die;
		

$query = "select * from profile";
$result = $conn->query($query);
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
		    						<div class="panel panel-default">
		    							<div class="panel-body">
		    								
		    							
			    							
			    								<?php
			    								while($row = $result->fetch_assoc()) {
			    									
			    									echo "<h3><b>Name:</b></h3>";
        											echo $row["name"]; echo "<br>";
        											echo "<h3><b>Username:</h3> </b>";
			    								    echo $row["username"];echo "<br>";
			    									echo "<h3><b>Email:</b></h3><br>";
			    									echo $row["email"];echo "<br><br>";
			    									
			    							}
			    							?>	 

			    							<button><a href="profile_update.php">update profile info </a></button>
			    						</div>
		    						</div>
		    						
		    						
	    						</div>
    						</div>
  							
	   								
    							
  					
				</div>
    			
    		<div class="col-2"></div>
    	</div>
    </div>

    