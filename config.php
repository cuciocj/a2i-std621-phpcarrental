<?php

$mysqli = new mysqli("localhost","aspire2","aspire2","rentacarsystem");

// Check connection
if ($mysqli -> connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
  exit();
}

?>