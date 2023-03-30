<?php
session_start();
//$id = $_SESSION['u_id'];
//echo $id;
// die();
$conn = mysqli_connect("localhost","root","","registeration");
if($conn) {
    //echo "Connected successfully";
    
  }else{
    die("Connection failed: " . mysqli_connect_error());
  }



if(isset($_POST['otpsubmit'])){
  $otp = $_POST['otp'];
  
  $query = "SELECT * FROM employee WHERE otp_code = '".$otp."'";
  $res = mysqli_query($conn, $query);
  if(mysqli_num_rows($res)>0){

    $re = mysqli_fetch_assoc($res);
    $email = $re['email'];
    $_SESSION['u_id'] = $re['id'];
    
    mysqli_query($conn,"UPDATE employee set status = 1 WHERE otp_code = '".$otp."'");
    header('location:index.php');

  }else{
    $otp_msg = "Your OTP Not Match!";
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
                <div class="card border-0 p-3 shadow">
                    <h2>Enter OTP</h2>
                    <?php
                if(isset($otp_msg)){
                 ?>
                 <div class="alert alert-success" role="alert">
                   <?php
                   echo  $otp_msg;
                   //session_unset();
                   ?>
                </div>
                 <?php
                }
                ?>
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="mt-3">
                        <label for="inputEmail4" class="form-label">Check your Mail to Enter OTP</label>
                        <input type="text" class="form-control" placeholder="Enter Otp" name="otp" required>
                    </div>
                    <div class="mt-4">
                        <button type="submit" name="otpsubmit" class="btn btn-primary">Login</button>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script>
    $(".alert").delay(4000).slideUp(200, function() {
    $(this).alert('close');
});
    </script>
  </body>
</html>