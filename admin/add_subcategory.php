<?php
session_start();
//$id = $_GET['id'];
$conn = mysqli_connect("localhost","root","","registeration");
if($conn) {
    //echo "Connected successfully";
    
  }else{
    die("Connection failed: " . mysqli_connect_error());
  }


if(isset($_POST['submit'])){

  if(empty($_POST['category_id'])){
    $_SESSION['error_msg'] = "Please Select Category Name!";
  }

  if(empty($_POST['sub_category_name'])){
    $_SESSION['errorr_msg'] = "Please Enter Sub-Category Name!";
  }
  if(!empty($_POST['category_id']) && !empty($_POST['sub_category_name'])){
    extract($_POST);
   
    $qury22 = "INSERT INTO `subcategory`(`sub_category_name`, `category_id`, `status`) 
    VALUES ('".$sub_category_name."', '".$_POST['category_id']."', 1)";
    $res = mysqli_query($conn, $qury22);
    if($res){
        $_SESSION['add_p_msg'] = "Your Sub-Category Add Successfully!";
        header('location:subcategory.php');
   }else{
        $_SESSION['add_p_msg'] = "Your Sub-Category Not Added Successfully! Error";
        header('location:subcategory.php');
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>email-varification!</title>
  </head>
  <body class="bg-secondary">
    <div class="container">
        <div class="row d-flex justify-content-center mt-5">
            <div class="col-md-4">
                <div class="card border-0 p-3 shadow rounded">
                    <h2 class="text-info">Add Sub-Category!</h2>
                    <hr></hr>
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="mt-3">
                        <label for="inputPassword4" class="form-label">Category Name</label>
                        <select class="form-select" name="category_id" aria-label="Default select example">
                        <option value="">--Select Category--</option>
                        <?php
                        $sel_data ="SELECT * FROM `category`";
                        $exicu = mysqli_query($conn, $sel_data);
                        if(mysqli_num_rows($exicu)>0){
                            foreach ($exicu as $option){
                            ?>
                              <option value=<?=$option['id'];?>><?=$option['category_name'];?></option>
                              <?php 
                              }
                            }
                             ?>
                       </select>
                       <div class="text-danger">
                        <?php
                          if(isset($_SESSION['error_msg'])){
                          echo $_SESSION['error_msg'];
                          unset($_SESSION['error_msg']);
                        }
                        ?>
                        </div>
                    </div>
                    <div class="mt-3"> 
                        <label for="inputPassword4" class="form-label">Sub-Category Name</label>
                        <input type="text" class="form-control" placeholder="" name="sub_category_name">
                    </div>
                    <div class="text-danger">
                        <?php
                          if(isset($_SESSION['errorr_msg'])){
                          echo $_SESSION['errorr_msg'];
                          unset($_SESSION['errorr_msg']);
                        }
                        ?>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
  </body>
</html>