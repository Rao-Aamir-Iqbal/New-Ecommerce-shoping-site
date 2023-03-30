<?php
require ('stripe-php-master/init.php');


$publishablekey ="pk_test_51MebYrAvrdybUPpyA6quYInM0TTgFyeNRkmKCkm3HAsYmiLCsuWviZgw1Go6mLw8fz1xcpoWgXrtBK9mgbssZUbn00XGroRFCj";
$secretkey ="sk_test_51MebYrAvrdybUPpymlJjleUJIhHmblO5fJ1UtWgACp0U6r3ErplFZ1aBWDDdfWBJrJwXPMiq4ouv23J2W3B4vFe600NHybzzI5";

\Stripe\Stripe::setApiKey($secretkey);

?>