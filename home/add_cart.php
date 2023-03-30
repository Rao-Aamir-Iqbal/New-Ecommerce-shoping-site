<?php
session_start();

include 'config.php';
//echo $_SESSION['u_id'];
//die();
if (!isset($_SESSION['u_id'])) {

    header('location:login.php');

} else {
    if (isset($_GET['del_id'])) {
        $del_sql = "DELETE FROM cart WHERE product_id ='" . $_GET['del_id'] . "'";
        $del_execut = mysqli_query($conn, $del_sql);

        if ($del_execut) {
            $_SESSION['cart_msg'] = "Product Deleted from Cart Successfully!";
            header('location:index.php');

        }
    }
    if (isset($_GET['del_idd'])) {
        $del_sql = "DELETE FROM cart WHERE product_id ='" . $_GET['del_idd'] . "'";
        $del_execut = mysqli_query($conn, $del_sql);

        if ($del_execut) {
            $_SESSION['cart_msg'] = "Product Deleted from Cart Successfully!";

            header('location:cart.php');

        }
    }

    if (isset($_GET['id'])) {

        $select_pic3 = "SELECT * FROM products where id = '" . $_GET['id'] . "'";
        $execute_sql3 = mysqli_query($conn, $select_pic3);
        $db_products3 = mysqli_fetch_assoc($execute_sql3);
        $product_id3 = $db_products3['id'];
        $product_name3 = $db_products3['p_name'];
        $product_price3 = $db_products3['p_price'];
        $product_details3 = $db_products3['p_description'];
        $product_image3 = $db_products3['p_image'];

        $insert = "INSERT INTO cart SET `user_id` = '".$_SESSION['u_id']."', `product_id` = '" . $product_id3 . "', `p_name` = '" . $product_name3 . "', 
            `p_price` = '" . $product_price3 . "', `p_quantity` = 1, `total_price` = '" . $product_price3 . "', `p_image` = '" . $product_image3 . "'";
        $execut_insert = mysqli_query($conn, $insert);
        $_SESSION['cart_msg'] = "Product Added to Cart Successfully!";
        header('location:index.php');
    }

    if (isset($_GET['idd'])) {

        $detail_quantity = $_POST['quantity'];

        $select_pi33 = "SELECT * FROM cart WHERE id = '" . $_GET['idd'] . "'";
        $exec_sql33 = mysqli_query($conn, $select_pi33);
        if (mysqli_num_rows($exec_sql33) > 0) {
            $select38 = "SELECT * FROM products where id = '" . $_GET['idd'] . "'";
            $execute38 = mysqli_query($conn, $select38);
            $db_produc38 = mysqli_fetch_assoc($execute38);

            $db_pro_price = $db_produc38['p_price'];

            $totall_price = $detail_quantity * $db_pro_price;

            $insert = "UPDATE cart SET p_quantity = '" . $detail_quantity . "', total_price = '" . $totall_price . "' WHERE id = '" . $_GET['idd'] . "'";
            $execut_insert = mysqli_query($conn, $insert);
            $_SESSION['cart_msg'] = "Product Added to Cart Successfully!";
            header('location:detaile.php?id=' . $_GET['idd']);
        } else {
            // $bd_res = mysqli_fetch_assoc($exec_sql33);
            // $bd_price = $bd_res['p_price'];

            // $totall_price = $detail_quantity * $bd_price;

            $select_pic3 = "SELECT * FROM products where id = '" . $_GET['idd'] . "'";
            $execute_sql3 = mysqli_query($conn, $select_pic3);
            $db_products3 = mysqli_fetch_assoc($execute_sql3);
            $product_id3 = $db_products3['id'];
            $product_name3 = $db_products3['p_name'];
            $product_price3 = $db_products3['p_price'];
            $product_details3 = $db_products3['p_description'];
            $product_image3 = $db_products3['p_image'];

            $totall_price = $detail_quantity * $product_price3;

            $insert = "INSERT INTO cart SET `p_name` = '" . $product_name3 . "', `p_price` = '" . $product_price3 . "',
            p_quantity = '" . $detail_quantity . "',  `total_price` = '" . $totall_price . "', p_image = '" . $product_image3 . "'";
            $execut_insert = mysqli_query($conn, $insert);
            $_SESSION['cart_msg'] = "Product Added to Cart Successfully!";
            header('location:detaile.php?id=' . $_GET['idd']);
        }
        //$db_products33 = mysqli_fetch_assoc($execute_sql33);

    }

    //include 'components/footer.php';  
}

?>