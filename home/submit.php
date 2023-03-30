<?php

require('config.php');
require('stripe.php');
if (isset($_POST['stripeToken'])) {
	\Stripe\Stripe::setVerifySslCerts(false);

	$token = $_POST['stripeToken'];

	$data = \Stripe\Charge::create(
		array(
			"amount" => $Grand_total,
			"currency" => "usd",
			"description" => "E-commerce Store!",
			"source" => $token,
		)
	);
	$squery = mysqli_query($conn, "DELETE FROM cart WHERE user_id = '".$_SESSION['u_id']."'");
		if ($squery) {
			header('location:cart.php');
		} else {
			echo "error to submit";
		}
	}

?>