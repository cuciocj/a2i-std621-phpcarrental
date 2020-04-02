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

<?php include './includes/header.php'; ?>

	
    <div class="jumbotron">
      		
    </div>

    <div class="container">
    	<div class="row">
    		<div class="col-3">
    			
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
			    									echo "<h3><b>Name:</b></h3>";
        											echo "<h3>".$user->name."</h3>"; echo "<br>";
        											echo "<h3><b>Username:</h3> </b>";
			    								    echo "<h3>".$user->username."</h3>";echo "<br>";
			    									echo "<h3><b>Email:</b></h3><br>";
			    									echo "<h3>".$user->email."</h3>";echo "<br><br>";
			    							?>	 

			    							<button><a href="profile_update.php">update profile info </a></button>
			    						</div>
		    						</div>
		    						
		    						
	    						</div>
    						</div>
  							
	   								
    							
  					
				</div>
    			
    		<div class="col-3"></div>
    	</div>
	</div>
	

	<?php include './includes/footer.php'; ?>
	
</body>

</html>

    