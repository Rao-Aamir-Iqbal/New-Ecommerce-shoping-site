<?php
session_start();
$id = $_GET['id'];
$conn = mysqli_connect("localhost","root","","registeration");
if($conn) {
    //echo "Connected successfully";
    
  }else{
    die("Connection failed: " . mysqli_connect_error());
  }
  if(isset($id)){
    $sql = "DELETE FROM `products` WHERE id= '".$id."'";
    $execute = mysqli_query($conn, $sql);
    if($execute){
        $_SESSION['add_p_msg'] = "Your Product Deleted Successfully!";
        header('location:product.php');
    }else{
        $_SESSION['add_p_msg'] = "Your Product Not Deleted Successfully!";
        header('location:product.php');
    }
  }

?>