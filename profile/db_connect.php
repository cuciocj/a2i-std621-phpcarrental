<?php

//This is dbconn.php
$servername = "localhost"; // since this is the server on which apahce, mysql are running 
$username = "root"; //this is the default username to connect to your mysql database server
$password = "root";
$dbname = "profile";

//Create connection object to the database  using the object-oriented approach
//In w3schools, 3 approaches are giben to connect and work with php and mysql
// object-oriented, procedural and PDO.. stick to what you prefer
//For this course either use object-oriented or procedural
//THe slide content for this is outdated (it won't work for the current versio of PHP
//the w3 schools tutorial is a better starting point
$conn = new mysqli ($servername, $username, $password, $dbname);

//Check connection - checking to see if php can connect to mysql or not
// if there is an error in the connection trhen priint it out the error message using die() function

if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
	}
//echo "Connected Successfully";
?>