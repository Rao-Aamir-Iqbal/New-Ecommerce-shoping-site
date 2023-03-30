<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "registeration");
if ($conn) {
  //echo "Connected successfully";

} else {
  die("Connection failed: " . mysqli_connect_error());
}




require('stripe-php-master/init.php');

$sql = "SELECT sum(total_price) as total FROM cart  WHERE `user_id` = '".$_SESSION['u_id']."'";
$q = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($q);
$Grand_total = $row['total'] * 100;
//echo "Grand Total = ".$g_total;

$publishableKey = "pk_test_51MebYrAvrdybUPpyA6quYInM0TTgFyeNRkmKCkm3HAsYmiLCsuWviZgw1Go6mLw8fz1xcpoWgXrtBK9mgbssZUbn00XGroRFCj";

$secretKey = "sk_test_51MebYrAvrdybUPpymlJjleUJIhHmblO5fJ1UtWgACp0U6r3ErplFZ1aBWDDdfWBJrJwXPMiq4ouv23J2W3B4vFe600NHybzzI5";

\Stripe\Stripe::setApiKey($secretKey);
