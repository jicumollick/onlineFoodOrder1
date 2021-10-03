<?php
include('partials/menu.php');

?>

<?php

if(isset($_GET['id'])){

    $id = $_GET['id'];

    $sql2= "SELECT * FROM tbl_food WHERE id=$id";

    $res2 = mysqli_query($conn,$sql2);

    $row = mysqli_fetch_assoc($res2);

    $title = $row['title'];
    
                            $description = $row['description'];
                            $price = $row['price'];
                            $current_image = $row['image_name'];
                            $current_category = $row['category_id'];
                            $featured = $row['featured'];
                            $active = $row['active'];


}else {

    header('location: https://localhost/food-order/admin/manage-food.php');
}
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Food</h1>
        <br> <br>

        <form action="" method="POST" enctype="multipart/form-data">
        <table class="tbl-30">
            <tr>
                <td>Title: </td>
                <td>
                    <input type="text" name="title" value="<?php echo $title; ?>" >
                </td>
            </tr>

            <tr>
                <td>Description: </td>
                <td>
                    <textarea name="description"  cols="30" rows="5" > <?php echo $description; ?></textarea>
                </td>
            </tr>

            <tr>
                <td>Price: </td>
                <td>
                    <input type="number" name="price" value="<?php echo $price; ?>">
                </td>
            </tr>

            <tr>
                <td>Current Image: </td>
                <td>
                    <?php

                    if($current_image == ""){

                        echo "<div class='error'> Image not Available</div>";
                    }else {

                        ?>
                        <img src="https://localhost/food-order/images/food/<?php echo $current_image; ?>" alt="something wrong" width="150px">

                        <?php

                    }

                    ?>
                </td>
            </tr>

            <tr>
                <td>Select New Image: </td>
                <td>
                    <input type="file" name="image">

                </td>
            </tr>

            <tr>
                <td>Category: </td>
                <td>
                    <select name="category">

                    <?php

                    $sql= "SELECT * FROM tbl_category WHERE active='yes'";

                    $res = mysqli_query($conn,$sql);

                    $count = mysqli_num_rows($res);

                    if($count > 0){

                        while($row2=mysqli_fetch_assoc($res)){

                            $category_id= $row2['id'];
                            $category_title = $row2['title'];

                            ?>

                        <option <?php if($current_category==$category_id){ echo "selected"; }  ?> value=" <?php echo $category_id; ?>"><?php echo $category_title; ?></option>


                           <?php



                            // $description = $row['description'];
                            // $price = $row['price'];
                            // $iamge = $row['image'];
                            // $category = $row['category'];
                            // $featured = $row['row'];
                            // $active = $row['active'];
                        }


                    }else {

                        ?>
                    <option value="0">No Category found</option>

                        <?php

                    }

                    ?>
                        
                       

                    </select>
                </td>
            </tr>

            <tr>
                    <td>Featured: </td>
                    <td>
                        <input <?php if($featured== "yes") { echo "checked"; } ?> type="radio" name="featured" value="yes" > YES 
                        <input <?php if($featured== "no") { echo "checked"; } ?> type="radio" name="featured" value="no"> NO 

                    </td>
            </tr>

            <tr>
                    <td>Active: </td>
                    <td>
                        <input <?php if($active=="yes") { echo "checked"; } ?> type="radio" name="active" value="yes"> YES 
                        <input <?php if($active=="no") { echo "checked"; } ?> type="radio" name="active" value="no"> NO 

                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="submit" name="submit" value="Update Food" class="btn-secondary">
                    </td>
                </tr>
        </table>

        </form>

        <?php

                if(isset($_POST['submit'])){
                    
                    $id = $_POST['id'];
                    $title = $_POST['title'];
                    $description = $_POST['description'];
                    $price = $_POST['price'];
                    $current_image = $_POST['current_image'];
                    $category = $_POST['category'];

                    $featured = $_POST['featured'];
                    $active = $_POST['active'];


                    if(isset($_FILES['image']['name'])){
                        $image_name = $_FILES['image']['name'];

                        if($image_name!=""){
                            $ext = end(explode('.',$image_name));

                            $image_name = "Food-Name-".rand(0000,1000).".".$ext;
                            
                            $src = $_FILES['image']['tmp_name'];
                            $dst = "../images/food/".$image_name;

                            $upload = move_uploaded_file($src,$dst);

                            if(!$upload){
                                $_SESSION['upload']="<div class='error'>Failed to upload Image</div>";
                                header('location: https://localhost/food-order/admin/manage-food.php');
                                die();
                            }

                            if($current_image!=""){

                                $remove_path = "../images/food/".$current_image;

                                $remove= unlink($remove_path);

                                if(!$remove){

                                    $_SESSION['remove-failed']="<div class='error'>Failed to remove current image</div>";
                                    header('location: https://localhost/food-order/admin/manage-food.php');
                                    die();
                                    
                                }

                            }
                        }else {
                        $image_name = $current_image;

                        }

                    }else {
                        $image_name = $current_image;
                    }

                    $sql3 = "UPDATE tbl_food SET
                    title = '$title',
                    description = '$description',
                    price = $price,
                    image_name = '$image_name',
                    category_id = '$category',
                    featured = '$featured',
                    active = '$active'
                    WHERE id=$id
                    ";

                    $res3 = mysqli_query($conn,$sql3);

                    if($res3){

                        
                        $_SESSION['update']="<div class='success'>Fodd Updated Successfully</div>";
                        header('location: https://localhost/food-order/admin/manage-food.php');

                    }else {
                        $_SESSION['update']="<div class='error'>Failed to Update Food</div>";
                        header('location: https://localhost/food-order/admin/manage-food.php');

                    }
                }

        ?>




    </div>
</div>
<?php
include('partials/footer.php');

?>