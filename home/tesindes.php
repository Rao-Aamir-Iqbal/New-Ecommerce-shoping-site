<?php
require('configration.php');
?>
<form action="submit.php" method="POST">
<scritp
                    src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                    data-key="<?php echo $publishablekey?>"
                    data-amount="500"
                    data-name="E-commerce Store"
                    data-description="E-commerce Store desc"
                    data-image=""
                    data-currency="Rs"
                    >

</form>