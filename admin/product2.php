<?php

include 'index.php';
$conn = mysqli_connect("localhost", "root", "", "registeration");
if ($conn) {
    //echo "Connected successfully";

} else {
    die("Connection failed: " . mysqli_connect_error());
}
?>
<div class="container">
    <div class="row d-flex justify-content-center">
        <div class="col-md-10 mt-4">
            <h3 class="d-flex justify-content-center text-success">Products Table:</h3>
            <?php
            if (isset($_SESSION['add_p_msg'])) {
                ?>
                <div class="alert alert-success" role="alert">
                    <?php
                    echo $_SESSION['add_p_msg'];
                    unset($_SESSION['add_p_msg']);
                    ?>
                </div>
                <?php
            }
            ?>
            <a href="add_product.php" name="submit" class="btn btn-info">Add Products</a>
            <form action="delete_bulk.php" method="POST" enctype="multipart/form-data">
                <table class="table table-bordered mt-4 table-sm">
                    <thead class="bg-dark text-white">
                        <tr>
                            <th scope="col"><button type="submit" name="delete_submit"
                                    class="btn btn-danger btn-sm">Delete</button></th>
                            <th scope="col">#</th>
                            <th scope="col">Product Name</th>
                            <th scope="col">Product Price</th>
                            <th scope="col">Sub-Category Name</th>
                            <th scope="col">Product Description</th>
                            <th scope="col"><button type="submit" name="active_submit"
                                    class="btn btn-success btn-sm">Active</button>

                                <button type="submit" name="deactive_submit"
                                    class="btn btn-danger btn-sm">Deactive</button>
                            </th>
                            <th scope="col">Product Image</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $select = "SELECT * FROM `products`";
                        $sql = mysqli_query($conn, $select);
                        // $idd = 1;
                        if (mysqli_num_rows($sql) > 0) {
                            $idd = 1;
                            while ($db_data = mysqli_fetch_assoc($sql)) {
                                $id = $db_data['id'];
                                $sub_category_id = $db_data['sub_category_id'];
                                $qur = mysqli_query($conn, "SELECT * FROM subcategory WHERE id = '" . $sub_category_id . "'");

                                $res34 = mysqli_fetch_assoc($qur);
                                if ($db_data['status'] == 1) {
                                    $status = "Active";
                                } else {
                                    $status = "Deactive";
                                }
                                ?>
                                <tr>
                                    <td>
                                        <input type="checkbox" name="products_delete_id[]" value="<?php echo $id; ?>">
                                    </td>
                                    <td>
                                        <?php echo $idd; ?>
                                    </td>
                                    <td>
                                        <?php echo $db_data['p_name']; ?>
                                    </td>
                                    <td>
                                        <?php echo $db_data['p_price']; ?>
                                    </td>
                                    <td>
                                        <?php echo $res34['sub_category_name']; ?>
                                    </td>
                                    <td>
                                        <?php echo $db_data['p_description']; ?>
                                    </td>
                                    <td>
                                        
                                    <input type="checkbox" name="active_deactive_id[]" value="<?php echo $id; ?>">&nbsp&nbsp
                                    <?php echo $status ?>

                                    </td>
                                    <td><img height='90' src='images/<?php echo $db_data['p_image']; ?>' .></td>
                                    <td class="p-3"><a class="btn btn-success btn-sm"
                                            href="edit_product.php?id=<?php echo $id; ?>">Edit</a>
                                        <a class="btn btn-danger btn-sm"
                                            href="delete_product.php?id=<?php echo $id; ?>">Delete</a>
                                    </td>
                                </tr>
                                <?php
                                $idd++;
                            }
                        } else {
                            $_SESSION['add_p_msg'] = "No Any Products Availabel!";
                        }
                        ?>
                    </tbody>
                </table>
                <div id="pagination">
                    <a>1</a>

                </div>
            </form>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
        </script>
    <script>
        $(".alert").delay(5000).slideUp(200, function () {
            $(this).alert('close');
        });
    </script>
    </body>

    </html>