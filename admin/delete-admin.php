<?php

// include constants.php 
include('../config/constants.php');
// get the id of admin to be deleted 

$id = $_GET['id'];

// write the eqlm query to delete  

$sql = "DELETE FROM tbl_admin WHERE id= $id";

$res = mysqli_query($conn,$sql);

if($res){
//  admin deleted successfully
// echo "admin deleted";

$_SESSION['delete'] = "<div class='success'>Admin deleted successfully</div>";

header('location: https://localhost/food-order/admin/manage-admin.php');

}else {
    // failed to delete admin 

    // echo "failed to delete admin";

    $_SESSION['delete'] = "<div class='error'>Failed to delete admin</div>";

header('location: https://localhost/food-order/admin/manage-admin.php');

}
// redirect to managae admin page


?>