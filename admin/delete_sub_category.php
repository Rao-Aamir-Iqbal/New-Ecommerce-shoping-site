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
    $sql = "DELETE FROM `subcategory` WHERE id= '".$id."'";
    $execute = mysqli_query($conn, $sql);
    if($execute){
        $_SESSION['add_p_msg'] = "Your Sub-Category Deleted Successfully!";
        header('location:subcategory.php');
    }else{
        $_SESSION['add_p_msg'] = "Your Sub-Category Not Deleted Successfully!";
        header('location:subcategory.php');
    }
  }

?>