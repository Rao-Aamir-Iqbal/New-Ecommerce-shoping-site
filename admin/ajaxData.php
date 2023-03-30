<?php 
// Include the database config file
$conn = mysqli_connect("localhost","root","","registeration");
if($conn) {
    //echo "Connected successfully";
    
  }else{
    die("Connection failed: " . mysqli_connect_error());
  }
 
if(!empty($_POST["category_id"])){ 
    // Fetch state data based on the specific country 
    $query = "SELECT * FROM subcategory WHERE category_id = '".$_POST['category_id']."'"; 
    $result = mysqli_query($conn, $query); 
     
    // Generate HTML of state options list 
    if(mysqli_num_rows($result) > 0){ 
        echo '<option value="">Now Select Sub-Category</option>'; 
        while($row = mysqli_fetch_assoc($result)){  
            echo '<option value="'.$row['id'].'">'.$row['sub_category_name'].'</option>'; 
        } 
    }else{ 
        echo '<option value="">Sub-Category not available</option>'; 
    } 
}
?>