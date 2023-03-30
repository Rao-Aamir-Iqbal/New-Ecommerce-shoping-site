<?php
session_start();
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
     $password = $_POST['password'];
     $otp = rand(100000, 999999);
     $status = "0";
    $ql = "SELECT * FROM employee WHERE email = '".$email."'";
    $ru = mysqli_query($conn, $ql);
    if(mysqli_num_rows($ru) > 0){
        $result = mysqli_fetch_assoc($ru);
        $db_pasword = $result['password'];
        
        if(password_verify($password,$db_pasword)){
            $vari_pass = password_verify($password,$db_pasword);
            $query = "SELECT * FROM employee WHERE email = '".$email."' AND status = 1";
            $res = mysqli_query($conn, $query);
            if(mysqli_num_rows($res) == 0){
                
                $query2 = "SELECT * FROM employee WHERE email = '".$email."' AND status = 0";
                $res2 = mysqli_query($conn, $query2);
                if(mysqli_num_rows($res2) > 0){
                    $re = mysqli_fetch_assoc($res);
            
                    $_SESSION['u_id'] = $re['id'];
            
                    $sql =mysqli_query($conn, "UPDATE `employee` SET otp_code = '$otp' WHERE email = '".$email."'");
            
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
                        //echo "Mail has been sent successfully!";
                        header("location:otp.php");
                    } catch (Exception $e) {
                        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                    }
            
                }
                
                }else{
            
            
                    $re = mysqli_fetch_assoc($res);
            
                    $_SESSION['u_id'] = $re['id'];
                    $_SESSION['isadmin'] = $re['isadmin'];
                    $_SESSION['email'] = $re['email'];

                    if($re['isadmin'] == 1){
                        header('location:../admin/index.php');
                    }else{
                        header('location:index.php');
                    }
                    
            
            }
        
        }else{
            echo '<script language="javascript">';
            echo 'alert("Your Password Incorrect!")';
            echo '</script>'; 
        }
        
        

    }else{
        echo '<script language="javascript">';
        echo 'alert("This Email Not Register Yet! Please SignUp")';
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
                    <h2 class="text-info">Please Login!</h2>
                    <?php
                        if(isset($_SESSION['email_send_msg'])){
                        ?>
                        <div class="alert alert-success" role="alert">
                        <?php
                        echo $_SESSION['email_send_msg'];
                        session_unset();
                        ?>
                        </div>
                        <?php
                        }

                        if(isset($_SESSION['password_rest'])){
                            ?>
                            <div class="alert alert-success" role="alert">
                            <?php
                            echo $_SESSION['password_rest'];
                            session_unset();
                            ?>
                            </div>
                            <?php
                            }
                     ?>
                 <form action="" method="POST" enctype="multipart/form-data">
                    <div class="mt-3">
                        <label for="inputEmail4" class="form-label">Email</label>
                        <input type="email" class="form-control" placeholder="Enter Email" name="email" required>
                    </div>
                    <div class="mt-3">
                        <label for="inputPassword4" class="form-label">Password</label>
                        <input type="password" class="form-control" placeholder="Enter Password" name="password" required>
                    </div>
                    <!-- <div class="mt-3">
                        <label for="inputPassword4" class="form-label">Password</label>
                        <input type="password" class="form-control" placeholder="Enter Password" name="password">
                    </div> -->
                    <div class="mt-4">
                        <button type="submit" name="submit" class="btn btn-primary me-3">Login</button>
                        Not a Member?<a href="register.php" class="ms-1 text-decoration-none">Register here</a><br>
                        <a href="forget.php" class="text-danger fw-bold text-decoration-none">Forget Password</a>
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
    $(".alert").delay(5000).slideUp(200, function() {
    $(this).alert('close');
});
    </script>
  </body>
</html>