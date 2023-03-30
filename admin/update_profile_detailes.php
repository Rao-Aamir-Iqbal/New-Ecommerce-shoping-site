<?php
//session_start();
 include 'index.php';
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require 'phpmailer/PHPMailer-master/src/Exception.php';
    require 'phpmailer/PHPMailer-master/src/PHPMailer.php';
    require 'phpmailer/PHPMailer-master/src/SMTP.php';

 //$se_id = $_SESSION['u_id'];
 $conn = mysqli_connect("localhost","root","","registeration");
 if($conn) {
     //echo "Connected successfully";
     
   }else{
     die("Connection failed:".mysqli_connect_error());
   }

   //$email = $_GET['email'];

 $sqli = "SELECT * FROM employee WHERE id = '".$_SESSION['u_id']."'";
 $rel = mysqli_query($conn, $sqli);
 if(mysqli_num_rows($rel)){
    $db_data = mysqli_fetch_assoc($rel);
    $email = $db_data['email'];
    $name = $db_data['name'];
    $phto = $db_data['image'];
    $decoded_image =  base64_decode($phto);
 }

 if(isset($_POST['submit-detailes'])){
    extract($_POST);
    $email = $_POST['email'];
    $otp = rand(100000, 999999);
    $qur = "SELECT `email` FROM `employee` WHERE id = '".$_SESSION['u_id']."'";
    $rse = mysqli_query($conn, $qur);
    $data_db = mysqli_fetch_assoc($rse);
    $email_db = $data_db['email'];
    if($email == $email_db){
        $quer = "UPDATE `employee` SET `name`='".$name."' WHERE id = '".$_SESSION['u_id']."'";
        mysqli_query($conn, $quer);
        $msg = "Your Name Update Successfully";
    } else {
        $quer = "UPDATE `employee` SET `name`='" . $name . "',`email`='" . $email . "',`otp_code` = '" . $otp . "', status = 0 WHERE id = '" . $_SESSION['u_id'] . "'";
        mysqli_query($conn, $quer);

        $mail = new PHPMailer(true);

        try {
            $mail->SMTPDebug = 0;
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com;';
            $mail->SMTPAuth = true;
            $mail->Username = 'amirraoiqbal@gmail.com';
            $mail->Password = 'pqdrfrfclraybgjl';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            $mail->setFrom('amirraoiqbal@gmail.com', 'Name'); // mail send from          
            $mail->addAddress($email); // mail receiver
            //$mail->addAddress('receiver2@gfg.com', 'Name');

            $mail->isHTML(true);
            $mail->Subject = 'OTP Varification';
            $mail->Body = 'Your <b>OTP</b> code <br><b>' . $otp . '</b>';
            $mail->AltBody = 'Body in plain text for non-HTML mail clients';
            $mail->send();
            $_SESSION['update_email'] = "Check Your Email and Set OTP!";
            header("location:otp.php");
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
    
    //header('location:otp.php');
    
      //$msg = "Your Profile Account Details Update Successfully"; 
   
}

if(isset($_POST['submit_img']) && isset($_FILES["image"]["tmp_name"]) && !empty(($_FILES["image"]["tmp_name"]))){

    extract($_POST);
    //print_r($_FILES);
    $fileinfo = getimagesize($_FILES["image"]["tmp_name"]);
    $width = $fileinfo[0];
    $height = $fileinfo[1];
    $filename = $_FILES["image"]["name"];
    $tempname = $_FILES["image"]["tmp_name"];
    //$folder = "images" . $filename;
    //move_uploaded_file($tempname, $folder);
   
    
    $allowed_image_extension = array(
        "png",
        "jpg",
        "jpeg"
    );
    // Get image file extension
    $file_extension = pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);
    
    // Validate file input to check if is not empty
    if (!isset($tempname)) {
        $response = array(
           // "type" => "error",
            $msg_image = "Choose image file to upload."
        );
    }    // Validate file input to check if is with valid extension
    else if (!in_array($file_extension, $allowed_image_extension)) {
        $response = array(
            //"type" => "error",
            $msg_image = "Upload valid images. Only PNG, JPG and JPEG are allowed."
        );
    }    // Validate image file size
    else if (($_FILES["image"]["size"] > 2000000)) {
        $response = array(
            "type" => "error",
            $msg_image = "Image size exceeds 2MB"
        );
    }    // Validate image file dimension
    else if ($width > "500" || $height > "400") {
        $response = array(
            "type" => "error",
            $msg_image = "Image dimension should be within 300X200"
        );
    } 
    else {
        $target_folder = "images" . basename($filename);

        if (move_uploaded_file($tempname, $target_folder)) {

            $encoded_image =  base64_encode($filename);

            $quer = "UPDATE `employee` SET `image`='".$encoded_image."' WHERE email = '".$email."'";
            mysqli_query($conn, $quer);
            $msg_image = "Your Profile Image Update Successfully"; 
            header("Refresh:4");
        } else {
            $msg_image = "Your Profile Image do not Update";
            header("Refresh:0"); 
        }
    }

   
}

?>
<div class="container mt-5">
    <div class="row d-flex justify-content-center">
        <div class="col-md-8">
            <a href="change_pass.php" class="btn btn-primary mt-2">Change Password</a>
            <div class="card shadow">

                <h5 class="card-title text-center mt-2">Profile Picture</h5>
                <div class="text-center mt-1">
                    <?php
                if(isset($msg_image)){
                 ?>
                    <div class="alert alert-success" role="alert">
                        <?php
                   echo $msg_image;
                   ?>
                    </div>
                    <?php
                }
                ?>
                    <?php
                if($decoded_image ==''){
                    ?>
                    <img src="images/download.png" class="bd-placeholder-img rounded-circle mt-1 my-1" alt="..."
                        width="140" height="140">
                    <?php
                }else{
                    ?>
                    <img src="images/<?php echo $decoded_image;?>" class="bd-placeholder-img rounded-circle mt-1 my-1"
                        alt="..." width="140" height="140">
                    <?php
                }
                ?>

                    <br>
                    <p>JPEG, JPG or PNG no larger than 5 MB</p>
                    <div class="fw-bold">
                        <?php
                echo $name;
                ?>
                    </div>
                    <br>
                    <form action="" method="post" enctype="multipart/form-data">
                        <label class="form-label ms-5">Choose New Image</label>
                        <input type="file" name="image" class="ms-0">
                        <br>
                        <button type="submit" name="submit_img" class="btn btn-primary mt-2">Upload New Image</button>

                    </form>
                </div>
                <hr>
                <div class="card-body text-center">
                    <h5 class="card-title">Account Details</h5>
                    <?php
                if(isset($msg)){
                 ?>
                    <div class="alert alert-success" role="alert">
                        <?php
                   echo $msg;
                   //session_unset();
                   ?>
                    </div>
                    <?php
                }
                ?>
                    <form action="" method="POST">
                        <div class="row my-4 g-3">
                            <div class="col text-start">
                                <label for="inputname4" class="form-label">Name</label>
                                <input type="text" name="name" class="form-control" value="<?php echo $name;?>"
                                    placeholder="" aria-label="">
                            </div>
                            <div class="col text-start">
                                <label for="inputEmail4" class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" value="<?php echo $email;?>"
                                    placeholder="" aria-label="">
                            </div>
                        </div>
                        <button type="submit" name="submit-detailes" value="submit" class="btn btn-primary">Update
                            Details</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
</script>
<script>
$(".alert").delay(4000).slideUp(200, function() {
    $(this).alert('close');
});
</script>
</body>

</html>