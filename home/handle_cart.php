<?php
include 'config.php';
if (isset($_POST['scope'])) {


    $scope = $_POST['scope'];
    switch ($scope) {
        case "update":

             $product_id = $_POST['product_id'];
             $product_qty = $_POST['product_qty'];

            $sqli = mysqli_query($conn, "SELECT * FROM cart WHERE product_id = '" . $product_id . "'");
            if(mysqli_num_rows($sqli)>0){
            $fetch = mysqli_fetch_assoc($sqli);

             $p_price = $fetch['p_price'];

             $total_priece = $product_qty * $p_price;
             
             $update = mysqli_query($conn,"UPDATE cart SET `p_quantity` = '".$product_qty."', `total_price` = '". $total_priece."' WHERE product_id = '" . $product_id . "' ");
                if ($update) {
                   $slq_qiry = mysqli_query($conn, "SELECT * FROM cart WHERE product_id = '" . $product_id . "'");
                   $fetch = mysqli_fetch_assoc($slq_qiry);
                   $total_price = $fetch['total_price'];
                   echo $total_price;

                } else {
                    echo 200;
                }
            }
            

    }
}


?>