<?php

include 'header.php';
error_reporting(0);
include 'stripe.php';
if (!isset($_SESSION['u_id'])) {
    header('location:login.php');
}
?>
<div class="container mt-5">

    <div class="row d-flex justify-content-center">
        <div class="col-md-10">
            <table class="table border-0 shadow">
                <thead class="shadow">
                    <tr>
                        <th scope="col">items</th>ٖ
                        <th scope="col">#</th>
                        <th scope="col">Product Name</th>
                        <th scope="col">Product Price</th>
                        <th scope="col">Product Quantity</th>
                    </tr>
                </thead>
                <tbody class="shadow">
                    <h3 class="mt-5 text-info">Order Summary</h3>
                    <?php
                    if (isset($_SESSION['billing'])) {
                        ?>
                        <div class="alert alert-success mt-5" role="alert">
                            <?php
                            echo $_SESSION['billing'];
                            unset($_SESSION['billing']);

                            ?>
                        </div>
                        <?php
                    }
                    ?>
                    <?php
                    $select_cart = "SELECT * FROM cart WHERE `user_id` = '" . $_SESSION['u_id'] . "'";
                    $execute_cart = mysqli_query($conn, $select_cart);
                    $idd = 1;
                    while ($fetch = mysqli_fetch_assoc($execute_cart)) {
                        ?>

                        <tr>
                            <td scope="row">
                                <img height='50' src='images/<?php echo $fetch['p_image']; ?>' .>
                            </td>
                            <td scope="row">
                                <?php echo $idd; ?>
                            </td>
                            <td>
                                <?php echo $fetch['p_name']; ?>
                            </td>
                            <td>
                                <?php echo '$' . $fetch['p_price']; ?>
                            </td>
                            <td>
                                <?php echo $fetch['p_quantity']; ?>

                            </td>
                        </tr>


                        <?php

                        $idd++;
                    }
                    ?>
                    <tr>
                        <td colspan="5" class="grand-total text-center text-danger" style="font-weight:bold">
                            <?php
                            $sql = "SELECT sum(total_price) as total FROM cart  WHERE `user_id` = '" . $_SESSION['u_id'] . "'";
                            $q = mysqli_query($conn, $sql);
                            $row = mysqli_fetch_assoc($q);
                            echo "Grand Total = " . $row['total'];
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="5" class="grand-total text-center text-danger" style="font-weight:bold">
                            <form action="submit.php" method="POST">
                                <div class="d-flex justify-content-center ">
                                    <script src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                                        data-key="<?php echo $publishableKey ?>"
                                        data-amount="<?php echo $Grand_total ?>" data-name="E-commerce Store"
                                        data-description="E-commerce Store Desc"
                                        data-image="https://www.logodesignlove.com/wp-content/uploads/2022/01/logo-wave-symbol-01.jpg"
                                        data-currency="usd" data-email="ecommerce@gmail.com">
                                        </script>
                                </div>
                            </form>
                        </td>
                    </tr>
                </tbody>

            </table>

        </div>
    </div>
</div>
<?php
include 'footer.php';
?>