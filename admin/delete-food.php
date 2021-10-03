<?php

include('../config/constants.php');

if(isset($_GET['id']) && isset($_GET['image_name'])){

    $id = $_GET['id'];
    $image_name = $_GET['image_name'];

    if($image_name !=""){

        $path = "../images/food/".$image_name;
        $remove = unlink($path);

        if(!$remove){

            $_SESSION['upload']="<div class='error'>Failed to remove image</div>";
            header('location: https://localhost/food-order/admin/manage-food.php');
            die();

        }
    }

    $sql = "DELETE FROM tbl_food WHERE id=$id";
    $res = mysqli_query($conn,$sql);

    if($res){
        $_SESSION['delete']= "<div class='success'>Food Deleted Successfuly</div>";
        header('location: https://localhost/food-order/admin/manage-food.php');

    }else {
        $_SESSION['delete']= "<div class='error'>Failed to delete food</div>";
        header('location: https://localhost/food-order/admin/manage-food.php');

    }

}else {

    $_SESSION['unauthor']= "<div class='error'>Unauthorized access</div>";
    header('location: https://localhost/food-order/admin/manage-food.php');
}

?>