<?php
session_start();

$conn = mysqli_connect("localhost", "root", "", "registeration");
if ($conn) {
    //echo "Connected successfully";

} else {
    die("Connection failed: " . mysqli_connect_error());
}
$sqli44 = mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '".$_SESSION['u_id']."'");
 session_destroy();
 header('location:login.php');   

?>