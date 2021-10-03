
<?php
include('partials/menu.php');

?>


<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1>
        <br><br>
        <?php

        if(isset($_SESSION['add'])){
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }

        if(isset($_SESSION['upload'])){
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }


        ?>
        <!-- Add category Form  -->

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" placeholder="Enter Category title">
                    </td>
                </tr>
                <tr>
                    <td>Image: </td>
                    <td>
                        <input type="file" name="image">
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
                        <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>


        <!-- end category Form  -->
<?php

if(isset($_POST['submit'])){
    // echo "clicked";
    $title = $_POST['title'];

    if(isset($_POST['featured'])){
        $featured = $_POST['featured'];

    }else{
        $featured = "no";

    }

    if(isset($_POST['active'])){
        $active = $_POST['active'];

    }else{
        $active = "no";

    }

    if(isset($_FILES['image']['name'])){

        $image_name = $_FILES['image']['name'];

        if($image_name!=""){

            $source_path = $_FILES['image']['tmp_name'];
            $destination_path = "../images/category/".$image_name;
    
            $upload = move_uploaded_file($source_path,$destination_path);
    
            if(!$upload){
                $_SESSION['upload']= "<div class='error'>Failed to Upload Image</div>";
                header('location: https://localhost/food-order/admin/add-category.php');
                die();
            }else{
                
            }
    
        }
    }else {
        $image_name="";
    
        }

        
       

    // create sql query to insert data in database 

    $sql= "INSERT INTO tbl_category SET
    title= '$title',
    image_name = '$image_name',
    featured= '$featured',
    active= '$active'
    ";

    $res = mysqli_query($conn,$sql);

    if($res){

        $_SESSION['add']= "<div class='success'>Category Added Successfully</div>";
        header('location: https://localhost/food-order/admin/manage-category.php');

    }else {
        
        $_SESSION['add']= "<div class='error'>Failed To Add Category</div>";
        header('location: https://localhost/food-order/admin/add-category.php');

    }
}
?>
    </div>
</div>










<?php
include('partials/footer.php');

?>