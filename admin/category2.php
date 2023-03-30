<?php

include 'index.php';
$conn = mysqli_connect("localhost","root","","registeration");
if($conn) {
    //echo "Connected successfully";
    
  }else{
    die("Connection failed: " . mysqli_connect_error());
  }
?>
<div class="container">
    <div class="row d-flex justify-content-center">
        
    <div class="col-md-8 mt-4">
    <h3 class="d-flex justify-content-center text-success">Category Table:</h3>
    <?php
        if(isset($_SESSION['add_p_msg'])){
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
    <a href="add_category.php" name="submit" class="btn btn-info">Add Category</a>
        <table class="table table-bordered mt-4">
            <thead class="bg-dark text-white fw-bold">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Category Name</th>
                    <th scope="col">Category Status</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $select = "SELECT * FROM `category`";
                $sql = mysqli_query($conn, $select);
                $idd = 1;
                if(mysqli_num_rows($sql)>0){
                    while($db_data = mysqli_fetch_assoc($sql)){
                        $id = $db_data['id'];
                        if($db_data['status']==1){
                            $status = "Active";
                        }else{
                            $status = "Deactive";
                        }
                        echo '<tr>
                        <td>' . $idd . '</td>
                        <td>' . $db_data['category_name'] . '</td>
                        <td>' .$status . '</td>
                        <td class="p-3"><a class="btn btn-success" href="edit_category.php?id='.$id.'">Edit</a> 
                        <a class="btn btn-danger" href="delete_category.php?id='.$id.'">Delete</a></td>
                    </tr>';
                        $idd++;
                    }
                }else{
                    $_SESSION['add_p_msg'] = "No Any Products Availabel!";
                }
                
                ?>
            </tbody>
        </table>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
</script>
<script>
$(".alert").delay(5000).slideUp(200, function() {
    $(this).alert('close');
});
</script>
</body>

</html>