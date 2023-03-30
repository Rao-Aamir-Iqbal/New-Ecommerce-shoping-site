<?php
include 'header.php';
include 'config.php';

    ?>
<div class="container mt-5">

    <div class="row">
        <div class="col-md-12 mt-5 text-info">
            <h3 class="">Your Cart</h3>
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
            <table class="table table-bordered shadow">
                <thead class="shadow">
                    <tr>
                        <th scope="col">items</th>ٖ
                        <th scope="col">#</th>
                        <th scope="col">Product Name</th>
                        <th scope="col">Product Price</th>
                        <th scope="col">Product Quantity</th>
                        <th scope="col">Total Price</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody class="shadow">
                    <?php
                    $select_cart = "SELECT * FROM cart WHERE `user_id` = '" . $_SESSION['u_id'] . "'";
                    $execute_cart = mysqli_query($conn, $select_cart);
                    if (mysqli_num_rows($execute_cart) != 0) {

                       
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
                                    <?php echo $fetch['p_price']; ?> <input type="hidden" class="iprice"
                                        value="<?php echo $fetch['p_price']; ?>">
                                </td>
                                <td class="product_data">
                                    <input type="hidden" class="product_id" value="<?= $fetch['product_id'] ?>">
                                    <div class="input-group text-center" style="width:130px">

                                        <div class="input-group-prepend">
                                            <button class="input-group-text decrement-btn updateQty">-</button>
                                        </div>


                                        <input type="text" class="form-control iquantity text-center bg-white" min="1"
                                            onchange="subTotal()" value="<?php echo $fetch['p_quantity']; ?>">


                                        <div class="input-group-append">
                                            <button class="input-group-text increment-btn updateQty">+</button>
                                        </div>

                                    </div>

                                </td>
                                <td class='itotal'>
                                    <?php echo $fetch['total_price']; ?>
                                </td>
                                <td>
                                    <a href="add_cart.php?del_idd=<?php echo $fetch['product_id']; ?>"
                                        class="btn btn-danger text-white"><i class="fa fa-trash" aria-hidden="true"></i>
                                        Remove</a>
                                </td>
                            </tr>


                            <?php

                            $idd++;
                        }
                        ?>
                        <tr>

                            <td colspan="4" class="text-center"><a href="index.php" class="btn btn-success text-white"><i
                                        class="fa fa-shopping-cart" aria-hidden="true"></i> &nbsp
                                    Continue Shopping</a></td>
                            <td colspan="2" class="grand-total text-center text-danger" style="font-weight:bold">
                                <?php
                                $sql = "SELECT sum(total_price) as total FROM cart WHERE `user_id` = '" . $_SESSION['u_id'] . "'";
                                $q = mysqli_query($conn, $sql);
                                $row = mysqli_fetch_assoc($q);
                                $g_total = $row['total'];
                                echo "Grand Total = " . $g_total;
                                ?>
                            </td>
                            <td><a href="checkout.php?" class="btn btn-success text-white"><i class="fa fa-money"
                                        aria-hidden="true"></i>
                                    Checkout</a></td>
                        </tr>
                        <?php
                    } else {
                        
                       echo "<h2 class='text-info'>Your Cart Is Empty, Please Add Products!</h2>";
                        ?>
                        <td colspan="4" class="text-center"><a href="index.php" class="btn btn-success text-white"><i
                                        class="fa fa-shopping-cart" aria-hidden="true"></i> &nbsp
                                    Continue Shopping</a></td>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php
include 'footer.php';
?>
<script>
    $(document).ready(function () {
        $('.increment-btn').click(function (e) {
            e.preventDefault();
            var qty = $(this).closest('.product_data').find('.iquantity').val();
            var value = parseInt(qty, 10);
            value = isNaN(value) ? 0 : value;
            if (value < 10) {
                value++;

                $(this).closest('.product_data').find('.iquantity').val(value);
            }
        });

        $('.decrement-btn').click(function (e) {
            e.preventDefault();
            var qty = $(this).closest('.product_data').find('.iquantity').val();
            var value = parseInt(qty, 10);
            value = isNaN(value) ? 0 : value;
            if (value > 1) {
                value--;
                $(this).closest('.product_data').find('.iquantity').val(value);
            }
        });

        $(document).on('click', '.updateQty', function (event) {
            var qty = $(this).closest('.product_data').find('.iquantity').val();
            var prod_id = $(this).closest('.product_data').find('.product_id').val();
            //alert(qty);
            $.ajax({
                method: "POST",
                url: "handle_cart.php",
                data: {
                    "product_qty": qty,
                    "product_id": prod_id,
                    "scope": "update"
                },
                success: function (response) {
                    $.ajax({
                        url: "handle_cart_sum.php",
                        method: "POST",
                        success: function (response) {
                            event.target.parentNode.parentNode.parentNode.parentNode.parentNode.querySelector('.grand-total').innerHTML = response;
                        }
                    });
                    event.target.parentNode.parentNode.parentNode.parentNode.querySelector('.itotal').innerHTML = response;
                }
            });

        });

    });
</script>