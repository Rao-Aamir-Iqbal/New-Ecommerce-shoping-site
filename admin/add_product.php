<?php
session_start();
$conn = mysqli_connect("localhost","root","","registeration");
if($conn) {
    //echo "Connected successfully";
    
  }else{
    die("Connection failed: " . mysqli_connect_error());
  }
 
if(isset($_POST['submit'])){
    if(empty($_POST['p_name'])){
        $_SESSION['error1_msg'] = "Please Enter Product Name!";
      }
      if(empty($_POST['p_price'])){
        $_SESSION['error2_msg'] = "Please Enter Product Price!";
      }
      if(empty($_POST['subcategory_id'])){
        $_SESSION['error3_msg'] = "Please Select First Category Type!";
      }
      if(empty($_POST['p_desc'])){
        $_SESSION['error4_msg'] = "Please Enter Description!";
      }
      if(empty($_FILES["p_image"]["name"])){
        $_SESSION['error5_msg'] = "Please Choose Product Image!";
      }
      if(!empty($_POST['p_name']) && !empty($_POST['p_price']) && !empty($_POST['subcategory_id']) &&
       !empty($_POST['p_desc']) && !empty($_FILES['p_image']["name"])){
        extract($_POST);
        $filename = $_FILES["p_image"]["name"];
        $tempname = $_FILES["p_image"]["tmp_name"];
        $folder = "images/" . $filename;
        move_uploaded_file($tempname, $folder);
        
        $qury22 = "INSERT INTO `products`(`emply_id`,`sub_category_id`, `p_name`, `p_price`, `p_type`, `p_description`, `status`, `p_image`) 
            VALUES ('".$_SESSION['u_id']."','".$subcategory_id."','".$p_name."','".$p_price."','".$p_type."','".$p_desc."', 1 ,'".$filename."')";
        // die();
        $res = mysqli_query($conn, $qury22);
        if($res){
            $_SESSION['add_p_msg'] = "Your New Product Add Successfully!";
            header('location:product.php');
       }else{
            $_SESSION['add_p_msg'] = "Your Product Not Add Successfully! Error";
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>email-varification!</title>
  </head>
  <body class="bg-secondary">
    <div class="container">
        <div class="row d-flex justify-content-center mt-5">
            <div class="col-md-4">
                <div class="card border-0 p-3 shadow rounded">
                    <h2 class="text-info">Add New Products!</h2>
                    <hr></hr>
                
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="mt-3">
                        <label for="inputEmail4" class="form-label">Product Name</label>
                        <input type="text" class="form-control" placeholder="" name="p_name">
                        <div class="text-danger">
                        <?php
                          if(isset($_SESSION['error1_msg'])){
                          echo $_SESSION['error1_msg'];
                          unset($_SESSION['error1_msg']);
                        }
                        ?>
                        </div>
                    </div>
                    
                    <div class="mt-3">
                        <label for="inputEmail4" class="form-label">Product Price</label>
                        <input type="number" class="form-control" placeholder="" name="p_price">
                        <div class="text-danger">
                        <?php
                          if(isset($_SESSION['error2_msg'])){
                          echo $_SESSION['error2_msg'];
                          unset($_SESSION['error2_msg']);
                        }
                        ?>
                        </div>
                    </div>
                    
                    <div class="mt-3">
                        <label for="inputPassword4" class="form-label">Category Type</label>
                        <select id="category_id" class="form-select">
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
                        <label for="inputPassword4" class="form-label  mt-3">Sub-Category Type</label>
                        <select id="subcategory" class="form-select" name="subcategory_id"  aria-label="Default select example">
                        <option value="">--First Select Category type--</option>
                        </select>
                        <div class="text-danger">
                        <?php
                          if(isset($_SESSION['error3_msg'])){
                          echo $_SESSION['error3_msg'];
                          unset($_SESSION['error3_msg']);
                        }
                        ?>
                        </div>
                    </div>
                    <div class="mt-3">
                        <label for="inputPassword4" class="form-label">Product Description</label>
                        <input type="text" class="form-control" placeholder="" name="p_desc">
                        <div class="text-danger">
                        <?php
                          if(isset($_SESSION['error4_msg'])){
                          echo $_SESSION['error4_msg'];
                          unset($_SESSION['error4_msg']);
                        }
                        ?>
                        </div>
                    </div>
                    <div class="mt-3">
                        <label for="inputPassword4" class="form-label">Choose Product Image</label>
                        <input type="file" class="form-control" placeholder="" name="p_image">
                        <div class="text-danger">
                        <?php
                          if(isset($_SESSION['error5_msg'])){
                          echo $_SESSION['error5_msg'];
                          unset($_SESSION['error5_msg']);
                        }
                        ?>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script>
$(document).ready(function(){
    $('#category_id').on('change', function(){
        var category_id = $(this).val();
        if(category_id){
            $.ajax({
                type:'POST',
                url:'ajaxData.php',
                data:'category_id='+category_id,
                success:function(html){
                    $('#subcategory').html(html);
                    //$('#city').html('<option value="">Select state first</option>'); 
                }
            }); 
        }else{
            $('#subcategory').html('<option value="">Select Category first</option>');
            //$('#city').html('<option value="">Select state first</option>'); 
        }
    });
    
    // $('#subcategory').on('change', function(){
    //     var subcategory = $(this).val();
    //     if(subcategory){
    //         $.ajax({
    //             type:'POST',
    //             url:'ajaxData.php',
    //             data:'state_id='+subcategory,
    //             success:function(html){
    //                 $('#city').html(html);
    //             }
    //         }); 
    //     }else{
    //         $('#city').html('<option value="">Select state first</option>'); 
    //     }
    // });
});
</script>
    </script>
  </body>
</html>