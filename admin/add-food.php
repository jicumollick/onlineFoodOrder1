
<?php
include('partials/menu.php');

?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Food</h1>
        <br> <br>

        <?php

        if(isset($_SESSION['upload'])){
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }

        
      

        ?>

        <form action="" method="POST" enctype="multipart/form-data">
    
        <table class="tbl-30">
            <tr>
                <td>Title: </td>
                <td>
                    <input type="text" name="title" placeholder="Title of the food">
                </td>
            </tr>

            <tr>
                <td>Description: </td>
                <td>
                    <textarea name="description"  cols="30" rows="5" placeholder="Description of the food"></textarea>
                </td>
            </tr>

            <tr>
                <td>Price: </td>
                <td>
                    <input type="number" name="price">
                </td>
            </tr>

            <tr>
                <td>Select Image: </td>
                <td>
                    <input type="file" name="image" >
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

                        while($row=mysqli_fetch_assoc($res)){

                            $id= $row['id'];
                            $title = $row['title'];

                            ?>

                        <option value=" <?php echo $id; ?>"><?php echo $title; ?></option>


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
                        <input type="radio" name="featured" value="yes" > YES 
                        <input type="radio" name="featured" value="no"> NO 

                    </td>
                </tr>
                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="active" value="yes"> YES 
                        <input type="radio" name="active" value="no"> NO 

                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Food" class="btn-secondary">
                    </td>
                </tr>
        </table>
        </form>

        <?php


        if(isset($_POST['submit'])){
            
            $title = $_POST['title'];
            $description = $_POST['description'];

            $price = $_POST['price'];
            $category = $_POST['category'];

            if(isset($_POST['featured'])){
                $featured= $_POST['featured'];
            }else {
                $featured = "no";
            }

            if(isset($_POST['active'])){
                $active= $_POST['active'];
            }else {
                $active = "no";
            }

            if(isset($_FILES['image']['name'])){

                $image_name = $_FILES['image']['name'];
                


                if($image_name!=""){
                    $ext = end(explode('.',$image_name));
                    $image_name = "Food Name-".rand(0000,1000).".".$ext;



                    $src = $_FILES['image']['tmp_name'];

                    $dst = "../images/food/".$image_name;

                    $upload = move_uploaded_file($src,$dst);

                    if(!$upload){


                        $_SESSION['upload'] = "<div class='error'>Failed to Upload Image</div>";
                        header('location: https://localhost/food-order/admin/add-food.php');

                        die();
                    }
                }

            }else {
                $image_name= "";
            }
            $sql2= "INSERT INTO tbl_food SET
            title = '$title',
            description = '$description',
            price = $price,
            image_name = '$image_name',
            category_id = $category,
            featured = '$featured',
            active = '$active'
            ";

            $res2 = mysqli_query($conn,$sql2);
            if($res2){

                $_SESSION['add'] = "<div class='success'> Food Added Successfully</div>";
                header('location: https://localhost/food-order/admin/manage-food.php');

            }else {
                
                $_SESSION['add'] = "<div class='error'>Failed to Add Food</div>";
                header('location: https://localhost/food-order/admin/manage-food.php');

            }

        }

        ?>
    </div>
</div>


<?php
include('partials/footer.php');

?>