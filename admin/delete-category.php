
<?php

include('../config/constants.php');

// echo "Delete Page"; 
// check wheter id and image name value is set or not 
if(isset($_GET['id']) && isset($_GET['image_name'])){

    // get the value and delete category
    // echo "we get the value";

    $id= $_GET['id'];
    $image_name = $_GET['image_name'];
    // Remopve the image 
    if($image_name !=""){
        
        $path = "../images/category/".$image_name;
        $remove = unlink($path);

        if($remove == false){
            $_SESSION['remove']= "<div class='error'>Failed to Remove Category Image</div>";
            header('location:https://localhost/food-order/admin/manage-category.php');
            die();
        }
    }

    // delete data data from database 
    $sql = "DELETE FROM tbl_category WHERE id=$id";

    $res = mysqli_query($conn,$sql);

    if($res){

        $_SESSION['delete']= "<div class='success'>Category Deleted Successfully</div>";
        header('location:https://localhost/food-order/admin/manage-category.php');


    }else{
        $_SESSION['delete']= "<div class='error'>Failed to Delete category</div>";
        header('location:https://localhost/food-order/admin/manage-category.php');



    }

    // redirect to manage category 
}else {
    // redirect to the manage category page 

    header('https://localhost/food-order/admin/manage-category.php');
}


?>