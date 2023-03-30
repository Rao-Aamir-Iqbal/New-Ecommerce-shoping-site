<?php
session_start();
$id_category = $_GET['id'];
$id_subcategory = $_GET['idsub'];
$conn = mysqli_connect("localhost","root","","registeration");
if($conn) {
    //echo "Connected successfully";
    
  }else{
    die("Connection failed: " . mysqli_connect_error());
  }

if(isset($id_category)) { 
$sql = "DELETE FROM `category` WHERE id= '".$id_category."'";
$execute = mysqli_query($conn, $sql);
if($execute){
    $_SESSION['add_p_msg'] = "Your Category Deleted Successfully!";
    header('location:category.php');
}else{
    $_SESSION['add_p_msg'] = "Your Category Not Deleted Successfully!";
    header('location:category.php');
}
}
if(isset($id_subcategory)) { 
  $sql = "DELETE FROM `subcategory` WHERE id= '".$id_subcategory."'";
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