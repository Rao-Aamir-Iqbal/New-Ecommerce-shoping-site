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
    <a href="add_category.php" name="submit" class="btn btn-info">Add Category</a>
        <div class="col-md-8 mt-4" id="table-data">
            <h3 class="d-flex justify-content-center text-success">Category Table:</h3>
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
            
            
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
        </script>
    <script type="text/javascript">
        $(document).ready(function () {
            function loadTable(page) {
                $.ajax({
                    url: "ajax-pagination1.php",
                    method: "POST",
                    data: { page_no: page },
                    success: function (data) {
                        $("#table-data").html(data);
                    }
                });
            }
            loadTable();

            $(document).on("click","#pagination a", function(e){
                e.preventDefault();
                var page_id = $(this).attr("id");
                loadTable(page_id);

            })


            $(".alert").delay(5000).slideUp(200, function () {
                $(this).alert('close');
            });
        });

    </script>
    </body>

    </html>