<?php
$conn = mysqli_connect("localhost", "root", "", "registeration");
if ($conn) {
    //echo "Connected successfully";

} else {
    die("Connection failed: " . mysqli_connect_error());
}

$limit_per_page = 2;
$page = "";
if (isset($_POST['page_no'])) {
    $page = $_POST['page_no'];
} else {
    $page = 1;
}

$offset = ($page - 1) * $limit_per_page;

// echo $offset;

$select = "SELECT * FROM `category` LIMIT {$offset},{$limit_per_page}";
$sql = mysqli_query($conn, $select);
$output = "";
if (mysqli_num_rows($sql) > 0) {
    $output .= '
  <table class="table table-bordered mt-4">
                <thead class="bg-dark text-white fw-bold">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Category Name</th>
                        <th scope="col">Category Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>';
    $idd = 1;

    while ($db_data = mysqli_fetch_assoc($sql)) {
        $id = $db_data["id"];
        if ($db_data["status"] == 1) {
            $status = "Active";
        } else {
            $status = "Deactive";
        }
        $output .= '<tr>
                        <td>' . $idd . '</td>
                        <td>' . $db_data['category_name'] . '</td>
                        <td>' . $status . '</td>
                        <td class="p-3"><a class="btn btn-success" href="edit_category.php?id=' . $id . '">Edit</a> 
                        <a class="btn btn-danger" href="delete_category.php?id=' . $id . '">Delete</a></td>
                    </tr>';
        $idd++;
    }

    $output .= ' </tbody>
            </table>';
    $select_total = "SELECT * FROM `category`";
    $sql_total = mysqli_query($conn, $select_total);
    $total_racord = mysqli_num_rows($sql_total);
    $total_pages = ceil($total_racord / $limit_per_page);
    ?>
    <nav aria-label="...">
        <!-- <ul class="pagination"> -->

            <?php
            $output .= ' <ul id="pagination" class="pagination">';

            if ($page > 1) {
                $previous = $page -1; 
                $output .= "<li class='page-item id='1'><span class='page-link'>First Page</span></li>";
                $output .= "<li class='page-item id='".$previous."'></li>";
                // <li class='page-item disabled'>
                //   <a class='{} btn btn-danger' id='{$page}-1' href=''>Prevoius</a>
                // </li>
            }

            for ($i = 1; $i <= $total_pages; $i++) {
                $class_name = "";
                if ($i == $page) {
                    $class_name = "active";
                } else {
                    $class_name = "";
                }
                // $output .= "<li class='page-item{$class_name}' id={$i}><a class='page-link' href=''>{$i}</a></li>";
                $output .=" <li class='page-item active' aria-current='page'>
                <a class='{$class_name} btn btn-success' id='{$i}' href=''>{$i}</a>
                </li>";
            }

            if ($total_pages > $page) {
                $output .= "<li class='page-item' id='".$page."'></li>";
                $output .= "<li class='page-item' id='".$total_pages."'><span class='page-link'>Last Page</span></li>";
            }
        //     <li class='page-item'>
        //     <a class='{$class_name} btn btn-danger' id='{$page}+1' href=''>Next</a>
        //   </li>
            $output .= ' </ul>';
            ?>
        <!-- </ul> -->
    </nav>
    <?php
    echo $output;
} else {
    $_SESSION['add_p_msg'] = "No Any Products Availabel!";
}
?>

<!-- <nav aria-label="...">
    <ul class="pagination">
        <li class="page-item disabled">
            <span class="page-link">Previous</span>
        </li>
        <li class="page-item"><a class="page-link" href="#">1</a></li>
        <li class="page-item active" aria-current="page">
            <span class="page-link">
                2
                <span class="sr-only">(current)</span>
            </span>
        </li>
        <li class="page-item"><a class="page-link" href="#">3</a></li>
        <li class="page-item">
            <a class="page-link" href="#">Next</a>
        </li>
    </ul>
</nav> -->