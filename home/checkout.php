<?php

include 'header.php';
ob_start();
// error_reporting(0);
if (!isset($_SESSION['u_id'])) {
    header('location:login.php');
}

if (isset($_POST['submit'])) {

    // echo "<pre>";
    // print_r($data);

    extract($_POST);

    echo $name . "<br>";
    echo $email . "<br>";
    echo $city . "<br>";
    echo $address . "<br>";
    echo $zip;

    if (empty($name)) {
        $_SESSION['error_msg1'] = "Please Enter Your Name";
    }
    if (empty($email)) {
        $_SESSION['error_msg2'] = "Please Enter Your Email";
    }
    if (empty($address)) {
        $_SESSION['error_msg3'] = "Please Enter Your Address";
    }
    if (empty($city)) {
        $_SESSION['error_msg4'] = "Please Enter Your City";
    }
    if (empty($zip)) {
        $_SESSION['error_msg5'] = "Please Enter Your Zip";
    }

    if (!empty($name) && !empty($email) && !empty($city) && !empty($address) && !empty($zip)) {

        $sqli_qry = "INSERT INTO `order_info`(`name`, `email`, `address`, `city`, `zip_code`) 
        VALUES ('" . $name . "','" . $email . "','" . $address . "','" . $city . "','" . $zip . "')";
        $rs66 = mysqli_query($conn, $sqli_qry);
        if ($rs66) {
            $_SESSION['billing'] = "Your Shipping And billing Information Submited Successfully!";
            header('location:order_info.php');
        }else{
            echo "Error to insert";
        }
    }

}
?>
<div class="container">
    <div class="row d-flex justify-content-center mt-5">
        <div class="col-md-10">
            <div class="card border-0 shadow p-4 mt-5 mb-2">
                <h3 class="text-info">Shipping And Biling Informatin</h3>
                <form action="" method="POST">
                    <div class="form-row mt-3">
                        <div class="form-group col-md-6">
                            <label for="inputName">Name</label>
                            <input type="text" class="form-control" name="name" placeholder="Name">
                            <div class="text-danger">
                                <?php
                                if (isset($_SESSION['error_msg1'])) {
                                    echo $_SESSION['error_msg1'];
                                    unset($_SESSION['error_msg1']);
                                }
                                ?>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputEmail">Email</label>
                            <input type="email" class="form-control" name="email" placeholder="Email">
                            <div class="text-danger">
                                <?php
                                if (isset($_SESSION['error_msg2'])) {
                                    echo $_SESSION['error_msg2'];
                                    unset($_SESSION['error_msg2']);
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputAddress">Address</label>
                        <input type="text" class="form-control" name="address" placeholder="1234 Main St">
                        <div class="text-danger">
                            <?php
                            if (isset($_SESSION['error_msg3'])) {
                                echo $_SESSION['error_msg3'];
                                unset($_SESSION['error_msg3']);
                            }
                            ?>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputCity">City</label>
                            <input type="text" class="form-control" name="city">
                            <div class="text-danger">
                                <?php
                                if (isset($_SESSION['error_msg4'])) {
                                    echo $_SESSION['error_msg4'];
                                    unset($_SESSION['error_msg4']);
                                }
                                ?>
                            </div>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="inputZip">Zip</label>
                            <input type="text" class="form-control" name="zip">
                            <div class="text-danger">
                                <?php
                                if (isset($_SESSION['error_msg5'])) {
                                    echo $_SESSION['error_msg5'];
                                    unset($_SESSION['error_msg5']);
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-success" name="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
include 'footer.php';
?>