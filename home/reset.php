<?php
session_start();
$email = $_GET['key'];
$token = $_GET['token'];
// echo $email;
// die();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/PHPMailer-master/src/Exception.php';
require 'phpmailer/PHPMailer-master/src/PHPMailer.php';
require 'phpmailer/PHPMailer-master/src/SMTP.php';

$conn = mysqli_connect("localhost","root","","registeration");
if($conn) {
    //echo "Connected successfully";
    
  }else{
    die("Connection failed:".mysqli_connect_error());
  }
 
if(isset($_POST['submit'])){
    extract($_POST);
     $password = $_POST['password'];
     $retyp_password = $_POST['retyp_password'];
 
    if($password == $retyp_password){

        $hash_pass = password_hash($password, PASSWORD_DEFAULT);

        $sql =  "UPDATE `employee` SET password ='".$hash_pass."' WHERE email='".$email."' AND token = '".$token."'";
        mysqli_query($conn,$sql);
        $_SESSION['password_rest'] = "Your Password Reset Successfully! Now you can Login.";
        header('location:login.php');


    }else{
        echo '<script language="javascript">';
        echo 'alert("Password Not Match!")';
        echo '</script>';
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
                    <h2>Reset Password</h2>
                 <form action="" method="POST" enctype="multipart/form-data">
                    <div class="mt-3">
                        <label for="inputEmail4" class="form-label">New Password</label>
                        <input type="password" class="form-control" placeholder="Enter Password" name="password" required>
                    </div>
                    <div class="mt-3">
                        <label for="inputPassword4" class="form-label">Retype Password</label>
                        <input type="password" class="form-control" placeholder="Enter Password" name="retyp_password" required>
                    </div>
                    <!-- <div class="mt-3">
                        <label for="inputPassword4" class="form-label">Password</label>
                        <input type="password" class="form-control" placeholder="Enter Password" name="password">
                    </div> -->
                    <div class="mt-4">
                        <button type="submit" name="submit" class="btn btn-primary">Reset Password</button>
                    </div>
                    <div class="mt-4">
                        
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