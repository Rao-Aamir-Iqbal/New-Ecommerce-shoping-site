<?php
 session_start();
 $_SESSION['email_send_msg'] = "Please Check Your Email to Reset Password";
// if(isset($_SESSION['u_id'])){
//     $id = $_SESSION['u_id'];
//     header('location:index.php');
//    }
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
    // $name = $_POST['name'];
    // $email = $_POST['email'];
    //  $password = $_POST['password'];
    //  $otp = rand(100000, 999999);
    //  $status = "0";
    $ql = "SELECT * FROM employee WHERE email = '".$email."'";
    $ru = mysqli_query($conn, $ql);
    if(mysqli_num_rows($ru) > 0){
        //$result = mysqli_fetch_assoc($ru);

        $token = rand(10,9999);
        $qury = "UPDATE `employee` SET token ='".$token."' WHERE email='".$email."'"; 
        mysqli_query($conn, $qury);
        $_SESSION['email_send_msg'] = "Please Check Your Mail to Reset Password!";
        $link = "<a href='http://localhost/ecommerce/reset.php?key=".$email."&token=".$token."'>Click To Reset password</a>";   
        // echo $token;
        // die();  
            
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
                        $mail->Subject = 'Reset Password';
                        $mail->Body    = 'Click On This Link to Reset Password '.$link.'';
                        $mail->AltBody = 'Body in plain text for non-HTML mail clients';
                        $mail->send();
                        echo "Check Your Email and Click on the link sent to your email";
                        header("location:login.php");
                    } catch (Exception $e) {
                        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                    }
            
        }else{
            echo '<script language="javascript">';
            echo 'alert("Invalid Email Address. Go back")';
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
                    <h2>Forget Password</h2>
                 <form action="" method="POST" enctype="multipart/form-data">
                    <div class="mt-3">
                        <label for="inputEmail4" class="form-label">Enter Email to Get Password</label>
                        <input type="email" class="form-control" placeholder="Enter Email" name="email" required>
                    </div>
                    <!-- <div class="mt-3">
                        <label for="inputPassword4" class="form-label">Password</label>
                        <input type="password" class="form-control" placeholder="Enter Password" name="password">
                    </div> -->
                    <div class="mt-4">
                        <button type="submit" name="submit" class="btn btn-primary">Send Mail</button>
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