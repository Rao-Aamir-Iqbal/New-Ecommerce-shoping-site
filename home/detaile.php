<style>
  body {
    font-family: 'Roboto Condensed', sans-serif;
    background-color: #f5f5f5
  }

  .hedding {
    font-size: 20px;
    color: #ab8181`;
  }

  .main-section {
    position: absolute;
    left: 50%;
    right: 50%;
    transform: translate(-50%, 5%);
  }

  .left-side-product-box img {
    width: 100%;
  }

  .left-side-product-box .sub-img img {
    margin-top: 5px;
    width: 83px;
    height: 100px;
  }

  .right-side-pro-detail span {
    font-size: 15px;
  }

  .right-side-pro-detail p {
    font-size: 25px;
    color: #a1a1a1;
  }

  .right-side-pro-detail .price-pro {
    color: #E45641;
  }

  .right-side-pro-detail .tag-section {
    font-size: 18px;
    color: #5D4C46;
  }

  .pro-box-section .pro-box img {
    width: 100%;
    height: 200px;
  }

  @media (min-width:360px) and (max-width:640px) {
    .pro-box-section .pro-box img {
      height: auto;
    }
  }
</style>

<?php
include 'header.php';
include 'config.php';

$id2 = $_GET['id'];

//echo $id2;

$select_pic2 = "SELECT * FROM products where id = '" . $id2 . "'";
$execute_sql = mysqli_query($conn, $select_pic2);
$db_products2 = mysqli_fetch_assoc($execute_sql);
$product_id2 = $db_products2['id'];
$product_name2 = $db_products2['p_name'];
$product_price2 = $db_products2['p_price'];
$product_details2 = $db_products2['p_description'];
$product_image2 = $db_products2['p_image'];
?>

<section>

  <div class="container mb-5 mt-5">
    <?php
    if (isset($_SESSION['cart_msg'])) {
      ?>
      <div class="alert alert-danger" role="alert">
        <?php
        echo $_SESSION['cart_msg'];
        unset($_SESSION['cart_msg']);

        ?>
      </div>
      <?php
    }
    ?>
      <div class="col-lg-12 mt-5 border p-3 main-section bg-white ">
        <div class="row hedding m-0 pl-3 pt-0 pb-3 mt-5">
          Product Details!
        </div>
        <div class="row m-0">

          <div class="col-lg-4 left-side-product-box pb-3">
            <!-- <img src="http://nicesnippets.com/demo/pd-image1.jpg" > -->
            <img src='images/<?php echo $product_image2; ?>' class="border p-3" width="100%" height="310">
          </div>
          <div class="col-lg-8">
            <div class="right-side-pro-detail border p-3 m-0">
              <div class="row">
                <div class="col-lg-12 pt-2">
                  <p>Product Name</p>
                  <span>
                    <?php echo $product_name2; ?>
                  </span>
                  <p class="">Product Price</p>
                  <span>
                    <?php echo $product_price2; ?>
                  </span>
                  <hr class="m-0 pt-2 mt-2">
                </div>
                <div class="col-lg-12 pt-2">
                  <h5>Product Detail</h5>
                  <span>
                    <?php echo $product_details2; ?>
                  </span>
                  <hr class="m-0 pt-2 mt-2">
                </div>
                <!-- <div class="col-lg-12">
                  <?php
                  // $sql98 = "SELECT * FROM cart WHERE id = '" . $product_id2 . "'";
                  // $exe_sql98 = mysqli_query($conn, $sql98);
                  // $fetch_sql98 = mysqli_fetch_assoc($exe_sql98);
                  // $dbqunty = $fetch_sql98['p_quantity'];
                  // if (!empty($dbqunty)) {
                  ?>
                    <h6>Quantity :</h6>
                    <input type="number" name="quantity" min="1" class="form-control text-center w-100"
                      value="<?php echo $dbqunty; ?>">
                    <?php
                    // }else{
                    ?>
                    <h6>Quantity :</h6>
                    <input type="number" name="quantity" min="1" class="form-control text-center w-100"
                      value="1">
                    <?php
                    // }
                    ?>

                </div> -->
                <div class="col-lg-12 mt-3">
                  <div class="row">
                    <div class="col-lg-6 pb-2">
                      <?php
                      $selec_catr = "SELECT * FROM cart WHERE product_id = '" . $product_id2 . "'";
                      $exe_select_car = mysqli_query($conn, $selec_catr);
                      if (mysqli_num_rows($exe_select_car) > 0) {
                        ?>
                        <!-- <a href="add_cart.php?del_id=<?php echo $product_id2; ?>" class="option2" style="font-size: 14px;">
                          Remove From Cart
                        </a> -->
                        <a href="add_cart.php?del_id=<?php echo $product_id2; ?>" class="btn btn-danger w-100">Remove From Cart</a>
                        <?php
                      } else {
                        ?>
                        <a href="add_cart.php?id=<?php echo $product_id2; ?>" class="btn btn-danger w-100">Add To Cart</a>
                        <!-- <a href="add_cart.php?id=<?php echo $product_id2; ?>" class="option2">
                          Add to Cart
                        </a> -->
                        <?php
                      }
                      ?>
                      <!-- <button type="submit" name="submit" class="btn btn-danger w-100">Add To Cart</button> -->
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
  </div>
</section>
<?php
include 'footer.php';

?>