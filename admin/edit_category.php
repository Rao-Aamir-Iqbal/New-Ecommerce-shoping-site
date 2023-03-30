<?php
session_start();
$id = $_GET['id'];
$conn = mysqli_connect("localhost", "root", "", "registeration");
if ($conn) {
  //echo "Connected successfully";

} else {
  die("Connection failed: " . mysqli_connect_error());
}

$sel_data = "SELECT * FROM `category` WHERE id='" . $id . "'";
$exicu = mysqli_query($conn, $sel_data);
if ($res = mysqli_fetch_assoc($exicu)) {
  $category_name = $res['category_name'];
  $category_status = $res['status'];
}
if (isset($_POST['submit'])) {
  if (empty($_POST['category_name'])) {
    $_SESSION['error_msg'] = "Please Enter Category Name!";
  } else {
    extract($_POST);


    $qury22 = "UPDATE `category` SET `category_name`='" . $category_name . "', status = '" . $status . "' WHERE id = '" . $id . "'";
    $res = mysqli_query($conn, $qury22);

    $sql_status = mysqli_query($conn, "SELECT * FROM `category` WHERE id='" . $id . "'");
    $status_fetch = mysqli_fetch_assoc($sql_status);
    $cat_id = $status_fetch['id'];
    $cat_ststus = $status_fetch['status'];

    if ($cat_ststus == 0) {
      // for category and subcategory---

      $sql_status21 = mysqli_query($conn, "SELECT * FROM `subcategory` WHERE category_id='" . $cat_id . "'");
      while ($status_fetch21 = mysqli_fetch_assoc($sql_status21)) {


        $subcat_name = $status_fetch21['sub_category_name'];
        $subcat_id21 = $status_fetch21['id'];
        $subcat_status = $status_fetch21['status'];

        $insert_status1 = "INSERT INTO `statuses`(`subcategory_name`, `subcategory_id`, `subcategory_status`)
        VALUES ('$subcat_name','$subcat_id21','$subcat_status')";
        $res1 = mysqli_query($conn, $insert_status1);
      }

      // for category and Products---
      $sub_cat_sqli22 = "SELECT * FROM subcategory WHERE category_id = $cat_id";
      $subcat_res22 = mysqli_query($conn, $sub_cat_sqli22);
      while ($sub_id22 = mysqli_fetch_assoc($subcat_res22)) {
        $cate_id22 = $sub_id22['id'];


        $pro_status22 = mysqli_query($conn, "SELECT * FROM `products` WHERE sub_category_id = '" . $cate_id22 . "'");
        while ($status_fetch22 = mysqli_fetch_assoc($pro_status22)) {


           $p_name = $status_fetch22['p_name'];
           $p_id22 = $status_fetch22['id'];
           $p_status = $status_fetch22['status'];

          $insert_status22 = "INSERT INTO `pro_statuses`(`product_name`, `product_id`, `product_status`)
        VALUES ('$p_name','$p_id22','$p_status')";
          $res22 = mysqli_query($conn, $insert_status22);
        }
      }

      $qury23 = "UPDATE `subcategory` SET status = '" . $status . "' WHERE category_id = '" . $cat_id . "'";
      mysqli_query($conn, $qury23);

      $sql_status21 = mysqli_query($conn, "SELECT * FROM `subcategory` WHERE category_id='" . $cat_id . "'");
      $status_fetch21 = mysqli_fetch_assoc($sql_status21);
      $subcat_id21 = $status_fetch21['id'];

      $qury23 = "UPDATE `products` SET status = '" . $status . "' WHERE sub_category_id = '" . $subcat_id21 . "'";
      mysqli_query($conn, $qury23);

    }
    if ($status == 1) {

      $sql2 = "SELECT * FROM subcategory WHERE category_id = $cat_id";
      $sql_res2 = mysqli_query($conn, $sql2);
      while ($fetch2 = mysqli_fetch_assoc($sql_res2)) {
        $sub_category_name = $fetch2['sub_category_name'];
        $sub_category_id = $fetch2['id'];
        $sub_category_status = $fetch2['status'];
        
        $sql3 = "SELECT * FROM statuses WHERE subcategory_id = $sub_category_id";
        $sql_res3 = mysqli_query($conn, $sql3);

        while ($fetch3 = mysqli_fetch_assoc($sql_res3)) {
          $status3 = $fetch3['subcategory_status'];
          $subcategory_id3 = $fetch3['subcategory_id'];


          //print_r($status3);

          $sql_update_subcat4 = "UPDATE `subcategory` SET `status`='$status3' WHERE id =" . $fetch3['subcategory_id'];

          $sqli_execut4 = mysqli_query($conn, $sql_update_subcat4);

          $delete_statuses = "DELETE FROM statuses WHERE subcategory_id = $sub_category_id";

          $delet_execut = mysqli_query($conn, $delete_statuses);

        }
      }

      $sql22 = "SELECT * FROM subcategory WHERE category_id = $cat_id";
      $sql_res22 = mysqli_query($conn, $sql22);
      while ($fetch22 = mysqli_fetch_assoc($sql_res22)) {
        $sub_category_id22 = $fetch22['id'];

        $sql_status23 = "SELECT * FROM products WHERE sub_category_id = $sub_category_id22 ";
        $sql_exe23 = mysqli_query($conn, $sql_status23);
        while ($res23 = mysqli_fetch_assoc($sql_exe23)) {
          $p_name23 = $res23['p_name'];
          $P_id23 = $res23['id'];
          $P_status23 = $res23['status'];




          $sql24 = "SELECT * FROM pro_statuses WHERE product_id = $P_id23";
          $sql_res24 = mysqli_query($conn, $sql24);

          while ($fetch24 = mysqli_fetch_assoc($sql_res24)) {
            $status24 = $fetch24['product_status'];

            $sql_update_subcat24 = "UPDATE `products` SET `status`='$status24' WHERE id =" . $P_id23;

            $sqli_execut24 = mysqli_query($conn, $sql_update_subcat24);

            $delete_statuses24 = "DELETE FROM pro_statuses WHERE product_id =  $P_id23";

            $delet_execu24 = mysqli_query($conn, $delete_statuses24);
          }



        }
      }




    }



    if ($res) {
      $_SESSION['add_p_msg'] = "Your Category Updated Successfully!";
      header('location:category.php');
    } else {
      $_SESSION['add_p_msg'] = "Your Category Not Updated Successfully! Error";
      header('location:category.php');
    }
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
                    <h2 class="text-info">Update Category!</h2>
                    <hr>
                    </hr>

                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="mt-3">
                            <label for="inputEmail4" class="form-label">Category Name</label>
                            <input type="text" class="form-control" placeholder="" value="<?php echo $category_name; ?>"
                                name="category_name">
                            <div class="text-danger">
                                <?php
                if (isset($_SESSION['error_msg'])) {
                  echo $_SESSION['error_msg'];
                  unset($_SESSION['error_msg']);
                }
                ?>
                            </div>
                            <div class="mt-3">
                                <label class="form-label">Status</label>
                                <select class="form-select" name="status" aria-label="Default select example">
                                    <option value="1" <?php $category_status == 1 ? print('selected') : null ?>>Active
                                    </option>
                                    <option value="0" <?php $category_status == 0 ? print('selected') : null ?>>Deactive
                                    </option>
                                </select>
                            </div>
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