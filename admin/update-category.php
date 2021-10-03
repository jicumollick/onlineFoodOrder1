<?php
include('partials/menu.php');
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Category</h1>
        <br> <br>

        
<?php

// getting id from manage category page

if(isset($_GET['id'])){

    $id = $_GET['id'];

    $sql= "SELECT * FROM tbl_category WHERE id=$id";

    $res=mysqli_query($conn,$sql);

    if($res){

        // get all data 
        $row= mysqli_fetch_assoc($res);

        $title= $row['title'];
        $current_image = $row['image_name'];
        $featured= $row['featured'];
        $active = $row['active'];

    }else{

        $_SESSION['no-category-found']="<div class='error'>Category Not Found</div>";
        header('location:https://localhost/food-order/admin/manage-category.php');

    }
}else {
    header('location:https://localhost/food-order/admin/manage-category.php');
}

?>


        <form action="" method="POST" enctype="multipart/form-data">
        <table class="tbl-30">
        <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Current Image: </td>
                    <td>
                        <?php
                        
                        if($current_image!=""){
                            // Display the image 

                           

                            ?>
                                                        <!-- <img src="https://localhost/food-order/images/category/<?php echo $current_image; ?>" alt="something wrong"> -->

                            <?php echo "<img src='https://localhost/food-order/images/category/$current_image' width='100px'/>" ?>

                            <?php
                        }else{
                            // display message
                            echo "<div class='error'>Image Not Added</div>";
                        }

                        ?>
                    </td>
                </tr>
                <tr>
                    <td>New Image: </td>
                    <td>
                       <input type="file" name="image">

                    </td>
                </tr>
                <tr>
                    <td>Featured: </td>
                    <td>
                        <input <?php if($featured=="yes"){ echo "checked"; } ?> type="radio" name="featured" value="yes"> YES 
                        <input <?php if($featured=="no"){ echo "checked"; } ?> type="radio" name="featured" value="no"> NO 

                    </td>
                </tr>
                <tr>
                    <td>Active: </td>
                    <td>
                        <input <?php if($active=="yes"){ echo "checked"; } ?> type="radio" name="active" value="yes"> YES 
                        <input <?php if($active=="no"){ echo "checked"; } ?> type="radio" name="active" value="no"> NO 

                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">

                        <input type="submit" name="submit" value="Update Category" class="btn-secondary">
                    </td>
                </tr>

        </table>
        </form>

<?php

if(isset($_POST['submit'])){
    
    $id = $_POST['id'];
    $title = $_POST['title'];
    $current_image = $_POST['current_image'];
    $featured = $_POST['featured'];
    $active = $_POST['active'];

    if(isset($_FILES['image']['name'])){

       $image_name = $_FILES['image']['name'];
       if($image_name!=""){

        // uload the new image 
        $image_name = $_FILES['image']['name'];

        if($image_name!=""){

            $source_path = $_FILES['image']['tmp_name'];
            $destination_path = "../images/category/".$image_name;
    
            $upload = move_uploaded_file($source_path,$destination_path);
    
            if(!$upload){
                $_SESSION['upload']= "<div class='error'>Failed to Upload Image</div>";
                header('location: https://localhost/food-order/admin/manage-category.php');
                die();
            }else{
                
            }

            // remove the current image 
            if($current_image!=""){
                $remove_path = "../images/category/".$current_image;

            $remove = unlink($remove_path);

            // check whether the image is removed or not 
            if(!$remove){
                $_SESSION['failed-reemove']="<div class='error'>Failed to remove current image</div>";
                header('location: https://localhost/food-order/admin/manage-category.php');
                die();

            }


            }

            

       }else{
        $image_name= $current_image;
       }

    }else {
        $image_name= $current_image;
    }

    $sql2= "UPDATE tbl_category SET
    title = '$title',
    image_name = '$image_name',
    active = '$active',
    featured = '$featured'
    WHERE id=$id
    ";


$res2 = mysqli_query($conn,$sql2);

    if($res2){

    $_SESSION['update']="<div class='success'>Category Updated Successfuly</div>";
    header('location: https://localhost/food-order/admin/manage-category.php');

    }else{

    $_SESSION['update']="<div class='error'>Failed to Update Category</div>";
    header('location: https://localhost/food-order/admin/manage-category.php');

    }


    }

}

?>


    </div>
</div>

<?php
include('partials/footer.php');
?>