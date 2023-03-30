
<style type="text/css">
    span.page-link{
        cursor :pointer;
    }
    .pagination{
        justify-content: center;
    }
</style>
<?php
$conn = mysqli_connect("localhost", "root", "", "registeration");
if ($conn) {
    //echo "Connected successfully";

} else {
    die("Connection failed: " . mysqli_connect_error());
}



$limit = 5;
$page = 0;
$output = '';

if (isset($_POST['page'])) {
    $page = $_POST['page'];
} else {
    $page = 1;
}

$astart_form = ($page - 1) * $limit;
$select = "SELECT * FROM `products` ORDER BY id DESC LIMIT $astart_form, $limit";
$sql = mysqli_query($conn, $select);
$output .= '
<form action="delete_bulk.php" method="POST" enctype="multipart/form-data">
    <table class="table table-bordered mt-4 table-sm">
        <thead class="bg-dark text-white">
            <tr>
                <th scope="col"><button type="submit" name="delete_submit" class="btn btn-danger btn-sm">Delete</button>
                </th>
                <th scope="col">#</th>
                <th scope="col">Product Name</th>
                <th scope="col">Product Price</th>
                <th scope="col">Sub-Category Name</th>
                <th scope="col">Product Description</th>
                <th scope="col"><button type="submit" name="active_submit"
                        class="btn btn-success btn-sm">Active</button>

                    <button type="submit" name="deactive_submit" class="btn btn-danger btn-sm">Deactive</button>
                </th>
                <th scope="col">Product Image</th>
                <th scope="col">Action</th>
            </tr>
        </thead>

';
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
        $output .= '
        <tbody>
             <tr>
                        <td>
                            <input type="checkbox" name="products_delete_id[]" value=' . $id . '>
                        </td>
                        <td>
                             ' . $idd . '
                        </td>
                        <td>
                            ' . $db_data["p_name"] . '
                        </td>
                        <td>
                            ' . $db_data["p_price"] . '
                        </td>
                        <td>
                            ' . $res34["sub_category_name"] . '
                        </td>
                        <td>
                            ' . $db_data["p_description"] . '
                        </td>
                        <td>

                            <input type="checkbox" name="active_deactive_id[]" value=' . $id . '>&nbsp&nbsp
                            ' . $status . '

                        </td>
                        <td><img height="90" src="images/' . $db_data["p_image"] . ' .></td>
                        <td class="p-3"><a class="btn btn-success btn-sm" href="edit_product.php?id=' . $id . '">Edit</a>
                            <a class="btn btn-danger btn-sm" href="delete_product.php?id=' . $id . '>Delete</a>
                        </td>
                    </tr>
                    </tbody>
        ';
        $idd++;
    }
} else {
    // $output .= '
    // $_SESSION["add_p_msg"] = "No Any Products Availabel!";
    // ';

}
$output .= '
          
     </table>
</form>
';

//pagination code

$qury = "SELECT * FROM `products`";
$total = mysqli_query($conn, $qury);
$total_records = mysqli_num_rows($total);
$total_page = ceil($total_records / $limit);
$output .= '
  <ul class="pagination">
';
if ($page > 1) {
    $previous = $page - 1;
    $output .= '<li class="page-item" id="1"><span class="page-link">First Page</span></li>';
    $output .= '<li class="page-item" id="' . $previous . '"><span class="page-link"><li class="fa fa-arrow-left"></li></span></li>';
}
for ($i = 1; $i <= $total_page; $i++) {
    $active_class = "";
    if ($i == $page) {
        $active_class = "Active";
    }
    $output .= '<li class="page-item ' . $active_class . '" id="' . $i . '"><span class="page-link">' . $i . '</span></li>';
}
if ($page < $total_page){
    $page++;
    $output .= '<li class="page-item" id="' . $page . '"><span class="page-link"><li class="fa fa-arrow-right"></li></span></li>'; 
    $output .= '<li class="page-item" id="' . $total_page . '"><span class="page-link">Last Page</span></li>';
}
    $output .= '</ul>';
    echo $output
?>



