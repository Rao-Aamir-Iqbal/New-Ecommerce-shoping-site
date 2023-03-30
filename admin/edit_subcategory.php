<?php
session_start();
$id = $_GET['id'];
$conn = mysqli_connect("localhost", "root", "", "registeration");
if ($conn) {
  //echo "Connected successfully";
} else {
  die("Connection failed: " . mysqli_connect_error());
}

$sel_data = "SELECT * FROM `subcategory` WHERE id='" . $id . "'";
$exicu = mysqli_query($conn, $sel_data);
if ($res = mysqli_fetch_assoc($exicu)) {
  $sub_category_name = $res['sub_category_name'];
  $sub_category_status = $res['status'];
  $sub_category_id = $res['id'];
}
if (isset($_POST['submit'])) {

  extract($_POST);
  $qury22 = "UPDATE `subcategory` SET `sub_category_name`='" . $sub_category_name . "' , status = '" . $status . "' WHERE id = '" . $id . "'";
  $res = mysqli_query($conn, $qury22);

  $sql_status = mysqli_query($conn, "SELECT * FROM `subcategory` WHERE id='" . $id . "'");
  $status_fetch = mysqli_fetch_assoc($sql_status);
  $sub_id = $status_fetch['id'];
  $sub_ststus = $status_fetch['status'];

 
  if ($status == 0) {
    $pro_status = mysqli_query($conn, "SELECT * FROM `products` WHERE sub_category_id = '" . $sub_id . "'");
    while ($pro_status_get = mysqli_fetch_assoc($pro_status)) {
      echo $pro_id = $pro_status_get['id'];
      $pro_name = $pro_status_get['p_name'];
      echo $pro_status_data = $pro_status_get['status'];

      $insert_status = mysqli_query($conn, "INSERT INTO `sub_category_stateses`(`product_name`, `product_id`,
       `product_status`) VALUES ('$pro_name','$pro_id','$pro_status_data')");


      $qury23 = "UPDATE `products` SET status = '" . $status . "' WHERE sub_category_id = '" . $id . "'";
      mysqli_query($conn, $qury23);
    }

  }

  if ($status == 1) {

    $pro_status11 = mysqli_query($conn, "SELECT * FROM `products` WHERE sub_category_id='" . $sub_id . "'");
    while ($pro_get11 = mysqli_fetch_assoc($pro_status11)) {
      $pro_cat_id11 = $pro_get11['id'];
      $pro_status_data11 = $pro_get11['status'];

      //echo $pro_cat_id11;
      $selct_status2 = mysqli_query($conn, "SELECT * FROM `sub_category_stateses` WHERE product_id = '" . $pro_cat_id11."'");
      while ($mysq_fetc = mysqli_fetch_assoc($selct_status2)) {
        $stat_status = $mysq_fetc['product_status'];
        $product_id = $mysq_fetc['product_id'];
       // $statu_id = $mysq_fetc['id'];
        //echo   $statu_id;

        $updt_stat = mysqli_query($conn, "UPDATE `products` SET `status`='" . $stat_status . "' WHERE id = '" .  $product_id . "'");


        $delete_stats = mysqli_query($conn, "DELETE FROM `sub_category_stateses` WHERE product_id = '" . $pro_cat_id11 . "'");
      }


    }
    //die();


  }

  //extract($_POST);
 

  if ($res) {
    $_SESSION['add_p_msg'] = "Your Sub-Category Updated Successfully!";
    header('location:subcategory.php');
  } else {
    $_SESSION['add_p_msg'] = "Your sub-Category Not Updated Successfully! Error";
    header('location:subcategory.php');
  }

}
?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <title>email-varification!</title>
</head>

<body class="bg-secondary">
  <div class="container">
    <div class="row d-flex justify-content-center mt-5">
      <div class="col-md-4">
        <div class="card border-0 p-3 shadow rounded">
          <h2 class="text-info">Update Sub-Category!</h2>
          <hr>
          </hr>

          <form action="" method="POST" enctype="multipart/form-data">
            <div class="mt-3">
              <label for="inputEmail4" class="form-label">Sub-Category Name</label>
              <input type="text" class="form-control" placeholder="" value="<?php echo $sub_category_name; ?>"
                name="sub_category_name">
            </div>
            <div class="mt-3">
              <label class="form-label">Status</label>
              <select class="form-select" name="status" aria-label="Default select example">
                <option value="1" <?php $sub_category_status == 1 ? print('selected') : null ?>>Active
                </option>
                <option value="0" <?php $sub_category_status == 0 ? print('selected') : null ?>>Deactive
                </option>
              </select>
            </div>
            <div class="mt-4">
              <button type="submit" name="submit" class="btn btn-primary">Submit</button>
            </div>
          </form>
        </div>

      </div>
    </div>
  </div>

  <!-- Optional JavaScript; choose one of the two! -->

  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

  <!-- Option 2: Separate Popper and Bootstrap JS -->
  <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
</body>

</html>