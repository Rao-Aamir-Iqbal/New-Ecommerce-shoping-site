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

        <div class="col-md-8 mt-4">
            <h3 class="d-flex justify-content-center text-success">Sub-Category Table:</h3>
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
            <a href="add_subcategory.php" name="submit" class="btn btn-info">Add Sub-Category</a>
            <form action="delete_bulk.php" method="POST">
                <table class="table table-bordered mt-4">
                    <thead class="bg-dark text-white fw-bold">
                        <tr>
                            <th scope="col"><button type="submit" name="delete_sub_submit"
                                    class="btn btn-danger btn-sm">Delete</button></th>
                            <th scope="col">#</th>
                            <th scope="col">Sub-Category Name</th>
                            <th scope="col">Category Name</th>
                            <th scope="col"><button type="submit" name="actve_sub_submit"
                                    class="btn btn-success btn-sm">Active</button>
                                    <button type="submit" name="deactive_sub_submit"
                                    class="btn btn-danger btn-sm">Deactive</button></th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $select = "SELECT * FROM `subcategory`";
                        $sql = mysqli_query($conn, $select);
                        $idd = 1;

                        if (mysqli_num_rows($sql) > 0) {
                            while ($db_data = mysqli_fetch_assoc($sql)) {
                                $id = $db_data['id'];
                                if ($db_data['status'] == 1) {
                                    $status = "Active";
                                } else {
                                    $status = "Deactive";
                                }
                                $cat_id = $db_data['category_id'];
                                $categoryqu = "SELECT * FROM `category` WHERE id = $cat_id";
                                $res45 = mysqli_query($conn, $categoryqu);
                                $db_cat_name = mysqli_fetch_assoc($res45);
                                $category_name = $db_cat_name['category_name'];

                                echo '<tr>
                            <td><input type="checkbox" name="subcategory_delete_id[]" value= ' . $id . '></td>
                        <td>' . $idd . '</td>
                        <td>' . $db_data['sub_category_name'] . '</td>
                        <td>' . $db_cat_name['category_name'] . '</td>
                        <td><input type="checkbox" name="subcategory_active-deactive_id[]" value= ' . $id . '>&nbsp&nbsp' . $status . '</td>
                        <td class="p-3"><a class="btn btn-success" href="edit_subcategory.php?id=' . $id . '&cat_name=' . $category_name . '">Edit</a> 
                        <a class="btn btn-danger" href="delete_category.php?idsub=' . $id . '">Delete</a></td>
                    </tr>';
                                $idd++;
                            }
                        } else {
                            $_SESSION['add_p_msg'] = "No Any Subcategory Availabel!";
                        }

                        ?>
                    </tbody>
                </table>
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