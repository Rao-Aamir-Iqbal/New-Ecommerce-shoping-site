<?php
session_start();
include 'config.php';
ob_start();
?>
<!DOCTYPE html>
<html>

<head>
   <!-- Basic -->
   <meta charset="utf-8" />
   <meta http-equiv="X-UA-Compatible" content="IE=edge" />
   <!-- Mobile Metas -->
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
   <!-- Site Metas -->
   <meta name="keywords" content="" />
   <meta name="description" content="" />
   <meta name="author" content="" />
   <link rel="shortcut icon" href="images/logo.jpg" type="">
   <title>Famms - Fashion HTML Template</title>
   <!-- bootstrap core css -->
   <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
   <!-- font awesome style -->
   <link href="css/font-awesome.min.css" rel="stylesheet" />
   <!-- Custom styles for this template -->
   <link href="css/style.css" rel="stylesheet" />
   <!-- responsive style -->
   <link href="css/responsive.css" rel="stylesheet" />
   <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.slim.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
   <div class="hero_area mb-4">
      <!-- header section strats -->
      <header class="header_section">
         <div class="container-">
            <nav class="navbar navbar-expand-lg navbar-light bg-white custom_nav-container fixed-top">
               <a class="navbar-brand ml-5" href="index.php"><img width="140" src="images/logo.jpg" alt="#" /></a>
               <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                  aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                  <span class=""> </span>
               </button>
               <div class="collapse navbar-collapse" id="navbarSupportedContent">
                  <ul class="navbar-nav">
                     <li class="nav-item active">
                        <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                     </li>
                     <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" role="button"
                           aria-haspopup="true" aria-expanded="true"> <span class="nav-label">Pages <span
                                 class="caret"></span></a>
                        <ul class="dropdown-menu">
                           <li><a href="about.php">About</a></li>
                           <li><a href="testimonial.php">Testimonial</a></li>
                        </ul>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link" href="product.php">Products</a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link" href="blog_list.php">Blog</a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link" href="contact.php">Contact</a>
                     </li>
                     <?php
                     if (isset($_SESSION['u_id'])) {
                        $query23 = mysqli_query($conn, "SELECT COUNT(*) AS count FROM cart WHERE user_id = '" . $_SESSION['u_id'] . "'");
                        while ($res23 = mysqli_fetch_assoc($query23)) {
                           $count = $res23['count'];
                        }
                        ?>
                        <li class="nav-item">
                           <a type="button" class="nav-link" href="cart.php">
                              <span class="badge badge-light nav-link border border-dark" style="font-size:17px;"><i class="fa fa-shopping-cart"
                                    aria-hidden="true">&nbsp;
                                    <?php echo $count ?></i></span>
                           </a>
                        </li>
                        <?php
                     } else {
                        echo "";
                     }
                     ?>
                     <form class="form-inline">
                        <button class="btn  my-2 my-sm-0 nav_search-btn" type="submit">
                           <i class="fa fa-search" aria-hidden="true"></i>
                        </button>
                        <?php
                        if (isset($_SESSION['u_id'])) {
                           ?>
                           <a type="button" href="logout.php" class="btn btn-outline-secondary btn-sm ml-3 mr-4">Loguot</a>
                           <?php
                        } else {
                           ?>
                           <a type="button" href="login.php" class="btn btn-outline-secondary btn-sm ml-3 mr-4">Login</a>
                           <?php
                        }
                        ?>
                     </form>
                  </ul>
               </div>
            </nav>
         </div>
      </header>