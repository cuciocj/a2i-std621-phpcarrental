

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
    			<img class="profile_img" class="responsive" src="images/sagpp.jpg">
    		</div>
    			<div class="col-6">
  							<div class="panel panel-default">
    							<div class="panel-body">
	    							<div class="panel panel-default">
    							<div class="panel-body">
	    							<h3><b>My Profile</b></h3>
	    						</div>
    						</div>
                            <form method="POST" action="profile_action.php">
                                <div class="panel panel-default">
                                <div class="panel-body">
                                    <label><h4><b>Name:</b></h4></label> <br>
                                    <input type="text" name="name" placeholder="update name"  class = "inputBox" >
                                    <h4><b>Address:</h4> </b> <br>
                                    <input type="text" name="address" placeholder="update Address" class = "inputBox">
                                    <h4><b>Email:</b></h4> <br>
                                    <input type="text" name="email" placeholder="update Email" class = "inputBox" required="required">
                                    <h4><b>Contact Number:</b></h4> <br>
                                    <input type="text" name="number" class = "inputBox" placeholder="update Contact Number">
                                    <h4><b>Short Description:</b></h4> <br>
                                    <input type="text" name="description" class = "inputBox" placeholder="update Description"><br><br>
                                    <h3><b>Select Profile Picture:</b></h3> <br>
                                    <input type="file" name="picture" id="picture">
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

    