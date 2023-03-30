<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "registeration");
if ($conn) {
  //echo "Connected successfully";

} else {
  die("Connection failed: " . mysqli_connect_error());
}
// start code delete subcategory in bulk------

if (isset($_POST['delete_sub_submit'])) {
  $all_id2 = $_POST['subcategory_delete_id'];

 
  if ($all_id2 != NULL) {
    $extra_id2 = implode(',', $all_id2);
   // echo $extra_id2;
    //echo $extra_id;

    // $delete_sql2 = "DELETE FROM products WHERE sub_category_id IN($extra_id2)";
    // $sql_execut2 = mysqli_query($conn, $delete_sql2);
    $delete_sql22 = "DELETE FROM subcategory WHERE id IN($extra_id2)";
    $sql_execut22 = mysqli_query($conn, $delete_sql22);

    if ($sql_execut22) {
      $_SESSION['add_p_msg'] = "Subcategory Deleted Successfully!";
      header('location:subcategory.php');
    } else {
      $_SESSION['add_p_msg'] = "Subcategory Not Deleted Successfully!";
      header('location:subcategory.php');
    }
  } else {
    $_SESSION['add_p_msg'] = "Please Select any Checkbox to Delete Subcategory!";
    header('location:subcategory.php');
  }


}
// end code delete subcategory in bulk------



// start code delete product in bulk------
if (isset($_POST['delete_submit'])) {
  $all_id = $_POST['products_delete_id'];
  if ($all_id != "") {
    $extra_id = implode(',', $all_id);

  //  echo $extra_id;
    $delete_sql = "DELETE FROM products WHERE id IN($extra_id)";
    $sql_execut = mysqli_query($conn, $delete_sql);

    if ($sql_execut) {
      $_SESSION['add_p_msg'] = "Product Deleted Successfully!";
      header('location:product.php');
    } else {
      $_SESSION['add_p_msg'] = "Product Not Deleted Successfully!";
      header('location:product.php');
    }
  } else {
    $_SESSION['add_p_msg'] = "Please Select any Checkbox to Delete Products!";
    header('location:product.php');
  }


}
// end code delete product in bulk------


// start code Active subcategory in bulk------
if (isset($_POST['actve_sub_submit'])) {
  $activ_id1122 = $_POST['subcategory_active-deactive_id'];
  if($activ_id1122 != ""){
    $extra_active_id1122 = implode(',', $activ_id1122);



    // $sel_sql11 = "SELECT status FROM products WHERE id IN($extra_active_id11)";
    // $execut_sel11 = mysqli_query($conn, $sel_sql11);
  
    // $update_status11 = "UPDATE `products` SET `status`=1 WHERE id IN($extra_active_id11)";
    // $execute11 = mysqli_query($conn, $update_status11);
    //die();
  
  
    if ($execute11) {
      $_SESSION['add_p_msg'] = "Product Active Successfully!";
      header('location:product.php');
    } else {
      $_SESSION['add_p_msg'] = "Product Not Active Successfully!";
      header('location:product.php');
    }
  }else{
    $_SESSION['add_p_msg'] = "Please Select any Checkbox to Active Subcategory!";
    header('location:subcategory.php');
  }
  
}
// end code Active subcategory in bulk------




// start code Active products in bulk------
if (isset($_POST['active_submit'])) {
  $active_id11 = $_POST['active_deactive_id'];
  if($active_id11 != ""){
    $extra_active_id11 = implode(',', $active_id11);



    $sel_sql11 = "SELECT status FROM products WHERE id IN($extra_active_id11)";
    $execut_sel11 = mysqli_query($conn, $sel_sql11);
  
    // while ($res223 = mysqli_fetch_assoc($execut_sel11)) {
    //   $status = $res223['status'];
    //   echo $status;
    //   $single_value = 0;
    //   if(in_array(0, $status)){
    //     $update_status11 = "UPDATE `products` SET `status`=1 WHERE id IN($extra_active_id11)";
    //     $execute11 = mysqli_query($conn, $update_status11);
    //   }else{
    //     $_SESSION['add_p_msg'] = "Please Select only Active or Deactive Checkbox!";
    //     //header('location:product.php');
    //   }
    // }
  
    $update_status11 = "UPDATE `products` SET `status`=1 WHERE id IN($extra_active_id11)";
    $execute11 = mysqli_query($conn, $update_status11);
    // die();
  
  
    if ($execute11) {
      $_SESSION['add_p_msg'] = "Product Active Successfully!";
      header('location:product.php');
    } else {
      $_SESSION['add_p_msg'] = "Product Not Active Successfully!";
      header('location:product.php');
    }
  }else{
    $_SESSION['add_p_msg'] = "Please Select any Checkbox to Active Products!";
    header('location:product.php');
  }
  
}
// end code Active products in bulk------



// start code Deactive products in bulk------
if (isset($_POST['deactive_submit'])) {
  $active_id22 = $_POST['active_deactive_id'];
  if($active_id22 != ""){
    $extra_deactive_id22 = implode(',', $active_id22);

    //$sel_sql = "SELECT * FROM products WHERE id = $extra_active_id";
    $update_status22 = "UPDATE `products` SET `status`= 0 WHERE id IN($extra_deactive_id22)";
    $execute22 = mysqli_query($conn, $update_status22);
  
    if ($execute22) {
      $_SESSION['add_p_msg'] = "Product Deactive Successfully!";
      header('location:product.php');
    } else {
      $_SESSION['add_p_msg'] = "Product Not Deactive Successfully!";
      header('location:product.php');
    }
  }else{
    $_SESSION['add_p_msg'] = "Please Select any Checkbox to Deactive Products!";
    header('location:product.php');
  }
  
}
// end code Deacctive products in bulk------
?>