<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/PHPMailer-master/src/Exception.php';
require 'phpmailer/PHPMailer-master/src/PHPMailer.php';
require 'phpmailer/PHPMailer-master/src/SMTP.php';

$conn = mysqli_connect("localhost","root","","registeration");
if($conn) {
    //echo "Connected successfully";
    
  }else{
    die("Connection failed: " . mysqli_connect_error());
  }
 
if(isset($_POST['submit'])){
    extract($_POST);
    // $name = $_POST['name'];
    // $email = $_POST['email'];
     $password = $_POST['password'];
     $hash_password = password_hash($password, PASSWORD_DEFAULT);
     $otp = rand(100000, 999999);
     $status = "0";

    $query = "SELECT * FROM employee WHERE email = '".$email."'";
    $res = mysqli_query($conn, $query);
    if(mysqli_num_rows($res)>0){
        echo '<script language="javascript">';
        echo 'alert("This Email Already in use!")';
        echo '</script>';
   }else{
        $query2 = "INSERT INTO `employee`(name, email, password, otp_code, status) 
        VALUES ('".$name."','".$email."','".$hash_password."','".$otp."','".$status."')";
        $res2 = mysqli_query($conn, $query2);

    if($res2){
        
        $mail = new PHPMailer(true);
        
        try {
            $mail->SMTPDebug = 0;                                       
            $mail->isSMTP();                                            
            $mail->Host       = 'smtp.gmail.com;';                    
            $mail->SMTPAuth   = true;                             
            $mail->Username   = 'amirraoiqbal@gmail.com';                 
            $mail->Password   = 'pqdrfrfclraybgjl';                        
            $mail->SMTPSecure = 'tls';                              
            $mail->Port       = 587;  
        
            $mail->setFrom('amirraoiqbal@gmail.com', 'Name');           
            $mail->addAddress($email);
            //$mail->addAddress('receiver2@gfg.com', 'Name');
            
            $mail->isHTML(true);                                  
            $mail->Subject = 'OTP Varification';
            $mail->Body    = 'Your <b>OTP</b> code <br><b>'.$otp.'</b>';
            $mail->AltBody = 'Body in plain text for non-HTML mail clients';
            $mail->send();
            echo "Mail has been sent successfully!";
            header("location:otp.php?");
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
  
       
     }else{
        echo '<script language="javascript">';
        echo 'alert("Mail sent Failed!")';
        echo '</script>';
    }
}


}
// else{
//     echo '<script language="javascript">';
//     echo 'alert("Register Failed!")';  //not showing an alert box.
//     echo '</script>';
// }

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
                    <h2 class="text-info">Please Register!</h2>
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="mt-3">
                        <label for="inputEmail4" class="form-label">Name</label>
                        <input type="text" class="form-control" placeholder="Enter Name" name="name">
                    </div><div class="mt-3">
                        <label for="inputEmail4" class="form-label">Email</label>
                        <input type="email" class="form-control" placeholder="Enter Email" name="email" required>
                    </div>
                    <div class="mt-3">
                        <label for="inputPassword4" class="form-label">Password</label>
                        <input type="password" class="form-control" placeholder="Enter Password" name="password" required>
                    </div>
                    <div class="mt-4">
                        <button type="submit" name="submit" class="btn btn-primary me-3">Send OTP</button>
                        Already Member?<a href="login.php" class="ms-1 text-decoration-none">Login here</a><br>
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