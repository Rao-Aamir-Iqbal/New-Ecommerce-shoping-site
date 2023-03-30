<?php
session_start();
include 'config.php';

$sql = "SELECT sum(total_price) as total FROM cart WHERE user_id = '".$_SESSION['u_id']."'";

$q = mysqli_query($conn, $sql);

$row = mysqli_fetch_assoc($q);
    if($row){
        echo "Grand Total = ".$row['total'];
        }


?>