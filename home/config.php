<?php
$conn = mysqli_connect("localhost", "root", "", "registeration");
if ($conn) {
  //echo "Connected successfully";

} else {
  die("Connection failed: " . mysqli_connect_error());
}

?>