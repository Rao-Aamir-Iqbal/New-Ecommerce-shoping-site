
<?php
session_start();
// $conn = mysqli_connect("localhost", "root", "", "registeration");
// if ($conn) {
//   //echo "Connected successfully";
// } else {
//   die("Connection failed: " . mysqli_connect_error());
// }

//$isadmin = $_GET["isadmin"];
//$email_checker = $_SESSION['email'];
if(!isset($_SESSION['u_id'])){
 header('location:login.php');
}
if($_SESSION['isadmin']==0)
{
  header('location: ../home/index.php');
}
// $query_checker = "SELECT * FROM `employee` Where `email`='$email_checker'";
// $run_cheker = mysqli_query($conn, $query_checker);
// $fetch_admin = mysqli_fetch_assoc($run_cheker);

// $user_type = $fetch_admin['isadmin'];
// if($user_type == 0)
// {
//   header('location: ../home/index.php');
// }
// echo $email;
// die();
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
  <body>
    <div class="container-fluid">
        <div class="row d-flex justify-content-center">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
              <div class="container-fluid">
                <a class="navbar-brand" href="#">Registeration Process And Profile Update</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                  <ul class="navbar-nav ms-auto me-5">
                    <li class="nav-item">
                      <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="category.php">Category</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="subcategory.php">Sub-Category</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="product.php">Products</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="update_profile_detailes.php">Profile</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link fw-bold" href="logout.php">Logout</a>
                    </li>
                  </ul>
                </div>
              </div>
           </nav>
           
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