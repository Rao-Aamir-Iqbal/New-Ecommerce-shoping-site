<?php
session_start();
$id = $_GET['id'];

$conn = mysqli_connect("localhost", "root", "", "registeration");
if ($conn) {
  //echo "Connected successfully";

} else {
  die("Connection failed: " . mysqli_connect_error());
}

$sub_data = "SELECT * FROM `products` WHERE id='" . $id . "'";
$exicu = mysqli_query($conn, $sub_data);
if ($res1 = mysqli_fetch_assoc($exicu)) {
  $sub_category = $res1['sub_category_id'];
}
$sub_data = "SELECT * FROM `category`";
$exicu2 = mysqli_query($conn, $sub_data);
if ($res2 = mysqli_fetch_assoc($exicu2)) {
  $category_id2 = $res2['id'];
}
$sub_data = "SELECT * FROM `subcategory` WHERE id='" . $sub_category . "'";
$exicu = mysqli_query($conn, $sub_data);
if ($res = mysqli_fetch_assoc($exicu)) {
  $category_id = $res['category_id'];
  $sub_category_id = $res['id'];
}

$sel_data = "SELECT * FROM `products` WHERE id='" . $id . "'";
$exicu = mysqli_query($conn, $sel_data);
if ($res = mysqli_fetch_assoc($exicu)) {
  $p_name = $res['p_name'];

  $p_price = $res['p_price'];
  $sub_cat_id = $res['sub_category_id'];
  $p_desc = $res['p_description'];
  $p_image = $res['p_image'];
  $p_status = $res['status'];
  // echo $p_name;
  // die();
}
if (isset($_POST['submit'])) {

  if (empty($_POST['p_name'])) {
    $_SESSION['error1_msg'] = "Please Enter Product Name!";
  }
  if (empty($_POST['p_price'])) {
    $_SESSION['error2_msg'] = "Please Enter Product Price!";
  }
  if (empty($_POST['subcategory_id'])) {
    $_SESSION['error3_msg'] = "Please Select Sub-Category Type!";
  }
  if (empty($_POST['p_desc'])) {
    $_SESSION['error4_msg'] = "Please Enter Description!";
  }
  if (
    !empty($_POST['p_name']) && !empty($_POST['p_price']) && !empty($_POST['subcategory_id']) &&
    !empty($_POST['p_desc'])
  ) {
    extract($_POST);

    $filename = $_FILES["p_image"]["name"];
    $tempname = $_FILES["p_image"]["tmp_name"];
    $folder = "images/" . $filename;
    move_uploaded_file($tempname, $folder);
    if (empty($filename)) {
      $qury22 = "UPDATE `products` SET `sub_category_id`='" . $subcategory_id . "',`p_name`='" . $p_name . "',`p_price`='" . $p_price . "',
        `p_type`='" . $sub_cat_id . "',`p_description`='" . $p_desc . "', status = '".$status."'  WHERE id = '" . $id . "'";
      // die();
    } else {
      $qury22 = "UPDATE `products` SET `sub_category_id`='" . $subcategory_id . "', `p_name`='" . $p_name . "',`p_price`='" . $p_price . "',
        `p_type`='" . $sub_cat_id. "',`p_description`='" . $p_desc . "', , status = '".$status."' ,`p_image`='" . $filename . "' WHERE id = '" . $id . "'";
    }

    // die();
    $res = mysqli_query($conn, $qury22);
    if ($res) {
      $_SESSION['add_p_msg'] = "Your Product Updated Successfully!";
      header('location:product.php');
    } else {
      $_SESSION['add_p_msg'] = "Your Product Not Updated Successfully! Error";
      header('location:product.php');
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
    <div class="row d-flex justify-content-center mt-3">
      <div class="col-md-4">
        <div class="card border-0 p-3 shadow rounded">
          <h2 class="text-info">Update Products!</h2>
          <hr>
          </hr>

          <form action="" method="POST" enctype="multipart/form-data">
            <div class="mt-3">
              <label for="inputEmail4" class="form-label">Product Name</label>
              <input type="text" class="form-control" placeholder="" value="<?php echo $p_name; ?>" name="p_name">
              <div class="text-danger">
                <?php
                if (isset($_SESSION['error1_msg'])) {
                  echo $_SESSION['error1_msg'];
                  unset($_SESSION['error1_msg']);
                }
                ?>
              </div>
            </div>
            <div class="mt-3">
              <label for="inputEmail4" class="form-label">Product Price</label>
              <input type="number" class="form-control" placeholder="" value="<?php echo $p_price; ?>" name="p_price">
              <div class="text-danger">
                <?php
                if (isset($_SESSION['error2_msg'])) {
                  echo $_SESSION['error2_msg'];
                  unset($_SESSION['error2_msg']);
                }
                ?>
              </div>
            </div>
            <div class="mt-3">
              <label for="inputPassword4" class="form-label">Category Type</label>
              <select id="category_id" class="form-select">
                <!-- <option value="">--Select Category--</option> -->
                <?php
                $sel_data = "SELECT * FROM `category`";
                $exicu = mysqli_query($conn, $sel_data);
                if (mysqli_num_rows($exicu) > 0) {
                  while ($fetch = mysqli_fetch_assoc($exicu)) {
                    echo $fetch['id'];

                    ?>
                    <option value=<?= $fetch['id']; ?>     <?php $fetch['id'] == $category_id ? print('selected') : null ?>>
                      <?= $fetch['category_name']; ?></option>
                    <?php
                  }
                }
                ?>
              </select>
              <label for="inputPassword4" class="form-label  mt-3">Sub-Category Type</label>
              <select id="subcategory" class="form-select" name="subcategory_id" aria-label="Default select example">
                <?php
                $sel_data = "SELECT * FROM `subcategory` WHERE category_id  =  $category_id ";
                $exicu = mysqli_query($conn, $sel_data);
                if (mysqli_num_rows($exicu) > 0) {
                  while ($fetch = mysqli_fetch_assoc($exicu)) {
                    //echo $fetch['id'];
                
                    ?>
                    <option value=<?= $fetch['id']; ?>     <?php $fetch['id'] == $sub_category_id ? print('selected') : null ?>>
                      <?= $fetch['sub_category_name']; ?></option>
                    <?php
                  }
                }
                ?>
              </select>
              <div class="text-danger">
                <?php
                if (isset($_SESSION['error3_msg'])) {
                  echo $_SESSION['error3_msg'];
                  unset($_SESSION['error3_msg']);
                }
                ?>
              </div>
            </div>

            <div class="mt-3">
              <label class="form-label">Product Description</label>
              <input type="text" class="form-control" placeholder="" name="p_desc" value="<?php echo $p_desc; ?>">
              <div class="text-danger">
                <?php
                if (isset($_SESSION['error4_msg'])) {
                  echo $_SESSION['error4_msg'];
                  unset($_SESSION['error4_msg']);
                }
                ?>
              </div>
              <div class="mt-3">
                <label class="form-label">Status</label>
                <select class="form-select" name="status" aria-label="Default select example">
                    <option value="1" <?php $p_status == 1 ? print('selected') : null ?>>Active</option>
                    <option value="0" <?php $p_status == 0 ? print('selected') : null ?>>Deactive</option>
                </select> 
              </div>
                <div class="mt-3">
                  <label for="inputPassword4" class="form-label">Choose Product Image</label>
                  <input type="file" class="form-control" placeholder="" value="<?php echo $p_image; ?>" name="p_image">
                  <img src="images/<?php echo $p_image; ?>" width="150px" height="100px">
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

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script>
    $(document).ready(function () {
      $('#category_id').on('change', function () {
        var category_id = $(this).val();
        if (category_id) {
          $.ajax({
            type: 'POST',
            url: 'ajaxData.php',
            data: 'category_id=' + category_id,
            success: function (html) {
              $('#subcategory').html(html);
              //$('#city').html('<option value="">Select state first</option>'); 
            }
          });
        } else {
          $('#subcategory').html('<option value="">Select Category first</option>');
          //$('#city').html('<option value="">Select state first</option>'); 
        }
      });
    });
  </script>
</body>

</html>