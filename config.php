<?php

$mysqli = new mysqli("localhost","homestead","secret","rentacarsystem");

// Check connection
if ($mysqli -> connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
  exit();
}

?>