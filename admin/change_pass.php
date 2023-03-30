<?php
session_start();

$conn = mysqli_connect("localhost","root","","registeration");
if($conn) {
    //echo "Connected successfully";
    
  }else{
    die("Connection failed:".mysqli_connect_error());
  }
 
if(isset($_POST['submit_pass'])){
    extract($_POST);
    // $name = $_POST['name'];
    // $email = $_POST['email'];
      //$old_pass = $_POST['old_pass'];
     // $new_pass = $_POST['new_pass'];
     
    $ql = "SELECT * FROM employee WHERE id='".$_SESSION['u_id']."'";
    $ru = mysqli_query($conn, $ql);
    if($fetch = mysqli_fetch_assoc($ru)){

        $db_password = $fetch['password'];

        // echo $db_password;
        // die();
    
        if(password_verify($old_pass,$db_password)){
            if($new_pass==$new_c_pass){
                $sq = "UPDATE `employee` SET password = '".password_hash($new_pass, PASSWORD_DEFAULT)."' WHERE id = '".$_SESSION['u_id']."'";
                mysqli_query($conn, $sq);
                echo '<script language="javascript">';
                echo 'alert("Your Password Change Successfully!")';
                echo '</script>';
                header("location:index.php");
            }else{
                $pass_msg = "Confirm Passsword Not Match!";
            }
            
        }else{
            $pass_msg = "Old Passwword Not Match!";
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
                <div class="card border-0 p-3 shadow">
                    <h2>change Password</h2>
                    <?php
                    if(isset($pass_msg)){
                        ?>
                    <div class="alert alert-success" role="alert">
                        <?php
                        echo $pass_msg;
                        ?>
                    </div>
                    <?php
                        }
                    ?>
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="col text-start">
                            <label for="inputname4" class="form-label">Old Password</label>
                            <input type="password" name="old_pass" class="form-control" placeholder="" aria-label="">
                        </div>
                        <div class="col text-start">
                            <label for="inputEmail4" class="form-label">New Password</label>
                            <input type="password" name="new_pass" class="form-control" placeholder="" aria-label="">
                        </div>
                        <div class="col text-start">
                            <label for="inputEmail4" class="form-label">New Confirm Password</label>
                            <input type="password" name="new_c_pass" class="form-control" placeholder="" aria-label="">
                        </div>
                        <button type="submit" name="submit_pass" class="btn btn-primary mt-2">Submit</button>
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